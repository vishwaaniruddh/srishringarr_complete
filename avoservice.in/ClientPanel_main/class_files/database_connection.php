<?php

class database_connection{
	private $con;
	function open_connection($server_name,$db_username,$db_password,$db_name){	
	//	$this->con = mysql_connect($server_name,$db_username,$db_password);
		$this->con = mysql_connect("localhost","satyavan_acc","Myaccounts123*");
		mysql_select_db("satyavan_accounts");
		}
				
	function close_connection(){
		mysql_close($this->con);
		}
	}

?>