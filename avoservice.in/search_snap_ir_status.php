<?php
session_start(); 
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="3%">S.N.</th> 
<th width="25%">Engineer Name</th>
<th width="10%">Desination</th>
<th width="10%">Branch</th>
<th width="10%">Call Ticket</th>

<th width="10%">Customer</th>
<th width="10%">Site / ATM Id</th>
<th width="10%">End User</th>
<th width="10%">Address</th>
<th width="10%">Call Closed Time</th>
<th width="10%">IR status</th>
<th width="10%">IR Uplaoded Time</th>

<th width="10%">Snap Status</th>
<th width="10%">Snap Uploaded Time</th>

<?php

    $branch=$_POST['branch_avo'];

$ii=1;


 $sql="Select * from alert where (status='Done' or call_status='Done')";
 $sql.=" and alert_type = 'new'";
  
 if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ 
 $sql.=" and branch_id='".$branch."'";
	}

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
} else{
$frmdt=date('Y-m-d');
$todt=date('Y-m-d');
}
$sql.=" and close_date between '".$frmdt." 00:00:00' and '".$todt." 23:59:59'";


if(isset($_POST['engg']) && $_POST['engg']!='')
{
$eng=$_POST['engg'];
$eng_alert=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$eng."'");

$all_alid=array();
while($eng_alert1=mysqli_fetch_row($eng_alert)){
        
	 $all_alid[]=$eng_alert1[0];
}

$alert_string = implode(",",$all_alid);
$sql.=" and alert_id in ($alert_string)";

}

$countsql=str_replace("Select *","Select count(*) as count",$sql);
$countrow=mysqli_query($con1,$countsql);

$rows=mysqli_fetch_assoc($countrow);
$Num_Rows=$rows['count'];
$count=0;
//$Num_Rows = mysqli_num_rows($table);
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
 </select> </div>
  
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

// echo $sql;

$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";


//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
// include("config.php");
while($row= mysqli_fetch_row($table))
{
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.engg_desgn, e.engg_id from area_engg e,alert_delegation d where e.engg_id=d.engineer and d.alert_id='".$row[0]."' order by d.id DESC");
if(mysqli_num_rows($fetchengid)>0){
    $getoldname=mysqli_fetch_row($fetchengid);
    $engg_name = $getoldname[0];
    $design = $getoldname[1];
    $engg_id = $getoldname[2];
}

$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);

$site_idqr=mysqli_query($con1,"select `atm_id` from `atm` where `track_id`='".$row[2]."'");
$site_id=mysqli_fetch_row($site_idqr);
?>
<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="center"><?php echo $engg_name; ?></td>
<td  valign="center"><?php echo $design; ?></td>
<td  valign="center"><?php echo $branch_name1[0]; ?></td>

<td  valign="center"><?php echo $row[25]; ?></td>
<td  valign="center"><?php echo $custrow[0]; ?></td>
<td  valign="center"><?php echo $site_id[0]; ?></td>

<td  valign="center"><?php echo $row[3]; ?></td>
<td  valign="center"><?php echo $row[5]; ?></td>

<td  valign="center"><?php echo $row[18]; ?></td>
<?
if($row[44]==''){ $ir_st="Pending"; $ir_d='';} 
else {
    $ir_st="Done";
$ir_qry=mysqli_query($con1,"select `upload_time` from `fsr_upload_time` where `alert_id`='".$row[0]."'");
$ir_date=mysqli_fetch_row($ir_qry);
$ir_d=$ir_date[0];

}
?>
<td  align="center"><?php echo $ir_st; ?> </td>
<td  align="center"><?php echo $ir_d; ?> </td>
<?
if($row[41]==''){ $snap_st="Pending"; $snap_d='';} 
else {
    $snap_st="Done";
$sanp_qry=mysqli_query($con1,"select `created_at` from `snap_inst` where `alert_id`='".$row[0]."'");
$snap_date=mysqli_fetch_row($sanp_qry);
$snap_d=$snap_date[0];

}
?>
<td  align="center"><?php echo $snap_st; ?> </td>
<td  align="center"><?php echo $snap_d; ?> </td>

</tr>
<?php $ii++;    
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

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="export_ir_snap_status.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(Max 500 Records)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 

