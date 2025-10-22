<?php
header("Content-Type: application/json");
require_once 'init.php';

$conn = openConnection();
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$id = $data['id'];
$title = $data['title'];
$author = $data['author'];
$description = $data['description'];
$year = $data['year'];

$stmt = $conn->prepare("UPDATE books SET title=?, author=?, description=?, year=? WHERE id=?");
$stmt->bind_param("sssii", $title, $author, $description, $year, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
closeConnection($conn);
