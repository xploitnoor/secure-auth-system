<?php
require_once 'lib/GoogleAuthenticator.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_system";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['fullname'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hash

// Generate 2FA secret
$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret(); // unique secret for user

// Save to DB
$sql = "INSERT INTO users (fullname, email, password, secret_key) VALUES ('$name', '$email', '$pass', '$secret')";

if ($conn->query($sql) === TRUE) {
    $qrCodeUrl = $ga->getQRCodeGoogleUrl($email, $secret, 'MySecureApp'); // generates QR code URL
    echo "✅ Signup successful!<br><br>";
    echo "<strong>📱 Scan this QR code in Google Authenticator:</strong><br><br>";
    echo "<img src='$qrCodeUrl'><br><br>";
    echo "<strong>Or manually enter this secret:</strong> <code>$secret</code><br><br>";
    echo "<a href='login.html'>Proceed to Login</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
