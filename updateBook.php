<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'php/inc/db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$title = $data['title'];
$isbn = $data['isbn'];
$description = $data['description'];
$author_id = $data['author_id'];
$genre_id = $data['genre_id'];

$query = "UPDATE books SET title=?, isbn=?, description=?, author_id=?, genre_id=? WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssiii", $title, $isbn, $description, $author_id, $genre_id, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['message' => 'Book updated successfully.']);
} else {
    echo json_encode(['error' => 'Failed to update book.']);
}

$stmt->close();
$conn->close();
?>
