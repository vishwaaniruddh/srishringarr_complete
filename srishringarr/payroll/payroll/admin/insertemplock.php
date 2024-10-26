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


	
         $empname=getempname($empid);

       // Query to insert a new message
       $querycm="INSERT INTO locks (lockid, empid, datelock, reasonlock, lockedby, active) VALUES (null, '$empid', '$today', '$lockmessage', 'Administrator', 'y')";
       
       $resultcm = MYSQL_QUERY($querycm) or die("SQL Error Occured : ".mysql_error().':'.$querycm);


?>


<table border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="35"> 
      <div align="right">Employee Name :</div>
    </td>
    <td><b><font color=red><? echo $empname; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Lock Message :</div>
    </td>
    <td><b><font color=red><? echo $lockmessage; ?></b></td>
  </tr>
</table>



<h2>Employee LOCK for <? echo $empname; ?> has been Activated</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>