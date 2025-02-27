<?php
// Informations sur la pharmacie


$pharmacie = [
    "nom" => "Pharmacy",
    "adresse" => "123 Rue Exemple 75000 Paris, France",
    "email" => "contact@mapharmacie.fr",
    "histoire" => "Depuis plus de 10 ans, nous accompagnons nos clients en leur fournissant des conseils personnalisés et des produits de qualité.",
    "services" => [
        "Vente de médicaments sur ordonnance et en libre-service",
        "Conseils personnalisés en santé et bien-être",
        "Produits de parapharmacie et cosmétiques",
        "Vaccination et suivi médical"
    ]
];

// Fonction pour afficher une liste en HTML
function afficher_liste($elements) {
    echo "<ul>";
    foreach ($elements as $element) {
        echo "<li>" . htmlspecialchars($element) . "</li>";
    }
    echo "</ul>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - <?php echo htmlspecialchars($pharmacie['nom']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>À propos de <?php echo htmlspecialchars($pharmacie['nom']); ?></h1>
    <p>Bienvenue sur le site de <strong><?php echo htmlspecialchars($pharmacie['nom']); ?></strong>, votre référence en matière de santé et bien-être.</p>

    <h2>Notre Histoire</h2>
    <p><?php echo htmlspecialchars($pharmacie['histoire']); ?></p>

    <h2>Nos Services</h2>
    <?php afficher_liste($pharmacie['services']); ?>

    <h2>Contact</h2>
    <p>📍 Adresse : <?php echo htmlspecialchars($pharmacie['adresse']); ?></p>
    <p>📧 Email : <a href="mailto:<?php echo htmlspecialchars($pharmacie['email']); ?>"><?php echo htmlspecialchars($pharmacie['email']); ?></a></p>
</div>

</body>
</html>
