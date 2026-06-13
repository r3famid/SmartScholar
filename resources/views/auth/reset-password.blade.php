<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Reset Password — SmartScholar AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0b0f14;--sf:#111820;--inp:#0e141c;--acc:#d4a843;--acc-s:#d4a84322;--acc-d:#b8922e;--t1:#e8e2d6;--t2:#9ca3af;--t3:#5c6370;--bd:#1e2a38;--r1:6px;--r2:12px;--r3:18px}
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Montserrat',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh;display:flex;align-items:center;justify-content:center;line-height:1.6;position:relative}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");opacity:.02;pointer-events:none;z-index:0}
        .glow{position:fixed;width:500px;height:500px;border-radius:50%;filter:blur(120px);opacity:.12;pointer-events:none;z-index:0}
        .glow-1{top:-150px;right:-100px;background:#4a9eff}
        ::selection{background:var(--acc);color:var(--bg)}
        a{color:var(--acc);text-decoration:none}
        .wrap{width:100%;max-width:420px;padding:24px;position:relative;z-index:1;animation:fi .6s ease}
        @keyframes fi{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        .brand{text-align:center;margin-bottom:32px}
        .brand-logo img{width:64px;height:64px;border-radius:16px;object-fit:contain;box-shadow:0 8px 32px rgba(212,168,67,.25);border:2px solid var(--acc);margin-bottom:14px}
        .brand-name{font-family:'Syne',sans-serif;font-weight:900;font-size:28px;background:linear-gradient(135deg,var(--acc),#f0d78c,var(--acc));background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:shimmer 3s linear infinite}
        @keyframes shimmer{0%{background-position:0% center}100%{background-position:200% center}}
        .card{background:var(--sf);border:1px solid var(--bd);border-radius:var(--r3);padding:36px;position:relative;overflow:hidden}
        .card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--acc),transparent)}
        .card h1{font-family:'Syne',sans-serif;font-size:22px;font-weight:700;text-align:center;margin-bottom:4px}
        .card .sub{font-size:12px;color:var(--t3);text-align:center;margin-bottom:28px}
        .err{background:#ef444411;border:1px solid #ef444444;border-radius:var(--r2);padding:12px 16px;margin-bottom:18px;font-size:12px;color:#f87171}
        .fg{margin-bottom:18px}
        .fg label{display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--t3);margin-bottom:8px;font-weight:600}
        .fg input{width:100%;padding:12px 16px;background:var(--inp);border:1px solid var(--bd);border-radius:var(--r1);color:var(--t1);font-family:'Montserrat',sans-serif;font-size:13px;outline:none;transition:all .25s ease}
        .fg input:focus{border-color:var(--acc);box-shadow:0 0 0 4px var(--acc-s)}
        .btn{width:100%;padding:14px;background:linear-gradient(135deg,var(--acc),var(--acc-d));color:var(--bg);border:none;border-radius:var(--r1);font-family:'Montserrat',sans-serif;font-size:14px;font-weight:700;cursor:pointer;transition:all .25s ease}
        .btn:hover{transform:translateY(-1px);box-shadow:0 6px 24px rgba(212,168,67,.3)}
        .foot{text-align:center;margin-top:24px;font-size:12px;color:var(--t3);font-weight:500}
    </style>
</head>
<body>
<div class="glow glow-1"></div>
<div class="wrap">
    <div class="brand">
        <div class="brand-logo"><img src="{{ asset('favicon.png') }}" alt="SmartScholar AI"></div>
        <div class="brand-name">SmartScholar</div>
    </div>
    <div class="card">
        <h1>Atur Password Baru</h1>
        <p class="sub">Password baru untuk <strong>{{ $email }}</strong></p>
        @if($errors->any())
            <div class="err">
                @foreach($errors->all() as $e)
                    <div>- {{ $e }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="fg">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Min. 6 karakter" required autofocus>
            </div>
            <div class="fg">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn">Simpan Password Baru</button>
        </form>
        <div class="foot"><a href="{{ route('login') }}">Kembali ke Login</a></div>
    </div>
</div>
</body>
</html>
