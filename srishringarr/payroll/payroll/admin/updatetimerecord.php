<?
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : updatetimerecord.php
    // Description : This file updates the timesheet table with new data
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?
       
       $workdesc=addslashes($workdesc);
       $checkin=$inday1." ".$intime1;
       $checkout=$outday1." ".$outtime1;
       
             
       // Split Check in time into hours, minutes and seconds 
       list($inday,$intime)=explode(' ',$checkin); 
       list($inyear,$inmonth,$indate)=explode('-',$inday);
       list($inhour, $inminute, $inseconds) = explode(':',$intime);
   
        // Split Check out time(now) into hours, minutes and seconds 
        list($outday,$outtime)=explode(' ',$checkout);
        list($outyear,$outmonth,$outdate)=explode('-',$outday);
        list($outhour, $outminute, $outseconds) = explode(':',$outtime);


        // use Mktime to find difference in start and end times
        $starttime=mktime($inhour,$inminute,$inseconds,$inmonth,$indate,$inyear);
        $endtime=mktime($outhour,$outminute,$outseconds,$outmonth,$outdate,$outyear);

        // Amount of Time worked
        // From checkin time to checkout time
       // in seconds
       $timeworksec=$endtime- $starttime;

       // Amount of time worked in hours
       $timeworkhour=$timeworksec/3600;      
             
       // Getting First 4 digits for hours eliminating
       // Additional decimals
       $timeworkhour1 = substr($timeworkhour,0,4);



       // Rounding the time worked
       // The variable rounding is set in the constants.php file
       // If $rounding is 0, time remains same
       // 25, then it rounds to nearest quarter hour
       // 50, then it rounds to nearest half hour            
       $roundedtime=roundtime($timeworkhour,$rounding);


             
       // Amount of Time worked in Minutes
       $timeworkminute=$roundedtime*60;
             
       // Getting the first 5 digits
       $timeworkminute1 = substr($timeworkminute,0,5); 


       // If it is a timesheet edit
       if ($action=="e")
       {
                // Add New TimeSheet Employee record and save checkin time and worked done
               $queryupdateout="update timesheet set checkin='$checkin',checkout='$checkout',workdesc='$workdesc',projectid='$projectid',rawtime='$timeworkhour1',roundedtime='$roundedtime' where timeid='$timeid';";
            
              // Execute Update Query 
              $resultupdateout = MYSQL_QUERY($queryupdateout); 
           
           
              // Remove old hours from project time
              subtractprojecttime($oldproject,$oldhours);    
           
           
              // Update time for project
             // Add this time to project worked on
             updateprojecttime($projectid,$timeworkhour1);
             
        }
        // If it is a timesheet addition
        else if ($action=="a")
        {
        	
        	$workdesc="<-- Admin TIME ADD -->".$workdesc;
        	
                // Add New TimeSheet Employee record and save checkin time and worked done
               $queryinsertts="INSERT INTO timesheet (timeid, empid, projectid, checkin, checkout, rawtime, roundedtime, workdesc, ipcheckin, ipcheckout, checked) VALUES (null, '$empid', '$projectid', '$checkin', '$checkout', '$rawtime', '$roundedtime', '$workdesc', '$ipaddress', '$ipaddress', 'n')";
               
             
              // Execute Update Query 
              $resultnewsheet = MYSQL_QUERY($queryinsertts); 
           
            
           
             // Update time for project
             // Add this time to project worked on
             updateprojecttime($projectid,$timeworkhour1);
        	
        	
        }
        
        $empname=getempname($empid);
                                       
        $projecttitle=genericget($projectid,'projectid','projecttitle','project');

?>






 <h3>Time Record Updated</h3>
    <table width="640" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Employee Name :</div>
        </td>
        <td height="30" width="509"><font color="#000099"><b><? echo $empname; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check IN</font></b></div>
        </td>
        <td height="30" width="509"><font color="#000099"><b></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"> <font color="#000099"><b><? echo $inday; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> <font color="#000099"><b><? echo $intime; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509"><font color="#000099"><b></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check Out</font></b></div>
        </td>
        <td height="30" width="509"><font color="#000099"><b></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"><font color="#000099"><b><? echo $outday; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> <font color="#000099"><b><? echo $outtime; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509"><font color="#000099"><b></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">New Hours Worked :</div>
        </td>
        <td height="30" width="509"><font color="#000099"><b><font size=+1><? echo $roundedtime; ?></font></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131">&nbsp;</td>
        <td height="30" width="509"><font color="#000099"><b></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Work Done :</div>
        </td>
        <td height="30" width="509"><font color="#000099"><b><? echo $workdesc; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Project Worked :</div>
        </td>
        <td height="30" width="509"><font color="#000099"><b><? echo $projecttitle; ?></b></font></td>
      </tr>
    </table>


            
            
            



<?

include("footer.php");

?>                        