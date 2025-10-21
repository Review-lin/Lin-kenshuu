<?php
require_once 'init.php';

// Open DB connection
$connection = openConnection();

// Check connection
if ($connection->connect_error) {
    die("Connection Error: " . $connection->connect_error);
}

// Data to update
$id          = 1;
$title       = 'Updated Title';
$author      = 'Updated Author';
$description = 'Updated description text';
$year        = 2026;

// Prepare SQL statement
$sql = "UPDATE books 
        SET title = ?, author = ?, description = ?, year = ? 
        WHERE id = ?";

$stmt = $connection->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}

// Bind parameters and execute
$stmt->bind_param("sssii", $title, $author, $description, $year, $id);

if ($stmt->execute()) {
    echo "Book updated successfully.<br>";
} else {
    echo "Error: " . $stmt->error . "<br>";
}

// Clean up
$stmt->close();
closeConnection($connection);
?>
