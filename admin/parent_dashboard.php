<?php
session_start();
include "./includes/header.php";
include "./config.php";

// Vérification de la session et de la connexion à la base de données
if (!isset($_SESSION['email_parent'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

?>
<div class="container">
  <?php include "./includes/navParent.php" ?>

    <h2 style="text-align:center;margin-top:20px;margin-bottom:20px;">Tableau de bord parent</h2>
    <div class="row">
        <div class="col-md-4">
            <a href="performance.php" class="btn btn-primary btn-lg btn-block">Suivi des performances</a>
        </div>
        <div class="col-md-4">
            <a href="fitness.php" class="btn btn-primary btn-lg btn-block">Suivi de la condition physique</a>
        </div>
        <div class="col-md-4">
            <a href="communication.php" class="btn btn-primary btn-lg btn-block">Communication avec l'entraîneur</a>
        </div>
    </div>
    <br><br>
   <div class="row " style="margin-left:50%;margin-top:20px;margin-bottom:20px;">
    <?php  
       
        $sqlathlete="select prenom,nom from athletes";
        $resultathlete = $conn->query($sqlathlete);
        $row_athlete=$resultathlete->fetch_assoc();

        echo "<pre>";
        echo  $row_athlete["prenom"]." ". $row_athlete['nom'];
        echo "</pre>";

    ?>
   </div>

</div>
