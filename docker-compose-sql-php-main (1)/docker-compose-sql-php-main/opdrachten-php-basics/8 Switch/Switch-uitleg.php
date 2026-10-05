Wat is een switch-case in PHP?

In PHP gebruik je een switch om te controleren wat de waarde van een bepaalde variabele is, en daarop te reageren. 
Het is een alternatief voor een lange reeks van if-else-verklaringen. Het kan je code eenvoudiger maken, vooral als je veel mogelijke opties hebt.

Hoe werkt het?
Bij een switch kijk je naar de waarde van een variabele en vergelijk je die met verschillende mogelijke gevallen (case). 
Als de waarde van de variabele gelijk is aan een van de gevallen, wordt de bijbehorende code uitgevoerd.

    <?PHP
    $dag = "maandag";

    switch ($dag) {
        case "maandag":
            echo "Het is maandag!";
            break;
        case "dinsdag":
            echo "Het is dinsdag!";
            break;
        case "woensdag":
            echo "Het is woensdag!";
            break;
        default:
            echo "Ongeldige dag!";
        }   
    ?>

    De variabele $dag wordt vergeleken met de verschillende case-waarden.
    Als de waarde van $dag gelijk is aan "maandag", wordt "Het is maandag!" weergegeven.
    Het break zorgt ervoor dat de code stopt na het uitvoeren van de juiste case.
    Als er geen overeenkomsten zijn, wordt de default uitgevoerd (in dit geval "Ongeldige dag!").

Voordelen van switch:
Duidelijker en korter: Een switch is vaak gemakkelijker te lezen dan een lange reeks if-else-verklaringen. Het maakt de code overzichtelijker.

Voorbeeld met if-else:
    <?php
        if ($dag == "maandag") {
            echo "Het is maandag!";
        } elseif ($dag == "dinsdag") {
            echo "Het is dinsdag!";
        } elseif ($dag == "woensdag") {
            echo "Het is woensdag!";
        } else {
            echo "Ongeldige dag!";
        }
    ?>
    
    Zoals je ziet, is de switch korter en overzichtelijker.
    Makkelijker te beheren: Als je veel mogelijke opties hebt, is een switch makkelijker te gebruiken dan veel if-else-verklaringen.


Nadelen van switch:
Beperkte mogelijkheden: Je kunt alleen precies gelijkwaardige waarden vergelijken in een switch. 
Je kunt geen meer ingewikkelde voorwaarden gebruiken, zoals "is groter dan" of "is tussen twee waarden". Daarvoor heb je een if-else nodig.
Werkt alleen met één variabele: In een switch kun je alleen één variabele tegelijk vergelijken. Als je meerdere variabelen tegelijk moet controleren, is een if-else beter.

Samenvatting:
Gebruik switch wanneer je de waarde van één variabele moet vergelijken met meerdere opties. Het is makkelijker te lezen en te begrijpen.
Gebruik if-else als je meer complexe vergelijkingen of meerdere variabelen wilt controleren.
Een switch is meestal sneller en netter als je veel gevallen hebt om te controleren.

Extra uitdaging:
Probeer bij sommige opdrachten de switch te combineren met een break en een default om te zien hoe ze werken.
Bijvoorbeeld bij de leeftijdsgroep-opdracht kun je een default toevoegen voor leeftijden die niet passen bij de normale groepen (bijvoorbeeld negatieve leeftijden).