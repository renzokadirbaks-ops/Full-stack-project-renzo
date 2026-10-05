<?php
$prijs = 50;
$btwPercentage = 21;

$btw=$prijs * ($btwPercentage/100) ;
$totaalPrijs = $prijs+$btw;

echo "BTW: ".$btw ;
echo "<br>" ;
echo "Totale prijs: " . $totaalPrijs;
?>