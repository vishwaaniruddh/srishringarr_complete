<?php

class date_range{
	function date_filter($server_name,$db_username,$db_password,$db_name,$table,$date_col,$from_date,$to_date){
		$from_date1=strtotime($from_date);
		$to_date1=strtotime($to_date);
		$from_date_in_format=date("Y-m-d",$from_date1);
		$to_date_in_format=date("Y-m-d",$to_date1);
		include_once('database_connection.php');
		$con_obj=new database_connection();
		$con_obj->open_connection($server_name,$db_username,$db_password,$db_name);
		$query_str="select * from $table where 0=0 ";
		if($from_date!=''){			
			if($to_date!=''){
			$query_str.="and $date_col between '$from_date_in_format' and '$to_date_in_format'";
			}
			else{
				$query_str.="and $date_col>='$from_date_in_format'";
			}
		}
		else{
			if($to_date!=''){
				$query_str.="and $date_col<='$to_date_in_format'";
				}				
			}
			//echo $query_str;
			$table=mysql_query($query_str);
			$con_obj->close_connection();
			return $table;
		}
	}
	//Testing:
/*$obj=new date_range();
$table=$obj->date_filter('localhost','site','site','atm_site','alert','alert_date','30th April 2013','');
include_once('table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","","","","","","","","","","",""),$table,"n");*/


?>