<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : checktimesheet.php
    // Description : This file allows administrator to check time worked by 
    //               employees and approve them
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?

          // Get Employee Name 
          $empname=getempname($empid);

          // Adding time to the dates
          // Starting at 00:00 on the $startdate
          $startdate1=$startdate." 00:00:00";
          
          // Ending at 23:59:59 on the enddate
          $enddate1=$enddate." 23:59:59";

           
          // Query to find all checkins between $startdate and $enddate 
          $query = "select * from timesheet where empid='$empid' and checkin >= '$startdate1' and checkout <= '$enddate1' order by checkin;";
                    
          $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

          // Finding number of rows of SQL Query
          if ($result>0) { $number = MYSQL_NUMROWS($result); }
          else {$number=0;}   
 
          // If there is no timesheet record
          if ($number == 0)
          {
              echo "<ul>";
       	     
              echo "<h3>Sorry there are no Timesheet Records for $empname from $startdate to $enddate</h3>";
  
              echo $back;
              
              echo "</ul>";
                              
          }
          // else if there are timesheet records
          elseif ($number > 0)
          {
               	
?>
         	





<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
      <h2>Manager Time Approval </h2>
      <form method="post" action="approvehours.php">
        <table width="640" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="154" height="40"> 
              <div align="right">Employee Name :</div>
            </td>
            <td width="486"><font color="#990033"><b><? echo $empname; ?></b></font></td>
          </tr>
          <tr> 
            <td width="154" height="40"> 
              <div align="right">Date Period :</div>
            </td>
            <td width="486"><font color="#990033"><b><? echo "$startdate - $enddate"; ?></b></font></td>
          </tr>
        </table>
        <table width="640" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#CCCCCC"> 
            <td width="176" height="30"> 
              <div align="center"><b>Date </b></div>
            </td>
            <td width="208" height="30"> 
              <div align="center"><b>Time</b></div>
            </td>
            <td width="108" height="30"> 
              <div align="center"><b>Hours</b></div>
            </td>
            <td width="148" height="30"> 
              <div align="center"><b>Checked</b></div>
            </td>
          </tr>
<?

                      
                               $totalhours=0;
                               $i=0;
                               // Go through each record in loop
                               while ($i < $number)
                               {

                                      $q=$i+1;

                                                                
                                      // Fetching Timesheet Data and storing in local variables  
                                      $timeid = mysql_result($result,$i,"timeid");                     
                                      $empid = mysql_result($result,$i,"empid");
                                      $roundedtime= mysql_result($result,$i,"roundedtime");
                                      $workdesc = mysql_result($result,$i,"workdesc");
                                      
                                      $checkin = mysql_result($result,$i,"checkin");
                                      $checkout = mysql_result($result,$i,"checkout");
                                   
                                      // Calculating Total Hours
                                      $totalhours=$totalhours+$roundedtime; 


                                      // breaking DateTime records into date and time
                                      list($inday,$intime)=explode(' ',$checkin);
                                      list($outday,$outtime)=explode(' ',$checkout);
                                      
                                      list($iyear,$imonth,$idate)=explode('-',$inday);
                                      
                                      $weekday=date("D jS M", mktime (0,0,0,$imonth,$idate,$iyear));

                                      

                                      if ($outday!=$inday) {$outtime=$outtime."<b>(nd)</b>";};
                                      
                                      
                                      $intime=substr($intime,0,5);
                                      $outtime=substr($outtime,0,5);
                                      
                                      
                                     // making every other alternate row
                                     // of a different color
                                     $k=$i/2;
                                     $k=substr($k,-1,1);
                  
                                     // if row is odd, then make row background grey
                                     if ($k=="5")
                                     {
                  
                                        $rowbg="#E7F8EB";	
                  	
                                     }
                                     else
                                     {
                                           $rowbg="#FFFFFF";
                                     }

?>          
              
          <tr> 
            <td width="176"> 
              <div align="center"><b><? echo $weekday; ?></b></div>
            </td>
            <td width="208" height="35"> 
              <div align="center"><? echo "$intime - $outtime"; ?></div>
            </td>
            <td width="108"> 
              <div align="center"><? echo $roundedtime; ?></div>
            </td>
            <td width="148"> 
              <div align="center"> 
                <input type="checkbox" name="checkbox[]" value="<? echo $timeid; ?>" checked>
              </div>
            </td>
          </tr>
          <tr> 
          
          <?
          
             $i++;
             
        } //end while
        
        
        ?>
          
          
          
          <tr bgcolor="#990000"> 
            <td width="176" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
            <td width="208" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
            <td width="108" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
            <td width="148" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          </tr>
         
        
        
          <tr> 
            <td width="176">&nbsp;</td>
            <td width="208" height="35"> 
              <div align="right">Total :</div>
            </td>
            <td width="108"> 
              <div align="center"><? echo $totalhours; ?></div>
            </td>
            <td width="148"> 
              <div align="center"> </div>
            </td>
          </tr>
        </table>
        <p>
          <input type="hidden" name="numelements" value="<? echo $number; ?>">
          <input type="hidden" name="empname" value="<? echo $empname; ?>">
          <input type="hidden" name="deptid" value="<? echo $deptid; ?>">
          <input type="hidden" name="startdate" value="<? echo $startdate; ?>">
          <input type="hidden" name="enddate" value="<? echo $enddate; ?>">
          <input type="submit" name="Submit" value="Approve Hours">
        </p>
        <p>&nbsp;</p>
      </form>

    </td>
  </tr>
</table>

<b>Note : Hours that you check off will be deleted from timesheet and employees will not get paid for these hours.</b><br>


<?


} //end else if number > 0


?>

<? include("footer.php"); ?>