<?php
include "./includes/header.php";
include "./includes/navbar.php";
include "./config.php";

if (isset($_GET['id'])) {
    $performance_id = $_GET['id'];

    // Fetch the performance record
    $sql = "SELECT * FROM performances WHERE performance_id = $performance_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $performance = mysqli_fetch_assoc($result);
    } else {
        echo "Erreur lors de la récupération de la performance: " . mysqli_error($conn);
    }
}

if (isset($_POST['update'])) {
    $performance_id = $_POST['performance_id'];
    $temps_enregistre = $_POST['temps_enregistre'];
    $classement = $_POST['classement'];
    $records_personnels = $_POST['records_personnels'];
    $date = $_POST['date'];

    // Update the performance record
    $sql = "UPDATE performances SET temps_enregistre = '$temps_enregistre', classement = $classement, records_personnels = '$records_personnels', date = '$date' WHERE performance_id = $performance_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='performances.php'</script>";
    } else {
        echo "Erreur lors de la mise à jour: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Modifier la Performance</h2>
    <form method="post" action="update_performance.php?id=<?php echo $performance['performance_id']; ?>">
        <input type="hidden" name="performance_id" value="<?php echo $performance['performance_id']; ?>">
        <div class="form-group">
            <label for="temps_enregistre">Temps Enregistré:</label>
            <input type="text" class="form-control" id="temps_enregistre" name="temps_enregistre" value="<?php echo $performance['temps_enregistre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="classement">Classement:</label>
            <input type="number" class="form-control" id="classement" name="classement" value="<?php echo $performance['classement']; ?>" required>
        </div>
        <div class="form-group">
            <label for="records_personnels">Records Personnels:</label>
            <input type="text" class="form-control" id="records_personnels" name="records_personnels" value="<?php echo $performance['records_personnels']; ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $performance['date']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
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
