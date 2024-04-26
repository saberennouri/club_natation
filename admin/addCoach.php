<?php
include 'config.php';

// Ajouter un entraineur
if(isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $numero_telephone = $_POST['numero_telephone'];
    //$competence_id = $_POST['competence_id']; // Supposons que vous avez un champ pour sélectionner l'ID de la compétence

    // Requête SQL pour insérer un nouvel entraîneur dans la base de données
    $query = "INSERT INTO entraineurs (prenom, nom, email, numero_telephone) 
    VALUES ('$prenom', '$nom', '$email', '$numero_telephone')";
    $result = mysqli_query($conn, $query);

        if(!$result) {
            die("Erreur d'ajout d'entraineur: " . mysqli_error($conn));
        }
        header("Location: coachs.php");
        // Fermeture de la connexion
        mysqli_close($conn);
    }   

?>