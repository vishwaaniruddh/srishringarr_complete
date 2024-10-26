<?php
include("config.php");
  $id=$_GET['id'];
   $type=$_GET['type'];
  $atmid=$_GET['atm'];
  $cid=$_GET['cid'];

$stat=0;
$flag=0;

if($type=='amc')
{echo "11";
$qry="select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,Amc b where a.atm_id='$id' and a.cust_id='".$cid."' and a.atm_id=b.amcid and a.assetstatus='".$type."' and entry_date>NOW() - INTERVAL 1 DAY order by alert_id DESC limit 5";
$sql=mysqli_query($con1,$qry);
$cnt1=mysqli_num_rows($sql);
if($cnt1>=2){ $flag=1;  }
//if($cnt1==0)
$qry="select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,Amc b where a.atm_id='$id' and a.cust_id='".$cid."' and a.atm_id=b.amcid and a.assetstatus='".$type."' order by alert_id DESC limit 5";
$sql=mysqli_query($con1,$qry);
}
if($type=='site'){ //echo "22";
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,atm b where (b.atm_id='".$atmid."') and a.cust_id='".$cid."' and a.atm_id=b.track_id and a.assetstatus='".$type."' and entry_date>NOW() - INTERVAL 45 DAY order by alert_id DESC limit 5";
$sql=mysqli_query($con1,$qry);
$cnt1=mysqli_num_rows($sql);
if($cnt1>=2){ $flag=1;  }
//if($cnt1==0)
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,atm b where (b.atm_id='".$atmid."') and a.cust_id='".$cid."' and a.atm_id=b.track_id and a.assetstatus='".$type."' order by alert_id DESC limit 5";
//echo $qry;
$sql=mysqli_query($con1,$qry);
}
//echo $qry;
if(!$qry)
echo mysqli_error($con1);
?>
<ul style="list-style:none; padding:0">
<?php

while($row=mysqli_fetch_array($sql))
{
$eng=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[6]."' order by id DESC limit 1");
$engro=mysqli_fetch_row($eng);
//echo $row[5];
if($row[5]!='Done' && $row[5]!='Rejected' && $row[7]!='Done')
$stat=1;
if($flag==1)echo "<font color='#FF0000'>";
?>
<li>
<b>Atm ID</b> <?php echo $row[0]; ?><br />
<b>Address</b> <?php echo $row[1]; ?><br />
<b>State</b> <?php echo $row[2]; ?><br />
<b>Date</b> <?php echo date("d/m/Y h:i:s a",strtotime($row[3])); ?><br />
<b>Call Type:</b> <font color='#0000FF'><?php if($row[5]=='Done' || $row[7]=='Done'){ echo "Done"; }elseif($row[5]=='Rejected'){ echo "Rejected"; }else{ echo "Contact AVO"; } ?> </font><br />
<b>Problem:</b> <?php echo $row[4]; ?><br />

<b>Last Feedback:</b> <?php echo $engro[0]; ?>
</li>
<?php if($flag==1)echo "</font>"; ?>
<li><hr /></li>
<?php
}
?></ul><?php echo "##".$stat; ?>