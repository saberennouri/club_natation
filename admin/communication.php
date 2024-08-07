<?php
session_start();
include "./includes/navParent.php";
include "./includes/header.php";
include "./config.php";

if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = 'User_' . rand(1000, 9999);
}

$email = $_SESSION['email'];

// Récupérer la liste des entraîneurs
$sql_entraineurs = "SELECT entraineur_id, prenom, nom FROM entraineurs";
$result_entraineurs = $conn->query($sql_entraineurs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-box {
            max-height: 500px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Chatbot</h2>
    <div class="form-group">
        <label for="trainer-select">Select Trainer:</label>
        <select class="form-control" id="trainer-select">
            <?php
            if ($result_entraineurs->num_rows > 0) {
                while($row = $result_entraineurs->fetch_assoc()) {
                    echo "<option value='".$row['entraineur_id']."'>".$row['prenom']." ".$row['nom']."</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="chat-box border p-3 mb-3">
        <!-- Messages will be loaded here via AJAX -->
    </div>
    <form id="chat-form" class="needs-validation" novalidate>
        <div class="form-group">
            <input type="text" class="form-control" name="message" id="message" placeholder="Type a message" required>
            <div class="invalid-feedback">Please enter a message.</div>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
    <?php
include "./includes/footer.php";
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    function loadMessages(trainerId) {
        $.ajax({
            url: 'load_messages.php',
            method: 'GET',
            data: { entraineur_id: trainerId },
            success: function(data) {
                $('.chat-box').html(data);
                $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
            }
        });
    }

    var trainerId = $('#trainer-select').val();
    loadMessages(trainerId);

    $('#trainer-select').change(function() {
        trainerId = $(this).val();
        loadMessages(trainerId);
    });

    setInterval(function() {
        loadMessages(trainerId);
    }, 3000);

    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'send_message.php',
            method: 'POST',
            data: { 
                message: $('#message').val(),
                entraineur_id: trainerId
            },
            success: function() {
                $('#message').val('');
                loadMessages(trainerId);
            }
        });
    });
});

// JavaScript for Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

