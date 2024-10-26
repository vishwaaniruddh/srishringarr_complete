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
	$query = "select * from deptevents where eventid = '$eventid'";
	$result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
	$deptid = mysql_result($result, 0,"deptid");
	$eventbody = mysql_result($result, 0,"eventbody");
	$eventid = mysql_result($result, 0,"eventid");

// If  department id is set
// then update department tbale with the new message
if  ($deptid!="")
{
	$querydname = "select * from department where deptid='$deptid'";
	$resultdname = MYSQL_QUERY($querydname) or die("SQL Error Occured : ".mysql_error().':'.$querydname);
       $deptname= mysql_result($resultdname, 0,"deptname");
    
}
else
{
	
       echo "<h3>Error! No Department ID found! </h3>";
	
	
}


// Enter A New Message     
?>


<h3>Please Edit Event For <? echo $deptname; ?></b></h3>

<form method="post" action="updatedeptevent.php">

   <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr> 
      <td height="35" valign="top">Event :</td>
      <td valign="top"> 
        <textarea name="eventbody" cols="35" rows="5" wrap="VIRTUAL">
	<? echo $eventbody; ?>
	</textarea>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="hidden" name=deptname value="<? echo $deptname; ?>">
    <input type="hidden" name=eventid value="<? echo $eventid; ?>">
    <input type="submit" name="Submit" value="Enter Event In Database">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
  






<? include("footer.php"); ?>











