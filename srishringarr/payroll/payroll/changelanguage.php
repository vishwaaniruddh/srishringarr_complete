<?
if ($l=="eng")
{
   $languagefile="english.inc.php";
}
else if ($l=="fr")
{
   $languagefile="french.inc.php";
}
else if ($l=="ger")
{
   $languagefile="german.inc.php";
}
$days=7; // how many days from now the cookie will exist 
$exp= time() + ( $days * 86400 ); // there are 86400 seconds in a day 
$exp=strftime("%a, %d-%b-%Y %H:%M:%S", $exp); // format the date and time 
$exp="$exp GMT"; // use Greenwich Mean Time 
$c_path= "/";                 # "/"= all directories or "/php/"=named path
$c_domain = "";               # leaving empty covers all domains
$c_secure = 0;                # secure server? 1=true,0=false

// Setting Cookie
setCookie("payrolllang","$languagefile","$exp","$c_path","$c_domain","$c_secure");
?>
<?


   include("header.php"); 
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : changelanguage.php
    // Description : This file allows user to change language used on the site
    //               by setting a cookie for appropriate language file
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?

if ($l=="eng")
{
   echo "<h3>Language has been changed to English</h3>";
}
else if ($l=="fr")
{
   echo "<h3>Language has been changed to French</h3>";
}
else if ($l=="ger")
{
   echo "<h3>Language has been changed to German</h3>";
}

echo $back;



?>
<? include("footer.php"); ?>