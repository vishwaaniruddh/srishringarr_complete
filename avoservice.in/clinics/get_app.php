<script>
$('a[href^="#"]').click(function(e) {
    e.preventDefault();
});

</script>

<?php
include('config.php');
############# must create your db base connection

$str="";
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d');

//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query ="select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.confirmstat,a.hospital,b.srno,b.name,b.mobile,a.status,a.presstat,a.center,b.pattype from appoint a,patient b where a.status=0 and a.no=b.srno and a.waiting_list='0' and a.reason='' and cancstat<>'1' ";

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

if(isset($_REQUEST['searchdate']) && $_REQUEST['searchdate']!="")
{
	
$searchdate=$_REQUEST['searchdate'];
//echo "hi";
$query.="and a.app_date like STR_TO_DATE('".$searchdate."%','%d/%m/%Y') ";
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
//$query.="order by a.slot";
//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins
?>
<div>
<?php 
$appcnt=mysql_query("SELECT count(hospital),hospital FROM `appoint` WHERE app_date=STR_TO_DATE('".$searchdate."','%d/%m/%Y') group by hospital");
while($appro=mysql_fetch_array($appcnt))
{
?><a href="#" onclick="fillapptype('<?php echo $appro[1]; ?>','hos')" style="text-decoration:none">
<?php
echo $appro[1].": ".$appro[0]." ";
?>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php
}
?>
</div>

<div>
<?php
$Per_Page =8;   // Records Per Page
 
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

$query.=" order  by a.slot ASC LIMIT $Page_Start , $Per_Page";
//echo $query;

$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="width:1100px;">  <!--overflow:scroll;-->
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
          <th>Edit</th>
          <th>Delete</th>
          <th>Update</th>
</tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row= mysql_fetch_array($result))
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
	//echo $row[7];
if($row[11]!='yes' && $row[2]<=$dt && $row[6]!='w' && $row[12]=='2' && $_REQUEST['dept']!='2') { ?><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row5[0]; ?>" onclick="<?php  if($row[7]=='NP Slot'){ ?>window.location.href='nptype.php?id=<?php echo $row[1]; ?>&aid=<?php echo $row[0];?>&type=<?php echo $row[5];?>&dt=<?php echo $row[2]; ?>' <?php }else{ ?>window.location.href='opd.php?id=<?php echo $row[1]; ?>&aid=<?php echo $row[0];?>&type=<?php echo $row[5];?>&dt=<?php echo $row[2]; ?>' <?php } ?>" /> <?php } ?></td>
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
    <td width="126" height="31"> <?php //if (is_numeric($row1[9])) echo $row2[1]; else echo $row1[9];
	echo $row[13];
	 ?></td>
    <td width="124" height="31"> <?php echo $row[7]; ?></td>
    <td width="48" height="31"> 
	<?php
	if($row[14]!=''){ echo $row[14]."/";} ?>
	<?php if($row[6]=='w'){ ?> <a href='javascript:void(0)' class="someclass" onclick="appoint('<?php echo $row[0]; ?>')">Tentative</a><?php }else{ echo "Confirmed";} ?></td>
    <?php
	if(isset($row[2]) and $row[2]!='0000-00-00') $ad= date('d/m/Y',strtotime($row[2]));
	
	?>
   
    <td width="40" height="31"> <!--<a href='edit_app.php?id=<?php echo $row[0]; ?>' onclick="Makerequest1('<?php echo $row[2];  ?>')">-->
  <div id="pay<?php echo $cnt; ?>">  <?php 
// echo $row[12];
  if($row[12]=='0' && $row[2]>=date("Y-m-d")){ ?>
	<a href='javascript:void(0)' onclick="Editapp('<?php echo date('d/m/Y',strtotime($row[2]));  ?>','<?php echo $row[0] ?>','<?php echo $row[7]; ?>','<?php echo $row[13]; ?>')"> Edit </a>
    <br /><br />
    
   <?php if($row[2]==$dt && ($row[6]!='w')){ ?> <a href='javascript:void(0)' class="someclass" onclick="Changestatus('<?php echo $row[0] ?>','1','<?php echo $strPage; ?>')"> Appointment </a>
	<?php
	}
	}
	elseif($row[12]=='1' && $row[2]>=date("Y-m-d")){ 
	?>
    <a href='#' onclick="Editapp('<?php echo date('d/m/Y',strtotime($row[2]));  ?>','<?php echo $row[0] ?>','<?php echo $row[7]; ?>','<?php echo $row[13]; ?>')"> Edit </a>
    <br /><br />
	<?php if($row[2]==$dt){ ?><a href='javascript:void(0)' class="someclass" onclick="Changestatus('<?php echo $row[0] ?>','2','<?php echo $strPage; ?>')">Visiting Waiting</a><?php } ?>
    <?php }
	elseif($row[12]=='2'){ ?>
	Consulting
    <?php }
	elseif($row[12]=='3'){ echo "Medicine"; }
	elseif($row[12]=='4'){ 
	$qr=mysql_query("select * from patient_package where patientid='".$row[8]."' and status='0'");
	if(mysql_num_rows($qr)>0)
	{
	/*$qryy=mysql_query("select sum(amt) from patient_package where patientid='".$row[8]."' and status='0'");
	$qrro=mysql_fetch_row($qryy);
	$paid=mysql_query("select sum(amt) from opd_collection where patientid='".$row[8]."'");
	$paidro=mysql_fetch_row($paid);
$bal=$qrro[0]-$paidro[0];*/
//echo "Amt".$bal;
	?>
    <a href="javascript:void(0)" onClick="window.open('opdpayment.php?appid=<?php echo $row[0];  ?>&amt=<?php //echo $bal; ?>&pid=<?php echo $row[8]; ?>','opdpay','width=600,height=300,left=200,top=100')" style="text-decoration:none; color:#099">Make Payment</a>
    <?php
	}
	else
	{
	/*$fees=mysql_query("select amt from fees");
	$feero=mysql_fetch_row($fees);
	echo "Amt".$feero[0];*/
	?>
   
	<a href="javascript:void(0)" onClick="window.open('opdpayment.php?appid=<?php echo $row[0];  ?>&amt=<?php //echo $feero[0]; ?>&pid=<?php echo $row[8]; ?>','opdpay','width=600,height=300,left=200,top=100')" style="text-decoration:none; color:#099">Make Payment</a>
    <?php
	}
	 }
	elseif($row[12]=='5')
	echo "Process Completed";
	 ?>
     </div>
	</td>
    <td width="51" height="31"><?php if($row[12]<='1'){ ?><a href="javascript:confirm_delete3('<?php echo $row[0]; ?>');"> Delete </a><?php } ?></td>
    <td>
	<div id="showrem<?php echo $i; ?>1" style="display:block">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Update" />
	</div>
	<div id="showrem<?php echo $i; ?>" style="display:none">	
		<textarea id="rem<?php echo $i; ?>" cols="20"></textarea>
		<input type="button" onClick="add_update('<?php echo $i; ?>','<?php echo $row[8]; ?>')" value="Update">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Cancel" />
	</div>
    </td>
    </tr>
    </tbody>

<?php
			$i++;
			$intRows++;
			$cnt=$cnt+1;
	?> 

	<?php
	}
		
		
	?>
</table></div>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
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
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>
<?php
############

}
else{
echo "<div class='error'>No Records Found!</div>";
}
 if(mysql_num_rows($result)>0) {
 
 ################ home end

 ?>
<form method="post" action="missed_app.php" >
<input type="text" name="texting" id="texting" onkeyup="lookup(this.value,this.id,'textsuggestions','textautoSuggestionsList','mailref1');"  value="" placeholder="Email"   />
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