<?php
$garage = [
    [
        "merk" => "BMW M50",
        "kleur" => "zwart",
        "kmstand" => 120000
    ],
    [
        "merk" => "Fiat Multipla",
        "kleur" => "groen",
        "kmstand" => 95000
    ],
];

foreach ($garage as $auto) {
    echo "Merk: " . $auto["merk"] . "<br>";
    echo "Kleur: " . $auto["kleur"] . "<br>";
    echo "Kmstand: " . $auto["kmstand"] . "<br><br>";
}
?>