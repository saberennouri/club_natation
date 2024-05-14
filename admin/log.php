<?php
//session_start();
include "./includes/header.php";
include "./includes/navbar.php";


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email_admin'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}



?>

<div class="container">
    <h2>Journal d'activité</h2>
    <p>Ce journal enregistre les actions des utilisateurs.</p>
    <hr>

    <?php
    // Récupérer l'email de l'utilisateur actuel
    $email = $_SESSION['email_admin'];

    // Récupérer l'action effectuée et la date actuelle
    $action = "Page visitée : log.php";
    $timestamp = date('Y-m-d H:i:s');

    // Formatage du message à enregistrer dans le journal
    $log_message = "[" . $timestamp . "] " . $email . ": " . $action . PHP_EOL;

    // Chemin vers le fichier journal
    $log_file = "activity.log";

    // Écriture du message dans le fichier journal (en mode ajout)
    file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);

    // Affichage du contenu du fichier journal
    if (file_exists($log_file)) {
        $log_content = file_get_contents($log_file);
        echo "<pre>" . $log_content . "</pre>";
    } else {
        echo "Aucune entrée dans le journal.";
    }
    ?>
</div>


