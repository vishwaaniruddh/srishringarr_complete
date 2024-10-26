<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : chooseempcat.php
    // Description : This file is a generic file to choose an employee category
    //               It queries the empcategory table and makes a type drop down 
    //               After user chooses an emp category, the file forwards
    //               them to $scriptname and passes the variable
    //               $catid to use in the new script
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
// if everything set, proceed
else
{

    
?>

<p><b><font color=red>Please choose an Employee Category</b></font></p>
<br>
 <form method="post" action="<? echo $scriptname; ?>">
  <p>Department : 
  <select name=catid>

      <? makedropdown('catid','catname','empcategory') ?>
  
  </select>
  </p>
  <p> 
    <input type="submit" name="Submit" value="Proceed">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>

<?

} // end else

?>


<? include("footer.php"); ?>