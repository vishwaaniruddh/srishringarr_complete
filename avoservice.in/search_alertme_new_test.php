<?php
session_start(); 
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// echo $br=$_POST['branch_avo'];

// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

if($_SESSION['branch']!=''){
    $br=$_SESSION['branch'];    
}else{
    $br=$_POST['branch_avo'];
}

############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Complain ID</th> 
<th width="5%">Client Docket Number</th> 
<th width="5%">Name</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>

<th width="5%">Pincode</th>
<th width="5%">Landmark</th>
<th width="5%">Address</th>
<!--<th width="5%">State</th>-->
<th width="5%">AVO Branch</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Contact Person</th>
<th width="5%"> Phone</th>
<th width="5%"> Delegated To</th>
<th width="5%"> Distance from Engr</th>
<th width="5%"> Call Type</th>
<th width="5%"> Customer Status</th>
<th width="5%"> Last FeedBack</th>
<th width="5%">Status</th>
<th width="5%">ETA</th>
<th width="5%">ETA Update/FSR Attach</th>
<th width="7%">Update</th>

</tr>
<?php

//======================================== Search Branch wise

if($_POST['bravo']=='all')
	{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
  		echo "stt".$stt.'<br>';
   	$sql="Select * from alert where branch_id ='".$stt."' ";
  	} 
  	else
   	$sql="Select * from alert where branch_id <>''";
}else{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
  		echo "stt".$stt.'<br>';
   	$sql="Select * from alert where branch_id ='".$stt."' ";
  	} 
  	else
	$sql="Select * from alert where branch_id='".$br1."' ";
	}
	

//================State wise===========
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
$openall=$_REQUEST['openall'];
if($openall=='')
{
}
elseif($openall=='all')
{
}
//$sql.=" and (alert_type = 'service' or alert_type='new' or `alert_type`='new temp')";
elseif($openall=='install')
$sql.=" and (alert_type = 'new')";

elseif($openall=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($openall=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($openall=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";

elseif($openall=='wtpcb')
$sql.=" and (`alert_type`='wtpcb') ";

}

//======================================Search Call eng wise
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
$eng_alert=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$eng."'  and `call_close_status`='0' ");
$all_alid=array();
while($eng_alert1=mysqli_fetch_row($eng_alert)){
         //echo $eng_alert1[0];
	 $all_alid[]=$eng_alert1[0];
}
$alert_string = implode(",",$all_alid);
if($eng !='-1' && $eng !='-2')
$sql.=" and alert_id in ($alert_string)";
else if($eng =='-1')
$sql.=" and alert_id not in (select alert_id from alert_delegation )";

elseif($eng =='-2')
$sql.=" and alert_id not in (select alert_id from eng_feedback )";
}
//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	if($_POST['calltype']=='Done'){
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and close_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";
		}
	elseif($_POST['calltype']=='Rejected'){
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and reject_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";
	}
	else{
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
	}
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}
//======================================Search ATM ID Wise
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
 echo $id;
 
$sql.=" and (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') ))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
//======================================Search 
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}
 //======================================Search
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
//======================================Search
if(isset($_POST['sitetp']) && $_POST['sitetp']!='')
{
$sitetp=$_REQUEST['sitetp'];
if($sitetp=="addon")
$sql.=" and alert_type like '%temp%' ";
else
$sql.=" and alert_type like '%temp%' ";
}
//======================================Search
if(isset($_POST['docket']) && $_POST['docket']!='')
{
$docket=$_REQUEST['docket'];
$sql.=" and custdoctno LIKE '%".$docket."%'";
}

//======================================Search
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
//======================================Search
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}

echo 'SQL:'.$sql;

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
// echo $qr22;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
// include("config.php");
while($row= mysqli_fetch_row($table))
{
 //======Fetch ATM ID =========
    $is_qry = 0;
	if($row[21] ==  'amc' || $row[21] ==  'AMC') {
	    $is_qry = 1;
	    $atm="select atmid from Amc where amcid='".$row[2]."'";
   } elseif($row[21] == 'site') {
       $is_qry = 1;
	    $atm="select atm_id from atm where track_id='".$row[2]."'";
	} 
  $atm_id = ''; 
  if($is_qry == 1){
	$atmquery = mysqli_query($con1,$atm);
	if(mysqli_num_rows($atmquery)>0) {
    	$atmrow=mysqli_fetch_row($atmquery);
    	$atm_id=$atmrow[0];
	} else{
	    $atm_id=$row[2];
	}
  }
	
if($atm_id==''){$atm_id=$row[2];}	
	
//===============Cutsomer===========
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
//============Updates=========	
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	

		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } if($row[43] !=''){ echo "style='background:#FFA500'"; }?>>


<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[30],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($custrow[0],10,"<br />\n",TRUE); ?></td>

<td  valign="top">&nbsp;<?php echo $atm_id;  ?></td>

<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo $row[8]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[4] ,7,"<br />\n",TRUE) ;?></td>
<td valign="top">&nbsp;<div height="100px" style="height:150px; overflow:hidden;"><?php  //$brtxt= preg_replace("/[^\p{Latin} ]/u", "", $row[5]);
 //echo  $brtxt1=wordwrap($brtxt ,10,"<br />\n",TRUE);
 echo $row[5];
  ?></div></td>

<!--<td  valign="top">&nbsp;<?php echo wordwrap($row[27],6,"<br />\n",TRUE); ?> </td>-->

<!--================Branch show here==================-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);
echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE);  ?></td>

<!---==================Problem ============-->
<td  valign="top">&nbsp;<?php echo $row[9];  ?></td>

<!---==================Alert date ============-->
<td valign="top">&nbsp;<?php echo date('d/m/Y h:i:s a',strtotime($row[10]));?></td>

<td  valign="top">&nbsp;<?php echo wordwrap($row[12],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo $row[13] ?></td>

<!---==================Engineer ============-->
<?php 
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation d where e.engg_id=d.engineer and d.alert_id='".$row[0]."' order by d.id DESC");
if(mysqli_num_rows($fetchengid)>0){
    $getoldname=mysqli_fetch_row($fetchengid);
    $engg_name = $getoldname[0];
    $phone_no1 = $getoldname[1];
    $engg_id = $getoldname[2];
}else{
     $engg_name = '';
    $phone_no1 = '';
    $engg_id = '';
} 
?>
<td  valign="top">&nbsp;
<?php 
// $fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation d where e.engg_id=d.engineer and d.alert_id='".$row[0]."' order by d.id DESC");
echo wordwrap($engg_name,30,"<br />\n",TRUE)."<br>".$phone_no1; 

// if(mysqli_num_rows($fetchengid)>0){
//     $getoldname=mysqli_fetch_row($fetchengid);
//     echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];    
// }

  ?></td>
  
<td  valign="top"><? echo $row[37] ?></td>
  <td  valign="top">&nbsp;<?php echo $row[17] ?></td>
 <!-- =============Customer Status =========== -->
  <td  valign="top">&nbsp;
<?php 
	
 	if($row[21]=='site'){ echo "Under Warrenty"; }
	else if($row[21]=='amc'){ echo "AMC"; }
	else echo "Temp Call"; 
	
  ?>
 
  </td>
<td valign="top">&nbsp;
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
</div>

 </td>

<!--- ==================Open  delegation Status==========   -->
 <?php 
 if($row[16]=='1' || $row[16]=='Pending') {  ?>
<td>
    <?
 if($row[15] =='Pending'){ ?>
     

 <a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>&state=<?php echo $row[7]; ?>"><font color="#000066" size="+1">Delegate</font></a>
 <?php  }
 
 if($row[15] =='Delegated' ){ ?>

<a href="redelegateme.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>"><font color="#000066" size="+1">Redelegate</font></a>

 <? } 

  if($row[15] !='Done' ){ 

	if($row[26]!='1') {   
	$qr=mysqli_query($con1,"select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");
  	?>
  	
   <a href="javascript:void(0);" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer',700,700)" class="update"> 
	Transfer
	<?php if(mysqli_num_rows($qr)>0){ 
		$qrro=mysqli_fetch_row($qr);
		echo " Failed<br>Reason :".$qrro[6]; }  ?></a>
	<?php } else
			echo "<br><br>Under Transferring Process";
?>
<a href="javascript:void(0);" onclick="newwin('rejected-hold.php?id=<?php echo $row[0] ?>','Reject',400,400)"><font color="white" > Reject/ Customer Dependency</font></a>

<a href="BRF_form.php?pid=<?php echo $row[25];?>&branch=<?php echo $branch_name1[0];?>" &nbsp;<font color="red" >Create/BRF</font></a>

 <? } 

elseif($row[15]=='Done'){ ?>

Closed By Engineer
<br>
<a href="avopdf/report.php?aid=<?php echo $row[0]; ?>" target="_blank" >Generate FSR </a>
<br/>
<a href="view_sitesnaps.php?aid=<?php echo $row[0]; ?>" target="_blank" >View Snaps </a>
<br/>
<a href="BRF_form.php?pid=<?php echo $row[25];?>&branch=<?php echo $branch_name1[0];?>" &nbsp;<font color="red" >Create/BRF</font></a>

</td>
<? } }

else if($row[16]=='Done') { ?>
<td> <? echo "Call Closed"; ?> 
<br>
<a href="avopdf/report.php?aid=<?php echo $row[0]; ?>" target="_blank" >Generate FSR </a>
<br/>
<a href="BRF_form.php?pid=<?php echo $row[25];?>&branch=<?php echo $branch_name1[0];?>" &nbsp;<font color="red" >Create/BRF</font></a>

</td>
<?  }


else if($row[16]=='Rejected') { ?>
<td> <? echo "Rejected"; ?> </td>
<?  } 
else if($row[16]=='onhold') { ?>
<td>
<? echo "Call on Hold";
echo "<br><a href=unhold.php?id=$row[0]>Unhold</a>"; ?> 

</td> 
<? } 
 ?>
 <!--=========ETA=============-->
 <td>
 <?php 

 echo $row[31];
//  if($row[31]!="0000-00-00 00:00:00" or $sql1[0]!="0000-00-00 00:00:00") //previous   
 if($row[31]!="0000-00-00 00:00:00")
 echo '<br>'.'<a href="calltrack.php?pid='.$row[0].'" target="_new" >Track</a>';
 ?>
 
 </td>
  <!--=========ETA FeedBack=============-->
  <!--FSR Attachment================= -->
 <td>
 <?php 
 //echo $sql1[1];
 
 if(($row[16]=='Done' || $row[15]=='Done') && $row[44]== ''){
  ?>
 <button input type="button" style="color:blue; font:bold;" <a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('manual_fsr.php?id=<? echo $row[0];?>','upload','width=700px,height=500,left=300,top=100')" class="update">Attach Manual FSR</a></button>
 
 <?php } elseif ($row[44] != '') { ?>
 
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="<?php echo $row[44]; ?>" target="_blank" <image src="<?php echo $row[41]; ?>.jpg" alt="Inst" width="300" height="300" />View FSR</a> </button>

<?php } ?>

 <!-- update link and status-->
 </td>
 <?
//  echo $br;
//   echo $row[0]." br: ".$br."  --- ".$row[17]." ".$row[0]." ".$getoldname[2]."<br>";
 ?>
 <td>
 <?php
  $qrytmp=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$row[0]."' and status=0");
 // echo $row[16]
// echo $br;
 if(($row[16]=='Delegated' || $row[16]=='Pending' || $row[16]=='2' || $row[16]=='1' || (mysqli_num_rows($qrytmp)>0) && $row[26]!='1') ){
 if($row[15]!='Done'){
     
    //  echo $row[0].'  '.$br.'   '.$row[17].'   '.$getoldname[2];
    
 ?>
  <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0]; ?>&br=<?php echo $br; ?>&ctype=<?php echo $row[17] ?>&alerts_id=<?php echo $row[0]; ?>&eng_id=<?php echo $engg_id; ?>','display',600,600)" class="update"> <font size="+4">Update</font></a> <?php }?>
 <br>
 <?php }  ?>
 
 
  <?php if($row[31]!='0000-00-00 00:00:00'){
  if($row[15]!='Done'){
  ?>
  <a href="javascript:void(0);" onclick="newwin('revise_update.php?id=<?php echo $row[0]; ?>&br=<?php echo $br; ?>&ctype=<?php echo $row[17]; ?>&alerts_id=<?php echo $row[0]; ?>&eng_id=<?php echo $engg_id; ?>','display',600,600)" class="update">
  <font color="#000066" size="-2">ETA Update</font></a> <?php }?>
 	<?php }

  ?>

 </td>

</tr>
<?php
// echo $c;
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
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 
<?php  CloseCon($con1); ?>