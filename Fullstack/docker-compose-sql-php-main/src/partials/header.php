
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? "Circuleather") ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<nav>
    <div>
        <a href="overview.php">Voorraad</a>
        <a href="create.php">Artikel toevoegen</a>
        <a href="bestellingen.php">Bestellingen</a>
        <a href="bestelling_maken.php">Bestelling maken</a>

        <?php if (isset($_SESSION['rol']) && in_array($_SESSION['rol'], ['admin', 'hoofdadmin'], true)) { ?>
            <a href="register.php">Werknemer toevoegen</a>
        <?php } ?>
    </div>

    <div>
        <?php if (isset($_SESSION['username'])) { ?>
            <span style="color: white;">
                Ingelogd als: <?= htmlspecialchars($_SESSION['username']) ?>
            </span>
            <a href="logout.php">Uitloggen</a>
        <?php } ?>
    </div>
</nav>
</body>
</html>
