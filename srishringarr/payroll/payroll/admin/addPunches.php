<?
   session_start();
   include("header.php"); 
   include("$absolutepath/$dbfile");
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
     <option value="07" <?php if($_REQUEST['monid']==7){ echo "selected"; } ?>>July</option>
     <option value="08" <?php if($_REQUEST['monid']==8){ echo "selected"; } ?>>AUGUST</option>
     <option value="09" <?php if($_REQUEST['monid']==9){ echo "selected"; } ?>>SEPTEMBER</option>
     <option value="10" <?php if($_REQUEST['monid']==10){ echo "selected"; } ?>>OCTOBER</option>
     <option value="11" <?php if($_REQUEST['monid']==11){ echo "selected"; } ?>>NOVEMBER</option>
     <option value="12" <?php if($_REQUEST['monid']==12){ echo "selected"; } ?>>DECEMBER</option>
     <option value="01" <?php if($_REQUEST['monid']==01){ echo "selected"; } ?>>JANUARY</option>
     <option value="02" <?php if($_REQUEST['monid']==02){ echo "selected"; } ?>>FEBRUARY</option>
     <option value="03" <?php if($_REQUEST['monid']==03){ echo "selected"; } ?>>MARCH</option>
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
        if(isset($_REQUEST['empid']) && $_REQUEST['empid']!=-1 && isset($_REQUEST['monid']) && $_REQUEST['monid']!=-1 && isset($_REQUEST['pdate']) && $_REQUEST['pdate']!=-1 && isset($_REQUEST['p_time_in']) && $_REQUEST['p_time_in']!='' && isset($_REQUEST['p_time_out']) && $_REQUEST['p_time_out']!='')
   	{
         $empid=$_REQUEST['empid'];
         $pdate=$_REQUEST['pdate'];
         $p_time_in=$_REQUEST['p_time_in'];
         $p_time_out=$_REQUEST['p_time_out'];
   	$qry1=MYSQL_QUERY("INSERT INTO `punches_log`(`ID`, `punchtime`, `p_date`, `p_time`) VALUES ('".$empid."','".date('Y-m-d H:i:s')."','".$pdate."','".$p_time_in."')");
        $qry2=MYSQL_QUERY("INSERT INTO `punches_log`(`ID`, `punchtime`, `p_date`, `p_time`) VALUES ('".$empid."','".date('Y-m-d H:i:s')."','".$pdate."','".$p_time_out."')");
        if($qry1 and $qry2)
        echo "<center><b>Data added Successfully</b></center>";
        else
        echo "<center><b>Error Occurred , try again</b></center>";
   	}
   	if(isset($_REQUEST['empid']) && $_REQUEST['empid']!=-1 && isset($_REQUEST['monid']) && $_REQUEST['monid']!=-1)
   	{
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<input type="hidden" name="empid" id="empid" value="<?php echo $_REQUEST['empid']; ?>"/>
<input type="hidden" name="monid" value="<?php echo $_REQUEST['monid']; ?>"/>
<table border="1">
<tr>
<th>Date</th>
<th>In Time</th>
<th>Out Time</th>
</tr>
<tr>
	<td><select name="pdate" >
	    <option value=-1 >select</option>
<?php
$monid=$_REQUEST['monid'];
$i=0;
//$sdate='2015-'.$monid.'-01';
//$edate=date("Y-m-t", strtotime($sdate));
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $monid, $d, date('Y'));
    if (date('m', $time)==$monid){
        $list=date('Y-m-d', $time);
   ?>
   <option value="<?php echo $list; ?>" ><?php echo $list; ?></option>
   <?php
}}
//echo "select distinct(p_date) from punches_log where ID='".$_REQUEST['empid']."' and p_date between '$sdate' and '$edate' order by p_date";
?>
	</td>
	
		<td>			
			<input type="text" name="p_time_in" value="00:00:00"/>
		</td>
		<td>			
			<input type="text" name="p_time_out" value="00:00:00"/>
		</td>			
	</tr>
<tr>
<th colsan="3"><input type="submit" value="Submit"/></th>
</tr>
</table>
</form>
<?php
   	}
   ?>  
<? include("footer.php"); ?>