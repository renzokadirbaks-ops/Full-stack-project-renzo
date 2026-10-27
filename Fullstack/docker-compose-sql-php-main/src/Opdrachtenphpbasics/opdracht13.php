<?php
$leeftijd = 25;
$heeftTicket = true;

if ($heeftTicket && $leeftijd > 18) {
    echo "Toegang verleend.";
} elseif ($heeftTicket && $leeftijd <= 18) {
    echo "Toegang verleend, maar je moet je ouders meenemen.";
} else {
    echo "Toegang geweigerd. Je hebt een ticket nodig.";
}
?>