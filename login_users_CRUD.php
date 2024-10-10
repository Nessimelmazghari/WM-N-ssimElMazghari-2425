<?php
// Voeg een nieuwe gebruiker toe met een optie voor admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $is_admin = isset($data['is_admin']) ? $data['is_admin'] : 0; // Admin-waarde instellen, standaard 0

    try {
        $stmt = $pdo->prepare("INSERT INTO login_users (username, password, is_admin) VALUES (:username, :password, :is_admin)");
        $stmt->execute([':username' => $username, ':password' => $password, ':is_admin' => $is_admin]);
        http_response_code(201); // Created
        echo json_encode(['id' => $pdo->lastInsertId(), 'username' => $username, 'is_admin' => $is_admin]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database query failed: ' . $e->getMessage()]);
    }
}
?>
