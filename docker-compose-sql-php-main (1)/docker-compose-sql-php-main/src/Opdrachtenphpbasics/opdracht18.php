<?php
$getallen = array(3.45, 7.89, 2.1, 9.65);

foreach ($getallen as $getal) {
    $afgerond = round($getal);
    echo "Origineel: " . $getal . " - Afgerond: " . $afgerond;
    echo "<br>";
}
?>