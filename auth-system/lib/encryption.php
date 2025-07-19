<?php
// lib/encryption.php

define('ENCRYPTION_KEY', 'h8Vt$zR9xW7@b#UeT4Km%LpFqY2N3sDd'); // 32 characters for AES-256
define('ENCRYPTION_IV', substr(hash('sha256', 'MySecureApp_IV@2025'), 0, 16)); // 16 bytes IV

function encryptData($data) {
    return openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}

function decryptData($encrypted) {
    return openssl_decrypt($encrypted, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}
