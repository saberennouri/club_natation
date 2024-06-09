<?php
include 'config.php';
include("./includes/header.php");
include("./includes/navbar.php");

// Lire les paiements existants
$select_query = "
    SELECT 
        p.paiement_id, 
        p.adhesion_id, 
        a.athlete_id, 
        ath.prenom, 
        ath.nom, 
        a.date_debut, 
        a.date_fin, 
        a.typeAdhesion, 
        a.statut, 
        ath.date_naissance, 
        ath.sexe, 
        ath.parent_id, 
        ath.entraineur_id, 
        ath.absence, 
        p.montant, 
        p.date_paiement, 
        p.montantPayer, 
        p.montantReste, 
        p.payment_method 
    FROM 
        paiements p
    INNER JOIN 
        adhesion a ON p.adhesion_id = a.adhesion_id
    INNER JOIN 
        athletes ath ON a.athlete_id = ath.athlete_id
";
$result = mysqli_query($conn, $select_query);

// Ajouter un nouveau paiement
if (isset($_POST['add_payment'])) {
    $adhesion_id = $_POST['athlete_id'];
    $montant = $_POST['montant'];
    $date_paiement = $_POST['date_paiement'];
    $payment_method = $_POST['payment_method'];
    $montant_paye = $_POST['montant_paye'];

    $montant_reste = $montant - $montant_paye;

    $insert_query = "INSERT INTO paiements (adhesion_id, montant, date_paiement, payment_method, montantPayer, montantReste) 
                    VALUES ('$adhesion_id', '$montant', '$date_paiement', '$payment_method', '$montant_paye', '$montant_reste')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        echo "<script>window.location.href='paiements.php'</script>";
        exit();
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}

// Supprimer un paiement existant
if (isset($_GET['delete_id'])) {
    $paiement_id = $_GET['delete_id'];

    $delete_query = "DELETE FROM paiements WHERE paiement_id=$paiement_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        echo "<script>window.location.href='paiements.php'</script>";
        exit();
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}

// Mettre à jour un paiement existant
if (isset($_GET['update_id'])) {
    $paiement_id = $_GET['update_id'];
    // Récupérer les détails du paiement basés sur le paiement_id
    $select_query = "
        SELECT 
            p.*, 
            ath.prenom, 
            ath.nom 
        FROM 
            paiements p 
        INNER JOIN 
            adhesion a ON p.adhesion_id = a.adhesion_id
        INNER JOIN 
            athletes ath ON a.athlete_id = ath.athlete_id
        WHERE 
            p.paiement_id = $paiement_id
    ";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-5">
    <h2>Paiements</h2>
    <!-- Formulaire pour ajouter un paiement -->
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="athlete_id">Nom de l'Athlète</label>
                
                <select name="athlete_id" class="form-control" id="athlete_id" required>
                <option>--------------</option>
                    <?php
                    // Récupérer les noms des athlètes depuis la base de données
                    $sql_athletes = "SELECT athlete_id, prenom, nom FROM athletes";
                    $result_athletes = mysqli_query($conn, $sql_athletes);
                    if (mysqli_num_rows($result_athletes) > 0) {
                        while ($row_athlete = mysqli_fetch_assoc($result_athletes)) {
                           
                            echo "<option value='" . $row_athlete['athlete_id'] . "'>" . $row_athlete['prenom'] . " " . $row_athlete['nom'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="montant">Montant Total</label>
                <input type="number" class="form-control" id="montant" name="montant" required>
            </div>
            <div class="form-group col-md-4">
                <label for="date_paiement">Date Paiement</label>
                <input type="date" class="form-control" id="date_paiement" name="date_paiement" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="payment_method">Méthode de Paiement</label>
                <input type="text" class="form-control" id="payment_method" name="payment_method" required>
            </div>
            <div class="form-group col-md-4">
                <label for="montant_paye">Montant Payé</label>
                <input type="number" class="form-control" id="montant_paye" name="montant_paye" required>
            </div>
            <div class="form-group col-md-4">
                <label for="montant_reste">Montant Restant</label>
                <input type="number" class="form-control" id="montant_reste" name="montant_reste" readonly>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="add_payment">Ajouter un paiement</button>
    </form>

    <!-- Tableau des paiements existants -->
    <table class="table table-hover border mt-4">
        <thead>
            <tr>
                <th>Paiement ID</th>
                <th>Nom Athlète</th>
                <th>Montant Total</th>
                <th>Date Paiement</th>
                <th>Montant Payé</th>
                <th>Montant Restant</th>
                <th>Méthode de Paiement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['paiement_id'] . "</td>";
                    echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
                    echo "<td>" . $row['montant'] . "</td>";
                    echo "<td>" . $row['date_paiement'] . "</td>";
                    echo "<td>" . $row['montantPayer'] . "</td>";
                    echo "<td>" . $row['montantReste'] . "</td>";
                    echo "<td>" . $row['payment_method'] . "</td>";
                    echo "<td>
                            <a href='updatePaiement.php?update_id=" . $row['paiement_id'] . "' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a>
                            <a href='paiements.php?delete_id=" . $row['paiement_id'] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                            <button onclick=\"printPaymentDetails(" . $row['paiement_id'] . ")\" class='btn btn-info btn-sm'><i class='fa fa-print'></i></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Aucun paiement trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    include("./includes/scripts.php");
    include("./includes/footer.php");
    ?>
</div>

<script>
    function printPaymentDetails(paiement_id) {
        // Récupérer les détails du paiement en utilisant AJAX
        fetch(`fetch_payment_details.php?paiement_id=${paiement_id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Erreur: ' + data.error);
                    return;
                }
                
                // Générer la structure HTML des détails du paiement et de l'athlète
                const paymentDetailsHTML = `
                    <h2>Détails du Paiement</h2>
                    <p><strong>ID du Paiement:</strong> ${data.paiement_id}</p>
                    <p><strong>Nom de l'Athlète:</strong> ${data.prenom} ${data.nom}</p>
                    <p><strong>Date de Naissance:</strong> ${data.date_naissance}</p>
                    <p><strong>Sexe:</strong> ${data.sexe}</p>
                    <p><strong>Parent ID:</strong> ${data.parent_id}</p>
                    <p><strong>Entraineur ID:</strong> ${data.entraineur_id}</p>
                    <p><strong>Absences:</strong> ${data.absence}</p>
                    <p><strong>Montant Total:</strong> ${data.montant}</p>
                    <p><strong>Date de Paiement:</strong> ${data.date_paiement}</p>
                    <p><strong>Méthode de Paiement:</strong> ${data.payment_method}</p>
                    <p><strong>Montant Payé:</strong> ${data.montantPayer}</p>
                    <p><strong>Montant Restant:</strong> ${data.montantReste}</p>
                `;

                // Ouvrir une nouvelle fenêtre et y écrire les détails du paiement et de l'athlète
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Détails du Paiement</title>
                        </head>
                        <body>
                            ${paymentDetailsHTML}
                            <button onclick="window.print();">Imprimer</button>
                            <button onclick="window.location.href='paiements.php';">Annuler</button>
                        </body>
                    </html>
                `);
                printWindow.document.close();
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des détails du paiement:', error);
            });
    }
</script>
