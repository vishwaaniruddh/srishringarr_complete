<?

   // Dont start session on this page
   $se="n";
   include("header.php"); 

?>



<?
    // FILE DOCUMENTATION
    // Filename    : stopwork.php
    // Description : This file allows employee to check out. Employees enter their 
    //               login, logout and word description
    //               and resulting script authenticates login and password
    //               and enters work done and ip address in database and calculates
    //               time worked
    //   
    // License : GPL
    // Date    : 11/09/2001
    // Related Files : precheckout.php,checkout.php
    
?>

<table>
<tr>
<td width=400>

<table>
<form method="POST" action="precheckout.php">

   <center><h2><? echo $stopwork1; ?></h2>
   <? echo $stopwork2; ?> <b><? echo $timenow; ?></b><br><br> </center>
   <table border="0" width="100%">
    <tr>
      <td width="19%" align="right"><font face="Arial"><b><? echo $stopwork3; ?></b></font></td>
      <td width="81%"><font face="Arial"> <input type="text" name="formlogin" size="20"></font></td>
    </tr>
    <tr>
      <td width="19%" align="right"><font face="Arial"><b><? echo $stopwork4; ?></b></font></td>
      <td width="81%"><font face="Arial"><input type="password" name="formpassword" size="20"></font></td>
    </tr>

  </table>
  <p><font face="Arial"><input type="submit" value="<? echo $stopwork5; ?>" name="B1"><input type="reset" value="<? echo $stopwork6; ?>" name="B2"></font></p>
</form>

</td>
<td>
<img src="images/oldclock.jpg">
</td>
</tr>
</table>


 <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><font color="#000000">If
          you dont remember or lost your password, please click <a href="lostpassword.php">here</a>.</font></font></p>


<?

include("footer.php");

?>
