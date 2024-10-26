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
       $query="select * from project where projectid='$projectid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
              echo "No Such Project.";

              
       }
       elseif ($number > 0) 
       {
           
           $i=0; 

              
                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables       
                  $projectid=mysql_result($result,$i,"projectid");
                  $projecttitle=mysql_result($result,$i,"projecttitle");
                  $projectdesc=mysql_result($result,$i,"projectdesc");
                  $deptid=mysql_result($result,$i,"deptid");            
                  $hoursworked=mysql_result($result,$i,"hoursworked");
                  $active=mysql_result($result,$i,"active");
                  
                  $deptname=genericget($deptid,'deptid','deptname','department');
                 
                  
      ?>
      
      
       <h3>Project Information</h3>
<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" width="187"> 
      <div align="right">Department :</div>
    </td>
    <td height="30" width="453"><b><? echo $deptname; ?></b></td>
  </tr>
  <tr> 
    <td height="30" width="187"> 
      <div align="right">Project Name :</div>
    </td>
    <td height="30" width="453"><b><? echo $projecttitle; ?></b></td>
  </tr>
  <tr> 
    <td height="30" width="187"> 
      <div align="right">Description :</div>
    </td>
    <td height="30" width="453"><b><? echo $projectdesc; ?></b></td>
  </tr>
  <tr> 
    <td height="30" width="187"> 
      <div align="right">Hours Worked on Project :</div>
    </td>
    <td height="30" width="453"><b><? echo $hoursworked; ?> hours</b></td>
  </tr>
  <tr> 
    <td height="30" width="187"> 
      <div align="right">Active :</div>
    </td>
    <td height="30" width="453"><b><? echo $active; ?></b></td>
  </tr>
</table>
      
      
      
      
      
      
      <?            

              
              
              
      } // end of elseif number>0 
        

?>

<? include("footer.php"); ?>
