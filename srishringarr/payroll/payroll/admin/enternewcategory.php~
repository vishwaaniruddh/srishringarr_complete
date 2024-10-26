<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");
  $dtpst=date("Y-m-d H:i:s");
?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewproject.php
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


<h3>Please Enter a project for <? echo $deptname; ?></b></h3>

<form method="post" action="insertproject.php">

  <p>Please enter project for <? echo $deptname; ?> department</p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="35" valign="top">Project Title :</td>
      <td valign="top"> 
        <input type="text" name="ptitle" size="40"><? echo $star; ?>
      </td>
    </tr>
    <tr> 
      <td height="35" valign="top">Project Description :</td>
      <td valign="top"> 
        <textarea name="pdesc" cols="35" rows="5" wrap="VIRTUAL"></textarea><? echo $star; ?>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=datepost value="<? echo $dt; ?>">
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="submit" name="Submit" value="Enter Project in Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  


<?

} // end else if $deptid != ""


?>



<? include("footer.php"); ?>