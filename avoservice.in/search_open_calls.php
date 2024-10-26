<?php
session_start(); 
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Complain ID</th> 
<th width="5%">Vertical Name</th>
<th width="5%">Site/Sol/ATM Id</th>

<th width="5%">End User Name</th>
<th width="10%">Address</th>
<th width="5%">AVO Branch</th>
<th width="15%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Contact Person</th>
<th width="5%"> Phone</th>
<th width="5%"> Delegated To</th>
<th width="5%"> Call Type</th>
<th width="5%"> Customer Status</th>
<th width="5%"> Last FeedBack</th>
<th width="5%">Status</th>
<th width="5%">Distance From Engr Res</th>
<th width="7%">Ageing</th>

</tr>
<?php

//=============================Function for distnace ====================================

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}


//======================================== Search Branch wise

if($_POST['bravo']=='all')
	{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
   	$sql.="Select * from alert where branch_id ='".$stt."' ";
  	} 
  	else
   	$sql.="Select * from alert where 1 and branch_id <>''";
}else{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{ $stt=$_POST['branch_avo'];
   	$sql.="Select * from alert where branch_id ='".$stt."' ";
  	} 
  	else
	$sql.="Select * from alert where branch_id='".$br1."' ";
	}

$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done'";
//======================================Search Call of open , close, tem, new tem etc.
if(isset($_POST['openall']))
{
$calltype=$_REQUEST['openall'];
if($calltype=='' || $calltype=='all')
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
if($eng!='-1')
$sql.=" and alert_id in ($alert_string)";
else
$sql.=" and alert_id not in (select alert_id from alert_delegation )";
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
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}

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
include("config.php");
while($row= mysqli_fetch_row($table))
{

//==============ATM Id & Lat Long===============     

if($row[21] =='amc'){ 
$atm=mysqli_query($con1,"select atmid, latitude1, longitude1 from Amc where amcid='".$row[2]."'");
//echo "select atmid, latitude, longitude from Amc where amcid='".$row[2]."'";

}
if($row[21] =='site'){
$atm=mysqli_query($con1,"select atm_id, latitude, longitude from atm where track_id='".$row[2]."'");
//echo "select atm_id, latitude, longitude from atm where track_id='".$row[2]."'";
}

$atmro=mysqli_fetch_row($atm);

//===============Cutsomer===========
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	//============Updates=========	
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } if($row[43] !=''){ echo "style='background:#FFA500'"; }?>>


<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($custrow[0],10,"<br />\n",TRUE); ?></td>

<td  valign="top">&nbsp;
	<?php // echo $row[17]." ".$row[2];
  	
  	if($row[17]=='new temp' || $row[17]=='temp_pm' || $row[17]=='temp_dere' ){ echo $row[2];
		
		}else{  
  		echo  wordwrap($atmro[0] ,40,"<br />\n",TRUE);  }?></td>
          
   
<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<td valign="top">&nbsp;<div height="50px" style="height:50px; overflow:hidden;"><?php  //$brtxt= preg_replace("/[^\p{Latin} ]/u", "", $row[5]);
 //echo  $brtxt1=wordwrap($brtxt ,10,"<br />\n",TRUE);
 echo $row[5];
  ?></div></td>

<!--<td  valign="top">&nbsp;<?php echo wordwrap($row[27],6,"<br />\n",TRUE); ?> </td>-->

<!--================Branch show here==================-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);
echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE);  ?></td>

<!---==============================-->
<td  valign="top">&nbsp;<?php echo $row[9];  ?></td>

<td valign="top">&nbsp;<?php echo date('d/m/Y h:i:s a',strtotime($row[10])); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[12],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo $row[13] ?></td>

<td  valign="top">&nbsp;
<?php 
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id,e.latitude,e.longitude from area_engg e,alert_delegation d where e.engg_id=d.engineer and alert_id='".$row[0]."' and d.status !=2 order by id DESC");

$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
  ?></td>
  <!-- =====  Call Type=========== -->
  <td  valign="top">&nbsp;<?php echo $row[17] ?></td>
  
  
  <td  valign="top">&nbsp;
<?php 
 	if($row[21]=='site'){ echo "Under Warrenty"; }
		
	else if($row[21]=='amc'){echo "AMC"; }
	else {echo "PCB"; }
  ?>
   </td>
   
<td valign="top">&nbsp;
<div height="50px" style="height:50px; overflow:hidden;">
<?php 
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


 <td>

 <?php 
 if($row[16]=='1'){
 if($row[15]!='Delegated' && $row[15]!='Done'){?>
 <br>
 <a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>&state=<?php echo $row[7]; ?>"><font color="#000066" size="+1">Delegate</font></a>
 <?php  }
 
 
} 

		elseif($row[16]=='Pending'){
  	if($row[26]!='1') { ?>  
	<br>
	<a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>&state=<?php echo $row[7]; ?>"><font color="#000066" size="+1">Delegate</font></a>

<? }
} ?>	
	
 </td>
<td> 
<?php
//==============Distance==============

$englat=$getoldname[3];
$englong=$getoldname[4];

$sitelat=$atmro[1];
$sitelong=$atmro[2];

if ($sitelat =='0.00' || $sitelat=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($sitelat, $sitelong, $englat, $englong, "K"); 
$dis=$dis1." KMs";
} 
echo $dis;
?>
</td>
<td>
<? $ct=date('Y-m-d H:i:s');
	  $to_time = strtotime($ct);
	$from_time = strtotime($row[10]); 

$diff=round(abs($to_time - $from_time) / 3600,2);  // Hours
$ddiff=round(abs($to_time - $from_time) / (3600*24),2); // Days

//if($diff<2.0)$hrs2++;
//else if($diff<4.0)$hrs4++;
		if($diff<8.0) { $age = "Below 8 Hrs";}
	else if($diff<12.0){ $age = "Below 12 Hrs";}
				else if($ddiff<1.0){ $age ="Below 1 Day";}
				else if($ddiff<2.0){ $age ="Below 2 Days";}
				else if($ddiff<3.0){ $age ="Below 3 Days";}
				else if($ddiff<5.0){ $age ="Below 5 Days";}
				else $age ="Above 5 Days";

echo $age;
?>    
</td>
</tr>
<?php } ?>

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
<form name="frm" method="post" action="export_opencalls.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 