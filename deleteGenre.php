<?php
header('Content-Type: application/json');
include 'php/inc/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if (!empty($id)) {
    $sql = "DELETE FROM genres WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Genre deleted successfully."]);
    } else {
        echo json_encode(["error" => "Error deleting genre: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Genre ID is required."]);
}

$conn->close();
?>
