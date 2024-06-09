<?php
session_start();
include "./includes/navParent.php";
include "./includes/header.php";
include "./config.php";
$id = $_SESSION['parent_id'];
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter un Athlète</h2>
    <form method="post" action="insertData.php">
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
            <?php
            // Sélection des parents
            $sql = "SELECT * FROM parents WHERE parent_id='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<input type='text' class='form-control' name='parent' id='parent' value='" . $row['nom'] . "' readonly>";
                }
            } else {
                echo "<input type='text' class='form-control' name='parent' id='parent' value='Aucun parent trouvé' readonly>";
            }
            ?>
        </div>
        <div class="form-group">
            <label for="entraineur">Entraineur :</label>
            <select class="form-control" id="entraineur" name="entraineur">
                <?php
                // Sélection des entraineurs
                $sql = "SELECT * FROM entraineurs";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {                        
                        echo "<option value='" . $row['id'] . "'>" . $row['prenom'] . "</option>";
                        $_SESSION['entraineur_id']=$row['id'];
                    }
                } else {
                    echo "<option value=''>Aucun entraineur trouvé</option>";
                }

                echo $_SESSION['entraineur_id'];
                ?>
            </select>
            
        </div>
        <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        <a href="parent_dashboard.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>


