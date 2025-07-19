<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('CLIENT_ID_TOBEADDED');
$client->setClientSecret('CLIENT-SECRET-TOBEADDED');
$client->setRedirectUri('http://localhost/auth-system/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();

// Redirect to Google Login
header('Location: ' . filter_var($login_url, FILTER_SANITIZE_URL));
exit;
?>
