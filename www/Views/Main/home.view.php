<p>Ceci est la page d'accueil</p>

<?php if ($this->isUserLoggedIn()): ?>
    <form action="/logout" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
<?php endif; ?>

