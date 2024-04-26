<?php
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="container mt-5">
    <h2>Gestion des athletes du Club Natation</h2>
    <a href="createAthlete.php" class="btn btn-primary my-3">Ajouter athlete</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de Naissance</th>
                <th>sexe</th>
                <th>Parent</th>
                <th>Entraineur</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT 
            a.athlete_id,
            a.prenom AS prenom_athlete,
            a.nom AS nom_athlete,
            a.date_naissance,
            a.sexe,
            p.prenom AS prenom_parent,
            p.nom AS nom_parent,
            e.prenom AS prenom_entraineur,
            e.nom AS nom_entraineur
            FROM 
                athletes a
            LEFT JOIN 
                parents p ON a.parent_id = p.parent_id
            LEFT JOIN 
            entraineurs e ON a.entraineur_id = e.entraineur_id  ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row['athlete_id'] . "</td>
                    <td>" . $row['prenom_athlete'] . "</td>
                    <td>" . $row['nom_athlete'] . "</td>
                    <td>" . $row['date_naissance'] . "</td> 
                    <td>" . $row['sexe'] . "</td>                  
                    <td>" . $row['prenom_parent'] . "_" . $row["nom_parent"] . "</td>
                    <td>" . $row['prenom_entraineur'] . "_" . $row["nom_entraineur"] . "</td>
                    <td>
                    <a href='readAthlete.php?id=" . $row['athlete_id'] . "' class='btn btn-info'>Lire</a>
                    <a href='updateAthlete.php?id=" . $row['athlete_id'] . "' class='btn btn-warning'>Modifier</a>
                    <a href='deleteAthlete.php?id=" . $row['athlete_id'] . "' class='btn btn-danger'>Supprimer</a>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun membre trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>