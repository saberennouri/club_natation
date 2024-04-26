<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de configuration de la base de données
    include('config.php');

    // Vérifier si des athlètes ont été cochés pour valider leur présence
    if (isset($_POST['presence']) && !empty($_POST['presence'])) {
        // Boucle à travers les athlètes cochés
        foreach ($_POST['presence'] as $athlete_id) {
            // Mise à jour de l'absence de l'athlète dans la base de données
            $update_query = "UPDATE athletes SET absence = absence + 1 WHERE athlete_id = $athlete_id";
            $update_result = mysqli_query($conn, $update_query);
            if (!$update_result) {
                die("Erreur lors de la mise à jour des absences : " . mysqli_error($conn));
            }
        }

        // Redirection vers la page du tableau de bord de l'entraîneur après la validation
        header("Location: entraineur_dashboard.php");
        exit();
    } else {
        // Si aucun athlète n'a été cochée, afficher un message d'erreur
        echo "Aucun athlète n'a été sélectionné.";
    }
} else {
    // Si le formulaire n'a pas été soumis via la méthode POST, afficher un message d'erreur
    echo "Accès invalide à cette page.";
}
?>
