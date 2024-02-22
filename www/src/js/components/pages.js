const defaultHtml = '<div class="default-block">Contenu par défaut</div>';
const defaultCss = '.default-block { background-color: #f0f0f0; padding: 20px; }';
function createDefaultPage(title) {
    const pageData = {
        title: `${title}`,
        html: defaultHtml,
        css: defaultCss,
        js: '',
        path: `/${title}` // Vous pouvez ajouter du JavaScript par défaut ici si nécessaire
    };

    fetch('/dashboard/create-page', {
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
function createPage() {
    const title = document.getElementById('pageTitle').value;
    // Assurez-vous que le titre n'est pas vide
    if (title.trim() === '') {
        alert('Veuillez entrer un titre pour la page.');
        return;
    }
    createDefaultPage(title);
}

const createPageBtn = document.getElementById('create-page')
createPageBtn.addEventListener('click', () => createPage())

function displayPages() {}
function editPage() {}
function deletePage () {}