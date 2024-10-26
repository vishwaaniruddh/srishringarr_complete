<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : lostpassword.php
    // Description : This file displays a prompt for user to put in an email address
    //               It then passes that email address to mailpassword.php to try to 
    //               find a password match and then email user the username and password
    //               If email match successful, it emails user with their login and password
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : mailpassword.php
    
?>

      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="+2"><b><font size="+1"><? echo $lostpass1; ?></font></b> </font> </p>
      <form name="form1" method="post" action="mailpassword.php">
        <p><? echo $lostpass2; ?></p>
        <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr> 
            <td> 
              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><? echo $lostpass3; ?> </b></font></div>
            </td>
            <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
              <input type="text" name="formemail" size="30">
              </font></td>
          </tr>
        </table>
        <p align="center"> 
          <input type="submit" name="Submit" value="<? echo $lostpass4; ?>">
        </p>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"></font></p>
      </form>

<? include("footer.php"); ?>
