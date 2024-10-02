<?php
// Verbinding met de database
require_once 'php/inc/db.php';

header('Content-Type: application/json');

// Controleer of de request een DELETE is
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Haal de JSON data uit de body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        // Verwijder de auteur uit de database
        try {
            $stmt = $pdo->prepare("DELETE FROM authors WHERE id = ?");
            $stmt->execute([$id]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Auteur succesvol verwijderd'
            ]);

        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database fout: ' . $e->getMessage()
            ]);
        }

    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Verkeerde input: id is verplicht.'
        ]);
    }

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ongeldige request-methode. Gebruik DELETE.'
    ]);
}
?>
