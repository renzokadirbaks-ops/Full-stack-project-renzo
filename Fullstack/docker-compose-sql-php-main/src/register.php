<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$ingelogdeRol = $_SESSION['rol'] ?? '';

if (!in_array($ingelogdeRol, ['admin', 'hoofdadmin'], true)) {
    header("Location: overview.php");
    exit();
}

$errors = [];

if (isset($_POST['knop'])) {
    $inputUsername = trim($_POST['username'] ?? '');
    $inputPassword = $_POST['password'] ?? '';

    if ($ingelogdeRol === 'hoofdadmin') {
        $rol = $_POST['rol'] ?? 'gebruiker';

        if (!in_array($rol, ['gebruiker', 'admin'], true)) {
            $errors[] = "Ongeldige rol gekozen.";
        }
    } else {
        $rol = 'gebruiker';
    }

    if ($inputUsername === '' || $inputPassword === '') {
        $errors[] = "Gebruikersnaam en wachtwoord zijn verplicht.";
    }

    if (strlen($inputPassword) < 8) {
        $errors[] = "Wachtwoord moet minimaal 8 tekens lang zijn.";
    }

    if (!preg_match('/[0-9]/', $inputPassword)) {
        $errors[] = "Wachtwoord moet minimaal 1 cijfer bevatten.";
    }

    if (empty($errors)) {
        require_once "partials/dbconnection.php";

        $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO werknemers (gebruikersnaam, wachtwoord, rol)
             VALUES (?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "sss",
                $inputUsername,
                $hashedPassword,
                $rol
            );

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();

                header("Location: overview.php");
                exit();
            } else {
                $errors[] = "Account kon niet worden aangemaakt.";
                $stmt->close();
            }
        } else {
            $errors[] = "Er ging iets mis bij het aanmaken van het account.";
        }

        $conn->close();
    }
}

$title = "Gebruiker registreren";
require "partials/header.php";
?>

<main>
    <h2>Nieuw account aanmaken</h2>

    <?php if (!empty($errors)) { ?>
        <ul class="errors">
            <?php foreach ($errors as $error) { ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input
            type="text"
            id="username"
            name="username"
            required
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
        >

        <label for="password">Wachtwoord:</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <?php if ($ingelogdeRol === 'hoofdadmin') { ?>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="gebruiker">Werknemer</option>
                <option value="admin">Admin</option>
            </select>
        <?php } ?>

        <button type="submit" name="knop">
            Account aanmaken
        </button>
    </form>
</main>

<?php require "partials/footer.php"; ?>
