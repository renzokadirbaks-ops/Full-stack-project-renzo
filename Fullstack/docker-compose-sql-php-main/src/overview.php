<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$title = "Voorraad overzicht";

require "partials/header.php";

$conn = require_once "partials/dbconnection.php";

$zoekterm = "";

if (isset($_GET['zoeken'])) {
    $zoekterm = trim($_GET['zoeken']);
}

if ($zoekterm != "") {
    $zoektermLike = "%" . $zoekterm . "%";

    $stmt = $conn->prepare("
        SELECT *
        FROM voorraadbeheer
        WHERE CAST(artikel_id AS CHAR) LIKE ?
        OR medewerker LIKE ?
        OR herkomst LIKE ?
        OR magazijn LIKE ?
        OR CAST(rek AS CHAR) LIKE ?
        OR kleur LIKE ?
        OR formaat LIKE ?
        OR status LIKE ?
        ORDER BY artikel_id ASC
    ");

    $stmt->bind_param(
        "ssssssss",
        $zoektermLike,
        $zoektermLike,
        $zoektermLike,
        $zoektermLike,
        $zoektermLike,
        $zoektermLike,
        $zoektermLike,
        $zoektermLike
    );

    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("
        SELECT *
        FROM voorraadbeheer
        ORDER BY artikel_id ASC
    ");
}
?>

<main>
    <h2>Voorraad overzicht</h2>

    <p>
        <a href="create.php">Nieuw artikel toevoegen</a>
    </p>

    <form method="GET">
        <label>Zoek artikel:</label>

        <input
            type="text"
            name="zoeken"
            placeholder="Zoek op ID, herkomst, kleur..."
            value="<?php echo htmlspecialchars($zoekterm); ?>"
        >

        <button type="submit">Zoeken</button>
    </form>

    <?php if ($zoekterm != "") { ?>
        <p>
            Zoekresultaten voor:
            <strong><?php echo htmlspecialchars($zoekterm); ?></strong>
        </p>

        <p>
            <a href="overview.php">Alle artikelen bekijken</a>
        </p>
    <?php } ?>

    <table>
        <tr>
            <th>Artikel ID</th>
            <th>Werknemer ID</th>
            <th>Medewerker</th>
            <th>Herkomst</th>
            <th>Magazijn</th>
            <th>Rek</th>
            <th>Gewicht (kg)</th>
            <th>Kleur(en)</th>
            <th>Formaat</th>
            <th>Dikte</th>
            <th>Status</th>
            <th>Actie</th>
        </tr>

        <?php if ($result->num_rows > 0) { ?>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td>
                        <?php echo $row['artikel_id']; ?>
                    </td>

                    <td>
                        <?php echo $row['werknemer_id']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['medewerker'] ?? '-'); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['herkomst'] ?? '-'); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['magazijn'] ?? '-'); ?>
                    </td>

                    <td>
                        <?php
                        if (!empty($row['rek'])) {
                            echo "Rek " . $row['rek'];
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>

                    <td>
                        <?php echo $row['gewicht_kg']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['kleur'] ?? '-'); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['formaat'] ?? '-'); ?>
                    </td>

                    <td>
                        <?php echo $row['dikte']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['status'] ?? '-'); ?>
                    </td>

                    <td>
                        <a href="update.php?id=<?php echo $row['artikel_id']; ?>">
                            Bewerken
                        </a>

                        |

                        <a
                            href="delete.php?id=<?php echo $row['artikel_id']; ?>"
                            onclick="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?');"
                        >
                            Verwijderen
                        </a>
                    </td>

                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="12">
                    Geen artikelen gevonden.
                </td>
            </tr>

        <?php } ?>

    </table>
</main>

<?php
if (isset($stmt)) {
    $stmt->close();
}

$conn->close();

require "partials/footer.php";
?>