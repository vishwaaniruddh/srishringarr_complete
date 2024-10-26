<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";

$strPage = $_REQUEST['Page'];
$engg=$_POST['Employee_name'];


?>
<table width="120%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="custtable" >
<tr>
<th width="2%">SN</th> 
<th width="4%">Docket No</th> 
<th width="4%">Call Log Date</th> 
<th width="5%">Site / ATM Id</th>
<th width="4%">Customer Name</th>
<th width="5%">Bank Name</th>

<th width="7%">Address</th>
<th width="3%">Branch</th>


<th width="3%">Call Type</th>
<!--<th width="6%">Location</th>-->
<th width="5%">Call Log Time</th>
<th width="5%">Engineer Name</th>
<th width="5%">Delegation Time</th>
<th width="5%">Call Status</th>
<th width="5%">Hold Time if Hold</th>
<th width="5%">Un-Hold Time</th>
<th width="5%">Last site visit</th>
<th width="5%">Problem Type</th>
<th width="10%">Updates</th>

</tr>
<?php
 $sql.="Select * from alert where branch_id <>'' and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated' or call_status='onhold') and status != 'Done'  and  responsetime !='0000-00-00 00:00:00' ";

if(isset($_POST['type']) && $_POST['type']!='')
{
$type=$_POST['type'];

if($type=='service') {
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";    
} elseif ($type=='new') {
$sql.=" and alert_type = 'new'";    
} elseif ($type=='de_re') {
$sql.=" and (alert_type = 'dere' or `alert_type`='temp_dere')";    
} elseif ($type=='pm') {
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";    

}
}

if(isset($_POST['cust']) && $_POST['cust']!='')
{
$cust=$_POST['cust'];
$sql.=" and cust_id =".$cust." ";
}

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_POST['branch'];
$sql.=" and branch_id =".$branch." ";
}

if(isset($_POST['prob']) && $_POST['prob']!='')
{
$prob=$_POST['prob'];
$probqr=mysqli_query($con1,"select * from problemtype where prob_group='".$prob."'");

$pr=array();
while($prow=mysqli_fetch_array($probqr))
    $pr[]=$prow[0];
    
    $ccl=implode(",",$pr);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    
$siteq=mysqli_query($con1,"select alertid from siteproblem where probid in($ccl)");
$sitrow=mysqli_fetch_row($siteq);

$sql.=" and alert_id in ('".$sitrow[0]."')";

//$sql.=" and alert_id in(select alertid from siteproblem where probid in ($ccl)";

}

//echo $sql;

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
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


$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;


$table=mysqli_query($con1,$sql);


if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))

{

	include("config.php");
	
		?>
<tr>
<!--===SN===-->
<td  valign="top" >&nbsp;<?php echo $sn; ?></td>

<!--===Docket No===-->
<td  valign="top">&nbsp;<?php echo $row[25] ; ?></td>

<td  valign="top">&nbsp;<?php echo $row[10] ; ?></td>

<!--===ATM ID===-->
<td  valign="top">&nbsp;<?php
//echo "select * from `atm` where `track_id`='".$row[2]."'"; 
if($row[21] ==  'amc' || $row[21] ==  'AMC')
{
$atmid=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	//echo "select atmid from Amc where amcid='".$row[2]."'";
}
elseif($row[21] == 'site')
{
$atmid=mysqli_query($con1,"select atm_id from `atm` where `track_id`='".$row[2]."'");
//echo "select * from `atm` where `track_id`='".$row[2]."'";
	}
$atmid1=mysqli_fetch_row($atmid);
if ($atmid1[0] !='') { echo $atmid1[0];} else echo $row[2]; ?>

</td>

<!--===Customer Name===-->
<td  valign="top">&nbsp;<?php 
$cuname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$row[1]."'");
$cuname1=mysqli_fetch_row($cuname);
echo $cuname1[0]; ?></td>

<!--===Bank Name===-->   
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>

<!--===Address===-->   
<td  valign="top">&nbsp;<?php echo $row[5]; ?></td>


<!--===Branch===-->   
<td  valign="top">&nbsp;
<?php
$branch_qry=mysqli_query($con1,"select * from avo_branch where id='".$row[7]."'");
$branch_row=mysqli_fetch_array($branch_qry);
echo $branch_row['name'];
?>
</td>

<!--===Call type===-->   

<td  valign="top">&nbsp;<?php echo $row[17]; ?></td>

<!--===Location===-->   
<!--<td  valign="top">&nbsp;<?php echo $row[6]; ?></td>-->
<!--===Call Log Time===-->
<td  valign="top"><?php echo $row[10]; ?></td>

<td valign="top">
<?php 
        $engtab=mysqli_query($con1,"select engineer, date from alert_delegation where alert_id='".$row[0]."'");
	$engrow=mysqli_fetch_row($engtab);
	$tab=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engrow[0]."'");
	//echo "select engg_name from area_engg where engg_id='".$engrow[0]."'";
	$row1=mysqli_fetch_row($tab);
	echo $row1[0];
?>
</td>
<!--   ========== Del time=========== -->
<td valign="top">
    <? 	echo $engrow[1]; ?>
    
</td>

</td>
<!--   ========== Call Statuse=========== -->
<td valign="top">
    <? if( $row[16]=='onhold') {echo "Hold Call"; } else echo "Open Call" ?>
    
</td>

<!--   ========== Hold time=========== -->
<?php 
    $unhold=mysqli_query($con1,"SELECT * FROM `alert_hold_unhold` where alert_id='".$row[0]."'");
	$hrow=mysqli_fetch_row($unhold);
	?>

<td valign="top"> <? echo $hrow[2]; ?> </td>

<td valign="top"> <? echo $hrow[3]; ?> </td>

<!--===Respons Time===-->
<td valign="top"><?php  echo $row[24]; ?></td>

<!--===Problem Type===-->


<td valign="top">
<?
$prqry=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
$prow=mysqli_fetch_row($prqry);
echo $prow[3]; ?>
</td>


<td>
<?php 
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC LIMIT 1");
	$row1=mysqli_fetch_row($tab);
	echo $row1[0];
?>
</td>

</tr>
<?php

	$sn++;}
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
<form name="frm" method="post" action="export_spare_dep.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>


<div id="bg" class="popup_bg"> </div> 