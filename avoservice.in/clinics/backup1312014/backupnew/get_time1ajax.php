<?php
include('config.php');
$appdate=$_GET['appdate']; 
$hos=$_GET['hos'];
$id=$_GET['ad'];
$center=$_GET['center'];
//echo $appdate." ".$hos." ".$id;
if($hos=="" || $hos=="0"){
$qry="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
$qry1="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
}else{
$qry="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and hospital='$hos' and center='".$center."'";
$qry1="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and hospital='$hos' and center='".$center."'";
}
//echo $qry."<br>".$qry1;
$res=mysql_query($qry);


$res1=mysql_query($qry1);
?>
<style>
#linkd { 
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
	border-color:#ac0404; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
        -webkit-border-radius: 4px;
	color:#fff;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:80px;
}
</style>



<table><tr>
<?php
$cnt=0;
while ($row = mysql_fetch_row($res)){
	$cnt=$cnt+1;
	$stime24=strtotime($row[3]);
	$etime24=strtotime($row[4]);
	$stime12=date("h:i a",$stime24);
	$etime12=date("h:i a",$etime24);
	
?>

<td>
<table width="190" border="1" style="background-color:#FFC" cellpadding="0" cellspacing="0">
<tr>
<th colspan="2" align="left"><?php echo $row[1]; ?><input type="checkbox" id="ch" name="ch[]" class="ch" value="<?php echo $row[0]; ?>" style="width:20px;" /></th>
</tr>
<tr>
<td width="87" height="20" style="border:1px solid;">Start Time</td>
<td width="83" height="20" style="border:1px solid;">End Time</td>
</tr>
<tr>
<td width="87" height="22" style="border:1px solid;"><?php echo $stime12; ?></td>
<td width="83" style="border:1px solid;"><?php echo $etime12; ?></td>
</tr>
</table>
</td>

<?php
if($cnt%2==0)
echo "</tr><tr>";
 } ?>
</tr>
</table>

              
Place of Appointment:<input type="text" name="center" id="center" onkeyup="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" style="background:#fff;border:1px solid #ac0404;width:150px;" value="<?php echo $center; ?>"  />
              <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:950px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>
<select name="hos1" id="hos1" style="width:222px; height:26px;border:1px #ac0404 solid;" onChange="MakeRequest1('<?php echo $appdate; ?>','<?php echo $id ?>','hos1');">
  <option value="0">Appointment type</option>
		<?php while($row1=mysql_fetch_row($res1))
                {  
		?>
                <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[1]; ?></option>
		<?php } ?>
</select>
				
<?php
if (mysql_num_rows($res)>0)
{ ?>


<input type="button" value="Exchange" id="linkd" onClick="ex()"><?php } else {
	echo "<b>No Hospital Found for this Date !!</b>";
	}
	 ?><input type="button" value="create Slot" class="submit formbutton" id="slotting" onClick="newslot('<?php echo $row[16]; ?>')" />