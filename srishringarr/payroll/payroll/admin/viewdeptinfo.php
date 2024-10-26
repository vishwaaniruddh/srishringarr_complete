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

       // Query to get list of employees matching keyword
       $query="select * from department where deptid='$deptid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "No Such Department.";

              
       }
       elseif ($number > 0) 
       {
           
           $i=0; 

              
                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  $deptid=mysql_result($result,$i,"deptid");
                  $managerid=mysql_result($result,$i,"managerid");
                  $deptparentid=mysql_result($result,$i,"deptparentid");
                  $deptname=mysql_result($result,$i,"deptname");
                  $location=mysql_result($result,$i,"location");
                  $deptdesc=mysql_result($result,$i,"deptdesc");
                  
                  $managername=getempname($managerid);
                  
      ?>
      
      
        <h3>Deparment Information</h3>
  <table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="30" width="157"> 
        <div align="right">Department Name :</div>
      </td>
      <td height="30" width="483"><b><? echo $deptname; ?></b></td>
    </tr>
    <tr> 
      <td height="30" width="157"> 
        <div align="right">Location :</div>
      </td>
      <td height="30" width="483"><b><? echo $location; ?></b></td>
    </tr>
    <tr> 
      <td height="30" width="157"> 
        <div align="right">Manager :</div>
      </td>
      <td height="30" width="483"><b><? echo "<a href=\"viewempinfo.php?empid=$managerid\">$managername</a>"; ?></b></td>
    </tr>
    <tr> 
      <td height="30" width="157"> 
        <div align="right">Description :</div>
      </td>
      <td height="30" width="483"><b><? echo $deptdesc; ?></b></td>
    </tr>
    <tr> 
      <td height="30" width="157"> 
        <div align="right"></div>
      </td>
      <td height="30" width="483" valign="top"> 
        <p><b><i><font color="#990000">Department Employee List</font></i></b></p>
        
          
          <? printdeptemployee($deptid); ?>
          
        <p>&nbsp;</p>
      </td>
    </tr>

  </table>
      
      
      
      
      
      
      
      
      
      <?            

              
              
              
      } // end of elseif number>0 
        

?>

<? include("footer.php"); ?>
