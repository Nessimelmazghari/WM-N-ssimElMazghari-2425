<?php
header('Content-Type: application/json');
include 'php/inc/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM genres WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $genre = $result->fetch_assoc();
    echo json_encode($genre);
} else {
    echo json_encode(["error" => "Genre not found."]);
}

$conn->close();
?>
