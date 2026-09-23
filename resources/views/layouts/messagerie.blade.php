<div class="chat-shell">
    <aside class="chat-sidebar" aria-label="Conversations">
        <div class="chat-sidebar-heading"><p class="eyebrow">Ton espace d’échange</p><h2>Boîte de réception</h2></div>
        <div id="listeConversations" class="chat-conversations"><p class="chat-loading" role="status">Chargement des messages...</p></div>
    </aside>
    <section class="chat-panel" aria-label="Discussion privée">
        <div id="enteteChat" class="chat-heading"><h3>Sélectionnez une conversation</h3></div>
        <div id="zoneMessages" class="chat-messages" role="log" aria-label="Messages"></div>
        <div class="chat-composer">
            <form id="formMessage">
                <label class="sr-only" for="inputMessage">Votre message</label>
                <input type="text" id="inputMessage" placeholder="Écrivez votre message..." disabled>
                <button type="submit" disabled>Envoyer</button>
            </form>
        </div>
    </section>
</div>
