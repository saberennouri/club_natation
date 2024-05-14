<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container mt-5">
    <h2>Gestion des competitions du Club Natation</h2>
    <a href="createCompetition.php" class="btn btn-primary my-3">Ajouter compétition</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Competition</th>
                <th>Date</th>
                <th>Lieu </th>
                <th style="text-align:center">Actions</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';
           
            // Sélection des competitions
            $sql = "SELECT * FROM competitions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                   
                    echo "<td>".$row['competition_id']."</td>";
                    echo "<td>".$row['nom']."</td>";
                    echo "<td>".$row['date_debut']."</td>";
                   
                    echo "<td>".$row['lieu']."</td>";
                    echo "<td>
                            
                            <a href='updateCompetition.php?id=".$row['competition_id']."' class='btn btn-warning'>Modifier</a>
                            <a href='deleteCompetiton.php?id=".$row['competition_id']."' class='btn btn-danger'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun competition trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>