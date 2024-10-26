<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$id="";
$cid="";
$bank="";
$city="";
$area="";

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="custtable" >
<tr>
<th width="5%">SN</th> 
<th width="7%">Customer Name</th>
<th width="7%">Bank Name</th>
<th width="5%">Docket No</th> 
<th width="7%">Address</th>
<th width="7%">Branch</th>
<th width="5%">ATM Id</th>
<th width="7%">Call Type</th>
<!--<th width="6%">Location</th>-->
<th width="8%">Call Log Time</th>
<th width="8%">Response Time</th>
<th width="8%">Call Close Time</th>
<th width="8%">Engineer Name</th>
<th width="25%">Final Remark</th>

<th width="8%">UPS Model</th>
<th width="8%">UPS Cap</th>
<th width="8%">UPS Qty</th>
<th width="8%">UPS Sl. No</th>
<th width="8%">Battery Details</th>
<th width="8%">Batt Qty</th>

<th width="8%">I/P L-N</th>
<th width="8%">I/P L-E</th>
<th width="8%">I/P N-E</th>
<th width="8%">O/P L-N</th>
<th width="8%">O/P L-E</th>
<th width="8%">O/P N-E</th>
<th width="8%">Charger Voltage</th>
<th width="8%">O/P Load</th>


</tr>
<?php
// $sql.="Select * from alert where  (call_status = 'Done' or status = 'Done') ";

$sql.="Select * from alert where 1 ";
//========================================for open and close call============
	if(isset($_POST['calltype'])){	
		$calltype=$_REQUEST['calltype'];
		if($calltype=='Done')
		{
		$sql.=" and (call_status = 'Done' or status = 'Done')";
		}
	}


//========================================for branch============

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_POST['branch'];
$sql.=" and branch_id =".$branch." ";
}

//=================for service and installation call============

if(isset($_POST['openall']))
{
	$calltype=$_REQUEST['openall'];
	
	if($calltype=='')
	{
	}
	elseif($calltype=='all')
	{
	}
elseif($calltype=='install')
$sql.=" and alert_type = 'new'";

elseif($calltype=='service' )
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and alert_type = 'pm'or `alert_type`='temp_pm')";


elseif($calltype=='dere')
$sql.=" and alert_type = 'dere'or `alert_type`='temp_dere')";
}


//========================================From Date to Date============
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

}


if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}

//echo $sql;

//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";

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

//echo $sql;

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
<td  valign="top" width="200">&nbsp;<?php echo $sn; ?></td>

<!--===Customer Name===-->
<td  valign="top">&nbsp;<?php 
$cuname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$row[1]."'");
$cuname1=mysqli_fetch_row($cuname);
echo $cuname1[0]; ?></td>

<!--===Bank Name===-->   
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>

<!--===Docket No===-->
<td  valign="top">&nbsp;<?php echo $row[25] ; ?></td>

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

<!--===ATM ID===-->

<?php

 if ($row[21] ==  'amc' || $row[21] ==  'AMC')
{
$atmid=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	//echo "select cat,atmid from Amc where amcid='".$row[2]."'";
}
elseif ($row[21] == 'site')
{
$atmid=mysqli_query($con1,"select atm_id from `atm` where `track_id`='".$row[2]."'");
//echo "select * from `atm` where `track_id`='".$row[2]."'";
	}
$atmid1=mysqli_fetch_row($atmid);
if ($atmid1[0]=='') $atmid1[0]= $row[2];
?>
<td  valign="top"> <?echo $atmid1[0]; ?></td>

<!--===Call type===-->   
<td  valign="top">&nbsp;<?php echo $row[17]; ?></td>

<!--===Call Log Time===-->
<td  valign="top">&nbsp;<?php echo date('d-m-Y h:i:s.a',strtotime($row[10])); ?></td>

<!--===Respons Time===-->
<td valign="top">&nbsp;<?php  echo date('d-m-Y h:i:s.a',strtotime($row[24])); ?></td>
<!--===Attend Call Time===-->

<!--===Call Close Time===-->
<td  valign="top">&nbsp;<?php  echo date('d-m-Y h:i:s.a',strtotime($row[18]));  ?></td>

 
<td>
<?php 
        $engtab=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
	$engrow=mysqli_fetch_row($engtab);
	$tab=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engrow[0]."'");
	//echo "select engg_name from area_engg where engg_id='".$engrow[0]."'";
	$row1=mysqli_fetch_row($tab);
	echo $row1[0];
?>
</td>

<td>
<?php 
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	echo $row1[0];
?>
</td>
<?
$fsrqry= mysqli_query($con1,"select * from FSR_details where alertid='".$row[0]."'");
$fsr=mysqli_fetch_row($fsrqry);
?>

<td  valign="top">&nbsp;<?php echo $fsr[3]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[4]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[5]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[6]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[7]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[8]; ?></td>

<td  valign="top">&nbsp;<?php echo $fsr[10]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[11]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[12]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[13]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[14]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[15]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[16]; ?></td>
<td  valign="top">&nbsp;<?php echo $fsr[17]; ?></td>

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
<form name="frm" method="post" action="export_callrep.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 