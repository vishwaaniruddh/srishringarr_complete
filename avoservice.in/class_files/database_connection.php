<?php

class database_connection{
	private $con;
	function open_connection($server_name,$db_username,$db_password,$db_name){	
	//	$this->con = mysql_connect($server_name,$db_username,$db_password);
		//$this->con = mysql_connect("mysql1002.mochahost.com","satya123_acc","Myaccounts123*");
		//mysql_select_db("satya123_satyavan_hav_accounts");
		}
				
	function close_connection(){
		mysql_close($this->con);
		}
	}

?>