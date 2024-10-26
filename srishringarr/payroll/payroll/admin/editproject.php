<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : editproject.php
    // Description : This file editing of project information
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : updateproject.php
    
?>


<?

      // Query to get department info 
       $query = "select * from project where projectid='$prid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
            
          echo "<h3>No Such Department </h3>"; 
       }
       else if ($number>0)
       {
           
           $projectid=mysql_result($result,0,"projectid");
           $deptid=mysql_result($result,0,"deptid");
           $projecttitle=mysql_result($result,0,"projecttitle");
           $projectdesc=mysql_result($result,0,"projectdesc");
           $hoursworked=mysql_result($result,0,"hoursworked");
           $active=mysql_result($result,0,"active");

?>


<h3>Edit <? echo $projecttitle; ?> for <? echo $deptname; ?></b></h3>

<form method="post" action="updateproject.php">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="35" valign="top">Project Title :</td>
      <td valign="top"> 
        <input type="text" name="ptitle" size="40" value="<? echo $projecttitle; ?>"><? echo $star; ?>
      </td>
    </tr>
    <tr> 
      <td height="35" valign="top">Project Description :</td>
      <td valign="top"> 
        <textarea name="pdesc" cols="35" rows="5" wrap="VIRTUAL"><? echo $projectdesc; ?></textarea><? echo $star; ?>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="hidden" name=projectid value="<? echo $projectid; ?>">
    <input type="submit" name="Submit" value="Enter Project in Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  


<?

} // end else if $deptid != ""


?>



<? include("footer.php"); ?>