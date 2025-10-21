<?php

// Include reusable database functions
require_once 'init.php';

// Open DB connection
$connection = openConnection();

// Check connection error
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Data to Insert
$title = 'HI';
$author = 'hey';
$description = 'hey world';
$year = 2025;

// Prepare & Execute Query
$sql = "
    INSERT INTO books (title, author, description, year)
    VALUES (?, ?, ?, ?)
";

$stmt = $connection->prepare($sql);

if (!$stmt) {
    die("SQL Prepare Error: " . $connection->error);
}

$stmt->bind_param("sssi", $title, $author, $description, $year);

if ($stmt->execute()) {
    echo "Data inserted successfully!";
} else {
    echo "Execution Error: " . $stmt->error;
}

// Close Connection
$stmt->close();
closeConnection($connection);
?>
