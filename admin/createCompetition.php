<?php

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

    <div class="container mt-5">
        <h2>Ajouter une Compétition</h2>
        <form method="post" action="addCompetiton.php">
            <div class="form-group">
                <label for="nom">Nom de la Compétition :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="date">Date de la Compétition :</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>
           
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>

