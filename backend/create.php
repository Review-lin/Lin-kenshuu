<?php
header("Content-Type: application/json");
require_once 'init.php';

$connection = openConnection();

// Read JSON body
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "Invalid JSON"]);
    exit;
}

$title = $data['title'] ?? '';
$author = $data['author'] ?? '';
$description = $data['description'] ?? '';
$year = $data['year'] ?? 0;

// Validate
if (empty($title) || empty($author)) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// Insert
$stmt = $connection->prepare("INSERT INTO books (title, author, description, year) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $title, $author, $description, $year);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
closeConnection($connection);
