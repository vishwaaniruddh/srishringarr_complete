<?php
include("update.php");
$update_obj = new update();
$bool = $update_obj->update_table("localhost","abc","abc","assign","login","password","happy123","username","joy");
if(!($bool))echo"Cannot be updated";
	else echo("One row updated");

?>