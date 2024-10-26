<?
     // Dont start session on this page
     $se="n";
     include ("header.php");
?>


<?
    // FILE DOCUMENTATION
    // Filename    : startwork.php
    // Description : This file allows users to login using a login and password
    //               This processing for the variables of this form are done in 
    //               checkin.php
       
    // License : GPL
    
?>

<table>
<tr>
<td width=400>

<form method="POST" action="checkin.php">

   <table border="0" width="100%">
        <center><h2><? echo $startwork1; ?></h2>
        
        <? echo "$startwork2  <b>$timenow</b>"; ?></b><br><br> </center> 

    <tr>
        <td width="17%" align="right">
            <? echo $startwork3; ?>
        </td>
        <td width="83%">
             <input type="text" name="formlogin" size="20">
        </td>
    </tr>
    
    <tr>
      <td width="17%" align="right">
           <? echo $startwork4; ?>
      </td>
      <td width="83%">
           <input type="password" name="formpassword" size="20">
      </td>
    </tr>
   </table>
    <p>   
       <input type="submit" value="<? echo $startwork5; ?>" name="B1">
       <input type="reset" value="<? echo $startwork6; ?>" name="B2">
   </p>
   
</form>


</td>
<td>
<img src="images/hourglass.jpg">
</td>
</tr>
</table>

 <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><font color="#000000">If
          you dont remember or lost your password, please click <a href="lostpassword.php">here</a>.</font></font></p>

<? 
   include("footer.php"); 
?>

