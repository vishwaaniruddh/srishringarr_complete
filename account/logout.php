<?php
session_start();

$cookie_params = [
    'expires' => time() - 3600, // Expire in the past
    'path' => '/',
    'secure' => true, // Only send cookies over HTTPS
    'httponly' => true, // Only accessible via HTTP protocol
    'samesite' => 'Lax' // Prevent CSRF
];

setcookie("ss_fname", '', $cookie_params);
setcookie("ss_lname", '', $cookie_params);
setcookie("ss_mobile", '', $cookie_params);
setcookie("ss_email", '', $cookie_params);
setcookie("ss_userid", '', $cookie_params);

setcookie("_ga_R8L1VTF3KQ", '', $cookie_params);
setcookie("_ga", '', $cookie_params);
setcookie("PHPSESSID", '', $cookie_params);

session_destroy();
?>
<script>
    window.location.href = '../index.php';
</script>
