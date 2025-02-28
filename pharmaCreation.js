document.getElementById('createPharma').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData();
    formData.append("message", message);

    fetch('pharmaCreationAjax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data)
        if (data.status === 200) {
            alert("pharmacie crée")
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => console.error('Erreur:', error));
});