<?
    // FILE DOCUMENTATION
    // Filename    : logininc.php
    // Description : This file displays the html for the login prompt for the admin pages
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : login.php,processlogin.php
    
?>



<form method="post" action="processlogin.php">
        <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Please 
          provide login and password information to have access to the site. </font></p>
        <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr> 
            <td> 
              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Login 
                :</font></div>
            </td>
            <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
              <input type="text" name="formlogin" size="15">
              </font></td>
          </tr>
          <tr> 
            <td> 
              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Password 
                :</font></div>
            </td>
            <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
              <input type="password" name="formpassword" size="15">
              </font></td>
          </tr>
        </table>
        <p align="center">
        <center>

          <input type="hidden" name="referpage" value="<? echo $frp; ?>"> 
          <input type="hidden" name="PHPSESSID" value="<? echo $PHPSESSID; ?>">
          <input type="submit" name="Submit" value="Login">
          <input type="reset" name="Submit2" value="Reset">
          
        </center>
        </p>

        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><font color="#000000">If 
          you dont remember or lost your password, please click <a href="lostpassword.php">here</a>.</font></font></p>
      </form>
     
