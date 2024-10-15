<?php
// Verbinding met de database
require_once 'php/inc/db.php'; // Zorg ervoor dat je db.php juist configureert

header('Content-Type: application/json');

// Controleer of de request een POST is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal de JSON data uit de body
    $data = json_decode(file_get_contents('php://input'), true);

    // Valideer de input
    if (isset($data['first_name'], $data['last_name'], $data['birth_year'])) {
        $first_name = trim($data['first_name']);
        $last_name = trim($data['last_name']);
        $birth_year = (int)$data['birth_year'];

        // Controleer of het geboortejaar een geldig jaartal is
        if ($birth_year < 1900 || $birth_year > date("Y")) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Ongeldig geboortejaar. Voer een jaar in tussen 1900 en ' . date("Y") . '.'
            ]);
            exit;
        }

        // Voeg de nieuwe auteur toe aan de database
        try {
            $stmt = $conn->prepare("INSERT INTO authors (first_name, last_name, birth_year) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $first_name, $last_name, $birth_year); // Gebruik bind_param voor mysqli

            if ($stmt->execute()) {
                // Verstuur een succesmelding terug
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Auteur succesvol toegevoegd',
                    'author_id' => $conn->insert_id // Verkrijg de laatst toegevoegde ID
                ]);
            } else {
                // Als de uitvoer van de query faalt
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Database fout: kon de auteur niet toevoegen.'
                ]);
            }

            $stmt->close(); // Sluit de statement
        } catch (Exception $e) {
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
