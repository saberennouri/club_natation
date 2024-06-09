<?php 
include "./includes/header.php";
include "./includes/navbar.php";
// get email from session 
//$email_admin=$_SESSION['email_admin'];
//echo "bienvenue " .$email;
?>


<div class="container mt-5">
    <h2>Gestion des équipes du Club Natation</h2>
    <a href="createEquipe.php" class="btn btn-primary my-3">Ajouter équipe</a>
    <table class="table table-hover border">
        <thead>
            <tr> 
                <th>ID</th>                
                <th>Nom</th>
                <th>Description</th>                
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';
           
            // Sélection des membres
            $sql = "SELECT * FROM equipe";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  
                    echo "<tr>
                    <td>".$row['id_equipe']."</td>
                    <td>".$row['nom']."</td>
                    <td>".$row['description']."</td>                    
                   
                    <td>
                    
                    <a href='updateEquipe.php?id=".$row['id_equipe']."' class='btn btn-warning'>Modifier</a>
                    <a href='deleteEquipe.php?id=".$row['id_equipe']."' class='btn btn-danger'>Supprimer</a>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun membre trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>






<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>