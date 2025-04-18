document.addEventListener("DOMContentLoaded", function() {
  // Attacher un écouteur d'événements à chaque lien de suppression quand il y a une suppression
  const removeLinks = document.querySelectorAll('.remove-product');
  
  removeLinks.forEach(link => {
      link.addEventListener('click', function(event) {
          event.preventDefault();

          // Récupérer l'ID du produit à supprimer depuis l'attribut data-product-id
          const productId = this.closest('tr').getAttribute('data-product-id');
          
          // Récupérer le prix total de ce produit pour mettre à jour le total du panier
          const productTotalElement = this.closest('tr').querySelector('td:nth-child(3)'); // La colonne du total
          let productTotal = productTotalElement.textContent.trim(); // Enlever les espaces blancs
          productTotal = productTotal.replace(' €', '').replace(',', '.'); // Enlever "€" et convertir la virgule en point
          productTotal = parseFloat(productTotal); // Convertir en nombre
          console.log(productTotal);
          
          // Faire la requête AJAX pour supprimer le produit
          fetch('cardAjax.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                  action: 'remove',
                  product_id: productId
              })
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  // Supprimer le produit du DOM si la suppression est réussie
                  this.closest('tr').remove();
                   
                  // Mettre à jour le total du panier en soustrayant le prix du produit supprimé
                  updateCartTotal(-productTotal);
              }
              console.log(data.message)
              alert(data.message);
          })
          .catch(error => {
              console.error('Erreur:', error);
              alert('Une erreur est survenue. Veuillez réessayer.');
          });
      });
  });

  // Fonction pour mettre à jour le total du panier
  function updateCartTotal(amount) {
      const totalElement = document.querySelector('.text-xl.font-bold');
      let currentTotal = totalElement.textContent.replace('Total du Panier: ', '').replace(' €', '').replace(',', '.');
      currentTotal = parseFloat(currentTotal); // Assurer que la conversion se fait correctement

      // Calculer le nouveau total
      const newTotal = currentTotal + amount;

      // Mettre à jour le texte du total
      totalElement.textContent = `Total du Panier: ${newTotal.toFixed(2)} €`;
  }
});

  