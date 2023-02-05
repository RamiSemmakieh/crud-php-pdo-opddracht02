<?php
// Voeg de verbindingsgegevens toe aan de delete.php
require('config.php');

// Maak de data sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    if ($pdo) {
        // echo "Er is een verbinding met de database";
    } else {
        echo "Interne server-error";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}

// Maak een delete query om een record in de tabel Persoon te verwijderen
$sql = "DELETE FROM pizza
        WHERE Id = :Id";

// Maak de query klaar voor het binden van een waarde aan de placeholder
$statement = $pdo->prepare($sql);

// Koppel de waarde van $_GET['id'] aan de placeholder :id
$statement->bindValue(':Id', $_GET['id'], PDO::PARAM_INT);

// Voer de query uit
$result = $statement->execute();

if ($result) {
    // Geef een melding dat het gelukt is
    echo "Bestelling nummer = {$_GET['id']} is verwijderd";    
} else {
    echo "Interne server-error. Record is niet verwijderd...probeer het opnieuw";
}

header('Refresh:2; url=read.php');



