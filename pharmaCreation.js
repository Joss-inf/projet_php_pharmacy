document.getElementById('createPharma').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('pharmaCreationAjax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.text(); // Affichez la réponse brute
    })
    .then(text => {
        console.log("Réponse brute du serveur :", text); // Affichez la réponse
        return JSON.parse(text); // Essayez de parser en JSON
    })
    .then(data => {
        if (data.status === 200) {
            alert("Pharmacie créée avec succès");
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur s\'est produite. Veuillez réessayer.');
    });
});