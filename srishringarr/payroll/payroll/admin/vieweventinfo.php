<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : vieweventinfo.php
    // Description : This file gets a lmid from listmesgbyemp.php
    //               and then displays the message in a non-editable test area
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


<h3>Event number <? echo $eventid; ?> for department <? echo $deptname; ?> is: </b></h3>

<form method="post" action="insertclockinmessage.php">

   <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr> 
      <td height="35" valign="top">Event :</td>
      <td valign="top"> 
        <textarea name="cmessage" cols="35" rows="5" DISABLED=TRUE wrap="VIRTUAL">
	<? echo $eventbody; ?>
	</textarea>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
  </p>
  </form>
  






<? include("footer.php"); ?>











