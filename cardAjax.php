<?php
session_start();

// Récupérer les données JSON envoyées via AJAX
$requestData = json_decode(file_get_contents('php://input'), true);

// Vérifier si une action a été spécifiée
if (isset($requestData['action'])) {
    $action = $requestData['action'];

    // Ajouter un produit au panier
    if ($action == 'add') {
        if (isset($requestData['product_id'], $requestData['product_name'], $requestData['quantity'], $requestData['price'])) {
            $productList = [
                'product_id' => $requestData['product_id'],
                'product_name' => $requestData['product_name'],
                'quantity' => $requestData['quantity'],
                'price' => $requestData['price']
            ];

            // Vérifier si le panier existe dans la session
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Vérifier si le produit existe déjà dans le panier, si oui, on met à jour la quantité
            $found = false;
            foreach ($_SESSION['cart'] as &$product) {
                if ($product['product_id'] == $productList['product_id']) {
                    $product['quantity'] += $productList['quantity'];  // Mise à jour de la quantité
                    $found = true;
                    break;
                }
            }

            // Si le produit n'est pas trouvé, on l'ajoute au panier
            if (!$found) {
                $_SESSION['cart'][] = $productList;
            }

            echo json_encode(['success' => true, 'message' => 'Produit ajouté au panier!']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Données manquantes pour l\'ajout au panier.']);
            exit;
        }
    }

    // Supprimer un produit du panier
    elseif ($action == 'remove') {
        if (isset($requestData['product_id'])) {
            $productIdToRemove = $requestData['product_id'];

            // Vérifier si le panier existe dans la session
            if (isset($_SESSION['cart'])) {
                // Parcourir le panier pour trouver le produit à supprimer
                foreach ($_SESSION['cart'] as $key => $product) {
                    if ($product['product_id'] == $productIdToRemove) {
                        unset($_SESSION['cart'][$key]);  // Supprimer le produit du panier
                        $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexer les éléments du tableau
                        echo json_encode(['success' => true, 'message' => 'Produit supprimé du panier']);
                        exit;
                    }
                }
            }

            echo json_encode(['success' => false, 'message' => 'Produit non trouvé dans le panier']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Aucun produit spécifié pour suppression']);
            exit;
        }
    }

    // Afficher le panier
    elseif ($action == 'view') {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Le panier est vide.']);
            exit;
        }
    }

    // Si l'action n'est pas valide
    else {
        echo json_encode(['success' => false, 'message' => 'Action non valide.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucune action spécifiée.']);
    exit;
}
?>

