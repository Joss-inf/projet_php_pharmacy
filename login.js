async function ajaxPost(postData) {
    console.log(JSON.stringify(postData))
    try {
        const response = await fetch("loginAjax.php", {
            method: "POST", // Spécifier la méthode HTTP
            headers: {
                "Content-Type": "application/json" // Spécifier le type de contenu
            },
            body: JSON.stringify(postData) // Envoyer les données sous forme JSON
        });
        if (!response.ok) {throw new Error(`Erreur HTTP ! Statut : ${response.status}`);}
        const data = await response.json();
        const { _, message } = data;
        console.log(data)
        if (message[0] === 200) {
            bgColor = 'bg-green-100';
            borderColor = 'border-green-400';
            textColor = 'text-green-700';
            setTimeout(() => {
                window.location.href = 'index.php'; // Redirection après 2 secondes
            }, 800);
        } else {
            bgColor = 'bg-red-100';
            borderColor = 'border-red-400';
            textColor = 'text-red-700';
        }

        // Créer le HTML dynamique avec les classes Tailwind
        const responseHTML = `
            <div class="${bgColor} border ${borderColor} ${textColor} px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Réponse :</strong>
                <span class="block sm:inline">${message[1]}</span>
            </div>
        `;

        // Injecter la réponse dans la div avec l'ID 'response-container'
        document.getElementById('response-container').innerHTML = responseHTML;

    }catch (error) {
    console.error("Erreur lors de la requête POST :", error);
}
}


document.getElementById('loginForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire

    // Récupérer les valeurs des champs de saisie
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const postData = {
        password: password,
        email: email,
    };
    
    try {
        await ajaxPost(postData)
    } catch (error){
        console.log(error)
    }
    
})
