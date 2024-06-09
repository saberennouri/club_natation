<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <center><h2 class="mb-4">Interface Ajout</h2></center>
    <form method="post" action="addUser.php">
    <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
       
        <div class="form-group">
            <label for="telephone">Télephone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="Motdepasse">Mot de passe :</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select class="form-control" id="role" name="role" required>
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from roles";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun role trouvé</td></tr>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
    </form>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>