<?php
$key = 'your_secret_key_32_characters'; // Must be 32 chars for AES-256

function encrypt($data, $key) {
    $iv = openssl_random_pseudo_bytes(16);
    $cipher = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($iv . $cipher);
}

function decrypt($encrypted_data, $key) {
    $data = base64_decode($encrypted_data);
    $iv = substr($data, 0, 16);
    $cipher = substr($data, 16);
    return openssl_decrypt($cipher, 'AES-256-CBC', $key, 0, $iv);
}
?>
