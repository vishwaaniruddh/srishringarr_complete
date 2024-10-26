<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : choosedept.php
    // Description : This file is a generic file to choose a department
    //               After user chooses a department, the file forwards
    //               them to $scriptname and passes the variable
    //               $deptid to use in the new script
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 


// If scriptname is not set, print error
if (!isset($scriptname))
{
	
      echo "<ul>";
       	     
      echo "<h3>Error - Scriptname not set</h3>";
  
      echo $back;
              
      echo "</ul>";

}
// if desc is not set, print error
else if (!isset($what))
{

	
      echo "<ul>";
       	     
      echo "<h3>Error - Description not set</h3>";
  
      echo $back;
              
      echo "</ul>";
	
	
}
// if everything set, proceed
else
{

    
?>

<p><b><font color=red>Please choose a department to <? echo $what; ?></b></font></p>
<br>
 <form method="post" action="<? echo $scriptname; ?>">
  <p>Department : 
  <select name=deptid>

      <? makedropdown('deptid','deptname','department') ?>
  
  </select>
  </p>
  <p> 
    <input type=hidden name=what value="<? echo $what; ?>">
    <input type=hidden name=datescript value="<? echo $datescript; ?>">
    <input type=hidden name=scriptname2 value="<? echo $scriptname2; ?>">
    <input type=hidden name=scriptname3 value="<? echo $scriptname3; ?>">
    <input type="submit" name="Submit" value="Proceed">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>

<?

} // end else

?>


<? include("footer.php"); ?>
