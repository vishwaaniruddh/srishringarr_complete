<?php
//============================For login=========================
function LoginForm()
{
	?>
    
   <link href="style.css" rel="stylesheet" type="text/css" />
<form action="<?php $_SERVER['PHP_SELF']  ?>" method="post">
<table width="291" align="center">
<tr>
<td width="104" height="45">Username : </td>
<td width="175"><input name="uname" type="text" value="<?php if(isset($_POST['uname'])){ echo $_POST['uname']; } ?>" /></td>
</tr>

<tr>
<td height="45">Password : </td>
<td><input name="password" type="password" /></td>
</tr>

<tr>
<td></td>
<td height="45"><input type="submit" value="Login" class="readbutton"/></td>
</tr>

</table>
</form>

    <?php
}
// ============================================NEW CUSTOMER FORM ========================================================================================
function newcustomer()
{
	?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="custform" id="custform" >
<table>

<tr>
<td height="35">Customer Name : </td>
<td><input type="text" name="cust" id="cust" /></td>
</tr>

<tr>
<td height="35">Phone 1 : </td>
<td><input type="text" name="ph1" id="ph2" /></td>
</tr>

<tr>
<td height="35">Phone 2 : </td>
<td><input type="text" name="ph2" id="ph2" /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>

<tr>
<td height="35">Contact Person Name : </td>
<td><input type="text" name="conper" id="conper" /></td>
</tr>

<tr>
<td height="35">Contact Person Number : </td>
<td><input type="text" name="percon" id="percon" /></td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea name="add" id="add" /></textarea></td>
</tr>

<tr>
<td height="35">City : </td>
<td><input type="text" name="city" id="city" /></td>
</tr>

<tr>
<td height="35">state : </td>
<td><input type="text" name="state" id="state" /></td>
</tr>

<tr>
<td height="35">Pin : </td>
<td><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td height="35"><input type="button" value="submit" class="readbutton" name="addnewcust" onclick="validate()"/></td>
</tr>
</table>
</form>
    <?php
}
// ============================================ SERVICE FORM ========================================================================================
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
<td height="35">CC Email : </td>
<td colspan="3">
<?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 order by c.cust_name,e.bank ASC");
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

// ============================================Non Deployment FORM ========================================================================================
function NonDeployment($ref,$user)
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

<form action="process_nonDeployment.php" method="post" name="form" >
<div id="" style="display:block;">
<table border="0">
<tr>
<td height="35">Subject: <input type="text" name="sub" id="sub" /></td>
<td colspan="3">Client Docket number:<input type="text" name="docket" id="docket" /></td>
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

</td>
<!--<td>Select PO NO:	
<select name="po" onchange="PO(this.value);" id="po_no">
<?php if(isset($_POST['po'])){ 
//$asst=	explode("####",$_POST['po']);
?>
<option value="<?php   echo $_POST['po']; ?>"><?php  echo $_POST['po']; ?></option>
<?php } ?>
</select>

</td> -->
</tr>


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
<td colspan="3"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>"  /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="3"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>"  /></td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="3"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>"  /></td>
</tr>
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<select id="branch" name="branch">

<option value="">Select</option>
<?php
$qry1=mysqli_query($con1,"select * from state");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>


<?php } ?>

</select>
</td>
</tr>
<tr>
<td height="35">Address:</td>
<td colspan="3"><textarea name="add" id="add"   rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Pin Code:</td>
<td colspan="3"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>"  /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="3"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>"  /></td>
</tr>

<tr>
<td height="35">Problem : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3">
<?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 order by c.cust_name,e.bank ASC");
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
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $qry2ro[0]; ?>" />
<input type="hidden" name="amcid1" id="amcid1" value="<?php if(isset($_POST['amcid1'])){ echo $_POST['amcid1']; } ?>" />
<input type="hidden" name="sertype" id="sertype" value="<?php if(isset($_POST['sertype'])){ echo $_POST['sertype']; } ?>" />
<input type="hidden" name="cat" id="cat" value="<?php if(isset($_POST['cat'])){ echo $_POST['cat']; } ?>" />
<input type="hidden" name="stdate" id="stdate" value="<?php if(isset($_POST['stdate'])){ echo $_POST['stdate']; } ?>" />
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

// ============================================LOCAL SERVICE FORM ========================================================================================
function localServiceForm($ref,$user)
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
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form" onsubmit="return validate(this)" >


<?php //echo $_POST['po'] ?>

<div id="" style="display:block;">
<table border="0" >
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
<td height="35">Subject: <input type="text" name="sub" id="sub" value="<?php echo $_POST['sub']; ?>" /></td>
<td colspan="3">Client Docket number:<input type="text" name="docket" id="docket" value="<?php echo $_POST['docket']; ?>" /></td>
</tr>
<tr><td width="110">
Customer Name: </td>
<td width="190">
<input type="text" name="cust" id="cust" style="width:150px" value="<?php if(isset($_POST['cust'])){ echo $_POST['cust']; } ?>">


</td><td width="93"> PO NO:	
<?php 
//echo $_POST['po'];
//$asst=	explode("####",$_POST['po']);
//echo $asst[0];
?>
<input type="text" name="po" id="po_no" value="<?php if(isset($_POST['po_no'])){ echo $_POST['po_no']; } ?>">
</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<?php
//echo "hello";
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','hav_acc','Myaccounts123*','hav_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");
?>
<tr><td>Customer unique ID</td><td colspan="3" id="reference">

<input type="text" name="ref" id="ref" value="<?php if(isset($_POST['ref'])){ echo $_POST['ref']; } ?>">
</td></tr>
<tr>
<td height="35">Assets : </td>
<td id="assets" colspan="2" >


<table class="">

<tr><th>Sr No</th><th>Assests with specification</th><th>Warranty</th></tr>

<?php
 //echo $_POST['ref']." ".$asst[1];
 if(isset($_POST['ref'])){ 
 //echo $_POST['ref']." ".$asst[1];
 $cnt=0;
  if($_POST['type']=="amc")
{
//echo "SELECT * FROM amcassets where amcpoid='".$asst[0]."'";
$res=mysqli_query($con1,"SELECT * FROM amcassets where siteid='".$_POST['ref']."'");
//echo "SELECT * FROM amcassets where siteid='".$id."'";

while($atmrow=mysqli_fetch_array($res)){ 
//echo "select * from assets_specification where ass_spc_id='".$atmrow[2]."'";
$qry2=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$atmrow[2]."'");
$row=mysqli_fetch_row($qry2);
//echo "select * from assets where assets_id='".$row[1]."'";
$qry3=mysqli_query($con1,"select * from assets where assets_id='".$row[1]."'");
$row2=mysqli_fetch_row($qry3);
//echo "select * from amcpurchaseorder where amcsiteid='".$id."'";
$qry=mysqli_query($con1,"select * from amcpurchaseorder where amcsiteid='".$_POST['ref']."'");
$row3=mysqli_fetch_row($qry);
//echo "exp".$row3[4];
 $expdt=new DateTime($row3[4]);
 //echo $expdt->format("Y-m-d"); 
?>

<tr><td><?php echo $cnt+1; ?></td>
<td><input type="checkbox" name="assets[]" id="assets[]" onClick="astselect('assets<?php echo $cnt ?>');"  />
<input type="hidden" name="assid[]" value="<?php echo $row[0]; ?>" /><?php echo $row2[1]." (".$row[2].")"; ?></td>
<td><?php if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) { echo "Under AMC<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {
 if($pcb!='pcb')
 $pcb='pcb';
echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } ?></td></tr>

<?php
$cnt=$cnt+1;
}
?>
<input type="hidden" name="type" value="amc" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}
elseif($_POST['type']=="site")
{
$id=$_POST['ref'];
//echo "hi";
$qry4=mysqli_query($con1,"select atm_id,podate from atm where track_id='".$id."'");
	$ro4=mysqli_fetch_row($qry4);
	//echo "select * from installed_sites where Ref_id='".$ro4[0]."'";
//echo "select * from installed_sites where Ref_id='".$ref."'";
//$qry=mysqli_query($con1,"select * from installed_sites where Ref_id='".$ro4[0]."'");
//echo "select * from site_assets where atmid='".$id."'";
$qry=mysqli_query($con1,"select * from site_assets where atmid='".$id."'");	
while($row=mysqli_fetch_array($qry))
{
//echo "select * from assets_specification where ass_spc_id='".$row[4]."'";
	
	$dt=explode(",",$row[5]);
	
	
	$qry2=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$row[4]."'");
$ro=mysqlfetch_row($qry2);
//echo "select * from assets where assets_id='".$ro[1]."'";
$qry3=mysqli_query($con1,"select * from assets where assets_id='".$ro[1]."'");
$row2=mysqli_fetch_row($qry3);

//echo $ro4[1];
$date = strtotime(date("Y-m-d", strtotime($ro4[1])) . " +$dt[0] month");
 $dt2 =date('Y-m-d',$date);

//echo $date = date("Y-m-d", strtotime($ro4[1] +$dt[0]." months"));
$expdt=new DateTime($ro4[1]);
//echo $today->format("Y-m-d");
// echo $expdt->format("Y-m-d");
// echo $row[0];
?>
<tr><td><?php echo $cnt+1; ?></td><td><input type="checkbox" name="assets[]" id="assets<?php echo $cnt; ?>" onClick="approval('pcb',this.id);" value="<?php echo $row[0]; ?>"  />
<input type="hidden" name="assid[]" value="<?php echo $row[0]; ?>" />
<?php echo $row2[1]." (".$ro[2].")"; ?></td><td><?php if(date('Y-m-d')<=$dt2) { echo "UW<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {
if($pcb!='pcb')
 $pcb='pcb'; 
echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } 

?></td></tr>
<?php 
 $cnt=$cnt+1;
}
?>
<input type="hidden" name="type" value="site" id="tp" />

<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}

 }
?></table>
</td>
</tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="2"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="2"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="2"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Address:</td>
<td colspan="2"><textarea name="add" id="add"  readonly rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="2"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="2"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>
<!-- <tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if(isset($_POST['adate'])){ echo $_POST['adate']; } else { echo date('d/m/Y'); } ?>" /></td>
</tr>-->

<tr>
<td height="35">Problem : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if(isset($_POST['appby'])){ echo $_POST['appby']; } ?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $_POST['crby']; ?>" />
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
//========================================================refForm==============================================================
function RefForm()
{
?>
 
Enter Site /ATM ID : <input type="text" name='re' id="re" value="<?php echo $_POST['re'];   ?>">&nbsp;&nbsp;<input type="button" name="refsub" value="Get Detail" onClick="GetRef('re')" >
      
<?php
}
?>