<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container mt-5">
    <h2>Gestion  Commité du Club Natation</h2>
    <a href="createCommite.php" class="btn btn-primary my-3">Ajouter commité</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>                
                <th>Nom</th>
                <th>Description</th>
                <th>Responsable</th>
                <th>Email</th>           
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT c.comite_id, c.nom AS comite_nom, c.description AS comite_description,
             u.utilisateur_id,u.nom AS responsable_nom, u.email AS responsable_email 
            FROM comites c 
            JOIN utilisateurs u ON c.responsable_id = u.utilisateur_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row['comite_id']."</td>
                    <td>".$row['comite_nom']."</td>
                    <td>".$row['comite_description']."</td>
                                      
                    <td>".$row['responsable_nom']."</td>
                    <td>".$row['responsable_email']."</td>
                    <td>
                  
                    <a href='updateCommite.php?id=".$row['comite_id']."' class='btn btn-warning'>Modifier</a>
                    <a href='deleteCommite.php?id=".$row['comite_id']."' class='btn btn-danger'>Supprimer</a>
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
include('includes/scripts.php');
include('includes/footer.php');
?>