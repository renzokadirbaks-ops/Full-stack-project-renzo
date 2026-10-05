<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$errors = [];

if (isset($_POST['knop'])) {
    $inputUsername = htmlspecialchars(trim($_POST['username']));
    $inputPassword = $_POST['password'];
    $inputRol = htmlspecialchars(trim($_POST['rol']));

    if (empty($inputUsername) || empty($inputPassword)) {
        $errors[] = "Gebruikersnaam en wachtwoord zijn verplicht.";
    }

    if (strlen($inputPassword) < 8) {
        $errors[] = "Wachtwoord moet minimaal 8 tekens lang zijn.";
    }

    if (!preg_match('/[0-9]/', $inputPassword)) {
        $errors[] = "Wachtwoord moet minimaal 1 cijfer bevatten.";
    }

    if (!in_array($inputRol, ['admin', 'gebruiker'])) {
        $errors[] = "Kies een geldige rol.";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

        $conn = require_once "partials/dbconnection.php";

        $stmt = $conn->prepare("INSERT INTO users (username, password, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $inputUsername, $hashedPassword, $inputRol);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: overview.php?msg=created");
        exit;
    }
}

$title = "Nieuwe gebruiker";
require "partials/header.php";
?>
<main>
<h2>Nieuwe gebruiker toevoegen</h2>

<?php if (!empty($errors)) { ?>
    <ul>
        <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Wachtwoord:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Rol:</label><br>
    <select name="rol" required>
        <option value="">-- Kies een rol --</option>
        <option value="admin">Admin</option>
        <option value="gebruiker">Gebruiker</option>
    </select><br><br>

    <button type="submit" name="knop">Toevoegen</button>
</form>

<p><a href="overview.php">Terug naar overzicht</a></p>

<?php require "partials/footer.php"; ?>
</main>