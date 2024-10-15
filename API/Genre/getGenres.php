<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'php/inc/db.php';

header('Content-Type: application/json');

$query = "SELECT * FROM genres";
$result = $conn->query($query);

$genres = [];
while ($row = $result->fetch_assoc()) {
    $genres[] = $row;
}

echo json_encode($genres);

$conn->close();
?>
