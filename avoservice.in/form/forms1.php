<?php





// ================== SERVICE FORM===========================
function ServiceForm($ref,$user)
{

include("config.php");
if($ref!='' || $ref!=NULL)
{
$re=mysqli_query($con1,"select * from Amc where Ref_id='".$ref."' limit 1");
$refid=mysqli_fetch_row($re);
}
$qry2=mysqli_query($con1,"select srno from login where username='".$user."'");
$qry2ro=mysqli_fetch_row($qry2);

	?>


<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form" >
<div id="" style="display:block;">
<table border="0">
<!--<tr><td>
Select Alert Type : </td>
<td width="221" colspan="2">
<select name="alerttype" id="alerttype" onchange="PCB();;" style="width:200px">


<option value="AMC">AMC</option>
<option value="PCB">Per Call Basis</option>


</select>

</td></tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td ><input type="text" name="appby" id="appby" /></td>
<td valign="top">Reason:<textarea name="how" id="how" /></textarea></td>
</tr></div>-->
<tr>
<td height="35">Subject: <input type="text" name="sub" id="sub" /></td>
<td colspan="3">Site Status:


<select name="docket" id="docket" required>
<option value="">select</option>
<option value="Operational">Operational </option>
<option value="Non Operational">Non Operational</option>

</select>





<!--<input type="text" name="docket" id="docket"  maxlength="30"/>-->

</td>
</tr>
<tr><td width="110">
Select Customer : </td>
<td width="190">
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">
<option value="">select</option>
<?php
$qry1=mysqli_query($con1,"select * from customer");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>


<?php } ?>
</select>

</td><td>Select PO NO:	
<select name="po" onchange="PO(this.value);" id="po_no">
<?php if(isset($_POST['po'])){ 
//$asst=	explode("####",$_POST['po']);
?>
<option value="<?php   echo $_POST['po']; ?>"><?php  echo $_POST['po']; ?></option>
<?php } ?>
</select>

</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<?php
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','hav_acc','Myaccounts123*','hav_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");
?>
<tr><td>Site / ATM ID</td><td colspan="3" id="reference">
<select name="ref" id="ref" onchange="">
<?php if(isset($_POST['ref'])){ 
?>
<option value="<?php  echo $_POST['ref']; ?>"><?php  echo $_POST['ref']; ?></option>
<?php } ?>
</select></td></tr>
<tr>
<td height="35">Assets : </td>
<td id="assets" colspan="3">

</td>
</tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="3"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="3"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="3"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>
<!--======Branch Selection Here===================-->
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<select id="branch" name="branch">

<option value="">Select</option>
<?php
$qrystate=mysqli_query($con1,"select * from avo_branch");
while($qrystate1=mysqli_fetch_row($qrystate)){
?>
<option value="<?php echo $qrystate1[0]; ?>" ><?php echo $qrystate1[1]; ?></option>


<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">Address:</td>
<td colspan="3"><textarea name="add" id="add"  rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="3"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="3"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>
<!-- <tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if(isset($_POST['adate'])){ echo $_POST['adate']; } else { echo date('d/m/Y'); } ?>" /></td>
</tr>-->

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" maxlength="20" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone"  onkeypress="return isNumber(event)" maxlength="10"    id="cphone" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Type Of Call : </td>
<td colspan="3">
<select name="type_call" id="type_call" onchange="pmdisable(this.value);">
<option value="service">Service Call</option>
<option value="pm">PM Call</option>
<option value="dere"> De-Re Installation</option>
</select>
</td>
</tr>

<tr>
<td height="35">Problem : </td>


<td><select id="ddl_prob" name="ddl_prob" onchange="DDL_Problem()" required>
<option value="">Select Problems</option>

<option value="UPS Down">UPS Down</option>
<option value="UPS Backup issue">UPS Backup issue </option>
<option value="UPS Beep Sound">UPS Beep Sound</option>
<option value="Servo Issue">Servo Issue</option>
<option value="IT Not Working">IT Not Working</option>

<option value="UPS Output abnormal">UPS Output abnormal</option>
<option value="Solar Issue">Solar Issue</option>
<option value="Others">Others</option>
</select></td>



<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob" style="color:black" readonly> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>

<tr>
<td height="35">WhatsApp Group: </td>
<td colspan="3"><?php
include ("config.php");
$whatcc=mysqli_query($con1,"select * from whatsapp_groupname where cust_id='".$_GET['cid']."' and type='service' order by groupname ASC");
//echo "select * from whatsapp_groupname where cust_id='".$_GET['cid']."' and type='service' order by groupname ASC";
$whatarray=array();
?>
<input type="checkbox" name="whatsgrp" id="whatsgrp" checked>
<select name='whatsgroup' id='whatsgroup' onchange="getno(this.value);">
<option value=""> Select Groups</option>
<?php
while($whatsrow=mysqli_fetch_row($whatcc))
{
?>
<option value="<?php echo $whatsrow[0]; ?>"><?php echo $whatsrow[2]." - ".$whatsrow[1]; ?></option>
<?php
}
?>
</select>
</br>Enter only whatsApp numbers separated with Comma (,)
<textarea name="whatsno" id="whatsno"  onkeypress="CheckNumeric(event);" rows=3 cols=25><?php if(isset($_POST['whatsno'])){ echo $_POST['whatsno']; } ?></textarea></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3">
<?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_id='".$_GET['cid']."' order by e.bank ASC");
?><input type="checkbox" name="sendmail" id="sendmail" checked>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if(isset($_POST['appby'])){ echo $_POST['appby']; } ?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3">
<textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>

<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $qry2ro[0]; ?>" />
</td>

</tr></div>	
<tr>
<td height="35" colspan="4"><input type="submit" value="submit" class="readbutton" id="submit" /></td>
</tr>

</table>
</div>
</form>
<?php
}

//=============refForm=======================================
function RefForm()
{
?>
 
Enter Site /ATM ID : <input type="text" name='re' id="re" value="<?php echo $_POST['re'];   ?>">&nbsp;&nbsp;<input type="button" name="refsub" value="Get Detail" onClick="GetRef('re')" >
      
<?php
}
?>