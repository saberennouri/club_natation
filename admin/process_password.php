<?php
// Démarrer la session
session_start();
include './config.php';
if (isset($_POST['changer'])) {
    # code...
    $old_password=$_POST['old_password'];
    $sql="SELECT email FROM utilisateurs WHERE mot_de_passe='$old_password'";
    $resultat1=mysqli_query($conn,$sql);
    $row1=mysqli_fetch_assoc($resultat1);
    $email=$row1['email'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];
    if($new_password==$confirm_password){
       // echo "bienvenue " .$new_password;
       $sqlUpdatePass="UPDATE utilisateurs SET mot_de_passe='$new_password' where email='$email'";
       $resultat=mysqli_query($conn,$sqlUpdatePass);
       if($resultat){
          header("location:utilisateurs.php");
    }else echo "mot de passe différents";
} else {
    # code...
    header('location:../changePassword.php');
}
}
