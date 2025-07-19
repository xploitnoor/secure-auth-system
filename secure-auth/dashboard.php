<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["user"];
?>

<h2>Welcome, <?= $user["name"] ?>!</h2>
<p>Your email: <?= $user["email"] ?></p>
<a href="logout.php">Logout</a>
