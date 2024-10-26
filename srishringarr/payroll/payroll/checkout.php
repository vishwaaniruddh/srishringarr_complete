<?


   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : checkout.php
    // Description : After user check out authenticates, and user selects
    //               project worked, and work description
    //               this script actually checks out user from the timesheet
    //               and calculate time worked
    // License : GPL
    // Date    : 11/11/2001
    // Related Files : precheckout.php,stopwork.php
    
?>

<?


// PRE CONDITION = REFERING SCRIPT = precheckout.php
// Checking Precondition that this page is being 
// accesed only from precheckout.php

// getting refering script path and name
$referer=getenv(http_referer);

// chopping off scriptname from path
$scriptname=substr($referer,-15,15);
if ($scriptname!="precheckout.php")
{
	
       echo "Error ! This page can only be accesed from precheckout.php";
	
}
else if ($scriptname=="precheckout.php")
{


   $error=0;
 
   // If project is not chosen
   if ($projectid=="-1")
   {

	echo "You have to choose a project. Project box cannot be left blank<br><br>";
	
	$error=1;
   }

   // If workdone field is left blank
   if ($workdone=="")
   {
        echo "Work done field cannot be left blank. You have to put a short word description of what you have done today.<br><br>";
         
        $error=1;
   }


   if ($error==1)
   {
       echo $back;
   }
   else if ($error==0)
   {
   	
   	
     // Checking if User is allowed to check in from this IP ADDRESS
     // Function checkipaddress returns 1 if address is valid
     // else it returns 0
     $goodip=checkipaddress($ipaddress,$empid); 
 
     // If IP Addres is not good, print error message
     if ($goodip==0)
     {
          echo "You cannot checkin from this location ($ipaddress). You can only checkin from valid locations. Ask your Manager which locations are valid.";	
     }  
     // If ip address is good, proceed
     else if ($goodip==1)
     {
      	 	
   	
   	  	
        // Select the user with the login and who had a checkin record but no checkout
        $querylogout = "Select * from timesheet where empid='$employeeid' and checkout='';";
        

        // Execute the Query
        $resultlogout = MYSQL_QUERY($querylogout);

        $numberlogout=MYSQL_NUMROWS($resultlogout);

        $i=0;


         // Cant find record... So use had not logged in before 
         if ($numberlogout == 0)
         {
             echo "Sorry you are not checked in. So you cannot checkout.<br>";
         }
         elseif ($numberlogout > 0)
         {

             $timeid=mysql_result($resultlogout,0,"timeid");
             $empid=mysql_result($resultlogout,0,"empid");
             $checkin=mysql_result($resultlogout,0,"checkin");
             $checkout=mysql_result($resultlogout,0,"checkout");


             // Split Check in time into hours, minutes and seconds 
             list($inday,$intime)=explode(' ',$checkin); 
             list($inyear,$inmonth,$indate)=explode('-',$inday);
             list($inhour, $inminute, $inseconds) = explode(':',$intime);
   
             // Split Check out time(now) into hours, minutes and seconds 
             list($outday,$outtime)=explode(' ',$dt);
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


             // Update Employee record and save checkin time and worked done
             $queryupdateout="update timesheet set checkout='$dt',workdesc='$workdone',projectid='$projectid',rawtime='$timeworkhour1',roundedtime='$roundedtime',ipcheckout='$ipaddress',checked='n' where timeid='$timeid';";
             
            // Execute Update Query 
            $resultupdateout = MYSQL_QUERY($queryupdateout); 
           
           
           
            // Update time for project
            // Add this time to project worked on
            updateprojecttime($projectid,$timeworkhour1);
            updatelastproject($empid,$projectid);
            
            
            $deptid=genericget($empid,'empid','deptid','employee');
            $deptname=genericget($deptid,'deptid','deptname','department');
            $empname=getempname($empid);
            $projname=genericget($projectid,'projectid','projecttitle','project');
            

            // Printing Employee Check Out Slip

?>
<center>            
<table width="550" border="1" cellspacing="0" cellpadding="0" bordercolordark="#CCCCCC" bordercolorlight="#000000">
  <tr bgcolor="#CCCCCC" valign="middle"> 
    <td height="40" colspan="2"> 
      <div align="center"><b><? echo $checkout1; ?></b></div>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF" valign="middle"> 
    <td height="40"><b><? echo $empname; ?></b></td>
    <td height="40"><b><? echo $deptname; ?></b></td>
  </tr>
  <tr bgcolor="#F4F4F4" valign="middle"> 
    <td height="40" colspan="2"><b><? echo $checkout2; ?> </b><? echo $projname; ?></td>
  </tr>
  <tr> 
    <td valign="top" width="263" height="110" bgcolor="#FFFFFF"> 
      <p><b><font color="#0000CC"><? echo $checkout3; ?></font></b></p>
      <blockquote> 
        <p><? echo $checkout4; ?><b><font color="#990033"><? echo $inday; ?></font></b></p>
        <p><? echo $checkout5; ?><b><font color="#990033"><? echo $intime; ?></font></b></p>
      </blockquote>
    </td>
    <td rowspan="2" width="237" valign="top" bgcolor="#FFFFFF"> 
      <p><b><font color="#0000CC"><? echo $checkout6; ?></font></b></p>
      <p><b><i><? echo $checkout7; ?></i></b></p>
      <blockquote> 
        <p><b><font color="#990033"><? echo $roundedtime; ?> <? echo $checkout8; ?></font></b></p>
      </blockquote>
      <p><b><i><? echo $checkout9; ?></i></b></p>
      <blockquote> 
        <p><b><font color="#990033"><? echo $timeworkminute1; ?> <? echo $checkout10; ?></font></b></p>
      </blockquote>
    </td>
  </tr>
  <tr> 
    <td valign="top" width="263" height="110" bgcolor="#FFFFFF"> <font color="#0000CC"><b><? echo $checkout11; ?></b></font> 
      <blockquote> 
        <p><? echo $checkout4; ?><b> <font color="#990033"><? echo $outday; ?></font></b></p>
        <p><? echo $checkout5; ?><b><font color="#990033"><? echo $outtime; ?></font></b></p>
      </blockquote>
    </td>
  </tr>
  <tr bgcolor="#F4F4F4"> 
    <td valign="top" colspan="2" height="110"> 
      <p><b><? echo $checkout12; ?></b></p>
      <blockquote>
        <p><i><? echo $workdone; ?></i></p>
      </blockquote>
    </td>
  </tr>
</table>
</center>
            
            
<?            
                        echo "<center>";
                        echo "<a href=\"javascript:window.close();\">$checkout13</a><br>";
                        echo "<a href=\"$siteaddress/startwork.php\">$checkout14</a><br>";
                        echo "<a href=\"login.php\">$checkout15</a><br>";
                        echo "</center>";

            

       } // end of else if numberlogout>0

     } // end of else if goodip=1
   
  } // else if error == 0

} // else if scriptname==precheckout.php

?>


<?

include("footer.php");

?>