<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'php/inc/db.php';

header('Content-Type: application/json');

// Gebruik een LEFT JOIN om boeken op te halen, ook als ze geen auteur hebben
$query = "SELECT books.*, authors.first_name, authors.last_name,genres.genre_name FROM books LEFT JOIN authors ON books.author_id = authors.id LEFT JOIN 
    genres ON books.genre_id = genres.id";
$result = $conn->query($query);

$books = [];
while ($row = $result->fetch_assoc()) {
    // Vervang NULL-waarden door "onbekend" of 0
    $row['first_name'] = $row['first_name'] ?? 'onbekend'; // Vervang NULL door "onbekend"
    $row['last_name'] = $row['last_name'] ?? 'onbekend';   // Vervang NULL door "onbekend"


    $books[] = $row;
}

echo json_encode($books);

$conn->close();
?>
