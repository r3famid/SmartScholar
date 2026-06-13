<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Daftar — SmartScholar AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0b0f14;--sf:#111820;--inp:#0e141c;--acc:#d4a843;--acc-s:#d4a84322;--acc-d:#b8922e;--t1:#e8e2d6;--t2:#9ca3af;--t3:#5c6370;--bd:#1e2a38;--r1:6px;--r2:12px;--r3:18px}
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Montserrat',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;line-height:1.6;position:relative}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");opacity:.02;pointer-events:none;z-index:0}
        .glow{position:fixed;width:500px;height:500px;border-radius:50%;filter:blur(120px);opacity:.12;pointer-events:none;z-index:0}
        .glow-1{top:-150px;right:-100px;background:var(--acc)}
        .glow-2{bottom:-200px;left:-100px;background:#4a9eff}
        ::selection{background:var(--acc);color:var(--bg)}
        a{color:var(--acc);text-decoration:none}
        .wrap{width:100%;max-width:440px;position:relative;z-index:1;animation:fi .6s cubic-bezier(.22,1,.36,1)}
        @keyframes fi{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        .brand{text-align:center;margin-bottom:32px}
        .brand-logo{display:inline-block;margin-bottom:14px;position:relative}
        .brand-logo img{width:64px;height:64px;border-radius:16px;object-fit:contain;box-shadow:0 8px 32px rgba(212,168,67,.25);border:2px solid var(--acc)}
        .brand-logo::after{content:'';position:absolute;inset:-5px;border-radius:20px;border:1px solid var(--acc);opacity:.2}
        .brand-name{font-family:'Syne',sans-serif;font-weight:900;font-size:28px;letter-spacing:-.03em;background:linear-gradient(135deg,var(--acc),#f0d78c,var(--acc));background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:shimmer 3s linear infinite}
        @keyframes shimmer{0%{background-position:0% center}100%{background-position:200% center}}
        .brand-ai{display:inline-block;font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:var(--acc);background:var(--acc-s);padding:3px 12px;border-radius:20px;margin-top:6px;border:1px solid var(--acc)}
        .brand-sub{font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:var(--t3);margin-top:10px;font-weight:500}
        .card{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r3);padding:36px;position:relative;overflow:hidden}
        .card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--acc),transparent)}
        .card h1{font-family:'Syne',sans-serif;font-size:22px;font-weight:700;text-align:center;margin-bottom:4px}
        .card .sub{font-size:12px;color:var(--t3);text-align:center;margin-bottom:28px}
        .err{background:#ef444411;border:1px solid #ef444444;border-radius:var(--r2);padding:12px 16px;margin-bottom:18px;font-size:12px;color:#f87171;line-height:1.7}
        .fr{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .fg{margin-bottom:16px}
        .fg label{display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--t3);margin-bottom:8px;font-weight:600}
        .fg input{width:100%;padding:12px 16px;background:var(--inp);border:1px solid var(--bd);border-radius:var(--r1);color:var(--t1);font-family:'Montserrat',sans-serif;font-size:13px;outline:none;transition:all .25s ease}
        .fg input::placeholder{color:var(--t3)}
        .fg input:focus{border-color:var(--acc);box-shadow:0 0 0 4px var(--acc-s)}
        .btn{width:100%;padding:14px;background:linear-gradient(135deg,var(--acc),var(--acc-d));color:var(--bg);border:none;border-radius:var(--r1);font-family:'Montserrat',sans-serif;font-size:14px;font-weight:700;cursor:pointer;transition:all .25s ease;letter-spacing:.03em;margin-top:4px}
        .btn:hover{transform:translateY(-1px);box-shadow:0 6px 24px rgba(212,168,67,.3)}
        .divider{display:flex;align-items:center;gap:12px;margin:24px 0}
        .divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--bd)}
        .divider span{font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:var(--t3);font-weight:600}
        .foot{text-align:center;margin-top:20px;font-size:12px;color:var(--t3);font-weight:500}
        .footer{text-align:center;margin-top:24px;font-size:9px;color:var(--t3);letter-spacing:.05em}
        .footer .accent{color:var(--acc)}
        @media(max-width:480px){.card{padding:28px 20px}.fr{grid-template-columns:1fr}.brand-name{font-size:24px}}
    </style>
</head>
<body>
<div class="glow glow-1"></div>
<div class="glow glow-2"></div>

<div class="wrap">
    <div class="brand">
        <div class="brand-logo">
            <img src="{{ asset('favicon.png') }}" alt="SmartScholar AI">
        </div>
        <div class="brand-name">SmartScholar</div>
        <div class="brand-ai">Artificial Intelligence</div>
        <div class="brand-sub">Platform Asisten Mahasiswa Berbasis AI</div>
    </div>

    <div class="card">
        <h1>Buat Akun Baru</h1>
        <p class="sub">Daftar untuk mengakses semua fitur AI.</p>

        @if($errors->any())
            <div class="err">
                @foreach($errors->all() as $e)
                    <div>- {{ $e }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="fg">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ahmad Rizky" required autofocus>
            </div>
            <div class="fg">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            <div class="fr">
                <div class="fg">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min. 6 karakter" required>
                </div>
                <div class="fg">
                    <label>Konfirmasi</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>
            <button type="submit" class="btn">Daftar →</button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="foot">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </div>

    <div class="footer">
        Powered by <span class="accent">Puter.js AI Engine</span> — Free & Unlimited
    </div>
</div>
</body>
</html>
