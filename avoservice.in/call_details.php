<?php 
include('config.php');


?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Count</th>
<th width="10%">Complain ID</th> 
<th width="5%">Client Docket Number</th> 
<th width="5%">Name</th>
<th width="5%">ATM</th>
<th width="5%">Bank</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="5%">Address</th>
<!--<th width="5%">State</th>-->
<th width="5%">Branch</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Contact Person</th>
<th width="5%"> Phone</th>
<th width="5%"> Delegated To</th>
<th width="5%"> Customer Status</th>
<th width="5%"> Last FeedBack</th>
<th width="5%">Status</th>
<th width="5%">ETA</th>
<th width="5%">ETA Update</th>
<th width="7%">Update</th>

</tr>
<?php
   	$sql="Select * from alert_old where atm_id ='".$_GET['atmid']."' ";  	
	$table=mysqli_query($con1,$sql);
	$i=1;
	while($row= mysqli_fetch_row($table)){
		
	if(($row[17]=='service' || $row[17]=='new') &&  $row[21] ==  'amc')
    $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	elseif(($row[17]=='service' || $row[17]=='new') &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");


	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback_old where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	
	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } ?>>
<td><?php echo $i;?></td>
<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[30],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($custrow[0],10,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;
	<?php // echo $row[17]." ".$row[2];
  	if(($row[17]=='new' && ($row[21]=='site') &&  $row[30]!='New Installation Call') || $row[17]=='new temp'){ echo wordwrap($row[2] ,8,"<br />\n",TRUE);
		}
		elseif($row[17]=='pm' || $row[17]=='temp_pm'){
	  		echo $row[2];
		}
		elseif($row[17]=='rede' || $row[17]=='temp_rede'){
	  		echo $row[2];	
		}else{  
  			$atmrow=mysqli_fetch_row($atm);
   			echo  wordwrap($atmrow[0] ,40,"<br />\n",TRUE);  }?></td>
   
<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
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

<!---==============================-->
<td  valign="top">&nbsp;<?php
// echo $row[9];
 if($row[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);
 echo "<br><b>Buy Back :</b>".$buyro[2]."<br>";
 
 }
 echo $row[9];
 ?></td>
<td valign="top">&nbsp;<?php
if($row[17]=='service' || $row[17]=='new temp' || $row[17]=='new'){ echo date('d/m/Y h:i:s a',strtotime($row[10]));  } else{ if(isset($row[11]) and $row[11]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[11])); }
?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[12],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo $row[13] ?></td>
<td  valign="top">&nbsp;
<?php 
//$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
//$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation d where e.engg_id=d.engineer and alert_id='".$row[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
  ?></td>
  <td  valign="top">&nbsp;
<?php 
if(0 === strpos($row[2], 'temp'))
	echo "PCB";
	else
 if($row[21]=='' || $row[21]=='site'){ echo "Under Warrenty"; }else if($row[21]=='amc'){ echo "AMC"; }else{ echo "PCB"; }
  ?></td>
<td valign="top">&nbsp;
<div height="100px" style="height:150px; overflow:hidden;">
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
<?php
 
 ?>

 </td>
 <td>

 <?php 
 //===For new installation call=============================================================
 if($row[16]=='1'){}elseif($row[16]=='Pending'){}elseif($row[16]=='onhold'){	  
				//echo "<br><a href=unhold.php?id=$row[0]>Unhold</a>";	
			}
			elseif($row[16]=='Rejected')
			echo $row[16];
			elseif($row[16]=='2')
			{}elseif($row[16]=='Done'){ ?>
			Call Closed
		<?php } elseif($row[16]=='Delegated'){}  ?>
     	
 		</td>
 	<!--=========ETA=============-->
 <td>
 <?php 
 //echo "select revise_eta,revise_update from alert_progress where alert_id='".$row[0]."' order by pro_id desc limit 1";
 $sql=mysqli_query($con1,"select revise_eta,revise_update from alert_progress_old where alert_id='".$row[0]."' order by pro_id desc limit 1");
 $sql1=mysqli_fetch_row($sql);
 if(mysqli_num_rows($sql)>0)
 echo $sql1[0];
 else
 echo $row[31];
 ?>
 
 </td>
  <!--=========ETA FeedBack=============-->
 <td>
 <?php 
 echo $sql1[1];
 ?>
 </td>
 <!-- update link and status-->
 <td>
 
 		<?php	 	
		$rejsta=mysqli_query($con1,"select * from `alert_updates_old` where `alert_id`='".$row[0]."'");
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	echo $rejsta1[2];
 		?>

 </td>

</tr>
<?php $i++; }?>
</table>