<?php
include("access.php");
include("config.php");
session_start();
if(!$_SESSION['user'])
	header('location:index.php');
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
	function validate1(form1)
	{
		with(form1)
		{
			var numbers = /^[0-9]+$/;
			var namePattern = /^[A-Za-z()_ ]/;
			if(cur_pwd.value=="")
			{
				alert("Please enter current password.");
				cur_pwd.focus();
				return false;
			}
			if(new_pwd1.value=="")
			{
				alert("Please enter new password.");
				new_pwd1.focus();
				return false;
			}
			if(new_pwd2.value=="")
			{
				alert("Please enter retype password.");
				new_pwd2.focus();
				return false;
			}
			if(new_pwd1.value.localeCompare(new_pwd2.value)!=0)
			{
				alert("Two password does not match");
				document.getElementById('new_pwd1').value="";
				document.getElementById('new_pwd2').value="";	
				new_pwd1.focus();	
				return false;		
			}
			
		}
		if(confirm("Are you sure you want to change password.")){
			return true;
		}
		else{
			return false;
		}
	}
	function chck_valid2()
	{
		var new_pwd1=document.getElementById('new_pwd1').value;
		var new_pwd2=document.getElementById('new_pwd2').value;
		if(new_pwd1.localeCompare(new_pwd2)!=0)
		{
			alert("Two password does not match");
			document.getElementById('new_pwd1').value="";
			document.getElementById('new_pwd2').value="";	
			new_pwd1.focus();						
		}
	}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
</center>
<?php
	if(isset($_REQUEST['success']))
	{
		if($_REQUEST['success']==0)	
		{
			$result="Password does not match please try again.";
		}
		else if($_REQUEST['success']==1)	
		{
			$result="Password changed sucessfully.";
		}
		else if($_REQUEST['success']==2)	
		{
			$result="Server problem please try again.";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
	}
?>
<div style="margin-left:100px;">
<h2 class="h2color">Change Password</h2>
<form name="form" method="post" action="process_change_pwd.php" onsubmit="return validate1(this)">
<table cellpadding="20px">
   <?php 
 
   $usern=mysql_query("select * from `login` where `username`='".$_SESSION['user']."'");
   $usern1=mysql_fetch_row($usern);
  
   ?>
	<tr height="50px">
    	<td>User Name : <b style="color:#F00;">*</b></td>
        <td><input type="text" name="username" id="username" value="<?php echo ucfirst($usern1[1]); ?>" readonly="readonly"/></td>
    </tr>
	<tr height="50px">
    	<td>Current Password : <b style="color:#F00;">*</b></td>
        <td><input type="password" name="cur_pwd" id="cur_pwd"/></td>
    </tr>
    <tr height="50px">
    	<td>New Password : <b style="color:#F00;">*</b></td>
        <td><input type="password" name="new_pwd1" id="new_pwd1" /></td>
    </tr>
    <tr height="50px">
    	<td>Retype Password : <b style="color:#F00;">*</b></td>
        <td><input type="password" name="new_pwd2" id="new_pwd2" onblur="chck_valid2()"/></td>
    </tr>
    <td colspan="2" height="50px" align="center"><input type="submit" name="Submit" value="Change" /></td>
</table>
</form>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>