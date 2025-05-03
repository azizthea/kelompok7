
<?php
require_once 'config/database.php';

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function generateVerificationCode() {
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
}
?>