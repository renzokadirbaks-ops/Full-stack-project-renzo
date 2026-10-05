<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if ($id === null) {
    header("Location: overview.php");
    exit();
}

$conn = require_once "partials/dbconnection.php";

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: overview.php?msg=deleted");
exit();