<script>
var r=confirm("Are You Sure !! You want to Delete Customer?? It will remove parmanentely");
if (r==true)
  {
	  <?php
include('config.php');
//echo "delete from phppos_service where id='$id'";	
$id=$_GET['id'];
$qry1=mysql_query("select image, ctype,amctaken from phppos_service where id='$id'");
$row=mysql_fetch_row($qry1);
$qry=mysql_query("delete from phppos_service where id='$id'");
	if($qry)
	{	if($row[0]!="")
	  unlink("modelphoto/".$oldimg);
	  if($row[1]=='commercial')
	  mysql_query("delete * from phppos_servicestatus where id='$id'");
	  mysql_query("SELECT * FROM `phppos_request` WHERE `person_id`='$id'");
	  if($row[3]=='1')
	  {
	  mysql_query("delete * from phppos_amc where person_id='$id' and atype='sales'");
	  if($row[1]=='commercial')
	  mysql_query("delete * from phppos_amcservicestatus where id='$id'");
	  
	  }
	}
if($qry)
{
?>	
	window.location="cust_service.php";<?php
}
else
echo "Error Updating Data";
?>
}
else
  {
  window.location="cust_service.php";
  }
</script>
