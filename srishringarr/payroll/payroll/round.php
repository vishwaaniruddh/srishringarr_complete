<?

include ("functions.php");


$deptid=1;
$ipaddress="13444.74344.72262.124";

$goodip=checkipaddress($ipaddress,$deptid);


echo "YOUR IP  $ipaddress<br>";
echo "GOOD IP  $goodip <br>";







?>