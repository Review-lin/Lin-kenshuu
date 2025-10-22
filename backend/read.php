<?php
header("Content-Type: application/json");
require_once 'init.php';

$conn = openConnection();
$result = $conn->query("SELECT id, title, author, description, year FROM books ORDER BY id DESC");

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);
$result->free();
closeConnection($conn);
