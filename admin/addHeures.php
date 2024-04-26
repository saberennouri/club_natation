<?php
// Include the database connection file
include 'config.php';

// Get data from form submission
$heure = $_POST['heure'];

// Get equipe id from the submitted form
$session_name=$_POST['session'];
$getsessionIdQuery="SELECT session_id FROM sessionsentrainement WHERE activite='$session_name' ";
$result1=mysqli_query($conn,$getsessionIdQuery);
$row1=mysqli_fetch_assoc($result1);
$session_id=$row1['session_id'];

// Get equipe id from the submitted form
$equipe_name=$_POST['equipe'];
$getEquipeIdQuery="SELECT id_equipe FROM equipe WHERE nom='$equipe_name' ";
$result2=mysqli_query($conn,$getEquipeIdQuery);
$row2=mysqli_fetch_assoc($result2);
$equipe_id=$row2['id_equipe'];
//$equipe_id = $_POST['equipe_id'];

// SQL query to insert new record
$sql = "INSERT INTO heuresentrainement (heure, session_id, equipe_id) 
        VALUES ('$heure', '$session_id', '$equipe_id')";

if ($conn->query($sql) === TRUE) {
    header("Location:heures.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
