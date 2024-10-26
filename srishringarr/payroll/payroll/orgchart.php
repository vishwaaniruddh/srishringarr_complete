<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : orgchart.php
    // Description : This file displays a graphical interface for an 
    //               organizational chart for the company
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

      echo "<h3>Organizational Chart</h3>";

       // Query to get list of employees matching keyword
       $query="select * from department where deptparentid='-1'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "No Departments yet.";

              
       }
       elseif ($number > 0) 
       {
            
              echo "<table>";
              echo "<tr>";
        
              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  $deptid=mysql_result($result,$i,"deptid");
                  $managerid=mysql_result($result,$i,"managerid");
                  $deptparentid=mysql_result($result,$i,"deptparentid");
                  $deptname=mysql_result($result,$i,"deptname");
                  $location=mysql_result($result,$i,"location");
                  
                  echo "<td valign=top>";
                  
                  
                    echo "<table width=100 border=1 cellspacing=0 cellpadding=0 align=center bordercolordark=#000000 bordercolorlight=#000000 bordercolor=#000000>";
                    echo "<tr><td height=80>";
                    echo "<font color=#003399><b><center>$deptname</center></b>";
                    echo "<br><div align=right><a href=\"viewdeptinfo.php?deptid=$deptid\"><img src=\"$siteaddress/images/info.gif\" alt=\"View Department Information\" width=\"17\" height=\"17\" border=0></a></div>";
        
                    echo "</td></tr></table>";

                  
                  findchild($deptid);
                  
                  echo "</td>";
                  
                  $i++;
              } // end of while i < number
              
              
              echo "</tr>";
              echo "</table>";
              
      } // end of elseif number>0 
        

?>

<? include("footer.php"); ?>
