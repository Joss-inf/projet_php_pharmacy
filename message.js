document.addEventListener('DOMContentLoaded', function () {
    const messageInput = document.getElementById('message');

    document.getElementById('sendMessage').addEventListener('submit', function(event) {
        event.preventDefault();

        const message = messageInput.value.trim();

        if (!message) {
            alert("Le champ message est vide !");
            return;
        }

        var formData = new FormData();
        formData.append("message", message);

        fetch('messageAjax.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  // Parse la réponse en JSON
        .then(data => {
            console.log("Réponse JSON du serveur:", data);
            if (data.status === 200) {
                alert("Message envoyé avec succès !");
                messageInput.value = '';  // Vide le champ de message
            } else {
                alert("Erreur: " + data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    });
});