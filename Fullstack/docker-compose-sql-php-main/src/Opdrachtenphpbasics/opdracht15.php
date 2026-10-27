<?php
$saldo = 1000;
$maandelijkseStorting = 50;
$rentePercentage = 5;

for ($maand = 1; $maand <= 12; $maand++) {
    $saldo += $maandelijkseStorting;
}

$saldo += $saldo * ($rentePercentage / 100);

echo "Eindsaldo: " . $saldo;
?>