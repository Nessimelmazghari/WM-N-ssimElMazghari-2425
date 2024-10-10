<?php
// Databaseconfiguratie
$host = 'ftp.nessimelmazghari-odiseebe.webhosting.be';
$dbname = 'ID449469_nessim';
$username = 'ID449469_nessim'; // Voeg hier je databasegebruikersnaam in
$password = 'Olala1234'; // Voeg hier je databasewachtwoord in

try {
    // Maak een verbinding met de database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Gegevens van de testgebruiker
    $test_username = 'testuser'; // Gebruikersnaam voor de testgebruiker
    $test_password = 'testpassword'; // Wachtwoord voor de testgebruiker

    // Hash het wachtwoord
    $hashed_password = password_hash($test_password, PASSWORD_DEFAULT);

    // Voer de SQL-query uit om de testgebruiker in te voegen
    $stmt = $pdo->prepare("INSERT INTO login_users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $test_username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

    echo "Testgebruiker succesvol toegevoegd!";
} catch (PDOException $e) {
    echo "Fout bij verbinding met de database: " . $e->getMessage();
}
?>
