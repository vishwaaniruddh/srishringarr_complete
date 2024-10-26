<?
   session_start();
   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : login.php
    // Description : This file checks whether  user is already logged in
    //               If not it displays the login screen
    //               If logged in, it displays the user's home page
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : logininc.php,personalpageinc.php,processlogin.php
    
?>
<?
// Checkin session ID to see if user is already logged in
if ($_SESSION['auth']==1)
{

   // If user has superadmin status
   // then display super admin Home Page   
   if ($_SESSION['superadmin']==1)
   {
   	
       echo "<meta http-equiv=\"Refresh\" content=\"0; url=$siteaddress/admin/index.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has Admin status
   // then display Admin Home Page   
   else if ($_SESSION['admin']==1)
   {

       echo "<meta http-equiv=\"Refresh\" content=\"0; url=$siteaddress/admin/index.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has no admin privileges
   // then display regular user Home Page 
   else
   {
       echo "<meta http-equiv=\"Refresh\" content=\"0; url=$siteaddress/accountmanager.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/accountmanager.php\">here</a> to continue. Thanks.</h3>";		     
   }

}
else
{

echo "<h2>Login page</h2>";

// If user not logged in, then display login screen
include("logininc.php");

}
?>

<? include("footer.php"); ?>