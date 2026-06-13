@extends('layouts.app')
@section('title', 'Career Assistant AI')
@section('content')
@php
    $user = Auth::user();
    $pc = '';
    $pc .= "- Jenjang: {$user->jenjang_label}\n";
    if ($user->jurusan) $pc .= "- Jurusan: {$user->jurusan}\n";
    if ($user->kelas) $pc .= "- Kelas: {$user->kelas}\n";
    if ($user->sekolah) $pc .= "- Sekolah: {$user->sekolah}\n";
    if ($user->semester) $pc .= "- Semester: {$user->semester}\n";
    if ($user->ipk) $pc .= "- IPK: {$user->ipk}\n";
    if ($user->universitas) $pc .= "- Universitas: {$user->universitas}\n";
    if ($user->last_education) $pc .= "- Pendidikan Terakhir: {$user->last_education}\n";
    if ($user->skills) $pc .= "- Keahlian/Skills: {$user->skills}\n";
    if ($user->experience) $pc .= "- Pengalaman Kerja/Magang/Proyek:\n{$user->experience}\n";
    if ($user->organisasi) $pc .= "- Pengalaman Organisasi:\n{$user->organisasi}\n";
@endphp
<div class="ch-wrap fade-in">
    <div class="ch-hd">
        <div class="ch-hd-ic" style="background:var(--c1g);color:var(--c1)">💼</div>
        <div><div class="ch-hd-t">Career Assistant AI</div><div class="ch-hd-d">artificial intelligence by GPT-4o & Puter.js · Free & Unlimited</div></div>
        <div class="ch-hd-s"><div class="sd"></div>Online</div>
    </div>
    <div class="ch-msgs" id="chatMessages">
        <div class="msg ai"><div class="msg-av">💼</div><div class="msg-bb">Halo <strong>{{ $user->name }}</strong>! Saya Career Assistant AI.

Saya sudah melihat profilmu ({{ $user->jenjang_label }}) dan siap memberikan rekomendasi karier yang personal.

Klik rekomendasi di bawah atau ketik pertanyaanmu!</div></div>
    </div>
    <div class="qk" id="quickActions">
        @if($user->skills)
            <button class="qk-b" onclick="ask(this)">Saya menguasai {{ Str::limit($user->skills, 50) }}. Karier apa yang cocok?</button>
        @endif
        @if($user->jurusan)
            <button class="qk-b" onclick="ask(this)">Saya {{ $user->jenjang_label }} jurusan {{ $user->jurusan }}. Skill tambahan apa?</button>
        @endif
        @if($user->organisasi)
            <button class="qk-b" onclick="ask(this)">Berdasarkan pengalaman organisasi saya, soft skill apa yang sudah saya miliki?</button>
        @endif
        @if($user->experience)
            <button class="qk-b" onclick="ask(this)">Berdasarkan pengalaman kerja/magang saya, apa kekuatan saya?</button>
        @endif
        <button class="qk-b" onclick="ask(this)">Buatkan roadmap belajar 6 bulan untuk karier saya.</button>
        <button class="qk-b" onclick="ask(this)">Sertifikasi apa yang cocok untuk saya?</button>
        <button class="qk-b" onclick="ask(this)">Simulasi wawancara kerja berdasarkan profil saya.</button>
    </div>
    <div class="ch-in"><div class="in-w">
        <textarea class="ch-inp" id="userInput" rows="1" placeholder="Tanyakan tentang karier, skill, atau sertifikasi..." onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();send()}"></textarea>
        <button class="snd" id="sendBtn" onclick="send()">↑</button>
    </div></div>
</div>
@endsection
@section('scripts')
<script>
const MODULE='career',AVATAR='💼';
const SYSTEM_PROMPT=`Kamu adalah Career Assistant AI dari SmartScholar AI. Konselor karier yang ramah untuk SEMUA jenjang.\n\nPROFIL PENGGUNA:\n{!! $pc !!}\n- Nama: {{ $user->name }}\n\nATURAN:\n- Bahasa Indonesia profesional tapi hangat\n- Sesuaikan rekomendasi dengan jenjang user\n- Untuk SMP: fokus eksplorasi minat bakat\n- Untuk SMA: fokus jurusan kuliah & karier masa depan\n- Untuk SMK: fokus skill teknis & dunia kerja langsung\n- Untuk Kuliah: fokus karier profesional & sertifikasi\n- Untuk Tidak Kuliah: fokus skill praktis & peluang kerja/wirausaha\n- Gunakan data pengalaman organisasi untuk analisis soft skill\n- Gunakan data pengalaman kerja untuk analisis hard skill\n- Selalu jawab terstruktur dengan heading dan bullet`;
const chatEl=document.getElementById('chatMessages'),inputEl=document.getElementById('userInput'),sendBtn=document.getElementById('sendBtn'),quickEl=document.getElementById('quickActions');
let chatHistory=[{role:'system',content:SYSTEM_PROMPT}];
inputEl.addEventListener('input',()=>{inputEl.style.height='auto';inputEl.style.height=Math.min(inputEl.scrollHeight,120)+'px'});
function addMsg(t,u){const d=document.createElement('div');d.className='msg '+(u?'u':'ai');d.innerHTML=u?`<div class="msg-av">AR</div><div class="msg-bb">${esc(t)}</div>`:`<div class="msg-av">${AVATAR}</div><div class="msg-bb">${fmt(t)}</div>`;chatEl.appendChild(d);chatEl.scrollTop=chatEl.scrollHeight}
function addTyp(){const d=document.createElement('div');d.className='msg ai';d.id='typing';d.innerHTML=`<div class="msg-av">${AVATAR}</div><div class="msg-bb"><div class="typ"><span></span><span></span><span></span></div></div>`;chatEl.appendChild(d);chatEl.scrollTop=chatEl.scrollHeight}
function rmTyp(){const e=document.getElementById('typing');if(e)e.remove()}
function esc(s){const d=document.createElement('div');d.textContent=s;return d.innerHTML}
function fmt(t){return t.replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>').replace(/^#{1,3} (.*$)/gm,'<h4>$1</h4>').replace(/^[•\-] (.*$)/gm,'<li>$1</li>').replace(/(<li>.*?<\/li>)/gs,'<ul>$1</ul>').replace(/<\/ul>\s*<ul>/g,'').replace(/\n\n/g,'<br><br>').replace(/\n/g,'<br>')}
async function send(){const text=inputEl.value.trim();if(!text)return;quickEl.style.display='none';addMsg(text,true);inputEl.value='';inputEl.style.height='auto';chatHistory.push({role:'user',content:text});addTyp();sendBtn.disabled=true;try{const res=await puter.ai.chat(chatHistory,{model:'gpt-4o'});rmTyp();const ai=res?.toString()||res?.message?.content||'Tidak ada respons.';addMsg(ai,false);chatHistory.push({role:'assistant',content:ai});try{await fetch('{{route("chat.send")}}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({module:MODULE,role:'assistant',message:ai})})}catch(e){}}catch(e){rmTyp();addMsg('Error: '+e.message,false)}sendBtn.disabled=false;inputEl.focus()}
function ask(b){inputEl.value=b.textContent;send()}
</script>
@endsection
