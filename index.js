// Fonction pour mettre à jour le prix total en fonction de la quantité choisie
function updateTotalPrice(price, productId) {
    // Récupérer la quantité saisie par l'utilisateur
    const quantityInput = document.getElementById('quantity-' + productId);
    const quantity = parseInt(quantityInput.value, 10); // Convertir la valeur en entier

    // Vérifier que la quantité saisie est valide
    const maxQuantity = parseInt(quantityInput.max, 10); // Convertir le max en entier
    if (quantity < 1 || quantity > maxQuantity) {
        alert('La quantité doit être comprise entre 1 et ' + maxQuantity);
        return;
    }

    // Calculer le prix total
    const totalPrice = price * quantity;

    // Trouver l'élément qui affiche le prix total
    const totalPriceElement = document.getElementById('total-price-' + productId);
    
    if (totalPriceElement) {
        // Afficher le prix total
        totalPriceElement.textContent = "Prix total: " + totalPrice.toFixed(2) + " €";
    } else {
        console.error("L'élément de prix total n'a pas été trouvé pour le produit " + productId);
    }
}

function addToCart(userId, productId, pharmacyId, price, productName) {
    // Récupérer la quantité saisie par l'utilisateur
    const quantityInput = document.getElementById('quantity-' + productId);
    const quantity = parseInt(quantityInput.value, 10); // Convertir la valeur en entier

    // Vérifier que la quantité est valide
    const maxQuantity = parseInt(quantityInput.max, 10); // Convertir le max en entier
    if (quantity < 1 || quantity > maxQuantity) {
        alert('La quantité doit être comprise entre 1 et ' + maxQuantity);
        return;
    }
    console.log(userId,productId,pharmacyId,price,productName)
    // Envoi des données via fetch
    fetch('cardAjax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'add',  // L'action à effectuer, ici 'add' pour ajouter un produit
            user_id: userId,
            product_id: productId,
            pharmacy_id: pharmacyId,
            product_name: productName, // Le nom du produit ajouté
            quantity: quantity,
            price: price
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data)
        if (data.success) {
            alert('Produit ajouté au panier');
        } else {
            alert('Erreur lors de l\'ajout au panier');
        }
    })
    .catch(error => console.error('Erreur:', error));
}


