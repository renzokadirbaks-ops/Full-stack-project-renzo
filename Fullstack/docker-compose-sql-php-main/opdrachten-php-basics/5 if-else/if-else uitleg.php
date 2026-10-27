If-Else Statements in PHP

Wanneer je PHP-code schrijft, wil je soms controleren of een bepaalde voorwaarde waar is, en op basis daarvan een actie uitvoeren. Dit kun je doen met if-else statements. 
Deze statements helpen je om beslissingen te nemen in je programma afhankelijk van de waarde van variabelen of condities.
Wat is een If-Else Statement in PHP?

Een if-else statement in PHP laat je toe om te controleren of een voorwaarde waar is. Als de voorwaarde waar is, wordt de bijbehorende code uitgevoerd. 
Als de voorwaarde niet waar is, wordt de else-code uitgevoerd (als die aanwezig is).
<?php
    if ($conditie) {
        // code die wordt uitgevoerd als de conditie waar is
    } else {
        // code die wordt uitgevoerd als de conditie niet waar is
    }
?>

Voorbeeld van een eenvoudige If-Else Statement in PHP:
Stel je voor dat je een PHP-script schrijft om te controleren of een gebruiker een voldoende score heeft behaald op een examen.
<?php
    $score = 75;

    if ($score >= 60) {
        echo "Je bent geslaagd!";
    } else {
        echo "Je bent niet geslaagd.";
    }
?>

Natuurlijk, hier is de uitleg voor if-else statements in PHP!
If-Else Statements in PHP

Wanneer je PHP-code schrijft, wil je soms controleren of een bepaalde voorwaarde waar is, en op basis daarvan een actie uitvoeren. 
Dit kun je doen met if-else statements. Deze statements helpen je om beslissingen te nemen in je programma afhankelijk van de waarde van variabelen of condities.
Wat is een If-Else Statement in PHP?

Een if-else statement in PHP laat je toe om te controleren of een voorwaarde waar is. Als de voorwaarde waar is, wordt de bijbehorende code uitgevoerd. 
Als de voorwaarde niet waar is, wordt de else-code uitgevoerd (als die aanwezig is).
Basis Syntax van een If-Else Statement in PHP:

        if (conditie) {
            // code die wordt uitgevoerd als de conditie waar is
        } else {
            // code die wordt uitgevoerd als de conditie niet waar is
        }

Voorbeeld van een eenvoudige If-Else Statement in PHP:
Stel je voor dat je een PHP-script schrijft om te controleren of een gebruiker een voldoende score heeft behaald op een examen.

    <?php
        $score = 75;

        if ($score >= 60) {
            echo "Je bent geslaagd!";
        } else {
            echo "Je bent niet geslaagd.";
        }
    ?>

In dit voorbeeld:
    De conditie is $score >= 60. Als de waarde van $score groter dan of gelijk aan 60 is, wordt de boodschap "Je bent geslaagd!" weergegeven.
    Als de score kleiner dan 60 is, wordt de boodschap "Je bent niet geslaagd." weergegeven.
    
If-Elif-Else in PHP:
In PHP gebruiken we elseif in plaats van elif (zoals in sommige andere talen). Dit stelt je in staat om meerdere voorwaarden te testen.
    <?php
        $score = 85;

        if ($score >= 90) {
            echo "Uitmuntend!";
        } elseif ($score >= 75) {
            echo "Goed!";
        } elseif ($score >= 60) {
            echo "Voldoende!";
        } else {
            echo "Onvoldoende.";
        }
    ?>

In dit geval:
    Als de score groter dan of gelijk aan 90 is, wordt "Uitmuntend!" weergegeven.
    Als de score tussen 75 en 89 ligt, wordt "Goed!" weergegeven.
    Als de score tussen 60 en 74 ligt, wordt "Voldoende!" weergegeven.
    Als de score lager is dan 60, wordt "Onvoldoende." weergegeven.

Waarom If-Else Gebruiken in PHP?
    If-else statements zijn zeer nuttig om beslissingen te nemen op basis van condities in je code. 
    Ze stellen je in staat om dynamische reacties te geven op verschillende invoer of gegevens, wat je code flexibeler maakt.

Samenvatting:
    if: Controleer of een voorwaarde waar is.
    else: Voer iets uit als de voorwaarde niet waar is.
    elseif: Test een andere voorwaarde als de eerste voorwaarde niet waar is.