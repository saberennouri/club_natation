<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>Gestion des utilisateurs du Club Natation</h2>
    <a href="createUser.php" class="btn btn-primary my-3">Ajouter utilisateur</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>                
                <th>Telephone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';
          
           
            // Sélection des utilisateurs avec leurs rôles
            $sql = "SELECT * from utilisateurs";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idrole=$row['role_id'];
  // selection roles
  $sqlrole="select * from roles where role_id='$idrole'";
  $resultRole=$conn->query($sqlrole);
  if($resultRole->num_rows> 0){ 
      $role=$resultRole->fetch_assoc();}
  
                    echo "<tr>";
                    echo "<td>" . $row['utilisateur_id'] . "</td>";
                    echo "<td>" . $row['nom'] . " " . $row['prenom'] . "</td>";                  
                    echo "<td>" . $row['telephone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mot_de_passe'] . "</td>";
                    echo "<td>" . $role['nom'] . "</td>";
                    echo "<td style='text-align:center'>
                            <a href='updateUser.php?id=" . $row['utilisateur_id'] . "' class='btn btn-warning'>Modifier</a>
                            <a href='deleteUser.php?id=" . $row['utilisateur_id'] . "' class='btn btn-danger'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun utilisateur trouvé</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
