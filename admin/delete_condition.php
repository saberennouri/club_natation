<?php
include 'config.php';

if (isset($_GET['condition_id'])) {
    $condition_id = $_GET['condition_id'];

    $sql = "DELETE FROM physical_conditions WHERE condition_id='$condition_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='fitness.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
