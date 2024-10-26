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
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
//$br="Mumbai";
$bran=array();
//echo $_SESSION['branch'];

//$br=$_SESSION['branch']; 
$br=$_POST['br'];
if($_POST['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where branch_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$str="";
//for($i=0;$i<count($br1);$i++){ 
//echo "select * from alert where state='$br1[$i]'";
//$table=mysqli_query($con1,"select * from alert where state='$br1[$i]'");
//include_once('class_files/generic_filter.php');
//$filter= new generic_filter();

//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');

$form=new table_formation();
$form->table_forming(array("","","","","","","","","","",""),$table,"n");*/

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="5%">Complain ID</th> 
<th width="5%">Name</th>
<th width="5%">CIN</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="5%">Address</th>
<th width="5%">State</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Contact Person</th>
<th width="5%"> Phone</th>
<th width="5%"> Delegated To</th>
<th width="5%"> Customer Status</th>
<th width="5%">Status</th>
<th width="5%">Update</th>

</tr>
<?php
include("config.php");


//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if($_POST['br']=='all')
{
 if(isset($_POST['state']) && $_POST['state']!='')
  { $stt=$_POST['state'];
   $sql.="Select * from alertlocal where state like ('%".$stt."%') ";
  } 
  else
   $sql.="Select * from alertlocal where 1";
}
else
{
 if(isset($_POST['state']) && $_POST['state']!='')
  { $stt=$_POST['state'];
   $sql.="Select * from alertlocal where state like ('%".$stt."%') ";
  } 
  else
	$sql.="Select * from alertlocal where state in (".$br2.") ";
}
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
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
if($eng!='-1')
$sql.=" and alert_id in (select alert_id from alert_delegationlocal where engineer='".$eng."' )";
else
$sql.=" and alert_id not in (select alert_id from alert_delegationlocal )";
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
 $sql.="and atm_id LIKE '%".$id."%'";
} 
if(isset($_POST['sitetp']) && $_POST['sitetp']!='')
{
$sitetp=$_REQUEST['sitetp'];
$sql.=" and alert_type ='".$sitetp."'";
}
if(isset($_POST['docket']) && $_POST['docket']!='')
{
$docket=$_REQUEST['docket'];
$sql.=" and custdoctno LIKE '%".$docket."%'";
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
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{

	include("config.php");
	$cname_qry=mysqli_query($con1,"select * from local_site where track_id='".$row[1]."'");
	$cname=mysqli_fetch_row($cname_qry);
	//$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedbacklocal where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	//$row1=mysqli_fetch_row($tab);
	
	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } ?>>
<td  valign="top">&nbsp;<?php echo wordwrap($row[25] ,20,"<br />\n",TRUE) ; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($cname[2],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[2],10,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[4] ,7,"<br />\n",TRUE); ?></td>
<td valign="top">&nbsp;<?php echo wordwrap($row[5] ,10,"<br />\n",TRUE);?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[27],6,"<br />\n",TRUE); ?> </td>
<td  valign="top">&nbsp;<?php echo $row[9]; ?></td>
<td valign="top">&nbsp;<?php echo date('d/m/Y',strtotime($row[11]));
//if($row[17]=='service' || $row[17]=='new temp' || $row[17]=='new'){ echo date('d/m/Y h:i:s a',strtotime($row[10]));  } else{ if(isset($row[11]) and $row[11]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[11])); }
?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[12],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo $row[13] ?></td>
<td  valign="top">&nbsp;
<?php 
//$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
//$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select e.engg_name from area_engg e,alert_delegationlocal d where e.engg_id=d.engineer and alert_id='".$row[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],8,"<br />\n",TRUE);
  ?></td>
  <td  valign="top">&nbsp;
<?php 
if(0 === strpos($row[2], 'temp'))
	echo "PCB";
	else
 if($row[21]=='' || $row[21]=='site'){ echo "Under Warrenty"; }else if($row[21]=='amc'){ echo "AMC"; }else{ echo "PCB"; }
  ?></td>
<!--<td valign="top">&nbsp;
<div height="100px" style="height:150px; overflow:hidden;">
<?php //if($row1[0]!=''){
//echo "select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";

/*if(mysqli_num_rows($tab)>0){
?>
<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>&type=local','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php
}
else
echo "No Updates so far";*/
?>
</div>
<?php
 //}else{ 
//$al=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
//$alro=mysqli_fetch_row($al);
//echo wordwrap($alro[0],10,"<br />\n",TRUE);
// } 
 
 //echo "select update_time from alert_updates where `alert_id`='".$row[0]."' order by id DESC LIMIT 1";

/*$qrytime=mysqli_query($con1,"select update_time,up from alert_updates where `alert_id`='".$row[0]."' order by id DESC LIMIT 1");
if(mysqli_num_rows($qrytime)>0)
{
$qrytime1=mysqli_fetch_row($qrytime);

?>
<div >
<?php

echo "<p style='color:black; font-weight:bold'>".wordwrap(date('d-m-Y h:i:s a',strtotime($qrytime1[0])),8,"<br />\n",TRUE) ."</p>";
?>
</div>
<?php
}

  */ 
 ?>

 </td>-->
 <td>
 <?php 
 //echo $row[16];
 
 if($row[16]=='1')
 {
  //echo $row[15]." ".$row[16];
 if($row[15]!='Delegated' && $row[15]!='Done')
 {

 ?><br><a href="delegate_local.php?req=<?php echo $row[0]?>&br=<?php echo $br; ?>&ctype=<?php echo $row[17]; ?>&type=local">Delegate</a>
<?php
}
if($row[15]=='Delegated')
{
?>
<br><a href="redelegateme_local.php?req=<?php echo $row[0]?>&br=<?php echo $br; ?>&ctype=<?php echo $row[17]; ?>&type=local">Redelegate</a>
<?php
}
if($row[15]=='Done')
{
?>
Call closed by Engineer
<?php
}
 }
  elseif($row[16]=='Pending')
  {
  echo $row[16];
  if($row[26]!='1')
  {
  ?>
<br><a href="decisionlocal.php?alertid=<?php echo $row[0]?>&ctype=<?php echo $row[17]; ?>">Questions</a>
<?php
//echo "select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' order by id DESC limit 1";
$qr=mysqli_query($con1,"select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");


  ?><!--<br />
   <a href="javascript:void(0);" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>&type=local','transfer',700,700)" class="update">
Transfer<?php if(mysqli_num_rows($qr)>0){ 
$qrro=mysqli_fetch_row($qr);
echo " Failed<br>Reason :".$qrro[6]; }  ?></a>-->
<?php
}
else
echo "<br><br>Under Transferring Process";
  }
  elseif($row[16]=='onhold')
  {
echo "<br><a href=unhold.php?id=$row[0]&type=local>Unhold</a>";

}
elseif($row[16]=='Rejected')
echo $row[16];
elseif($row[16]=='2')
{
?>
<!--<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=close&tbl=local" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>-->
<?php }
elseif($row[16]=='Done')
{
?>
Call Closed
<?php }
elseif($row[16]=='Delegated')
{
?>
<br><a href="redelegateme.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>&type=local">Redelegate</a>
<?php }


 ?>
 </td>
 
 <td>
 <?php
 //echo "Select * from tempclosedcall where alert_id='".$row[0]."' and status=0";
 $qrytmp=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$row[0]."' and status=0");
	
// echo $row[16]
 if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1' || (mysqli_num_rows($qrytmp)>0) && $row[26]!='1') )
 {
 ?>
 <a href="javascript:void(0);" onclick="newwin('call_updatelocal.php?id=<?php echo $row[0]; ?>&br=<?php echo $br; ?>&ctype=<?php echo $row[17]; ?>&type=local','display',600,600)" class="update">
  Update</a>
	
	<?php
 }
 
 
 ?>
<!--<a href="update1.php?id=<?php echo $row[0]?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>" style="text-decoration:none">Update</a>-->
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
<!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
-->
 
<div id="bg" class="popup_bg"> </div>