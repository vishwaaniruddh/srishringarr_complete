<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : resultsearchemp.php
    // Description : This file searches for employee names matching user keyword
    //               from last page
    //               
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>


<?


// If keyword is empty, print error and dont proceed
if ($keyword=="")
{
              echo "<ul>";
       	     
              echo "<h3>Sorry there are keyword to search on. You have to put a Keyword</h3>";
  
              echo $back;
              
              echo "</ul>";	
	
	
}
// else proceed if user had put a keyword
else
{

        echo "<font size=+2><b><font color=red size=\"+2\">Student Search Results</font></b></font><br>";
 
       // If there are spaces between keyword
       // Breaking up Search Keyword into tokens
       // by the space separator 
       $tok = strtok($keyword," ");
       while ($tok) 
       {
       	      // storing each token in an array
              $kw[]=$tok;
              $tok = strtok(" ");
       }

       // Generating SQL query where part
       // This part generates a query with each token being compared
       // to the fields needed with a like %token% style
       for ($i=0;$i<count($kw);$i++)
       {
	
                $sqlsearch=$sqlsearch."((firstname like '%$kw[$i]%') or (minit like '%$kw[$i]%') or (lastname like '%$kw[$i]%') or (ssn like '%$kw[$i]%') or (email like '%$kw[$i]%') ) and ";
	
       }

       // removing the last 'and' from the end of $sqlsearch
       $sqlsearch=substr_replace($sqlsearch, '', -4, -1);


       
       // Query to get list of employees matching keyword
       $query="select * from student where $sqlsearch order by active,lastname,firstname";

       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<error>No students found matching your query.</error>";
              echo "<ul>";
              echo "<li><h2><a href=\"searchstudent.php\">Search Again</a></h2>";
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr><td height=30><font color=\"#003399\"><b>Last Name</b></font></td><td><font color=\"#003399\"><b>First name</b></font></td><td><font color=\"#003399\"><b>Email</b></font></td><td><font color=\"#003399\"><b>Active</b></font></td><td><font color=\"#003399\"></font></td><td><font color=\"#003399\"></font></td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $empid=mysql_result($result,$i,"stid");
                  $lastname=mysql_result($result,$i,"lastname");
                  $firstname=mysql_result($result,$i,"firstname");
                  $minit=mysql_result($result,$i,"minit");
                 // $jobid=mysql_result($result,$i,"jobid");
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
                  echo "<td><b><a href=\"viewstuinfo.php?stid=$empid\">View Details</a></b></td>";
                  echo "<td><b><a href=\"editstuinfo.php?stid=$empid\">Edit Details</a></b></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
           echo "<b><br><a href=\"searchstudent.php\">Make Another Search</a><br></b>";
           echo "<br>";

  
      } // end else if number>0

  } // end of else keyword != ""
 

?>

<? include("footer.php"); ?>