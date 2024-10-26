<?php
session_start();  
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

$branch=$_POST['branch_avo'];

?>
<table width="105" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="2" >Branch Name</th>
<th rowspan="2" >Live Pend Delegation</th>
<th rowspan="2" >Live ETA Pending</th>

<th colspan="2" width="30%" style="text-align:center">Delegation</th>
<th colspan="2" width="30%" style="text-align:center">ETA By Engineer</th>


</tr>
<tr><th>Within 24 Hrs</th><th>Out of 24 Hrs</th><th>Within 24 Hrs</th><th>Out of 24 Hrs</th></tr>
<?php



$frm=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$to=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));





$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;		

$intot=0; $outtot=0; $ptot=0; $etcnt=0; $ettot=0;
		
$branch_=mysqli_query($con1,"select * from `avo_branch` order by name ASC ");

while($branch1=mysqli_fetch_array($branch_))
{
		$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;
		$pcnt=0; $etcnt=0;
//========== Only Installation calls = First delegation time and engineer =================

$qrybreta=mysqli_query($con1,"select alert_id, entry_date from alert where alert_type='new' and entry_date between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$branch1[0]."' ");	

//echo "select alert_id, entry_date from alert where alert_type='new' and entry_date between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$branch1[0]."' and (call_status !=1 and status !='Pending') ";

$penqry=mysqli_query($con1,"select count(*) as count from alert where alert_type='new' and branch_id='".$branch1[0]."' and call_status not in ('Rejected','Done') and  alert_id NOT IN(select alert_id from alert_delegation) ");	

$prow=mysqli_fetch_assoc($penqry);
$pcnt=$prow['count'];

$etqry=mysqli_query($con1,"select count(*) as count from alert where alert_type='new' and branch_id='".$branch1[0]."' and call_status not in ('Rejected','Done') and  alert_id NOT IN(select alert_id from eng_feedback) ");	

$etrow=mysqli_fetch_assoc($etqry);
$etcnt=$etrow['count'];


while($alert=mysqli_fetch_array($qrybreta))
{
//========== Delegation==========
$delqry=mysqli_query($con1,"select date from alert_delegation where alert_id='".$alert[0]."' order by id ASC limit 1");
//echo "select date from alert_delegation where alert_id='".$alert[0]."' order by id ASC limit 1"; 

$result=mysqli_fetch_array($delqry);
$ddate= date('Y-m-d H:i:s', strtotime( "$alert[1] + 1 day" ));

if($result[0] <= $ddate)
{
$incnt++;

} else {
$outcnt++;
}
//====================ETA Shared time===========

$feedqry=mysqli_query($con1,"select feed_date from eng_feedback where alert_id='".$alert[0]."' order by id ASC limit 1");
$erow=mysqli_fetch_array($feedqry);
$edate= date('Y-m-d H:i:s', strtotime( "$alert[1] + 1 day" ));

if($erow[0] <= $edate)
{  $incnt1++; 
} else { $outcnt1++; }

}

		?>		
<tr>
<!--=== Branch name ===-->
<td  valign="top">&nbsp;<?php 
echo $branch1[1];
 ?></td>

<td  valign="top"><?php $ptot+=$pcnt; echo $pcnt;  ?></td>
<td  valign="top"><?php $ettot+=$etcnt; echo $etcnt;  ?></td>

<!--===Delegation===-->   
<td  valign="top"><?php $intot+=$incnt; echo $incnt;  ?> </td>
<td  valign="top"><?php $outtot+=$outcnt; echo $outcnt;  ?></td>


<!--===Time of ETA sharing===-->   
<td  valign="top"><?php $intot1+=$incnt1; echo $incnt1; ?></td>
<td  valign="top"><?php $outtot1+=$outcnt1; echo $outcnt1; ?></td>


</tr>

<?php } ?>

<tr>
<td>Grand Total</td><td><? echo $ptot; ?></td> <td><? echo $ettot; ?></td> <td><? echo $intot; ?></td><td><? echo $outtot; ?></td><td><? echo $intot1; ?></td><td><? echo $outtot1; ?></td>     
</tr>
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
//==============================customer wise========================================================
 }else{ ?>
<tr>
<th rowspan="2" ">Engineer Name</th> 
<th rowspan="2" ">Branch Name</th> 

<th colspan="2" width="35%" style="text-align:center">ETA Shared Time from Call log time</th>

</tr>
<tr><th>Within 24 Hrs</th><th>Above 24 Hrs</th></tr>
<?php

 $sql ="SELECT engg_id,engg_name, area, loginid FROM `area_engg` where area='".$branch."' and deleted=0 and status=1";
 

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

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
$sql.=" LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);


$frm=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$to=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));


while($row= mysqli_fetch_array($table))
{$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;

$qrybreta=mysqli_query($con1,"select alert_id, entry_date, branch_id from alert where alert_type='new' and entry_date between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$row[2]."' ");	

//echo "select alert_id, entry_date, branch_id from alert where alert_type='new' and entry_date between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$row[2]."' ";



while($alert=mysqli_fetch_array($qrybreta))
{
//========== ETA============

$delqry=mysqli_query($con1,"select feed_date from eng_feedback where alert_id='".$alert[0]."' and engineer='".$row[3]."' order by id ASC limit 1");

//echo "select feed_date from eng_feedback where alert_id='".$alert[0]."' and engineer='".$row[3]."' order by id ASC limit 1";

while ($result=mysqli_fetch_array($delqry))
{
$ddate= date('Y-m-d H:i:s', strtotime( "$alert[1] + 1 day" ));

if($result[0] <= $ddate)
{
$incnt++;

} else {
$outcnt++;
}

}

}
 ?>
<tr>
<td  valign="top">&nbsp;
<?php echo $row[1];
 ?>
</td>
<!--=== Branch name ===-->
<td  valign="top">&nbsp;<?php $brqry=mysqli_query($con1,"select * from `avo_branch` where id='".$branch."'");
$branch1=mysqli_fetch_row($brqry);
echo $branch1[1];  ?></td>

<!--===Service Call===-->   
<td  valign="top"> <?php echo $incnt; ?> </td>
<td  valign="top"> <?php echo $outcnt; ?></td>


</tr>

<?php 	} ?>


</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


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
	 	 	 
	 }
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 