<?php
include('includes/header.php');
include('includes/navbar.php');
?>




<div class="container mt-5">
    <h2>Créer une nouvelle session d'entraînement</h2>
    <form method="post" action="addsessions.php">
        <div class="form-group">
            <label for="date">Date :</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <input type="text" class="form-control" id="lieu" name="lieu" required>
        </div>
        <div class="form-group">
            <label for="activite">Activité :</label>
            <input type="text" class="form-control" id="activite" name="activite" required>
        </div>
        <div class="form-group">
        <label for="entraineur">Entraineur :</label>
                <select class="form-control" id="entraineur" name="entraineur" >
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from entraineurs";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" . $row['prenom']. "</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun role trouvé</td></tr>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="athlete_id">Nom de l'athlète :</label>
            <select class="form-control" id="athlete" name="athlete" >
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from athletes";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" . $row['prenom']. "</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun athlete trouvé</td></tr>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="equipe_id">Nom de l'équipe :</label>
            <select class="form-control" id="equipe" name="equipe" required>
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from equipe";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" . $row['nom']. "</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun equipe trouvé</td></tr>";
                }
                ?>
            </select>
        </div>
        
   

       
        <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        <a href="sessions.php" class="btn btn-secondary">Annuler</a>
    </form>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>