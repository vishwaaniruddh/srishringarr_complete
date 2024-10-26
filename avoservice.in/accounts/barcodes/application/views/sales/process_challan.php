<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

$item_no=$_GET['item_no'];
$item_name=$_GET['item_name'];
$quan=$_GET['quan'];
$cust=$_GET['cust'];
$uid=$_GET['uid'];
$sql1="insert into phppos_challan (customer_id,employee_id) values ('$cust','$uid')";
$result1=mysql_query($sql1);

$sq=mysql_query("select max(sale_id) from phppos_challan");
$ro=mysql_fetch_row($sq);

for($i=0;$i<count($item_no);$i++){
$sql=mysql_query("select * from phppos_items where item_number='$item_no[$i]'");
$row=mysql_fetch_row($sql);

//echo $row[0];


$sql2="insert into phppos_challan_items(sale_id,item_id,quantity_purchased) values ('$ro[0]','$row[9]','$quan[$i]')";
$result2=mysql_query($sql2);
	}




if($result1 && $result2)
{
	header('Location:new_challan.php?uid='.$uid);
}
else
echo "Error Creating Challan";
?>