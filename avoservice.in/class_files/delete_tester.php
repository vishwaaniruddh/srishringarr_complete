<?php

include('delete.php');
$delete_obj = new delete();
$bool= $delete_obj->delete_from("localhost","abc","abc","assign","login","password","johnny123");
if($bool)echo"Row(s) deleted";
	else echo "No such row found!";

?>