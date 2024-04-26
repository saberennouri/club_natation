<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>Créer une nouvelle session d'entraînement</h2>
    <form method="post" action="addHeures.php">
        <div class="form-group">
            <label for="heure">Heures :</label>
            <input type="time" class="form-control" id="heure" name="heure" required>
        </div>
      
       
        <div class="form-group">
        <label for="session">Session :</label>
                <select class="form-control" id="session" name="session" required>
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from sessionsentrainement";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" . $row['activite']. "</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun session trouvé</td></tr>";
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