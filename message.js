document.addEventListener('DOMContentLoaded', function () {
    const messageBox = document.getElementById('messageBox');
    const sendMessageForm = document.getElementById('sendMessage');

    function loadMessages() {
        fetch('getMessage.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    messageBox.innerHTML = '';

                    data.message.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'message';
                        messageElement.innerHTML = `<strong>${message.email}</strong>: ${message.message}`;
                        messageBox.appendChild(messageElement);
                    });

                    messageBox.scrollTop = messageBox.scrollHeight;
                } else {
                    console.error('Erreur lors du chargement des messages:', data.messages);
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    loadMessages();

    document.getElementById('sendMessage').addEventListener('submit', function(event) {
        event.preventDefault();

        const messageInput = document.getElementById('message');
        const message = messageInput.value.trim();

        var formData = new FormData();
        formData.append("message", message);

        fetch('messageAjax.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.status === 200) {
                loadMessages();
                messageInput.value = '';
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => console.error('Erreur:', error));
    });

    // Optionnel: Recharger les messages toutes les X secondes
    setInterval(loadMessages, 5000); // Recharge les messages toutes les 5 secondes
});