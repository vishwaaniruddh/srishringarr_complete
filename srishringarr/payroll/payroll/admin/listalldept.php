<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listdepts.php
    // Description : This file list all departments and allows user
    //               to edit, view or delete them
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

       echo "<h3>List All Departments</h3>";
        
       // Query to get list of departments
       $query="select * from department order by deptname";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<error>No Departments yet.</error>";
              echo $back;
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Department Name</td><td>View</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $deptid=mysql_result($result,$i,"deptid");
                  $deptname=mysql_result($result,$i,"deptname");
                
                  

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
                  
                  echo "<td height=\"30\"><b>$deptname</b></td>";
                  echo "<td><a href=\"viewdeptinfo.php?deptid=$deptid\">View</a></td>";
                  echo "<td><a href=\"editdepartment.php?deptid=$deptid\">Edit</a></td>";
                  echo "<td><a href=\"deldept.php?deptid=$deptid\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
         
  
      } // end else if number>0




?>

<? include("footer.php"); ?>