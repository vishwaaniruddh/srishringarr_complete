<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

$bran=array();

$br=$_POST['br'];
if($_POST['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";

$src=mysql_query("select state from state where state_id in (".$br1.")");
while($srcrow=mysql_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$str="";

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr><th width="77">Complain ID</th> 
<th width="77">Call Request Type</th> 
<th width="77">Name</th>
<th width="72">Site/ATM ID</th>
<th width="71">End User</th>
<!--<th width="55">City</th>
<th width="57">Area</th> -->
<th width="100">Address</th>
<th width="100">State</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Call Type</th>
<th width="75">Call Close</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>
<th width="75"> Delegated To</th>
<th width="75"> Engg Number</th>
<th width="75"> Customer Status</th>
<th width="75"> ETA</th>
<th width="150"> Update</th>
<!--<th width="75">View Update</th> -->
<!--<th width="75">Customer comment</th> -->
<th width="75">FSR / Snaps</th>
<th width="75">Status</th>
</tr>
<?php


$cid=$_POST['cid'];
//$sql.="Select * from alert where cust_id='".$cid."'";

$sql.="Select * from alert where 1";

    $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==6){
  // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysql_query("select client from clienthandle where logid='".$_SESSION['logid']."'");
    
    $cc=array();
    while($custr=mysql_fetch_array($cust))
    $cc[]=$custr[0];
    
   // print_r($cc);
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


 if(isset($_POST['state']) && $_POST['state']!='')
  { $stt=$_POST['state'];
  
 $sql.=" and branch_id = '".$stt."' ";
}
if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='')
{
}
elseif($calltype=='open')
//$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and atm_id<>'temp_' and status != 'Done'";
$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done'";

elseif($calltype=='Done')
$sql.=" and (call_status = 'Done' or status = 'Done') ";
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

elseif($calltype=='install')
$sql.=" and (alert_type = 'new')";


elseif($calltype=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($calltype=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";

}
//echo $sql;


if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
	//echo "select alert_id from alert_delegation where engineer='".$eng."' and `date` >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) ";
	$alrtid=mysql_query("select alert_id from alert_delegation where engineer='".$eng."' ");
 	$alertarry = array();
   	   while($alertrows = mysql_fetch_assoc($alrtid)) {
              $alertarry[] = $alertrows['alert_id'];
            }
      	$alert_string = implode(",",$alertarry);
       //echo $alert_string;


$sql.=" and alert_id in ($alert_string )";
}
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
 $qr=mysql_query("select track_id from atm where atm_id LIKE '%".$id."%'");
  $qr2=mysql_query("select amcid from Amc where atmid LIKE '%".$id."%'");
  $qr3=mysql_query("select atm_id from alert where atm_id LIKE '%".$id."%'");
 $r1=mysql_num_rows($qr);
 $r2=mysql_num_rows($qr2);
 $r3=mysql_num_rows($qr3);
 if($r1>0 && $r2>0)
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";
 elseif($r1>0 && $r2==0)
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%'))";
 elseif($r2>0 && $r1==0)
 $sql.=" and ((atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";

 
 
//$sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%') or atm_id LIKE '%".$id."%'))";
if($r1=='0' && $r2=='0')
$sql.=" and atm_id LIKE '%".$id."%' ";
else
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}

if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
if(isset($_POST['sitetp']) && $_POST['sitetp']!='')
{
$sitetp=$_REQUEST['sitetp'];
$sql.=" and alert_type ='".$sitetp."'";
}

if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}

//echo $sql;

//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysql_query($sql);
$count=0;
$Num_Rows = mysql_num_rows ($table);
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

//echo $sql;
$qr22=$sql;
//$sql.=" and `entry_date` >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)  order by alert_id DESC LIMIT $Page_Start , $Per_Page";
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysql_query($sql);
$qry=mysql_query("select cust_name from customer where cust_id='".$cid."'");
	$custrow=mysql_fetch_row($qry);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysql_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysql_num_rows($table);
if(mysql_num_rows($table)>0) {
while($row= mysql_fetch_row($table))
{
       /* if(startsWith($row[2], 'temp'))
       {
	
       }*/
      // else{
	if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] ==  'amc')
        $atm=mysql_query("select atmid from Amc where amcid='".$row[2]."'");
	if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] == 'site')
	$atm=mysql_query("select atm_id from atm where track_id='".$row[2]."'");
	//}
	$tab=mysql_query("select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysql_fetch_row($tab);
	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } ?>>


<td width="77" valign="top">&nbsp;<?php echo $row[25]; ?></td> <!--ticket -->
<td width="77" valign="top">&nbsp;<?php echo $row[30]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td width="72" valign="top">&nbsp;<?php // echo $row[17]." ".$row[2];
  if($row[17]=='new' || $row[17]=='new temp' || $row[17]=='temp_pm' || $row[17]=='temp_dere'){ echo $row[2]; } else {  
  $atmrow=mysql_fetch_row($atm);
   echo $atmrow[0];  }?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[3] ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>
<td width="55" valign="top">&nbsp;<?php echo $row[6] ?></td>
<td width="57" valign="top">&nbsp;<?php echo $row[4] ?></td> -->
<td valign="top">&nbsp;<?php echo $row[5] ?></td>   <!-- Address -->
<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td> <!--State-->
<td width="75" valign="top">&nbsp;<?php echo $row[9] ?></td> <!--Problem-->

<td width="75" valign="top">&nbsp;<?php
if($row[17]=='service' || $row[17]=='new temp'){ echo date('d/m/Y h:i:s a',strtotime($row[10]));  } else{ if(isset($row[11]) and $row[11]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[11])); }
?></td>


<td width="75" valign="top">&nbsp;<?php //echo $row[17] 
 if($row[17]=='service' || $row[17]=='new temp'){ echo "Service Call"; } 
 
 elseif ($row[17]=='new') { echo "Installation Call";}
 elseif ($row[17]=='pm'|| $row[17]=='temp_pm') { echo "PM Call";}
 elseif ($row[17]=='dere' || $row[17]=='temp_dere') { echo "De-Re installation Call";}


?></td>

<td width="75" valign="top">&nbsp;<?php
if($row[18]!='0000-00-00 00:00:00'){ echo date('d/m/Y h:i:s a',strtotime($row[18]));  } else{ echo "Call still Active"; }
?></td>

<td width="75" valign="top">&nbsp;<?php echo $row[12] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[13] ?></td>
<td width="75" valign="top">&nbsp;
<?php 
$oldeng=mysql_query("select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysql_fetch_row($oldeng);
$fetchengid=mysql_query("Select engg_name,phone_no1 from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysql_fetch_row($fetchengid);
echo $getoldname[0];
 ?></td>
  
  <!---->
  <td>
  <?php 
  echo $getoldname[1];
  ?>
  </td>
  <td width="75" valign="top">&nbsp;
<?php 
if(0 === strpos($row[2], 'temp'))
	echo "PCB";
	else
 if($row[21]=='' || $row[21]=='site'){ echo "Under Warrenty"; }else if($row[21]=='amc'){ echo "AMC"; }else{ echo "PCB"; }
  ?></td>
  
<td width="77" valign="top">&nbsp;<?php echo $row[31]; ?></td>
  
  <!--==========Update Remarks======-->
 
<td width="150">
<div height="100px" style="height:150px; overflow:hidden;">    

<?php 
if(mysql_num_rows($tab)>0){
?>
<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php
}
else
echo "No Updates so far";
?>
</div>
</td>


  
  
<!--<td>
<?php
 //echo "Select * from tempclosedcall where alert_id='".$row[0]."' and status=0";
// $qrytmp=mysql_query("Select * from tempclosedcall where alert_id='".$row[0]."' and status=0");
	
//echo $row[16];
 if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1' || $row[16]=='Done' || (mysql_num_rows($qrytmp)>0) && $row[26]!='1') )
 {
 ?>
 <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>','display',600,600)" class="update">
  Update</a>
	
	<?php
 }
 
 
 ?>
</td> -->

<!--<td>
<?php
 if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1' || (mysql_num_rows($qrytmp)>0) && $row[26]!='1') )
 {
 ?>
 <a href="javascript:void(0);" onclick="newwin('custcomments.php?id=<?php echo $row[0] ?>&cust_id=<?php echo $row[1]?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>','display',600,600)" class="update">
  Comment</a>
	
	<?php
 }
 
 
 ?>

</td>-->
<td>
<?php if($row[15]=='Done'){ ?> <a href="../avopdf/report.php?aid=<?php echo $row[0]; ?>" target="_blank" >Generate e-FSR </a> 
<?php } 

 if($row[44] !='') { ?>

<br>
<button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="../<?php echo $row[44]; ?>" target="_blank" <image src="<?php echo $row[44]; ?>.jpg" width="300" height="300" />Scanned Copy</a> </button>
<?php } ?>
 </td>

<td>
<?php   //if($row[19]=='Y')
if($row[15]=='Done' ||$row[16]=='Done' )
{ echo "Call Closed";  }
else if($row[16]=='Rejected') 
{ echo "Call Rejected by AVO";  }

else if($row[16]=='onhold') 
{ echo "Call is on Hold for Your action";  }

else echo "Pending"; ?> 
 </td>
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
<form name="frm" method="post" action="export_viewalert.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 