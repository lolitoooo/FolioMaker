import grapesjs from 'grapesjs';
import blocks from 'grapesjs-blocks-basic';

const editor = grapesjs.init({
  container : '#gjs',
  height: '100vh',
  type: 'remote',
    stepsBeforeSave: 1,        // Store data automatically
    autoload: true,
    urlStore: 'save.php',
    urlLoad: 'load.php',
    params: { page_id: 11111 },
    contentTypeJson: true,
    storeComponents: true,
    storeStyles: true,
    storeHtml: true,
    storeCss: true,
     headers: {
    'Content-Type': 'application/json'
    },
  plugins: [blocks],
  pluginsOpts: {
    blocks: {}
  },
});
editor.on('storage:load', function(e) {
  console.log('Loaded ', e);
})
editor.on('storage:store', function(e) {
  console.log('Stored ', e);
})
const pagesWrapper = document.querySelector('.pages-wrp');
const pm = editor.Pages;

// Ajout du bouton pour ajouter une page
const addButton = document.getElementById('add-page');
addButton.addEventListener('click', addPage);

const saveButton = document.getElementById('save-page');
saveButton.addEventListener('click', function() {
  // Exécute la sauvegarde et gère les erreurs potentielles
  editor.store().then(response => {
    console.log('Sauvegarde réussie !', response);
  }).catch(error => {
    console.error('Erreur lors de la sauvegarde :', error);
  });
});

// ...


function setPages(pages) {
    pagesWrapper.innerHTML = ''; // Clear existing pages
    pagesWrapper.appendChild(addButton);
    pages.forEach(page => {
        const pageDiv = document.createElement('div');
        pageDiv.textContent = page.get('name') || page.id;
        pageDiv.classList.add('page');
        if (isSelected(page)) {
            pageDiv.classList.add('selected');
        }
        pageDiv.addEventListener('click', () => selectPage(page.id));
        const closeButton = document.createElement('span');
        closeButton.textContent = '✕';
        closeButton.classList.add('page-close');
        closeButton.addEventListener('click', () => console.log(editor.getHtml()));
        pageDiv.appendChild(closeButton);
        pagesWrapper.appendChild(pageDiv);
    });
    pagesWrapper.appendChild(saveButton);
}

function isSelected(page) {
    return pm.getSelected().id == page.id;
}

function selectPage(pageId) {
    pm.select(pageId);
    setPages(pm.getAll());
}

function removePage(pageId) {
    pm.remove(pageId);
    setPages(pm.getAll());
}

function addPage() {
  const len = pm.getAll().length;
  pm.add({
      name: `Page ${len + 1}`,
      component: '<div>Nouvelle page</div>',
  });
}

// Initial setup
setPages(pm.getAll());
editor.on('page', () => {
    setPages(pm.getAll());
});
