<?php
include('config.php');
session_start();

include('config.php');

$id=$_GET['id'];
$sub=$_GET['engg'];
$user = $_SESSION['user'];


$qry=mysqli_query($con1,"update engg_site_mapping set engg_id= '".$sub."' where id='".$id."' ");


if($qry) echo"SUccess";

else echo '-1';
?>