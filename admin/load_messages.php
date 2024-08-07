<?php
include "./config.php";

$sql = "SELECT * FROM chat_messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>" . htmlspecialchars($row['user']) . ":</strong> " . htmlspecialchars($row['message']) . " <small>(" . $row['timestamp'] . ")</small></div>";
    }
} else {
    echo "<div>No messages yet.</div>";
}

$conn->close();
?>
