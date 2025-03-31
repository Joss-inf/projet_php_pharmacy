document.addEventListener('DOMContentLoaded', function () {
    const messageBox = document.getElementById('messageBox');
    const pharmacyName = document.getElementById('pharmacyName');

    function loadMessages() {
        fetch('getMessage.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    messageBox.innerHTML = '';
                    pharmacyName.innerHTML = '';

                    let pharmacy = data.message[0].name;
                    const pharmacyElement = document.createElement('h2');
                    pharmacyElement.innerHTML = `${pharmacy}`;
                    pharmacyName.appendChild(pharmacyElement);

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

    setInterval(loadMessages, 5000); // recharge the message every 5 sec
});