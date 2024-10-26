<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listdeptemphours.php
    // Description : This file displays total hours worked by departmental employees
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

   // if department if is not set, do not proceed
   if (!isset($deptid))
   {
   	
   
         echo "<h3>Error - Department ID Not set</h3>";
         echo $back;
   	
   	
   }
   else
   {

       $deptname=genericget($deptid,'deptid','deptname','department');

       echo "<h3>List All Employees in $deptname</h3>";
        
        
       // Query to get list of departments
       $query="select * from employee where deptid='$deptid' order by active,lastname,firstname";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	      echo "<ul>";
       	     
              echo "<h3>No Employees in this Department yet</h3>";
              
              echo "<a href=\"enternewemployee1.php?deptid=$deptid\">Add a New Employee in the department of $deptname</a><br>";
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td> Employee Name</td><td>Active</td><td>Email</td><td>View</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $empid=mysql_result($result,$i,"deptid");
                  $lastname=mysql_result($result,$i,"lastname");
                  $firstname=mysql_result($result,$i,"firstname");
                  $minit=mysql_result($result,$i,"minit");
                  $email=mysql_result($result,$i,"email");
                  $active=mysql_result($result,$i,"active");
                  

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
                  
                  echo "<td height=\"30\"><b>$lastname, $firstname $minit</b></td>";
                  echo "<td height=\"30\"><b>$active</b></td>";
                  echo "<td height=\"30\"><b>$email</b></td>";
                  echo "<td><a href=\"viewempinfo.php?empid=$empid\">View</a></td>";
                  echo "<td><a href=\"editempinfo.php?empid=$empid\">Edit</a></td>";
                  echo "<td><a href=\"delemp.php?deptid=$empid\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
         
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>