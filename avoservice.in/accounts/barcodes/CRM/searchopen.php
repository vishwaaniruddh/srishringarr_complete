<table width="826" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="34">Sr No.</th>
	 <th width="34">Customer ID.</th>
    <th width="124">Name</th>
    <th width="104">Contact</th>
    <th width="124">Address</th>
    <th width="124">Pincode</th>
    <th width="99">Assign To</th>
    <th width="115">Request</th>
    <th width="115">Feedback</th>
    <th width="101">Request Date</th>
    <th width="59">Amount</th>
    <th width="97">Paid Amount</th>
    <th width="118">Balance Amount</th>
    <th width="59">Update</th>
    <th width="59">Feedback</th>
  </tr>
<?php
$sum=0;
$sum1=0;$sum2=0;
$i=1;
$cid=$_GET['cid'];
//$cont=$_REQUEST['cont'];
//$pin=$_REQUEST['pin'];
//$search=$_GET['search'];
include('config.php');


if($cid=="sales")
{

$sql1="select a.request,a.request_date,a.assign_to,a.amount,a.paid_amount,b.name,b.contact,b.address,a.id,a.feedback,b.pincode,a.person_id from  phppos_request a,phppos_service b where a.person_id=b.id and a.status='' and a.cust_type='$cid'  ";

if(isset($_REQUEST['cont']))
{
	
$con=$_REQUEST['cont'];

$sql1.="and b.contact like('".$con."%') ";
}
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$sql1.="and a.person_id like('".$id."%') ";
}
if(isset($_REQUEST['pin']))
{
	
$pin=$_REQUEST['pin'];
$sql1.="and b.pincode like('".$pin."%')";
}
}
else
{

$sql1="select a.request,a.request_date,a.assign_to,a.amount,a.paid_amount,b.name,b.contact,b.address,a.id,a.feedback,b.pincode,a.person_id from  phppos_request a,phppos_service1 b where a.person_id=b.id and a.status='' and a.cust_type='$cid' and ";	


if(isset($_REQUEST['cid']))
{
	
$con=$_REQUEST['cont'];

$sql1.="b.contact like('".$con."%') ";
}

if(isset($_REQUEST['id']))
{
	
$cid=$_REQUEST['id'];

$sql1.="and a.person_id like('".$id."%') ";
}
if(isset($_REQUEST['pin']))
{
	
$pin=$_REQUEST['pin'];
$sql1.="and b.pincode like('".$pin."%')";
}
}
//echo $sql1;

$ress=mysql_query($sql1);
while($row1 = mysql_fetch_row($ress)){

$result2 = mysql_query("SELECT * FROM  phppos_engineer where id='$row1[2]' order by name");
$row2 = mysql_fetch_row($result2);
?>
  
  <tr>
    <td width="34"><?php echo $i++; ?></td>
	  <td><?php echo $row1[11]; ?></td>
    <td><?php echo $row1[5]; ?></td>
    <td><?php echo $row1[6]; ?></td>
    <td><?php echo $row1[7]; ?></td>
    <td><?php echo $row1[10]; ?></td>
    <td><?php echo $row2[1]; ?></td>
    <td><?php echo $row1[0]; ?></td>
    <td><?php echo $row1[9]; ?></td>
    <td><?php if(isset($row1[1]) and $row1[1]!='0000-00-00') echo date('d/m/Y',strtotime($row1[1])); ?></td>
    <td><?php echo $row1[3]; $sum+=$row1[3]; ?></td>
    <td><?php echo $row1[4]; $sum1+=$row1[4]; ?></td>
    <td><?php $am=$row1[3]-$row1[4]; $sum2+=$am; echo $am; ?></td>
    <td width="59"><a href="update_request.php?id=<?php echo $row1[8]; ?>&type=<?php echo $cid; ?>">Update</a></td>
    <td width="70"><a href="view_feedback.php?id=<?php echo $row1[8]; ?>&type=<?php echo $cid; ?>&name=<?php echo $row1[5]; ?>">Feedback</a></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="8" align="right">Total Amount</td>
    <td><?php echo $sum; ?></td>
    <td><?php echo $sum1; ?></td>
    <td><?php echo $sum2; ?></td>
    <td></td>
  </tr>
</table>
