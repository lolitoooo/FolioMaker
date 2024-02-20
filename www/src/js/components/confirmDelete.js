function confirmDelete(buttonElement) {
    const userId = buttonElement.getAttribute('data-id');
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/user/delete';

        // Ajouter l'ID de l'utilisateur dans le formulaire
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'user_id';
        hiddenField.value = userId;
        form.appendChild(hiddenField);

        // Ajouter d'autres champs si nécessaire, par exemple un champ CSRF token

        document.body.appendChild(form);
        form.submit();
    }
}