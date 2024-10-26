<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : emailmanager.php
    // Description : This file sends email to the manager of the
    //               Employee Employee ID
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : resultssearch.php
    
?>
<?

$manageremail=genericget($managerid,'empid','email','employee');


$mailto="$manageremail";
$emailfrom="From: $session[lastname] $session[firstname]<$session[email]>";
$subject="WEB FORM MAIL : ".$subject;

$emailbody=$emailbody."\n\nThis email was sent from IP Address $ipaddress\n\n"; 
 
 
mail($mailto,$subject,$emailbody,"$emailfrom");


echo "<h3>Your email has been sent to $managername. Please do not reload this page or email will be sent again.</h3>";

echo "Click <a href=\"index.php\">here</a> to go back to main menu.";

?>


<? include("footer.php"); ?>