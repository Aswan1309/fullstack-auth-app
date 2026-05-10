<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Nexora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        :root{--bg:#0a0a0f;--bg-panel:#0f0f1a;--bg-card:#13131f;--bg-input:#1a1a2e;--border:rgba(255,255,255,0.07);--gold:#c9a96e;--gold-light:#e8c99a;--gold-dim:rgba(201,169,110,0.15);--text-primary:#f0ede8;--text-secondary:#8a8599;--text-muted:#4a4760;--radius:14px;--radius-sm:8px;--transition:0.25s cubic-bezier(0.4,0,0.2,1)}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{font-size:16px}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text-primary);min-height:100vh;-webkit-font-smoothing:antialiased;overflow-x:hidden}
        a{color:var(--gold);text-decoration:none;transition:color var(--transition)}
        a:hover{color:var(--gold-light)}

        /* AUTH LAYOUT */
        .auth-page{display:grid;grid-template-columns:420px 1fr;min-height:100vh}
        .auth-panel{position:relative;background:var(--bg-panel);border-right:1px solid var(--border);overflow:hidden;display:flex;flex-direction:column}
        .auth-panel::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 20% 80%,rgba(201,169,110,0.08) 0%,transparent 70%),radial-gradient(ellipse 60% 50% at 80% 20%,rgba(100,80,200,0.06) 0%,transparent 70%);pointer-events:none}
        .panel-inner{position:relative;z-index:1;display:flex;flex-direction:column;height:100%;padding:48px 40px}
        .logo{display:flex;align-items:center;gap:10px;font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:700;color:var(--gold);letter-spacing:.02em}
        .logo-icon{font-size:1.5rem;animation:spin-slow 8s linear infinite;display:inline-block}
        @keyframes spin-slow{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
        .panel-quote{margin-top:auto;margin-bottom:48px}
        .panel-quote blockquote{font-family:'Playfair Display',serif;font-size:1.25rem;line-height:1.65;color:var(--text-secondary);font-style:italic;border-left:2px solid var(--gold);padding-left:20px}
        .panel-steps{margin-top:auto;margin-bottom:48px}
        .steps-label{font-size:.8rem;letter-spacing:.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:24px}
        .step-item{display:flex;align-items:center;gap:14px;padding:14px 16px;border-radius:var(--radius-sm);margin-bottom:8px;color:var(--text-muted);transition:all var(--transition)}
        .step-item.active{background:var(--gold-dim);color:var(--gold-light);border:1px solid rgba(201,169,110,.2)}
        .step-num{font-family:'Playfair Display',serif;font-size:.85rem;font-weight:600;color:var(--gold)}
        .panel-orb{position:absolute;border-radius:50%;filter:blur(50px);pointer-events:none;animation:orb-float 6s ease-in-out infinite}
        .orb-1{width:200px;height:200px;top:10%;right:-60px;background:radial-gradient(circle,rgba(201,169,110,.12),transparent)}
        .orb-2{width:150px;height:150px;bottom:20%;left:-30px;background:radial-gradient(circle,rgba(120,100,220,.1),transparent);animation-delay:-2s}
        .orb-3{width:100px;height:100px;top:50%;right:20px;background:radial-gradient(circle,rgba(201,169,110,.06),transparent);animation-delay:-4s}
        @keyframes orb-float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}

        /* FORM SIDE */
        .auth-form-wrapper{display:flex;align-items:center;justify-content:center;padding:40px 24px;background:var(--bg);position:relative}
        .auth-form-wrapper::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 50% 40% at 70% 30%,rgba(201,169,110,.04) 0%,transparent 70%);pointer-events:none}
        .auth-card{position:relative;z-index:1;width:100%;max-width:440px;animation:card-in .6s cubic-bezier(.22,1,.36,1) both}
        @keyframes card-in{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        .form-header{margin-bottom:32px}
        .form-eyebrow{font-size:.78rem;letter-spacing:.14em;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:8px}
        .form-title{font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--text-primary);line-height:1.2;margin-bottom:10px}
        .form-subtitle{font-size:.9rem;color:var(--text-secondary);line-height:1.55}

        /* ALERT */
        .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:var(--radius-sm);font-size:.875rem;margin-bottom:20px}
        .alert-error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#fca5a5}

        /* GOOGLE BTN */
        .btn-google{display:flex;align-items:center;justify-content:center;gap:12px;width:100%;padding:13px 20px;border-radius:var(--radius-sm);border:1px solid var(--border);background:var(--bg-card);color:var(--text-primary);font-size:.9rem;font-weight:500;cursor:pointer;transition:all var(--transition);text-decoration:none;margin-bottom:24px}
        .btn-google:hover{background:var(--bg-input);border-color:rgba(255,255,255,.15);color:var(--text-primary);transform:translateY(-1px);box-shadow:0 8px 20px rgba(0,0,0,.3)}

        /* DIVIDER */
        .divider{display:flex;align-items:center;gap:12px;margin-bottom:24px;color:var(--text-muted);font-size:.8rem}
        .divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--border)}

        /* FIELDS */
        .auth-form{display:flex;flex-direction:column;gap:18px}
        .field-group{display:flex;flex-direction:column;gap:6px}
        .field-label{font-size:.82rem;font-weight:500;color:var(--text-secondary);display:flex;justify-content:space-between;align-items:center}
        .forgot-link{font-size:.8rem;color:var(--gold);font-weight:400}
        .field-input-wrap{position:relative}
        .field-input{width:100%;padding:13px 44px 13px 16px;background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);color:var(--text-primary);font-family:'DM Sans',sans-serif;font-size:.9rem;transition:all var(--transition);outline:none}
        .field-input::placeholder{color:var(--text-muted)}
        .field-input:focus{border-color:rgba(201,169,110,.5);background:rgba(201,169,110,.04);box-shadow:0 0 0 3px var(--gold-dim)}
        .field-icon{position:absolute;right:14px;top:50%;transform:translateY(-50%);font-size:.9rem;color:var(--text-muted);cursor:default;user-select:none}
        .toggle-pw{cursor:pointer;transition:color var(--transition)}
        .toggle-pw:hover{color:var(--gold)}

        /* PASSWORD STRENGTH */
        .pw-strength{height:3px;background:var(--border);border-radius:2px;margin-top:6px;overflow:hidden}
        .pw-bar{height:100%;width:0;border-radius:2px;transition:width .4s ease,background .4s ease}
        .pw-hint{font-size:.75rem;margin-top:4px;height:16px}

        /* CHECKBOX */
        .field-check{margin:4px 0}
        .check-label{display:flex;align-items:center;gap:10px;font-size:.85rem;color:var(--text-secondary);cursor:pointer;user-select:none}
        .check-label input[type="checkbox"]{display:none}
        .check-box{width:18px;height:18px;min-width:18px;border:1px solid var(--border);border-radius:4px;background:var(--bg-input);transition:all var(--transition);position:relative}
        .check-label input:checked+.check-box{background:var(--gold);border-color:var(--gold)}
        .check-label input:checked+.check-box::after{content:'✓';position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:.7rem;color:#0a0a0f;font-weight:700}

        /* PRIMARY BUTTON */
        .btn-primary{display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:14px 24px;border:none;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--gold),#a07840);color:#0a0a0f;font-family:'DM Sans',sans-serif;font-size:.95rem;font-weight:600;cursor:pointer;transition:all var(--transition);margin-top:6px}
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(201,169,110,.3)}
        .btn-arrow{transition:transform var(--transition)}
        .btn-primary:hover .btn-arrow{transform:translateX(4px)}
        .switch-auth{text-align:center;font-size:.875rem;color:var(--text-muted);margin-top:24px}
        .switch-auth a{font-weight:500}

        /* DASHBOARD */
        .dashboard-page{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
        .sidebar{background:var(--bg-panel);border-right:1px solid var(--border);display:flex;flex-direction:column;padding:32px 20px;position:sticky;top:0;height:100vh}
        .sidebar-logo{display:flex;align-items:center;gap:10px;font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:var(--gold);padding:0 8px;margin-bottom:40px}
        .sidebar-nav{display:flex;flex-direction:column;gap:4px;flex:1}
        .nav-item{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:var(--radius-sm);color:var(--text-muted);font-size:.9rem;font-weight:500;text-decoration:none;transition:all var(--transition)}
        .nav-item:hover{background:var(--bg-card);color:var(--text-primary)}
        .nav-item.active{background:var(--gold-dim);color:var(--gold-light);border:1px solid rgba(201,169,110,.15)}
        .nav-ico{font-style:normal;font-size:1rem}
        .sidebar-bottom{margin-top:auto}
        .sidebar-user{display:flex;align-items:center;gap:10px;padding:12px 8px;margin-bottom:8px}
        .user-avatar{width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-dim)}
        .user-avatar-placeholder{width:36px;height:36px;min-width:36px;border-radius:50%;background:var(--gold-dim);border:2px solid rgba(201,169,110,.3);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:700;font-size:.95rem;color:var(--gold)}
        .user-info{overflow:hidden}
        .user-name{font-size:.85rem;font-weight:600;color:var(--text-primary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .user-email{font-size:.75rem;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .btn-logout{width:100%;padding:9px 14px;background:none;border:1px solid var(--border);border-radius:var(--radius-sm);color:var(--text-muted);font-family:'DM Sans',sans-serif;font-size:.85rem;cursor:pointer;transition:all var(--transition)}
        .btn-logout:hover{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.25);color:#fca5a5}
        .dash-main{padding:40px 48px;display:flex;flex-direction:column;gap:32px}
        .welcome-banner{position:relative;background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:40px 44px;overflow:hidden;animation:card-in .6s cubic-bezier(.22,1,.36,1) both}
        .welcome-banner::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 90% 50%,rgba(201,169,110,.07) 0%,transparent 70%)}
        .welcome-text{position:relative;z-index:1}
        .welcome-eyebrow{font-size:.85rem;color:var(--text-secondary);margin-bottom:8px}
        .welcome-title{font-family:'Playfair Display',serif;font-size:2.4rem;font-weight:700;line-height:1.2;color:var(--text-primary);margin-bottom:10px}
        .welcome-name{color:var(--gold);font-style:italic}
        .welcome-sub{font-size:.95rem;color:var(--text-secondary);max-width:500px}
        .w-orb{position:absolute;border-radius:50%;filter:blur(50px)}
        .w1{width:180px;height:180px;right:60px;top:-30px;background:radial-gradient(circle,rgba(201,169,110,.15),transparent)}
        .w2{width:120px;height:120px;right:20px;bottom:-10px;background:radial-gradient(circle,rgba(100,80,200,.1),transparent)}
        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;transition:all var(--transition)}
        .stat-card:hover{border-color:rgba(201,169,110,.2);transform:translateY(-2px);box-shadow:0 12px 28px rgba(0,0,0,.3)}
        .stat-label{font-size:.8rem;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:10px}
        .stat-value{font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--text-primary);margin-bottom:6px}
        .stat-delta{font-size:.8rem;color:var(--text-muted)}
        .stat-delta.up{color:#4ade80}
        .activity-section{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px 32px}
        .section-title{font-family:'Playfair Display',serif;font-size:1.15rem;font-weight:600;color:var(--text-primary);margin-bottom:20px}
        .activity-list{display:flex;flex-direction:column;gap:4px}
        .activity-item{display:flex;align-items:center;gap:14px;padding:12px 14px;border-radius:var(--radius-sm);transition:background var(--transition)}
        .activity-item:hover{background:var(--bg-input)}
        .activity-icon{font-size:1.1rem;width:36px;height:36px;min-width:36px;background:var(--bg-input);border-radius:8px;display:flex;align-items:center;justify-content:center}
        .activity-label{font-size:.88rem;color:var(--text-primary)}
        .activity-time{font-size:.78rem;color:var(--text-muted);margin-top:2px}

        @media(max-width:768px){.auth-page{grid-template-columns:1fr}.auth-panel{display:none}.dashboard-page{grid-template-columns:1fr}.dash-main{padding:20px 16px}.stats-grid{grid-template-columns:1fr 1fr}}
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>