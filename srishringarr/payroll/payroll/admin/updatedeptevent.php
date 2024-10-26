<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertclockinmessage.php
    // Description : This file inserts a new clock in message
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>


<?


	
      //   $empname=getempname($empid);

       // Query to insert a new message
       $queryud="UPDATE deptevents SET eventbody='$eventbody'WHERE eventid='$eventid'";
       
       $resultud = MYSQL_QUERY($queryud) or die("SQL Error Occured : ".mysql_error().':'.$queryud);


?>


<table border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="35"> 
      <div align="right">Department Name :</div>
    </td>
    <td><b><font color=red><? echo $deptname; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Event :</div>
    </td>
    <td><b><font color=red><? echo $eventbody; ?></b></td>
  </tr>
</table>



<h2>Department Event has been Changed</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>










