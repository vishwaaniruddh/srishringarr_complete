<?php
	//Start session
	session_start();
	
	//Include database connection details
	include_once 'config.php';
	
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
		return mysqli_real_escape_string($str);
	}
	
	//Sanitize the POST values
	//$login = clean($_POST['uname']);
	//$password = clean($_POST['pass']);
	$login = $_POST['uname'];
	$password = $_POST['pass'];
	
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
	$qry="SELECT * FROM login WHERE username='".$login."' AND password='".$_POST['pass']."'";
	$result=mysqli_query($con,$qry);
	
	//Check whether the query was successful or not
	if($result)
	{
		if(mysqli_num_rows($result) == 1)
		 {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			//$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			//$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			
			$_SESSION['SESS_USER_NAME'] = $member['username'];
			$_SESSION['type'] = $member['type'];
			
			session_write_close();
			header("location:home.php");
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
?>