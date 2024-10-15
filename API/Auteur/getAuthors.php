<?php
// Include the database connection file
include('php/inc/db.php');

// Set the response header to JSON
header('Content-Type: application/json');

// Prepare the SQL statement
$query = "SELECT * FROM authors";

if ($result = $conn->query($query)) {
    // Fetch all authors
    $authors = $result->fetch_all(MYSQLI_ASSOC);
    
    // Check if authors are found
    if ($authors) {
        echo json_encode($authors);
    } else {
        echo json_encode([]);
    }
} else {
    // Handle query error
    http_response_code(500);
    echo json_encode(["error" => "Database query failed: " . $conn->error]);
}

// Close the database connection
$conn->close();
?>
