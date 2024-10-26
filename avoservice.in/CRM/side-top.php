<?php session_start();
$username = $_SESSION['user_name'];
include("config.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>


   <?php include("header.php");?>

</head>
<body class="sidebar-pinned ">

<?php include("vertical_menu.php")?>


<main class="admin-main">
<header class="admin-header">



    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

    <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">

            <li class="nav-item">
                <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                    <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                </a>
            </li>
        </ul>
    </nav>
  

    <nav class=" ml-auto">
        <ul class="nav align-items-center">
           

            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark"><? echo $username[0];?></span>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"   >

                    <a class="dropdown-item" href="<? echo 'http://'.$_SERVER["SERVER_NAME"]."/CRM/logout.php"; ?>"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>




