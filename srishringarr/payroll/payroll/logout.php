<?

   session_start();
   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : logout.php
    // Description : This file logs a user out. It deregisters all session variables
    //               and transports user back to the main page
    // License : GPL
    // Date    : 11/04/2001
    
?>


<?

     // Unregister all Session variables
     // Thus logging out user
    // session_unregister("session");

        session_unset();
     // bringing user back to the front page
     echo "$transportout";


?>

<?
   include("footer.php");
?>
