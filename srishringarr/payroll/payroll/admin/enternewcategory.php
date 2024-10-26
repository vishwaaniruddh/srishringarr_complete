<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");
  $dtpst=date("Y-m-d H:i:s");
?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewcategory.php
    // Description : This file gets a deptid and allows user to 
    //               add a new project for a department
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : insertproject.php
    
?>


<?

// if dept id is not set, print error message
if ($deptid=="")
{
	
	      echo "<ul>";
       	     
              echo "<h3>Error - Dept ID not set</h3>";
  
              echo $back;
              
              echo "</ul>";
	
}
// if deptid is set, proceed
else
{

	
       $deptname=genericget($deptid,'deptid','deptname','department');  
       


      // Form Enter a project for this department     

?>


<h3>Please Enter a project category for <? echo $deptname; ?></b></h3>

<form method="post" action="insertcategory.php">

  <p>Please enter project category for <? echo $deptname; ?> department</p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="35" valign="top">Project Category Title :</td>
      <td valign="top"> 
        <input type="text" name="ctitle" size="40"><? echo $star; ?>
      </td>
    </tr>
    <tr> 
      <td height="35" valign="top">Category Description :</td>
      <td valign="top"> 
        <textarea name="cdesc" cols="35" rows="5" wrap="VIRTUAL"></textarea><? echo $star; ?>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=datepost value="<? echo $dt; ?>">
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="submit" name="Submit" value="Enter Category in Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  


<?

} // end else if $deptid != ""


?>



<? include("footer.php"); ?>