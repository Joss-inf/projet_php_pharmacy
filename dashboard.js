document.addEventListener('DOMContentLoaded', function () {
    const addPharmacyForm = document.getElementById('addPharmacyForm');
    const pharmaciesListDiv = document.getElementById('pharmaciesList');
    const closeAddPharmacyForm = document.getElementById('closeAddPharmacyForm');
    const addPharmacyBtn = document.getElementById('addPharmacyBtn');

    function loadPharmacies() {
        fetch('dashboardAjax.php?action=getPharmacies', {
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
                        <div class="pharmacy-card shadow-[4px_4px_30px_0px_#718096] p-4" data-pharmacy-id="${pharmacy.id}">
                            <h3 class="font-bold">${pharmacy.name}</h3>
                        <div class="flex w-full gap-2">
                            <button class="viewPharmacyBtn flex-1 bg-blue-500 text-white p-2 rounded text-center" 
                                    data-pharmacy-id="${pharmacy.id}" 
                                    data-pharmacy-name="${pharmacy.name}"
                                    data-pharmacy-email="${pharmacy.email}"
                                    data-pharmacy-phone="${pharmacy.phone}"
                                    data-pharmacy-address="${pharmacy.address}"
                                    data-pharmacy-country="${pharmacy.country}"
                                    data-pharmacy-department="${pharmacy.department}"
                                    data-pharmacy-description="${pharmacy.description}"
                                    data-pharmacy-isvalid="${pharmacy.is_valid}"
                                    data-pharmacy-users='${JSON.stringify(pharmacy.users)}'>
                                Voir Détails
                            </button>
                            <button class="deletePharmacyBtnflex-1 bg-red-500 text-white p-2 rounded text-center">Supprimer</button>
                        </div>
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
    function loadUsers() {
        fetch('dashboardAjax.php?action=getUsers', {
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
            const UsersListDiv = document.getElementById('usersList');  // Assurez-vous que cet élément existe dans le HTML
            let html = '';
            console.log(data.message)
            // Vérification si des pharmacies sont trouvées
            if (data.code === 200 && data.message.length > 0) {
                data.message.forEach(user => {
                    // Création de l'HTML de base pour chaque utilisateur
                    html += `
    <div class="user-card shadow-[4px_4px_30px_0px_#718096] p-4" data-user-id="${user.id}">
        <h3 class="font-bold">${user.email}</h3> <!-- Affiche l'email de l'utilisateur -->
        <p class="text-sm text-gray-600">
            Role: 
            ${user.role === 1 ? 'Employé' :
            user.role === 2 ? 'Directeur' :
            user.role === 0 ? 'Client' : 
            user.role === 3 ? 'Admin' : 'N/A'}
        </p>
        <p class="text-sm text-gray-600">User ID: ${user.id}</p>
        
        <!-- Affiche l'utilisateur avec le nom de la pharmacie -->
        <p class="text-sm text-gray-600">
            <strong>Nom de la Pharmacie : </strong> 
            ${user.pharmacy_name ? `${user.pharmacy_name}` : 'Aucune pharmacie associée'}
        </p>
        
        <!-- Affichage des informations directement dans la div -->
        <p class="text-sm text-gray-600"><strong>Email:</strong> ${user.email}</p>
        <p class="text-sm text-gray-600"><strong>Role:</strong> 
            ${user.role === 1 ? 'Employé' :
            user.role === 2 ? 'Directeur' :
            user.role === 0 ? 'Client' : 
            user.role === 3 ? 'Admin' : 'N/A'}
        </p>
        <p class="text-sm text-gray-600"><strong>User ID:</strong> ${user.id}</p>
        <p class="text-sm text-gray-600"><strong>Pharmacy ID:</strong> ${user.pharmacy_id}</p>
        <p class="text-sm text-gray-600"><strong>Nom de la Pharmacie:</strong> ${user.pharmacy_name || 'Aucune pharmacie associée'}</p>
     
    </div>
    `;

                });
            } else {
                html = '<p>Aucun utilisateur trouvé.</p>';
            }
        
            UsersListDiv.innerHTML = html; // Affichage des pharmacies ou du message d'aucune pharmacie
    
        })
        .catch(error => {
            console.error('Erreur lors de la requête GET:', error);
        });
    }
    // Charger la liste  dès que la page est prête
    loadPharmacies();
    loadUsers();
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