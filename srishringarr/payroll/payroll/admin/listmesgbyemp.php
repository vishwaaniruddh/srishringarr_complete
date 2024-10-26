<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listmesgbyemp.php
    // Description : This file list all the clock in messages for a particular employee
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

   // if employee id is not set, do not proceed
   if (!isset($empid))
   {
   	
   
         echo "<h3>Error - Employee ID Not set</h3>";
         echo $back;
   	
   	
   }
   else
   {

       $empname=getempname($empid);

       echo "<h3>List All Messages for $empname</h3>";
       
        
       // Query to get list of departments
       $query="select * from messages where empid='$empid' order by dateposted desc,active";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);
       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>$empname has got no Check In Messages</h3>";
              
              echo "<a href=\"enternewempmesg.php?empid=$empid\">Add a new Clock In Message for $empname</a><br>";
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Message</td><td>Date</td><td>Active</td><td>View</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $lmid=mysql_result($result,$i,"lmid");
                  $empid=mysql_result($result,$i,"empid");
                  $dateposted=mysql_result($result,$i,"dateposted");
                  $message=mysql_result($result,$i,"message");
                  $active=mysql_result($result,$i,"active");

                 
                  $reasonlock=cuttext($message,60);
                  

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
                  
                  echo "<td height=\"30\"><b>$message</b></td>";
                  echo "<td>$dateposted</td>";
                  echo "<td><center>$active</center></td>";
                  echo "<td><a href=\"viewmesginfo.php?lmid=$lmid\">View</a></td>";
                  echo "<td><a href=\"editmesginfo.php?lmid=$lmid\">Edit</a></td>";
                  echo "<td><a href=\"delmesg.php?lockid=$lmid\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           echo "<ul>";
           echo "<a href=\"enternewempmesg.php?empid=$empid\">Add a new Clock In Message for $empname</a><br>";
           echo $back;
           echo "</ul>";
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>