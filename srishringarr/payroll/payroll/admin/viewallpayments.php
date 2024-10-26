<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listempbytype.php
    // Description : This file searches for employees of type $typeid
    //               and displays them
    //               
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>


<?




        echo "<h3>List of ALL Payments</h3>";
 
        
       // Query to get list of employees matching keyword
       $query="select * from fees order by paydate";

       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<error>No Fees details yet !</error>";
              echo "<ul>";
              echo "<li><h2><a href=\"index.php\">Go To main page</a></h2>";
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr><td height=30><font color=\"#003399\"><b>Last Name</b></font></td><td><font color=\"#003399\"><b>First name</b></font></td><td><font color=\"#003399\"><b>Date</b></font></td><td><font color=\"#003399\"><b>Amount</b></font></td><td><font color=\"#003399\"><b>Department</b></font></td><td><font color=\"#003399\"></font></td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $stid=mysql_result($result,$i,"stid");
                  $query1="select * from student where stid='$stid'";

                  $result1 = MYSQL_QUERY($query1) or die("SQL Error Occured : ".mysql_error().':'.$query1); 
               
                  $lastname=mysql_result($result1,0,"lastname");
                  $firstname=mysql_result($result1,0,"firstname");
                  $deptid=mysql_result($result1,0,"deptid");
                  $minit=mysql_result($result1,0,"minit");
                  $bid=mysql_result($result,$i,"bid");
                  $amt=mysql_result($result,$i,"amount");
                  $pdate=mysql_result($result,$i,"paydate");
                  //$active=mysql_result($result,$i,"active");

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
                  
                  echo "<td height=\"30\"><b>$lastname</b></td>";
                  echo "<td>$firstname $minit</td>";
                  echo "<td>$pdate</td>";
                  echo "<td>$amt</td>";
                  echo "<td><b>$deptname</b></td><td><a href='printbill.php?bid=$bid' >print bill</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
           echo "<b><br><a href=\"index.php\">Back to Admin Index</a><br></b>";
           echo "<br>";

  
      } // end else if number>0

 

?>

<? include("footer.php"); ?>