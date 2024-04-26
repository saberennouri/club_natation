<?php 
    include('./admin/includes/header.php');
    include('./admin/includes/navbar.php')
?>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Devenir Membre</h2>
        <form method="POST" action="inscription.php">
            <div class="form-group">
                <label for="role">Je suis :</label>
                <select name="role" id="role" class="form-control">
                    <option value="parent">Parent</option>
                    <option value="athlete">Athlète</option>
                    <option value="coach">Coach</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" name="inscription" class="btn btn-primary">Devenir Membre</button>
        </form>
    </div>
<?php
    include('admin/includes/script.php');
    include('./admin/includes/footer.php');
?>
