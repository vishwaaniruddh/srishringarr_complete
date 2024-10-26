<?php
include('config.php');
	//$_GET['i'] is reference id and $_GET['j'] is weather it is amc or site
 	$id=$_GET['id'];
	$po=$_GET['j'];
	//echo "<br>".$id;
	//echo $po."hi".($po=="site")."hi2".($po=="amc");
	$today=new DateTime(date("Y-m-d"));
	//echo $today->format("Y-m-d");
	$cnt=0;
	$pcb='';
	
	?>
<!--================================For Amc=========================================================================-->
<?php
if(strcasecmp($po,"amc")==0){ ?>

	<?php
	//echo "SELECT * FROM amcassets where siteid='".$id."'";
	$res=mysql_query("SELECT * FROM amcassets where siteid='".$id."'");
	$atmrow=mysql_fetch_array($res);
	//while($atmrow=mysql_fetch_array($res)){ 

		$qry2=mysql_query("select * from assets_specification where ass_spc_id='".$atmrow[2]."'");
		$row=mysql_fetch_row($qry2);

		$qry3=mysql_query("select * from assets where assets_id='".$row[1]."'");
		$row2=mysql_fetch_row($qry3);

		$qry=mysql_query("select * from amcpurchaseorder where amcsiteid='".$id."'");
		$row3=mysql_fetch_row($qry);
		//echo "exp".$row3[4];a
 		$expdt=new DateTime($row3[4]);
		// echo $expdt->format("Y-m-d"); 

	
	
?>

<table width="100%" bordercolor="#000" border="2">
<!--====UPS==================-->

<tr>
<td width="200">
<b>UPS</b>
</td>
<td>
<select name="ups" id="ups">
<option value="0">select</option>
<?php
$qryspecups=mysql_query("Select * from assets_specification where assets_id='1'");
while($rowups=mysql_fetch_row($qryspecups))
{
?>
<option value="<?php echo $rowups[0]; ?>" ><?php echo $rowups[2]; ?></option>
<?php
}
?>

</select>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<select name="upsno" id="upsno">
<option value="">Select</option>

<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td width="50">
<span class="space">Warranty:</span>
</td>
<td>
<select name="upswr" id="upswr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>

<!--====Battery==================-->
<tr>
<td><b>Battery</b></td>
<td>
<select name="btry" id="btry">
<option value="0">select</option>
<?php
$qryspecbat=mysql_query("Select * from assets_specification where assets_id='2'");
while($rowbat=mysql_fetch_row($qryspecbat))
{
?>
<option value="<?php echo $rowbat[0]; ?>"><?php echo $rowbat[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space">Number:</span>
</td>
<td>

<select name="btryno" id="btryno">
<option value="">Select</option>
<?php
for($i=1;$i<=16;$i++)
{
?>
<option value="<?php echo $i; ?>" > <?php echo $i; ?></option>
<?php
}
?>
</select>
</td>

<td>
<span class="space">Warranty:</span>
</td>
<td>
<select name="btrywr" id="btrywr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>

<!--====Isolation Transformer==========-->
<tr>
<td> <b>Isolation Transformer</b> </td>

<td>
<select name="isot" id="isot">
<option value="0">select</option>
<?php
$qryiso=mysql_query("Select * from assets_specification where assets_id='8'");
while($rowiso=mysql_fetch_row($qryiso))
{
?>
<option value="<?php echo $rowiso[0]; ?>"><?php echo $rowiso[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space"> Number: </span>
</td>

<td>
<select name="isotno" id="isotno">

<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>

<?php }?>
</select>
</td>

<td>
<span class="space">Warranty:</span>
</td>
<td>
<select name="isotwr" id="isotwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>

<!--====Stabilizer==========-->
<tr>
<td> <b> Stabilizer</b></td>

<td>
<select name="stab" id="stab">
<option value="0">select</option>
<?php
$qrystab=mysql_query("Select * from assets_specification where assets_id='7'");
while($rowstab=mysql_fetch_row($qrystab))
{
?>
<option value="<?php echo $rowstab[0]; ?>"><?php echo $rowstab[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space">Number:</span>
</td>

<td>
<select name="stabno" id="stabno">
<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td>
<span class="space">Warranty: </span>
</td>
<td>
<select name="stabwr" id="stabwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>

<!--====AVR==========-->
<tr>
<td>
<b>AVR</b>
</td>
<td>
<select name="avr" id="avr">
<option value="0">select</option>
<?php
$qryavr=mysql_query("Select * from assets_specification where assets_id='10'");
while($rowavr=mysql_fetch_row($qryavr))
{
?>
<option value="<?php echo $rowavr[0]; ?>"><?php echo $rowavr[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space"> Number: </span>
</td>

<td>
<select name="avrno" id="avrno">
<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td>
<span class="space"> Warranty: </span>
</td>

<td>
<select name="avrwr" id="avrwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
</tr>

<!-- ========================table end for amc assets========================-->
</table>

<?php
	$cnt=$cnt+1;
	//}
?>

<input type="hidden" name="type" value="amc" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />

<?php  }
//================================================= site details==================>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
else if(strcasecmp($po,"site")==0){
	
	$qry4=mysql_query("select atm_id,podate from atm where track_id='".$id."'");
	$ro4=mysql_fetch_row($qry4);
	
$qry=mysql_query("select * from site_assets where atmid='".$id."'");
$row=mysql_fetch_array($qry);	
//while($row=mysql_fetch_array($qry)){
	$dt=explode(",",$row[5]);
		
	$qry2=mysql_query("select * from assets_specification where ass_spc_id='".$row[4]."'");
	$ro=mysql_fetch_row($qry2);

	$qry3=mysql_query("select * from assets where assets_id='".$ro[1]."'");
	$row2=mysql_fetch_row($qry3);

	//echo $ro4[1];
	$date = strtotime(date("Y-m-d", strtotime($ro4[1])) . " +$dt[0] month");
 	$dt2 =date('Y-m-d',$date);
	//echo $date = date("Y-m-d", strtotime($ro4[1] +$dt[0]." months"));
	$expdt=new DateTime($ro4[1]);

?>
<!---============table start for site assests==========================-->
<table width="100%" bordercolor="#000" border="2">
<!--====UPS==================-->

<tr>
<td width="200">
<b>UPS</b>
</td>
<td>
<select name="ups" id="ups">
<option value="0">select</option>
<?php
$qryspecups=mysql_query("Select * from assets_specification where assets_id='1'");
while($rowups=mysql_fetch_row($qryspecups))
{
?>
<option value="<?php echo $rowups[0]; ?>" <?php if($rowups[0]==$row[0]) echo"selected"; ?>><?php echo $rowups[2]; ?></option>
<?php
}
?>

</select>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<select name="upsno" id="upsno">

<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td width="50">
<span class="space">Warranty:</span>
</td>
<td>
<select name="upswr" id="upswr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<input type="text" name="upsrate" id="upsrate"/>
</td>
</tr>

<!--====Battery==================-->
<tr>
<td><b>Battery</b></td>
<td>
<select name="btry" id="btry">
<option value="0">select</option>
<?php
$qryspecbat=mysql_query("Select * from assets_specification where assets_id='2'");
while($rowbat=mysql_fetch_row($qryspecbat))
{
?>
<option value="<?php echo $rowbat[0]; ?>" <?php if($rowbat[0]==$row[0]) echo"selected"; ?>><?php echo $rowbat[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space">Number:</span>
</td>
<td>

<select name="btryno" id="btryno">
<option value="">Select</option>
<?php
for($i=1;$i<=16;$i++)
{
?>
<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>
<?php
}
?>
</select>
</td>

<td>
<span class="space">Warranty:</span>
</td>
<td>
<select name="btrywr" id="btrywr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
<td>
<span class="space">Rate:</span> 
</td>
<td>
<input type="text" name="batteryrate" id="batteryrate" />
</td>
</tr>

<!--====Isolation Transformer==========-->
<tr>
<td> <b>Isolation Transformer</b> </td>

<td>
<select name="isot" id="isot">
<option value="0">select</option>
<?php
$qry1=mysql_query("Select * from assets_specification where assets_id='8'");
while($row=mysql_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space"> Number: </span>
</td>

<td>
<select name="isotno" id="isotno">
<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>

<?php }?>
</select>
</td>

<td>
<span class="space">Warranty:</span>
</td>
<td>
<select name="isotwr" id="isotwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
<td>
<span class="space">Rate:</span>
</td>
<td>
 <input type="text" name="isotrate" id="isotrate" />
</td>
</tr>

<!--====Stabilizer==========-->
<tr>
<td> <b> Stabilizer</b></td>

<td>
<select name="stab" id="stab">
<option value="0">select</option>
<?php
$qry1=mysql_query("Select * from assets_specification where assets_id='7'");
while($row=mysql_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space">Number:</span>
</td>

<td>
<select name="stabno" id="stabno">
<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td>
<span class="space">Warranty: </span>
</td>
<td>
<select name="stabwr" id="stabwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>
<td>
<span class="space">Rate:</span>
</td>
<td>
 <input type="text" name="stabrate" id="stabrate" />
</td>
</tr>

<!--====AVR==========-->
<tr>
<td>
<b>AVR</b>
</td>
<td>
<select name="avr" id="avr">
<option value="0">select</option>
<?php
$qry1=mysql_query("Select * from assets_specification where assets_id='10'");
while($row=mysql_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
</td>
<td>
<span class="space"> Number: </span>
</td>

<td>
<select name="avrno" id="avrno">
<option value="">Select</option>
<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<td>
<span class="space"> Warranty: </span>
</td>

<td>
<select name="avrwr" id="avrwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

<td>
<span class="space">Rate:</span> 
</td>
<td>

<input type="text" name="avrrate" id="avrrate" />
</td>
</tr>

<!-- ========================table end for amc assets========================-->
</table>

<!-- ========================table ends for site assets=========================-->
<?php 
 $cnt=$cnt+1;
//}
?>

<input type="hidden" name="type" value="site" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}
?>





