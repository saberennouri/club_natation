<?php
include "./config.php";
include "./includes/header.php";
include "./includes/navbar.php";

?>


<div class="container center">
    <h3  style="text-align: center;">Liste des packages </h3>
    
    <a href="addPackage.php" class="btn btn-primary">Ajouter un package</a><br><br>
    <div class="row">
        
            
            <table class="table table-striped table-bordered">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Durée</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM packages";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['nom']."</td>";
                        echo "<td>".$row['duree']."</td>";
                        echo "<td>".$row['prix']."</td>";
                        echo "<td><a href='updatePackage.php?id=".$row['id']."' class='btn btn-info'>Modifier</a>
                        <a href='deletePackage.php?id=".$row['id']."' class='btn btn-danger'>Supprimer</a></td>";
                        echo "</tr>";
                        }
                        }else{
                            echo "Aucun package trouvé";
                            }
                            ?>
            </tbody>
            </table>
    </div>
</div>






<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>