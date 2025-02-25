<?php 

require "header/header.php";

?>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-4xl mx-auto my-16 p-8 bg-white shadow-lg rounded-lg">

        <h1 class="text-5xl font-bold text-center text-gray-800 mb-2">Nous Contacter</h1>
        <h3 class="text-1xl text-center text-gray-800 mb-5">Merci de bien vouloir formuler votre message de manière claire et professionnelle afin de garantir un traitement rapide et efficace de votre demande.</h3>
        
        <form action="https://formspree.io/f/xldgyall" method="POST">
            <div class="mt-4">
                <input type="text" name="Mail" type="email" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Mail">
            </div>

            <div class="mt-4">
                <input type="text" name="phone" type="tel" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Numéro De Téléphone">
            </div>

            <div class="mt-10">
                <label for="objet" class="block text-lg font-medium text-gray-700">Objet :</label>
                <input type="text" name="Object" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mt-6">
                <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                <textarea id="message" rows="6" name="text" required class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mt-7 text-center">
                <button type="submit" class="px-6 py-3 text-lg font-semibold text-white bg-green-600 hover:bg-green-700 rounded-md shadow-md transition duration-200">Envoyer</button>
            </div>
        </form>
    </div>
</body>


<?php 

require "footer/footer.php"

?>