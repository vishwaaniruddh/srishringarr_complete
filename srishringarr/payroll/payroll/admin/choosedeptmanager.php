<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : choosedeptmanager.php
    // Description : This file gets a empid and a deptid from searchdeptmanager.php
    //               and then updates the department with deptid with new manager 
    //               with empid
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewdepartment.php, searchdeptmanager.php, insertdepartment.php
    
?>


<?


// If deptid and employee id are set
// then update department tbale with the new manager
if (($deptid!="") and ($empid!=""))
{
	
	
       $empname=getempname($empid);
       $deptname=genericget($deptid,'deptid','deptname','department');       
       	 	
       $querydept = "update department set managerid='$empid' where deptid='$deptid'";	
       $resultdept = MYSQL_QUERY($querydept) or die("SQL Error Occured : ".mysql_error().':'.$querydept);
       
       echo "<table border=0 cellspacing=0 cellpadding=0>";
       echo "<tr><td height=35><div align=right>Department Name :</div></td><td><b><font color=red>$deptname</b></td></tr>";
       echo "<tr><td height=35><div align=right>Manager :</div></td><td><b><font color=red>$empname</b></td></tr>";
       echo "</table>";
       
       echo "<br>Department has been updated with New Manager<br><br>";
       
       
}
else
{
	
       $deptname=genericget($deptid,'deptid','deptname','department');  
       echo "<h3>You have not chosen a manager for $deptname. Please do so as soon as possible. </h3>";
	
	
}


// Enter a project for this department     
?>


<h3>Please Enter a project for <? echo $deptname; ?></b></h3>

<form method="post" action="insertdeptproject.php">

  <p>There need to be at least one project for this department, so that employees can check 
    in for work on the project.If you dont put any projects, the program will 
    set a Default project for this department. You can then modify it at a later 
    time. </p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="35" valign="top">Project Title :</td>
      <td valign="top"> 
        <input type="text" name="ptitle" size="40">
      </td>
    </tr>
    <tr> 
      <td height="35" valign="top">Project Description :</td>
      <td valign="top"> 
        <textarea name="pdesc" cols="35" rows="5" wrap="VIRTUAL"></textarea>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="submit" name="Submit" value="Enter Project in Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  






<? include("footer.php"); ?>