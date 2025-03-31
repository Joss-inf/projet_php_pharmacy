<?php 
require "header/header.php";
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Votre Panier</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead>
          <tr class="border-b">
            <th class="py-4 px-6 text-left">Produit</th>
            <th class="py-4 px-6 text-center">Quantité</th>
            <th class="py-4 px-6 text-right">Prix Unitaire</th>
            <th class="py-4 px-6 text-right">Total</th>
            <th class="py-4 px-6"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $totalPanier = 0; // Initialiser avant la boucle pour éviter l'erreur
          if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $product):
              $total = $product['quantity'] * $product['price'];
              $totalPanier += $total;
          ?>
            <tr class="border-b hover:bg-gray-100" data-product-id="<?= $product['product_id'] ?>">
              <!-- Product details with image and name -->
              <td class="py-4 px-6 flex items-center">
                <img src="" alt="Product image">
                <span><?= htmlspecialchars($product['product_name']) ?></span>
              </td>
              <!-- Quantity -->
              <td class="py-4 px-6 text-center"><?= $product['quantity'] ?></td>
              <!-- Unit price -->
              <td class="py-4 px-6 text-right"><?= number_format($product['price'], 2) ?> €</td>
              <!-- Total price for the product -->
              <td class="py-4 px-6 text-right"><?= number_format($total, 2) ?> €</td>
              <!-- Remove item link -->
              <td class="py-4 px-6 text-right">
                <a href="#" class="text-red-500 hover:text-red-700 remove-product">Supprimer</a>
              </td>
            </tr>
          <?php 
            endforeach;
          else:
          ?>
            <tr>
              <td colspan="5" class="py-4 px-6 text-center">Votre panier est vide.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <!-- Cart total -->
      <div class="flex justify-end p-6">
        <p class="text-xl font-bold">Total du Panier: <?= number_format($totalPanier, 2) ?> €</p>
      </div>
    </div>
    <!-- Checkout button -->
    <div class="flex justify-end mt-6">
      <a href="checkout.php" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">Passer à la caisse</a>
    </div>
</div>

<?php 
require "footer/footer.php";
?>
<script src = 'card.js'></script>