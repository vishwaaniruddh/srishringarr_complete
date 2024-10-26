<?php
   //include("header.php"); 
   session_start();
   include('cal_attendance1.php');
   include("constants.php"); 
   include("$absolutepath/$dbfile");
   $pida=$_REQUEST['pid'];
   $empid=$_REQUEST['empid'];
   $monid=$_REQUEST['monid'];
   $errors=0;
   mysql_query("BEGIN");
   foreach($pida as $pid)
   {
   	//echo $pid."-".$_REQUEST['p_time_'.$pid]."<br/>";
   	$qry=mysql_query("update punches_log set p_time='".$_REQUEST['p_time_'.$pid]."' where pid='".$pid."'");
   	if(!$qry)
   	$errors++;
   }
   if($errors==0)
   {
   	mysql_query("COMMIT");
   	update_single($empid,$monid);
   	$_SESSION["result"]="Edited Successfully.";
   }
   else
   {
   	mysql_query("ROLLBACK");
   	$_SESSION["result"]="Editing failed, Please try again.";
   }
   header('location: editTimesheet.php');
?>