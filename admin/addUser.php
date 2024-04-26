<?php
include 'config.php';

// Ajouter un utilisateur
if (isset($_POST['ajouter'])) {

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['mot_de_passe'];
    $role_name = $_POST['role']; // Récupérez le nom du rôle à partir du formulaire




    // Requête pour récupérer l'ID du rôle à partir de son nom
    $getRoleIdQuery = "SELECT role_id FROM roles WHERE nom = '$role_name'";
    $result = $conn->query($getRoleIdQuery);

    if ($result->num_rows > 0) {
        // Récupération de l'ID du rôle
        $row = $result->fetch_assoc();
        $role_id = $row["role_id"];

        // Requête d'insertion de l'utilisateur
        $insertUserQuery = "INSERT INTO utilisateurs (nom,email,mot_de_passe, role_id) VALUES ('$nom','$email','$mdp', '$role_id')";

        if ($conn->query($insertUserQuery) === TRUE) {
            header('Location:utilisateurs.php');
        } else {
            echo "Erreur lors de la création de l'utilisateur: " . $conn->error;
        }
    } else {
        echo "Le rôle spécifié n'existe pas";
    }

    // Fermeture de la connexion
    $conn->close();
}
?>