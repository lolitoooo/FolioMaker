
$(document).ready(function() {
    $('#userTable').DataTable({
        "language": {
            "lengthMenu": "Afficher _MENU_ entrées par page",
            "zeroRecords": "Aucun enregistrement trouvé",
            "info": "Affichage de la page _PAGE_ de _PAGES_",
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
