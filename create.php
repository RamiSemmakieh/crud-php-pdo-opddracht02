<?php
/**
 * We gaan een verbinding maken met de MySQL database
 */
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo 'Er is een verbinding gemaakt met de mysqldatabase';
    } else {
        echo 'Interne servererror, neem contact op met de databasebeheerder';
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

/**
 * We gaan een sql-query maken voor het wegschrijven van de formuliergegevens in de tabel Persoon
 */
// Schrijf de sql-insertquery
$sql = "INSERT INTO pizza   (Id
                            ,Bodemformaat
                            ,Saus
                            ,Pizzatopping
                            ,Kruiden)
        VALUES              (NULL
                            ,:bodemformaat
                            ,:saus
                            ,:pizzatopping
                            ,:kruiden);";

// Maak de sql-query gereed om te worden afgevuurd op de mysql-database
$statement = $pdo->prepare($sql);

// De bindValue method bind de $_POST waarde aan de placeholder
$statement->bindValue(':bodemformaat', $_POST['bodemformaat'], PDO::PARAM_STR);
$statement->bindValue(':saus', $_POST['saus'], PDO::PARAM_STR);
$statement->bindValue(':pizzatopping', $_POST['pizzatopping'], PDO::PARAM_STR);
$statement->bindValue(':kruiden', $_POST['kruiden'], PDO::PARAM_STR);

// Voer de sql-query uit op de database
$statement->execute();

echo "Bestelling is geplaatst";
// Link door naar read.php voor een overzicht van de gegevens in tabel Persoon
header('Refresh:2; url=read.php');



