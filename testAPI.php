<?php
session_start();
header('Content-Type: application/json');

$host = 'ftp.nessimelmazghari-odiseebe.webhosting.be';
$dbname = 'ID449469_nessim';
$username = 'ID449469_nessim'; // Database username
$password = 'Olala1234'; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle the HTTP methods
    $method = $_SERVER['REQUEST_METHOD'];

    // Read users
    if ($method === 'GET') {
        $stmt = $pdo->query("SELECT * FROM users"); // Pas de tabelnaam aan indien nodig
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }
    
    // Create a new user
    if ($method === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $email = $data['email'];
        // Voeg validatie toe indien nodig
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(['name' => $name, 'email' => $email]);
        echo json_encode(['success' => true]);
    }
    
    // Update an existing user
    if ($method === 'PUT') {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->execute(['name' => $name, 'email' => $email, 'id' => $id]);
        echo json_encode(['success' => true]);
    }
    
    // Delete a user
    if ($method === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];

        // Controleer of de gebruiker bestaat
        $checkStmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $checkStmt->execute(['id' => $id]);
        if ($checkStmt->rowCount() > 0) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
