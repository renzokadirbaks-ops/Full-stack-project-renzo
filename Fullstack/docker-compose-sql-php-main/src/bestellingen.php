<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$title = "Bestellingen";

require_once "partials/dbconnection.php";

$sql = "SELECT id, klant_id, bestelnummer, besteldatum, leverdatum, status, opmerking
        FROM bestellingen
        ORDER BY besteldatum DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Fout bij ophalen van bestellingen: " . $conn->error);
}

require "partials/header.php";
?>

<main class="container">
    <h1>Bestellingen</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Bestelnummer</th>
                    <th>Klantnummer</th>
                    <th>Besteldatum</th>
                    <th>Leverdatum</th>
                    <th>Status</th>
                    <th>Opmerking</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($bestelling = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($bestelling["bestelnummer"] ?? "") ?></td>
                            <td><?= htmlspecialchars($bestelling["klant_id"] ?? "") ?></td>
                            <td><?= htmlspecialchars($bestelling["besteldatum"] ?? "") ?></td>
                            <td><?= htmlspecialchars($bestelling["leverdatum"] ?? "") ?></td>
                            <td><?= htmlspecialchars($bestelling["status"] ?? "") ?></td>
                            <td><?= htmlspecialchars($bestelling["opmerking"] ?? "") ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">Geen bestellingen gevonden.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<?php
$result->free();
require "partials/footer.php";
?>
