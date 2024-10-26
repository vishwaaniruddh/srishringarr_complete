<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listprojectbydept.php
    // Description : This file list all projects from one dept
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?


       echo "<h3>List All Active Projects</h3>";
       
       // Query to get list of departments
       $query="select * from project where active='y' order by projecttitle";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>Sorry, Query Returned No Results. Try Again</h3>";
             
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Project Name</td><td>Department</td><td>Hours</td><td>Employees</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $projectid=mysql_result($result,$i,"projectid");
                  $projecttitle=mysql_result($result,$i,"projecttitle");
                  $hoursworked=mysql_result($result,$i,"hoursworked");
                  $activepro=mysql_result($result,$i,"active");
                  $deptid=mysql_result($result,$i,"deptid");
 
                  $deptname=genericget($deptid,'deptid','deptname','department');

                  

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
                  
                  echo "<td height=\"30\"><b><a href=\"$siteaddress/admin/viewprojectinfo.php?projectid=$projectid\">$projecttitle</a></b></td>";
                  echo "<td height=\"30\"><b>$deptname</b></td>";
                  echo "<td height=\"30\"><b>$hoursworked</b></td>";
                  echo "<td><b><a href=\"$siteaddress/admin/employeesproject.php?projectid=$projectid\">Employees on it</a></b></td>";
     
                
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
          
  
      } // end else if number>0



?>

<? include("footer.php"); ?>