<?php
session_start();
require_once 'lib/GoogleAuthenticator.php';

$otp = $_POST['otp'];
$secret = $_SESSION['secret'];

$ga = new PHPGangsta_GoogleAuthenticator();
$isValid = $ga->verifyCode($secret, $otp, 2); // 2 = clock drift allowed (2 x 30 sec)

if ($isValid) {
    echo "✅ 2FA Verification Successful!<br>";
    echo "Welcome, " . $_SESSION['email'];
} else {
    echo "❌ Invalid OTP. Please try again.";
}
?>
