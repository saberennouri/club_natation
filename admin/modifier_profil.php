<?php
session_start();
include './config.php';
if(isset($_SESSION['email'])){
 $email = $_SESSION['email'];
 $sql="select * from entraineurs where email='$email'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id_entraineur = $row["entraineur_id"];
        $email_entraineur= $row['email'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $tel=$row['numero_telephone'];

        $update="update entraineurs set nom='$nom',prenom='$prenom',email='$email',numero_telephone='$tel' where entraineur_id='$id_entraineur'";
        $resultat = mysqli_query($conn, $update);

        
    }
 }

}else 
 header("Location:index.php");