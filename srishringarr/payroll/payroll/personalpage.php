<?

   include("header.php"); 
   include("functions.php");

?> 

<?
    // FILE DOCUMENTATION
    // Filename    : personalpage.php
    // Description : After processlogin.php checks whether username and password 
    //               are correct, it sends user to this page. THis page determines
    //               what kind of user it is and displays the correct home webpage
    //               for them. There exists 3 types of users superadmin, admin and
    //               regular user.
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : processlogin.php,superadminpage.php,adminpage.php,userpage.php
    
?>


<?

// Check if user is logged in
// by checking session variavle $session[auth]
//
// If User is logged in
if ($session[auth]==1)
{

   // If user has superadmin status
   // then display super admin Home Page   
   if ($session[superadmin]==1)
   {

       include("superadminpage.php"); 
     
   }
   // If user has Admin status
   // then display Admin Home Page   
   else if ($session[admin]==1)
   {

     include("adminpage.php"); 
     
   }
   // If user has no admin privileges
   // then display regular user Home Page 
   else
   {

     include("userpage.php"); 
     
   }
   
   
   
   
}
else
{

     echo "$noaccess";
     
}



?>

<? include("footer.php"); ?>
