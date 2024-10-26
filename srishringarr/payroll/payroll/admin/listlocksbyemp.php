<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listlocksbyemp.php
    // Description : This file list all the locks on a particular employee
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

      if ($action=="del")
      {
      	
      	  $queryl="update locks set active='n' where lockid='$lockid'";
      	  $resultl = MYSQL_QUERY($queryl);
      	
      	
      }


       $empname=getempname($empid);

       echo "<h3>List All Locks for $empname</h3>";
        
        
       // Query to get list of departments
       $query="select * from locks where empid='$empid' and active='y' order by datelock desc,active";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>$empname has got no Check In Lock</h3>";
              

              
              
              echo "<a href=\"enteremplock.php?empid=$empid&deptid=$deptid\">Add an Clock Lock for $empname</a><br>";
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Reason Lock</td><td>Date</td><td>Active</td><td>View</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $lockid=mysql_result($result,$i,"lockid");
                  $empid=mysql_result($result,$i,"empid");
                  $datelock=mysql_result($result,$i,"datelock");
                  $reasonlock=mysql_result($result,$i,"reasonlock");
                  $active=mysql_result($result,$i,"active");

                 
                  $reasonlock=cuttext($reasonlock,60);
                  

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
                  
                  echo "<td height=\"30\"><b>$reasonlock</b></td>";
                  echo "<td>$datelock</td>";
                  echo "<td><center>$active</center></td>";
                  echo "<td><a href=\"viewlockinfo.php?lockid=$lockid\">View</a></td>";
                  echo "<td><a href=\"editlockinfo.php?lockid=$lockid\">Edit</a></td>";
                  echo "<td><a href=\"listlocksbyemp.php?lockid=$lockid&empid=$empid&action=del\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
         
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>