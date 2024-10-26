<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertproject.php
    // Description : This file inserts a new project in project table
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewproject.php
    
?>
<?/*
	var_dump($dt); */
	?>

<?

// If no project title is supplied, print error
if ($ptitle=="")
{

      echo "<ul>";
       	     
      echo "<h3>Error - Project Title not set</h3>";
  
      echo $back;
              
      echo "</ul>";	

} 
// if no project description is supplied, put a default one
elseif ($pdesc=="")
{
      echo "<ul>";
       	     
      echo "<h3>Error - Project Description  set</h3>";
  
      echo $back;
              
      echo "</ul>";	

}
// if everything filled, then insert project
else
{
	
 

       // Query to insert a new project
       $queryproj = "INSERT INTO project (projectid, deptid, projecttitle, projectdesc, dateposted, hoursworked, active) VALUES (null, '$deptid', '$ptitle', '$pdesc', '$dt', '0', 'y')";
       //for debug
       //echo $queryproj;
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



<h2>Project has been Inserted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>

<?


}

?>

<? include("footer.php"); ?>