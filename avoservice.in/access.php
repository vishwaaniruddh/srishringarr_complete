<?php
 session_start();
if(!isset($_SESSION['user']) && !isset($_SESSION['branch']) && !isset($_SESSION['designation']))
{
//echo "hii";
	header("location:index.php");
}
	
?>