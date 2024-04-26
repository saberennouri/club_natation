<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container mt-5">
    <h2>Gestion des utilisateurs du Club Natation</h2>
    <a href="createUser.php" class="btn btn-primary my-3">Ajouter utilisateur</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Mot de passe</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT utilisateurs.*, roles.nom AS nom_role FROM utilisateurs INNER JOIN roles ON utilisateurs.role_id = roles.role_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                   
                    echo "<td>".$row['utilisateur_id']."</td>";
               
                    echo "<td>".$row['nom']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['nom_role']."</td>";
                    echo "<td>".$row['mot_de_passe']."</td>";
                    echo "<td>
                            <a href='readUser.php?id=".$row['utilisateur_id']."' class='btn btn-info'>Lire</a>
                            <a href='updateUser.php?id=".$row['utilisateur_id']."' class='btn btn-warning'>Modifier</a>
                            <a href='deleteUser.php?id=".$row['utilisateur_id']."' class='btn btn-danger'>Supprimer</a>
                          </td>";
                    echo "</tr>";
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