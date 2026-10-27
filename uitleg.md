# Uitleg van de code

## Databaseverbinding – `partials/dbconnection.php`

Dit bestand maakt verbinding met de MySQL-database. De andere PHP-bestanden gebruiken deze verbinding om gegevens op te halen, toe te voegen of te wijzigen.

De verbinding wordt opgeslagen in de variabele `$conn`. Hierdoor kunnen andere bestanden SQL-query's uitvoeren zonder telkens een nieuwe databaseverbinding te maken.

## Inloggen – `login.php`

De inlogpagina controleert de gegevens die een gebruiker via het formulier invoert. De applicatie zoekt de bijbehorende gebruiker op in de database en controleert het wachtwoord.

Wachtwoorden worden veilig opgeslagen met een hash. Bij het inloggen wordt `password_verify()` gebruikt om het ingevoerde wachtwoord met de opgeslagen hash te vergelijken.

Wanneer het inloggen lukt, worden gegevens zoals de gebruikersnaam en gebruikersrol in de PHP-sessie opgeslagen. Deze gegevens kunnen op andere pagina's worden gebruikt om te controleren wie is ingelogd en welke rechten die persoon heeft.

## Sessies en toegangscontrole

Met `session_start()` start of hervat PHP een sessie. Een sessie maakt het mogelijk om gegevens van de ingelogde gebruiker tussen verschillende pagina's te bewaren.

Met `$_SESSION` kunnen deze gegevens worden gelezen. Bijvoorbeeld: `$_SESSION['username']` bevat de gebruikersnaam en `$_SESSION['rol']` bevat de gebruikersrol, als deze tijdens het inloggen zijn ingesteld.

Met voorwaarden zoals `if` kan de applicatie controleren of iemand is ingelogd en voldoende rechten heeft. Zo kunnen bepaalde functies alleen toegankelijk zijn voor bevoegde gebruikers.

De sessie moet worden gestart voordat de pagina HTML uitvoert. Anders kunnen fouten ontstaan bij het starten van de sessie of het doorsturen naar een andere pagina.

## Voorraad bekijken – `overview.php`

Deze pagina toont de voorraadartikelen die in de database zijn opgeslagen.

Met een SQL-query worden de benodigde gegevens opgehaald. PHP verwerkt het resultaat en toont de gegevens in een HTML-tabel.

Met `while` kan de applicatie de resultaten één voor één doorlopen. Voor ieder artikel wordt een nieuwe tabelrij weergegeven.

De functie `htmlspecialchars()` wordt gebruikt bij het tonen van gegevens. Hierdoor worden speciale HTML-tekens omgezet en wordt voorkomen dat ingevoerde tekst als HTML-code wordt uitgevoerd.

## Voorraad toevoegen – `create.php`

Deze pagina bevat een formulier waarmee een gebruiker een nieuw artikel kan registreren.

Wanneer het formulier wordt verzonden, controleert PHP de ingevoerde gegevens. Vervolgens kan met een SQL-query een nieuw record aan de voorraadtabel worden toegevoegd.

Met een prepared statement kunnen waarden afzonderlijk aan een SQL-query worden gekoppeld. Dit helpt SQL-injectie te voorkomen.

## Bestellingen bekijken – `bestellingen.php`

Deze pagina haalt bestellingen uit de tabel `bestellingen` op en toont ze in een overzicht.

Met `SELECT` worden de gegevens opgehaald. Met `ORDER BY` kunnen de resultaten bijvoorbeeld op besteldatum worden gesorteerd.

PHP controleert of er resultaten zijn. Als er bestellingen bestaan, worden deze in de tabel weergegeven. Anders kan een melding worden getoond dat er geen bestellingen zijn gevonden.

## Een bestelling maken – `bestelling_maken.php`

Deze pagina laat de gebruiker beschikbare voorraadartikelen selecteren en aan een nieuwe bestelling toevoegen.

De pagina haalt artikelen op uit `voorraadbeheer` met de status `Beschikbaar`. De geselecteerde artikelen worden via een formulier naar PHP verzonden.

PHP verwerkt de selectie en maakt een nieuw record aan in `bestellingen`. Vervolgens worden de gekoppelde artikelen opgeslagen in `bestelling_artikelen`.

De koppeltabel `bestelling_artikelen` verbindt bestellingen met voorraadartikelen via hun identificatienummers. Zo kan worden vastgelegd welke artikelen bij welke bestelling horen.

Bij het reserveren wordt de status van een gekozen artikel aangepast naar `Gereserveerd` en wordt het bestellings-ID opgeslagen in `bestellingen_id`.

Een databasetransactie met `begin_transaction()`, `commit()` en `rollback()` zorgt ervoor dat meerdere databasebewerkingen samen kunnen worden uitgevoerd. Als er iets misgaat, kunnen de wijzigingen worden teruggedraaid.

## Uitloggen – `logout.php`

Deze pagina beëindigt de inlogsessie. Hierdoor kan de applicatie de gebruiker niet langer als ingelogd behandelen.

Na het uitloggen wordt de gebruiker doorgaans doorgestuurd naar de inlogpagina.

## Gedeelde onderdelen – `partials/header.php` en `partials/footer.php`

De header bevat onderdelen die op meerdere pagina's terugkomen, zoals de navigatie en de naam van de ingelogde gebruiker.

De footer bevat de gedeelde onderkant van de pagina.

Door deze onderdelen in aparte bestanden te plaatsen, hoeft dezelfde HTML niet op iedere pagina opnieuw te worden geschreven. Met `require` of `require_once` kunnen de bestanden worden ingeladen.

## Vormgeving – `css/style.css`

Dit bestand bevat de CSS-regels die bepalen hoe de applicatie eruitziet. CSS kan bijvoorbeeld worden gebruikt om kleuren, lettertypen, marges, tabellen, knoppen en formulieren vorm te geven.

Door de vormgeving in een apart bestand te bewaren, blijft de HTML overzichtelijker en kan de stijl van meerdere pagina's centraal worden aangepast.

## Docker en GitHub

Docker wordt gebruikt om de applicatie en database in een ontwikkelomgeving te draaien. Het bestand `docker-compose.yml` beschrijft welke containers nodig zijn en hoe deze met elkaar communiceren.

GitHub wordt gebruikt om de projectbestanden en wijzigingen bij te houden. Hierdoor kan ik mijn werk bewaren, eerdere versies terugvinden en wijzigingen aan het project beheren.
