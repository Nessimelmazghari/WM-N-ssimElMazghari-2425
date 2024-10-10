<?php
session_start();
header('Content-Type: application/json');

// Database configuration
$host = 'ftp.nessimelmazghari-odiseebe.webhosting.be';
$dbname = 'ID449469_nessim';
$username = 'ID449469_nessim';
$password = 'Olala1234';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check the request method
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            // Read all users
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                $stmt = $pdo->prepare("SELECT * FROM login_users");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($users);
            } else {
                echo json_encode(['error' => 'Unauthorized access']);
            }
            break;

        case 'POST':
            // Create a new user
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $username = $data['username'];
                $password = password_hash($data['password'], PASSWORD_BCRYPT);
                $is_admin = $data['is_admin'] ? 1 : 0;

                $stmt = $pdo->prepare("INSERT INTO login_users (username, password, is_admin) VALUES (:username, :password, :is_admin)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':is_admin', $is_admin);
                $stmt->execute();

                echo json_encode(['message' => 'User created successfully']);
            } else {
                echo json_encode(['error' => 'Unauthorized access']);
            }
            break;

        case 'PUT':
            // Update a user
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'];
                $username = $data['username'];
                $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null;
                $is_admin = $data['is_admin'] ? 1 : 0;

                if ($password) {
                    $stmt = $pdo->prepare("UPDATE login_users SET username = :username, password = :password, is_admin = :is_admin WHERE id = :id");
                    $stmt->bindParam(':password', $password);
                } else {
                    $stmt = $pdo->prepare("UPDATE login_users SET username = :username, is_admin = :is_admin WHERE id = :id");
                }

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':is_admin', $is_admin);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo json_encode(['message' => 'User updated successfully']);
            } else {
                echo json_encode(['error' => 'Unauthorized access']);
            }
            break;

        case 'DELETE':
            // Delete a user
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'];

                $stmt = $pdo->prepare("DELETE FROM login_users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo json_encode(['message' => 'User deleted successfully']);
            } else {
                echo json_encode(['error' => 'Unauthorized access']);
            }
            break;

        default:
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
