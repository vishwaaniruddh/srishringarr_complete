<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : viewmesginfo.php
    // Description : This file gets a lmid from listmesgbyemp.php
    //               and then displays the message in a non-editable test area
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


<h3>Message number <? echo $lmid; ?> for employee <? echo $empname; ?> is: </b></h3>

<form method="post" action="insertclockinmessage.php">

   <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr> 
      <td height="35" valign="top">Message :</td>
      <td valign="top"> 
        <textarea name="cmessage" cols="35" rows="5" DISABLED=TRUE wrap="VIRTUAL">
	<? echo $mess; ?>
	</textarea>
      </td>
    </tr>
  </table>
  <p> 
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="hidden" name=empid value="<? echo $empid; ?>">
  </p>
  </form>
  






<? include("footer.php"); ?>











