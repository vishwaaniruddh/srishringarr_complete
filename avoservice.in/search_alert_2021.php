<?php
session_start(); 
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// ini_set('memory_limit', '512MB');
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
   	$sql="Select * from alert160222 where branch_id ='".$stt."' ";
  	} 
  	else
   	$sql="Select * from alert160222 where 1 and branch_id <>''";
}else{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
   	$sql="Select * from alert160222 where branch_id ='".$stt."' ";
  	} 
  	else
	$sql="Select * from alert160222 where branch_id='".$br."' ";
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
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";

elseif($calltype=='wtpcb')
$sql.=" and (`alert_type`='wtpcb') ";

}

//======================================Search Call eng wise
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
$eng_alert=mysqli_query($con1,"select alert_id from alert_delegation_2021 where engineer='".$eng."'  and `call_close_status`='0' ");
$all_alid=array();
while($eng_alert1=mysqli_fetch_row($eng_alert)){
         //echo $eng_alert1[0];
	 $all_alid[]=$eng_alert1[0];
}
$alert_string = implode(",",$all_alid);
if($eng !='-1' && $eng !='-2')
$sql.=" and alert_id in ($alert_string)";
else if($eng =='-1')
$sql.=" and alert_id not in (select alert_id from alert_delegation_2021 )";

elseif($eng =='-2')
$sql.=" and alert_id not in (select alert_id from eng_feedback160222 )";
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

$countsql=str_replace("Select *","Select count(*) as count",$sql);

//echo $countsql;

$countrow=mysqli_query($con1,$countsql);

$rows=mysqli_fetch_assoc($countrow);
$Num_Rows=$rows['count'];
$count=0;
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

// echo $sql;

$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
// include("config.php");
while($row= mysqli_fetch_row($table))
{
 //======Fetch ATM ID =========
 $is_qry = 0;
	if($row[21] ==  'amc' || $row[21] ==  'AMC') {
	    $is_qry = 1;
	    $atmquery="select atmid from Amc where amcid='".$row[2]."'";
   } elseif($row[21] == 'site') {
       $is_qry = 1;
	    $atmquery="select atm_id from atm where track_id='".$row[2]."'";
	} 
	$atm_id='';
	if($is_qry==1){
	    $atm=mysqli_query($con1,$atmquery);
    	if(mysqli_num_rows($atm)>0) {
        	$atmrow=mysqli_fetch_row($atm);
        	$atm_id=$atmrow[0];
    	}else{ 
    	    $atm_id=$row[2];
	    }
	}
	
	
if($atm_id==''){$atm_id=$row[2];}	
	
//===============Cutsomer===========
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
//============Updates=========	
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback160222 where alert_id='".$row[0]."' order by feed_date DESC limit 1");
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
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation_2021 d where e.engg_id=d.engineer and d.alert_id='".$row[0]."' order by d.id DESC");
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
// $fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation_2021 d where e.engg_id=d.engineer and d.alert_id='".$row[0]."' order by d.id DESC");
// $getoldname=mysqli_fetch_row($fetchengid);
// if(mysqli_num_rows($fetchengid)>0){
//     echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
// }else{ echo ""; }
echo wordwrap($engg_name,30,"<br />\n",TRUE)."<br>".$phone_no1;
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
<a href="javascript:void(0);" onclick="newwin('masteralert_2021.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php
}
else
echo "No Updates so far";
?>
</div>

 </td>

<!--- ==================Open  delegation Status==========   -->
 <td>
 <?php 
 if($row[16]=='1' || $row[16]=='Pending') { echo "Pending";}

else if($row[16]=='Rejected') { echo "Rejected";}
else if($row[16]=='onhold') { echo "Call on Hold";}   
else if($row[16]=='Done' or $row[16] =='Done' ) { echo "Call Closed"; ?> 
<br>
<a href="avopdf/report.php?aid=<?php echo $row[0]; ?>" target="_blank" >Generate FSR </a>

<?  } ?>
</td>
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
</div>
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 
<?php  CloseCon($con1); ?>