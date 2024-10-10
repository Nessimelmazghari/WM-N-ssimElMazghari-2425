<?php
require 'php/inc/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM authors WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $author = $result->fetch_assoc();
        echo json_encode($author);
    } else {
        echo json_encode(["error" => "Author not found."]);
    }
} else {
    echo json_encode(["error" => "Invalid ID."]);
}

$conn->close();
?>
