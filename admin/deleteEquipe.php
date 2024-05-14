<?php
session_start();
include "./config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // get details for equipe
    $select = "select * from equipe where id_equipe=$id";
    $res = mysqli_query($conn, $select);
    if (mysqli_num_rows($res) > 0) {
if($rowselect = mysqli_fetch_assoc($res)){
            $delete="delete from equipe where id_equipe=$id";
            $resdelete=mysqli_query($conn,$delete);
            header("location:equipe.php");
       
    } else {
        $message="aucune équipe n'est enrégistrée dans la base";
        echo mysqli_error($conn) . $message;
    }
}
}