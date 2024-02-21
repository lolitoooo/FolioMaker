const defaultHtml = '<div class="default-block">Contenu par défaut</div>';
const defaultCss = '.default-block { background-color: #f0f0f0; padding: 20px; }';
function createDefaultPage() {
    const pageData = {
        title: 'Nouvelle Page',
        html: defaultHtml,
        css: defaultCss,
        js: '' // Vous pouvez ajouter du JavaScript par défaut ici si nécessaire
    };

    fetch('/dashboard/save-page', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(pageData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de la sauvegarde de la page');
        }
        console.log('Page créée et enregistrée avec succès');
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
    