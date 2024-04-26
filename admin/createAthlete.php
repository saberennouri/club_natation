<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container mt-5">
        <h2 class="mb-4">Ajouter un Athlète</h2>
        <form method="post" action="addAthlete.php">
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de Naissance :</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <select class="form-control" id="sexe" name="sexe" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
            <div class="form-group">
            <label for="parent_id">Parent :</label>
            <select class="form-control" id="parent" name="parent" required>
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from parents";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" .$row['prenom']."</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun role trouvé</td></tr>";
                }
                ?>
            </select>
        </div>
            <div class="form-group">
                <label for="entraineur">Entraineur :</label>
                <select class="form-control" id="entraineur" name="entraineur" required>
                <?php
                // Connexion à la base de données
                require_once 'config.php';

                // Sélection des membres
                $sql = "SELECT * from entraineurs";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>";
                        echo "<td>" .$row['prenom']."</td>";
                        echo "</option>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun role trouvé</td></tr>";
                }
                ?>
                </select>
            </div>
            
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
            <a href="athletes.php" class="btn btn-secondary">Annuler</a>
        </form>

    <?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>