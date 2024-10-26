<ul id="menu-bar">
<?php
//$echo $_SESSION['designation'];
// include("myfunction/menu.function.php");

include($_SERVER['DOCUMENT_ROOT'].'/AccountManager/myfunction/menu.function.php');


if($_SESSION['user']=='masteradmin')
{
masteradmin();
}
else
{
if($_SESSION['designation']=="1")
{

 Admin();
}
elseif($_SESSION['designation']=="2")
{
	Call();
}
elseif($_SESSION['designation']=="3")
{
	BranchHead();
}
elseif($_SESSION['designation']=="4")
{
	Engineer();
}
elseif($_SESSION['designation']=="5")
{
	AccountManager();
}
elseif($_SESSION['designation']=="7")
{

	Accounts();
}
}
?>

 <li><a href="logout.php">Logout</a></li>
</ul>