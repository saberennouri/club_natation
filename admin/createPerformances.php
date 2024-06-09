<?php
include "./includes/header.php";
include "./includes/navbar.php";
include "./config.php";

if (isset($_POST['create'])) {
    $athlete_id = $_POST['athlete_id'];
    $event_id = $_POST['event_id'];
    $temps_enregistre = $_POST['temps_enregistre'];
    $classement = $_POST['classement'];
    $records_personnels = $_POST['records_personnels'];
    $date = $_POST['date'];

    // Insert the new performance record
    $sql = "INSERT INTO performances (athlete_id, event_id, temps_enregistre, classement, records_personnels, date)
            VALUES ('$athlete_id', '$event_id', '$temps_enregistre', '$classement', '$records_personnels', '$date')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='performances.php'</script>";
    } else {
        echo "Erreur lors de la création de la performance: " . mysqli_error($conn);
    }
}

// Fetch athletes and events data for the dropdowns
$athletes_sql = "SELECT * FROM athletes";
$athletes_result = mysqli_query($conn, $athletes_sql);

$events_sql = "SELECT * FROM evenements";
$events_result = mysqli_query($conn, $events_sql);
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter une Nouvelle Performance</h2>
    <form method="post" action="createPerformances.php">
        <div class="form-group">
            <label for="athlete_id">Athlète:</label>
            <select class="form-control" id="athlete_id" name="athlete_id" required>
                <?php
                if (mysqli_num_rows($athletes_result) > 0) {
                    while ($athlete = mysqli_fetch_assoc($athletes_result)) {
                        echo "<option value='" . $athlete['athlete_id'] . "'>" . $athlete['prenom'] . " " . $athlete['nom'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun athlète trouvé</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="event_id">Événement:</label>
            <select class="form-control" id="event_id" name="event_id" required>
                <?php
                if (mysqli_num_rows($events_result) > 0) {
                    while ($event = mysqli_fetch_assoc($events_result)) {
                        echo "<option value='" . $event['evenement_id'] . "'>" . $event['nom'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun événement trouvé</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="temps_enregistre">Temps Enregistré:</label>
            <input type="text" class="form-control" id="temps_enregistre" name="temps_enregistre" required>
        </div>
        <div class="form-group">
            <label for="classement">Classement:</label>
            <input type="number" class="form-control" id="classement" name="classement" required>
        </div>
        <div class="form-group">
            <label for="records_personnels">Records Personnels:</label>
            <input type="text" class="form-control" id="records_personnels" name="records_personnels" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Ajouter</button>
        <a href="performances.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>

<?php
// Close the database connection
mysqli_close($conn);
?>
