<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('CLIENT ID -TOBEADDED');
$client->setClientSecret('CLIENT SECRET TOBEADDED');
$client->setRedirectUri('http://localhost/auth-system/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        // Get user info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // You can now store user info in session or database
        session_start();
        $_SESSION['name'] = $google_account_info->name;
        $_SESSION['email'] = $google_account_info->email;
        $_SESSION['picture'] = $google_account_info->picture;

        // Redirect to login.php or dashboard
        header('Location: login.php');
        exit;
    } else {
        echo "Error fetching token.";
    }
} else {
    echo "Invalid callback request.";
}
?>
