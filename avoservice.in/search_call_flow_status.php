<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
// class="res"
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable" >
<tr>
<th width="5%">Complain ID</th> 
<th width="5%">Customer Name</th>
<th width="5%">ATM</th>
<th width="5%">Bank</th>
<th width="5%">Address</th>
<th width="5%">Branch</th>
<th width="5%">Call Type</th>
<th width="5%"> Delegated To</th>
<th width="5%">Alert Date</th>
<th width="20%">Updates</th>
<th width="5%">Delegation Time</th>
<th width="5%">First Update by Engr</th>
<th width="5%">ETA Shared</th>
<th width="5%">Reached at Site</th>
<th width="5%">Left the site</th>
<th width="5%">Status</th>
<!--<th width="5%">GPS Records</th>
<th width="5%">Update</th>-->

</tr>
<?php


if(isset($_POST['state']) && $_POST['state']!='')
  	{ $stt=$_POST['state'];
   	$sql="Select * from alert where branch_id ='".$stt."' and cust_id !=96 ";
  	} 
  	else
   	$sql="Select * from alert where 1 and branch_id <>'' and cust_id !=96";

//======================================Search Call Type Wise 
if(isset($_POST['status']))
{
$status=$_REQUEST['status'];
if($status=='')
{
}
elseif($status=='open')
$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done'";
elseif($status=='Done')
$sql.=" and (call_status = 'Done' or status = 'Done') ";
elseif($status=='onhold')
$sql.=" and call_status = 'onhold'";
elseif($status=='Rejected')
$sql.=" and call_status = 'Rejected'";
}
//======================================Search Call of open , close, tem, new tem etc.
if(isset($_POST['call_type']))
{
$calltype=$_REQUEST['call_type'];
if($calltype=='')
{
}
elseif($calltype=='all')
{
}

elseif($calltype=='new')
$sql.=" and (alert_type = 'new')";

elseif($calltype=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($calltype=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";

}

//======================================Search Call eng wise
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
$eng_alert=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$eng."'");

$all_alid=array();
while($eng_alert1=mysqli_fetch_row($eng_alert)){
         //echo $eng_alert1[0];
	 $all_alid[]=$eng_alert1[0];
}
$alert_string = implode(",",$all_alid);
if($eng !='-1' && $eng !='-2')
$sql.=" and alert_id in ($alert_string)";
else if($eng =='-1')
$sql.=" and alert_id not in (select alert_id from alert_delegation )";

elseif($eng =='-2')
$sql.=" and alert_id not in (select alert_id from eng_feedback )";
}
//======================================Search Call Date wise
	$fromdt=$_POST['fromdt'];
	$todt=$_POST['todt'];
	
	$start_date=$fromdt;
	$end_date=$todt;
	
//	echo $fromdt."  To Date:".$todt;


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){

	if($_POST['status']=='Done'){
	$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
	$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
	$sql.=" and close_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";
		}
	elseif($_POST['status']=='Rejected'){
	$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
	$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
$sql.=" and reject_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";
	} 
	else{
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
	}	

}
//======================================Search ATM ID Wise
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
 
$sql.=" and (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') ))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
//======================================Search 
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}
 //======================================Search
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}

//=====================================Search
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}

$countsql=str_replace("Select *","Select count(*) as count",$sql);

//echo $countsql;

$countrow=mysqli_query($con1,$countsql);

$rows=mysqli_fetch_assoc($countrow);
$Num_Rows=$rows['count'];

 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
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

//echo $sql;
$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{

	include("config.php");
	
	if($row[17]=='service' &&  $row[21] ==  'amc')
    $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='service' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
    $atmrow=mysqli_fetch_row($atm);
    $atm_id=$atmrow[0];
    if($atm_id=='') { $atm_id=$row[2];}

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);
	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } ?>>
<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top"><?php echo $custrow[0]; ?></td>
<td  valign="top"><?php echo $atm_id; ?></td>
   
<td  valign="top"><?php echo $row[3]; ?></td>
<td valign="top"><?php  $brtxt= preg_replace("/[^\p{Latin} ]/u", "", $row[5]); echo  $brtxt1=wordwrap($brtxt ,10,"<br />\n",TRUE); ?></td>


<td  valign="top">
<?php 
$brqry=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
$br=mysqli_fetch_row($brqry);
echo $br[0]; ?> </td>
<td  valign="top">
<?php 
if($row[17]=='service' or $row[17]=='new temp') { echo "Service";}
if($row[17]=='pm' or $row[17]=='temp_pm') { echo "PM Call";}
if($row[17]=='dere' or $row[17]=='temp_dere') { echo "De-Re Call";}
if($row[17]=='new') { echo "inst Call";}
 ?> </td>

<?php
$oldeng=mysqli_query($con1,"select engineer, date from alert_delegation where alert_id='".$row[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select engg_name,engg_id from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
?>
<td  valign="top"> <?php echo $getoldname[0]; // eng Name  ?></td>

<td valign="top"><?php echo $row[10];?></td>

<td valign="top">
<?php if($row1[0]!=''){ 
?><a class="update" href="#" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display')" ><?php echo wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php }else{ echo "No Updates So far"; } ?>
</td>
<td> <? echo $getold[1];  // Del Date?> </td>
<?

$qrytime=mysqli_query($con1,"select feed_date from eng_feedback where `alert_id`='".$row[0]."' order by id ASC LIMIT 1");

$qrytime1=mysqli_fetch_row($qrytime);
?>
<td><div style="height:150px; width:50px; overflow:hidden;"> <?php echo $qrytime1[0]; ?> </div?</td>

<td><?php echo $row[31];// ETA time ?> </td>

<td><?php echo $row[24];// rEACH ?> </td>
<td><?php echo $row[18];// Left time ?> </td>

<? if($row[16]=='onhold'){ $sttus ="Call on Hold";}  
else if($row[16]=='Rejected'){ $sttus ="Rejected";} 
else if($row[16]=='Done' or $row[15]=='Done' ){ $sttus ="Closed";}
else { $sttus ="Open";}
?>
<td><? echo $sttus ?> </td>
<?php

//$dt2= "select count(id) As count from Location where engg_id= '".$getoldname[1]."' and dt between STR_TO_DATE('$start_date','%d/%m/%Y') AND STR_TO_DATE('$end_date','%d/%m/%Y') + INTERVAL 1 DAY group by engg_id" ;
//echo $dt2;

//$qry3= mysqli_query($con1,$dt2) ;
//$rec_cnt= mysqli_fetch_assoc($qry3);

//$cnt=$rec_cnt['count'];
//if($cnt==''){ $cnt="Dates not selected";}
?>
 
</tr>
<?php
}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="export_callflow.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 