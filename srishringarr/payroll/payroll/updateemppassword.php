<?


   include("header.php"); 
   include("functions.php");

?>

<?
 
if ($session[auth]!=1)
{
 
    echo "$noaccess $refresh<br>";
 
}
else
{
 
 

     $query="select empid,login,firstname,lastname,email,password from employee where login='$formlogin';";
     $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

     $empid= mysql_result($result,0,"empid");
     $fname = mysql_result($result,0,"firstname");
     $lname = mysql_result($result,0,"lastname");
     $email = mysql_result($result,0,"email");
     $login = mysql_result($result,0,"login");
 
     $password1 = mysql_result($result,0,"password");


     if ($password1!=$oldpwd)  
              { echo "Old Password do not match. Please Try again !!<br>"; }

     else if ($newpwd1!=$newpwd2) 
              {echo "Your new passwords do not match. Please go back and correct !!<br>";}
     else if (strlen($newpwd1)>12)
              { echo "The new password you entered is longer than 12 characters. It had to be less than 12 Characters. $back<br>"; } 
    else if (strlen($newpwd1)<4)
    { echo "The new password you entered is less 4 characters. It had to be more than 4 Characters. $back<br>"; } 

     else
     {


          $newpwd=addslashes($newpwd);

          $query1 = "update employee set password='$newpwd1' where empid='$empid';";
          $result1 = MYSQL_QUERY($query1) or die("SQL Error Occured : ".mysql_error().':'.$query1);

          echo "<h3>Password Change Success</h3><h4>Your password has been successfully updated</h4><br>Click <a href=\"accountmanager.php\">here</a> to go back to your main page";

          
$passchsubj="Password Change";
$passchbody="Hi $fname,

You recently updated your password on EPayroll System. Your new login and password information is as follows :-

Login    : $login
Password : $newpwd

Thanks,
EPayroll Team
";


          mail($email,$passchsubj,$passchbody,$from);

     } 

}

?>
<? include("footer.php"); ?>
