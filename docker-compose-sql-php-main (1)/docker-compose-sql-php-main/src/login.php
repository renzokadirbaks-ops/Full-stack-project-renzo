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
    
    // security check doormiddel van prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    $loginSuccess = false;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($inputPassword, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $inputUsername;
            $loginSuccess = true;
        }
    }

    $stmt->close();
    $conn->close();

    if ($loginSuccess) {
        header("Location: overview.php");
        exit;
    } else {
        $loginError = true;
    }
}

$title = "Inloggen";
require "partials/header.php";
?>
<main>
<h2>Inlogscherm</h2>

<?php if ($loginError) { ?>
    <p>Gebruikersnaam of wachtwoord is niet correct</p>
<?php } ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Wachtwoord:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="knop">Log in</button>
</form>
<p><a href="register.php">Nieuwe gebruiker aanmaken</a></p>

</main>
<?php require "partials/footer.php"; ?>