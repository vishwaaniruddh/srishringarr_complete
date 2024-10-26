<?php
include("config.php");
  $cid=$_GET['cid'];
$qry='';
/*$qry.="select c.atmid,b.atm_id,a.bank_name,a.problem,a.createdby from alert a, atm b, amc c where 1 ";
if($type=='amc')
$qry.=" and c.amcid=a.atm_id";
if($type=="site")
$qry.=" and b.atm_id=a.atm_id ";*/
$stat=0;


/*if($type=='amc')
$qry="select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id from alert a,Amc b where a.atm_id='$id' and a.cust_id='".$cid."' and a.atm_id=b.amcid and a.assetstatus='".$type."' order by alert_id DESC limit 5";
if($type=='site')
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id from alert a,atm b where (b.atm_id='".$atmid."') and a.cust_id='".$cid."' and a.atm_id=b.track_id and a.assetstatus='".$type."' order by alert_id DESC limit 5";
*/
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,b.cust_id from alertlocal a,local_site b where a.cust_id=b.track_id and a.cust_id='".$cid."'  order by alert_id DESC limit 5";


//echo $qry;
if(!$qry)
echo mysqli_error();
?>
<ul style="list-style:none; padding:0">
<?php
$sql=mysqli_query($con1,$qry);
while($row=mysqli_fetch_array($sql))
{

$eng=mysqli_query($con1,"select feedback from eng_feedbacklocal where alert_id='".$row[6]."' order by id DESC limit 1");
$engro=mysqli_fetch_row($eng);
//echo $row[5];
if($row[5]!='Done' && $row[5]!='Rejected')
$stat=1;
?>
<li>
<b>NAME</b> <?php echo $row[7]; ?><br />
<b>CIN</b> <?php echo $row[0]; ?><br />
<b>Address</b> <?php echo $row[1]; ?><br />
<b>State</b> <?php echo $row[2]; ?><br />
<b>Date</b> <?php echo date("d/m/Y h:i:s a",strtotime($row[3])); ?><br />
<b>Call Type:</b> <font color='#FF0000'><?php if($row[5]=='Done'){ echo "Done"; }elseif($row[5]=='Rejected'){ echo "Rejected"; }else{ echo "Open"; } ?> </font><br />
<b>Problem:</b> <?php echo $row[4]; ?><br />

<b>Last Feedback:</b> <?php echo $engro[0]; ?>
</li>
<li><hr /></li>
<?php
}
?></ul><?php echo "##".$stat; ?>