<?php 

require "header/header.php"

?>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Conteneur principal -->
    <div class="max-w-4xl mx-auto my-16 p-8 bg-white shadow-lg rounded-lg">
        <!-- Titre -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Nous Contacter</h1>
        <h3 class="text-1xl text-center text-gray-800 mb-8">(Merci de renseigner votre numéro de téléphone ou votre email dans votre message)</h3>
        
        <!-- Formulaire de contact -->
        <form action="#" method="POST">
            <div class="grid gap-6">
                <input type="text" id="searchInput" placeholder="Nom de la pharmacie" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                <div id="pharmacyEmail"></div>

                <div>
                    <label for="object" class="block text-lg font-medium text-gray-700">Objet :</label>
                    <input type="text" id="name" name="name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <div>
                    <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="6" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <button type="submit" class="px-6 py-3 text-lg font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-md shadow-md transition duration-200">Envoyer</button>
            </div>
        </form>
    </div>
</body>


<?php 

require "footer/footer.php"

?>