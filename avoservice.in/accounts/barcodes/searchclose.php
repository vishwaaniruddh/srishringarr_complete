<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
</head>

<body>
<table width="975" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="25">Sr No.</th>
		 <th width="28">Customer ID</th>
    <th width="56">Name</th>
    <th width="62">Contact</th>
    <th width="124">Address</th>
    <th width="62">Pincode</th>
    <th width="61">Assign To</th>
    <th width="94">Request</th>
    <th width="75">Complete Date</th>
    <th width="143">Feedback</th>
    <th width="63">Client</th>
    <th width="65">Request Date</th>
    <th width="59">Amount</th>
    <th width="57">Paid Amount</th>
    <th width="63">Balance Amount</th>
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

$sql1="select a.request,a.request_date,a.assign_to,a.amount,a.paid_amount,b.name,b.contact,b.address,a.id,a.feedback,a.complete_date,a.client,b.pincode,a.person_id from  phppos_request a,phppos_service b where a.person_id=b.id and a.status='close' and a.cust_type='$cid' and ";

if(isset($_REQUEST['cont']))
{
	
$con=$_REQUEST['cont'];

$sql1.="b.contact like('".$con."%') ";
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

$sql1="select a.request,a.request_date,a.assign_to,a.amount,a.paid_amount,b.name,b.contact,b.address,a.id,a.feedback,a.complete_date,a.client,b.pincode,a.person_id from  phppos_request a,phppos_service1 b where a.person_id=b.id and a.status='close' and a.cust_type='$cid' and ";	

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
///echo $sql1;
$ress=mysql_query($sql1);
while($row1 = mysql_fetch_row($ress)){

$result2 = mysql_query("SELECT * FROM  phppos_engineer where id='$row1[2]' order by name");
$row2 = mysql_fetch_row($result2);
?>
  </tr>
  <tr>
    <td width="25"><?php echo $i++; ?></td>
	<td><?php echo $row1[13]; ?></td>
    <td><?php echo $row1[5]; ?></td>
    <td><?php echo $row1[6]; ?></td>
    <td><?php echo $row1[7]; ?></td>
    <td><?php echo $row1[12]; ?></td>
    <td><?php echo $row2[1]; ?></td>
    <td><?php echo $row1[0]; ?></td>
    <td><?php if(isset($row1[10]) and $row1[10]!='0000-00-00') echo date('d/m/Y',strtotime($row1[10])); ?></td>
    <td><?php echo $row1[9]; ?></td>
    <td><?php echo $row1[11]; ?></td>
    <td><?php if(isset($row1[1]) and $row1[1]!='0000-00-00') echo date('d/m/Y',strtotime($row1[1])); ?></td>
    <td><?php echo $row1[3]; $sum+=$row1[3]; ?></td>
    <td><?php echo $row1[4]; $sum1+=$row1[4]; ?></td>
    <td><?php $am=$row1[3]-$row1[4]; $sum2+=$am; echo $am; ?></td>
  </tr>
  
  <?php } ?>
  <tr>
    <td colspan="10" align="right">Total Amount</td>
    <td><?php echo $sum; ?></td>
    <td><?php echo $sum1; ?></td>
    <td><?php echo $sum2; ?></td>
  </tr>
  
</table>
</body>
</html>