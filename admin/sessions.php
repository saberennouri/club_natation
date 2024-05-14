<?php
include("./includes/header.php");
include("./includes/navbar.php");
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Requête SQL pour récupérer les données des sessions d'entraînement
$sql = "SELECT *FROM `sessionsentrainement`";

// Exécution de la requête
$resultat = mysqli_query($conn, $sql);

// Vérification s'il y a des résultats
if (mysqli_num_rows($resultat) > 0) {
    // Affichage des données sous forme de tableau HTML
    echo "<center><div class='container'><h3>Liste des sessions d'entraînement</h3><br><br>";
    echo "<table class='table table-hover'>
    
            <tr style='background-color:skyblue'>
                <th>ID</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Activité</th>
                <th>Athlète</th>
                <th>Entraîneur</th>
                <th>Equipe</th>
                <th style='text-align:center'>Actions</th>
            </tr>";

    // Boucle à travers les lignes de résultats
    while ($ligne = mysqli_fetch_assoc($resultat)) {
        $equipe_id = $ligne['equipe_id'];
        $athlete_id = $ligne['athlete_id'];
        $entraineur_id = $ligne['entraineur_id'];
        // récuperer nom et prenom athlète 
        $athlete = "select * from athletes where athlete_id='$athlete_id'";
        $resultat2 = mysqli_query($conn, $athlete);
        $row2 = mysqli_fetch_assoc($resultat2);
        // récuperer nom et prenom entraineurs 
        $entraineur = "select * from entraineurs where entraineur_id='$entraineur_id'";
        $resultat3 = mysqli_query($conn, $entraineur);
        $row3 = mysqli_fetch_assoc($resultat3);
        // récuperer nom equipe
        $equipe = "select * from equipe where id_equipe='$equipe_id'";
        $resultat4 = mysqli_query($conn, $equipe);
        $row4 = mysqli_fetch_assoc($resultat4);

        echo "<tr>";
        echo "<td>" . $ligne['session_id'] . "</td>";
        echo "<td>" . $ligne['date'] . "</td>";
        echo "<td>" . $ligne['lieu'] . "</td>";
        echo "<td>" . $ligne['activite'] . "</td>";

        echo "<td>" . $row2['prenom'] . " " . $row2['nom'] . "</td>";
        echo "<td>" . $row3['prenom'] . " " . $row3['nom'] . "</td>";
        echo "<td>" . $row4['nom'] . "</td>";
        echo "<td>
                           
                            <a href='updatesessions.php?id=" . $ligne['session_id'] . "' class='btn btn-warning'>Modifier</a>
                            <a href='deletesessions.php?id=" . $ligne['session_id'] . "' class='btn btn-danger'>Supprimer</a>
                          </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucune session d'entraînement trouvée.";
}
echo "</div></center>";
// Fermer la conn à la base de données
mysqli_close($conn);
include("./includes/scripts.php");
include("./includes/footer.php");
