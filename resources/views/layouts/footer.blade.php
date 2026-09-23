<footer class="site-footer">
    <div class="container">
        <div class="footer-invitation">
            <div><p class="footer-kicker">LE PROCHAIN PAS COMMENCE AVEC TOI</p><h2>Ensemble, on va <span>plus loin.</span></h2></div>
            @auth
                <a class="footer-cta" href="/#echanges">Retrouver la communauté <span aria-hidden="true">↗</span></a>
            @else
                <a class="footer-cta" href="/inscription">Faire le premier pas <span aria-hidden="true">↗</span></a>
            @endauth
        </div>
        <div class="footer-grid">
            <div class="footer-intro">
                <a class="footer-brand" href="/" aria-label="JeunesseForte — Accueil"><span class="footer-mark" aria-hidden="true">JF</span>JEUNESSE<strong>FORTE</strong></a>
                <p>Un espace pour parler, une communauté pour avancer. Ensemble, prenons soin de ce qui nous rend forts.</p>
                <span class="footer-motto">Ta voix compte. <span aria-hidden="true">✳</span></span>
            </div>
            <nav class="footer-links" aria-label="Navigation de pied de page">
                <h2>Explore la communauté</h2>
                <a href="/">Accueil</a>
                <a href="/#echanges">Les échanges</a>
                @auth
                    <a href="/messagerie">Mes conversations</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin">Administration</a>
                    @endif
                    @if(in_array(auth()->user()->role, ['pair-aidant', 'psychologue']))
                        <a href="/dashboard-pro">Espace professionnel</a>
                    @endif
                @else
                    <a href="/connexion">Se connecter</a>
                    <a href="/inscription">Rejoindre JeunesseForte</a>
                @endauth
            </nav>
            <div class="footer-values">
                <h2>Un même état d’esprit</h2>
                <p>Écouter avec attention.<br>Partager avec respect.<br>Avancer à son rythme.</p>
                <div class="footer-tags"><span>Écoute</span><span>Entraide</span><span>Bienveillance</span></div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} JeunesseForte. Ensemble, on avance.</p>
            <a href="#main-content">Retour en haut <span aria-hidden="true">↑</span></a>
        </div>
    </div>
</footer>
