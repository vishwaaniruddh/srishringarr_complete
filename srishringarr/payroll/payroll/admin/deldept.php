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
		  
		$deptname=mysql_result($result,$i,"deptname");
                $query1="delete from department where deptid='$deptid'";
      		$result1 = MYSQL_QUERY($query1) or die("SQL Error Occured : ".mysql_error().':'.$query1); 
                $query2="delete from category where deptid='$deptid'";
      		$result2 = MYSQL_QUERY($query2) or die("SQL Error Occured : ".mysql_error().':'.$query2); 
                $query3="delete from deptevents where deptid='$deptid'";
      		$result3 = MYSQL_QUERY($query3) or die("SQL Error Occured : ".mysql_error().':'.$query3); 
                $query4="delete from project where deptid='$deptid'";
      		$result4 = MYSQL_QUERY($query4) or die("SQL Error Occured : ".mysql_error().':'.$query4); 
              

  
                  
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
        <div align="right">Has been deleted!</div>
     
    </tr>
   <tr> 
      <td height="30" width="157"> 
        <div align="right"></div>
      </td>
      <td height="30" width="483" valign="top"> 
        <p><b><i><font color="#990000">The Following Employees Will Need To Be Reasigned</font></i></b></p>
        
          
          <? printdeptemployee($deptid); ?>
          
        <p>&nbsp;</p>
      </td>
    </tr>
   
    <tr> 
      <td height="30" width="157"> 
        <div align="right"></div>
      </td>
     
    </tr>

  </table>
      
      
      
      
      
      
      
      
      
      <?            

              
              
              
      } // end of elseif number>0 
        

?>

<? include("footer.php"); ?>















