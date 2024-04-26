<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container mt-5">
    <h2>Gestion des entraineurs du Club Natation</h2>
    <a href="createCoach.php" class="btn btn-primary my-3">Ajouter entraineur</a>
    <table class="table">
        <thead>
            <tr> 
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>email</th>
                <th>numéro tel</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT * FROM entraineurs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row['entraineur_id']."</td>
                    <td>".$row['prenom']."</td>
                    <td>".$row['nom']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['numero_telephone']."</td>
                    <td>
                    <a href='readCoach.php?id=".$row['entraineur_id']."' class='btn btn-info'>Lire</a>
                    <a href='updateCoach.php?id=".$row['entraineur_id']."' class='btn btn-warning'>Modifier</a>
                    <a href='deleteCoach.php?id=".$row['entraineur_id']."' class='btn btn-danger'>Supprimer</a>
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