<?php 
session_start();
include "./config.php";
if(isset($_POST['ajouter'])){
$nom=$_POST['nom'];
$description=$_POST['description'];
// get athlete id from the post form
$athelete=$_POST['athlete_id'];
$sql="INSERT INTO `equipe`(`nom`, `description`, `athlete_id`) VALUES ('$nom','$description','$athelete')";
$result=mysqli_query($conn,$sql);
header(
    "location:equipe.php"
);


}
