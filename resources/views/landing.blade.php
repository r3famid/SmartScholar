<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>SmartScholar AI — Platform Asisten Mahasiswa Berbasis AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Syne:wght@400;600;700;800;900&family=DM+Mono:wght@300;400;500&family=Crimson+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://js.puter.com/v2/"></script>
    <style>
        :root{--bg:#0b0f14;--sf:#111820;--crd:#171f2a;--crd2:#1c2736;--inp:#0e141c;--acc:#d4a843;--acc-s:#d4a84322;--acc-d:#b8922e;--c1:#4a9eff;--c1g:#4a9eff22;--c2:#34d399;--c2g:#34d39922;--c3:#f472b6;--c3g:#f472b622;--t1:#e8e2d6;--t2:#9ca3af;--t3:#5c6370;--bd:#1e2a38;--bd2:#263040;--r1:6px;--r2:12px;--r3:18px;--shadow-card:0 4px 20px rgba(0,0,0,.3)}
        *{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{font-family:'Montserrat',sans-serif;background:var(--bg);color:var(--t1);line-height:1.6;overflow-x:hidden}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");opacity:.02;pointer-events:none;z-index:0}
        ::selection{background:var(--acc);color:var(--bg)}
        a{color:var(--acc);text-decoration:none;transition:color .2s}
        a:hover{color:var(--acc-d)}

        /* ===== NAVBAR ===== */
        .lp-nav{position:fixed;top:0;left:0;right:0;z-index:100;padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;background:rgba(11,15,20,.85);backdrop-filter:blur(12px);border-bottom:1px solid var(--bd);transition:all .3s ease}
        .lp-nav-brand{display:flex;align-items:center;gap:10px}
        .lp-nav-logo{width:32px;height:32px;border-radius:var(--r1);object-fit:contain}
        .lp-nav-name{font-family:'Syne',sans-serif;font-weight:800;font-size:15px}
        .lp-nav-links{display:flex;align-items:center;gap:28px}
        .lp-nav-links a{font-size:12px;color:var(--t2);font-weight:500;transition:color .2s}
        .lp-nav-links a:hover{color:var(--acc)}
        .lp-nav-btns{display:flex;align-items:center;gap:10px}
        .btn-login{padding:8px 20px;border-radius:var(--r1);border:1px solid var(--bd);background:transparent;color:var(--t2);font-family:'Montserrat',sans-serif;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s}
        .btn-login:hover{border-color:var(--acc);color:var(--acc)}
        .btn-register{padding:8px 20px;border-radius:var(--r1);border:none;background:linear-gradient(135deg,var(--acc),var(--acc-d));color:var(--bg);font-family:'Montserrat',sans-serif;font-size:12px;font-weight:700;cursor:pointer;transition:all .2s}
        .btn-register:hover{box-shadow:0 4px 16px rgba(212,168,67,.3);transform:translateY(-1px)}

        /* Mobile Nav Toggle */
        .nav-toggle{display:none;background:none;border:none;color:var(--t2);font-size:22px;cursor:pointer;padding:4px}

        /* ===== HERO ===== */
        .lp-hero{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:100px 24px 60px;position:relative;overflow:hidden}
        .lp-hero::before{content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);width:800px;height:800px;background:radial-gradient(circle,var(--acc) 0%,transparent 60%);opacity:.06;pointer-events:none}
        .lp-hero-logo{width:100px;height:100px;border-radius:24px;object-fit:contain;border:3px solid var(--acc);box-shadow:0 12px 48px rgba(212,168,67,.3);margin-bottom:24px;animation:float 6s ease-in-out infinite}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        .lp-hero-title{font-family:'Syne',sans-serif;font-weight:900;font-size:52px;letter-spacing:-.04em;background:linear-gradient(135deg,var(--acc),#f0d78c,var(--acc));background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:shimmer 3s linear infinite;line-height:1.1;margin-bottom:12px}
        @keyframes shimmer{0%{background-position:0% center}100%{background-position:200% center}}
        .lp-hero-badge{display:inline-block;font-family:'DM Mono',monospace;font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:var(--acc);background:var(--acc-s);padding:5px 20px;border-radius:20px;border:1px solid var(--acc);margin-bottom:20px}
        .lp-hero-sub{font-size:18px;color:var(--t2);max-width:560px;margin:0 auto 12px;font-weight:500}
        .lp-hero-desc{font-size:13px;color:var(--t3);max-width:480px;margin:0 auto 36px;line-height:1.8}
        .lp-hero-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
        .btn-primary{padding:14px 36px;border-radius:var(--r2);border:none;background:linear-gradient(135deg,var(--acc),var(--acc-d));color:var(--bg);font-family:'Montserrat',sans-serif;font-size:14px;font-weight:700;cursor:pointer;transition:all .3s;letter-spacing:.02em}
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(212,168,67,.35)}
        .btn-outline{padding:14px 36px;border-radius:var(--r2);border:1px solid var(--bd);background:transparent;color:var(--t2);font-family:'Montserrat',sans-serif;font-size:14px;font-weight:600;cursor:pointer;transition:all .3s}
        .btn-outline:hover{border-color:var(--t1);color:var(--t1);transform:translateY(-2px)}
        .lp-scroll{margin-top:48px;color:var(--t3);font-size:11px;animation:bounce 2s infinite}
        @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(8px)}}

        /* ===== SECTIONS ===== */
        .lp-section{padding:80px 24px;max-width:1100px;margin:0 auto}
        .lp-section-title{font-family:'Syne',sans-serif;font-size:28px;font-weight:800;text-align:center;margin-bottom:10px;letter-spacing:-.02em}
        .lp-section-sub{text-align:center;font-size:13px;color:var(--t3);margin-bottom:48px;max-width:500px;margin-left:auto;margin-right:auto}
        .lp-section-label{display:flex;align-items:center;justify-content:center;gap:10px;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:var(--acc);margin-bottom:12px;font-weight:600}
        .lp-section-label::before,.lp-section-label::after{content:'';width:24px;height:1px;background:var(--acc)}

        /* ===== FEATURE CARDS ===== */
        .lp-feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
        .lp-feat-card{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r3);padding:32px 24px;text-align:center;transition:all .3s;position:relative;overflow:hidden}
        .lp-feat-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-card)}
        .lp-feat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px}
        .lp-feat-card.fc-c::before{background:var(--c1)}.lp-feat-card.fc-s::before{background:var(--c2)}.lp-feat-card.fc-l::before{background:var(--c3)}
        .lp-feat-icon{width:56px;height:56px;border-radius:var(--r2);display:flex;align-items:center;justify-content:center;font-size:26px;margin:0 auto 18px}
        .lp-feat-card.fc-c .lp-feat-icon{background:var(--c1g);color:var(--c1)}
        .lp-feat-card.fc-s .lp-feat-icon{background:var(--c2g);color:var(--c2)}
        .lp-feat-card.fc-l .lp-feat-icon{background:var(--c3g);color:var(--c3)}
        .lp-feat-name{font-size:16px;font-weight:700;margin-bottom:8px;font-family:'Syne',sans-serif}
        .lp-feat-desc{font-size:12px;color:var(--t3);line-height:1.7}
        .lp-feat-status{display:inline-flex;align-items:center;gap:5px;font-size:9px;padding:3px 12px;border-radius:16px;margin-top:16px;background:#22c55e22;color:#4ade80;font-weight:600}
        .lp-feat-status .dot{width:5px;height:5px;border-radius:50%;background:#4ade80;animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}

        /* ===== JENJANG ===== */
        .lp-jenjang-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
        .lp-jenjang-card{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r2);padding:24px 16px;text-align:center;transition:all .25s}
        .lp-jenjang-card:hover{border-color:var(--acc);background:var(--acc-s);transform:translateY(-2px)}
        .lp-jenjang-icon{font-size:32px;margin-bottom:10px;display:block}
        .lp-jenjang-name{font-size:13px;font-weight:700}
        .lp-jenjang-desc{font-size:10px;color:var(--t3);margin-top:4px}

        /* ===== KEUNGGULAN ===== */
        .lp-why-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}
        .lp-why-card{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r3);padding:28px;display:flex;gap:18px;transition:all .3s}
        .lp-why-card:hover{transform:translateY(-2px);box-shadow:var(--shadow-card)}
        .lp-why-icon{width:48px;height:48px;border-radius:var(--r2);background:var(--acc-s);color:var(--acc);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
        .lp-why-name{font-size:14px;font-weight:700;margin-bottom:4px;font-family:'Syne',sans-serif}
        .lp-why-desc{font-size:12px;color:var(--t3);line-height:1.7}

        /* ===== STATISTIK ===== */
        .lp-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
        .lp-stat-card{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r2);padding:28px 16px;text-align:center}
        .lp-stat-num{font-family:'Syne',sans-serif;font-size:36px;font-weight:900;color:var(--acc);line-height:1}
        .lp-stat-label{font-size:11px;color:var(--t3);margin-top:8px;font-weight:500}

        /* ===== CTA ===== */
        .lp-cta{text-align:center;padding:80px 24px;background:var(--crd);border-top:1px solid var(--bd);border-bottom:1px solid var(--bd);position:relative;overflow:hidden}
        .lp-cta::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,transparent,var(--acc),transparent)}
        .lp-cta-title{font-family:'Crimson Pro',serif;font-size:28px;font-weight:300;margin-bottom:8px}
        .lp-cta-title b{font-weight:600;color:var(--acc)}
        .lp-cta-sub{font-size:13px;color:var(--t3);margin-bottom:28px}

        /* ===== FOOTER ===== */
        .lp-footer{padding:48px 24px 32px;max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:40px;border-top:1px solid var(--bd)}
        .lp-foot-brand{display:flex;align-items:center;gap:10px;margin-bottom:14px}
        .lp-foot-brand img{width:36px;height:36px;border-radius:var(--r1)}
        .lp-foot-brand span{font-family:'Syne',sans-serif;font-weight:800;font-size:15px}
        .lp-foot-desc{font-size:11px;color:var(--t3);line-height:1.8}
        .lp-foot-title{font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:var(--t3);margin-bottom:16px;font-weight:700}
        .lp-foot-links{display:flex;flex-direction:column;gap:10px}
        .lp-foot-links a{font-size:12px;color:var(--t2);transition:color .2s}
        .lp-foot-links a:hover{color:var(--acc)}
        .lp-foot-bottom{text-align:center;padding:24px;font-size:10px;color:var(--t3);border-top:1px solid var(--bd);margin-top:32px;letter-spacing:.03em}

        /* ===== ANIMATIONS ===== */
        .fade-up{opacity:0;transform:translateY(30px);transition:all .6s cubic-bezier(.22,1,.36,1)}
        .fade-up.visible{opacity:1;transform:translateY(0)}

        /* ===== RESPONSIVE ===== */
        @media(max-width:768px){
            .lp-nav{padding:0 20px}
            .lp-nav-links{display:none}
            .nav-toggle{display:block}
            .lp-hero{padding:90px 20px 50px}
            .lp-hero-title{font-size:32px}
            .lp-hero-sub{font-size:15px}
            .lp-feat-grid{grid-template-columns:1fr}
            .lp-jenjang-grid{grid-template-columns:repeat(3,1fr)}
            .lp-why-grid{grid-template-columns:1fr}
            .lp-stats{grid-template-columns:repeat(2,1fr)}
            .lp-footer{grid-template-columns:1fr;gap:28px}
            .lp-hero-btns{flex-direction:column;align-items:center}
            .btn-primary,.btn-outline{width:100%;max-width:300px}
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="lp-nav" id="lpNav">
        <div class="lp-nav-brand">
            <img src="{{ asset('favicon.png') }}" alt="SmartScholar" class="lp-nav-logo">
            <span class="lp-nav-name">SmartScholar</span>
        </div>
        <div class="lp-nav-links">
            <a href="#fitur">Fitur</a>
            <a href="#jenjang">Jenjang</a>
            <a href="#keunggulan">Keunggulan</a>
            <a href="{{ route('about') }}">Tim</a>
        </div>
        <div class="lp-nav-btns">
            <button class="btn-login" onclick="window.location='{{ route('login') }}'">Masuk</button>
            <button class="btn-register" onclick="window.location='{{ route('register') }}'">Daftar Gratis</button>
        </div>
        <button class="nav-toggle" onclick="document.querySelector('.lp-nav-links').classList.toggle('mobile-open')">☰</button>
    </nav>

    {{-- HERO --}}
    <section class="lp-hero">
        <img src="{{ asset('favicon.png') }}" alt="SmartScholar AI" class="lp-hero-logo">
        <h1 class="lp-hero-title">SmartScholar</h1>
        <div class="lp-hero-badge">Artificial Intelligence</div>
        <p class="lp-hero-sub">Platform Asisten Mahasiswa Berbasis Kecerdasan Buatan</p>
        <p class="lp-hero-desc">Dapatkan rekomendasi karier, informasi beasiswa, dan referensi literatur akademik secara personal dan gratis menggunakan teknologi GPT-4o.</p>
        <div class="lp-hero-btns">
            <button class="btn-primary" onclick="window.location='{{ route('register') }}'">Daftar Sekarang — Gratis →</button>
            <button class="btn-outline" onclick="window.location='{{ route('login') }}'">Masuk</button>
        </div>
        <div class="lp-scroll">↓ Scroll untuk jelajahi</div>
    </section>

    {{-- FITUR --}}
    <section class="lp-section fade-up" id="fitur">
        <div class="lp-section-label">Fitur Utama</div>
        <h2 class="lp-section-title">Tiga Modul AI dalam Satu Platform</h2>
        <p class="lp-section-sub">Akses konsultasi karier, beasiswa, dan literatur secara gratis dan tanpa batas.</p>
        <div class="lp-feat-grid">
            <div class="lp-feat-card fc-c">
                <div class="lp-feat-icon">💼</div>
                <div class="lp-feat-name">Career Assistant AI</div>
                <div class="lp-feat-desc">Konsultasi karier personal, analisis skill, roadmap belajar, dan simulasi wawancara berdasarkan profilmu.</div>
                <div class="lp-feat-status"><div class="dot"></div>AI Aktif</div>
            </div>
            <div class="lp-feat-card fc-s">
                <div class="lp-feat-icon">🎓</div>
                <div class="lp-feat-name">Scholarship Assistant AI</div>
                <div class="lp-feat-desc">Cari beasiswa sesuai IPK dan jurusanmu, bantuan tulis motivation letter, dan tips seleksi wawancara.</div>
                <div class="lp-feat-status"><div class="dot"></div>AI Aktif</div>
            </div>
            <div class="lp-feat-card fc-l">
                <div class="lp-feat-icon">📚</div>
                <div class="lp-feat-name">Smart Library AI</div>
                <div class="lp-feat-desc">Rekomendasi buku berdasarkan jurusan, ringkasan otomatis, dan referensi literatur untuk skripsi.</div>
                <div class="lp-feat-status"><div class="dot"></div>AI Aktif</div>
            </div>
        </div>
    </section>

    {{-- JENJANG --}}
    <section class="lp-section fade-up" id="jenjang">
        <div class="lp-section-label">Multi Jenjang</div>
        <h2 class="lp-section-title">Mendukung 5 Jenjang Pendidikan</h2>
        <p class="lp-section-sub">Form profil yang menyesuaikan secara dinamis berdasarkan jenjang pendidikanmu.</p>
        <div class="lp-jenjang-grid">
            <div class="lp-jenjang-card"><span class="lp-jenjang-icon">🏫</span><div class="lp-jenjang-name">SMP</div><div class="lp-jenjang-desc">Eksplorasi minat bakat</div></div>
            <div class="lp-jenjang-card"><span class="lp-jenjang-icon">🏛️</span><div class="lp-jenjang-name">SMA</div><div class="lp-jenjang-desc">Jurusan & karier masa depan</div></div>
            <div class="lp-jenjang-card"><span class="lp-jenjang-icon">🔧</span><div class="lp-jenjang-name">SMK</div><div class="lp-jenjang-desc">Skill teknis & dunia kerja</div></div>
            <div class="lp-jenjang-card"><span class="lp-jenjang-icon">🎓</span><div class="lp-jenjang-name">Kuliah</div><div class="lp-jenjang-desc">Karier & sertifikasi</div></div>
            <div class="lp-jenjang-card"><span class="lp-jenjang-icon">💼</span><div class="lp-jenjang-name">Tidak Kuliah</div><div class="lp-jenjang-desc">Skill praktis & wirausaha</div></div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="lp-section fade-up" id="keunggulan">
        <div class="lp-section-label">Mengapa Kami</div>
        <h2 class="lp-section-title">Mengapa SmartScholar AI?</h2>
        <p class="lp-section-sub">Empat alasan mengapa platform ini layak kamu coba.</p>
        <div class="lp-why-grid">
            <div class="lp-why-card">
                <div class="lp-why-icon">🤖</div>
                <div><div class="lp-why-name">AI Powered by GPT-4o</div><div class="lp-why-desc">Teknologi AI terbaru yang mampu memahami konteks percakapan dan memberikan respons yang personal berdasarkan profilmu.</div></div>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon">💰</div>
                <div><div class="lp-why-name">100% Gratis</div><div class="lp-why-desc">Tanpa biaya langganan, tanpa batasan jumlah chat, dan tanpa perlu API key. Semua fitur bisa diakses secara cuma-cuma.</div></div>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon">🎯</div>
                <div><div class="lp-why-name">Personal & Kontekstual</div><div class="lp-why-desc">Rekomendasi disesuaikan dengan jenjang, jurusan, keahlian, pengalaman kerja, dan pengalaman organisasimu.</div></div>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon">🔒</div>
                <div><div class="lp-why-name">Aman & Terpercaya</div><div class="lp-why-desc">Data profilmu tersimpan dengan aman menggunakan enkripsi bcrypt. Password tidak pernah disimpan secara langsung.</div></div>
            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="lp-section fade-up">
        <div class="lp-stats">
            <div class="lp-stat-card"><div class="lp-stat-num">3</div><div class="lp-stat-label">Modul AI</div></div>
            <div class="lp-stat-card"><div class="lp-stat-num">5</div><div class="lp-stat-label">Jenjang Pendidikan</div></div>
            <div class="lp-stat-card"><div class="lp-stat-num">100%</div><div class="lp-stat-label">Gratis</div></div>
            <div class="lp-stat-card"><div class="lp-stat-num">24/7</div><div class="lp-stat-label">Online</div></div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="lp-cta fade-up">
        <div class="lp-section-label">Mulai Sekarang</div>
        <p class="lp-cta-title">"Mulai perjalanan akademik <b>dan kariermu</b> sekarang"</p>
        <p class="lp-cta-sub">Daftar gratis dan nikmati semua fitur AI tanpa batas.</p>
        <button class="btn-primary" onclick="window.location='{{ route('register') }}'">Daftar Sekarang — Gratis →</button>
    </section>

    {{-- FOOTER --}}
    <footer class="lp-footer">
        <div>
            <div class="lp-foot-brand">
                <img src="{{ asset('favicon.png') }}" alt="SmartScholar">
                <span>SmartScholar AI</span>
            </div>
            <p class="lp-foot-desc">Platform Asisten Mahasiswa Berbasis Kecerdasan Buatan. Dikembangkan menggunakan Laravel 13, PHP 8.4, MySQL, dan Puter.js API (GPT-4o).</p>
        </div>
        <div>
            <div class="lp-foot-title">Navigasi</div>
            <div class="lp-foot-links">
                <a href="#fitur">Fitur</a>
                <a href="#jenjang">Jenjang</a>
                <a href="#keunggulan">Keunggulan</a>
                <a href="{{ route('about') }}">Tentang Tim</a>
            </div>
        </div>
        <div>
            <div class="lp-foot-title">Akun</div>
            <div class="lp-foot-links">
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar Gratis</a>
                <a href="{{ route('password.request') }}">Lupa Password</a>
            </div>
        </div>
    </footer>
    <div class="lp-foot-bottom">© 2025 SmartScholar AI — Tugas Akhir · Universitas Dinamika · Dikembangkan oleh <a href="{{ route('about') }}">Tim SmartScholar</a></div>

    <script>
        // Scroll animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('lpNav');
            if (window.scrollY > 50) {
                nav.style.background = 'rgba(11,15,20,.95)';
                nav.style.boxShadow = '0 2px 20px rgba(0,0,0,.3)';
            } else {
                nav.style.background = 'rgba(11,15,20,.85)';
                nav.style.boxShadow = 'none';
            }
        });
    </script>

    <style>
        .lp-nav-links.mobile-open{display:flex!important;position:absolute;top:64px;left:0;right:0;background:var(--sf);border-bottom:1px solid var(--bd);flex-direction:column;padding:16px 24px;gap:14px}
    </style>
</body>
</html>
