<?php
include 'config.php';

// Ajouter un utilisateur
if (isset($_POST['ajouter'])) {
/**    INSERT INTO `utilisateurs`(`utilisateur_id`, `prenom`, `telephone`, `nom`, `email`, `mot_de_passe`, `role_id`)
 *  VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]') */
    // Récupération des données du formulaire
   
    $nom = $_POST['nom'];
    $prenom=$_POST['prenom'];
    $telephone=$_POST['telephone'];
    $email = $_POST['email'];
    $mdp = $_POST['mot_de_passe'];
    $role_name = $_POST['role']; // Récupérez le nom du rôle à partir du formulaire
     
     $idrole="SELECT `role_id`FROM `roles` WHERE nom='$role_name'";
     $resroleId=mysqli_query($conn,$idrole);
     $roleId=mysqli_fetch_assoc($resroleId);
     $id= $roleId['role_id'];
     // insert data to table utilisateur
     $insertUser="insert into utilisateurs(`prenom`, `telephone`, `nom`, `email`, `mot_de_passe`, `role_id`) 
     VALUES ('$prenom','$telephone','$nom','$email','$mdp','$id')";
     $res=mysqli_query($conn,$insertUser);
     if($res){
        header("location:utilisateurs.php");
        }
        else{ echo "echec insertion utilisateur";
        }
    }
