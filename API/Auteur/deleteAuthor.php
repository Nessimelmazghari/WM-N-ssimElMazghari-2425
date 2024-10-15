<?php
// Verbinding met de database
require_once 'php/inc/db.php'; // Zorg ervoor dat db.php de MySQLi-verbinding bevat

header('Content-Type: application/json');

// Controleer of de request een DELETE is
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Haal de JSON data uit de body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        // Verwijder de auteur uit de database
        try {
            $stmt = $conn->prepare("DELETE FROM authors WHERE id = ?");
            $stmt->bind_param("i", $id); // 'i' geeft aan dat de parameter een integer is

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Auteur succesvol verwijderd'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Fout bij het verwijderen van de auteur: ' . $stmt->error
                ]);
            }

            $stmt->close();

        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Er is een fout opgetreden: ' . $e->getMessage()
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
