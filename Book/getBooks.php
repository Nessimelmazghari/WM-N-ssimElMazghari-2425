<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'php/inc/db.php';

header('Content-Type: application/json');

$query = "SELECT books.*, authors.first_name, authors.last_name FROM books JOIN authors ON books.author_id = authors.id";
$result = $conn->query($query);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);

$conn->close();
?>
