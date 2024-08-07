<?php
session_start();
include "./includes/navTrainer.php";
include "./includes/header.php";
include "./config.php";

// Vérification de la session et de la connexion à la base de données
if (!isset($_SESSION['email_entraineur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Vérification de la présence de l'ID de l'équipe dans l'URL
if (!isset($_GET['equipe_id']) || empty($_GET['equipe_id'])) {
    // Rediriger vers la page d'accueil si l'ID de l'équipe n'est pas présent
    header("Location: dashboard.php");
    exit;
}

$equipe_id = intval($_GET['equipe_id']);

// Préparation de la requête pour récupérer les informations de l'équipe et les athlètes associés
$sqlathletes = "SELECT 
                    a.athlete_id, 
                    a.prenom, 
                    a.nom, 
                    a.date_naissance, 
                    a.sexe, 
                    a.parent_id, 
                    a.entraineur_id, 
                    a.absence, 
                    me.id_membre, 
                    me.id_equipe, 
                    me.date_affiliation,
                    e.nom as nom_equipe

                FROM 
                    athletes a 
                JOIN 
                    membre_equipe me ON a.athlete_id = me.id_athlete 
                JOIN equipe e ON e.id_equipe =me.id_equipe
                WHERE 
                    me.id_equipe = ?";
$stmtathletes = $conn->prepare($sqlathletes);
$stmtathletes->bind_param("i", $equipe_id);
$stmtathletes->execute();
$resultathletes = $stmtathletes->get_result();

if ($resultathletes->num_rows > 0) {
    $row_athlete = $resultathletes->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'équipe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center">Détails de l'équipe</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nom de l'équipe</th>
            <td><?php echo htmlspecialchars($row_athlete['nom_equipe']); ?></td>
        </tr>
    </table>

    <h3>Athlètes affiliés</h3>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de Naissance</th>
                <th>Sexe</th>
                <th>Parent ID</th>
                <th>Entraîneur ID</th>
                <th>Absence</th>
                <th>ID Membre</th>
                <th>Date d'affiliation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            do {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_athlete['athlete_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['date_naissance']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['sexe']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['parent_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['entraineur_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['absence']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['id_membre']) . "</td>";
                echo "<td>" . htmlspecialchars($row_athlete['date_affiliation']) . "</td>";
                echo "</tr>";
            } while ($row_athlete = $resultathletes->fetch_assoc());
            ?>
        </tbody>
    </table>
    <a href="entraineur_dashboard.php" class="btn btn-primary">Retour au Dashboard</a>
    <?php include "./includes/footer.php"; ?>
</div>

</body>
</html>

<?php
} else {
    echo "No athletes found for the selected team.";
}

$conn->close();
?>
