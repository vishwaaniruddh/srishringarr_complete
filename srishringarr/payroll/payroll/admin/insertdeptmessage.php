<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertdeptmessage.php
    // Description : This file inserts a new dept message
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewproject.php
    
?>


<?


	
        $deptname=genericget($deptid,'deptid','deptname','department'); 

       // Query to insert a new project
       $querydm="INSERT INTO deptevents (eventid, deptid, eventdate, eventtime, eventbody, postedby, dateposted, expirydate, active) VALUES (null, '$deptid', '$today', '', '$deptmessage', 'Administrator', '$today', '$expdate', 'y')";
       $resultdm = MYSQL_QUERY($querydm) or die("SQL Error Occured : ".mysql_error().':'.$querydm);

       // getting Department Name

              
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
      <div align="right">Department Message :</div>
    </td>
    <td><b><font color=red><? echo $deptmessage; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Expiry Date :</div>
    </td>
    <td><b><font color=red><? echo $expdate; ?></b></td>
  </tr>
</table>



<h2>Department Message has been Inserted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>