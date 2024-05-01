<?php
session_start();
//include "./config.php";

$email=$_SESSION['email_parent'];
//echo $email;

//echo $nom;
// Connexion à la base de données
include './config.php';
// requete sql pour recupérer id role from pour le nom affiché
//$password=$_SESSION['password'];
//$nom=$_POST['nom'];
// Requête SQL
$sql = "SELECT * from utilisateurs where email='$email' ";
$result = mysqli_query($conn, $sql);

// Vérification des résultats de la requête
if (mysqli_num_rows($result)>0) {
    // Affichage des résultats
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['nom'] ;
    }
} else {
    // Gestion des erreurs
    echo "Erreur de requête : " . mysqli_error($conn);
}

// Fermeture de la connexion
mysqli_close($conn);


