<?php
header("Content-Type: application/json");
require_once 'init.php';

$conn = openConnection();

// Get pagination range from frontend (e.g. ?start=0&limit=20)
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;

// Fetch limited number of books
$stmt = $conn->prepare("SELECT id, title, author, description, year FROM books ORDER BY id DESC LIMIT ?, ?");
$stmt->bind_param("ii", $start, $limit);
$stmt->execute();

$result = $stmt->get_result();
$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);

$result->free();
$stmt->close();
closeConnection($conn);
