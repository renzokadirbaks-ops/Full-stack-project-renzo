<!DOCTYPE html>
<html lang="nl">
  <link rel="stylesheet" href="/css/style.css">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title ?? 'PHP'; ?></title>
</head>
<body>
<main>
<?php

if (isset($_SESSION['loggedin'])) { ?>
    <p>Ingelogd als: <?php echo $_SESSION['username']; ?> | <a href="logout.php">Uitloggen</a></p>
<?php } ?>
</main>