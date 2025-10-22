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
$stmt = $conn->prepare("DELETE FROM books WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
closeConnection($conn);
