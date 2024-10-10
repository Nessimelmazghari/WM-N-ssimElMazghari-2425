<?php
// Verbinding met de database
require_once 'php/inc/db.php'; // Zorg ervoor dat db.php de MySQLi-verbinding bevat

header('Content-Type: application/json');

// Controleer of de request een PUT is
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Haal de JSON data uit de body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'], $data['first_name'], $data['last_name'], $data['birth_year'])) {
        $id = $data['id'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $birth_year = $data['birth_year'];

        // Werk de gegevens van de auteur bij in de database
        try {
            $stmt = $conn->prepare("UPDATE authors SET first_name = ?, last_name = ?, birth_year = ? WHERE id = ?");
            $stmt->bind_param("ssii", $first_name, $last_name, $birth_year, $id);

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Auteur succesvol bijgewerkt'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Fout bij het bijwerken van de auteur: ' . $stmt->error
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
            'message' => 'Verkeerde input: id, voornaam, achternaam en geboortejaar zijn verplicht.'
        ]);
    }

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ongeldige request-methode. Gebruik PUT.'
    ]);
}
?>
