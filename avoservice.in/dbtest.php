<?php
/*$con = mysqli_connect("localhost","avoservi_avo","Myaccounts123*","avoservi_service");
//$con = mysqli_connect("localhost","my_user","my_password","my_db");

if (mysqli_connect_errno()) {
  echo "Failed to connect to mysqli: " . mysqli_connect_error();
  exit();
}
echo "connected";

$result=mysqli_query($con,"select * from login where username='masteradmin' and password='24UDVk8tu$' and status=1");


echo mysqli_num_rows($result);*/
$con = mysqli_connect("localhost","avoservi_avo","Myaccounts123*");

mysqli_select_db("avoservi_service",$con);
$result=mysqli_query($con1,"select * from login where username='masteradmin' and password='24UDVk8tu$' and status=1");

echo mysqli_num_rows($result);

echo "insert into login(username,password,branch,designation) values ('satyendra','qwerty',10,2)";
mysqli_query($con1,"insert into login(username,password,branch,designation) values ('satyendrax','qwerty',10,2)");


//$c

//mysqli_query($con1,"SET NAMES UTF8;");
?>