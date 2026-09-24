<div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Navbar -->
    <header class="bg-white border-b border-gray-100 py-4 px-8 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-black text-[#1A5C3A]">JEUNESSEFORTE</span>
        </div>
        <nav class="hidden md:flex space-x-6 text-sm font-semibold text-gray-700">
            <a href="/" class="hover:text-[#1A5C3A]">ACCUEIL</a>
            <a href="#comprendre" class="hover:text-[#1A5C3A]">COMPRENDRE</a>
            <a href="/messagerie" class="hover:text-[#1A5C3A]">SALONS PRIVÉS</a>
            <a href="/connexion" class="hover:text-[#1A5C3A]">CONNEXION</a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-1 grid grid-cols-1 lg:grid-cols-3">
        <!-- Gauche : Message fort -->
        <div class="lg:col-span-2 p-12 lg:p-20 flex flex-col justify-center bg-white">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                PARLER DE SES DÉFIS N'EST PAS FAIBLIR,
                <br>
                <span style="color:#1A5C3A;">TROUVER DU SOUTIEN C'EST AVANCER</span>
            </h1>
            <p class="text-gray-600 text-lg mb-8 max-w-xl">
                Bienvenue sur JeunesseForte. Une plateforme pensée par et pour les jeunes, offrant un espace d'écoute, des salons d'échanges et un accompagnement professionnel adapté.
            </p>
            <div class="flex gap-4">
                @auth
                    <a href="/messagerie" class="bg-[#1A5C3A] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#144d2f] transition">
                        💬 Mes Conversations
                    </a>
                @else
                    <a href="/inscription" class="bg-[#1A5C3A] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#144d2f] transition">
                        S'inscrire gratuitement
                    </a>
                @endauth
                <a href="#comprendre" class="bg-white text-[#1A5C3A] px-6 py-3 rounded-xl font-bold hover:bg-gray-100 transition border-2 border-[#1A5C3A]">
                    Comprendre la dépression →
                </a>
            </div>
        </div>

        <!-- Droite : Blocs empilés -->
        <div class="flex flex-col">
            <!-- Bloc Podcast -->
            <div class="bg-[#1A5C3A] text-white p-8 flex-1 flex flex-col justify-center">
                <span class="text-xs font-bold uppercase tracking-wider mb-2 opacity-80">À la une</span>
                <h3 class="text-xl font-bold mb-3">LE PODCAST JEUNESSEFORTE</h3>
                <p class="text-sm mb-6 opacity-90">Découvrez les témoignages poignants et les conseils de nos experts pour traverser les moments de doute.</p>
                <a href="#" class="self-start bg-white text-[#1A5C3A] font-bold px-6 py-2 rounded-full text-sm hover:bg-gray-100 transition">LIRE</a>
            </div>
            <!-- Bloc Accompagnement -->
            <div class="bg-[#C8963E] text-white p-8 flex-1 flex flex-col justify-center">
                <span class="text-xs font-bold uppercase tracking-wider mb-2 opacity-80">Accompagnement</span>
                <h3 class="text-xl font-bold mb-3">BESOIN D'UN ACCOMPAGNEMENT ?</h3>
                <p class="text-sm opacity-90">Prenez rendez-vous en toute confidentialité avec un professionnel de santé ou un pair-aidant.</p>
                <a href="/messagerie" class="self-start bg-white text-[#C8963E] font-bold px-6 py-2 rounded-full text-sm hover:bg-gray-100 transition">NOUS CONTACTER</a>
            </div>
        </div>
    </main>

    <!-- SECTION QUI SOMMES-NOUS (publique, sans connexion) -->
    <section id="equipe" class="py-16 bg-white">
        <div class="container max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Qui sommes-nous ?</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        JeunesseForte est une plateforme de soutien étudiant née d'un constat simple :
                        la solitude et la détresse psychologique touchent beaucoup d'étudiants, mais rarement parlent-ils en ouvert.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-[#F0FDF4] p-5 rounded-xl border border-[#BBF7D0]">
                            <h4 class="font-bold text-[#1A5C3A] text-lg mb-2">🔒 Anonymat garanti</h4>
                            <p class="text-sm text-gray-700">Vos confessions restent anonymes. Seuls les professionnels accrédités peuvent vous contacter via les salons privés.</p>
                        </div>
                        <div class="bg-[#FFF7ED] p-5 rounded-xl border border-[#FED7AA]">
                            <h4 class="font-bold text-[#C8963E] text-lg mb-2">🌍 Inclusion</h4>
                            <p class="text-sm text-gray-700">Nous rejoignons les jeunes de tous horizons, sans jugement, avec des ressources adaptées à chaque situation.</p>
                        </div>
                        <div class="bg-[#F0FDF4] p-5 rounded-xl border border-[#BBF7D0]">
                            <h4 class="font-bold text-[#1A5C3A] text-lg mb-2">👥 Communauté</h4>
                            <p class="text-sm text-gray-700">Des pairs-aidants et professionnels formés vous écoutent et vous orientent vers les bonnes ressources.</p>
                        </div>
                        <div class="bg-[#FFF7ED] p-5 rounded-xl border border-[#FED7AA]">
                            <h4 class="font-bold text-[#C8963E] text-lg mb-2">🎯 Mission</h4>
                            <p class="text-sm text-gray-700">Réduire la stigmatisation de la santé mentale et offrir un espace sûr où chaque jeune peut être écouté.</p>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:flex items-center justify-center">
                    <div style="width:100%;max-width:400px;height:300px;background:linear-gradient(135deg,#1A5C3A,#2D8A5A);border-radius:20px;display:flex;align-items:center;justify-content:center;color:white;font-size:4rem;font-weight:bold;">
                        🫂
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION COMPRENDRE LA DÉPRESSION (publique, sans connexion) -->
    <section id="comprendre" class="py-16 bg-[#F8FAFC]">
        <div class="container max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Comprendre la dépression</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    La dépression est l'un des troubles mentaux les plus fréquents, mais aussi l'un des moins compris.
                    Voici les clés pour en faire face.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Symptômes -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">🧠</div>
                    <h3 class="font-bold text-lg mb-3 text-gray-900">Symptômes courants</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>🔹 Tristesse persistante ou vide émotionnelle</li>
                        <li>🔹 Perte d'intérêt pour les activités habituelles</li>
                        <li>🔹 Fatigue constante, manque d'énergie</li>
                        <li>🔹 Difficultés de concentration</li>
                        <li>🔹 Troubles du sommeil (insomnie ou hypersomnie)</li>
                        <li>🔹 Pensées négatives ou désespoir</li>
                    </ul>
                </div>

                <!-- Causes -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">🌱</div>
                    <h3 class="font-bold text-lg mb-3 text-gray-900">Les causes</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>🔸 Facteurs biologiques (chimie cérébrale, génétique)</li>
                        <li>🔸 Stress post-traumatique ou événements difficiles</li>
                        <li>🔸 Isolement social et solitude</li>
                        <li>🔸 Pressions académiques et professionnelles</li>
                        <li>🔸 Problèmes relationnels ou familiaux</li>
                        <li>🔸 Mauvaises habitudes de vie (sommeil, alimentation)</li>
                    </ul>
                </div>

                <!-- Ce qu'on peut faire -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">🤝</div>
                    <h3 class="font-bold text-lg mb-3 text-gray-900">Ce qu'on peut faire</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>✅ Parler à un proche de confiance</li>
                        <li>✅ Consulter un professionnel (psychologue, psychiatre)</li>
                        <li>✅ Rejoindre un groupe de soutien</li>
                        <li>✅ Pratiquer une activité physique régulière</li>
                        <li>✅ Maintenir une hygiène de vie saine</li>
                        <li>✅ Utiliser JeunesseForte pour s'exprimer</li>
                    </ul>
                </div>
            </div>

            <!-- Bannières Jours Mondiaux (automates selon date serveur) -->
            <div class="mt-12 bg-[#1A5C3A] text-white rounded-xl p-8">
                <h3 class="text-xl font-bold mb-4">📅 Journées Mondiales de Sensibilisation</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white/10 rounded-lg p-4">
                        <span class="text-xs opacity-80">14 FÉVRIER</span>
                        <h4 class="font-bold">Journée Mondiale de la Médecine</h4>
                        <p class="text-sm opacity-90">Conscience des soins de santé accessibles à tous.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4">
                        <span class="text-xs opacity-80">10 SEPTEMBRE</span>
                        <h4 class="font-bold">Journée Mondiale de la Prévention du Suicide</h4>
                        <p class="text-sm opacity-90">Briser le silence autour du suicide.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4">
                        <span class="text-xs opacity-80">10 OCTOBRE</span>
                        <h4 class="font-bold">Journée Mondiale de la Santé Mentale</h4>
                        <p class="text-sm opacity-90">Santé mentale : un droit humain fondamental.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4">
                        <span class="text-xs opacity-80">27 OCTOBRE</span>
                        <h4 class="font-bold">Journée Mondiale du Marketing Éthique</h4>
                        <p class="text-sm opacity-90">Promouvoir des campagnes responsables en santé mentale.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4">
                        <span class="text-xs opacity-80">25 NOVEMBRE</span>
                        <h4 class="font-bold">Journée Internationale de la Victime de Violence</h4>
                        <p class="text-sm opacity-90">Soutenir les victimes de violence psychologique.</p>
                    </div>
                </div>
                <p class="text-white/80 text-sm mt-4 text-center">
                    * Ces jours sont affichés automatiquement selon la date du serveur.
                </p>
            </div>
        </div>
    </section>

    <!-- CTA + WIDGET DON (déjà dans le layout via @include) -->
    <section class="py-16 bg-white">
        <div class="container max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Vous avez besoin d'aide ?</h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                Vous n'êtes pas seul. Des milliers d'étudiants traversent des moments difficiles.
                Rejoignez JeunesseForte pour trouver un soutien adapté.
            </p>
            <div class="flex justify-center gap-4">
                @auth
                    <a href="/messagerie" class="bg-[#1A5C3A] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#144d2f] transition text-lg">
                        💬 Aller dans ma messagerie
                    </a>
                @else
                    <a href="/inscription" class="bg-[#1A5C3A] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#144d2f] transition text-lg">
                        S'inscrire gratuitement
                    </a>
                @endauth
                <a href="#comprendre" class="bg-white text-[#1A5C3A] px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition border-2 border-[#1A5C3A] text-lg">
                    En savoir plus
                </a>
            </div>
        </div>
    </section>
</div>
