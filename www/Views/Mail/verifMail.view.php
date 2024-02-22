<?php
    $message = isset($message) ? $message : '';
?>
<!-- Affichage du message selon la situation -->
<?php if ($message == 'success'): ?>
    <p>La vérification de l'e-mail a réussi. Vous pouvez maintenant accéder à votre compte.</p>
    <a href="/login">Connexion</a>
<?php elseif ($message == 'failure'): ?>
    <p>La vérification de l'e-mail a échoué. Veuillez réessayer ultérieurement.</p>
    <a href="/register">Inscription</a>
<?php elseif ($message == 'missing_param'): ?>
    <p>Paramètre manquant dans l'URL. Veuillez fournir un e-mail valide pour la vérification.</p>
    <a href="/">Inscription</a>
<?php endif; ?>
