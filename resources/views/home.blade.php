@extends('layouts.app')

@section('content')
    <!-- Hero Section Grid -->
    <section class="home-grid">
        <!-- Gauche (2 colonnes) : Message fort -->
        <div class="home-intro">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                PARLER DE SES DÉFIS N’EST PAS FAIBLIR, <br>
                <span class="text-[#00A896]">TROUVER DU SOUTIEN C’EST AVANCER</span>
            </h1>
            <p class="text-gray-600 text-lg mb-8 max-w-xl">
                Bienvenue sur JeunesseForte. Une plateforme pensée par et pour les jeunes, offrant un espace d'écoute, des salons d'échanges et un accompagnement professionnel adapté.
            </p>
        </div>

        <!-- Droite (1 colonne) : Blocs empilés (Turquoise & Corail) -->
        <div class="home-features">
            <!-- Bloc Haut : Turquoise -->
            <div class="home-feature home-feature-podcast">
                <span class="text-xs font-bold uppercase tracking-wider mb-2 opacity-80">À la une</span>
                <h3 class="text-xl font-bold mb-3">LE PODCAST JEUNESSEFORTE</h3>
                <p class="text-sm mb-6 opacity-90">Découvrez les témoignages poignants et les conseils de nos experts pour traverser les moments de doute.</p>
                <a href="#" class="self-start bg-white text-[#00A896] font-bold px-6 py-2 rounded-full text-sm hover:bg-gray-100 transition">LIRE</a>
            </div>

            <!-- Bloc Bas : Corail -->
            <div class="home-feature home-feature-support">
                <span class="text-xs font-bold uppercase tracking-wider mb-2 opacity-80">Accompagnement</span>
                <h3 class="text-xl font-bold mb-3">BESOIN D'UN ACCOMPAGNEMENT ?</h3>
                <p class="text-sm opacity-90">Prenez rendez-vous en toute confidentialité avec un professionnel de santé ou un pair-aidant.</p>
            </div>
        </div>
    </section>

@endsection
