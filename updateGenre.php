<?php
header('Content-Type: application/json');
include 'php/inc/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$genre_name = $data['genre_name'];

if (!empty($genre_name) && !empty($id)) {
    $sql = "UPDATE genres SET genre_name = '$genre_name' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Genre updated successfully."]);
    } else {
        echo json_encode(["error" => "Error updating genre: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Genre name and ID are required."]);
}

$conn->close();
?>
