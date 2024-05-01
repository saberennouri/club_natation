<?php
// Démarrage de la session
session_start();

// Récupérer le nom d'utilisateur pour afficher dans la barre de navigation
$nom_utilisateur = $_POST['nom'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Ajoutez vos styles de navbar ici -->
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?php echo $dashboard_link; ?>">Tableau de bord</a></li>
            <li><?php echo $nom_utilisateur; ?></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</body>
</html>
