<?
require("include/calvars.inc.php");
?>
<html>
<head>
<title>Planner::Login</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
</head>
<?

//make some variables global
//if (isset($_POST['uname'])) { $uname = $_POST['uname']; }
//if (isset($_POST['upass'])) { $upass = $_POST['upass']; }

//make some variables global
//function importPost() {
//    $arglist = func_get_args();
  //  for ($i=0;$i<count($arglist);$i++) {
    //    if (isset($_POST[$arglist[$i]])) {$$arglist[$i] = $_POST[$arglist[$i]];}
   // }
//}

//importPost("uname","upass");

if(isset($_POST['uname'])) {

?>
<body bgcolor="#FFFFFF" text="#000000" class="rightnow">
<CENTER>
<?
    mysql_connect($host,$user,$pwd);
    mysql_select_db($db);
    $sql = "SELECT * FROM `".$admin_table."` WHERE `username`='".$_POST['uname']."' AND password=PASSWORD('".$_POST['upass']."')";
    $rs = mysql_query($sql);
    if(mysql_num_rows($rs))
    {
       $_SESSION['ADMIN'] = 1;
       print "Success!<BR><BR><A HREF=index.php TARGET=\"mymain\" onClick=\"self.close()\">return to the calendar</A>";
    }
    else
    {
       $_SESSION['ADMIN'] = 0;
//       print "Login failed!<BR><BR><A HREF=# onClick=\"history.back()\">go back</A>";
       print "Login failed!<BR><BR><A HREF=\"login.php\">go back</A>";
    }
}
else
{
?>
<body bgcolor="#FFFFFF" text="#000000" onLoad="document.form1.uname.focus()" class="rightnow">
<form name="form1" method="post" action="login.php">
  <p> Username:
    <input type="text" name="uname">
  </p>
  <p> Password:
    <input type="password" name="upass">
  </p>
  <p>
    <input type="submit" name="Submit" value="Submit">
  </p>
</form>
<?
}
?>
</CENTER>
</body>
</html>