<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listempbycat.php
    // Description : This file searches for employees of category $catid
    //               and displays them
    //               
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>


<?


// If keyword is empty, print error and dont proceed
if ($catid=="")
{
              echo "<ul>";
       	     
              echo "<h3>Error - Sorry Category ID Not set !</h3>";
  
              echo $back;
              
              echo "</ul>";	
	
	
}
// else proceed if user had put a keyword
else
{

        $empcat=genericget($catid,'catid','catname','empcategory');

        echo "<font size=+2><b><font color=red size=\"+2\">List of all Employees of Category <font color=green>'$empcat'</font></font></b></font><br>";
 
        
       // Query to get list of employees matching keyword
       $query="select * from employee where catid='$catid' order by active,lastname,firstname";

       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<error>No employees of Category $empcat yet !</error>";
              echo "<ul>";
              echo "<li><h2><a href=\"index.php\">Back To Admin</a></h2>";
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr><td height=30><font color=\"#003399\"><b>Last Name</b></font></td><td><font color=\"#003399\"><b>First name</b></font></td><td><font color=\"#003399\"><b>Email</b></font></td><td><font color=\"#003399\"><b>Active</b></font></td><td><font color=\"#003399\"></font></td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $empid=mysql_result($result,$i,"empid");
                  $lastname=mysql_result($result,$i,"lastname");
                  $firstname=mysql_result($result,$i,"firstname");
                  $minit=mysql_result($result,$i,"minit");
                  $jobid=mysql_result($result,$i,"jobid");
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
                  
                  echo "<td height=\"30\"><b>$lastname</b></td>";
                  echo "<td>$firstname $minit</td>";
                  echo "<td>$email</td>";
                  echo "<td><b>$active</td>";
                  echo "<td><b><a href=\"viewempinfo.php?empid=$empid\">View Details</a></b></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
           echo "<b><br><a href=\"index.php\">Back to Admin Index</a><br></b>";
           echo "<br>";

  
      } // end else if number>0

  } // end of else catid != ""
 

?>

<? include("footer.php"); ?>