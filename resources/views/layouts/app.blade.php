<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        (() => {
            let saved;
            try { saved = localStorage.getItem('jeunesseforte-theme'); } catch {}
            document.documentElement.dataset.theme = ['light', 'dark'].includes(saved)
                ? saved : (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        })();
    </script>
    <title>JeunesseForte — Plateforme de Soutien</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

</head>
<body>
    <a class="skip-link" href="#main-content">Aller au contenu</a>
    <header class="site-header">
        <nav class="jf-navbar navbar navbar-expand-xl" aria-label="Navigation principale">
            <div class="container navbar-inner">
                <a href="/" class="navbar-brand" aria-label="JeunesseForte — Accueil">
                    <span class="brand-mark" aria-hidden="true">JF<span></span></span>
                    <span class="brand-copy"><span>JEUNESSE<strong>FORTE</strong></span><small>Ensemble, on avance.</small></span>
                </a>
                <button class="theme-toggle" type="button" aria-label="Mode sombre" aria-pressed="false" title="Changer le thème">
                    <span class="theme-moon" aria-hidden="true">☾</span><span class="theme-sun" aria-hidden="true">☀</span>
                    <span class="sr-only">Mode sombre</span>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Afficher ou masquer le menu">
                    <span class="menu-icon" aria-hidden="true"><span></span><span></span><span></span></span>
                    <span>Menu</span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav">
                        <li><a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}" @if(request()->is('/')) aria-current="page" @endif>Accueil</a></li>
                        <li><a href="/#a-propos" class="nav-link">À propos</a></li>
                        <li><a href="/#echanges" class="nav-link">Les échanges</a></li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li><a href="/admin" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" @if(request()->is('admin*')) aria-current="page" @endif>Administration</a></li>
                            @endif
                            @if(in_array(auth()->user()->role, ['pair-aidant', 'psychologue']))
                                <li><a href="/dashboard-pro" class="nav-link {{ request()->is('dashboard-pro') ? 'active' : '' }}" @if(request()->is('dashboard-pro')) aria-current="page" @endif>Espace pro</a></li>
                            @endif
                            @if(in_array(auth()->user()->role, ['jeune', 'pair-aidant', 'psychologue']))
                                <li><a href="/messagerie" class="nav-link {{ request()->is('messagerie') ? 'active' : '' }}" @if(request()->is('messagerie')) aria-current="page" @endif>Conversations</a></li>
                            @endif
                        @endauth
                    </ul>
                    <div class="navbar-actions">
                        @auth
                            <span class="navbar-account"><span class="account-dot" aria-hidden="true"></span><span class="account-name">{{ auth()->user()->name }}</span></span>
                            <a href="/deconnexion" class="nav-signout">Déconnexion</a>
                        @else
                            <a href="/connexion" class="nav-link {{ request()->is('connexion') ? 'active' : '' }}" @if(request()->is('connexion')) aria-current="page" @endif>Connexion</a>
                            <a href="/inscription" class="nav-signup" @if(request()->is('inscription')) aria-current="page" @endif>S’inscrire <span aria-hidden="true">↗</span></a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main id="main-content" class="container site-main">
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>