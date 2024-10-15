<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database verbinding
include 'php/inc/db.php';

// Haal auteur-ID op uit de URL-parameter
$author_id = isset($_GET['author_id']) ? intval($_GET['author_id']) : 0;

$sql = "SELECT books.id, books.title, books.isbn, books.description, genres.genre_name 
        FROM books 
        JOIN genres ON books.genre_id = genres.id 
        WHERE books.author_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $author_id);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);

$stmt->close();
$conn->close();
?>
