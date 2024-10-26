<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : mailpassword.php
    // Description : This file accepts an email address from the lostpassword.php file
    //               It searches employee records for an employee whose email address
    //               matches the email address entered and then emails the same email address
    //               the login and password for that user.
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : lostpassword.php
    
?>


<?

// Query to get employee information matching email address entered
$query="select email,password,login,firstname,lastname from employee where email='$formemail' and active='y';";
$result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
$number = MYSQL_NUMROWS($result);

if ($number == 0)
{
      
   echo "<br>$mailpass1".$red.$formemail."</font></h4><br>$back<br>";
              
}
elseif ($number > 0)
{

    // Getting Database data from query
    $fname=mysql_result($result,0,"firstname");
    $lname=mysql_result($result,0,"lastname");
    $login = mysql_result($result,0,"login");
    $password=mysql_result($result,0,"password");
    
    // Declaring variables and data to send in email

    $subject="$sitename - $mailpass3";
    $emailbody="$mailpass4 $fname,
 
$mailpass5

$sitename $mailpass6

$mailpass7 $login
$mailpass8 $password

$mailpass9
";                    

    // send email to user with login and password
    mail($formemail,$subject,$emailbody,$from);


    echo "<br><h3>$mailpass10</h3><h4>$mailpass11</h4><h4>$mailpass12 <font color=red>$formemail</font>. $mailpass13</h4>";
 
    echo "$mailpass14<br><br>"; 

 
} 

?>
<? include("footer.php"); ?>