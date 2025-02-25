<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-green-100 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white rounded-xl shadow-md p-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Profil Utilisateur</h2>
        <form class="mt-4 space-y-4">
            <!-- profil picture -->
            <!-- Profile Picture Upload -->
            <div>
                <label for="profile-picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" id="profile-picture" class="mt-1 w-full border border-gray-300 rounded-lg p-2" />
            </div>

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your name" />
            </div>

            <!-- Surname Field -->
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" id="surname" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your surname" />
            </div>

            <!-- Date of Birth Field -->
            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="dob" class="mt-1 w-full border border-gray-300 rounded-lg p-2" />
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your email" />
            </div>

            <!-- Phone Number Field -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Enter your phone number" />
            </div>

            
            <!-- Bouton d'enregistrement -->
            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition">
                Enregistrer
            </button>
        </form>
    </div>
</body>
</html>
