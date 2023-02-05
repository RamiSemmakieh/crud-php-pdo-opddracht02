<?php
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding";
    } else {
        // echo "Interne error";
    }
} catch(PDOException $e) {
    $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        $sql = "UPDATE pizza
                SET    Bodemformaat = :Bodemformaat,
                        Saus = :Saus,
                        Pizzatopping = :Pizzatopping
                        Kruiden = :Kruiden
                WHERE  Id = :Id";

        $statement = $pdo->prepare($sql);
        $statement->bindValue(':Id', $_POST['id'], PDO::PARAM_INT);
        $statement->bindValue(':Bodemformaat', $_POST['bodemformaat'], PDO::PARAM_STR);
        $statement->bindValue(':Saus', $_POST['saus'], PDO::PARAM_STR);
        $statement->bindValue(':Pizzatopping', $_POST['pizzatopping'], PDO::PARAM_STR);
        $statement->bindValue(':Kruiden', $_POST['kruiden'], PDO::PARAM_STR);

        $statement->execute();

        echo 'De bestelling is aangepast';
        header('Refresh:3; url=read.php');    
        
    } catch(PDOException $e) {
        echo 'Het is niet gelukt om de bestelling te aanpassen';
        header('Refresh:3; url=read.php');
    }
    exit();
} 

$sql = "SELECT Id
              ,Bodemformaat as BO
              ,Saus as SA
              ,Pizzatopping as TP
              ,Kruiden as KR
        FROM pizza
        WHERE Id = :Id";

$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/pizza-icon">
    <title>Maak je eigen pizza</title>
    <style>
        body * { box-sizing: border-box;}
        form {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        fieldset {
            display: flex;
            width: calc(100% - .5rem);
            margin: .5em 3;
            flex-direction: column;
            border: 2px solid #00aeef;
            background-color: rgba(255,255,255,.5);
            border-radius: .5rem;
        }
        fieldset > label {
            width: 100%;
            margin-top: .5em;
        }
        label > input:not([type="radio"]):not([type="checkbox"]),
        label > textarea,
        label > select {
            width: 100%;
            margin-top:.5em;
        }
    </style>
</head>
<body>
    <form action="create.php" method="post">
    <fieldset class="field2">
    <legend class="legend"><span>Bestelling Wijzigen</span></legend>

        <label for="bodemformaat"><h4>Bodemformaat:</h4>
            <select id="bodemformaat" name="bodemformaat" value="<?= $result->BO ?>">
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
            </select>
        </label>


        <label for="saus"><h4>Saus:</h4>
            <select id="saus" name="saus" value="<?= $result->SA ?>">
                <option>Tomatensaus</option>
                <option>Extra Tomatensaus</option>
                <option>Spicy Tomatensaus</option>
                <option>BBQ saus</option>
                <option>Creme fraiche</option>
            </select>
        </label>
         
        <label for="pizzatopping">
                <h4>Pizzatoppings:</h4>
                <div class="box">
                    <label for="pizzatopping">vegan
                        <input type="radio" name="pizzatopping" value="vegan" id="pizzatopping" value="<?= $result->TP ?>" required/>
                    </label>
                    <label for="pizzatopping">vegatarisch
                        <input type="radio" name="pizzatopping" value="vegatarisch" id="pizzatopping" value="<?= $result->TP ?>" required/>
                    </label>
                    <label for="pizzatopping">vlees
                    <input type="radio" name="pizzatopping" value="vlees" id="pizzatopping" value="<?= $result->TP ?>" required/>
                    </label>
                </div>
        </label>

        <label for="kruiden">

        <h4>Kruiden</h4>
        <div class="box">
            <label for="kruiden">Petersellie
                <input type="checkbox" id="kruiden" name="kruiden" value="Petersellie" value="<?= $result->KR ?>">
            </label>
                <label for="kruiden">Oregano
                <input type="checkbox" id="kruiden" name="kruiden" value="Oregano"value="<?= $result->KR ?>">
            </label>
            <label for="kruiden">Chli flakes
                <input type="checkbox" id="kruiden" name="kruiden" value="ChliFlakes" value="<?= $result->KR ?>">
            </label>

            <label for="kruiden">Zwarte peper
                <input type="checkbox" id="kruiden" name="kruiden" value="ZwartePeper" value="<?= $result->KR ?>">
            </label>
        </div>
                    
    </label>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <label for="Bestel">
            <input type="submit" id="Bestel" name="Bestel" value="Wijzigen opslaan" >
        </label>              
</fieldset>

        
    </form>
</body>
</html>