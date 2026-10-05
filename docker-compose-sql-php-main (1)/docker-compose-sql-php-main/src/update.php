<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$errors = [];
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($id === null) {
    header("Location: overview.php");
    exit();
}

$conn = require_once "partials/dbconnection.php";

if (isset($_POST['knop'])) {
    $inputUsername = htmlspecialchars(trim($_POST['username']));
    $inputRol = htmlspecialchars(trim($_POST['rol']));
    $inputPassword = $_POST['password'];

    if (empty($inputUsername)) {
        $errors[] = "Gebruikersnaam is verplicht.";
    }

    if (!in_array($inputRol, ['admin', 'gebruiker'])) {
        $errors[] = "Kies een geldige rol.";
    }

    if (!empty($inputPassword)) {
        if (strlen($inputPassword) < 8) {
            $errors[] = "Wachtwoord moet minimaal 8 tekens lang zijn.";
        }
        if (!preg_match('/[0-9]/', $inputPassword)) {
            $errors[] = "Wachtwoord moet minimaal 1 cijfer bevatten.";
        }
    }

    if (empty($errors)) {
        if (!empty($inputPassword)) {
            $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("sssi", $inputUsername, $hashedPassword, $inputRol, $id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET username = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("ssi", $inputUsername, $inputRol, $id);
        }

        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: overview.php?msg=updated");
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$user) {
    header("Location: overview.php");
    exit();
}

$title = "Gebruiker bewerken";
require "partials/header.php";
?>
<main>
<h2>Gebruiker bewerken</h2>

<?php if (!empty($errors)) { ?>
    <ul>
        <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

    <label>Nieuw wachtwoord:</label><br>
    <input type="password" name="password"><br><br>

    <label>Rol:</label><br>
    <select name="rol" required>
        <option value="admin" <?php echo $user['rol'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="gebruiker" <?php echo $user['rol'] === 'gebruiker' ? 'selected' : ''; ?>>Gebruiker</option>
    </select><br><br>

    <button type="submit" name="knop">Opslaan</button>
</form>

<p><a href="overview.php">Terug naar overzicht</a></p>
</main>
<?php require "partials/footer.php"; ?>