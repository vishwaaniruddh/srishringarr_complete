<?

   $se=n;
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : editimerecord.php
    // Description : This file displays allows admin to edit one time record with $timeid
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enterdates.php,edittimerecord.php
    
?>

<?



 


           
          // Query to find all checkins between $startdate and $enddate 
          $query = "select * from timesheet where timeid='$timeid'";
                      
                    
          $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

          // Finding number of rows of SQL Query
          if ($result>0) { $number = MYSQL_NUMROWS($result); }
          else {$number=0;}   
 
          // If there is no timesheet record
          if ($number == 0)
          {
              echo "<ul>";
       	     
              echo "<h3>Sorry this time record does not exist</h3>";
  
              echo $back;
              
              echo "</ul>";
                              
          }
          // else if there are timesheet records
          elseif ($number > 0)
          {
          	
                               
                               $i=0;
                               
                                                                
                                      // Fetching Timesheet Data and storing in local variables 
                                      $timeid = mysql_result($result,$i,"timeid");                      
                                      $empid = mysql_result($result,$i,"empid");
                                      $roundedtime= mysql_result($result,$i,"roundedtime");
                                      $workdesc = mysql_result($result,$i,"workdesc");
                                      $projectid1 = mysql_result($result,$i,"projectid");
                                      
                                      $checkin = mysql_result($result,$i,"checkin");
                                      $checkout = mysql_result($result,$i,"checkout");
                                   

                                      // breaking DateTime records into date and time
                                      list($inday,$intime)=explode(' ',$checkin);
                                      list($outday,$outtime)=explode(' ',$checkout);

                                      
                                      
                                      
                                      $intime=substr($intime,0,5);
                                      $outtime=substr($outtime,0,5);
                                      
                                      
                                       // Get Employee Name 
                                       $empname=getempname($empid);
                                       
                                       $projecttitle=genericget($projectid1,'projectid','projecttitle','project');
                                       $deptid=genericget($empid,'empid','deptid','employee');
?>



<h3>Edit Time Record</h3>
  <form method="post" action="updatetimerecord.php">
    <table width="640" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Employee Name :</div>
        </td>
        <td height="30" width="509"><font color="#003399"><b><? echo $empname; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check IN</font></b></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="inday1" size="16" value="<? echo $inday; ?>">
          <b><i> (YYYY-MM-DD) </i></b></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="intime1" size="16" value="<? echo $intime; ?>">
          <b><i> (hh:mm:ss) </i></b></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check Out</font></b></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="outday1" size="16" value="<? echo $outday; ?>">
          <b><i> (YYYY-MM-DD)</i></b> </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="outtime1" size="16" value="<? echo $outtime; ?>">
          <b><i> (hh:mm:ss) </i></b> </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Hours Worked :</div>
        </td>
        <td height="30" width="509"><b><font color=red><? echo $roundedtime; ?></font></b> <i>(this will be updated after time change)</i></td>
      </tr>
      <tr> 
        <td height="30" width="131">&nbsp;</td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Work Done :</div>
        </td>
        <td height="30" width="509"> 
          <textarea name="workdesc" cols="30" rows="4" wrap="VIRTUAL"><? echo $workdesc; ?></textarea>
        </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Project Worked :</div>
        </td>
        <td height="30" width="509">
        
                     <? 
                     echo "<select name=\"projectid\">\n";
                     echo "<option selected value=\"$projectid1\">$projecttitle</option>";
                     projectdropdown($deptid);
              
                     echo "</select>\n";
             ?>
         </td>
      </tr>
    </table>
    <p>
      <input type=hidden name=oldproject value="<? echo $projectid1; ?>">
      <input type=hidden name=oldhours value="<? echo $roundedtime; ?>">
      <input type=hidden name=timeid value="<? echo $timeid; ?>">
      <input type=hidden name=empid value="<? echo $empid; ?>">
      <input type=hidden name=action value=e>
      <input type="submit" name="Submit" value="Update Time Sheet Record">
    </p>
  </form>










<?


  
         } // end else if number >  0

?>





<? include("footer.php"); ?>