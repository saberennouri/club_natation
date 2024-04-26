<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
 
<div class="container mt-5">
        <h2 class="mb-4">Ajouter un entraineur</h2>
        <form method="post" action="addCoach.php">
        <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de Téléphone :</label>
                <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" required>
            </div>
           
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </form>

    <?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>