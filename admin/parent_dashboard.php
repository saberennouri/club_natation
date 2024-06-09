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
     $_SESSION['parent_id']=$parent_id;
    // Préparation de la requête pour récupérer les athlètes associés au parent avec jointure
    $sqlathlete = "SELECT athletes.athlete_id, athletes.prenom, athletes.nom FROM athletes 
                   WHERE athletes.parent_id = ?";
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
        echo "<div class='row'><div class='col-md-12' ><h2 style='text-align:center'>Liste des Athlètes</h2>
        <a href='InsertAthlete.php' class='btn btn-primary'>Ajouter un athlète</a><br><br>";
       echo "<table class='table table-hover border'><tr><th>Prénom</th><th>Nom</th></tr>";

        while ($row_athlete = $resultathlete->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row_athlete["prenom"]) . "</td><td>" 
            . htmlspecialchars($row_athlete["nom"]) . "</td></tr>";
        }

        echo "</table></div></div></div>";
    } else {
        echo "<p>Aucun athlète associé trouvé.</p>";
    }

} else {
    echo "<p>Aucun parent associé trouvé.</p>";
}

$stmtparent->close();
$stmtathlete->close();
$conn->close();

?>
 

