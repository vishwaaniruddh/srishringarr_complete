<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listeventsbydept.php
    // Description : This file list all events for a department
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

       echo "<h3>List All Events for $deptname</h3>";
        
        
       // Query to get list of departments
       $query="select * from deptevents where deptid='$deptid' order by dateposted desc,eventbody,active";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>No Events for this Department yet</h3>";
              
              echo "<a href=\"enterdeptevent.php?deptid=$deptid\">Add a New Event for the department of $deptname</a><br>";
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Event Name</td><td>Date</td><td>Active</td><td>View</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $eventid=mysql_result($result,$i,"eventid");
                  $eventdate=mysql_result($result,$i,"eventdate");
                  $active=mysql_result($result,$i,"active");
                  $eventbody=mysql_result($result,$i,"eventbody");
                 

                  

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
                  
                  echo "<td height=\"30\"><b>$eventbody</b></td>";
                  echo "<td>$eventdate</td>";
                  echo "<td>$active</td>";
                  echo "<td><a href=\"vieweventinfo.php?eventid=$eventid\">View</a></td>";
                  echo "<td><a href=\"editeventinfo.php?eventid=$eventid\">Edit</a></td>";
                  echo "<td><a href=\"delevent.php?eventidid=$eventid\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
         
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>












