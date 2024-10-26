<?php
include('config.php');
############# must create your db base connection
 $str="";
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d',strtotime('-1 days'));

//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query ="select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.confirmstat,a.hospital,b.srno,b.name,b.mobile,a.status,a.presstat,a.center,b.pattype,a.missreason from appoint a,patient b where a.status=0 and a.no=b.srno and a.waiting_list='0' and a.reason='' and presstat='0' and cancstat<>'1' ";
if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
	//echo "hi";
$name=$_REQUEST['name'];

$query.=" and b.name like('%".$name."%') ";
}
if(isset($_REQUEST['center']) && $_REQUEST['center']!='')
{
$center=$_REQUEST['center'];

$query.=" and a.center like '".$center."%' ";
}
if(isset($_REQUEST['searchdate']) && $_REQUEST['searchdate']!="" && isset($_REQUEST['edate']) && $_REQUEST['edate']!="")
{
	
$searchdate=$_REQUEST['searchdate'];
$edate=$_REQUEST['edate'];
//echo "hi";
if($searchdate>=date("d/m/Y") || $edate>=date("d/m/Y"))
{
$searchdate=$dt;
$query.="and a.app_date='".$searchdate."'";
}
else
$query.="and a.app_date between STR_TO_DATE('".$searchdate."%','%d/%m/%Y') and STR_TO_DATE('".$edate."%','%d/%m/%Y')";
//$query.="and a.app_date like STR_TO_DATE('".$searchdate."%','%d/%m/%Y') ";
}
else
{
$searchdate=$dt;
$query.="and a.app_date='".$searchdate."'";
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
$query.=" order  by a.app_id ASC";
//echo $query;
//$Num_Rows = mysql_num_rows ($result);
$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="width:1100px;">  
<input type="hidden" id="misappqry" value="<?php echo $query; ?>"/>
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
          <th>Type/status</th>          
          <th>Renew</th>
          <th>Reason</th>
          <th>Update</th>
          <!--<th>Delete</th>-->
</tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row= mysql_fetch_array($result))
{
	$chckqry=mysql_query("select * from appoint where presstat<>0 and app_date>'".$row['app_date']."' and no='".$row['no']."'");
	//echo "select * from appoint where presstat<>0 and app_date>'".$row['app_date']."' and no='".$row['no']."' ".mysql_num_rows($chckqry)."<br/>";
	if(mysql_num_rows($chckqry)<1)
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
   <!--<td width="5" height="31"> <input type="checkbox" name="mail<?php echo $cnt; ?>" id="mail<?php echo $cnt ?>" value="<?php echo $row[0]; ?>" /></td>-->
    <td align="center"><?php //if ($row[2]==$dt)
if($row[11]!='yes' && $row[2]<=$dt && $row[6]!='w' && $row[12]=='2') { ?><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row5[0]; ?>" onClick="window.location.href='opd.php?id=<?php echo $row[1]; ?>&aid=<?php echo $row[0];?>&type=<?php echo $row[5];?>&dt=<?php echo $row[2]; ?>'" /> <?php } ?></td>
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
    <td width="48" height="31"> 
	<?php
	if($row[14]!=''){ echo $row[14]."/";} ?>
	<?php if($row[6]=='w'){ ?> <a href='#' onClick="appoint('<?php echo $row[0]; ?>')">Tentative</a><?php }else{ echo "Confirmed";} ?></td>
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
    
<?php
$app_qry=mysql_query("select app_id,NO from appoint where app_real_id = '".$row[0]."'");
$app_row=mysql_fetch_array($app_qry);
?>
<td>
	<div id="showrem<?php echo $intRows; ?>1" style="display:block">
		<input type="button" onclick="showrem('showrem<?php echo $intRows; ?>','<?php echo $intRows; ?>')" value="Update" />
	</div>
	<div id="showrem<?php echo $intRows; ?>" style="display:none">	
		<textarea id="rem<?php echo $intRows; ?>" cols="20"></textarea>
		<input type="button" onClick="add_update('<?php echo $intRows; ?>','<?php echo $app_row[0]; ?>','<?php echo $app_row[1]; ?>')" value="Update">
		<input type="button" onclick="showrem('showrem<?php echo $intRows; ?>','<?php echo $intRows; ?>')" value="Cancel" />
	</div>
</td>

    </tr>
    </tbody>

<?php
			$intRows++;
			$cnt=$cnt+1;
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
 if(mysql_num_rows($result)>0) {
 
 ################ home end

 ?>
<form method="post" action="missed_app.php" >
<input type="text" name="texting" id="texting" onKeyUp="lookup(this.value,this.id,'textsuggestions','textautoSuggestionsList','mailref1');"  value="" placeholder="Email"   />
 <div class="suggestionsBox" id="textsuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="textautoSuggestionsList">
					&nbsp;
				</div>
			</div>
            
            <textarea name="email" id="email" rows="6" readonly="readonly"></textarea>
<input type="hidden" name="msg" value="<?php echo $query; ?>" />
<input type="submit" value="Mail" class=" submit formbutton"/>
</form> 
<?php
}
?></div>