<?php
include('includes/header.php');
include('includes/navbar.php');
include('config.php');

// Vérifier si l'ID de l'athlète est passé en paramètre
if (isset($_GET['id'])) {
    $athlete_id = $_GET['id'];

    // Traitement du formulaire pour l'ajout à une équipe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $team_id = $_POST['team_id'];
        $dateaffiliation = $_POST['dateaffiliation'];

        // Insérer l'association dans la base de données
        $sql = "INSERT INTO membre_equipe (id_athlete, id_equipe, date_affiliation) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $athlete_id, $team_id, $dateaffiliation);

        if ($stmt->execute()) {
            echo "<script>window.location.href='affiliations.php?success=1'</script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erreur : " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
} else {
    // Redirection si l'ID de l'athlète n'est pas fourni
    header("Location: affiliations.php");
    exit();
}
?>

<div class="container mt-5">
    <h2>Ajouter un athlète à une équipe</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $athlete_id; ?>">
        <div class="form-group">
            <label for="team_id">Sélectionner l'équipe :</label>
            <select class="form-control" id="team_id" name="team_id" required>
                <?php
                $sql_teams = "SELECT * FROM equipe";
                $result_teams = $conn->query($sql_teams);
                while ($row_team = $result_teams->fetch_assoc()) {
                    echo "<option value='" . $row_team['id_equipe'] . "'>" . $row_team['nom'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="dateaffiliation">Date d'affiliation :</label>
            <input type="date" class="form-control" id="dateaffiliation" name="dateaffiliation" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter à l'équipe</button>
    </form>
</div>

<?php
include('includes/footer.php');
?>
