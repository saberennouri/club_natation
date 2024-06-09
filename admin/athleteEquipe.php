<?php
include "./includes/header.php";
include "./includes/navbar.php";
include "./config.php";
?>

<div class="container">
    <div class="row">
        <form method="POST" action="">
            <select name="equipeA" id="equipeA">
                <option value="">Sélectionnez une équipe</option>
                <?php
                $sqlequipe = "SELECT * FROM equipe";
                $resultat = $conn->query($sqlequipe);
                while ($row = $resultat->fetch_assoc()) {
                    echo "<option value='" . $row['id_equipe'] . "'>" . $row['nom'] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Afficher les athlètes</button>
        </form>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row">
        <?php
        if (isset($_POST['equipeA'])) {
            $id_equipe = $_POST['equipeA'];
            $sql_equipe = "SELECT * FROM equipe WHERE id_equipe='$id_equipe'";
            $result_equipe = $conn->query($sql_equipe);
            $row_equipe = $result_equipe->fetch_assoc();
            echo "<h2>liste des athlètes pour l' " . $row_equipe['nom'] . "</h2>";

            // Récupérer les athlètes associés à l'équipe
            $sql_athletes = "SELECT athletes.nom AS nomathlete, athletes.prenom AS prenomathlete 
                             FROM athletes 
                             INNER JOIN membre_equipe ON athletes.athlete_id = membre_equipe.id_athlete 
                             WHERE membre_equipe.id_equipe='$id_equipe'";
            $result_athletes = $conn->query($sql_athletes);

            if ($result_athletes->num_rows > 0) {
                echo "<table class='table table-hover border'>
                        <thead>
                            <th>Nom</th>
                            <th>Prénom</th>
                        </thead>
                        <tbody>";
                while ($row_athlete = $result_athletes->fetch_assoc()) {
                    echo "<tr><td>" . $row_athlete['prenomathlete'] . "</td><td>" . $row_athlete['nomathlete'] . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "Aucun athlète trouvé pour cette équipe.";
            }
        }
        ?>
    </div>
</div>

<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>
