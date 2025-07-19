<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_system";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        echo "Login successful!";
        // TODO: Redirect to dashboard or add 2FA
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "Email not found.";
}

$conn->close();
?>
