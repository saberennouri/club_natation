<?php
session_start();
include "./config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO chat_messages (user, message) VALUES ('$user', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
