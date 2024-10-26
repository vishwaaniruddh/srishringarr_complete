<?

   $se=n;
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : approvehours.php
    // Description : This file approve timesheet hours... sets the checked field to y
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files :
    
?>
<?

echo "<h3>Approved Hours for $empname</h3>";
echo "<h3>Period : $startdate to $enddate</h3>";
echo "<table width=364 border=0 cellspacing=0 cellpadding=0>";
 
for ($a=0;$a<$numelements;$a++)
{
    if ($checkbox[$a]!="")
    {
       
       $i=0;
       
       // Query to find all checkins between $startdate and $enddate 
       $query = "select * from timesheet where timeid='$checkbox[$a]'";
                    
       $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
          
       // Fetching Timesheet Data and storing in local variables  
      $timeid = mysql_result($result,$i,"timeid");                     
      $empid = mysql_result($result,$i,"empid");
      $roundedtime= mysql_result($result,$i,"roundedtime");
      $workdesc = mysql_result($result,$i,"workdesc");
                                      
      $checkin = mysql_result($result,$i,"checkin");
      $checkout = mysql_result($result,$i,"checkout");



      // breaking DateTime records into date and time
      list($inday,$intime)=explode(' ',$checkin);
      list($outday,$outtime)=explode(' ',$checkout);
                                      
      list($iyear,$imonth,$idate)=explode('-',$inday);
                                      
      $weekday=date("D jS M", mktime (0,0,0,$imonth,$idate,$iyear));
      
      $intime=substr($intime,0,5);
      $outtime=substr($outtime,0,5);
      
      $hoursapproved=$hoursapproved+$roundedtime;
      
      
      echo "<tr><td height=30 width=274>$weekday : $intime - $outtime<font color=#3333FF> &nbsp;<b>approved</b></font></td>";
      echo "<td height=30 width=90><b><font color=#CC0033>$roundedtime</font></b> hours</td></tr>";
          
      approvetime($timeid);
       
       
       
    }
}

echo "</table>";

echo "<h3>Total hours Approved : $hoursapproved </h3>";


echo "<a href=\"$siteaddress/admin/choosedeptemp.php?deptid=$deptid&startdate=$startdate&enddate=$enddate&scriptname2=checktimesheet.php&what=CheckTimeSheets\">Back to Choose Employees for Time Approval</a><br>";


?>
<? include("footer.php"); ?>