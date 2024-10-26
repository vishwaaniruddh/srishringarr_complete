<ul id="menu-bar">
<?php
include("myfunction/menu.function.php");
/*if($_SESSION['user']=='masteradmin')
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
else */
if($_SESSION['designation']=="6")
{
	Client();
}
//}
?>

 <li><a href="../logout.php">Logout</a></li>
</ul>