<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>SmartScholar AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('logosmartscholar.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&family=Crimson+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://js.puter.com/v2/"></script>
    <style>
        /* ===== DARK MODE (DEFAULT) ===== */
        :root{
            --bg:#0b0f14;--sf:#111820;--crd:#171f2a;--crd2:#1c2736;--inp:#0e141c;
            --acc:#d4a843;--acc-s:#d4a84322;--acc-d:#b8922e;
            --c1:#4a9eff;--c1g:#4a9eff22;--c2:#34d399;--c2g:#34d39922;--c3:#f472b6;--c3g:#f472b622;
            --t1:#e8e2d6;--t2:#9ca3af;--t3:#5c6370;
            --bd:#1e2a38;--bd2:#263040;
            --r1:6px;--r2:12px;--r3:18px;
            --grain-opacity:.02;
            --shadow-card:0 4px 20px rgba(0,0,0,.3);
        }

        /* ===== LIGHT MODE ===== */
        .light{
            --bg:#f4f1eb;--sf:#ffffff;--crd:#f9f7f3;--crd2:#eae6de;--inp:#ffffff;
            --acc:#b8922e;--acc-s:#b8922e18;--acc-d:#9a7a24;
            --c1:#2563eb;--c1g:#2563eb15;--c2:#059669;--c2g:#05966915;--c3:#db2777;--c3g:#db277715;
            --t1:#1a1a2e;--t2:#4a5568;--t3:#8896a6;
            --bd:#e2ddd4;--bd2:#d4cfc6;
            --grain-opacity:.015;
            --shadow-card:0 4px 20px rgba(0,0,0,.08);
        }

        *{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{font-family:'DM Mono',monospace;background:var(--bg);color:var(--t1);min-height:100vh;line-height:1.6;transition:background .3s ease,color .3s ease}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");opacity:var(--grain-opacity);pointer-events:none;z-index:9999}
        h1,h2,h3,h4{font-family:'Syne',sans-serif;font-weight:700;letter-spacing:-.02em}
        ::selection{background:var(--acc);color:var(--bg)}
        ::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:var(--bg)}::-webkit-scrollbar-thumb{background:var(--bd2);border-radius:3px}
        a{color:var(--acc);text-decoration:none}

        .app{display:flex;min-height:100vh;position:relative;z-index:1}

        /* ===== SIDEBAR ===== */
        .sidebar{width:272px;min-height:100vh;background:var(--sf);border-right:1px solid var(--bd);padding:28px 16px;display:flex;flex-direction:column;position:fixed;top:0;left:0;z-index:100;transition:transform .35s cubic-bezier(.22,1,.36,1),background .3s ease}
        .sb-brand{display:flex;align-items:center;gap:12px;margin-bottom:36px;padding-bottom:20px;border-bottom:1px solid var(--bd)}
        .sb-icon{width:40px;height:40px;background:linear-gradient(135deg,var(--acc),var(--acc-d));border-radius:var(--r1);display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:16px;color:#fff}
        .sb-name{font-family:'Syne',sans-serif;font-weight:700;font-size:15px}.sb-sub{font-size:9px;color:var(--t3);letter-spacing:.08em;text-transform:uppercase;margin-top:2px}
        .sb-nav{flex:1}.nav-lbl{font-size:8px;letter-spacing:.14em;text-transform:uppercase;color:var(--t3);margin:18px 0 10px 12px}
        .ni{display:flex;align-items:center;gap:11px;padding:11px 12px;border-radius:var(--r2);cursor:pointer;transition:all .2s;margin-bottom:3px;font-size:12px;color:var(--t2);user-select:none;position:relative;text-decoration:none}
        .ni:hover{background:var(--crd);color:var(--t1)}.ni.active{background:var(--crd);color:var(--t1)}
        .ni.active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:55%;background:var(--acc);border-radius:0 2px 2px 0}
        .ni-ic{width:32px;height:32px;border-radius:var(--r1);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
        .nic-d{background:var(--acc-s);color:var(--acc)}.nic-c{background:var(--c1g);color:var(--c1)}.nic-s{background:var(--c2g);color:var(--c2)}.nic-l{background:var(--c3g);color:var(--c3)}.nic-p{background:#f9731622;color:#fb923c}

        .sb-foot{padding-top:16px;border-top:1px solid var(--bd)}
        .uc{display:flex;align-items:center;gap:10px;padding:8px;border-radius:var(--r2)}
        .uc-av{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;color:#fff;font-family:'Syne',sans-serif}
        .uc-n{font-size:12px;font-weight:500}.uc-r{font-size:9px;color:var(--t3);margin-top:1px}
        .uc-info{flex:1;min-width:0}
        .logout-btn{display:flex;align-items:center;gap:8px;padding:9px 12px;border-radius:var(--r2);border:1px solid #ef444433;background:#ef444408;color:#f87171;font-size:11px;cursor:pointer;transition:all .2s;font-family:'DM Mono',monospace;width:100%;margin-top:10px}
        .logout-btn:hover{background:#ef444415;border-color:#ef444455}

        /* ===== THEME TOGGLE ===== */
        .theme-toggle{display:flex;align-items:center;gap:8px;padding:9px 12px;border-radius:var(--r2);border:1px solid var(--bd);background:var(--crd);color:var(--t2);font-size:11px;cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif;width:100%;margin-top:10px;position:relative;overflow:hidden}
        .theme-toggle:hover{border-color:var(--acc);color:var(--t1)}
        .theme-toggle .tg-icon{font-size:16px;transition:transform .3s ease}
        .theme-toggle .tg-label{flex:1;font-weight:500}
        .theme-toggle .tg-track{width:36px;height:20px;background:var(--bd);border-radius:10px;position:relative;transition:background .3s ease;flex-shrink:0}
        .theme-toggle .tg-dot{width:16px;height:16px;background:var(--t3);border-radius:50%;position:absolute;top:2px;left:2px;transition:all .3s ease}
        .light .theme-toggle .tg-track{background:var(--acc)}
        .light .theme-toggle .tg-dot{left:18px;background:#fff}

        /* ===== MAIN ===== */
        .main{flex:1;margin-left:272px;display:flex;flex-direction:column;min-height:100vh}
        .topbar{height:56px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--bd);background:var(--sf);position:sticky;top:0;z-index:50;transition:background .3s ease}
        .tb-l{display:flex;align-items:center;gap:14px}
        .hb{display:none;background:none;border:none;color:var(--t2);font-size:20px;cursor:pointer;padding:6px}
        .tb-t{font-family:'Syne',sans-serif;font-size:16px;font-weight:700}
        .tb-b{font-size:9px;padding:3px 10px;background:var(--c2g);color:var(--c2);border-radius:20px;letter-spacing:.05em}
        .tb-r{display:flex;align-items:center;gap:10px}
        .tb-user{display:flex;align-items:center;gap:8px;padding:5px 12px;border-radius:var(--r1);background:var(--crd);border:1px solid var(--bd)}
        .tb-av{width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:600;color:#fff;font-family:'Syne',sans-serif}
        .tb-un{font-size:11px;color:var(--t2)}

        /* Topbar Theme Button */
        .tb-theme{width:34px;height:34px;border-radius:var(--r1);background:var(--crd);border:1px solid var(--bd);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:16px;transition:all .2s}
        .tb-theme:hover{border-color:var(--acc);background:var(--acc-s)}

        .content{flex:1;padding:28px}
        .fade-in{animation:fi .5s ease}
        @keyframes fi{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
        .ov{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:99}.ov.on{display:block}

        /* ===== CHAT ===== */
        .ch-wrap{display:flex;flex-direction:column;height:calc(100vh - 56px - 56px);max-height:calc(100vh - 112px)}
        .ch-hd{display:flex;align-items:center;gap:12px;padding-bottom:16px;border-bottom:1px solid var(--bd);margin-bottom:16px}
        .ch-hd-ic{width:40px;height:40px;border-radius:var(--r2);display:flex;align-items:center;justify-content:center;font-size:18px}
        .ch-hd-t{font-size:18px}.ch-hd-d{font-size:10px;color:var(--t3)}
        .ch-hd-s{display:flex;align-items:center;gap:5px;font-size:10px;color:var(--c2);margin-left:auto}
        .sd{width:6px;height:6px;border-radius:50%;background:var(--c2);animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
        .ch-msgs{flex:1;overflow-y:auto;padding-right:6px;display:flex;flex-direction:column;gap:14px}
        .msg{display:flex;gap:10px;max-width:80%;animation:mi .3s ease}
        @keyframes mi{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
        .msg.u{align-self:flex-end;flex-direction:row-reverse}
        .msg-av{width:30px;height:30px;border-radius:var(--r1);display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
        .msg.ai .msg-av{background:var(--acc-s);color:var(--acc)}
        .msg.u .msg-av{background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;font-size:11px;font-weight:600}
        .msg-bb{padding:12px 16px;border-radius:var(--r2);font-size:12px;line-height:1.8;white-space:pre-wrap;font-family:'Montserrat',sans-serif;transition:background .3s ease}
        .msg.ai .msg-bb{background:var(--crd);border:1px solid var(--bd);color:var(--t2)}
        .msg.u .msg-bb{background:var(--acc);color:#fff}
        .msg-bb h4{font-family:'Montserrat',sans-serif;font-size:13px;font-weight:600;margin:10px 0 4px;color:var(--t1)}
        .msg-bb ul{margin:6px 0;padding-left:18px}.msg-bb li{margin:3px 0;font-size:11px}
        .msg-bb strong{color:var(--t1)}.msg.u .msg-bb strong{color:#fff}
        .qk{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:12px}
        .qk-b{font-size:10px;padding:7px 12px;border-radius:16px;border:1px solid var(--bd);background:var(--crd);color:var(--t2);cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif}
        .qk-b:hover{border-color:var(--acc);color:var(--acc);background:var(--acc-s)}
        .ch-in{padding-top:12px;border-top:1px solid var(--bd)}
        .in-w{display:flex;align-items:center;gap:8px;background:var(--inp);border:1px solid var(--bd);border-radius:var(--r2);padding:4px;transition:border-color .2s}
        .in-w:focus-within{border-color:var(--acc);box-shadow:0 0 0 3px var(--acc-s)}
        .ch-inp{flex:1;background:transparent;border:none;outline:none;color:var(--t1);font-family:'Montserrat',sans-serif;font-size:12px;padding:10px 12px;resize:none}
        .ch-inp::placeholder{color:var(--t3)}
        .snd{width:38px;height:38px;border-radius:var(--r1);border:none;background:var(--acc);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;font-size:15px;flex-shrink:0}
        .snd:hover{background:var(--acc-d);transform:scale(1.05)}
        .snd:disabled{opacity:.4;cursor:not-allowed;transform:none}
        .typ{display:flex;gap:3px;padding:6px 0}
        .typ span{width:5px;height:5px;border-radius:50%;background:var(--t3);animation:ty 1.4s infinite}
        .typ span:nth-child(2){animation-delay:.2s}.typ span:nth-child(3){animation-delay:.4s}
        @keyframes ty{0%,60%,100%{transform:translateY(0);opacity:.3}30%{transform:translateY(-5px);opacity:1}}

        /* ===== DASHBOARD ===== */
        .dg{margin-bottom:32px}.dg-t{font-family:'Crimson Pro',serif;font-size:30px;font-weight:300;line-height:1.3}.dg-t b{font-weight:600;color:var(--acc)}.dg-s{font-size:12px;color:var(--t3);margin-top:6px}
        .stg{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px}
        .stc{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r2);padding:18px;transition:all .25s;position:relative;overflow:hidden;text-decoration:none;color:var(--t1);display:block}
        .stc:hover{transform:translateY(-2px);box-shadow:var(--shadow-card)}
        .stc::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
        .stc.c::before{background:var(--c1)}.stc.s::before{background:var(--c2)}.stc.l::before{background:var(--c3)}
        .st-ic{width:44px;height:44px;border-radius:var(--r2);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px}
        .stc.c .st-ic{background:var(--c1g);color:var(--c1)}.stc.s .st-ic{background:var(--c2g);color:var(--c2)}.stc.l .st-ic{background:var(--c3g);color:var(--c3)}
        .st-t{font-size:16px;font-weight:700;margin-bottom:4px;font-family:'Syne',sans-serif}
        .st-d{font-size:11px;color:var(--t3);line-height:1.6}
        .st-st{display:inline-flex;align-items:center;gap:5px;font-size:9px;padding:3px 10px;border-radius:16px;margin-top:12px;background:#22c55e22;color:#4ade80}
        .st-st .dot{width:5px;height:5px;border-radius:50%;background:#4ade80;animation:pulse 2s infinite}
        .nb{border-radius:var(--r2);padding:14px 18px;margin-bottom:20px;display:flex;gap:10px;font-size:11px;line-height:1.7;transition:background .3s ease}
        .nb.info{background:var(--acc-s);border:1px solid var(--acc);color:var(--t1)}.nb b{color:var(--acc)}
        .nb.ok{background:#22c55e11;border:1px solid #22c55e44}.nb.ok b{color:#4ade80}

        /* ===== PROFILE ===== */
        .pf{background:var(--crd);border:1px solid var(--bd);border-radius:var(--r3);padding:28px;max-width:640px;transition:background .3s ease}
        .pf-h{display:flex;align-items:center;gap:18px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid var(--bd)}
        .pf-av{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;color:#fff;font-family:'Syne',sans-serif}
        .pf-n{font-size:20px;font-weight:700}.pf-d{font-size:11px;color:var(--t3);margin-top:3px}
        .fg{margin-bottom:14px}.fg label{display:block;font-size:9px;letter-spacing:.1em;text-transform:uppercase;color:var(--t3);margin-bottom:5px}
        .fg input,.fg select,.fg textarea,.fg .ta{width:100%;padding:9px 12px;background:var(--inp);border:1px solid var(--bd);border-radius:var(--r1);color:var(--t1);font-family:'Montserrat',sans-serif;font-size:12px;outline:none;transition:border-color .2s,background .3s ease}
        .fg input:focus,.fg select:focus,.fg textarea:focus,.fg .ta:focus{border-color:var(--acc);box-shadow:0 0 0 3px var(--acc-s)}
        .fg select option{background:var(--crd);color:var(--t1)}
        .fr{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .sv{padding:9px 24px;background:var(--acc);color:#fff;border:none;border-radius:var(--r1);font-family:'Montserrat',sans-serif;font-size:11px;font-weight:600;cursor:pointer;transition:all .2s;margin-top:6px}
        .sv:hover{background:var(--acc-d)}
        .ok-msg{background:#22c55e11;border:1px solid #22c55e44;border-radius:var(--r2);padding:12px 16px;margin-bottom:20px;font-size:11px;color:#4ade80}
        .section-lbl{font-size:9px;letter-spacing:.12em;text-transform:uppercase;color:var(--t3);margin:16px 0 12px;padding-top:12px;border-top:1px solid var(--bd)}
        .jenjang-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:8px;margin-bottom:20px}
        .jbtn{padding:10px 6px;border:1px solid var(--bd);background:var(--inp);border-radius:var(--r2);cursor:pointer;text-align:center;transition:all .2s;font-family:'Montserrat',sans-serif;font-size:10px;color:var(--t2)}
        .jbtn:hover{border-color:var(--acc);color:var(--t1)}
        .jbtn.active{border-color:var(--acc);background:var(--acc-s);color:var(--acc)}
        .jbtn .jic{font-size:20px;display:block;margin-bottom:4px}
        .hidden{display:none!important}

        @media(max-width:768px){
            .sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}
            .hb{display:flex}.content{padding:16px}.topbar{padding:0 16px}
            .stg{grid-template-columns:1fr}.fr{grid-template-columns:1fr}.msg{max-width:95%}.tb-user{display:none}
            .jenjang-grid{grid-template-columns:repeat(3,1fr)}
        }
    </style>
</head>
<body>
<div class="app">
    <div class="ov" id="ov"></div>
    <aside class="sidebar" id="sb">
        <div class="sb-brand">
            <img src="{{ asset('images/logosmartscholar.png') }}" alt="SmartScholar AI" style="width:40px;height:40px;border-radius:6px;object-fit:contain">
            <div><div class="sb-name">SmartScholar AI</div><div class="sb-sub"></div></div>
        </div>
        <nav class="sb-nav">
            <div class="nav-lbl">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="ni {{ request()->routeIs('dashboard') ? 'active' : '' }}"><div class="ni-ic nic-d">◉</div><span>Dashboard</span></a>
            <a href="{{ route('career') }}" class="ni {{ request()->routeIs('career') ? 'active' : '' }}"><div class="ni-ic nic-c">💼</div><span>Career Assistant</span></a>
            <a href="{{ route('scholarship') }}" class="ni {{ request()->routeIs('scholarship') ? 'active' : '' }}"><div class="ni-ic nic-s">🎓</div><span>Scholarship Assistant</span></a>
            <a href="{{ route('library') }}" class="ni {{ request()->routeIs('library') ? 'active' : '' }}"><div class="ni-ic nic-l">📚</div><span>Smart Library</span></a>
            <div style="margin-top:20px"><div class="nav-lbl">Lainnya</div></div>
            <a href="{{ route('profile') }}" class="ni {{ request()->routeIs('profile') ? 'active' : '' }}"><div class="ni-ic nic-p">⚙</div><span>Profil & Pengaturan</span></a>
        </nav>
        <div class="sb-foot">
            <div class="uc">
                <div class="uc-av">{{ Auth::user()->initials }}</div>
                <div class="uc-info">
                    <div class="uc-n">{{ Auth::user()->name }}</div>
                    <div class="uc-r">{{ Auth::user()->subtitle }}</div>
                </div>
            </div>
            <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn">
                <span class="tg-icon" id="tgIcon">🌙</span>
                <span class="tg-label" id="tgLabel">Mode Gelap</span>
                <div class="tg-track"><div class="tg-dot"></div></div>
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🚪 Keluar</button>
            </form>
        </div>
    </aside>
    <main class="main">
        <header class="topbar">
            <div class="tb-l">
                <button class="hb" onclick="document.getElementById('sb').classList.toggle('open');document.getElementById('ov').classList.toggle('on')">☰</button>
                <img src="{{ asset('images/logosmartscholar.png') }}" alt="SmartScholar" style="width:28px;height:28px;border-radius:4px;object-fit:contain;margin-right:4px">
                <span class="tb-t">@yield('title', 'Dashboard')</span>
                <span class="tb-b">Free & Unlimited</span>
            </div>
            <div class="tb-r">
                <button class="tb-theme" onclick="toggleTheme()" id="tbTheme" title="Ganti tema">🌙</button>
                <div class="tb-user">
                    <div class="tb-av">{{ Auth::user()->initials }}</div>
                    <span class="tb-un">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>
        <div class="content">@yield('content')</div>
    </main>
</div>

<script>
function toggleTheme() {
    const body = document.body;
    const isLight = body.classList.toggle('light');
    localStorage.setItem('smartscholar-theme', isLight ? 'light' : 'dark');
    updateThemeUI(isLight);
}

function updateThemeUI(isLight) {
    const icon = document.getElementById('tgIcon');
    const label = document.getElementById('tgLabel');
    const tbTheme = document.getElementById('tbTheme');

    if (isLight) {
        icon.textContent = '☀️';
        label.textContent = 'Mode Terang';
        tbTheme.textContent = '☀️';
    } else {
        icon.textContent = '🌙';
        label.textContent = 'Mode Gelap';
        tbTheme.textContent = '🌙';
    }
}

// Load saved theme on page load
(function() {
    const saved = localStorage.getItem('smartscholar-theme');
    if (saved === 'light') {
        document.body.classList.add('light');
        updateThemeUI(true);
    } else {
        updateThemeUI(false);
    }
})();
</script>

@yield('scripts')
</body>
</html>
