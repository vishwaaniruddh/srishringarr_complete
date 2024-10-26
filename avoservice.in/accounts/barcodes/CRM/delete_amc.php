<script>
var r=confirm("Are You Sure !! You want to Delete ??");
if (r==true)
  {
	<?php
include('config.php');

//echo "delete from phppos_amc where person_id='$id'";	
$id=$_GET['id'];
$atype=$_GET['atype'];
$qry1=mysql_query("select `person_id` from phppos_amc where id='$id'");
$row=mysql_fetch_row($qry1);
$ctype=$_GET['ctype'];

if($atype=='sales')
{	// echo "in sales";
	
$qry=mysql_query("delete from phppos_amc where id='$id'");
	if($qry)
	{	 if($ctype=='commercial')
	  mysql_query("delete * from phppos_amcservicestatus where id='$row[0]'");
	}
if($qry)
{
?>	
	window.location="amcview.php";<?php
}
else
echo "Error Updating Data";

}
else if($atype=='service'||$atype=='services')
{	// echo "in service ";
$qry=mysql_query("delete from phppos_amc where id='$id'");
	if($qry)
	{	 
	  mysql_query("delete * from phppos_service1 where id='$row[0]'");
	  if($ctype=='commercial')
	  mysql_query("delete * from phppos_servicestatus1 where id='$row[0]");
	}
if($qry)
{
?>	
	window.location="amcview.php";<?php
}
else
echo "Error Updating Data";

}

?>
	  
  }
else
  {
  window.location="amcview.php";
  }
</script>
