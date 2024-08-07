<?php
session_start();
include "./includes/navParent.php";
include "./includes/header.php";
include "./config.php";

if (isset($_GET['condition_id'])) {
    $condition_id = $_GET['condition_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $athlete_id = $_POST['athlete_id'];
        $date = $_POST['date'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $body_fat = $_POST['body_fat'];
        $muscle_mass = $_POST['muscle_mass'];

        $sql = "UPDATE physical_conditions
                SET athlete_id='$athlete_id', date='$date', weight='$weight', height='$height', body_fat='$body_fat', muscle_mass='$muscle_mass'
                WHERE condition_id='$condition_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='fitness.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM physical_conditions WHERE condition_id='$condition_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql_athletes = "SELECT athlete_id, prenom, nom FROM athletes";
    $result_athletes = $conn->query($sql_athletes);
}
?>
<div class="container center">

<h2>Update Physical Condition</h2>
<form method="post" action="">
    <label for="athlete_id">Athlete:</label>
    <select name="athlete_id" id="athlete_id" required class="form-control">
        <?php
        if ($result_athletes->num_rows > 0) {
            while ($row_athlete = $result_athletes->fetch_assoc()) {
                $selected = $row_athlete['athlete_id'] == $row['athlete_id'] ? "selected" : "";
                echo "<option value='" . $row_athlete['athlete_id'] . "' $selected>" . $row_athlete['prenom'] . " " . $row_athlete['nom'] . "</option>";
            }
        }
        ?>
    </select><br>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date" value="<?php echo $row['date']; ?>" required  class="form-control"><br>

    <label for="weight">Poids:</label>
    <input type="text" name="weight" id="weight" value="<?php echo $row['weight']; ?>" required class="form-control"><br>

    <label for="height">Taille:</label>
    <input type="text" name="height" id="height" value="<?php echo $row['height']; ?>" required class="form-control"><br>

    <label for="body_fat">Taux du graisse:</label>
    <input type="text" name="body_fat" id="body_fat" value="<?php echo $row['body_fat']; ?>" required class="form-control"><br>

    <label for="muscle_mass">Muscle Mass:</label>
    <input type="text" name="muscle_mass" id="muscle_mass" value="<?php echo $row['muscle_mass']; ?>" required class="form-control"><br>

    <button type="submit" class="btn btn-success">Update Condition</button>
    
</form>
<?php
    include "./includes/scripts.php";
    include "./includes/footer.php";
    $conn->close();
?>
</div>