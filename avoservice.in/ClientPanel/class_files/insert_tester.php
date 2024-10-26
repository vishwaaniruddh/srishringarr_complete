<?php

include("insert.php");
$insert_obj = new insert();
$bool=$insert_obj->insert_into("localhost","abc","abc","assign","login",array("username","password"),array("scooby","scooby123"));
if($bool)echo"One row inserted!";
	else echo "Could not insert the row!";

?>