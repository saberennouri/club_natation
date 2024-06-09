<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
include('config.php');
?>



<div class="container mt-5">
    <h2>Gestion des sessions </h2>
    <a href="createsessions.php" class="btn btn-primary my-3">Ajouter une session</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>                
                <th>Date</th>
                <th>Lieu</th>
                <th>Activité</th>
                <th>Nom Athlète</th>
                <th>Entraineur</th>
                <th>Equipe</th>
             
                <th style='text-align:center'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer les session d'etrainement depuis la base de données
            //`date`, ``, `activite`, `athlete_id`, `entraineur_id`, `equipe_id`
            $sql = "SELECT  * from sessionsentrainement";
            $result = mysqli_query($conn, $sql);
            // Affichage des résultats dans une table
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $entraineur_id=$row['entraineur_id'];
                    $equipe_id=$row['equipe_id'];
                    $athlete_id = $row['athlete_id'];
                    $sqlathlete="select * from athletes where athlete_id=$athlete_id";
                    $resultathlete = mysqli_query($conn, $sqlathlete);
                    $rowathlete = $resultathlete->fetch_assoc(); 
                    // recuperer nom  et prenom de l'entraineur
                    $entraineur="select nom as nom_entr, prenom as prenom_entr from entraineurs where entraineur_id=$entraineur_id";
                    $resentr=mysqli_query($conn,$entraineur);
                    $rowentraineur=mysqli_fetch_assoc($resentr);   
                      // recuperer nom de l'équipe
                      $equipe="select nom as nom_equipe from equipe where id_equipe=$equipe_id";
                      $resequipe=mysqli_query($conn,$equipe);
                      $rowequipe=mysqli_fetch_assoc($resequipe);                

                    echo "<tr>";
                    echo "<td>".$row['session_id']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['lieu']."</td>";
                    echo "<td>".$row['activite']."</td>";
                    echo "<td>".$rowathlete['nom']."_".$rowathlete['prenom']."</td>";                    
                    echo "<td>".$rowentraineur['prenom_entr']." " .$rowentraineur['nom_entr']."</td>";     
                    echo "<td>".$rowequipe['nom_equipe']."</td>";                
                    echo "<td>                 
                    <a href='updatesessions.php?id=" . $row['session_id'] . "' class='btn btn-warning'>Modifier</a>
                    <a href='deletesessions.php?id=" . $row['session_id'] . "' class='btn btn-danger'>Supprimer</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune adhésion trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include './includes/scripts.php';
include './includes/footer.php';
?>
