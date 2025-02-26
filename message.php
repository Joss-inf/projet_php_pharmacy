<?php 
require "header/header.php";
?>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Main content container -->
    <div class="flex-1 flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex flex-col h-[80vh] m-10">
            
            <!-- Nom de la pharmacie en haut de la fenêtre de messagerie -->
            <div class="p-4 bg-green-600 text-white text-center text-lg font-semibold">
                Messagerie de la pharmacie
            </div>
            
            <!-- Zone des messages -->
            <div id="messageBox" class="p-4 flex-1 overflow-y-auto space-y-4">
                <!-- Messages ici -->
            </div>

            <!-- Formulaire d'envoi avec méthode POST -->
            <form action="" id="sendMessage" method="POST" class="p-4 border-t flex items-center">
                <input type="text" id="message" name="message" placeholder="Écrivez un message..." class="flex-1 p-2 border rounded-lg outline-none" required>
                <button type="submit" class="ml-2 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Envoyer</button>
            </form>
        </div>
    </div>
</body>

<?php 
require "footer/footer.php"
?>

<script src="message.js"></script>
