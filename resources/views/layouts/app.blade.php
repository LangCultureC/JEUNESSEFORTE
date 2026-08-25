<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JeunesseForte — Plateforme de Soutien</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #F8FAFC; --brand-primary: #1A5C3A; --brand-secondary: #2D8A5A;
            --accent-gold: #C8963E; --text-dark: #0F172A; --text-muted: #64748B;
            --card-bg: #FFFFFF; --danger-red: #EF4444; --radius-lg: 16px;
            --radius-md: 12px; --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-main); color: var(--text-dark); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* HEADER PRINCIPAL */
        header { background: var(--card-bg); padding: 1.2rem 0; }
        .header-wrap { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.5rem; color: var(--brand-primary); text-decoration: none; }
        .btn-login, .btn-register { padding: 0.6rem 1.2rem; border-radius: var(--radius-md); text-decoration: none; font-weight: 600; font-size: 0.9rem; color: var(--text-dark); }
        .btn-register { background: var(--brand-primary); color: white; }
        .btn-logout { background: transparent; border: 1px solid var(--danger-red); color: var(--danger-red); padding: 0.4rem 0.8rem; border-radius: var(--radius-md); text-decoration: none; font-weight: 600; font-size: 0.8rem; }
        
        /* BARRE DE NAVIGATION PAR RÔLE */
        .role-nav { background: var(--brand-primary); box-shadow: var(--shadow-sm); position: sticky; top: 0; z-index: 100; margin-bottom: 2rem; }
        .role-nav .container { display: flex; gap: 0.5rem; overflow-x: auto; }
        .nav-tab { padding: 1rem 1.5rem; color: #E2E8F0; text-decoration: none; font-weight: 600; font-size: 0.95rem; border-bottom: 3px solid transparent; white-space: nowrap; transition: all 0.2s; }
        .nav-tab:hover, .nav-tab.active { color: white; background: rgba(255,255,255,0.1); border-bottom-color: var(--accent-gold); }
        
        /* RESTE DU SITE */
        .hero-layout { display: grid; grid-template-columns: 1.4fr 1fr; gap: 2rem; margin-bottom: 2.5rem; align-items: stretch; }
        .hero-main { background: linear-gradient(135deg, #1A5C3A 0%, #113B25 100%); color: white; border-radius: var(--radius-lg); padding: 3rem; }
        .hero-main h1 { font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; margin-bottom: 1rem; }
        .filter-grid { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem; }
        .filter-btn { background: var(--card-bg); border: 1px solid #E2E8F0; padding: 0.6rem 1.2rem; border-radius: 30px; cursor: pointer; }
        .filter-btn.active { background: var(--brand-primary); color: white; }
        .box-confession { background: var(--card-bg); border-radius: var(--radius-lg); padding: 2rem; box-shadow: var(--shadow-sm); border: 1px solid #E2E8F0; margin-bottom: 3rem; }
        textarea { width: 100%; height: 120px; padding: 1rem; border: 1px solid #E2E8F0; border-radius: var(--radius-md); resize: none; margin-bottom: 1rem; font-family: inherit; }
        .main-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 2.5rem; }
        .confession-card { background: var(--card-bg); border-radius: var(--radius-lg); border: 1px solid #E2E8F0; padding: 2rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm); }
        .tag-cat { background: #EAF4EE; color: var(--brand-primary); padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 700; font-size: 0.8rem; }
        .btn-sos { background: var(--danger-red); color: white; border: none; padding: 0.5rem 1rem; font-size: 0.8rem; font-weight: 700; border-radius: var(--radius-md); cursor: pointer; }
        .stat-card { background: var(--card-bg); border: 1px solid #E2E8F0; border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow-sm); margin-bottom:1rem; }
    </style>
</head>
<body>
    <header>
        <div class="container header-wrap">
            <a href="/" class="logo">JEUNESSEFORTE</a>
            <div style="display:flex; align-items:center; gap:1rem;">
                @auth
                    <span style="font-size:0.95rem; color: var(--text-muted);">Connecté en tant que <strong style="color: var(--text-dark);">{{ auth()->user()->name }}</strong></span>
                    <a href="/deconnexion" class="btn-logout">Déconnexion</a>
                @else
                    <a href="/connexion" class="btn-login">Connexion</a>
                    <a href="/inscription" class="btn-register">S'inscrire</a>
                @endauth
            </div>
        </div>
    </header>

    @auth
    <nav class="role-nav">
        <div class="container">
            <a href="/" class="nav-tab {{ request()->is('/') ? 'active' : '' }}">🏠 Accueil & Fil public</a>

            @if(auth()->user()->role === 'admin')
                <a href="/admin" class="nav-tab {{ request()->is('admin') ? 'active' : '' }}">🛡️ Espace Admin (Gestion)</a>
            @endif

            @if(in_array(auth()->user()->role, ['pair-aidant', 'psychologue']))
                <a href="/dashboard-pro" class="nav-tab {{ request()->is('dashboard-pro') ? 'active' : '' }}">🚨 Gestion RDV & SOS</a>
            @endif

            @if(in_array(auth()->user()->role, ['jeune', 'pair-aidant', 'psychologue']))
                <a href="/messagerie" class="nav-tab {{ request()->is('messagerie') ? 'active' : '' }}">💬 Mes Conversations Privées</a>
            @endif
        </div>
    </nav>
    @endauth

    <main class="container">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>