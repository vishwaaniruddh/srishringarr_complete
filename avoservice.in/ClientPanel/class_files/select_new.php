<?php

class site_filter{
	function filter_site($server_name,$db_username,$db_password,$db_name,$arry_final_columns,$table,$array_filtbycol,$array_filtbyval,$order_by_col,$order_by_a_d){
		include_once('filter.php');
		$filter_obj=new filter();
		$tab=$filter_obj->filter_by($server_name,$db_username,$db_password,$db_name,$arry_final_columns,$table,$array_filtbycol,$array_filtbyval,$order_by_col,$order_by_a_d);
		return $tab;
		}
	}
	
	//Testing:
    //$ob=new site_filter();
//	$obj=$ob->filter_site('localhost','site','site','atm_site',array("*"),'atm',array("city"),array("Mumbai"),"bank_name","d");
//	
//	include_once('table_formation.php');
//	$format=new table_formation();
//	$format->table_forming(array("","","","","",""),$obj,'n');
?>