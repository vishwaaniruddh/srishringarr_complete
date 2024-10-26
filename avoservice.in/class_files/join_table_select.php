<?php



class join_table_select{
function select_from_join($server_name,$db_username,$db_password,$db_name,$array_final_column,$table_string_1,$join_type,$table_string_2,$on_column_1,$on_column_2,$filter_column,$filter_value,$array_table_heading,$return_y_n){
	include_once ('string_builder.php');
	$str_builder_obj=new string_builder();
	$final_column_string= $str_builder_obj->string_with_commas($array_final_column);
	//include_once ('table_formation.php');
	include_once ('database_connection.php');	
	$con_obj=new database_connection();
	$con_obj->open_connection($server_name,$db_username,$db_password,$db_name);
	$i = rand();	
	//create 2temp tables
	//mysql_query("create table temp1(col1 varchar(300),col2 varchar(300),col3 varchar(300))");
	//$row=mysql_fetch_row($table_string_1);
	//echo $row;
	//while($row){
//		for($i=0;$i<mysql_num_rows($table_string_1);i++){
//			
//			}
//		
//	}
	//mysql_query("insert into temp1 values($row[i])");
	$temp="temp_".$i;
	//echo "<br>".$temp;
	echo "<br>create view $temp as (select $final_column_string from $table_string_1 x $join_type $table_string_2 y on x.$on_column_1=y.$on_column_2 where $filter_column='$filter_value')";
	$join_select_query=mysql_query("create view $temp as (select distinct $final_column_string from $table_string_1 x $join_type $table_string_2 y on x.$on_column_1=y.$on_column_2 where $filter_column='$filter_value')");
	//if($join_select_query) echo "creation done";
	//else echo "Could not create only";
	//echo"here1";
		if($join_select_query && $return_y_n=="n"){
			include_once ('select.php');
			$sel_obj= new select();
	$temp_table=$sel_obj->select_rows($server_name,$db_username,$db_password,$db_name,"*",$temp,"","",$array_table_heading,"n","","");
	if($temp_table) return true; else return false;
		}
		else if($join_select_query && $return_y_n=="y")
		{
			//include_once ('select.php');
			//$sel_obj= new select();
	//$temp_table=$sel_obj->select_rows("localhost","atm","atm","atm_service_management","*",$temp,"","",$array_table_heading,"n","","");
			return $temp;
			}
			else{
				return false;
				}


$con_obj->close_connection();
	}
//	function name_table($table,$h,$r){
//		$named_table =mysql_query("select * from atm_details ");
//		$func_obj=new table_formation();
//		
//			$func_obj->table_forming($h,$named_table,$r);
//		
//		}
}

?>