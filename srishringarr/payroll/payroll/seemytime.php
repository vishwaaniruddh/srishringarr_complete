<?


   include("header.php"); 
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : seemytime.php
    // Description : This file takes 3 variables, $startdate, $enddate and $empid
    //               and display all hours worked for employee with employee id $empid
    //               between the dates of $startdate and $enddate
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?

          // Get Employee Name 
          $empname=getempname($session[empid]);


          echo "<b>Time Record for $empname for period starting $startdate and ending $enddate</b><br><br>";


          // Adding time to the dates
          // Starting at 00:00 on the $startdate
          $startdate=$startdate." 00:00:00";
          
          // Ending at 23:59:59 on the enddate
          $enddate=$enddate." 23:59:59";

           
          // Query to find all checkins between $startdate and $enddate 
          $query = "select * from timesheet where empid='$session[empid]' and checkin >= '$startdate' and checkout <= '$enddate' and checkout <>'' order by checkin;";
                    
          $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

          // Finding number of rows of SQL Query
          if ($result>0) { $number = MYSQL_NUMROWS($result); }
          else {$number=0;}   
 
          // If there is no timesheet record
          if ($number == 0)
          {
              echo "<ul>";
       	     
              echo "<h3>Sorry there are no Timesheet Records for $empname</h3>";
  
              echo $back;
              
              echo "</ul>";
                              
          }
          // else if there are timesheet records
          elseif ($number > 0)
          {
          	
          	$rowspan=($number*2)+1;
?>
         	
          	
<table cellspacing=0 cellpadding=0 border=0 width="640">
  <tr> 
    <td height=1 bgcolor=#444444 colspan=11><img src="images/shim.gif" height=1 width=1></td>
  </tr>
  <tr> 
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>><img src="images/shim.gif" height=1 width=1></td>
    <td width=79 height=25 bgcolor=#CCCCCC align=center><b><font color="#000000">Date</font></b></td>
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>><b><img src="images/shim.gif" height=1 width=1></b></td>
    <td width=52 height=25 bgcolor=#CCCCCC align=center><b><font color="#000000">Start</font></b></td>
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>><b><img src="images/shim.gif" height=1 width=1></b></td>
    <td width=51 height=25 bgcolor=#CCCCCC align=center><b><font color="#000000">End</font></b></td>
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>><b><img src="images/shim.gif" height=1 width=1></b></td>
    <td width=47 height=25 bgcolor=#CCCCCC align=center><b><font color="#000000">Hours</font></b></td>
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>><b><img src="images/shim.gif" height=1 width=1></b></td>
    <td width=405 height=25 bgcolor=#CCCCCC align=center><b><font color="#000000">Work Done </font></b></td>
    <td height=78 width=1 bgcolor=#444444 rowspan=<? echo $rowspan; ?>></td>
  </tr>                   
<?                             
                               $totalhours=0;
                               $i=0;
                               // Go through each record in loop
                               while ($i < $number)
                               {

                                      $q=$i+1;

                                                                
                                      // Fetching Timesheet Data and storing in local variables                       
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
    <td width=79 height=1 bgcolor=#444444><img src="images/shim.gif" width=1 height=1></td>
    <td width=52 height=1 bgcolor=#444444><img src="images/shim.gif" width=1 height=1></td>
    <td width=51 height=1 bgcolor=#444444><img src="images/shim.gif" width=1 height=1></td>
    <td width=47 height=1 bgcolor=#444444><img src="images/shim.gif" width=1 height=1></td>
    <td width=405 height=1 bgcolor=#444444><img src="images/shim.gif" width=1 height=1></td>
  </tr>
  <tr> 
    <td width=79 height=24 bgcolor=<? echo $rowbg; ?> align=center><font color="#000000"><? echo $weekday; ?></font></td>
    <td width=52 height=24 bgcolor=<? echo $rowbg; ?> align=center><font color="#000000"><? echo $intime; ?></font></td>
    <td width=51 height=24 bgcolor=<? echo $rowbg; ?> align=center><font color="#000000"><? echo $outtime; ?></font></td>
    <td width=47 height=24 bgcolor=<? echo $rowbg; ?> align=center><font color="red"><b><? echo $roundedtime; ?></b></font></td>
    <td width=405 height=24 bgcolor=<? echo $rowbg; ?> align=center><font color="blue"><? echo $workdesc; ?></font></td>
  </tr>



<?


                                  $i++;
                             
                        }  // end while i < number

?>                        
                        
  <tr> 
    <td height=1 bgcolor=#444444 colspan=11><img src="images/shim.gif" height=1 width=1></td>
  </tr>
</table>                         


<?
              echo "<br><b>Total Hours for $empname : $totalhours hours</b><br>";


                        

  
         } // end else if number >  0

?>







<? include("footer.php"); ?>
