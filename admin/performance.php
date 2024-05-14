<?php
session_start();
include "./config.php";
include "./includes/navParent.php" ;
include "./includes/header.php";

echo '<div class="container">
      <br><br><br>
    <div class="row">
        <div class="col-md-4">
            <a href="performance.php" class="btn btn-primary btn-lg btn-block">Suivi des performances</a>
        </div>
        <div class="col-md-4">
            <a href="fitness.php" class="btn btn-primary btn-lg btn-block">Suivi de la condition physique</a>
        </div>
        <div class="col-md-4">
            <a href="communication.php" class="btn btn-primary btn-lg btn-block">Communication avec l\'entraîneur</a>
        </div>
    </div> <br><br>';
// Requête SELECT
$sql = "SELECT * FROM `performances`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les données dans un tableau
    echo "<div class='row'><div class='col-md-12'><h2>Performances</h2><table class='table'><tr><th>ID</th><th>Athlète</th><th>Événement</th><th>Temps Enregistré</th><th>Classement</th><th>Records Personnels</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $id=$row['athlete_id'];
        $sqlathlete="select prenom,nom from athletes where athlete_id=$id";
        $resultathlete = $conn->query($sqlathlete);
        $row_athlete=$resultathlete->fetch_assoc();
        $id_event=$row['event_id'];
        $sqlevent="select nom from evenements where evenement_id=$id_event";
        $resultevent = $conn->query($sqlevent);
        $row_event=$resultevent->fetch_assoc();
        echo "<tr><td>" . $row["performance_id"] . "</td><td>" . $row_athlete["prenom"] . "</td><td>" . $row_event["nom"] . "</td><td>" . $row["temps_enregistre"] . "</td><td>" . $row["classement"] . "</td><td>" . $row["records_personnels"] . "</td></tr>";
    }
    echo "</table></div></div></div>";
} else {
    echo "0 results";
}


//include "./includes/footer.php"; // Assuming you have a footer file to include
$conn->close();