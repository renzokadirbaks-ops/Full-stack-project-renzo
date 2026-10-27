<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['werknemer_id'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$errors = [];

$kleuren = [
    "Zwart",
    "Bruin",
    "Donkerbruin",
    "Lichtbruin",
    "Beige",
    "Cognac",
    "Naturel",
    "Wit",
    "Grijs",
    "Rood",
    "Bordeaux",
    "Blauw",
    "Donkerblauw",
    "Groen",
    "Donkergroen",
    "Geel",
    "Oranje",
    "Roze",
    "Paars"
];

if (isset($_POST['knop'])) {
    $werknemerId = $_SESSION['werknemer_id'];
    $medewerker = $_SESSION['username'];

    $herkomst = htmlspecialchars(trim($_POST['herkomst']));
    $magazijn = htmlspecialchars(trim($_POST['magazijn']));
    $rek = trim($_POST['rek']);
    $gewicht = trim($_POST['gewicht_kg']);
    $gekozenKleuren = $_POST['kleur'] ?? [];
    $formaat = trim($_POST['formaat']);
    $dikte = trim($_POST['dikte']);
    $status = htmlspecialchars(trim($_POST['status']));

    if (empty($herkomst)) {
        $errors[] = "Herkomst is verplicht.";
    }

    if (!in_array($magazijn, ['Magazijn A', 'Magazijn B', 'Magazijn C'])) {
        $errors[] = "Kies een geldig magazijn.";
    }

    if (!in_array($rek, ['1', '2', '3'])) {
        $errors[] = "Kies een geldig rek.";
    }

    if (empty($gewicht) || !is_numeric($gewicht) || $gewicht < 0) {
        $errors[] = "Gewicht moet een positief getal zijn.";
    }

    if (empty($gekozenKleuren)) {
        $errors[] = "Kies minimaal één kleur.";
    }

    if (empty($dikte) || !is_numeric($dikte) || $dikte < 0) {
        $errors[] = "Dikte moet een positief getal zijn.";
    }

    if (empty($status)) {
        $errors[] = "Status is verplicht.";
    }

    if (empty($errors)) {
        $kleur = implode(", ", $gekozenKleuren);

        $conn = require_once "partials/dbconnection.php";

        $stmt = $conn->prepare("
            INSERT INTO voorraadbeheer
            (
                werknemer_id,
                medewerker,
                herkomst,
                magazijn,
                rek,
                gewicht_kg,
                kleur,
                formaat,
                dikte,
                status,
                datum_registratie
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->bind_param(
            "isssidssds",
            $werknemerId,
            $medewerker,
            $herkomst,
            $magazijn,
            $rek,
            $gewicht,
            $kleur,
            $formaat,
            $dikte,
            $status
        );

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            header("Location: overview.php");
            exit();
        }

        $errors[] = "Artikel kon niet worden toegevoegd.";

        $stmt->close();
        $conn->close();
    }
}

$title = "Nieuw artikel";
require "partials/header.php";
?>

<main>
    <h2>Nieuw artikel toevoegen</h2>

    <?php if (!empty($errors)) { ?>
        <ul class="errors">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">

        <label>Herkomst:</label>
        <input
            type="text"
            name="herkomst"
            placeholder="Bijvoorbeeld Italië"
            required
        >

        <label>Magazijn:</label>
        <select name="magazijn" required>
            <option value="">Kies een magazijn</option>
            <option value="Magazijn A">Magazijn A</option>
            <option value="Magazijn B">Magazijn B</option>
            <option value="Magazijn C">Magazijn C</option>
        </select>

        <label>Rek:</label>
        <select name="rek" required>
            <option value="">Kies een rek</option>
            <option value="1">Rek 1</option>
            <option value="2">Rek 2</option>
            <option value="3">Rek 3</option>
        </select>

        <label>Gewicht (kg):</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="gewicht_kg"
            required
        >

        <label>Kleur(en):</label>

        <?php foreach ($kleuren as $kleur) { ?>
            <label style="display: block; margin: 5px 0;">
                <input
                    type="checkbox"
                    name="kleur[]"
                    value="<?php echo htmlspecialchars($kleur); ?>"
                >
                <?php echo htmlspecialchars($kleur); ?>
            </label>
        <?php } ?>

        <label>Formaat:</label>
        <input
            type="text"
            name="formaat"
            placeholder="Bijvoorbeeld 555555x55555"
        >

        <label>Dikte (cm):</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="dikte"
            required
        >

        <label>Status:</label>
        <select name="status" required>
            <option value="">Kies een status</option>
            <option value="Beschikbaar">Beschikbaar</option>
            <option value="Gereserveerd">Gereserveerd</option>
            <option value="Verkocht">Verkocht</option>
        </select>

        <button type="submit" name="knop">
            Artikel toevoegen
        </button>

    </form>

    <p>
        <a href="overview.php">Terug naar voorraad</a>
    </p>
</main>

<?php require "partials/footer.php"; ?>