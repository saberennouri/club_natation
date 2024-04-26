    
    <?php
    include('includes/header.php'); 
    include('includes/navbar.php'); 
    ?>

<div class="container mt-5">
        <h2 class="mb-4">Ajouter un comité</h2>
        <form action="addCommite.php" method="post">
            <div class="form-group">
                <label for="nom">Nom du comité :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" ></textarea>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable du comité :</label>
                <select class="form-control" id="responsable" name="responsable" required>
                    <option value="">Sélectionner le responsable</option>
                    <!-- Remplacez ces options par les valeurs réelles des utilisateurs depuis votre base de données -->
                    <option value="1">John Doe</option>
                    <option value="2">Jane Smith</option>
                    <option value="3">Alice Johnson</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>