<?php
include('config.php');
############# must create your db base connection
 $str="";
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d',strtotime('-1 days'));
//$query ="select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.confirmstat,a.hospital,b.srno,b.name,b.mobile,a.status,a.presstat,a.center,b.pattype,a.missreason from appoint a,patient b where a.status=0 and a.no=b.srno and a.waiting_list='0' and a.reason='' and presstat='0' and cancstat<>'1' ";
$query="SELECT a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.confirmstat,a.hospital,b.srno,b.name,b.mobile,a.status,a.presstat,a.center,b.pattype,a.missreason FROM `appoint` a,patient b WHERE a.no=b.srno and a.`presstat` != 0 AND a.`cancstat` != 1 and DATE_ADD(a.app_date, INTERVAL 2 MONTH)<'".date('Y-m-d')."'";
if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
	//echo "hi";
$name=$_REQUEST['name'];

$query.=" and b.name like('".$name."%') ";
}
else
{
	$query.=" and b.name like('".$_REQUEST['sname']."%') ";
}
if(isset($_REQUEST['cont']) && $_REQUEST['cont']!='')
{
$cont=$_REQUEST['cont'];
$query.="and b.mobile like('".$cont."%')";
}

if(isset($_REQUEST['hos']) && $_REQUEST['hos']!='')
{
$hos=$_REQUEST['hos'];
$query.="and a.hospital like('".$hos."%')";
}

if(isset($_REQUEST['ref']) && $_REQUEST['ref']!="")
{
$ref=$_REQUEST['ref'];
$query.="and b.reference in(select doc_id from doctor where name like('".$ref."%'))";
}
//echo $query;
//$result = mysql_query($query) or die(mysql_error());
$query.=" order  by a.app_date desc";
//echo $query;
//$Num_Rows = mysql_num_rows ($result);
$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="width:1100px;">  
<!--overflow:scroll;-->
<table class="results">
 
       <thead>
         <tr>
		<!-- <td width="5" style="color:#ac0404; font-size:12px; font-weight:bold;">Mail</td>-->
		  <th>OPD</th>
          <th>App_Date</th>
          <th>Patient ID</th>
          <th>Time</th>
          <th>Patient_Name</th>
          <th>Balance</th>
          <th>Contact</th>
          <th>New/Old</th>
          <th>Center</th>
          <th>Appointment Type</th>
          <th>Patient Type</th>   
          <th>END DATE</th>       
          <th>Renew</th>
          <th>Reason</th>
          <!--<th>Delete</th>-->
</tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row= mysql_fetch_array($result))
{
	$chckqry=mysql_query("select * from appoint where presstat != 0 AND cancstat != 1 and app_date>'".$row['app_date']."' and no='".$row['no']."'");
	//echo "select * from appoint where presstat<>0 and app_date>'".$row['app_date']."' and no='".$row['no']."' ".mysql_num_rows($chckqry)."<br/>";
	if(mysql_num_rows($chckqry)<1)
	{
	
	$dt=mysql_query("select * from patient_package where patientid='".$row['srno']."' and status=0 order by id DESC limit 1");
	if(mysql_num_rows($dt)>0)
	{
		$dtro=mysql_fetch_row($dt);
		if(strtotime($dtro[4])>strtotime(date('d-m-Y')))
		{
			$inactivetype="Term remaining.";
			$incativestat="tr";
			
		}
		else
		{
			$inactivetype="Term over.";
			$incativestat="to";
		}		
		$edate=date('d-m-Y',strtotime($dtro[4]));
	}
	else
	{
		$inactivetype="Not in Package";
		$incativestat="nip";
	}
	
	if(isset($_REQUEST['inactivetype']) && $_REQUEST['inactivetype']!='')
	{
		if($_REQUEST['inactivetype']==$incativestat)
		{
$cnt=$cnt+1;
$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);
$result5=mysql_query("select * from appoint");
$row5=mysql_fetch_row($result5);

$result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($row[4]-1)* $durro[0];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 
?>
<tbody>
<tr>
   <tr>
    <td align="center"><?php echo $cnt; ?></td>
    <td width="71" height="31"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td><?php echo $row[8];  ?></td>
    <td width="105" height="31"> <?php echo $apptime; ?></td>
    <td height="31"> <?php echo $row1[6]; ?></td>
    <td><?php
    
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[8]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[8]."'");
$ro=mysql_fetch_row($qr);
echo ($pacro[0]-$ro[0]);
	?></td>
    
    <td height="31"> <?php if($row1[23]=="") { echo $row1[22]; } else { echo $row1[23]; }?></td>
 	<td width="69" height="31"> <?php if($row[5]=="N"){ echo "New";}else if($row[5]=="O"){ echo "Old"; }  ?></td>
    <td width="126" height="31"> <?php echo $row[13];
	
	 ?></td>
    <td width="124" height="31"> <?php echo $row[7]; ?></td>
    <td width="48" height="31"><?php echo $inactivetype; ?></td>
    <td width="48" height="31"><?php echo $edate; ?></td>
    <?php
	if(isset($row[2]) and $row[2]!='0000-00-00') $ad= date('d/m/Y',strtotime($row[2]));
	
	?>
   
    <td width="40" height="31"> 
 <a href="#"  id="opdapp" onClick="openchild(this.id,'app2ajax.php?dt=<?php echo date('d/m/Y'); ?>&id=<?php echo $row[8]; ?>','appointment','width=800,height=750,left=200,top=40');" value=""> Renew Appointment</a>
	</td>
    <td width="40" height="31"> 
    <?php  echo $row[15];
	if($row[15]=='')
	{
	  ?>
 <a href="#"  id="reason" onClick="openchild(this.id,'misappreason.php?dt=<?php echo date('d/m/Y'); ?>&id=<?php echo $row[0]; ?>','missing reason','width=400,height=400,left=220,top=50');" value=""> Reason</a>
 <?php } ?>
	</td>
    <!--<td width="51" height="31"><?php if($row[12]<='1'){ ?><a href="javascript:confirm_delete3('<?php echo $row[0]; ?>');"> Delete </a><?php } ?></td>-->
    </tr>
    </tbody>

<?php
			$intRows++;
		}
	}
	else
	{
		
$cnt=$cnt+1;
$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);
$result5=mysql_query("select * from appoint");
$row5=mysql_fetch_row($result5);

$result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($row[4]-1)* $durro[0];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 
?>
<tbody>
<tr>
   <tr>
    <td align="center"><?php echo $cnt; ?></td>
    <td width="71" height="31"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td><?php echo $row[8];  ?></td>
    <td width="105" height="31"> <?php echo $apptime; ?></td>
    <td height="31"> <?php echo $row1[6]; ?></td>
    <td><?php
    
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[8]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[8]."'");
$ro=mysql_fetch_row($qr);
echo ($pacro[0]-$ro[0]);
	?></td>
    
    <td height="31"> <?php if($row1[23]=="") { echo $row1[22]; } else { echo $row1[23]; }?></td>
 	<td width="69" height="31"> <?php if($row[5]=="N"){ echo "New";}else if($row[5]=="O"){ echo "Old"; }  ?></td>
    <td width="126" height="31"> <?php echo $row[13];
	
	 ?></td>
    <td width="124" height="31"> <?php echo $row[7]; ?></td>
    <td width="48" height="31"><?php echo $inactivetype; ?></td>
    <td width="48" height="31"><?php echo date('d-m-Y',strtotime($dtro[4])); ?></td>
    <?php
	if(isset($row[2]) and $row[2]!='0000-00-00') $ad= date('d/m/Y',strtotime($row[2]));
	
	?>
   
    <td width="40" height="31"> 
 <a href="#"  id="opdapp" onClick="openchild(this.id,'app2ajax.php?dt=<?php echo date('d/m/Y'); ?>&id=<?php echo $row[8]; ?>','appointment','width=800,height=750,left=200,top=40');" value=""> Renew Appointment</a>
	</td>
    <td width="40" height="31"> 
    <?php  echo $row[15];
	if($row[15]=='')
	{
	  ?>
 <a href="#"  id="reason" onClick="openchild(this.id,'misappreason.php?dt=<?php echo date('d/m/Y'); ?>&id=<?php echo $row[0]; ?>','missing reason','width=400,height=400,left=220,top=50');" value=""> Reason</a>
 <?php } ?>
	</td>
    <!--<td width="51" height="31"><?php if($row[12]<='1'){ ?><a href="javascript:confirm_delete3('<?php echo $row[0]; ?>');"> Delete </a><?php } ?></td>-->
    </tr>
    </tbody>

<?php
			$intRows++;
	}
	}
}	
		
	?>
</table></div>
<?php

}
else{
echo "<div class='error'>No Records Found!</div>";
}
}
?></div>***???<?php echo $cnt; ?>