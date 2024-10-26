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
	$lmid = $lockid;
       // Query to obtain the relevant row ( only one row will be in the result because lmid is an auto_increment field)
       $querycm="SELECT * from  messages where lmid = '$lmid'";
       $resultcm = MYSQL_QUERY($querycm) or die("SQL Error Occured : ".mysql_error().':'.$querycm);
       $empid = mysql_result($resultcm, 0, 'empid');
        //Query for employee name
       $querynm = "SELECT * FROM employee where empid = '$empid'";
       $resultnm = MYSQL_QUERY($querynm) or die("SQL Error Occured : ".mysql_error().':'.$querynm);
       $empfirst = mysql_result($resultnm, 0, 'firstname');
       $empmid = mysql_result($resultnm, 0, 'minit'); 
       $emplast = mysql_result($resultnm, 0, 'lastname');
       $empname = $empfirst." ".$empmid." ".$emplast;
       $mess = mysql_result($resultcm, 0, 'message');
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
    <td><b><font color=red><? echo $mess; ?></b></td>
  </tr>
</table>
<? $querydel="DELETE FROM messages WHERE lmid='$lmid'";
   $resultdel = MYSQL_QUERY($querydel) or die("SQL Error Occured : ".mysql_error().':'.$querydel);
?>

<h2>Employee Clock In  Message has been Deleted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>



<? include("footer.php"); ?>

