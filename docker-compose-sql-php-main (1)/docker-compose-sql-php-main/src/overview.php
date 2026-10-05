<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$title = "Overzicht gebruikers";
require "partials/header.php";

$conn = require_once "partials/dbconnection.php";
$result = $conn->query("SELECT * FROM users");
?>
<main>
<h2>Overzicht gebruikers</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') { ?>
    <p>Gebruiker verwijderd.</p>
<?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'updated') { ?>
    <p>Gebruiker bijgewerkt.</p>
<?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'created') { ?>
    <p>Gebruiker toegevoegd.</p>
<?php } ?>

<p><a href="create.php">Nieuwe gebruiker toevoegen</a></p>

<table border="1">
  <tr>
    <th>Id</th>
    <th>Username</th>
    <th>Rol</th>
    <th>Actie</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo htmlspecialchars($row['username']); ?></td>
      <td><?php echo htmlspecialchars($row['rol']); ?></td>
      <td>
        <a href="update.php?id=<?php echo $row['id']; ?>">Bewerken</a>
        |
        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a>
      </td>
    </tr>
  <?php } ?>

</table>
</main>
<?php require "partials/footer.php"; ?>