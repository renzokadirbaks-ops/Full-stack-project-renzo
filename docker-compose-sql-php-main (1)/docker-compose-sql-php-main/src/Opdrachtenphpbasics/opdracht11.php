<?php
$leeftijd = 25;

if ($leeftijd < 12) {
    echo "Je bent een kind.";
} elseif ($leeftijd <= 17) {
    echo "Je bent een tiener.";
} elseif ($leeftijd <= 64) {
    echo "Je bent een volwassene.";
} else {
    echo "Je bent een senior.";
}
?>