<?php
include("config.php");
$id=$_GET['id'];
$field=$_GET['field'];
$val=$_GET['value'];
$table=$_GET['table'];

//echo $id." ".$field." ".$val;
//echo "Update $table set $field='".$val."' where opd_real_id='".$id."'";
$qry=mysql_query("Update ".$table." set $field='".$val."' where opd_real_id='".$id."' ");
if($qry)
echo '1';
else
echo "".mysql_error();
?>