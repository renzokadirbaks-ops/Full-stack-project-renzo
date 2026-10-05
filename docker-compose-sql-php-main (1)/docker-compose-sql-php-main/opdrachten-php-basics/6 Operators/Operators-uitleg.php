Operators:

Rekenkundige Operators
Rekenkundige operators worden gebruikt voor eenvoudige wiskundige bewerkingen zoals optellen, aftrekken,
vermenigvuldigen, delen en het vinden van de restwaarde
<?php
$a = 2;
$b = 3;

echo $a + $b; // + Optellen 
echo $a - $b; // - Aftrekken
echo $a * $b; // * Vermenigvuldigen
echo $a / $b; // / Delen
echo $a % $b; // % Modulus (restwaarde)
?>

Assignment Operators
Assignment operators worden gebruikt om waarden toe te wijzen aan variabelen.
De meest eenvoudige en bekende is =, maar er zijn ook combinaties die rekenkundige bewerkingen en toewijzing combineren.
<?php
$a = 5;

echo $a = 5; // Toekenning
echo $a += 5; // Optellen en toekennen
echo $a -= 5; // Aftrekken en toekennen
echo $a *= 5; // Vermenigvuldigen en toekennen
echo $a /= 5; // Delen en toekennen
echo $a %= 5; // Modulus en toekennen
?>

Vergelijkingsoperators
Vergelijkingsoperators worden gebruikt om twee waarden met elkaar te vergelijken.
Ze geven een booleaanse waarde (true of false) terug, afhankelijk van de uitkomst van de vergelijking.
<?php
$a = 5;
$b = 10;

var_dump($a == $b);   // == Gelijk aan (true als $a gelijk is aan $b)
var_dump($a === $b);  // === Identiek aan (true als $a gelijk is aan $b én hetzelfde type heeft)
var_dump($a != $b);   // != Niet gelijk aan (true als $a niet gelijk is aan $b)
var_dump($a <> $b);   // <> Niet gelijk aan (zelfde als !=)
var_dump($a !== $b);  // !== Niet identiek (true als $a niet gelijk is aan $b of niet hetzelfde type heeft)
var_dump($a < $b);    // < Kleiner dan
var_dump($a > $b);    // > Groter dan
var_dump($a <= $b);   // <= Kleiner dan of gelijk aan
var_dump($a >= $b);   // >= Groter dan of gelijk aan
?>

Logische Operators
Logische operators worden gebruikt om logische bewerkingen uit te voeren,
vaak in combinatie met vergelijkingsuitdrukkingen. Ze geven een booleaanse waarde terug.
<?php
$x = true;
$y = false;

var_dump($x and $y);  // and Waar als beide waarden waar zijn
var_dump($x or $y);   // or Waar als één van beide waarden waar is
var_dump($x && $y);   // && En (zelfde als and, maar hogere prioriteit)
var_dump($x || $y);   // || Of (zelfde als or, maar hogere prioriteit)
var_dump(!$x);        // ! Niet (waar als $x onwaar is)
?>

Incrementeer- en Decrementeeroperators
Deze operators worden gebruikt om de waarde van een variabele met 1 te verhogen of verlagen.
<?php
$a = 5;

echo ++$a;  // ++$a Pre-increment: verhoogt $a met 1, daarna geeft het $a terug
echo $a++;  // $a++ Post-increment: geeft $a terug, daarna verhoogt het $a met 1
echo --$a;  // --$a Pre-decrement: verlaagt $a met 1, daarna geeft het $a terug
echo $a--;  // $a-- Post-decrement: geeft $a terug, daarna verlaagt het $a met 1
?>

String Operators
String operators worden gebruikt om tekst (strings) samen te voegen of toe te voegen aan een bestaande string.
<?php
$a = "Hello ";
$b = "World!";

echo $a . $b;   // . Concateneert (verbindt) $a en $b
$a .= $b;       // .= Concateneert $b aan $a en kent het resultaat toe aan $a
echo $a;        // Geeft "Hello World!" weer
?>

Array Operators
Array operators worden gebruikt om arrays met elkaar te combineren of te vergelijken.
<?php
$array1 = ["a" => "apple", "b" => "banana"];
$array2 = ["a" => "apple", "b" => "banana", "c" => "cherry"];

var_dump($array1 + $array2);   // + Unie: voegt arrays samen (zonder dubbele sleutels)
var_dump($array1 == $array2);  // == Gelijk: true als $array1 en $array2 dezelfde sleutel/waarde-paren hebben
var_dump($array1 === $array2); // === Identiek: true als $array1 en $array2 dezelfde sleutel/waarde-paren en in dezelfde volgorde staan
var_dump($array1 != $array2);  // != Niet gelijk
var_dump($array1 <> $array2);  // <> Niet gelijk (zelfde als !=)
var_dump($array1 !== $array2); // !== Niet identiek
?>

Extra:
Spaceship Operator
De spaceship-operator (<=>) wordt gebruikt om drie mogelijke uitkomsten te geven voor een vergelijking: -1, 0, of 1.
    Handig voor sorteringen.
    <?php
    $a = 5;
    $b = 10;

    echo $a <=> $b;  // Geeft -1 als $a kleiner is dan $b, 0 als ze gelijk zijn, en 1 als $a groter is
    ?>

    Type Operators
    Type operators worden gebruikt om te controleren of een variabele een bepaalde klasse of subtype heeft. Deze zijn
    meer relevant in objectgeoriënteerd programmeren.
    <?php
    class Fruit
    {
    }
    class Apple extends Fruit
    {
    }

    $apple = new Apple();

    var_dump($apple instanceof Apple);   // Geeft true als $apple een instantie van Apple is
    var_dump($apple instanceof Fruit);   // Geeft true als $apple een instantie van Fruit (of subklasse) is
    ?>