<?php
require_once 'init.php';

// Open DB connection
$connection = openConnection();

// Check connection
if ($connection->connect_error) {
    die("Connection Error: " . $connection->connect_error);
}

// ID to delete
$id = 1;

// Prepare SQL statement
$sql = "DELETE FROM books WHERE id = ?";

$stmt = $connection->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}

// Bind parameter and execute
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Book with ID $id deleted successfully.<br>";
    } else {
        echo "No record found with ID $id.<br>";
    }
} else {
    echo "Error: " . $stmt->error . "<br>";
}

// Clean up
$stmt->close();
closeConnection($connection);
?>
