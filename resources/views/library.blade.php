@extends('layouts.app')
@section('title', 'Smart Library AI')
@section('content')
<div class="ch-wrap fade-in">
    <div class="ch-hd">
        <div class="ch-hd-ic" style="background:var(--c3g);color:var(--c3)">📚</div>
        <div><div class="ch-hd-t">Smart Library AI</div><div class="ch-hd-d">artificial intelligence by GPT-4o & Puter.js · Free & Unlimited</div></div>
        <div class="ch-hd-s"><div class="sd"></div>Online</div>
    </div>
    <div class="ch-msgs" id="chatMessages">
        <div class="msg ai"><div class="msg-av">📚</div><div class="msg-bb">Halo <strong>{{ Auth::user()->name }}</strong>! Saya Smart Library AI.

Saya akan membantu:
- Rekomendasi buku berdasarkan topik
- Ringkasan buku
- Referensi skripsi/thesis
- Tanya jawab literatur

Klik rekomendasi di bawah atau ketik topik buku yang kamu cari!</div></div>
    </div>
    <div class="qk" id="quickActions">
        @if(Auth::user()->jurusan)
            <button class="qk-b" onclick="ask(this)">Rekomendasikan buku untuk mahasiswa {{ Auth::user()->jurusan }}</button>
        @endif
        <button class="qk-b" onclick="ask(this)">Ringkasan buku 'Atomic Habits' oleh James Clear</button>
        <button class="qk-b" onclick="ask(this)">Buku machine learning untuk pemula</button>
        <button class="qk-b" onclick="ask(this)">Referensi skripsi tentang pemasaran digital UMKM</button>
        <button class="qk-b" onclick="ask(this)">Buku terbaik tentang kepemimpinan</button>
    </div>
    <div class="ch-in"><div class="in-w">
        <textarea class="ch-inp" id="userInput" rows="1" placeholder="Cari buku atau literatur..." onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();send()}"></textarea>
        <button class="snd" id="sendBtn" onclick="send()">↑</button>
    </div></div>
</div>
@endsection
@section('scripts')
<script>
const MODULE = 'library';
const AVATAR = '📚';

const SYSTEM_PROMPT = `Kamu adalah Smart Library AI dari SmartScholar AI. Pustakawan digital yang ahli.

TUGAS:
- Rekomendasikan buku: Judul + Penulis + Tahun + Ringkasan + Rating
- Berikan referensi skripsi: jurnal, paper, buku teks, framework
- Bantu cari literatur berdasarkan topik
- Berikan ringkasan buku yang informatif

ATURAN:
- Bahasa Indonesia, terstruktur
- Selalu gunakan heading dan bullet points
- Berikan informasi yang akurat
- Fokus hanya pada literatur dan perpustakaan`;

const chatEl = document.getElementById('chatMessages');
const inputEl = document.getElementById('userInput');
const sendBtn = document.getElementById('sendBtn');
const quickEl = document.getElementById('quickActions');

let chatHistory = [{ role: 'system', content: SYSTEM_PROMPT }];

inputEl.addEventListener('input', () => {
    inputEl.style.height = 'auto';
    inputEl.style.height = Math.min(inputEl.scrollHeight, 120) + 'px';
});

function addMsg(t, u) {
    const d = document.createElement('div');
    d.className = 'msg ' + (u ? 'u' : 'ai');
    d.innerHTML = u
        ? `<div class="msg-av">AR</div><div class="msg-bb">${esc(t)}</div>`
        : `<div class="msg-av">${AVATAR}</div><div class="msg-bb">${fmt(t)}</div>`;
    chatEl.appendChild(d);
    chatEl.scrollTop = chatEl.scrollHeight;
}

function addTyp() {
    const d = document.createElement('div');
    d.className = 'msg ai';
    d.id = 'typing';
    d.innerHTML = `<div class="msg-av">${AVATAR}</div><div class="msg-bb"><div class="typ"><span></span><span></span><span></span></div></div>`;
    chatEl.appendChild(d);
    chatEl.scrollTop = chatEl.scrollHeight;
}

function rmTyp() {
    const e = document.getElementById('typing');
    if (e) e.remove();
}

function esc(s) {
    const d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
}

function fmt(t) {
    return t.replace(/</g, '&lt;').replace(/>/g, '&gt;')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/^#{1,3} (.*$)/gm, '<h4>$1</h4>')
        .replace(/^[•\-] (.*$)/gm, '<li>$1</li>')
        .replace(/(<li>.*?<\/li>)/gs, '<ul>$1</ul>')
        .replace(/<\/ul>\s*<ul>/g, '')
        .replace(/\n\n/g, '<br><br>')
        .replace(/\n/g, '<br>');
}

async function send() {
    const text = inputEl.value.trim();
    if (!text) return;
    quickEl.style.display = 'none';
    addMsg(text, true);
    inputEl.value = '';
    inputEl.style.height = 'auto';
    chatHistory.push({ role: 'user', content: text });
    addTyp();
    sendBtn.disabled = true;
    try {
        const response = await puter.ai.chat(chatHistory, { model: 'gpt-4o' });
        rmTyp();
        const aiText = response?.toString() || response?.message?.content || 'Maaf, tidak ada respons.';
        addMsg(aiText, false);
        chatHistory.push({ role: 'assistant', content: aiText });
        try {
            await fetch('{{ route("chat.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ module: MODULE, role: 'assistant', message: aiText })
            });
        } catch (e) {}
    } catch (e) {
        rmTyp();
        addMsg('Terjadi error: ' + e.message, false);
    }
    sendBtn.disabled = false;
    inputEl.focus();
}

function ask(b) {
    inputEl.value = b.textContent;
    send();
}
</script>
@endsection
