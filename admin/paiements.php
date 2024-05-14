<?php
include 'config.php';
include("./includes/header.php");
include("./includes/navbar.php");

// Read existing payments
$select_query = "SELECT p.*, a.*
                FROM paiements p 
                INNER JOIN adhesion a ON p.adhesion_id = a.adhesion_id";
$result = mysqli_query($conn, $select_query);

// Add new payment
if (isset($_POST['add_payment'])) {
    $adhesion_id = $_POST['adhesion_id'];
    $montant = $_POST['montant'];
    $date_paiement = $_POST['date_paiement'];
    $payment_method = $_POST['payment_method'];

    $insert_query = "INSERT INTO paiements (adhesion_id, montant, date_paiement, payment_method) 
                    VALUES ('$adhesion_id', '$montant', '$date_paiement', '$payment_method')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        echo "<script>window.location.href='paiements.php'</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Delete existing payment
if (isset($_GET['delete_id'])) {
    $paiement_id = $_GET['delete_id'];

    $delete_query = "DELETE FROM paiements WHERE paiement_id=$paiement_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        echo "<script>window.location.href='paiements.php'</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
// update existing paiement
if (isset($_GET['update_id'])) {
    $paiement_id = $_GET['update_id'];
    // Fetch the payment details based on the paiement_id
    $select_query = "SELECT p.*, a.*
                    FROM paiements p 
                    INNER JOIN adhesion a ON p.adhesion_id = a.adhesion_id
                    WHERE p.paiement_id = $paiement_id";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
}



?>

<body>
    <div class="container mt-5">
        <h2>Payments</h2>
        <!-- Add Payment Form -->
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="adhesion_id">Nom de l'Athlète</label>
                    <select name="athlete_id" class="form-control <?php echo (!empty($athlete_id_err)) ? 'is-invalid' : ''; ?>">
                        <?php
                        // Récupérer les noms des athlètes depuis la base de données
                        $sql_athletes = "SELECT athlete_id, CONCAT(nom, ' ', prenom) AS nom_complet FROM athletes";
                        $result_athletes = mysqli_query($conn, $sql_athletes);
                        if (mysqli_num_rows($result_athletes) > 0) {
                            while ($row_athlete = mysqli_fetch_assoc($result_athletes)) {
                                echo "<option value='" . $row_athlete['athlete_id'] . "'>" . $row_athlete['nom_complet'] . "</option>";
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="form-group col-md-4">
                    <label for="montant">Montant</label>
                    <input type="text" class="form-control" id="montant" name="montant" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="date_paiement">Date Paiement</label>
                    <input type="date" class="form-control" id="date_paiement" name="date_paiement" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="payment_method">Payment Method</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="add_payment">Add Payment</button>
        </form>

       <!-- Existing Payments Table -->
<table class="table table-hover border mt-4">
    <thead text >
        <tr>
            <th>Paiement ID</th>                    
            <th>Nom Athlete</th>
            <th>Montant</th>
            <th>Date Paiement</th>
            <th>Payment Method</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                //$athlete_id_id=$row_athlete["athlete_id"];
                $sql2 = "SELECT * FROM athletes WHERE athlete_id = " . $row['athlete_id'];
                $result2=mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo "<tr>";
                echo "<td>" . $row['paiement_id'] . "</td>";
                echo "<td>" . $row2['prenom'] . " ".$row2['nom'] . "</td>";
                echo "<td>" . $row['montant'] . "</td>";
                echo "<td>" . $row['date_paiement'] . "</td>";
                echo "<td>" . $row['payment_method'] . "</td>";
                echo "<td><a href='updatePaiement.php?update_id=" . $row['paiement_id'] . "' class='btn btn-warning btn-sm'>Modifier</a></td>";
                echo "<td><a href='paiements.php?delete_id=" . $row['paiement_id'] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No payments found.</td></tr>";
        }
        ?>
    </tbody>
</table>





    <?php
    include("./includes/scripts.php");
    include("./includes/footer.php");
    ?>