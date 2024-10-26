<?php
include('../config.php');

$name = $_POST["name"];
    $email = $_POST["email"];
    $gcm_regid = $_POST["regId"];
    $mac_id = $_POST["mac_id"];
    $username=$_POST["username"];
    ?>
    <form name="myfrm" method="post" action="register.php" >
    <tr><td>Name</td><td>email</td><td>regid</td><td>macid</td><td>username</td></tr>
        <input type="text" name="name" id="name" />
        <input type="text" name="email" id="email" />
        <input type="text" name="regId" id="regId" />
        <input type="text" name="mac_id" id="mac_id" />
        <input type="text" name="username" id="username" />
        <input type="submit" name="done" id="done" value="Submit" />
    </form>