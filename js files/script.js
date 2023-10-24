// Fonction pour afficher le formulaire
function addProducts() {
    // Créer un élément <iframe> pour afficher le formulaire
    var iframe = document.createElement('iframe');
    iframe.src = 'form.html'; // Remplacez 'form.html' par le nom de votre fichier HTML de formulaire
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.position = 'fixed';
    iframe.style.top = '0';
    iframe.style.left = '0';
    iframe.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    iframe.style.zIndex = '1000';
    iframe.style.border = 'none';
  
    // Ajouter l'élément <iframe> au corps du document
    document.body.appendChild(iframe);
  }
  function showForm() {
    var form = document.getElementById('productForm');
    form.style.opacity = '1';
    form.style.display = 'block';
  }
  