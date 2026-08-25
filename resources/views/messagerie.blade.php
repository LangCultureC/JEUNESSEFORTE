@extends('layouts.app')

@section('content')
<div class="box-confession" style="padding: 0; display: flex; height: 70vh; overflow: hidden;">
    
    <!-- Liste des conversations à gauche -->
    <div style="width: 300px; border-right: 1px solid #E2E8F0; background: #F8FAFC; overflow-y: auto;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #E2E8F0;">
            <h2 style="font-size: 1.2rem; font-family: 'Space Grotesk', sans-serif;">Boîte de réception</h2>
        </div>
        <div id="listeConversations" style="padding: 1rem;">
            <p style="color: var(--text-muted); font-size: 0.9rem;">Chargement des messages...</p>
        </div>
    </div>

    <!-- Zone de chat à droite -->
    <div style="flex: 1; display: flex; flex-direction: column; background: white;">
        <div id="enteteChat" style="padding: 1.5rem; border-bottom: 1px solid #E2E8F0; background: white;">
            <h3 style="margin: 0; color: var(--text-dark);">Sélectionnez une conversation</h3>
        </div>
        
        <div id="zoneMessages" style="flex: 1; padding: 1.5rem; overflow-y: auto; background: #F8FAFC;">
            <!-- Les messages apparaîtront ici -->
        </div>

        <div style="padding: 1.5rem; border-top: 1px solid #E2E8F0; background: white;">
            <form id="formMessage" style="display: flex; gap: 1rem;">
                <input type="text" id="inputMessage" placeholder="Écrivez votre message..." style="flex: 1; padding: 0.8rem; border: 1px solid #E2E8F0; border-radius: var(--radius-md);" disabled>
                <button type="submit" style="background: var(--brand-primary); color: white; border: none; padding: 0 1.5rem; border-radius: var(--radius-md); font-weight: 600; cursor: pointer;" disabled>Envoyer</button>
            </form>
        </div>
    </div>

</div>
@endsection
