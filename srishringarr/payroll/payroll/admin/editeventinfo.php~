<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewempmesg.php
    // Description : This file gets a empid from listmesgbyemp.php
    //               and then updates the message table with empid and new message
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewdepartment.php, searchdeptmanager.php, insertdepartment.php
    
?>


<?
	$query = "select * from messages where lmid = '$lmid'";
	$result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
	$mess = mysql_result($result, 0,"message");
	$empid = mysql_result($result, 0,"empid");

// If  employee id is set
// then update department tbale with the new message
if  ($empid!="")
{
	
	
       $empname=getempname($empid);

}
else
{
	
       echo "<h3>Error! No Employee ID found! </h3>";
	
	
}


// Enter A New Message     
?>


<h3>Please Edit Message For <? echo $empname; ?></b></h3>

<form method="post" action="updateclockinmesg.php">

   <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr> 
      <td height="35" valign="top">Message :</td>
      <td valign="top"> 
        <textarea name="message" cols="35" rows="5" wrap="VIRTUAL">
	<? echo $mess; ?>
	</textarea>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=lmid value="<? echo $lmid; ?>">
    <input type="hidden" name=empname value="<? echo $empname; ?>">
    <input type="submit" name="Submit" value="Enter Message In Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  






<? include("footer.php"); ?>











