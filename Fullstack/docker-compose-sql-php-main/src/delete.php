<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: overview.php");
    exit();
}

$artikelId = $_GET['id'];

$conn = require_once "partials/dbconnection.php";

$stmt = $conn->prepare("DELETE FROM voorraadbeheer WHERE artikel_id = ?");
$stmt->bind_param("i", $artikelId);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: overview.php");
exit();
?>