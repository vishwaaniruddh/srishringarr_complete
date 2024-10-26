<?
   
   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : changepassword.php
    // Description : This file allows user to change their password
    //   
    // License : GPL
    // Date    : 11/04/2001
   
    

if ($_SESSION['auth']!=1)
{
 
    echo "$noaccess $refresh<br>";
 
}
else
{
?>
<h2>Change Password</h2>

<form method="post" action="updateemppassword.php" name="updatepass">
<table width="640" border="0" cellspacing="0" cellpadding="0">
 
    <tr> 
      <td height="30"> 
        <div align="right">Old Password :</div>
      </td>
      <td>
        <input type="password" name="oldpwd" size="20">
      </td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right">New Password :</div>
      </td>
      <td>
        <input type="password" name="newpwd1" size="20">
      </td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right">Re-Type New Password :</div>
      </td>
      <td>
        <input type="password" name="newpwd2" size="20">
      </td>
    </tr>
  </table>
  <p> 
    <input type=hidden name=formlogin value="<? echo $_SESSION['login']; ?>">
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>


<?

} // end else

?>

<? include("footer.php"); ?>
