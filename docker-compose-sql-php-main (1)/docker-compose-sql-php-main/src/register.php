<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header("Location: overview.php");
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

    header("Location: login.php");
    exit;
  }
}

$title = "Registreren";
require "partials/header.php";
?>
<main>
<h2>Registreren</h2>

<?php if (!empty($errors)) { ?>
  <ul class="errors">
    <?php foreach ($errors as $error) { ?>
      <li><?php echo $error; ?></li>
    <?php } ?>
  </ul>
<?php } ?>

<form method="POST" class="auth-form" id="alle-form">
  <label>Username:</label>
  <input type="text" name="username" required>

  <label>Wachtwoord:</label>
  <input type="password" name="password" required>

  <label>Rol:</label>
  <select name="rol" required>
    <option value="">Kies een rol (verplicht)</option>
    <option value="admin">Admin</option>
    <option value="gebruiker">Gebruiker</option>
  </select>

  <button type="submit" name="knop">Registreren</button>
</form>
</main>

<?php require "partials/footer.php"; ?>