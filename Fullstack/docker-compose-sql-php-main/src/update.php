<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$conn = require_once "partials/dbconnection.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: overview.php");
    exit();
}

$artikelId = $_GET['id'];
$errors = [];

$stmt = $conn->prepare("SELECT * FROM voorraadbeheer WHERE artikel_id = ?");
$stmt->bind_param("i", $artikelId);
$stmt->execute();

$result = $stmt->get_result();
$artikel = $result->fetch_assoc();

$stmt->close();

if (!$artikel) {
    $conn->close();
    header("Location: overview.php");
    exit();
}

if (isset($_POST['knop'])) {
    $gewicht = trim($_POST['gewicht_kg']);
    $kleur = htmlspecialchars(trim($_POST['kleur']));
    $formaat = trim($_POST['formaat']);
    $dikte = trim($_POST['dikte']);
    $status = htmlspecialchars(trim($_POST['status']));

    if (empty($gewicht) || !is_numeric($gewicht) || $gewicht < 0) {
        $errors[] = "Gewicht moet een positief getal zijn.";
    }

    if (empty($kleur)) {
        $errors[] = "Kleur is verplicht.";
    }

    if (empty($dikte) || !is_numeric($dikte) || $dikte < 0) {
        $errors[] = "Dikte moet een positief getal zijn.";
    }

    if (empty($status)) {
        $errors[] = "Status is verplicht.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("
            UPDATE voorraadbeheer
            SET gewicht_kg = ?, kleur = ?, formaat = ?, dikte = ?, status = ?,
                datum_statuswijziging = NOW()
            WHERE artikel_id = ?
        ");

        $stmt->bind_param(
            "dssdsi",
            $gewicht,
            $kleur,
            $formaat,
            $dikte,
            $status,
            $artikelId
        );

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            header("Location: overview.php");
            exit();
        }

        $errors[] = "Artikel kon niet worden aangepast.";

        $stmt->close();
    }
}

$title = "Artikel bewerken";
require "partials/header.php";
?>

<main>
    <h2>Artikel bewerken</h2>

    <?php if (!empty($errors)) { ?>
        <ul class="errors">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">

        <label>Artikel ID:</label>
        <input type="text" value="<?php echo $artikel['artikel_id']; ?>" disabled>

        <label>Medewerker:</label>
        <input type="text" value="<?php echo htmlspecialchars($artikel['medewerker']); ?>" disabled>

        <label>Gewicht (kg):</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="gewicht_kg"
            value="<?php echo $artikel['gewicht_kg']; ?>"
            required
        >

        <label>Kleur:</label>
        <input
            type="text"
            name="kleur"
            value="<?php echo htmlspecialchars($artikel['kleur']); ?>"
            required
        >

        <label>Formaat:</label>
        <input
            type="text"
            name="formaat"
            value="<?php echo htmlspecialchars($artikel['formaat']); ?>"
        >

        <label>Dikte:</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="dikte"
            value="<?php echo $artikel['dikte']; ?>"
            required
        >

        <label>Status:</label>
        <select name="status" required>
            <option value="Beschikbaar" <?php if ($artikel['status'] == 'Beschikbaar') echo 'selected'; ?>>
                Beschikbaar
            </option>

            <option value="Gereserveerd" <?php if ($artikel['status'] == 'Gereserveerd') echo 'selected'; ?>>
                Gereserveerd
            </option>

            <option value="Verkocht" <?php if ($artikel['status'] == 'Verkocht') echo 'selected'; ?>>
                Verkocht
            </option>
        </select>

        <button type="submit" name="knop">Opslaan</button>

    </form>

    <p>
        <a href="overview.php">Terug naar voorraad</a>
    </p>
</main>

<?php
$conn->close();
require "partials/footer.php";
?>