@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="fade-in">
    <div class="dg">
        <p class="dg-t">Selamat datang, <b>{{ Auth::user()->name }}</b></p>
        <p class="dg-s">{{ Auth::user()->subtitle }}</p>
    </div>
    <div class="nb info" style="margin-bottom:24px">
        <div>💡</div>
        <div><b>Puter.js AI Engine:</b> Semua chatbot memakai API gratis tanpa batas. Tidak perlu API key. Model: GPT-4o.</div>
    </div>
    @if(!Auth::user()->jenjang || Auth::user()->jenjang === 'kuliah' && !Auth::user()->jurusan)
    <div class="nb" style="background:#f59e0b11;border:1px solid #f59e0b44;margin-bottom:24px">
        <div>⚠️</div>
        <div><b>Profil belum lengkap!</b> <a href="{{ route('profile') }}">Lengkapi profil</a> agar AI bisa memberikan rekomendasi personal.</div>
    </div>
    @endif
    <div class="stg">
        <a href="{{ route('career') }}" class="stc c"><div class="st-ic">💼</div><div class="st-t">Career Assistant AI</div><div class="st-d">Konsultasi karier, analisis skill, roadmap belajar.</div><div class="st-st"><div class="dot"></div>AI Aktif</div></a>
        <a href="{{ route('scholarship') }}" class="stc s"><div class="st-ic">🎓</div><div class="st-t">Scholarship Assistant AI</div><div class="st-d">Cari beasiswa, motivation letter, tips seleksi.</div><div class="st-st"><div class="dot"></div>AI Aktif</div></a>
        <a href="{{ route('library') }}" class="stc l"><div class="st-ic">📚</div><div class="st-t">Smart Library AI</div><div class="st-d">Rekomendasi buku, ringkasan, referensi.</div><div class="st-st"><div class="dot"></div>AI Aktif</div></a>
    </div>
</div>
@endsection
