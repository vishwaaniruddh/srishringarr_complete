<?php
session_start();
include('./config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$gid = $_SESSION['gid'];
$email = $_POST['usernm'];
$passwd = $_POST['pass'];
// $referer = $_SESSION['referer'];

// Prepare the SQL statement
$stmt = $con->prepare("SELECT * FROM customer_login WHERE email=? AND password=? AND site='SN'");
$stmt->bind_param("ss", $email, $passwd);
$stmt->execute();
$result = $stmt->get_result();

if ($sql_result1 = $result->fetch_assoc()) {
    $id = $sql_result1['login_id'];

    $stmt = $con->prepare("SELECT * FROM Registration WHERE registration_id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sql_result = $result->fetch_assoc();

    $_SESSION['fname'] = $sql_result['Firstname'];
    $_SESSION['lname'] = $sql_result['Lastname'];
    $_SESSION['mobile'] = $sql_result['Mobile'];
    $_SESSION['email'] = $sql_result['email'];
    $_SESSION['gid'] = $sql_result['registration_id'];

    // Set cookies with the path set to '/'
    setcookie("ss_fname", $sql_result['Firstname'], time() + 31556926, '/');
    setcookie("ss_lname", $sql_result['Lastname'], time() + 31556926, '/');
    setcookie("ss_mobile", $sql_result['Mobile'], time() + 31556926, '/');
    setcookie("ss_email", $sql_result['email'], time() + 31556926, '/');
    setcookie("ss_userid", $sql_result['registration_id'], time() + 31556926, '/');

    $stmt = $con->prepare("UPDATE cart SET user_id = ? WHERE user_id=?");
    $stmt->bind_param("ss", $sql_result['registration_id'], $gid);
    $stmt->execute();
    ?>
    <script>
        alert('Login Successfully!');
        window.location.href="https://srishringarr.com/account/my-account.php";
        // window.location.href="https://srishringarr.com/";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("Incorrect Login Credentials");
        window.history.back();
    </script>
    <?php
}
?>
