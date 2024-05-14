<?php

include "./includes/header.php";
include "./includes/navbar.php";
?>


<div class="container">
    <h2>Changer le mot de passe</h2>
    <form method="post" action="process_password.php">
        <div class="form-group">
            <label for="old_password">Mot de passe actuel:</label>
            <input type="password" class="form-control" id="old_password" name="old_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Nouveau mot de passe:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmer le nouveau mot de passe:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary" id="changer" name="changer">Changer le mot de passe</button>
    </form>
</div>

<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>
