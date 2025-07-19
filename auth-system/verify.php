<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_system";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if (password_verify($pass, $user['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['secret'] = $user['secret_key'];
        echo "
        <h3>Enter the 6-digit OTP from Google Authenticator</h3>
        <form action='otp_verify.php' method='POST'>
            <input type='text' name='otp' required pattern='[0-9]{6}' maxlength='6'>
            <input type='submit' value='Verify OTP'>
        </form>";
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Email not found.";
}

$conn->close();
?>
