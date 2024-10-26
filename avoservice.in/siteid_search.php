<?php
include("access.php");

?>

<table style="width:80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">

<tr>
   
<th width="80">Site/Sol/ATM ID</th>
<th width="50">Vertical</th>
<th width="50">Enduser Name</th>
<th width="50">Area</th>
<th width="50">City</th>
<th width="10%2">Address</th>
<th width="42">State</th>
<th width="42">Branch</th>
<th width="25">Status</th>
<th width="25">Last Feedback</th>
<th width="25">Action</th>

</tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];

//echo " Hello";

//var_dump($_POST);
if(isset($_POST['type']) && $_POST['type']=='siteid')
{
$str="select track_id, atm_id,cust_id,branch_id, bank_name,city, area, address, state1,active from atm where atm_id like '%".$_POST['data']."%' and active='Y'";
$qry=mysqli_query($con1,$str);
if(mysqli_num_rows($qry)>0) { $site='site'; } else {
$str="select amcid,atmid,cid,branch, bankname,city, area, address, state,active from Amc where atmid like '%".$_POST['data']."%' and active='Y'";

//echo $str;
$qry=mysqli_query($con1,$str);
if(mysqli_num_rows($qry)>0)  { $site='amc'; }
}
if(!$qry) { echo "No Results found";
die;

}
}
if($qry)
$results = mysqli_num_rows($qry);
echo "COunt:".$results;
while($row=mysqli_fetch_row($qry))
{
$count=$count+1;

$qry3=mysqli_query($con1,"select * from avo_branch where id='".$row[3]."'");
$row3=mysqli_fetch_row($qry3);

$qry34=mysqli_query($con1,"select * from customer where cust_id='".$row[2]."'");
$row34=mysqli_fetch_row($qry34);
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $row[1]; ?></td> <!--ATM ID-->

<td><?php echo $row34[1]; ?></td>  <!--Vertical-->
<td><?php echo $row[4]; ?></td>   <!-- End User-->
<td><?php echo $row[6]; ?></td>   <!-- Area-->
<td><?php echo $row[5]; ?></td>   <!-- City-->
<td><?php echo $row[7]; ?></td>   <!-- Add-->
<td><?php echo $row[8]; ?></td>  <!-- State-->
<td><?php echo $row3[1]; ?></td>  <!-- Branch-->


<?php 
$errcnt = 0;
$error = '';
$tmb=date('Y-m-d 00:00:00', strtotime('-5 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));

$qry_his = "select alert_id, entry_date, call_status,status,alert_type,createdby from alert where atm_id='$row[0]' and entry_date > '".$ly."' order by alert_id DESC limit 5";
//echo $qry_his;

$sqlhis = mysqli_query($con1, $qry_his);
$rcnt = mysqli_num_rows($sqlhis);
$tmcnt = 0;
$stat=0;
if(mysqli_num_rows($sqlhis)>0 ){
while($rowe=mysqli_fetch_array($sqlhis))
{
    $eng=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$rowe[0]."' order by id DESC limit 1");
$engro=mysqli_fetch_row($eng);

$lastfeed = $engro[1]." : ".$engro[0];

if($rowe[1]>$tmb)$tmcnt++;

//echo "call_status".$rowe[2]."-status-".$rowe[3]."-created-".$rowe[5];

if($rowe[2]!='Done' && $rowe[2]!='Rejected' && $rowe[3]!='Done') {
$stat=1; }

}

if($stat==1){
    $errcnt++;
    $error.="Still Call is in Open";
   
} else if($rcnt >5){
    $errcnt++;
    $error.="repeated_failure of 5 times in a year. ";
   
} else if($tmcnt > 0){
   $errcnt++;
    $error.="call_closed within 5 days";
  
} else { $error = "You can Proceed"; }

} else { $error = "No History"; $lastfeed = "No History"; }

?>
<td><?php echo $error;; ?></td>

<td><?php echo $lastfeed; ?></td>

<?php
   ####======Start Logging=========
if($errcnt =='0') {
?>   
<td width="56" height="31">  <a href="javascript:confirm_generate('<?php echo $row[0]; ?>','<?php echo $site; ?>');" class="update"> Generate Call </a></td>
<?php } ?>

</tr>
<?php } ?>
</table>
