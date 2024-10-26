<?
   session_start();
   include("header.php"); 
   include("datacon.php");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : editimesheet.php
    // Description : This file displays timesheet records for an employee
    //               for a period of time and allows admin to choose and edit 
    //               these records
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enterdates.php,edittimerecord.php
    
?>
<script>
function addpunch(cnt) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	if(xmlhttp.responseText!='0')
            	{
                	document.getElementById("td_"+cnt).innerHTML = xmlhttp.responseText;
                }
                else
                {
                	alert('Failed, Please try again.');
                }
            }
        }
        empid=document.getElementById("empid").value;
        ptime=document.getElementById("p_time_"+cnt).value;
        pdate=document.getElementById("p_date_"+cnt).value;
        xmlhttp.open("GET", "addpunch.php?empid=" + empid+"&ptime=" + ptime+"&pdate=" + pdate, true);
        xmlhttp.send();
}
</script>
<?php
if(isset($_SESSION["result"]))
{
echo "<h1>".$_SESSION["result"]."</h1>";
unset($_SESSION["result"]);
}
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
     <center> Select Month : <select name="monid" ><option value=-1 >select</option>
     <option value="01" <?php if($_REQUEST['monid']==1){ echo "selected"; } ?>>JANUARY</option>
     <option value="02" <?php if($_REQUEST['monid']==2){ echo "selected"; } ?>>FEBRUARY</option>
     <option value="03" <?php if($_REQUEST['monid']==3){ echo "selected"; } ?>>MARCH</option>
     <option value="04" <?php if($_REQUEST['monid']==4){ echo "selected"; } ?>>APRIL</option>
     <option value="05" <?php if($_REQUEST['monid']==5){ echo "selected"; } ?>>MAY</option>
     <option value="06" <?php if($_REQUEST['monid']==6){ echo "selected"; } ?>>JUNE</option>
     <option value="07" <?php if($_REQUEST['monid']==7){ echo "selected"; } ?>>JULY</option>
     <option value="08" <?php if($_REQUEST['monid']==8){ echo "selected"; } ?>>AUGUST</option>
     <option value="09" <?php if($_REQUEST['monid']==9){ echo "selected"; } ?>>SEPTEMBER</option>
     <option value="10" <?php if($_REQUEST['monid']==10){ echo "selected"; } ?>>OCTOBER</option>
     <option value="11" <?php if($_REQUEST['monid']==11){ echo "selected"; } ?>>NOVEMBER</option>
     <option value="12" <?php if($_REQUEST['monid']==12){ echo "selected"; } ?>>DECEMBER</option>
     </select>

Select Employee : <select name="empid" ><option value=-1 >select</option>
<?
          $empquery = "select empid,firstname,lastname,ssn from employee";
          $empresult =  MYSQL_QUERY($empquery) or die("SQL Error Occured : ".mysql_error().':'.$empquery);
          while($emprow=mysql_fetch_row($empresult))
          {
?>        <option value=<?php echo $emprow[3]; ?> <?php if($_REQUEST['empid']==$emprow[3]){ echo "selected"; } ?>><?php echo $emprow[1]." ".$emprow[2]; ?></option>

  <?php } ?></select>
  <input type="submit" value="Submit"/>
</form>
   <?php
   	if(isset($_REQUEST['empid']) && $_REQUEST['empid']!=-1 && isset($_REQUEST['monid']) && $_REQUEST['monid']!=-1)
   	{
?>
<form method="post" action="process_editTimesheet.php">
<input type="hidden" name="empid" id="empid" value="<?php echo $_REQUEST['empid']; ?>"/>
<input type="hidden" name="monid" value="<?php echo $_REQUEST['monid']; ?>"/>
<table border="1">
<tr>
<th>Date</th>
<th>In Time</th>
<th>Out Time</th>
</tr>
<?php
$monid=$_REQUEST['monid'];
$i=0;
$sdate='2016-'.$monid.'-01';
$edate=date("Y-m-t", strtotime($sdate));

//echo "select distinct(p_date) from punches_log where ID='".$_REQUEST['empid']."' and p_date between '$sdate' and '$edate' order by p_date";
$punch_qry=mysql_query("select distinct(p_date) from punches_log where ID='".$_REQUEST['empid']."' and p_date between '$sdate' and '$edate' order by p_date");


while($punch_row=mysql_fetch_array($punch_qry))
{
?>
	<tr>
	<td><?php echo date('d-m-Y',strtotime($punch_row[0])); ?>
	<?php
	$pidqry=mysql_query("select min(p_time),max(p_time) from punches_log where ID='".$_REQUEST['empid']."' and p_date ='".$punch_row[0]."'");
	$pidrow=mysql_fetch_row($pidqry);
	$mint=mysql_query("select pid,p_time from punches_log where ID='".$_REQUEST['empid']."' and p_date ='".$punch_row[0]."' and p_time='".$pidrow[0]."'");
	$mintr=mysql_fetch_row($mint);
	if($pidrow[0]!=$pidrow[1])
	{
	$maxt=mysql_query("select pid,p_time from punches_log where ID='".$_REQUEST['empid']."' and p_date ='".$punch_row[0]."' and p_time='".$pidrow[1]."'");
	$maxtr=mysql_fetch_row($maxt);
	}
	/*$tdate_qry=mysql_query("select * from punches_log where ID='".$_REQUEST['empid']."' and p_date ='".$punch_row[0]."' order by p_time");
	while($tdate_row=mysql_fetch_array($tdate_qry))
	{*/
	?>
		<td>
			<input type="hidden" name="pid[]" value="<?php echo $mintr[0]; ?>"/>
			<input type="text" name="p_time_<?php echo $mintr[0]; ?>" value="<?php echo $mintr[1]; ?>"/>
		</td>
		<?php
		if($pidrow[0]!=$pidrow[1])
		{
		?>
		<td>
			<input type="hidden" name="pid[]" value="<?php echo $maxtr[0]; ?>"/>
			<input type="text" name="p_time_<?php echo $maxtr[0]; ?>" value="<?php echo $maxtr[1]; ?>"/>
		</td>
		<?php
		}
		else
		{
		?>
		<td id="td_<?php echo $i; ?>">
			<input type="text" id="p_time_<?php echo $i; ?>" placeholder="00:00:00"/>
			<input type="hidden" id="p_date_<?php echo $i; ?>" value="<?php echo $punch_row[0]; ?>"/>
			<input type="button" Value="Add" onclick="addpunch(<?php echo $i; ?>)"/>
		</td>
		<?php
		$i++;
		}
		?>
	<?php
	//}
	?>
	</tr>
<?php
}
?>
<tr>
<th colsan="3"><input type="submit" value="Submit"/></th>
</tr>
</table>
</form>
<?php
   	}
   ?>  
<? include("footer.php"); ?>