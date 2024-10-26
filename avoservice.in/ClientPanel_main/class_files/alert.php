<?php

class alert{
	function send_alert(){
		//sending alert to area_head and city_head
		include_once('database_connection.php');
		$con_obj=new database_connection();
		$con_obj->open_connection("localhost","satyavan_atm123","service1234","satyavan_atm");
		$city_head_email=mysql_query("select * from city_head where ");
		$con_obj->close_connection();
		
		}
	}

?>