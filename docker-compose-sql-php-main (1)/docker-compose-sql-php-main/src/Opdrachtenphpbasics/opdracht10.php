<?php
$float1 = 3.14;
$float2 = 9.81;
$resultaat = $float1 + $float2;

echo $resultaat;
echo "<br>";

if (is_float($resultaat)) {
    echo "resultaat is_float is true";
} else {
    echo "resultaat is_float is false";
}

echo "<br>";

if ($resultaat > PHP_FLOAT_EPSILON) {
    echo "resultaat is groter dan PHP_FLOAT_EPSILON";
} else {
    echo "resultaat is niet groter dan PHP_FLOAT_EPSILON";
}
?>