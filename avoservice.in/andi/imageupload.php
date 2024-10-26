<?php
include("../config.php");
 if(isset($_POST['ImageName']))
 {
  $imgname=$_POST['ImageName'];
  $imgsrc=base64_decode($_POST['base64']);
  $picid=$_POST['pid'];
  $fp=fopen('images/'.$imgname,'w');
  fwrite($fp,$imgsrc);
  
  mysql_query("insert into site_images values('".$picid."','".$imgname."')");
 }