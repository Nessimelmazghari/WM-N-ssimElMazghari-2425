<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'php/inc/db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$isbn = $data['isbn'];
$description = $data['description'];
$author_id = $data['author_id'];
$genre_id = $data['genre_id'];

$query = "INSERT INTO books (title, isbn, description, author_id, genre_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssiii", $title, $isbn, $description, $author_id, $genre_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['message' => 'Book created successfully.']);
} else {
    echo json_encode(['error' => 'Failed to create book.']);
}

$stmt->close();
$conn->close();
?>
