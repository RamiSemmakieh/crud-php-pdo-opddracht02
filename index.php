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
    <legend class="legend"><span>Maak je eigen pizza</span></legend>

        <label for="bodemformaat"><h4>Bodemformaat:</h4>
            <select id="bodemformaat" name="bodemformaat">
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
            </select>
        </label>


        <label for="saus"><h4>Saus:</h4>
            <select id="saus" name="saus">
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
                        <input type="radio" name="pizzatopping" value="vegan" id="pizzatopping" required/>
                    </label>
                    <label for="pizzatopping">vegatarisch
                        <input type="radio" name="pizzatopping" value="vegatarisch" id="pizzatopping" required/>
                    </label>
                    <label for="pizzatopping">vlees
                    <input type="radio" name="pizzatopping" value="vlees" id="pizzatopping" required/>
                    </label>
                </div>
        </label>

        <label for="kruiden">

        <h4>Kruiden</h4>
        <div class="box">
            <label for="kruiden">Petersellie
                <input type="checkbox" id="kruiden" name="kruiden" value="Petersellie">
            </label>
                <label for="kruiden">Oregano
                <input type="checkbox" id="kruiden" name="kruiden" value="Oregano">
            </label>
            <label for="kruiden">Chli flakes
                <input type="checkbox" id="kruiden" name="kruiden" value="ChliFlakes" >
            </label>

            <label for="kruiden">Zwarte peper
                <input type="checkbox" id="kruiden" name="kruiden" value="ZwartePeper">
            </label>
        </div>
                    
    </label>

        <label for="Bestel">
            <input type="submit" id="Bestel" name="Bestel" value="Bestel" >
        </label>              
</fieldset>

        
    </form>
</body>
</html>