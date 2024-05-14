<?php

include 'config.php';

// Check if the 'ajouter' button is clicked
if (isset($_POST['ajouter'])) {
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $activite = $_POST['activite']; 

   

    // Get entraineur id from the submitted form
    $entraineur_name = $_POST['entraineur'];
    $getEntraineurIdQuery = "SELECT entraineur_id FROM entraineurs WHERE prenom = '$entraineur_name'";
    $result = mysqli_query($conn, $getEntraineurIdQuery);
    $row = mysqli_fetch_assoc($result);
    $entraineur_id = $row['entraineur_id'];
     // Get equipe id from the submitted form
     $equipe_name = $_POST['equipe'];
     $getequipeIdQuery = "SELECT id_equipe FROM equipe WHERE nom = '$equipe_name'";
     $result1 = mysqli_query($conn, $getequipeIdQuery);
     $row1 = mysqli_fetch_assoc($result1);
     $equipe_id = $row1['id_equipe'];
    // get athlete id from the submitted form
    $athlete_name=$_POST['athlete'];
    $getAthleteIdQuery = "SELECT athlete_id FROM athletes WHERE prenom = '$athlete_name'";
    $result2 = mysqli_query($conn, $getAthleteIdQuery);
    $row2 = mysqli_fetch_assoc($result2);
    $athlete_id = $row2['athlete_id'];

   
    // Insert query to add a new session
    $insert_query = "INSERT INTO `sessionsentrainement`(`date`, `lieu`, `activite`, `athlete_id`, `entraineur_id`, `equipe_id`)
    VALUES('$date', '$lieu', '$activite', '$athlete_id','$entraineur_id','$equipe_id')";

    $insert_result = mysqli_query($conn, $insert_query);

    if (!$insert_result) {
        die("Erreur d'ajout du session: " . mysqli_error($conn));
    }
    echo "<script>window.location.href='sessions.php'</script>";
}
