<?

/*

Filename : Constants.php

Description : This file contain all the constants which will be used throughout the site. Changing the information in this file will affect the functionality of the whole site.


*/

include("settings.php");

date_default_timezone_set('Asia/Kolkata');

$today=date("Y-m-d");
$timenow=date("h:i A");
$dt=date("Y-m-d H:i:s");

// Declaring Common Entry Variables

// Getting Reffering Page address
$frp1=$SCRIPT_URI."?".$QUERY_STRING;

// User is not authenticated.. so forward them to the login page
$noaccess="<center><img src=\"$siteaddress/$imagedirectory/memberonly1.gif\" border=0></center><br><br><h3>You cannot access this page. You have to <a href=\"$siteaddress/login.php?frp=$frp1\">log in</a> first.</h3><br><p><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\"><font color=\"#000000\">If you dont remember or lost your password, please click <a href=\"$siteaddress/lostpassword.php\">here</a>.</font></font></p>";

$refresh="<meta http-equiv=\"Refresh\" content=\"3; url=$siteaddress/login.php?frp=$frp1\">\n\n<br><br><h3>If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/login.php?frp=$frp1\">here</a> to continue. Thanks.</h3><br>";
 


// Declaring Transport Strings


// Transporting user to their home page after authentification
$transporthome="<meta http-equiv=\"Refresh\" content=\"0; url=$siteaddress/personalpage.php\">\n\n<br><br><h2>Authentification Successful</h2><h3>You will now be transported to your personal $sitename Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/personalpage.php\">here</a> to continue. Thanks.</h3><br>";


// Transporting user to the reffering page after authentification 
$transportrefer="<meta http-equiv=\"Refresh\" content=\"0; url=$referpage\">\n\n<br><br><h2>Authentification Successful</h2><h3>You will now be transported to the page you were trying to access (<i>$referpage</i>).If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$referpage\">here</a> to continue. Thanks.</h3><br>";


// Transporting already logged in user to their homepage
$transportlogged="<meta http-equiv=\"Refresh\" content=\"0; url=$siteaddress/personalpage.php\">\n\n<br><br><h2>You are already logged in !</h2><h3>You will now be transported to your personal $sitename Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/personalpage.php\">here</a> to continue. Thanks.</h3><br>";

// User logging out... transporting back to first page...
$transportout="<meta http-equiv=\"Refresh\" content=\"2; url=$siteaddress/\">\n\n<br><br><h2>You are now logged out !</h2><h3>You will now be transported to $sitename Main Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/\">here</a> to continue. Thanks.</h3><br>";

// Email
$adminemail="nileshd@olemiss.edu";
$from="From: Nilesh Dosooye<nileshd@olemiss.edu>";
$emailend="Sincerely,\nSupport Team\n";


// Images
$headertop="pagehead.php";


//Screen
$screenwidth=640;



// Time worked rounding
// This variable specifies to what accuracy to 
// Calculate the time worked
// 0 : No rounding.. uses raw time
// 25 : rounding to the nearest 15 minutes
// 50 : rounding to the nearest 30 minutes

$rounding=0;


$star="<b><font color=\"red\" size=\"+1\">&nbsp;&nbsp;*</font></b>";

?>
