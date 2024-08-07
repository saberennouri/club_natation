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
$sqlentraineur = "SELECT entraineur_id FROM entraineurs WHERE email = ?";
$stmtentraineur = $conn->prepare($sqlentraineur);
$stmtentraineur->bind_param("s", $email);
$stmtentraineur->execute();
$resultentraineur = $stmtentraineur->get_result();

if ($resultentraineur->num_rows > 0) {
    $row_entraineur = $resultentraineur->fetch_assoc();
    $entraineur_id = $row_entraineur['entraineur_id'];
    $_SESSION['entraineur_id'] = $entraineur_id;

    // Préparation de la requête pour récupérer les athlètes associés à l'entraîneur avec jointure
    $sqlathlete = "SELECT athlete_id, prenom, nom FROM athletes WHERE entraineur_id = ?";
    $stmtathlete = $conn->prepare($sqlathlete);
    $stmtathlete->bind_param("i", $entraineur_id);
    $stmtathlete->execute();
    $resultathlete = $stmtathlete->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Entraîneur Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Entraîneur Dashboard</h2>
    <h3 class="mt-4">Athlètes</h3>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultathlete->num_rows > 0) {
                while ($row = $resultathlete->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['athlete_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prenom']) . " " . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td>
                            <a href='view_athlete.php?athlete_id=" . htmlspecialchars($row['athlete_id']) . "' class='btn btn-primary btn-sm'>View</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No athletes found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include "./includes/footer.php";?>
</div>

<?php
} else {
    echo "No entraîneur found.";
}


$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

