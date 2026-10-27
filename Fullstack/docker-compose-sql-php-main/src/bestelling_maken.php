<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

require_once "partials/dbconnection.php";


$title = "Bestelling maken";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $artikelen = $_POST["artikelen"] ?? [];
    $aantallen = $_POST["aantallen"] ?? [];
    $opmerking = trim($_POST["opmerking"] ?? "");

    $gekozenArtikelen = [];

    foreach ($artikelen as $artikelId) {
        $artikelId = filter_var($artikelId, FILTER_VALIDATE_INT);
        $aantal = filter_var($aantallen[$artikelId] ?? 0, FILTER_VALIDATE_INT);

        if (!$artikelId || !$aantal || $aantal < 1) {
            $errors[] = "Selecteer geldige artikelen en aantallen.";
            break;
        }

        $gekozenArtikelen[$artikelId] = $aantal;
    }

    if (empty($gekozenArtikelen) && empty($errors)) {
        $errors[] = "Selecteer minimaal één artikel.";
    }

    if (empty($errors)) {
        $conn->begin_transaction();

        try {
            $bestelnummer = "B-" . date("YmdHis") . "-" . random_int(100, 999);

            $stmt = $conn->prepare(
                "INSERT INTO bestellingen (bestelnummer, status, opmerking)
                 VALUES (?, 'Nieuw', ?)"
            );
            $stmt->bind_param("ss", $bestelnummer, $opmerking);
            $stmt->execute();

            $bestellingId = $conn->insert_id;
            $stmt->close();

            $controle = $conn->prepare(
                "SELECT artikel_id
                 FROM voorraadbeheer
                 WHERE artikel_id = ? AND status = 'Beschikbaar'
                 FOR UPDATE"
            );

            $toevoegen = $conn->prepare(
                "INSERT INTO bestelling_artikelen
                 (bestelling_id, artikel_id, aantal, prijs_per_stuk)
                 VALUES (?, ?, ?, 0.00)"
            );

            $reserveren = $conn->prepare(
                "UPDATE voorraadbeheer
                 SET status = 'Gereserveerd', bestellingen_id = ?
                 WHERE artikel_id = ? AND status = 'Beschikbaar'"
            );

            foreach ($gekozenArtikelen as $artikelId => $aantal) {
                $controle->bind_param("i", $artikelId);
                $controle->execute();
                $resultaat = $controle->get_result();

                if (!$resultaat->fetch_assoc()) {
                    throw new Exception("Artikel " . $artikelId . " is niet meer beschikbaar.");
                }

                $toevoegen->bind_param("iii", $bestellingId, $artikelId, $aantal);
                $toevoegen->execute();

                $reserveren->bind_param("ii", $bestellingId, $artikelId);
                $reserveren->execute();

                if ($reserveren->affected_rows !== 1) {
                    throw new Exception("Artikel " . $artikelId . " kon niet worden gereserveerd.");
                }
            }

            $controle->close();
            $toevoegen->close();
            $reserveren->close();

            $conn->commit();

            header("Location: bestellingen.php");
            exit();
        } catch (Throwable $e) {
            $conn->rollback();
            $errors[] = $e->getMessage();
        }
    }
}

$result = $conn->query(
    "SELECT artikel_id, herkomst, magazijn, rek, gewicht_kg, kleur, formaat, dikte
     FROM voorraadbeheer
     WHERE status = 'Beschikbaar'
     ORDER BY artikel_id"
);

require "partials/header.php";
?>

<main class="container">
    <h1>Bestelling maken</h1>

    <?php foreach ($errors as $error) { ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <form method="POST">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kiezen</th>
                        <th>Artikelnummer</th>
                        <th>Herkomst</th>
                        <th>Magazijn</th>
                        <th>Rek</th>
                        <th>Gewicht (kg)</th>
                        <th>Kleur</th>
                        <th>Formaat</th>
                        <th>Dikte</th>
                        <th>Aantal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($artikel = $result->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <input
                                    type="checkbox"
                                    name="artikelen[]"
                                    value="<?= (int) $artikel['artikel_id'] ?>"
                                >
                            </td>
                            <td><?= (int) $artikel['artikel_id'] ?></td>
                            <td><?= htmlspecialchars($artikel['herkomst'] ?? '') ?></td>
                            <td><?= htmlspecialchars($artikel['magazijn'] ?? '') ?></td>
                            <td><?= htmlspecialchars((string) ($artikel['rek'] ?? '')) ?></td>
                            <td><?= htmlspecialchars((string) $artikel['gewicht_kg']) ?></td>
                            <td><?= htmlspecialchars($artikel['kleur'] ?? '') ?></td>
                            <td><?= htmlspecialchars($artikel['formaat'] ?? '') ?></td>
                            <td><?= htmlspecialchars((string) $artikel['dikte']) ?></td>
                            <td>
                                <input
                                    type="number"
                                    name="aantallen[<?= (int) $artikel['artikel_id'] ?>]"
                                    value="1"
                                    min="1"
                                    required
                                >
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <label for="opmerking">Opmerking</label>
        <textarea id="opmerking" name="opmerking"></textarea>

        <button type="submit">Bestelling opslaan</button>
    </form>
</main>

<?php
$result->free();
require "partials/footer.php";
?>
