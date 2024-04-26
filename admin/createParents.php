<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un Nouveau Parent</h2>
        <form method="POST" action="addParents.php">
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de Téléphone :</label>
                <input type="text" name="numero_telephone" id="numero_telephone" class="form-control">
            </div>
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>