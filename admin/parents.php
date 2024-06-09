<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="container mt-5">
    <h2>Gestion des parents du Club Natation</h2>
    <a href="createParents.php" class="btn btn-primary my-3">Ajouter parent</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro de télèphone</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT * FROM utilisateurs where role_id='2'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telephone'] . "</td>";
                    echo "<td>
                           
                            <a href='updateUser.php?id=" . $row['utilisateur_id'] . "' class='btn btn-warning'>Modifier</a>
                            <a href='deleteUser.php?id=" . $row['utilisateur_id'] . "' class='btn btn-danger'>Supprimer</a>
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