<?php

class delete{
	function delete_from($server_name,$db_username,$db_password,$db_name,$table_name,$ref_col_name,$ref_col_value){	
		include_once('database_connection.php');	
		$con_obj=new database_connection();
		$con_obj->open_connection($server_name,$db_username,$db_password,$db_name);
		$check_query = mysql_query("select * from $table_name where $ref_col_name = '$ref_col_value'");
		if(mysql_num_rows($check_query)>0){		
			//$bool=mysql_query("delete from $table_name where $ref_col_name = '$ref_col_value'");
			$bool=mysql_query("update $table_name set active='N' where $ref_col_name = '$ref_col_value'");
			if ($bool)return true;
			else return false;
			}
			else return false;				
			$con_obj->close_connection();
		}
	}

?>