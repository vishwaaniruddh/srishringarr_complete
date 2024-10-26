<?
require("include/calvars.inc.php");
?>
<html>
<head>
<title>Planner::Logout</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" class="rightnow">
<BR>
<CENTER>
<?
if((isset($_GET['dologout'])) && $_GET['dologout'] == 1)
{
    $_SESSION['ADMIN'] = 0;
    print "You have been logged out<BR><BR><A HREF=\"index.php\" TARGET=\"mymain\" onClick=\"self.close()\">return to the main page</A>";
}
else
{
?>
Click to <A HREF="logout.php?dologout=1">LOGOUT</A>
<?
}
?>
</CENTER>
</body>
</html>