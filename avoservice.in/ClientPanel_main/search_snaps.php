<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
$br=$_POST['br'];

//class="res"  
?>
<table border="1" cellpadding="2" cellspacing="0"  style="margin-top:5px;" "width:100%;" id="custtable">

<tr><th width="77">Complain ID</th> 
<th width="72">Site/ATM ID</th>
<th width="71">End User</th>
<th width="100">Address</th>
<th width="75">State</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Call Close</th>
<th width="75"> Delegated To</th>
<th width="75"> Engg Number</th>
<th width="200"> Update</th>

<th width="75">Snaps</th>
<? if(isset($_POST['calltype']) && $_POST['calltype']=='done')
{ ?>
<th width="5%">Full Product </th>
<th width="5%">Front Panel Display </th>
<th width="5%">Buyback Product </th>
<th width="5%">Input Voltage </th>
<th width="5%">Output Voltage </th>
<th width="5%">Earth Voltage </th>

<? } ?>
</tr>
<?php

$cid=$_POST['cid'];

$sql.="Select * from alert where alert_type = 'new' and (status='Done' or call_status='Done') and date(close_date) >= '2022-10-18'";

$client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==6){
  // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysql_query("select client from clienthandle where logid='".$_SESSION['logid']."'");
    
    $cc=array();
    while($custr=mysql_fetch_array($cust))
    $cc[]=$custr[0];
   $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
    
     $cl=mysql_query($client);
	while($clro=mysql_fetch_row($cl))
		{
		   $custid[] = $clro[0];
            }
      	$cust = implode(",",$custid);

 $sql.=" and cust_id in($cust) ";  
 
if(isset($_POST['calltype']) && $_POST['calltype']=='done')
{ 
$sql.=" and snap_file ='Done'";
} else if ($_POST['calltype']=='open'){

$sql.=" and snap_file !='Done'";    
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$sql.=" and cust_id='".$cid."'";
}

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
 
$sql.=" and atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%')"; 
}


if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id ='".$branch."'";
}

if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}


$cntrowsa=mysql_query($sql);
$count=0;
$Num_Rows = mysql_num_rows ($cntrowsa);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
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

$table=mysql_query($sql);

if(mysql_num_rows($table)>0) {
while($row= mysql_fetch_row($table))
{
	$atm=mysql_query("select atm_id from atm where track_id='".$row[2]."'");
	$atmrow=mysql_fetch_row($atm);
	
	$tab=mysql_query("select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
	$update=mysql_fetch_row($tab);
		?>
<tr>
<td width="77" valign="top">&nbsp;<?php echo $row[25]; ?></td> <!--ticket -->
<td width="72" valign="top">&nbsp;<?php echo $atmrow[0];  ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[3] ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[5] ?></td>   <!-- Address -->
<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td> <!--State-->
<td width="75" valign="top">&nbsp;<?php echo $row[9] ?></td> <!--Problem-->

<td width="75" valign="top">&nbsp;<?php echo date('d-m-Y',strtotime($row[11]));
?></td>

<td width="75" valign="top">&nbsp;<?php echo date('d-m-Y',strtotime($row[18]));
?></td>

<td width="75" valign="top">&nbsp;
<?php 
$oldeng=mysql_query("select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysql_fetch_row($oldeng);
$fetchengid=mysql_query("Select engg_name,phone_no1 from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysql_fetch_row($fetchengid);
echo $getoldname[0];
 ?></td>
  
  <!---->
  <td width="75" valign="top">
  <?php 
  echo $getoldname[1];
  ?>
  </td>
  
 <!--==========Update Remarks======-->
 
<td  width="150" valign="top"> <?php echo $update[0]; ?> </td>

<td>
 <?php if($row[41] !='Done') {echo "No Snaps Found";} else {echo "Available";} ?> </td>
 
<?php 
  if($row[41] =='Done') {   
$snapqry=mysql_query("select * from snap_inst where alert_id='".$row[0]."'");
$snap=mysql_fetch_row($snapqry);
 ?>

   <td>
 <? if($snap[2] !='' && $snap[2] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[2]; ?>" target="_blank" <image src="<?php echo $snap[2]; ?>.jpg" alt="Inst" width="300" height="300" />Full Product Snap</a> </button>
     <? } else {  echo "Not Uploaded"; }  ?>    
   </td>

<td>
 <? if($snap[3] !='' && $snap[3] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[3]; ?>" target="_blank" <image src="<?php echo $snap[3]; ?>.jpg" alt="Inst" width="300" height="300" />Front Panel Display</a> </button>
 <? } else {  echo "Not Uploaded"; }  ?>    
   </td>
   <td>
<? if($snap[4] !='' && $snap[4] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[4]; ?>" target="_blank" <image src="<?php echo $snap[4]; ?>.jpg" alt="Inst" width="300" height="300" />Buyback Product</a> </button>   
  <? } else {  echo "Not Uploaded"; }  ?>    
   </td>
   <td>
 <? if($snap[5] !='' && $snap[5] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[5]; ?>" target="_blank" <image src="<?php echo $snap[5]; ?>.jpg" alt="Inst" width="300" height="300" />Input Voltage</a> </button>  
   
    <? } else {  echo "Not Uploaded"; }  ?>    
   </td>
   <td>
   <? if($snap[6] !='' && $snap[6] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[6]; ?>" target="_blank" <image src="<?php echo $snap[6]; ?>.jpg" alt="Inst" width="300" height="300" />Output Voltage</a> </button>
   
    <? } else {  echo "Not Uploaded"; }  ?>    
   </td>
   <td>
  <? if($snap[7] !='' && $snap[7] !='NULL') { ?>
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $snap[7]; ?>" target="_blank" <image src="<?php echo $snap[7]; ?>.jpg" alt="Inst" width="300" height="300" />Earth Voltage</a> </button> 
    <? } else {  echo "Not Uploaded"; }  ?>    
   </td>

<? } ?>
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

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="export_viewalert.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 