<?php
session_start();
include "./includes/navTrainer.php";
include "./includes/header.php";
include "./config.php";

if (!isset($_SESSION['email_entraineur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}
$athlete_id = $_GET['athlete_id'];

// Récupérer les informations de l'athlète
$sql_athlete = "SELECT * FROM athletes WHERE athlete_id = '$athlete_id'";
$result_athlete = $conn->query($sql_athlete);
$athlete = $result_athlete->fetch_assoc();

// Récupérer les conditions physiques de l'athlète
$sql_conditions = "SELECT * FROM physical_conditions WHERE athlete_id = '$athlete_id'";
$result_conditions = $conn->query($sql_conditions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Athlete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center">Athlete Details</h2>
    <h3>Personal Information</h3>
    <table class="table table-hover border">
        <tr>
            <th>First Name</th>
            <td><?php echo htmlspecialchars($athlete['prenom']); ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo htmlspecialchars($athlete['nom']); ?></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><?php echo htmlspecialchars($athlete['date_naissance']); ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php echo htmlspecialchars($athlete['sexe']); ?></td>
        </tr>
    </table>

    <h3>Physical Conditions</h3>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Body Fat</th>
                <th>Muscle Mass</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_conditions->num_rows > 0) {
                while ($row = $result_conditions->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['height']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['body_fat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['muscle_mass']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No physical conditions found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    include "./includes/footer.php";
    ?>
</div>
</body>
</html>
