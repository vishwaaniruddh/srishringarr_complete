<?php
session_start();

// Clear cookies by setting them to a past time and specifying the path
$cookies_to_clear = ["ss_fname", "ss_lname", "ss_mobile", "ss_email", "ss_userid", "_ga_R8L1VTF3KQ", "_ga", "PHPSESSID"];

foreach ($cookies_to_clear as $cookie) {
    setcookie($cookie, '', time() - 3600, '/');
}

// Optionally, unset the cookies in the current request
foreach ($cookies_to_clear as $cookie) {
    unset($_COOKIE[$cookie]);
}

// Destroy the session
session_destroy();
?>

<script>
    window.location = 'index.php';
</script>
