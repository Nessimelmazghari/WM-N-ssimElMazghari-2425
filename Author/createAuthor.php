<?php
// Verbinding met de database
require_once 'php/inc/db.php'; // Zorg ervoor dat je db.php juist configureert

header('Content-Type: application/json');

// Controleer of de request een POST is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal de JSON data uit de body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['first_name'], $data['last_name'], $data['birth_year'])) {
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $birth_year = $data['birth_year'];

        // Voeg de nieuwe auteur toe aan de database
        try {
            $stmt = $pdo->prepare("INSERT INTO authors (first_name, last_name, birth_year) VALUES (?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $birth_year]);

            // Verstuur een succesmelding terug
            echo json_encode([
                'status' => 'success',
                'message' => 'Auteur succesvol toegevoegd',
                'author_id' => $pdo->lastInsertId()
            ]);

        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database fout: ' . $e->getMessage()
            ]);
        }

    } else {
        // Als vereiste data ontbreekt
        echo json_encode([
            'status' => 'error',
            'message' => 'Verkeerde input: voornaam, achternaam en geboortejaar zijn verplicht.'
        ]);
    }

} else {
    // Als de request geen POST is
    echo json_encode([
        'status' => 'error',
        'message' => 'Ongeldige request-methode. Gebruik POST.'
    ]);
}
?>
