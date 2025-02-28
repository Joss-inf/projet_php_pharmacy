document.addEventListener('DOMContentLoaded', function () {
    const addPharmacyForm = document.getElementById('addPharmacyForm');
    const pharmaciesListDiv = document.getElementById('pharmaciesList');
    const closeAddPharmacyForm = document.getElementById('closeAddPharmacyForm');
    const addPharmacyBtn = document.getElementById('addPharmacyBtn');

    function loadPharmacies() {
        fetch('dashboardAjax.php', {
            method: 'GET',  // Spécification de la méthode HTTP
            headers: {
                'Content-Type': 'application/json'  // Optionnel: définit le type de contenu attendu en réponse
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();  // On transforme la réponse en JSON
        })
        .then(data => {
            const pharmaciesListDiv = document.getElementById('pharmaciesList');  // Assurez-vous que cet élément existe dans le HTML
            let html = '';
            
            // Vérification si des pharmacies sont trouvées
            if (data.code === 200 && data.message.length > 0) {
                data.message.forEach(pharmacy => {
                    html += `
                        <div class="pharmacy-card" data-pharmacy-id="${pharmacy.id}">
                            <h3 class="font-bold">${pharmacy.name}</h3>
                            <button class="viewPharmacyBtn bg-blue-500 text-white p-2 rounded" 
                                    data-pharmacy-id="${pharmacy.id}" 
                                    data-pharmacy-name="${pharmacy.name}"
                                    data-pharmacy-email="${pharmacy.email}"
                                    data-pharmacy-phone="${pharmacy.phone}"
                                    data-pharmacy-address="${pharmacy.address}"
                                    data-pharmacy-country="${pharmacy.country}"
                                    data-pharmacy-department="${pharmacy.department}"
                                    data-pharmacy-description="${pharmacy.description}"
                                    data-pharmacy-isvalid="${pharmacy.is_valid}">
                                Voir Détails
                            </button>
                            <button class="deletePharmacyBtn bg-red-500 text-white p-2 rounded">Supprimer</button>
                        </div>
                    `;
                });
            } else {
                html = '<p>Aucune pharmacie trouvée.</p>';
            }
    
            pharmaciesListDiv.innerHTML = html;  // Affichage des pharmacies ou du message d'aucune pharmacie
    
            // Ajouter l'événement de clic pour "Voir Détails"
            document.querySelectorAll('.viewPharmacyBtn').forEach(button => {
                button.addEventListener('click', (event) => {
                    const pharmacyData = event.target.dataset;
                    showPharmacyDetails(pharmacyData);
                });
            });
    
        })
        .catch(error => {
            console.error('Erreur lors de la requête GET:', error);
        });
    }
    
    // Fonction pour afficher les détails de la pharmacie dans un modal
    function showPharmacyDetails(pharmacyData) {
        // Affichage des détails dans un modal
        const modal = document.getElementById('pharmacyDetailsModal')
        modal.innerHTML = `
            <div class="modal-content bg-white rounded-xl shadow-2xl w-96 p-8 relative space-y-2 ">
                <h2 class="text-2xl font-medium text-gray-700">${pharmacyData.pharmacyName}</h2>
                <p><strong class="font-medium text-gray-700">Email:</strong> <span class="text-gray-600">${pharmacyData.pharmacyEmail}</span></p>
                <p><strong class="font-medium text-gray-700">Téléphone:</strong> <span class="text-gray-600">${pharmacyData.pharmacyPhone}</span></p>
                <p><strong class="font-medium text-gray-700">Adresse:</strong> <span class="text-gray-600">${pharmacyData.pharmacyAddress}</span></p>
                <p><strong class="font-medium text-gray-700">Pays:</strong> <span class="text-gray-600">${pharmacyData.pharmacyCountry}</span></p>
                <p><strong class="font-medium text-gray-700">Département:</strong> <span class="text-gray-600">${pharmacyData.pharmacyDepartment}</span></p>
                <p><strong class="font-medium text-gray-700">Description:</strong> <span class="text-gray-600">${pharmacyData.pharmacyDescription}</span></p>
                <p><strong class="font-medium text-gray-700">Valide:</strong> <span class="text-gray-600">${pharmacyData.pharmacyIsvalid ? 'Oui' : 'Non'}</span></p>
                <button id="closeModal" class="bg-red-500 text-white p-2 rounded mt-4">Fermer</button>
            </div>
        `;
    
        // Affichage du modal
        modal.classList.remove('hidden');
    
        // Ajouter un événement pour fermer le modal
        document.getElementById('closeModal').addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }
    
    

    // Afficher les détails de la pharmacie (produits, logs)
    pharmaciesListDiv.addEventListener('click', (e) => {

        // Supprimer une pharmacie
        if (e.target.classList.contains('deletePharmacyBtn')) {
            const pharmacyId = e.target.closest('.pharmacy-card').dataset.pharmacyId;
            deletePharmacy(pharmacyId);
        }
    });

    // Charger les détails de la pharmacie (produits et logs)
    

    // Fonction pour supprimer une pharmacie
    function deletePharmacy(pharmacyId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette pharmacie ?')) {
            fetch('dashboardAjax.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'deletePharmacy',
                    id: pharmacyId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.code === 200) {
                    loadPharmacies(); // Recharger la liste des pharmacies
                } else {
                    alert('Erreur lors de la suppression de la pharmacie');
                }
            });
        }
    }

    // Charger la liste des pharmacies dès que la page est prête
    loadPharmacies();

// Afficher le formulaire d'ajout de pharmacie
addPharmacyBtn.addEventListener('click', () => {
    addPharmacyForm.classList.remove('hidden');
});

// Fermer le formulaire d'ajout de pharmacie
closeAddPharmacyForm.addEventListener('click', () => {
    addPharmacyForm.classList.add('hidden');
});

// Soumettre le formulaire pour ajouter une pharmacie
document.getElementById('addPharmacyFormSubmit').addEventListener('submit', (e) => {
    e.preventDefault();
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;  // Ajout du téléphone
    const address = document.getElementById('address').value;
    const country = document.getElementById('country').value;
    const department = document.getElementById('department').value;
    const is_valid = document.getElementById('is_valid').checked;
    const description = document.getElementById('description').value;

    console.log(name, email, phone, address, country, department, is_valid, description);

    fetch('dashboardAjax.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'addPharmacy',
            name: name,
            email: email,
            phone: phone,  // Envoi du numéro de téléphone
            address: address,
            country: country,
            department: department,
            is_valid: is_valid,
            description: description
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.code === 200) {
            loadPharmacies(); // Recharger les pharmacies
            addPharmacyForm.classList.add('hidden'); // Fermer le formulaire
        } else {
            alert('Erreur lors de l\'ajout de la pharmacie');
        }
    });
});



});