<?php

//include('database_connection.php');
//$con_obj= new database_connection();
//$c = $con_obj->open_connection("localhost","abc","abc","assign");
//$con_obj->close_connection($c);
//include('demo_select.php');
//$select_obj= new demo_select();
//$select_obj->select_rows($select_obj->columnlist_string_builder(array("username")),"login","username","sheetal",array("Username"),"n","","");


//include ('database_connection.php');
//$obj=new database_connection();
//$obj->open_connection("localhost","abc","abc","assign");
include('select.php');
$sel_obj=new select();
//$obj->close_connection();
$sel_obj->select_rows("localhost","abc","abc","assign",array("username"),"login","username","shilpa",array("Username"),"n","","");

?>