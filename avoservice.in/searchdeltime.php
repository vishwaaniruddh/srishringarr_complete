<?php
session_start();

include("access.php");
$strPage = $_REQUEST['Page'];

include("config.php");

function get_engg($id,$con1){
 
 $sql =mysqli_query($con1,"select engg_name from area_engg where engg_id='".$id."'");
 $sql_result =mysqli_fetch_assoc($sql);
 
 return $sql_result['engg_name'];
}


$count=0;
$sql="Select * from alert where branch_id <>''";
if(isset($_POST['calltype']))
{
$calltype=$_POST['calltype'];
if($calltype=='')
{
}

elseif($calltype=='inst')
$sql.=" and (alert_type = 'new')";

elseif($calltype=='service')
//$sql.=" and (alert_type = 'new')";
$sql.=" and alert_type in('service', 'new temp')";// `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($calltype=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";

}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
$sql.=" and (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') ))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";

}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}
if(isset($_POST['st']) && $_POST['st']!='')
{
$state=$_POST['st'];
$sql.=" and branch_id='".$state."'";
}
 
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
if(isset($_POST['docket']) && $_POST['docket']!='')
{
$docket=$_REQUEST['docket'];
$sql.=" and custdoctno LIKE '%".$docket."%'";
}
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];;
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')+ INTERVAL 1 DAY";
}

if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}
$sqlr = $sql;
// echo $sql."<br>";

//$table=mysqli_query($con1,$sql);

$countsql=str_replace("Select *","Select count(*) as count",$sql);
$countrow=mysqli_query($con1,$countsql);
$rows=mysqli_fetch_assoc($countrow);
$Num_Rows=$rows['count'];
//echo $sql."/br>";
//echo $countsql."/br>";
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
 </select>
 
 </div>
 <?php
 //echo "Total Records :<b>".$Num_Rows."</b>";
########### pagins

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
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

?>

<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="">


<th width="77">Complaint No</th>
<th width="77">Customer Vertical</th>
<th width="75">Site /Sol/ATM Id</th>
<th width="75">End User</th>
<th width="125">Site Address</th>
<th width="75">Branch</th>

<th width="45">Problem</th>
<th width="45"> Alert Date</th>
<th width="45"> Call Status</th>
<th width="45">First Delegation Type</th>

<th width="10%">Present Del to </th>
<th width="45">First Delegation Time</th>

<th width="45">First Delegate to</th>
<th width="45">No. of Delegation</th>
<th width="45">Last Del Time</th>
<th width="45">Engr Reject Det</th>
<th width="45">Rejected by Engr</th>
<th width="3%">Log to Del Time</th>
<th width="3%">Time Duration to Delegate</th>

<!--<th width="45">Delegated IN</th>
<th width="75"> Delegated To</th>-->

<?php


if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
 //======Fetch ATM ID =========
 $is_qry = 0;
	if($row[21] ==  'amc' || $row[21] ==  'AMC') {
	    $is_qry = 1;
	    $atmquery="select atmid from Amc where amcid='".$row[2]."'";
	 //  echo $atmquery; 
   } elseif($row[21] == 'site') {
       $is_qry = 1;
       
	    $atmquery="select atm_id from atm where track_id='".$row[2]."'";
	  
	} 
	
	if($is_qry==1){
	    $atm=mysqli_query($con1,$atmquery);
    
        	$atmrow=mysqli_fetch_row($atm);
        	$atm_id=$atmrow[0];
    	 } else{ 
    	    $atm_id=$row[2];
	    
	} 
//===============Cutsomer===========
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
//============Updates=========	
//	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
//	$row1=mysqli_fetch_row($tab);
	?>
<tr>

<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $atm_id;  ?></td>

<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>

<td valign="top"><? echo $row[5]; // Address  ?></div></td>
<!--================Branch show here==================-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);
echo  $branch_name1[0] ?></td>

<!---==================Problem ============-->
<td  valign="top"><?php echo $row[9];  ?></td>

<!---==================Alert date ============-->
<td valign="top"><?php echo $row[10];?></td>
<?php
if($row[15]=='Done' or $row[16]=='Done' ) { $stat="Closed"; }
elseif($row[16]=='Rejected') { $stat="Rejected"; }
elseif($row[16]=='onhold') { $stat="on Hold"; }
else { $stat="Pending"; } ?>
<td valign="top"><?php echo $stat;?></td>


<!---==================Delegation Tracking ============-->
<?php
$del_trqry=mysqli_query($con1,"select * from `Delegation_tracking` where `alertid`='".$row[0]."'");
if(mysqli_num_rows($del_trqry)>0){
$del_track=mysqli_fetch_row($del_trqry);
if($del_track[2] == 1){ $del_type ="GPS";}
elseif($del_track[2] == 2){ $del_type ="History";}
elseif($del_track[2] == 3){ $del_type ="Database";}
}else { $del_type ="Manual";}
?>
<td  valign="top"><?php echo $del_type ?></td>
<?

$tot_del = 0;
$first_eng = '';
$curr_engr ='';
$first_deltime = '';
$last_del = '';


$curr_delqry=mysqli_query($con1,"select * from `alert_delegation` where `alert_id`='".$row[0]."'");
if(mysqli_num_rows($curr_delqry)>0){
    $tot_del =mysqli_num_rows($curr_delqry);
$curr_delto=mysqli_fetch_row($curr_delqry);
$curr_engr = $curr_delto[1];
$first_deltime= $curr_delto[5];
$tot_del = 1;
} else {
    $curr_engr = "Pending";
    $first_deltime = "Pending";
    $last_del = "Pending";
}
?>
<td  valign="top"><? echo get_engg($curr_engr,$con1) // Current engr ?></td>
<td  valign="top"><? echo $first_deltime ?></td>
<?
if($row[24] != 0){
echo "select * from `alert_redelegation` where `alert_id`='".$row[0]."' and created_at < '".$row[24]."' order by id DESC</br>";
$redl_delqry=mysqli_query($con1,"select * from `alert_redelegation` where `alert_id`='".$row[0]."' and created_at < '".$row[24]."' order by id DESC");
} else {
    echo "select * from `alert_redelegation` where `alert_id`='".$row[0]."' order by id DESC"; 
   $redl_delqry=mysqli_query($con1,"select * from `alert_redelegation` where `alert_id`='".$row[0]."' order by id DESC </br>"); 
}
if(mysqli_num_rows($redl_delqry) >0 ) {
$delcnt = mysqli_num_rows($redl_delqry);
$tot_del = $delcnt+1;


while ($all_del=mysqli_fetch_array($redl_delqry)) {
   $lst[] = $all_del[6];
    $all_oldeng = $all_del[1];
    $all_neweng = $all_del[2];
    $all_deltime = $all_del[6];
//$all_deldet =  get_engg($all_oldeng,$con1)." # ".get_engg($all_neweng,$con1)." # ".$all_deltime;
    }

$first_eng = $all_oldeng;
$last_del = reset($lst);
}
//print_r($last_del);
?>

<td  valign="top"><? echo get_engg($first_eng,$con1) // First engr ?></td>

<!--<td  valign="top"><? echo $all_deldet; // All del  ?></td> -->
<td  valign="top"><? echo $tot_del ?></td>

<td  valign="top"><? echo $last_del ?></td>

<? // =================Engr Reject

$rejqry=mysqli_query($con1,"select * from `rejectedcalls` where `alertid`='".$row[0]."' ");
if(mysqli_num_rows($rejqry) >0) {
 $rej=mysqli_fetch_row($rejqry);
 $rej_dt = $rej[4];
 $rej_by = get_engg($rej[3],$con1);
} else { $rej_dt = "No Reject"; $rej_by = "No Reject"; }
?>
<td><?php echo $rej_dt; ?></td>
<td><?php echo $rej_by; ?></td>
<? ////============Delegation =Duraion=====

$time1 = strtotime($row[10]); //entry date
$time2 = strtotime($last_del); // del date

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$hours = round($hours,0);
$minutes = round($minutes);

?>
<td><?php echo $row[10]." : ".$last_del; ?></td>
<td><?php echo $hours.":".$minutes; ?></td>

</tr>
<?php
} 
}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


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
</div>

<form name="frm" method="post" action="export_deltime.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 