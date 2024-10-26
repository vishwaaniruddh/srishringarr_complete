<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listipaddbydept.php
    // Description : This file list all ipaddress blocks (bans) from one dept
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

   // if department if is not set, do not proceed
   if (!isset($empid))
   {
   	
   
         echo "<h3>Error - Employee ID Not set</h3>";
         echo $back;
   	
   	
   }
   else
   {

       $empname=getempname($empid);

       echo "<h3>List All IPADDRESS Restrictions for Employee $empname</h3>";
        
        
       // Query to get list of departments
       $query="select * from iptable where linkid='$empid' and type='e' order by ipaddress";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>No IP Address Restriction for this Employee yet</h3>";
              
              echo "<a href=\"enternewipadd.php?linkid=$deptid&type=d\">Add a New IP address restriction for the department of $deptname</a><br>";
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>IP Address</td><td>Edit</td><td>Delete</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $ipid=mysql_result($result,$i,"ipid");
                  $ipaddress=mysql_result($result,$i,"ipaddress");
                  

                  

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
                  
                  echo "<td height=\"30\"><b>$ipaddress</b></td>";
                  echo "<td><a href=\"editipaddress.php?ipid=$ipid\">Edit</a></td>";
                  echo "<td><a href=\"delip.php?ipid=$ipid\">Delete</a></td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           
         
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>