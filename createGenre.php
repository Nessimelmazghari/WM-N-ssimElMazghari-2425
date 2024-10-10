<?php
header('Content-Type: application/json');
include 'php/inc/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$genre_name = $data['genre_name'];

if (!empty($genre_name)) {
    $sql = "INSERT INTO genres (genre_name) VALUES ('$genre_name')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Genre added successfully."]);
    } else {
        echo json_encode(["error" => "Error adding genre: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Genre name is required."]);
}

$conn->close();
?>
