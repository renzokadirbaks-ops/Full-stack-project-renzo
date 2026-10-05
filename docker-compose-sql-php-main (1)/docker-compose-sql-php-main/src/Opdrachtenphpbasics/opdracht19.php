<?php
$willekeurig = rand(1, 50);
$ingevoerd = 25;

if ($ingevoerd == $willekeurig) {
    echo "Je had het goed.";
} else {
    echo "Je had het niet goed. Het was " . $willekeurig;
}
?>