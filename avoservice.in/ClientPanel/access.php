<?php
 session_start();
//if(!$_SESSION['user'] && !$_SESSION['branch'] && !$_SESSION['designation'])
if(!$_SESSION['designation'])
{
	header("location:index.php");
}
	
?>