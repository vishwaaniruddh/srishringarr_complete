<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : pregeneratepayroll.php
    // Description : This file allows administrator to check times before 
    //               making final payroll report.
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?
 
   $deptname=genericget($deptid,'deptid','deptname','department');
   
   echo "<h3>Department : $deptname </h3>";
   
    // Query to get list of all employees in one department
       $queryd="select empid from employee where deptid='$deptid' and active='y' order by lastname,firstname";

       $resultd = MYSQL_QUERY($queryd);
       $numberd = MYSQL_NUMROWS($resultd);

       $k = 0;
                
       // if query is empty                        
       if ($numberd == 0)
       {  
       	      echo "<ul>";
       	     
              echo "<h3>No Employees in this Department yet</h3>";
             
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($numberd > 0) 
       {
?>       	
       	
            <table width="472" border="1" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="34" width="258"> 
      <div align="center"><b>Employee Name</b></div>
    </td>
    <td height="34" width="80"> 
      <div align="center"><b>Hours Worked</b></div>
    </td>
    <td height="34" width="66"> 
      <div align="center"><b>Approved Hours</b></div>
    </td>
    <td height="34" width="36"> 
      <div align="center"><b>A</b></div>
    </td>
    <td height="34" width="32"> 
      <div align="center"><b>V</b></div>
    </td>
  </tr>
            
            
  <?          

              // For each result row, get data values 
              WHILE ($k < $numberd)
              {
              
                // Retreiving data from each row of the sql query result 
                // and putting them in local variables                   
                $empid1=mysql_result($resultd,$k,"empid");
                  
                $empname=getempname($empid1);
   
                // Adding time to the dates
                // Starting at 00:00 on the $startdate
                $startdate1=$startdate." 00:00:00";
          
                // Ending at 23:59:59 on the enddate
                $enddate1=$enddate." 23:59:59";



           
                // Query to find all checkins between $startdate and $enddate 
               $query = "select timeid,roundedtime,checked from timesheet where empid='$empid1' and checkin >= '$startdate1' and checkout <= '$enddate1' order by checkin;";
                    
               $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

               // Finding number of rows of SQL Query
               if ($result>0) { $number = MYSQL_NUMROWS($result); }
               else {$number=0;}   
 
               // If there is no timesheet record
               if ($number == 0)
               {
                   $timeworked=0;
                   $approvehours=0;
                      
?>

  <tr bgcolor="<? echo $bgcolor; ?>"> 
    <td height="34" width="258"> 
      <div align="right"><b><? echo $empname; ?></b></div>
    </td>
    <td height="34" width="80"> 
      <div align="center">0</div>
    </td>
    <td height="34" width="66"> 
      <div align="center">0</div>
    </td>
    <td height="34" width="36"><font size="-2">&nbsp;</font></td>
    <td height="34" width="32"><font size="-2">&nbsp;</font></td>
  </tr>




<?                   
                          
                   
                   
                                           
               }
               // else if there are timesheet records
               elseif ($number > 0)
               {
                     $totalhours=0;
                     $approvehours=0;
                     $i=0;
                               
                     // Go through each record in loop
                     while ($i < $number)
                     {

                                                                                                  
                                      // Fetching Timesheet Data and storing in local variables  
                                      $timeid = mysql_result($result,$i,"timeid");                     
                                      $roundedtime= mysql_result($result,$i,"roundedtime");
                                      $checked= mysql_result($result,$i,"checked");
                                      
                                      
                                   
                                      if ($checked=='y')
                                      {
                                      	
                                      	   $approvehours=$approvehours+$roundedtime;
                                      } 
                                   
                                      // Calculating Total Hours
                                      $totalhours=$totalhours+$roundedtime; 


                                    $i++;
                                    
                    } // end while i < number
                    
  ?>                  
       <tr bgcolor="<? echo $bgcolor; ?>"> 
    <td height="34" width="258"> 
      <div align="right"><b><? echo $empname; ?></b></div>
    </td>
    <td height="34" width="80"> 
      <div align="center"><? echo $totalhours; ?></div>
    </td>
    <td height="34" width="66">    
      <div align="center">
      
      <? 
         
         if ($approvehours!=$totalhours)
         {
             echo "<font color=red><b>";
         } 
        
         echo $approvehours; 
         
      ?>
         
         </div>
    </td>
    <td height="34" width="36"><font size="-2"><a href="<? echo "viewpayslip.php?empid=$empid1&startdate=$startdate&enddate=$enddate"; ?>">View</a></font></td>
    <td height="34" width="32"><font size="-2"><a href="<? echo "$siteaddress/admin/checktimesheet.php?empid=$empid1&what=Check%20Timesheets%20&startdate=$startdate&enddate=$enddate&deptid=$deptid"; ?>">Approve</a></font></td>
  </tr>
     
<?     
                    
                    
                    
                } // end if number >0
                
               $k++;  
               
                  // making every other alternate row
                  // of a different color
                  $p=$k/2;
                  $p=substr($p,-1,1);
                  
                  
                  // if row is odd, then make row background grey
                  if ($p=="5")
                  {
                  
                      $bgcolor="#EBEBEB"; 	
                  	
                  }
                  else
                  {
                       $bgcolor="white";
                  }
               
                
             }  // end while k < numberd
             
             
             echo "</table>";
             
             echo "<h3>Check and make sure that all the above hours are correct and then Click on Finalize Payroll Below</h3>";
             
             echo "<h3><a href=\"$siteaddress/admin/finalizepayroll.php?deptid=$deptid&startdate=$startdate&enddate=$enddate\">Finalize Payroll and Print ALL PAYSLIPS</a></h3>";
             
          } // end if numberd > 0   
                
                    
?>                                      
                                
<? include("footer.php"); ?>