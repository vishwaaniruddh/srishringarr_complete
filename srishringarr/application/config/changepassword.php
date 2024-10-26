<?php  
$hostname='localhost'; //// specify host, i.e. 'localhost'
$user="satyavan_pos123"; //// specify username
$pass="Mypos1234"; //// specify password
$dbase="satyavan_pos"; //// specify database name
$connection = mysql_connect("$hostname" , "$user" , "$pass") 
or die ("Can't connect to MySQL");
mysql_select_db($dbase , $connection) or die ("Can't select database.");
$pass = md5('123456');
echo $pass;
$result1 = mysql_query("update phppos_employees set password='$pass' where username='preeti'");	
if($result1)echo "done";
else echo "error";	
 ?>
