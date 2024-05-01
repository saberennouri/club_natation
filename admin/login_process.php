<?php
session_start();
// Inclure le fichier de configuration de la base de données
include('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
   

    // Préparer la requête SQL pour récupérer l'utilisateur et son rôle
    $sql = "SELECT u.utilisateur_id, u.nom, u.email, u.mot_de_passe, r.role_id, r.nom AS role_nom
    FROM utilisateurs u    
    INNER JOIN roles r ON u.role_id = r.role_id
    WHERE u.email = '$email' AND u.mot_de_passe = '$password'";

    
    // Exécuter la requête SQL
    $result = mysqli_query($conn, $sql);

    // Vérifier si des résultats ont été renvoyés
    if (mysqli_num_rows($result) == 1) {
        // L'utilisateur est authentifié avec succès
        // Récupérer les données de l'utilisateur et son rôle
        $row = mysqli_fetch_assoc($result);
        $role = $row['role_nom'];
        //echo $role;
        // Rediriger vers la page appropriée en fonction du rôle
        switch ($role) {
            case 'administrateur':
                header("Location: admin_dashboard.php");
                $_SESSION['email_admin']=$row['email'];
                break;
            case 'entraineur':
                header("Location: entraineur_dashboard.php");
                $_SESSION['email_entraineur']=$row['email'];
                break;
            case 'parent':
                header("Location: parent_dashboard.php");
                
                $_SESSION['email_parent']=$row['email'];
                break;
            default:
                // Gérer une erreur de rôle invalide
                die("Rôle invalide");
                break;
        }
    } else {
        // L'authentification a échoué
        // Rediriger vers la page de connexion avec un message d'erreur
        header("Location: login.php?error=1");
    }
} else {
    // Rediriger vers la page de connexion si le formulaire n'a pas été soumis
    header("Location: login.php");
}
?>
