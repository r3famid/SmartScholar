@extends('layouts.app')
@section('title', 'Scholarship Assistant AI')
@section('content')
<div class="ch-wrap fade-in">
    <div class="ch-hd">
        <div class="ch-hd-ic" style="background:var(--c2g);color:var(--c2)">🎓</div>
        <div><div class="ch-hd-t">Scholarship Assistant AI</div><div class="ch-hd-d">artificial intelligence by GPT-4o & Puter.js · Free & Unlimited</div></div>
        <div class="ch-hd-s"><div class="sd"></div>Online</div>
    </div>
    <div class="ch-msgs" id="chatMessages">
        <div class="msg ai"><div class="msg-av">🎓</div><div class="msg-bb">Halo <strong>{{ Auth::user()->name }}</strong>! Saya Scholarship Assistant AI.

Saya akan membantu:
- Rekomendasi beasiswa berdasarkan profilmu
- Draft & review motivation letter
- Tips seleksi & wawancara

Klik rekomendasi di bawah atau ceritakan profilmu!</div></div>
    </div>
    <div class="qk" id="quickActions">
        @if(Auth::user()->ipk)
            <button class="qk-b" onclick="ask(this)">IPK saya {{ Auth::user()->ipk }}, semester {{ Auth::user()->semester ?? '?' }}. Rekomendasikan beasiswa yang cocok.</button>
        @endif
        <button class="qk-b" onclick="ask(this)">Buatkan draft motivation letter untuk LPDP</button>
        <button class="qk-b" onclick="ask(this)">Tips lolos seleksi beasiswa Bank Indonesia</button>
        <button class="qk-b" onclick="ask(this)">Apa saja beasiswa yang sedang dibuka untuk mahasiswa Indonesia?</button>
        <button class="qk-b" onclick="ask(this)">Review motivation letter saya</button>
    </div>
    <div class="ch-in"><div class="in-w">
        <textarea class="ch-inp" id="userInput" rows="1" placeholder="Ceritakan profilmu atau tanyakan tentang beasiswa..." onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();send()}"></textarea>
        <button class="snd" id="sendBtn" onclick="send()">↑</button>
    </div></div>
</div>
@endsection
@section('scripts')
<script>
const MODULE = 'scholarship';
const AVATAR = '🎓';

const SYSTEM_PROMPT = `Kamu adalah Scholarship Assistant AI dari SmartScholar AI. Tutor beasiswa untuk mahasiswa Indonesia.

TUGAS:
- Rekomendasikan beasiswa: LPDP, Bank Indonesia, Djarum Plus, Kemendikbud, Tanoto Foundation, dll
- Bantu buat dan review motivation letter
- Berikan tips seleksi dan wawancara beasiswa
- Format rekomendasi: Nama beasiswa + persyaratan + deadline + tips

ATURAN:
- Bahasa Indonesia, informatif dan terstruktur
- Selalu gunakan heading dan bullet points
- Berikan informasi yang akurat dan praktis
- Fokus hanya pada beasiswa dan pendidikan`;

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
