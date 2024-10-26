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
if ($ctitle=="")
{

      echo "<ul>";
       	     
      echo "<h3>Error - Category Title not set</h3>";
  
      echo $back;
              
      echo "</ul>";	

} 
// if no project description is supplied, put a default one
elseif ($cdesc=="")
{
      echo "<ul>";
       	     
      echo "<h3>Error - Project Category Description  set</h3>";
  
      echo $back;
              
      echo "</ul>";	

}
// if everything filled, then insert project
else
{
	
 

       // Query to insert a new project
       $querycat = "INSERT INTO category (deptid, name, categorydesc) VALUES ('$deptid', '$ctitle', '$cdesc')";
       //for debug
       //echo $querycat;
       $resultdept = MYSQL_QUERY($querycat) or die("SQL Error Occured : ".mysql_error().':'.$queryproj);

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
      <div align="right">Project Category Title :</div>
    </td>
    <td><b><font color=red><? echo $ctitle; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Project Category Description :</div>
    </td>
    <td><b><font color=red><? echo $cdesc; ?></b></td>
  </tr>
</table>



<h2>Project Category has been Inserted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>

<?


}

?>

<? include("footer.php"); ?>