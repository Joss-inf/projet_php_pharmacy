document.getElementById("sendMessage").addEventListener("click", function () {
    const message = document.getElementById("message").value;

    if (message.trim() === "") {
        alert("Le message ne peut pas être vide !");
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", `message.php`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById("message").value = "";
            } else {
                alert("Erreur lors de l'envoi du message.");
            }
        }
    };
    xhr.send(`message=${encodeURIComponent(message)}`);
});