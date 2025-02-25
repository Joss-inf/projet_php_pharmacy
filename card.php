<?php 

require "header/header.php"

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
          <tr class="border-b hover:bg-gray-100">
            <!-- Product details with image and name -->
            <td class="py-4 px-6 flex items-center">
              <img src="">
              <span>Doliprane</span>
            </td>
            <!-- Quantity -->
            <td class="py-4 px-6 text-center">2</td>
            <!-- Unit price -->
            <td class="py-4 px-6 text-right">20 €</td>
            <!-- Total price for the product -->
            <td class="py-4 px-6 text-right">40 €</td>
            <!-- Remove item link (implementation needed) -->
            <td class="py-4 px-6 text-right">
              <a href="" class="text-red-500 hover:text-red-700">Supprimer</a>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- Cart total -->
      <div class="flex justify-end p-6">
        <p class="text-xl font-bold">Total du Panier: €</p>
      </div>
    </div>
    <!-- Checkout button -->
    <div class="flex justify-end mt-6">
      <a href="checkout.php" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Passer à la caisse</a>
    </div>
  </div>
<?php 

require "footer/footer.php"

?>