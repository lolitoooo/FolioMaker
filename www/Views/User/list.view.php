<div class="table-container">
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td><?= $user->getFirstname() ?></td>
                    <td><?= $user->getLastname() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td>
                    <form class="transparant" method="GET" action="/user/editList">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <button class="button button-secondary w-100" type="submit" >Modifier</button>
                    </form>
                    <!-- Modifier pour chaque utilisateur dans la boucle -->
                    <button class="button primary w-100" data-id="<?= $user->getId(); ?>" onclick="confirmDelete(this)">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    <button class="button button-primary" onclick="window.location.href='/user/create'">Ajouter un utilisateur</button>
</div>


<script>
    $(document).ready(function() {
    $('#userTable').DataTable({
        "language": {
            "lengthMenu": "Afficher _MENU_ entrées par page",
            "zeroRecords": "Aucun enregistrement trouvé",
            "info": "Affichage de la page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucune entrée disponible",
            "infoFiltered": "(filtré de _MAX_ enregistrements totaux)",
            "search": "Recherche:",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        },
        "pagingType": "full_numbers",
        "lengthChange": true,
        "pageLength": 10
    });
});

function confirmDelete(buttonElement) {
    const userId = buttonElement.getAttribute('data-id');
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/user/deletelist';

        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'user_id';
        hiddenField.value = userId;
        form.appendChild(hiddenField);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>