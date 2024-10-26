<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertdepartment.php
    // Description : This file inserts data from enternewdepartment in the database
    //               and asks user to put a search keyword for a manager for that 
    //               department
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewdepartment.php, searchdeptmanager.php, choosedeptmanager.php
    
?>


<?

       // If no project title is supplied, put a default one
       if ($ptitle=="")
       {
           $ptitle="Default Project";		
       } 
   
       // if no project description is supplied, put a default one
       if ($pdesc=="")
       {
          $pdesc="No Description";	
       }
 

       // Query to insert a new project for a department
       $queryproj = "INSERT INTO project (projectid, deptid, projecttitle, projectdesc, hoursworked, active) VALUES (null, '$deptid', '$ptitle', '$pdesc', '0', 'y')";
       $resultdept = MYSQL_QUERY($queryproj) or die("SQL Error Occured : ".mysql_error().':'.$queryproj);

       // getting Department Name
       $deptname=genericget($deptid,'deptid','deptname','department'); 
              
?>


<table border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="35"> 
      <div align="right">Department Name :</div>
    </td>
    <td><b><font color=red><? echo $deptname; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Project Title :</div>
    </td>
    <td><b><font color=red><? echo $ptitle; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Project Description :</div>
    </td>
    <td><b><font color=red><? echo $pdesc; ?></b></td>
  </tr>
</table>



<h2>Department entry is now complete</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>