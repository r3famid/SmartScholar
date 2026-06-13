@extends('layouts.app')
@section('title', 'Tentang Tim')
@section('content')
<div class="fade-in">
    {{-- HERO --}}
    <div class="about-hero">
        <div class="about-logo">
            <img src="{{ asset('favicon.png') }}" alt="SmartScholar AI">
        </div>
        <h1 class="about-title">SmartScholar AI</h1>
        <div class="about-badge">Artificial Intelligence</div>
        <p class="about-desc">Platform Asisten Mahasiswa Berbasis Kecerdasan Buatan yang dikembangkan menggunakan Laravel 13, PHP 8.4, MySQL, dan Puter.js API dengan model GPT-4o. SmartScholar AI menyediakan tiga modul utama: Career Assistant, Scholarship Assistant, dan Smart Library yang dapat diakses secara gratis dan tanpa batas.</p>
    </div>

    {{-- FITUR UTAMA --}}
    <div class="about-section">
        <div class="about-section-title">Fitur Utama</div>
        <div class="about-features">
            <div class="about-feat-card">
                <div class="about-feat-icon" style="background:var(--c1g);color:var(--c1)">💼</div>
                <div class="about-feat-name">Career Assistant AI</div>
                <div class="about-feat-desc">Konsultasi karier personal berdasarkan profil, keahlian, dan pengalaman pengguna</div>
            </div>
            <div class="about-feat-card">
                <div class="about-feat-icon" style="background:var(--c2g);color:var(--c2)">🎓</div>
                <div class="about-feat-name">Scholarship Assistant AI</div>
                <div class="about-feat-desc">Rekomendasi beasiswa, bantuan motivation letter, dan tips seleksi</div>
            </div>
            <div class="about-feat-card">
                <div class="about-feat-icon" style="background:var(--c3g);color:var(--c3)">📚</div>
                <div class="about-feat-name">Smart Library AI</div>
                <div class="about-feat-desc">Rekomendasi buku, ringkasan, dan referensi literatur akademik</div>
            </div>
        </div>
    </div>

    {{-- MULTI JENJANG --}}
    <div class="about-section">
        <div class="about-section-title">Mendukung 5 Jenjang Pendidikan</div>
        <div class="about-jenjang-grid">
            <div class="about-jenjang-card"><span class="jic">🏫</span>SMP</div>
            <div class="about-jenjang-card"><span class="jic">🏛️</span>SMA</div>
            <div class="about-jenjang-card"><span class="jic">🔧</span>SMK</div>
            <div class="about-jenjang-card"><span class="jic">🎓</span>Kuliah</div>
            <div class="about-jenjang-card"><span class="jic">💼</span>Tidak Kuliah</div>
        </div>
    </div>

    {{-- TIM PENGEMBANG --}}
    <div class="about-section">
        <div class="about-section-title">Tim Pengembang</div>
        <div class="about-team-grid">

            {{-- KETUA TIM --}}
            <div class="about-card about-card-ketua">
                <div class="about-card-badge">Ketua Tim</div>
                <div class="about-avatar ketua">YN</div>
                <div class="about-name">Yuma Narendra</div>
                <div class="about-role">Fullstack Developer & Project Lead</div>
                <div class="about-info">
                    <div>📧 yuma@email.com</div>
                    <div>🎓 D3 Sistem Informasi</div>
                    <div>🏛️ Universitas Dinamika</div>
                </div>
                <div class="about-social">
                    <a href="https://github.com/r3famid" target="_blank" class="about-social-btn">GitHub</a>
                    <a href="#" class="about-social-btn">LinkedIn</a>
                </div>
            </div>

            {{-- ANGGOTA 1 --}}
            <div class="about-card">
                <div class="about-card-badge anggota">Anggota</div>
                <div class="about-avatar anggota1">NA</div>
                <div class="about-name">Nama Anggota 1</div>
                <div class="about-role">Frontend Developer</div>
                <div class="about-info">
                    <div>📧 email@email.com</div>
                    <div>🎓 D3 Sistem Informasi</div>
                    <div>🏛️ Universitas Dinamika</div>
                </div>
                <div class="about-social">
                    <a href="#" class="about-social-btn">GitHub</a>
                    <a href="#" class="about-social-btn">LinkedIn</a>
                </div>
            </div>

            {{-- ANGGOTA 2 --}}
            <div class="about-card">
                <div class="about-card-badge anggota">Anggota</div>
                <div class="about-avatar anggota2">NA</div>
                <div class="about-name">Nama Anggota 2</div>
                <div class="about-role">Backend Developer</div>
                <div class="about-info">
                    <div>📧 email@email.com</div>
                    <div>🎓 D3 Sistem Informasi</div>
                    <div>🏛️ Universitas Dinamika</div>
                </div>
                <div class="about-social">
                    <a href="#" class="about-social-btn">GitHub</a>
                    <a href="#" class="about-social-btn">LinkedIn</a>
                </div>
            </div>

        </div>
    </div>

    {{-- TEKNOLOGI --}}
    <div class="about-section">
        <div class="about-section-title">Teknologi yang Digunakan</div>
        <div class="about-tech-grid">
            <div class="about-tech-card">
                <div class="about-tech-icon">🅻</div>
                <div class="about-tech-name">Laravel 13</div>
                <div class="about-tech-desc">Framework PHP MVC</div>
            </div>
            <div class="about-tech-card">
                <div class="about-tech-icon">🐘</div>
                <div class="about-tech-name">PHP 8.4</div>
                <div class="about-tech-desc">Bahasa Pemrograman</div>
            </div>
            <div class="about-tech-card">
                <div class="about-tech-icon">🗄️</div>
                <div class="about-tech-name">MySQL</div>
                <div class="about-tech-desc">Basis Data</div>
            </div>
            <div class="about-tech-card">
                <div class="about-tech-icon">🤖</div>
                <div class="about-tech-name">Puter.js</div>
                <div class="about-tech-desc">API AI (GPT-4o)</div>
            </div>
            <div class="about-tech-card">
                <div class="about-tech-icon">🌐</div>
                <div class="about-tech-name">HTML/CSS/JS</div>
                <div class="about-tech-desc">Frontend</div>
            </div>
            <div class="about-tech-card">
                <div class="about-tech-icon">🔤</div>
                <div class="about-tech-name">Google Fonts</div>
                <div class="about-tech-desc">Typography</div>
            </div>
        </div>
    </div>

    {{-- VERSI --}}
    <div class="about-footer">
        <p>SmartScholar AI v1.0.0 — Tugas Akhir 2025</p>
        <p>Universitas Dinamika — Program Studi D3 Sistem Informasi</p>
    </div>
</div>
@endsection
