<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : searchdeptmanager.php
    // Description : This file searches for employee names matching user keyword
    //               from last page
    //               
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewdepartment.php, insertdepartment.php, choosedeptmanager.php
    
?>


<?

// If user decides to search again
if ($search=="y")
{
?>
	
<h3>Select a Manager for the department of <? echo $deptname; ?></b></h3>

<form name="form1" method="post" action="searchdeptmanager.php">

  <p>Please put the name of the manager in the textbox below and the program will 
    search the database for names matching ur entry. The program will locate employees whose name match your query.</p>
  <p>Manager Name (Keyword) : 
    <input type="text" name="keyword">
  </p>
  <p>
  
    <input type="hidden" name=deptname value="<? echo $deptname; ?>">
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="submit" name="Submit" value="Search Database for Manager">
  </p>
</form>

  <p>You can add a manager at a later time for this department if you wish to. 
    Just press the Search Button without anything if you dont wish to select a 
    manager now.</p>

<?	
	
}
else
{


        echo "<font size=+2>Please choose a manager for the department of <b><font color=red size=\"+2\">$deptname</font></b></font><br>";
 
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
	
                $sqlsearch=$sqlsearch."((firstname like '%$kw[$i]%') or (minit like '%$kw[$i]%') or (lastname like '%$kw[$i]%')) and ";
	
       }

       // removing the last and from the end of $sqlsearch
       $sqlsearch=substr_replace($sqlsearch, '', -4, -1);

       
       // Query to get list of employees matching keyword
       $query="select * from employee where $sqlsearch and active='y' order by lastname,firstname";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "<error>No employees found matching your query.</error>";
              echo "<ul>";
              echo "<li><h2><a href=\"searchdeptmanager.php?deptname=$deptname&deptid=$deptid&search=y\">Search Again</a></h2>";
              echo "<li><h2><a href=\"choosedeptmanager.php?deptid=$deptid\">SKIP this step for now. Add Manager at a later day</a></h2>";
              echo "<li>Add a new Employee (in new window) and then search again</li>"; 
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr><td height=30><font color=\"#003399\"><b>Last Name</b></font></td><td><font color=\"#003399\"><b>First name</b></font></td><td><font color=\"#003399\"><b>Email</b></font></td><td><font color=\"#003399\"></font></td></tr>";

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
                  echo "<td><b><a href=\"choosedeptmanager.php?deptid=$deptid&empid=$empid\">Make Manager</a></b></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
           echo "<b><br><a href=\"searchdeptmanager.php?deptname=$deptname&deptid=$deptid&search=y\">Cant find the one you were looking for? Make Another Search</a><br></b>";
           echo "<br><a href=\"choosedeptmanager.php?deptid=$deptid\">SKIP this step for now. Add Manager at a later day</a></b><br>";
           echo "Add a new Employee (in new window) and then search again"; 
  
      } // end else if number>0


} // end of else search == y

?>

<? include("footer.php"); ?>