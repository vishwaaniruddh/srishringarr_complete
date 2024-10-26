<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : employeesproject.php
    // Description : This file searches lists all employees who have worked on a project
    //               
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>


<?


// If projectid is empty, print error and dont proceed
if ($projectid=="")
{
              echo "<ul>";
       	     
              echo "<h3>Sorry.. need to specify a project ID</h3>";
  
              echo $back;
              
              echo "</ul>";	
	
	
}
// else proceed if user had put a projectid
else
{

       $projectname=genericget($projectid,'projectid','projecttitle','project');
       


        echo "<h3>List of Employees having worked on $projectname</h3>";
 
       
       // Query to get list of employees matching keyword
       $query="select * from timesheet where projectid='$projectid' order by checkin,checkout";

       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<h3>No employees have worked on $projectname.</h3>";

              
       }
       elseif ($number > 0) 
       {
       
          
           
           
           
       
       
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr><td height=30><font color=\"#003399\"><b>Employee</b></font></td><td><font color=\"#003399\"><b>Date</b></font></td><td><font color=\"#003399\"><b>Time</b></font></td><td><font color=\"#003399\"><b>Description</b></font></td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $timeid=mysql_result($result,$i,"timeid");
                  $empid=mysql_result($result,$i,"empid");
                  $checkin=mysql_result($result,$i,"checkin");
                  $checkout=mysql_result($result,$i,"checkout");
                  $roundedtime=mysql_result($result,$i,"roundedtime");
                  $workdesc=mysql_result($result,$i,"workdesc");
                  $ipcheckin=mysql_result($result,$i,"ipcheckin");
                  
                  $empname=getempname($empid);
                 
                  list($inday,$intime)=explode(' ',$checkin); 
                 

                  // making every other alternate row
                  // of a different color
                  $k=$i/2;
                  $k=substr($k,-1,1);
                  
                  // if row is odd, then make row background grey
                  if ($k=="5")
                  {
                  
                      echo "<tr bgcolor=\"#EBEBEB\">"; 	
                  	
                  }
                  else
                  {
                       echo "<tr>";
                  }
                  
                  echo "<td height=\"30\"><b><a href=\"viewempinfo.php?empid=$empid\">$empname</a></b></td>";
                  echo "<td>$inday</td>";
                  echo "<td>$roundedtime</td>";
                  echo "<td><b>$workdesc</td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           

  
      } // end else if number>0

  } // end of else keyword != ""
 

?>

<? include("footer.php"); ?>