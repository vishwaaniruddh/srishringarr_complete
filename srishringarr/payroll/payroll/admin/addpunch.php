<?php
   //include("header.php"); 
   session_start();
   include("constants.php"); 
   include("$absolutepath/$dbfile");
   $empid=$_REQUEST['empid'];
   $ptime=$_REQUEST['ptime'];
   $pdate=$_REQUEST['pdate'];
   $qry=mysql_query("INSERT INTO `punches_log`(`ID`, `punchtime`, `p_date`, `p_time`) VALUES ('".$empid."','".date('Y-m-d H:i:s')."','".$pdate."','".$ptime."')");
   if($qry)
   {
   	$pid=mysql_insert_id();
?>
<input type="hidden" name="pid[]" value="<?php echo $pid; ?>"/>
<input type="text" name="p_time_<?php echo $pid; ?>" value="<?php echo $ptime; ?>"/>
<?php   	
   }
   else
   echo "0";
?>