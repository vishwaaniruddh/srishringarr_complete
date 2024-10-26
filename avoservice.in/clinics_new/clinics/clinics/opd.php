<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');


$id=$_GET['id'];
$sql="select * from  patient where no='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
	
var a = document.opdform.diagn;
//alert(a.value);
var add = a.value+',';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+',';

document.opdform.adv.value += add;
return true;
}

function addThem2(){
	
var a = document.opdform.compl;
//alert(a.value);
var add = a.value+',';

document.opdform.comp.value += add;
return true;
}

function addThem3(){
	
var a = document.opdform.findi;
//alert(a.value);
var add = a.value+',';

document.opdform.findin.value += add;
return true;
}
//////////////subcat
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {// alert(xmlhttp.responseText);
    document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
  var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","sub_cat.php?cat="+cat,true);

xmlhttp.send();
}
</script>
<!-- end multiple selection -->

<!-- validation-->
<script type="text/javascript">

function opdvalidate(opdform){
 with(opdform)
 {
  

if(date.value=="")
{
	alert("Please select Date");
	date.focus();
	return false;
}
 
}
 return true;
 }
 ////upload image
function upp(){
var newdiv=document.createElement("div");
var aTextBox=document.createElement('input');
aTextBox.type = 'file';
aTextBox.name = 'image[]';
aTextBox.style='background:none; border:none;';

 //append text to new div
newdiv.appendChild(aTextBox); //append text to new div
//alert(aTextBox)
document.getElementById("img").appendChild(newdiv); 
}
</script><!--end validation-->

<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	
	background: #00a4ae;
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.2em;
	position: relative;
	top: 1%; left: 20%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#fff; 
	font-size:13px; 
	line-height:18px;
} 

form.signin .textbox input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:300px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.formbutton { 
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
	width:100px;
}

form.signin td{ font-size:12px; }
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div id="" class="login-popup">

         <form method="post" class="signin" action="new_opd.php" name="opdform" onSubmit="return opdvalidate(this)" enctype="multipart/form-data">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">OPD</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $row[2]; ?>"/>
                
                <table>
                <tr>
                <td>Upload Report</td>
                <td colspan="3"><div id="img"><input type="file" name="image[]" id="image[]" style="background:none; border:none;"></div>
                <br/>
                <a href="#" onclick="upp()">Add More</a><br/></td>
                </tr>
                <tr>
                <td><label class="name">Name:</label></td>
                <td><input id="name" name="name" type="text" value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;"/> </td>
                <td><label class="age">Age:</label></td>
                <td><input id="age" name="age" type="text" value="<?php echo $row[26]; ?>" readonly style="background-color:#DCDCDC;"/></td>
                </tr>
                                
                <tr>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text" value="<?php echo $row[23]; ?>" readonly style="background-color:#DCDCDC;"/></td>
                
<?php 
$sql2="select * from doctor ";
$result2 = mysql_query($sql2);

?>
                <td> <label class="ref">Reference By: </label></td>
                <td>
                <select name="ref" style="width:300px; height:25px; border:1px #ac0404 solid;background-color:#DCDCDC;">
                <?php while($row2=mysql_fetch_row($result2)) { ?>
                <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="date">Date: </label></td>
                <td><input id="date" name="date" type="text" onClick="displayDatePicker('date');"></td>
                </tr>
                </table>
                
<?php
//$sql="select * from  opdbill ";
//$res = mysql_query($sql);
//$row5 = mysql_fetch_row($res);
?>                
                <table>
                <tr>
                <td width="89">Consultation: </td><td width="109"><input type="radio" name="type" id="con" style="width:15px;" onclick="confun();"/><input type="text" style="width:50px;display:none;" id="cons" value="" /></td>
                <td width="121">Plaster Application: </td><td width="60"><input type="text" style="width:50px;" name="pa" id="pa"/></td>
                </tr>
                
                <tr>
                <td>Follow-up: </td><td><input type="radio" name="type" id="fol" style="width:15px;" onclick="confun();"/><input type="text" style="width:50px;display:none;" id="foll"  /></td>
                <td>Plaster Removal: </td><td><input type="text" style="width:50px;" name="pr" id="pr"/></td>
                </tr>
                
                <tr>
                <td>X-Ray: </td><td><input type="checkbox"  style="width:15px;" id="xr" onclick="ab();"/><input type="text" style="width:50px;display:none;" id="xray" name="xray"  /></td>
                <td>Reduction: </td><td><input type="text" style="width:50px;" name="red" id="red"/></td>
                </tr>
                
                <tr>
                <td>Dressing: </td><td><input type="checkbox"  name="dres" id="dres" style="width:15px;" onclick="dresfun();"/><input type="text" style="width:50px;display:none;" id="drestxt" name="drestxt"  /></td>
                <td>Operation: </td><td><input type="text" style="width:50px;" name="op" id="op"/></td>
                </tr>
                
                <tr>
                <td>Strapping: </td><td><input type="checkbox" name="str" id="str" style="width:15px;" onclick="strfun();"/><input type="text" name="strtxt" id="strtxt" style="width:50px;display:none;"  /></td>
                <td>Suturing: </td><td><input type="text" style="width:50px;" name="sut" id="sut"/></td>
                </tr>
                
                <tr>
                <td>ECG: </td><td><input type="checkbox" name="ecg" id="ecg" style="width:15px;" onclick="ecgfun();"/><input type="text" style="width:50px;display:none;" name="ecgtxt" id="ecgtxt"  /></td>
                <td>Certificate: </td><td><input type="text" style="width:50px;" name="cer" id="cer"/></td>
                </tr>
                
                <tr>
                <td>Injection: </td><td><input type="text" style="width:50px;" name="inj" id="inj"/></td>
                <td>Other: </td><td><input type="text" style="width:50px;" name="oth" id="oth"/></td>
                </tr>
                
                <tr>
                <td>Paid: </td><td><input type="text" style="width:70px;" name="tot" id="tot" readonly="readonly" onclick="pqr();"/></td>
                </tr>
                </table>
                                
<?php
include ('config.php');
$result4=mysql_query("select * from compla");
?>     
                <table>
                <tr>
                <td><label class="comp"><span> Complaints: </span>
                <select name="compl" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem2()">
                <option value="0">-Select-</option>
                <?php while ($row4=mysql_fetch_row ($result4))
				{ ?>
                <option value="<?php echo $row4[0];?>"><?php echo $row4[0];?></option>
                <?php } ?>
				</select><br />
                <textarea name="comp" cols="35" rows="3" style="resize:none;"></textarea>
                </label>
                </td>
                
<?php

$result5=mysql_query("select * from finding");
?>
                <td>
                <label class="find">
                <span> Findings: </span>
                <select name="findi" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem3()">
                <option value="0">-Select-</option>
                <?php while ($row5=mysql_fetch_row ($result5))
				{ ?>
                <option value="<?php echo $row5[0];?>"><?php echo $row5[0];?></option>
                <?php } ?>
                </select><br />
                <textarea name="findin" cols="35" rows="3" style="resize:none;"></textarea>
                </label>
                </td>
                </tr>
<?php

$result6=mysql_query("select * from advise");
?>                
                <tr>
                <td><label class="rec">
                <span>Advised:</span>
                <select name="rec" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem1()">
                <option value="0">-Select-</option>
                <?php while ($row6=mysql_fetch_row ($result6))
				{ ?>
                <option value="<?php echo $row6[0];?>"><?php echo $row6[0];?></option>
                <?php } ?>
                </select><br />
                <textarea name="adv" cols="35" rows="3" style="resize:none;"></textarea>
                </label>
                </td>
<?php 

$result3 = mysql_query("select * from diag");
?>               
                <td>
                <label class="diagnosis">
                <span> Diagnosis: </span>
                <select name="diagn" style="width:300px; border:1px #ac0404 solid;" onChange="addThem()">
                <option value="0">-Select-</option>
                <?php while($row=mysql_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select><br />
                <textarea name="diag" cols="35" rows="3" style="resize:none;"></textarea>
                </label>
                </td>
                </tr>
                </table>
                
<?php 

?>               
                <table border="1">
                <th>Medicine Name </th><th>How to Take </th><th>Dosage </th>
                <?php for($j=0;$j<=2;$j++){?>
                <tr>
                <td>
                <select style="width:140px;" name="med[]">
                <option value="0">Select</option>
                <?php $result3 = mysql_query("select * from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td>
                
<?php 

$result4 = mysql_query("select * from medicine");
?>                  
                <td>
                <select style="width:140px;" name="tak[]">
                <option value="0">Select</option>
                 <?php 
				    while($row=mysql_fetch_row($result4)){ ?>
					<option value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>
				 <?php } ?>
                </select>
                </td>
                
                <td>
                <select style="width:140px;" name="dos[]">
                <option value="0">Select</option>
                <option value="1..0..0">1..0..0</option>
                <option value="1..0..1">1..0..1</option>
                <option value="1..1..1">1..1..1</option>
                <option value="0..0..1">0..0..1</option>
                <option value="0..1..1">0..1..1</option>
                <option value="1..1..1..1">1..1..1..1</option>
                <option value="1/2..0..0">1/2..0..0</option>
                </select>
                </td>
                </tr>

<?php 
				}
				

$result3 = mysql_query("select * from medicine");
?>


                <tr>
                <td colspan="3">
                     
                <table border="1" id="med" style="display:none;" >
                <?php for($r=1;$r<=3;$r++){ ?>
                <tr>
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                <?php  $result3 = mysql_query("select * from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td>
                
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                 <?php  $result4 = mysql_query("select * from how_to_take ");
				    while($row=mysql_fetch_row($result4)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				 <?php } ?>
                </select>
                </td>
                
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
                </td>
                </tr>

<?php } ?>
                </table>
                
                </td></tr>
                <tr><td align="right" colspan="3" style="border:none;"><a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;">Add More </a>    </td></tr>
                </table>   
                                                                               
                <button class="submit formbutton" type="submit" name="Submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
          </form>
      
</div>
<script>
function ab(){
var cb=document.getElementById('xr');
if (cb.checked==true)
{
	document.getElementById('xray').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('xray').value);
	
}
	else { document.getElementById('xray').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('xray').value);
}
}
function dresfun(){
var dc=document.getElementById('dres');
if (dc.checked==true)
{
	document.getElementById('drestxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('drestxt').value);
}
	else 
	{
		document.getElementById('drestxt').style.display='none';
		document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('drestxt').value);
}
}

function strfun(){
var sc=document.getElementById('str');
if (sc.checked)
{
	document.getElementById('strtxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('strtxt').value);
}
	else { document.getElementById('strtxt').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('strtxt').value);
	}
}

function ecgfun(){
var ec=document.getElementById('ecg');
if (ec.checked)
{
	document.getElementById('ecgtxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('ecgtxt').value);
}
	else { document.getElementById('ecgtxt').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('ecgtxt').value);
}
}
function confun(){
var cc=document.getElementById('con');
var fc=document.getElementById('fol');
if (cc.checked)
{
	document.getElementById('cons').style.display='inline';
	document.getElementById('foll').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('cons').value);

}
	else if (fc.checked) { 
	document.getElementById('foll').style.display='inline';
	document.getElementById('cons').style.display='none'; 
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('foll').value);
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('cons').value);
	}
}

function paid() {
		 
var a=Number(document.getElementById("cons").value); 
var b=Number(document.getElementById("foll").value); 
var c=Number(document.getElementById("xray").value);
var d=Number(document.getElementById("drestxt").value);
var e=Number(document.getElementById("strtxt").value);
var f=Number(document.getElementById("ecgtxt").value);
var g=Number(document.getElementById("inj").value);
var h=Number(document.getElementById("pa").value);
var i=Number(document.getElementById("pr").value);
var j=Number(document.getElementById("red").value);
var k=Number(document.getElementById("op").value);
var l=Number(document.getElementById("sut").value);
var m=Number(document.getElementById("cer").value);
var n=Number(document.getElementById("oth").value);
var cc=document.getElementById('con');
var fc=document.getElementById('fol');


 if (isNaN(a) || isNaN(b)  || isNaN(g) || isNaN(h)  || isNaN(i) || isNaN(j)|| isNaN(k) || isNaN(l) || isNaN(m) || isNaN(n) ) { alert("Please enter only numbers."); return false; } 

if (cc.checked)
{
var grandtotal=a+g+h+i+j+k+l+m+n; } else var grandtotal=b+g+h+i+j+k+l+m+n;

document.getElementById("tot").value=grandtotal.toFixed(2); 
return false; 
} 

</script>
<?php 
}else
{ 
 header("location: index.html");
}
?>