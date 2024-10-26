<?php

class generic_filter{
	function filter($server_name,$db_username,$db_password,$db_name,$table,$array_columns,$array_values){
		include_once('database_connection.php');
		$con_obj=new database_connection();
		$con_obj->open_connection($server_name,$db_username,$db_password,$db_name);
		$query_str="select * from $table where 0=0 ";
		for($i=0;$i<count($array_columns);$i++){
		if($array_values[$i]!=""){
		$query_str.="and $array_columns[$i] like('$array_values[$i]%')";
		}
		}
		//echo $query_str;
		$table=mysql_query($query_str);
		$con_obj->close_connection();
		return $table;
		}
	}
	//Testing:
/*$ob=new generic_filter();
$table=$ob->filter('localhost','site','site','atm_site','alert',array("atm_id","cust_id","bank_name","city"),array("","","","M"));
include_once('table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","","",""),$table,"n");*/
?>