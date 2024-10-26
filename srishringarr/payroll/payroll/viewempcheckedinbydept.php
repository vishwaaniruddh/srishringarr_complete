<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : viewempcheckedin.php
    // Description : This file displays all the checked in Employees
    //               and the department they are in and the time
    //               they have checked in
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?
     

        $deptname=genericget($session[deptid],'deptid','deptname','department');
      	
      	$query = "select t.empid,checkin,checkout from timesheet t,employee e where checkout='' and t.empid=e.empid and e.deptid='$session[deptid]' order by checkin;";
      	
     	
       $result = MYSQL_QUERY($query);  

       if ($result>0) { $number = MYSQL_NUMROWS($result);}                       
       else {$number=0;}               
            
       $i = 0;

       if ($number == 0)
       {
               echo "<h2>No-one Checked in $deptname !<h2>";
       }
       elseif ($number > 0)
       {
    
          $i=0;
          echo "<b>List of all Checked In $deptname Employees</b><br>";
          echo "<table>";
          
          while ($i < $number)
          {

                                    
                   $empid = mysql_result($result,$i,"empid");
                   $checkin= mysql_result($result,$i,"checkin");
                   $checkout= mysql_result($result,$i,"checkout");
                   


                   list($inday,$intime)=explode(' ',$checkin);
                   
                   $empname=getempname($empid);

                   echo "<tr height=20>\n";
                   echo "<td>$empname</td>\n";
                   echo "<td>$intime</td>\n";
                   echo "</tr>\n";   

                   $i++;
                   
          } // end while


          echo "</table>";

       } // end of else if number > 0

?>

<? include("footer.php"); ?>