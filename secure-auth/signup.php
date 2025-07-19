<?php
include 'db.php';
include 'encrypt.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $plain_password = $_POST["password"];

    $encrypted_password = encrypt($plain_password, $key);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $encrypted_password);

    if ($stmt->execute()) {
        $msg = "Signup successful! You can now login.";
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<form method="POST">
    <h2>Signup</h2>
    <p style="color:green"><?= $msg ?></p>
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Signup</button>
</form>
<a href="login.php">Already have an account? Login</a>
