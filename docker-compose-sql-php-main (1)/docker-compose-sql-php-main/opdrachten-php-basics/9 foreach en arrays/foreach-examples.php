<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays en foreach</title>
</head>

<body>
    <h1>Doelen</h1>
    <ul>
        <li>Arrays lezen en aanpassen</li>
        <li>Associative arrays gebruiken</li>
        <li>Met foreach door data lopen</li>
    </ul>
    <h1>Voorbeelden</h1>
    <p>Auto's in (Associative) arrays en foreach</p>
    <?php
    echo "<p>simpel array:<p>";

    $autos = ["Volvo", "Toyota"];
    foreach ($autos as $auto) {
        echo $auto . " ";
    }

    echo "<p>associative array 1:<p>";
    $autos1 = ["merk" => "Volvo", "kleur" => "zwart"];

    foreach ($autos1 as $key => $value) {
        echo "$key: $value<br>";
    }

    foreach ($autos1 as $eigenschap => $waarde) {
        echo "$eigenschap: $waarde<br>";
    }

    echo "<p>associative array 2:<p>";
    $autos2 = [
        [
            "merk" => "Toyota",
            "model" => "Corolla",
            "bouwjaar" => 2018
        ],
        [
            "merk" => "Volkswagen",
            "model" => "Golf",
            "bouwjaar" => 2020
        ],
        [
            "merk" => "Ford",
            "model" => "Focus",
            "bouwjaar" => 2016
        ]
    ];
    foreach ($autos2 as $auto) {
        echo "Merk: " . $auto["merk"] . "<br>";
        echo "Model: " . $auto["model"] . "<br>";
        echo "Bouwjaar: " . $auto["bouwjaar"] . "<br><br>";
    }


    echo "<p>associative array3:<p>";

    $autos3 = [
        "auto1" => [
            "merk" => "Toyota",
            "model" => "Corolla",
            "bouwjaar" => 2018
        ],
        "auto2" => [
            "merk" => "Volkswagen",
            "model" => "Golf",
            "bouwjaar" => 2020
        ],
        "auto3" => [
            "merk" => "Ford",
            "model" => "Focus",
            "bouwjaar" => 2016
        ]
    ];

    foreach ($autos3 as $key => $value) {
        echo "Auto: $key<br>";
        echo "Merk: " . $value["merk"] . "<br>";
        echo "Model: " . $value["model"] . "<br>";
        echo "Bouwjaar: " . $value["bouwjaar"] . "<br><br>";
    }

    foreach ($autos3 as $naam => $eigenschappen) {
        echo "Auto: $naam<br>";
        echo "Merk: " . $eigenschappen["merk"] . "<br>";
        echo "Model: " . $eigenschappen["model"] . "<br>";
        echo "Bouwjaar: " . $eigenschappen["bouwjaar"] . "<br><br>";
    }


    ?>
</body>

</html>