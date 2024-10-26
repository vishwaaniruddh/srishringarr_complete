<? include("header.php"); ?>
<?

// Checkin session ID to see if user is already logged in
if ($session[auth]!=1)
{
	echo "<h2>YOU ARE NOT LOGGED IN</h2>";
	echo "<h3>You have to be logged in to have acesss to this page</h3>";
	echo "<br>Please click <a href=\"$siteaddress/login.php\">here</a> to login<br><br>";
}
else if ($session[auth]==1)
{


?>
<p><font face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $user1; ?></b></font></p>

<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="320" valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#003366"><? echo $user2; ?></font></b></font></p>
      <ul>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="startwork.php"><? echo $user3; ?></a></font></li>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="stopwork.php"><? echo $user4; ?></a></font></li>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="enterdates.php?scriptname=seemytime.php"><? echo $user5; ?></a></font></li>

        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="composeemail.php?scriptname=emailmanager.php&towhom=My%20Manager"><? echo $user7; ?></a></font></li>
         <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="composeemail.php?scriptname=emaildept.php&towhom=My%20Department"><? echo $user8; ?></a></font></li> 
      </ul>
    </td>
    <td valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#003366"><? echo $user16; ?></font></b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="changepassword.php"><? echo $user17; ?></a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="changepassword.php"><? echo $user18; ?></a></font></li>
        <li><a href="lostpassword.php"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><? echo $user19; ?></font></a></li>
      </ul>
    </td>
  </tr>
  <tr> 
    <td valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#003366"><? echo $user9; ?></font></b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=deptemplist.php&what=View%20Departmental%20Employees"><? echo $user10; ?></a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="searchemployee.php"><? echo $user11; ?></a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="orgchart.php"><? echo $user13; ?></a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="<? echo $siteaddress; ?>/viewempcheckedinbydept.php"><? echo $user14; ?></a></font></li>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="<? echo $siteaddress; ?>/viewempcheckedin.php"><? echo $user15; ?></a></font></li>
      </ul>
    </td>
    <td valign="top"> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#003366"><? echo $user20a; ?></font></b></font> 
      <ul>
        <li><a href="enterdates.php?scriptname=seemytime.php"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><? echo $user20; ?></font></a></li>
         <li><a href="enterdates.php?scriptname=viewmytimecal.php"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><? echo $user21; ?></font></a></li>

      </ul>
    </td>
  </tr>
</table>

<h3><a href="logout.php"><? echo $user24; ?></a></h3>


<?

} // end of else if session == 1

?>

<? include("footer.php"); ?>