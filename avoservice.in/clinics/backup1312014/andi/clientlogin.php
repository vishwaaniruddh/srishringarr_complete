<?php
	//Include database connection details
	include('../config.php');
	
	//Array to store validation errors
	function clean($str) 
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
		{
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	$response=array();
	
	$login = clean($_GET['uname']);
	$password = clean($_GET['pass']);
	//$res='';

	//Create query
	$qry="SELECT * FROM patient_login WHERE username='$login' AND password='".$password."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result)
	{
		if(mysql_num_rows($result) == 1)
		 {
			//Login Successful
			//session_regenerate_id();
			$member = mysql_fetch_row($result);
			$response[]=array( 'patid' => $member[3]);
			//$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			//$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			
			//$_SESSION['SESS_USER_NAME'] = $member['username'];
			//$_SESSION['type'] = $member['type'];
			
			//session_write_close();
			//header("location:home.php");
			//exit();
		}
		else 
		{
			//Login failed
			$response[]=array( 'patid' =>"-1");
		}
	}
	else
	{
	$response[]=array( 'patid' =>"-1");
	}
	//$res="uname = ".$_POST['uname']." password".$_POST['pass'];
	
	echo json_encode($response);
?>