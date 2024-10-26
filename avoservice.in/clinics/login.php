<?php
//check for valid IP's
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  //  echo "11-".$ip;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  //  echo "12-".$ip;
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
  //  echo "13-".$ip;
}
//if($ip=='103.212.140.101' or $ip=='183.87.44.77' or $ip=='122.170.2.234' or $ip=='182.70.115.173')
//{
	//Start session
	session_start();
	
	//Include database connection details
	include('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) 
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
		{
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['uname']);
	$password = clean($_POST['pass']);
	
	//Input Validations
	if($login == '')
	 {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') 
	{
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag)
	 {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:index.html");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM login WHERE username='$login' AND password='".$_POST['pass']."' and status=1";
	//echo $qry;
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result)
	{
		if(mysql_num_rows($result) == 1)
		 {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			//$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			//$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			
			$_SESSION['SESS_USER_NAME'] = $member['username'];
			$_SESSION['type'] = $member['type'];
			$_SESSION['dept'] = $member['dept'];
			
			session_write_close();
			if($member['dept']=='5')
			header("location: View_app.php");
			else
			header("location:view_patient1.php");
			exit();
		}
		else 
		{
			//Login failed
			header("location: index.html");
			exit();
		}
	}
	else
	{
		die("Query failed");
	}
	/*}
	else
	echo "It seems you are not a valid user . Please contact system administrator";*/
?>