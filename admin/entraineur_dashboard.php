<?php
session_start(); // Démarrer la session

include('config.php');

// Vérifier si l'ID de l'entraîneur est défini dans la session
if(isset($_SESSION['entraineur_id'])) {
    $entraineur_id = $_SESSION['entraineur_id']; // Récupérer l'ID de l'entraîneur à partir de la session
    
    // Récupérer les données de l'entraîneur à partir de la base de données
    $sql = "SELECT * FROM entraineurs WHERE entraineur_id = $entraineur_id";
    $result = mysqli_query($conn, $sql);
    
    // Vérifier si des données ont été trouvées
    if(mysqli_num_rows($result) > 0) {
        $entraineur = mysqli_fetch_assoc($result);
        
        // Traitement du formulaire s'il est soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST['athlete_id'] as $athlete_id) {
                $absent = isset($_POST['absent'][$athlete_id]) ? 1 : 0;
                // Insérer ou mettre à jour l'absence de l'athlète dans la base de données
                $sql_update = "INSERT INTO athletes_absences (athlete_id, absent) VALUES ($athlete_id, $absent) ON DUPLICATE KEY UPDATE absent = $absent";
                mysqli_query($conn, $sql_update);
            }
        }
    } else {
        echo "Aucun entraîneur trouvé avec cet ID.";
    }
} else {
    echo "ID de l'entraîneur non défini dans la session.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord de l'entraîneur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Bienvenue <?php echo $entraineur['prenom'] . ' ' . $entraineur['nom']; ?> sur votre tableau de bord</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Profil de l'entraîneur</h3>
                <p><strong>Nom:</strong> <?php echo $entraineur['nom']; ?></p>
                <p><strong>Prénom:</strong> <?php echo $entraineur['prenom']; ?></p>
                <p><strong>Email:</strong> <?php echo $entraineur['email']; ?></p>
                <!-- Ajoutez d'autres détails du profil de l'entraîneur ici -->
            </div>
            <div class="col-md-6">
                <h3>Vos athlètes</h3>
                <form method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom de l'athlète</th>
                                <th>Absent</th>
                                <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Exemple de récupération des athlètes de l'entraîneur à partir de la base de données
                            $sql = "SELECT * FROM athletes WHERE entraineur_id = $entraineur_id";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($athlete = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $athlete['nom'] . "</td>";
                                    echo "<td><input type='checkbox' name='absent[" . $athlete['athlete_id'] . "]'></td>";
                                    // Ajoutez d'autres cellules de données si nécessaire
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>Aucun athlète n'est attribué à cet entraîneur.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Enregistrer les absences</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
