<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">ATM ID</th> 
<th width="5%">Cust Name</th>
<th width="5%">Bank</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="5%">Address</th>
<th width="5%">State</th>
<th width="5%">Branch</th>

<th width="5%">UpsCapacity</th>
<th width="5%">UpsStatus</th>
<th width="5%">Battery Qty</th>
<th width="5%">Battery AH</th>
<th width="5%">Battery Make</th>
<th width="5%">Backup Observed</th>
<th width="5%">Weak Qty</th>
<th width="5%">Eng ID</th>
<th width="5%">Update Time</th>

<th width="5%">Latitude </th>

<th width="5%">Longitude</th>

</tr>
<?php


//======================================== Search Branch wise
if($_POST['bravo']=='all')
	{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']=='' )
  	{ $stt=$_POST['branch_avo'];
   	$sql.="Select * from Pmcalls where 1 ";
  	} 
  	else
   	$sql.="Select * from Pmcalls where 1 and branch_id ='".$_POST['branch_avo']."'";
}else{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
   	$sql.="Select * from alert_customer where branch_id ='".$stt."' ";
  	} 
  	else
	$sql.="Select * from alert_customer where branch_id='".$br1."' ";
	}
	
//=================================== Branch wise
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and `state1`='".$state."'";
}	
	
//======================================Search Call Type Wise 
if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='')
{
}
elseif($calltype=='open')
$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and atm_id<>'temp_'";
elseif($calltype=='Done')
$sql.=" and call_status = 'Done'";
elseif($calltype=='onhold')
$sql.=" and call_status = 'onhold'";
elseif($calltype=='Rejected')
$sql.=" and call_status = 'Rejected'";
}
//======================================Search Call of open , close, tem, new tem etc.
if(isset($_POST['openall']))
{
$calltype=$_REQUEST['openall'];
if($calltype=='')
{
}
elseif($calltype=='all')
{
}
//$sql.=" and (alert_type = 'service' or alert_type='new' or `alert_type`='new temp')";
elseif($calltype=='install')
$sql.=" and (alert_type = 'new')";

elseif($calltype=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($calltype=='dere')
$sql.=" and `alert_type`='dere' ";

elseif($calltype=='W2PCB')
$sql.=" and `alert_type`='w2pcb' ";

}

//======================================Search Call eng wise
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];

$sql.=" and engid ='".$eng."'";

}
//======================================Search Customer wise
/*if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];

$sql.=" and atmid in(select atmid from amc where cid ='".$cid."')";

}*/

//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and `Uptime` between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";
	
	
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}


//echo $sql;
//echo "Select * from alert_customer where state in (".$br2.") order by alert_id DESC";
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

echo $sql;
$qr22=$sql;
$sql.=" order by id DESC LIMIT $Page_Start , $Per_Page";
// echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$i=0;
while($row= mysqli_fetch_row($table))
{

	//echo "select bankname,cid,area,city,address,state1 from Amc where atmid='".$row[1]."'";
    $atm=mysqli_query($con1,"select bankname,cid,area,city,address,state1 from Amc where atmid='".$row[1]."'");
	
	if(mysqli_num_rows($atm)==0){
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	$atm=mysqli_query($con1,"select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'");
	}
	$atmdet=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	//$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	//$row1=mysqli_fetch_row($tab);
	
	//echo "eng stat".$row[15];
		?>
<tr>

<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[1]; ?></td>
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $atmdet[0]; ?></td>

       
            
   
<td  valign="top">&nbsp;<?php echo $atmdet[3]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $atmdet[2] ?></td>
<td  valign="top">&nbsp;<?php echo $atmdet[4]; ?></td>

<td valign="top">&nbsp;<?php echo $atmdet[5] ;?></td>

<td valign="top">&nbsp;
		<?php 
		$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[14]."'");
		$branch_name1=mysqli_fetch_row($branch_name);
		echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE);  ?>
   </td>

<td valign="top">&nbsp;<?php echo $row[2] ;?></td>

<td valign="top">&nbsp;<?php echo $row[3] ;?></td>

<td valign="top">&nbsp;<?php echo $row[4] ;?></td>

<td valign="top">&nbsp;<?php echo $row[5] ;?></td>

  

<!--================Branch show here==================-->
<td ><?php echo $branch_name1[6];  ?></td>

<!---==============================-->


<td  valign="top">&nbsp;<?php echo $row[7]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[8] ?></td>

<td><?php 
$engname=mysqli_query($con1,"select `engg_name` from `area_engg` where `loginid` = '".$row[10]."'");
$engname1=mysqli_fetch_row($engname);
echo $engname1[0]; 

?></td>
<td><?php echo $row[11]; ?></td>

<td><?php echo $row[12]; ?></td>

<td><?php echo $row[13]; ?></td>
<?php
}
?>
</tr>
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
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 

