<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : finalizepayroll.php
    // Description : This file allows administrator to finalize payrolls
    //               making final payroll report.
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?
 
   $deptname=genericget($deptid,'deptid','deptname','department');
   
   echo "<h3>Department : $deptname </h3>";
   
                echo "<h3>PAYROLL FINALIZED</h3>";
             
             echo "<h3>DO NOT REALOAD THIS PAGE</h3>";
   
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

                 
               
                // printing payroll slips
                printpayslip($empid1,$startdate,$enddate,'f');

           
                echo "<hr>";

                $k++;
                
             }  // end while k < numberd
             
             
             
             echo "<h3>PAYROLL FINALIZED</h3>";
             
             echo "<h3>DO NOT REALOAD THIS PAGE</h3>";
             
          } // end if numberd > 0   
                
                    
?>                                      
                                
<? include("footer.php"); ?>