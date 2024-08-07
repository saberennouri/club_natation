<?php
session_start();
include "./config.php";
include "./includes/navParent.php";
include "./includes/header.php";


// Vérification de la session et de la connexion à la base de données
if (!isset($_SESSION['email_parent'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

$email = mysqli_real_escape_string($conn, $_SESSION['email_parent']);

// Préparation de la requête pour récupérer les informations du parent
$sqlparent = "SELECT parent_id FROM parents WHERE email = ?";
$stmtparent = $conn->prepare($sqlparent);
$stmtparent->bind_param("s", $email);
$stmtparent->execute();
$resultparent = $stmtparent->get_result();

if ($resultparent->num_rows > 0) {
    $row_parent = $resultparent->fetch_assoc();
    $parent_id = $row_parent['parent_id'];

    // Préparation de la requête pour récupérer les athlètes associés au parent
    $sqlathlete = "SELECT athlete_id, prenom, nom FROM athletes WHERE parent_id = ?";
    $stmtathlete = $conn->prepare($sqlathlete);
    $stmtathlete->bind_param("i", $parent_id);
    $stmtathlete->execute();
    $resultathlete = $stmtathlete->get_result();

    echo '<div class="container">
        <br><br><br>
        <div class="row">
            <div class="col-md-4">
                <a href="performanceAthlete.php" class="btn btn-primary btn-lg btn-block">Suivi des performances</a>
            </div>
            <div class="col-md-4">
                <a href="fitness.php" class="btn btn-primary btn-lg btn-block">Suivi de la condition physique</a>
            </div>
            <div class="col-md-4">
                <a href="communication.php" class="btn btn-primary btn-lg btn-block">Communication avec l\'entraîneur</a>
            </div>
        </div>
        <br><br>';

    if ($resultathlete->num_rows > 0) {
        echo "<div class='row'><div class='col-md-12'>
        <h2>Performances des Athlètes</h2>
        <table class='table'>
        <tr><th>Athlète</th>
        <th>Événement</th>
        <th>Temps Enregistré</th><th>Classement</th>
        <th>Records Personnels</th></tr>";

        // Préparation de la requête pour récupérer les performances des athlètes
        $sqlperformance = "SELECT * FROM performances WHERE athlete_id = ?";
        $stmtperformance = $conn->prepare($sqlperformance);

        while ($row_athlete = $resultathlete->fetch_assoc()) {
            $athlete_id = $row_athlete['athlete_id'];
            $prenom = $row_athlete['prenom'];
            $nom = $row_athlete['nom'];

            $stmtperformance->bind_param("i", $athlete_id);
            $stmtperformance->execute();
            $resultperformance = $stmtperformance->get_result();

            while ($row_performance = $resultperformance->fetch_assoc()) {
                $event_id = $row_performance['event_id'];

                // Préparation de la requête pour récupérer le nom de l'événement
                $sqlevent = "SELECT nom FROM evenements WHERE evenement_id = ?";
                $stmtevent = $conn->prepare($sqlevent);
                $stmtevent->bind_param("i", $event_id);
                $stmtevent->execute();
                $resultevent = $stmtevent->get_result();
                $row_event = $resultevent->fetch_assoc();
                $event_nom = $row_event['nom'];
                $stmtevent->close();

                echo "<tr><td>" . htmlspecialchars($prenom) . " " . htmlspecialchars($nom) . "</td><td>" . htmlspecialchars($event_nom) . "</td><td>" . htmlspecialchars($row_performance["temps_enregistre"]) . "</td><td>" . htmlspecialchars($row_performance["classement"]) . "</td><td>" . htmlspecialchars($row_performance["records_personnels"]) . "</td></tr>";
            }
        }

        echo "</table></div></div></div>";
        $stmtperformance->close();
    } else {
        echo "<p>Aucun athlète associé trouvé.</p>";
    }
} else {
    echo "<p>Aucun parent associé trouvé.</p>";
}

$stmtparent->close();
$conn->close();
