# Documentatie – Circuleather Fullstack Project

## 1. Basisinformatie

**Projectnaam:** Circuleather  
**Projecttype:** Fullstack webapplicatie  
**Programmeertalen:** PHP, SQL, HTML en CSS  
**Database:** MySQL/MariaDB  
**Ontwikkelomgeving:** Visual Studio Code, Docker en GitHub  
**Startdatum:** September 2026  
**Einddatum:** Nog niet afgerond

### Doel van het project

Het doel van dit project is om een voorraadbeheersysteem te ontwikkelen voor Circuleather. Met de applicatie kunnen medewerkers de voorraad bekijken en beheren. Ook kunnen gebruikers artikelen toevoegen en bestellingen aanmaken.

Het systeem is bedoeld om voorraadgegevens overzichtelijk bij te houden en het verwerken van artikelen en bestellingen eenvoudiger te maken.

### Aanpak

Ik ontwikkel de applicatie met PHP voor de serverkant en MySQL/MariaDB voor het opslaan van gegevens. HTML en CSS worden gebruikt voor de structuur en vormgeving van de website.

Met Docker draai ik de applicatie en database in containers. Ik gebruik Visual Studio Code om de code te schrijven en GitHub om mijn projectbestanden te beheren.

## 2. Bestandsstructuur en softwarekeuzes

De applicatie is verdeeld over meerdere bestanden. Hierdoor hebben verschillende onderdelen van de website hun eigen functie.

| Bestand | Functie |
|---|---|
| `overview.php` | Toont het voorraadbeheer en de beschikbare artikelen. |
| `create.php` | Wordt gebruikt om nieuwe voorraadartikelen toe te voegen. |
| `bestellingen.php` | Toont de bestellingen. |
| `bestelling_maken.php` | Maakt een nieuwe bestelling aan met geselecteerde voorraadartikelen. |
| `login.php` | Verzorgt het inloggen van gebruikers. |
| `logout.php` | Verwerkt het uitloggen. |
| `register.php` | Maakt nieuwe werknemersaccounts aan voor bevoegde gebruikers. |
| `partials/header.php` | Bevat de gedeelde navigatie en de bovenkant van de pagina. |
| `partials/footer.php` | Bevat de gedeelde onderkant van de pagina. |
| `partials/dbconnection.php` | Maakt verbinding met de database. |
| `css/style.css` | Bevat de vormgeving van de applicatie. |
| `docker-compose.yml` | Configureert de containers voor de applicatie en database. |

### Waarom deze structuur?

Ik heb de code verdeeld over aparte bestanden om de applicatie overzichtelijk te houden. Onderdelen die op meerdere pagina's worden gebruikt, zoals de header, footer en databaseverbinding, staan in aparte bestanden. Hierdoor hoef ik dezelfde code niet op iedere pagina opnieuw te schrijven.

### Naamgeving

Ik gebruik beschrijvende bestandsnamen en variabelen. Hierdoor is makkelijker te herkennen waarvoor een bestand of variabele wordt gebruikt. Zo verwijst `$conn` naar de databaseverbinding en `$title` naar de titel van een pagina.

## 3. Functionaliteiten

### Voorraadbeheer

De applicatie bevat een voorraadbeheerfunctie waarmee medewerkers artikelen kunnen bekijken en registreren. Voorraadgegevens bevatten onder andere het artikelnummer, de herkomst, het magazijn, het rek, het gewicht, de kleur, het formaat, de dikte en de status.

### Inloggen en gebruikersrollen

Gebruikers kunnen inloggen om toegang te krijgen tot de applicatie. De applicatie gebruikt sessies om de ingelogde gebruiker bij te houden. Gebruikersrollen bepalen welke onderdelen toegankelijk zijn.

### Bestellingen

De applicatie bevat een onderdeel voor bestellingen. Een bestelling kan aan voorraadartikelen worden gekoppeld. Artikelen kunnen worden gereserveerd, zodat ze niet opnieuw als beschikbare voorraad worden geselecteerd.

### Database

De database slaat de voorraadgegevens, gebruikers en bestellingen op. De tabellen zijn via identificatienummers aan elkaar te koppelen. Hierdoor kan bijvoorbeeld worden vastgelegd welke artikelen bij een bestelling horen.

## 4. Belangrijke technische keuzes

### PHP

Ik gebruik PHP om gegevens uit formulieren te verwerken, informatie uit de database op te halen en pagina's dynamisch op te bouwen.

### MySQL/MariaDB

Ik gebruik een relationele database om gegevens gestructureerd op te slaan. Met SQL kan ik gegevens toevoegen, opvragen en aanpassen.

### Docker

Ik gebruik Docker om de ontwikkelomgeving te draaien. Hierdoor kunnen de PHP-applicatie en database in aparte containers werken.

### Herbruikbare onderdelen

De databaseverbinding, header en footer staan in aparte bestanden. Met `require` en `require_once` kan ik deze onderdelen in andere PHP-bestanden gebruiken.

## 5. Planning en takenlijst

- [x] Databaseverbinding opzetten.
- [x] Inlogfunctionaliteit ontwikkelen.
- [x] Voorraadbeheer opzetten.
- [x] Formulier maken om voorraadartikelen toe te voegen.
- [x] Tabellen voor bestellingen en bijbehorende artikelen aanmaken.
- [ ] Bestellingen volledig testen.
- [ ] Controleren of voorraadstatussen correct worden aangepast.
- [ ] De vormgeving en gebruiksvriendelijkheid verbeteren.
- [ ] Alle functionaliteiten testen en fouten oplossen.
- [ ] De documentatie afronden.

## 6. Wat heb ik geleerd?

Tijdens dit project leer ik hoe verschillende onderdelen van een fullstack webapplicatie samenwerken. Ik werk met PHP, SQL, databases, HTML, CSS, Docker en GitHub. Ook leer ik hoe ik een project opdeel in verschillende bestanden en hoe ik fouten opspoor en oplos.

Een belangrijk onderdeel is dat de applicatie niet alleen goed moet werken, maar ook overzichtelijk en onderhoudbaar moet zijn.

## 7. Status van het project
