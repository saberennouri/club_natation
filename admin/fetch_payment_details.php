<?php
include 'config.php';

if (isset($_GET['paiement_id'])) {
    $paiement_id = $_GET['paiement_id'];

    $query = "
        SELECT 
            p.paiement_id, 
            p.adhesion_id, 
            p.montant, 
            p.date_paiement, 
            p.payment_method, 
            p.montantPayer, 
            p.montantReste, 
            ath.prenom, 
            ath.nom, 
            ath.date_naissance, 
            ath.sexe, 
            ath.parent_id, 
            ath.entraineur_id, 
            ath.absence
        FROM 
            paiements p
        INNER JOIN 
            adhesion a ON p.adhesion_id = a.adhesion_id
        INNER JOIN 
            athletes ath ON a.athlete_id = ath.athlete_id
        WHERE 
            p.paiement_id = $paiement_id
    ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Erreur: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => 'ID de paiement non spécifié.']);
}
?>
