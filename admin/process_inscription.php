<?php
// Inclure le fichier de configuration de la base de données
include "./config.php";

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role'];

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête d'insertion
    $insert_query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role_id) VALUES (?, ?, ?, ?)";

    // Préparer la déclaration SQL
    $stmt = mysqli_prepare($conn, $insert_query);

    // Lier les paramètres
    mysqli_stmt_bind_param($stmt, "sssi", $nom, $email, $hashed_password, $role_id);

    // Exécuter la requête
    $result = mysqli_stmt_execute($stmt);

    if($result) {
        header("location:index.php");
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_error($conn);
    }

    // Fermer la déclaration
    mysqli_stmt_close($stmt);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
