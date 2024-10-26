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
       $querycm="INSERT INTO messages (lmid, empid, message, postedby, dateposted, numviews, active) VALUES (null, '$empid', '$cmessage','Administrator', '$dt', '$noviews', 'y')";
       
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
      <div align="right">Clock In Message :</div>
    </td>
    <td><b><font color=red><? echo $cmessage; ?></b></td>
  </tr>
</table>



<h2>Employee Clock In  Message has been Inserted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>

