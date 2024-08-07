<?php
session_start();
include "./includes/navParent.php";
include "./includes/header.php";
include "./config.php";

// Vérifier si l'identifiant du parent est défini dans la session
if (!isset($_SESSION['parent_id'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$parent_id = $_SESSION['parent_id'];

function calculateBodyFatPercentage($weight, $height, $age, $gender) {
    // Convert height from cm to meters
    $heightInMeters = $height / 100;

    // Calculate BMI
    $bmi = $weight / ($heightInMeters * $heightInMeters);

    // Calculate body fat percentage
    if ($gender == 'male') {
        $bodyFatPercentage = 1.20 * $bmi + 0.23 * $age - 16.2;
    } else {
        $bodyFatPercentage = 1.20 * $bmi + 0.23 * $age - 5.4;
    }

    return round($bodyFatPercentage, 2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $athlete_id = $_POST['athlete_id'];
    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $muscle_mass = $_POST['muscle_mass'];

    // For the purpose of the example, let's set a default age and gender
    $age = 25; // This should be retrieved from athlete data
    $gender = 'male'; // This should be retrieved from athlete data

    $body_fat = calculateBodyFatPercentage($weight, $height, $age, $gender);

    $sql = "INSERT INTO physical_conditions (athlete_id, date, weight, height, body_fat, muscle_mass)
            VALUES ('$athlete_id', '$date', '$weight', '$height', '$body_fat', '$muscle_mass')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='fitness.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_athletes = "SELECT athlete_id, prenom, nom FROM athletes WHERE parent_id = '$parent_id'";
$result_athletes = $conn->query($sql_athletes);
?>

<div class="container mt-5">
    <h2 class="text-center">Nouveau Condition physique</h2>
    <form method="post" action="" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="athlete_id">Athlete:</label>
            <select class="form-control" name="athlete_id" id="athlete_id" required>
                <?php
                if ($result_athletes->num_rows > 0) {
                    while($row = $result_athletes->fetch_assoc()) {
                        echo "<option value='".$row['athlete_id']."'>".$row['prenom']." ".$row['nom']."</option>";
                    }
                }
                ?>
            </select>
            <div class="invalid-feedback">
                Sélectionner athlète.
            </div>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" name="date" id="date" required>
            <div class="invalid-feedback">
                Saisir une date.
            </div>
        </div>

        <div class="form-group">
            <label for="weight">Poids:</label>
            <input type="number" step="0.1" class="form-control" name="weight" id="weight" required>
            <div class="invalid-feedback">
                Saisir poids.
            </div>
        </div>

        <div class="form-group">
            <label for="height">Taille:</label>
            <input type="number" step="0.1" class="form-control" name="height" id="height" required>
            <div class="invalid-feedback">
               Saisir taille.
            </div>
        </div>

        <div class="form-group">
            <label for="muscle_mass">Masse musculaire:</label>
            <input type="number" step="0.1" class="form-control" name="muscle_mass" id="muscle_mass" required>
            <div class="invalid-feedback">
                Please provide a muscle mass percentage.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter Condition</button>
    </form>

    <?php
    include "./includes/scripts.php";
    include "./includes/footer.php";  
    ?>
</div>

<!-- JavaScript for Bootstrap form validation -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
