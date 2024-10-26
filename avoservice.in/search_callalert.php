<?php
session_start(); 
//echo $_SESSION['user'];
//include('config.php');
############# must create your db base connection

include("access.php");
$strPage = $_REQUEST['Page'];
$id="";
$cid="";
$bank="";
$city="";

include("config.php");

$count=0;
$sql="Select * from alert where branch_id <>''";

if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='')
{
}
elseif($calltype=='open')
$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done'";
elseif($calltype=='Done')
$sql.=" and (call_status = 'Done' or status = 'Done') ";
elseif($calltype=='onhold')
$sql.=" and call_status = 'onhold'";
elseif($calltype=='Rejected')
$sql.=" and call_status = 'Rejected'";
}
//=============Open Call search=====
if(isset($_POST['openall']))
{
$sertype=$_REQUEST['openall'];
if($sertype=='')
{
}
elseif($sertype=='all')
{
}
//$sql.=" and (alert_type = 'service' or alert_type='new' or `alert_type`='new temp')";

elseif($sertype=='install')
$sql.=" and (alert_type = 'new')";

elseif($sertype=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($sertype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm') ";

elseif($sertype=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere')";


elseif($sertype=='wtpcb')
$sql.=" and (`alert_type`='wtpcb') ";
}

//echo $sql; 
//================== ATM ID search=================
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
$qr=mysqli_query($con1,"select track_id from atm where atm_id LIKE '%".$id."%'");
  $qr2=mysqli_query($con1,"select amcid from Amc where atmid LIKE '%".$id."%'");
 
 $r1=mysqli_num_rows($qr);
 $r2=mysqli_num_rows($qr2);
 
 if($r1>0 && $r2>0)
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";
 elseif($r1>0 && $r2==0)
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%'))";
 elseif($r2>0 && $r1==0)
 $sql.=" and ((atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";


if($r1=='0' && $r2=='0')
$sql.=" and atm_id LIKE '%".$id."%' ";
else
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
//===============Customer/ Address search===========
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}

if(isset($_POST['st']) && $_POST['st']!='')
{
$state=$_POST['st'];
$sql.=" and state1 LIKE '%".$state."%'";
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
//===============Date search===================
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];;
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$area=$_REQUEST['state'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}
//======================Branch==============================
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and `branch_id`='".$branch."'";
}

// echo $sql;

$table=mysqli_query($con1,$sql);

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
$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

?><table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">


<th width="5%" >Complaint No</th>
<th width="5%">Client Docket Number</th>
<th width="5%">Name</th>
<th width="5%">ATM</th>
<th width="5%">Bank</th>
<!--<th width="5%">State</th>-->
<th width="5%">Branch</th>
<th width="5%">Site Address</th>
<th width="5%">Problem</th>

<th width="5%"> Date</th>
<th width="5%">Contact Person</th>
<th width="5%">Phone</th>
<?php
if($_POST['sitetp']!='new'){
?>
<th width="5%">Approved by</th>
<th width="5%">Reference</th>
<?php
}
?>

<th width="5%">Status</th>
<th width="5%">Call Close Date/time</th>
<th width="5%">ETA</th>
<th width="5%">Response Time</th>
<th width="5%">Resolution Time</th>
<th width="5%"> Delegated To</th>
<th width="5%"> Call Type</th>
<th width="5%">Customer Status</th>
<th width="5%">UPS S.N.</th>
<th width="5%">Last Feedback</th>
<th width="5%">Status</th>
<th width="5%">Update</th>
<th width="5%">Problem Type</th>
<?php
$cdate=date('Y-m-d H:i:s');

// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
$count=$count+1;
//include("config.php");
//$qry3=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"customer",array("cust_name"),array($row[0]));
//echo "select cust_name from customer where cust_id='".$row[1]."'";
/*if($row[17]=='service' &&  $row[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='service' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
if($row[17]=='new')
$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");

$atmrow=mysqli_fetch_row($atm);*/

	if(($row[17]=='service' || $row[17]=='new' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] ==  'amc')
	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if(($row[17]=='service' || $row[17]=='new' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	
	
$qry3=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);
//$tab=mysqli_query($con1,"select up from alert_updates where alert_id='$row[0]' order by id DESC");
	//include_once('class_files/filter.php');
	//$ob=new filter();
	//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("up"),'alert_updates',array("alert_id"),array($row[0]),'','');
	//$row1=mysqli_fetch_row($tab);
	
$time1 = strtotime($row[10]);
$time2 = strtotime($row[18]);

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;

$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC");
	$row1=mysqli_fetch_row($tab);
	
	//echo "select feedback from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";
	$qryme=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC");
	$qrymeres=mysqli_fetch_row($qryme);

?>
<tr>
<td><?php echo wordwrap($row[25],10,"<br />\n",TRUE);?></td>
<td ><?php echo wordwrap($row[30],6,"<br />\n",TRUE); ?></td>
<td ><?php echo wordwrap($row3[0],10,"<br />\n",TRUE); ?></td>
<td ><?php //if($row[17]=='service'){ echo wordwrap($atmrow[0],8,"<br />,\n",TRUE); }else{ echo wordwrap($row[2],8,"<br />,\n",TRUE); }
 	if(($row[17]=='new' && ($row[21]=='site') &&  $row[30]!='New Installation Call') || $row[17]=='new temp'){
	  	echo wordwrap($row[2] ,8,"<br />\n",TRUE);
		}
		elseif($row[17]=='temp_pm'){
	  		echo $row[2];
		}
		elseif( $row[17]=='temp_dere'){
	  		echo $row[2];
		} else {  
  		$atmrow=mysqli_fetch_row($atm);
   		echo  wordwrap($atmrow[0] ,40,"<br />\n",TRUE);  }
 ?></td>
<td > <?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?> </td>
<!--state show here-->
<!--<td ><?php echo  wordwrap($row[27],6,"<br />\n",TRUE);  ?></td>-->

<!--branch show here-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);

echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE);  ?></td>


<td ><?php echo  wordwrap($row[5],10,"<br />\n",TRUE);  ?></td>
<td ><?php echo  wordwrap($row[9],10,"<br />\n",TRUE); ?></td>
<td ><?php //if($row[17]=='new'){ echo wordwrap(date('d/m/Y h:i:s a',strtotime($row[11])),10,"<br />\n",TRUE); }
            //            else { echo wordwrap(date('d/m/Y h:i:s a',strtotime($row[10])),10,"<br />\n",TRUE); }
            echo wordwrap(date('d/m/Y h:i:s a',strtotime($row[10])),10,"<br />\n",TRUE);
?></td>
<td ><?php echo wordwrap($row[12],6,"<br />\n",TRUE); ?></td>
<td ><?php echo $row[13] ?></td>


<?php
//echo $_POST['sitetp'];
if($_POST['sitetp']!='new'){
?>
<td ><?php echo $row[22]; ?></td>
<td ><?php echo $row[23]; ?></td>
<?php
}
?>



<td><?php 
if($row[15]=='Done')
echo "Closed";
elseif($row[16]=='1')
echo "Pending";
elseif($row[16]=='2')
echo "Waitng for Final Close";
else
echo $row[16] ?></td>
<td width="75">
<?php  
if(isset($row[18]) and $row[18]!='0000-00-00 00:00:00') echo wordwrap(date('d/m/Y h:i a',strtotime($row[18])),8,"<br />\n",TRUE);
?></td>
<td width="75">
<?php  
if(isset($row[31]) and $row[31]!='0000-00-00 00:00:00') echo wordwrap(date('d/m/Y h:i a',strtotime($row[31])),8,"<br />\n",TRUE);
?></td>

<td ><?php 
if($row[24]!='0000-00-00 00:00:00')
echo date('d/m/Y g:i:s a',strtotime($row[24]));
?></td><td><?php 

if($row[18]!='0000-00-00 00:00:00')
echo ''.$final_hours. "h " .$final_minutes."m";
?></td>
<td  valign="top">
<?php 
$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select engg_name,phone_no1,engg_id from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
  ?></td>
  <td  valign="top">&nbsp;<?php echo $row[17] ?></td>
<td>
<?php 
	if(0 === strpos($row[2], 'temp'))
	{
	if($row[17]=='new temp')
	$fetchtype=mysqli_query($con1,"Select type from tempsites where atmid='".$row[2]."'");
	else
	$fetchtype=mysqli_query($con1,"Select call_type from tempsites_pm where atmid='".$row[2]."'");
        $gettype=mysqli_fetch_row($fetchtype);
        if($gettype[0]=='')
	echo "PCB";
	else
	echo $gettype[0];
	}
	else
 	if($row[21]=='' || $row[21]=='site'){
		if($row[37]=='' and $row[38]==''){
			echo "Under Warrenty";
			}else{
				echo "WARRENTY_TO_PCB";
				}
	 }
	else if($row[21]=='amc'){
		
		if($row[37]=='' and $row[38]==''){
			echo "AMC"; 
			}else{
				echo "AMC_TO_PCB";
				}
	}else{ 
		echo "PCB"; 
		}
  ?>
  <!---For warranty to pcb conver--->
 <?php 
 if($row[21]=='site' || $row[21]=='amc'){ ?>
 <br />
   <?php if($row[37]=='' and $row[38]==''){ ?>
    <a href="javascript:void(0);" onclick="newwin('convet_pcb.php?id=<?php echo $row[0] ?>','transfer',700,700)" class="update">Convert To PCB</a>
	
	
   
 <?php }}?>

 
 </td>
 
 <!---Ups serial No.-->
 <td>
 <?php 
 if($row[21]=='amc'){
 	$ups_sn=mysqli_query($con1,"select `serialno` from `amcassets` where `siteid`='".$row[2]."' and `assets_name`='UPS'");
 	$ups_sn1=mysqli_fetch_row($ups_sn);
 	echo $ups_sn1[0];
 	}elseif($row[21]=='site'){
		$ups_sn=mysqli_query($con1,"select `upssrno` from `enginstalled_sites` where `atm_id`='".$row[2]."' and `assets` like '%ups%'");
		$ups_sn1=mysqli_fetch_row($ups_sn);
 		echo $ups_sn1[0];
		 if($ups_sn1[0]==""){
			 	$ups_sn=mysqli_query($con1,"select `serialno` from `site_assets` where `atmid`='".$row[2]."' and `assets_name`='UPS'");
 				$ups_sn1=mysqli_fetch_row($ups_sn);
			 	echo $ups_sn1[0];
			 }
		 }else{
		 	$ups_sn=mysqli_query($con1,"select `serialno` from `tempsites` where `atmid`='".$row[2]."'");
 			$ups_sn1=mysqli_fetch_row($ups_sn);
 			echo $ups_sn1[0];		 
		 }
 ?>
 </td>
<td>

<div height="100px" style="height:150px; overflow:hidden;">
<?php //if($row1[0]!=''){
//echo "select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";

if(mysqli_num_rows($tab)>0){
?>
<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php
}
else
echo "No Updates so far";
?>
</div></td>


 <td>
 <?php 
 //echo $_POST['br']." ".$_SESSION['user'];
 if($row[16]=='1'){
  //echo $row[15]." ".$row[16];
 if($row[15]!='Delegated'){
 if($row[15]!='Done'){
 ?>
 <br><a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_SESSION['branch']; ?>&state=<?php echo $row[7]; ?>">Delegate</a>
 	<?php 
 //==new installation transfer call here
	if($row[26]!='1') { ?>  
	<?php
	$qr=mysqli_query($con1,"select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");
  	?>
  	<br />
   <a href="javascript:void(0);" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer',700,700)" class="update">
	Transfer
	<?php if(mysqli_num_rows($qr)>0){ 
		$qrro=mysqli_fetch_row($qr);
		echo " Failed<br>Reason :".$qrro[6]; }  ?></a>
	<?php } else
			echo "<br><br>Under Transferring Process";
 		?>
 
<?php }} if($row[15]=='Done') {
//echo $row[16];
?> Closed
<input type="button" value="ReOpen" onclick="reopen_fun(<?php echo $row[0]; ?>)"/>


<!--<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=wait">Standby Close</a>
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>-->
<?php
}
elseif($row[15]=='Delegated')
echo "Delegated";
elseif($row[16]!='1')
{
echo $row[16];
?>
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=wait">Standby Close</a>
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
<?php }
 }
  elseif($row[16]=='Pending')
  {
  echo $row[16];
  if($row[26]!='1')
  {
  ?>
<br>
<a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>&state=<?php echo $row[7]; ?>">Delegate</a>
<!--<a href="decision.php?alertid=<?php echo $row[0]?>">Questions</a>-->
<?php
//echo "select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' order by id DESC limit 1";
$qr=mysqli_query($con1,"select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");



  ?><br />
   
<a class="update" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer')"  href="#"  >Transfer<?php if(mysqli_num_rows($qr)>0){ 
$qrro=mysqli_fetch_row($qr);
echo " Failed<br>Reason :".$qrro[6]; }  ?></a>
<?php
}
else
echo "<br><br>Under Transferring Process";
  }
  elseif($row[16]=='onhold')
  {
echo "<br><a href=unhold.php?id=$row[0]>Unhold</a>";

}
elseif($row[16]=='Rejected'){
echo $row[16]; ?> <input type="button" value="ReOpen" onclick="reopen_fun(<?php echo $row[0]; ?>)"/>
<?}
elseif($row[16]=='2')
{
?>
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
<?php }
elseif($row[16]=='Done')
{
?>
Call Closed <br>
<input type="button" value="ReOpen" onclick="reopen_fun(<?php echo $row[0]; ?>)"/>
 
<?php }

//echo "select update_time from alert_updates where `alert_id`='".$row[0]."'";

$qrytime=mysqli_query($con1,"select update_time from alert_updates where `alert_id`='".$row[0]."' ");
$qrytime1=mysqli_fetch_row($qrytime);

   //echo date('Y-m-d h:i:s a',strtotime($qrytime1[0]));
 
 
 ?>
<!-- <a href="javascript:void(0);" onclick="newwin('Reopen_call.php?alerts_id=<?php echo $row[0] ?>','display',600,600)" class="update">ReOpen</a>
 -->
 

 
</td>
 
 
<td>
<?php
 //echo "Select * from tempclosedcall where alert_id='".$row[0]."' and status=0";
 $qrytmp=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$row[0]."' and status=0");
	
// echo $row[16]
 if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1' || (mysqli_num_rows($qrytmp)>0) && $row[26]!='1') )
 {
 ?>
 <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>&alerts_id=<?php echo $row[0] ?>&eng_id=<?php echo $getoldname[2] ?>','display',600,600)" class="update">
  Update</a>
	
	<?php
 } else{
	 	//echo "select * from `alert_updates` where `alert_id`='".$row[0]."'";
		$rejsta=mysqli_query($con1,"select * from `alert_updates` where `alert_id`='".$row[0]."'");
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	echo $rejsta1[2];
 }
 
 
 ?>
<!--<a class="update" href="#"  onClick="openpopup('<?php echo $row[0] ?>','display')" >Update</a>-->
<!--<a class="update" href="#" onclick="newwin('call_update.php?id=<?php //echo $row[0] ?>','display')" >View Update</a>-->
<div id="<?php echo $row[0] ?>"  class="popup"></div></td>
<td><?php
	 	//echo "select * from `alert_updates` where `alert_id`='".$row[0]."'";
		$rejsta=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
		if(mysqli_num_rows($rejsta)>0){
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	if($rejsta1[2]==0)echo $rejsta1[3];
	 	else{
	 	$rejstax=mysqli_query($con1,"select problem from `problemtype` where `probid`='".$rejsta1[2]."'");
	 	$rejstay=mysqli_fetch_row($rejstax);
	 	echo $rejstay[0];}
	 	}
	?>
</td>
</tr><?php 
}
?>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a> ";
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
if($Page!=$Num_Pages)
{
	echo "<a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?>
<form name="frm" method="post" action="exportme.php" target="_blank">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
<div id="bg" class="popup_bg"> </div> 