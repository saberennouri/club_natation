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

$email = mysqli_real_escape_string($conn, $_SESSION['email_entraineur']);

// Préparation de la requête pour récupérer les informations de l'entraîneur
$sqlentraineur = "SELECT entraineur_id, prenom, nom, email, numero_telephone FROM entraineurs WHERE email = ?";
$stmtentraineur = $conn->prepare($sqlentraineur);
$stmtentraineur->bind_param("s", $email);
$stmtentraineur->execute();
$resultentraineur = $stmtentraineur->get_result();

if ($resultentraineur->num_rows > 0) {
    $row_entraineur = $resultentraineur->fetch_assoc();
    $entraineur_id = $row_entraineur['entraineur_id'];
    $_SESSION['entraineur_id'] = $entraineur_id;

    // Préparation de la requête pour récupérer les équipes associées à l'entraîneur avec jointure
    $sqlequipes = "SELECT e.id_equipe, e.nom, e.description 
                   FROM equipe e 
                   JOIN membre_equipe me ON e.id_equipe = me.id_equipe
                   JOIN entraineurs en ON me.id_athlete = en.entraineur_id
                   WHERE en.entraineur_id = ?";
    $stmtequipes = $conn->prepare($sqlequipes);
    $stmtequipes->bind_param("i", $entraineur_id);
    $stmtequipes->execute();
    $resultequipes = $stmtequipes->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Entraîneur Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center">Entraîneur Dashboard</h2>
    <h3>Équipes</h3>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultequipes->num_rows > 0) {
                while ($row = $resultequipes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_equipe']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>
                            <a href='view_equipes.php?equipe_id=" . htmlspecialchars($row['id_equipe']) . "'>View</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No teams found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include "./includes/footer.php";?>
</div>

<?php

} else {
    echo "No entraineur found.";
}

$conn->close();
?>
</body>
</html>
