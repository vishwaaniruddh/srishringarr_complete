<?php
session_start();
include ('config.php');

//echo $_SESSION['usertype'];
if($_SESSION['usertype']=="Admin")
{

header('Location:dashboard_admin.php');
//header('Location:viewlead.php');
//header('Location:testscheduleviewadmin.php');
}
else if($_SESSION['usertype']=="SUB ADMIN")
{

//header('Location:teacherpanel.php');
header('Location:dashboard.php');
}
else if($_SESSION['usertype']=="Sales Associate")
{

header('Location:dashboard_SalesAssociate.php');
}
else if($_SESSION['usertype']=="HOTEL MANGER")
{

header('Location:dashboard_HotelManager.php');
}

else{
header('Location:index.php');   
    
}


?>