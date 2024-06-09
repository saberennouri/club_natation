<?php
// Inclure le fichier de configuration de la base de données
include "./config.php";

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
     $prenom=$_POST['prenom'];
     $telephone=$_POST['telephone'] ;
    // Hasher le mot de passe
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête d'insertion pour la table utilisateurs
    $insert_user_query = "INSERT INTO utilisateurs (nom,prenom, email,telephone, mot_de_passe) 
    VALUES ('$nom', '$prenom', '$email','$telephone' ,'$password')";

    // Exécuter la requête pour insérer dans la table utilisateurs
    $result_user = mysqli_query($conn, $insert_user_query);
    header("location:index.php");

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}

