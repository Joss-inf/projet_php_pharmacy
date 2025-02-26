document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("sendMessage").addEventListener("submit", function (event) {
        
        event.preventDefault();
    
        const message = document.getElementById("message").value.trim(); // Supprime les espaces inutiles

        if (message === "") {
            alert("Le message ne peut pas être vide !");
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "messageAjax.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("message").value = ""; // Vide l'input après envoi
                        loadMessages(); // Recharge les messages pour voir le nouveau
                    } else {
                        alert("Erreur lors de l'envoi du message.");
                    }
                } catch (error) {
                    console.error("Erreur de parsing JSON:", error);
                }
            }
        };

        xhr.send("message=" + encodeURIComponent(message));
    });

    loadMessages();

    function loadMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "load_messages.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const messageBox = document.getElementById("messageBox");
                        messageBox.innerHTML = "";

                        response.messages.forEach(msg => {
                            const messageElement = document.createElement("div");
                            messageElement.classList.add("p-2", "bg-gray-200", "rounded-lg", "my-1");
                            messageElement.textContent = `${msg.timestamp} - ${msg.message}`;
                            messageBox.appendChild(messageElement);
                        });

                        messageBox.scrollTop = messageBox.scrollHeight;
                    }
                } catch (error) {
                    console.error("Erreur de parsing JSON:", error);
                }
            }
        };

        xhr.send();
    }
});
