<?php
include('../config.php');
$patid=$_GET['branch'];
$arr=array();
$name1=mysql_query("select engg_id,engg_name,loginid,area,city from area_engg where loginid in(select srno from login where designation='4' and branch in($patid))  order by engg_name ASC");
while($name=mysql_fetch_row($name1))
{
$q=mysql_query("select state from state where state_id='".$name[3]."'");
	$r=mysql_fetch_row($q);
	$q2=mysql_query("select city from cities where city_id='".$name[4]."'");
	$r2=mysql_fetch_row($q2);
	$arr[] = array( 'name' => $name[1],'engid'=>$name[0],'state'=>$r[0],'city'=>$r2[0]);
}
echo json_encode($arr);
?>