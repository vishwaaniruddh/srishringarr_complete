<?php
 session_start();
include 'config.php';
include("access.php");

$fix=25;
$BatteryVendorName=$_POST['BatteryVendorName'];
$Customer_Name=$_POST['Customer_Name'];
$branch=$_POST['branch'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
//$fromdate=date("Y-m-d",str_replace("/","-",$_POST['fromdate']));
//$todate=date("Y-m-d",str_replace("/","-",$_POST['todate']));
$sta=$_POST['calltype'];
$tkt=$_POST['tktno'];
$atmid=$_POST['atmid'];
//echo $tkt;

//echo $fromdate;
//echo $todate;

$brch=mysqli_query($con1,"select name from avo_branch where id='".$_SESSION['branch']."'");

$brname=mysqli_fetch_array($brch);
$brme=explode('&',$brname[0]);
$brne=$brme[0];

$strPage=$_POST['Page'];

if($_SESSION['branch']=="all"){
$abc="select * from BRF_form where 1 ";
} else{
$abc="select * from BRF_form where Branch LIKE '%".$brne."%' ";
//echo $abc;
    
}
if($sta!="") {
if($sta!="0"){
$abc.=" and statu='".$sta."'";
 
}
else{
$abc.=" and (statu='0' or statu='')";
 
}
}
if($BatteryVendorName!=""){
$abc.=" and Battery_Vendor like'%".$BatteryVendorName."%'";
 
}


if($atmid!=""){

$abc.=" and ATM_ID like'%".$atmid."%'";
 
}

if($Customer_Name!=""){
$abc.=" and Customer_Name like'%".$Customer_Name."%'";
}
if($tkt!=""){
$abc.=" and Call_Ticket like '%".$tkt."%'";
}

if($branch!=""){
$abc.=" and Branch='".$branch."'";
}

//echo $abc;
if($fromdate && $todate!=""){
//$abc.=" and date(createtime)='".$newDate."'";
$abc.=" and date(CallAlertDate) between '".$fromdate."' and '".$todate ."' ";
}
$abc.="order by CallAlertDate DESC";

//echo $abc;
$result=mysqli_query($con1,$abc);
$Num_Rows=mysqli_num_rows($result);

$Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$abc.=" LIMIT $Page_Start , $Per_Page";

//echo $abc;	
$qrys=mysqli_query($con1,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	// echo "ram".($Page_Start* $Page)-$Page_Start;
	   // echo $fix."-".$Page."-".$fix;
	//   $sr=($Page_Start* $Page)-$Page_Start;
	  $sr=($fix* $Page)-$fix;
	  
	   $sr=$sr+1;
	}


  
   ?> 
   
<html>
<head>

</head>

<style>
.space{margin-left:80px;}
.addcolor{font-size:20px; color:#C60000; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
</style>

<body>
<Form>
<center>



<div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>

<!--=================================================-->
 Records Per Page :<select name="perpg" id="perpg" onchange="a('1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%25==0)
 {

 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 
<!--=================================================-->


</div>

  <table border="1" style="margin-top:30px"  width="100%">
  <tr>
      
         <th>Sr</th>
     <!-- <th>Service Call Alert No</th>-->
    <th>Avo Ticket Date</th>
    <th>Created Date</th>
    <th>Branch Name</th>
    <th>Service Call Ticket No:</th>
    <th>Battery Vendor Name</th>
    <th>Installation Date</th>
    <th>Battery Expiry Date</th>
	<th>Site / Sol / ATM Id</th>   
    <th>Customer Name</th>
    <th>Address</th>
    <th>No. Of Batteries Faulty</th>
    <th>Battery Rating AH</th>
    <th>Battery batch Codes</th>
    <th>Contact Person Name</th>
   <th>Contact person Number</th>
   <!--<th>Mail sent to</th>-->
<th>Vendor Ticket No</th>
<th>Vendor Tkt Date</th>
<th>Completed Date</th>
<!--<th>Status</th>-->
<th>No. Of Batteries Replaced</th>
    
    <th>View BRF</th>
     <th>View Battery Details</th>
    <th>Comments</th>
    <th>Edit</th>
   <th>Updates</th>

  </tr>

  <?php  while($row = mysqli_fetch_array($qrys)) {
  
  $result3=mysqli_query($con1,"select * from UpdateStatus where brf_id='$row[0]' order by currentdate desc limit 1 ");
$fetchBrf_id=mysqli_fetch_array($result3);

   ?>
  
 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <!--<td><?php echo $row[""];?></td>-->
    <td><?php echo $row["CallAlertDate"];?></td>
    <td><?php echo $row["created_at"];?></td>
    <td><?php echo $row["Branch"];?></td>
    <td><?php echo $row["Call_Ticket"];?></td>
    <td><?php echo $row["Battery_Vendor"];?></td>
    <td><?php echo $row["inst_date"];?></td>
    <td><?php echo $row["exp_date"];?></td>
    <td><?php echo $row["ATM_ID"];?></td>	
    <td><?php echo $row["Customer_Name"];?></td>
    <td><?php echo $row["Address"];?></td>
    <td><?php echo $row["No_ofbatteriesfoundSuspected"];?></td>
    
    <td><?php echo $row["BatteryRating_AH"];?></td>
<td width ="50">    
<?php $batchqry= mysqli_query($con1,"Select BatterySerialNo from BRF_details where Brf_id = '".$row["Brf_id"]."'");
while($batch = mysqli_fetch_array($batchqry)) {
    echo $batch[0].", ";
} ?>
</td>
<td><?php echo $row["ContactPersonName"];?></td>
    <td><?php echo $row["ContactpersonNumber"];?></td>
    <!--<td><?php echo $row["caller_email"];?></td>-->

<td><?php echo $row["VendorTicketNo"];?></td>
<td><?php echo $row["VendorTktDate"];?></td>
<td><?php echo $row["CompletedDate"];?></td>
<!--<td><?php echo $row["Status1"];?></td>-->
<td><?php echo $row["BatteriesReplaced"];?></td>

   <td><a href="createbrf_view.php?brf_id=<?php echo $row["Brf_id"];?> ">&nbsp;<font color="red" >view</font></a> </td>
 <!--   <td><a href="createbrf_moreview.php?brf_id=<?php echo $row["Brf_id"];?> "><font color="blue" >View Battery Details</font></a> </td>-->
    <td><a href="#" onClick="window.open('battfail_det.php?id=<?php echo $row["Brf_id"]; ?>','view_batt','width=500px,height=400,left=400,top=300')"><font color="blue" > View Battery Details</a></font></td>
<?php

?>
   <td><?php echo $fetchBrf_id[1];?></td>

<?php if($row['statu']=="0" || $row['statu']=="" ) {   ?>
  
   <td>
<a href="Edit_brfform.php?ticketno=<?php echo $row["Call_Ticket"];?> ">&nbsp;<font color="red" >Edit</font></a></td>
<!-- <td><a href="statusupdate.php?pid=<?php echo $row[25];?>&cust=<?php echo $row5['cust_name'];?>&branch=<?php echo $row6['badd'];?>" >&nbsp;<font color="red" >Create/BRF</font></a>-->
<!--<td><a href="statusupdate.php?custnum=<?php echo $row["Brf_id"];?>">&nbsp;<font color="red">update</font></a> </td>-->
<td>
<a onclick="window.open('statusupdate.php?BRF_id=<?php echo $row["Brf_id"];?>', '_blank', 'location=yes,height=570,width=520,left=400,scrollbars=yes,status=yes');">
  Update</a></td>
<?php }  ?>
   </tr>

   <?php
$sr++;
  ?>
<?php } ?>

</table>

 <?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

?>
</form>
</body>
</html>







