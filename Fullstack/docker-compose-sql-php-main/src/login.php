<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    header("Location: overview.php");
    exit();
}

$loginError = false;

if (isset($_POST['knop'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $conn = require_once "partials/dbconnection.php";

    $stmt = $conn->prepare("SELECT * FROM werknemers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();

    $result = $stmt->get_result();

    $loginSuccess = false;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($inputPassword, $row['wachtwoord'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['gebruikersnaam'];
            $_SESSION['werknemer_id'] = $row['werknemer_id'];
            $_SESSION['rol'] = $row['rol'];

            $loginSuccess = true;
        }
    }

    $stmt->close();
    $conn->close();

    if ($loginSuccess) {
        header("Location: overview.php");
        exit();
    } else {
        $loginError = true;
    }
}

$title = "Inloggen";
require "partials/login-header.php";
?>

<main>
    <h2>Inlogscherm</h2>

    <?php if ($loginError) { ?>
        <p class="errors">Gebruikersnaam of wachtwoord is niet correct.</p>
    <?php } ?>

    <form method="POST">

        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required>

        <label>Wachtwoord:</label>
        <input type="password" name="password" required>

        <button type="submit" name="knop">Log in</button>

    </form>

    <p>
        <a href="register.php">Nieuwe werknemer aanmaken</a>
    </p>
</main>

<?php require "partials/footer.php"; ?>