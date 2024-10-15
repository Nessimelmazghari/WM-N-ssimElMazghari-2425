<?php
include 'php/inc/db.php';

header('Content-Type: application/json');

$id = $_GET['id'];

$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'Book not found']);
}

$stmt->close();
$conn->close();
?>
