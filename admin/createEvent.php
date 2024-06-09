<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container mt-5">
        <h2 class="mb-4">Ajouter un Événement</h2>
        <form method="post" action="addEvent.php">
            <div class="form-group">
                <label for="nom">Nom de l'Événement :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="date_evenement">Date:</label>
                <input type="date" class="form-control" id="date_evenement" name="date_evenement" required>
            </div>
            <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>
            <div class="form-group">
                <label for="heuredebut">Heure Début :</label>
                <input type="time" name="heuredebut" id="heuredebut">
            
                <label for="heurefin">Heure Fin :</label>
                <input type="time" name="heurefin" id="heurefin">
            </div>           
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>