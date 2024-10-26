<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';
if(isset($id)){
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql1="select * from patient where no='$row[1]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);
}
?>
<script>
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}
////for print
function pres(){
//alert ("isuhgf");
	var cond=document.getElementById('condi').value;
	var amtc=document.getElementById('amtc').value;
	var amtad=document.getElementById('amtad').value;
	var rem=document.getElementById('rem').value;
	var code=document.getElementsByClassName('code');
	var proc=document.getElementsByClassName('proc'); 
	var other=document.getElementsByClassName('other'); 
	var code=document.getElementsByClassName('code'); 
	var rate=document.getElementsByClassName('rate');
	var amt=document.getElementsByClassName('amt');
	var proc1=""; var other1=""; var code1="";var rate1="";var amt1="";var sr1="";
	var implan=document.getElementById('implan').value;
	var other_proc=document.getElementsByClassName('other_proc'); 
	var other_rate=document.getElementsByClassName('other_rate'); var other_proc1=""; var other_rate1="";
	
	for(i=0;i<proc.length;i++) {
		
		proc1=proc1+proc[i].value+"<br>";
		
	    other1=other1+other[i].value+"<br>";
	
	    code1=code1+code[i].value+"<br>";
		
		rate1=rate1+rate[i].value+"<br>";
		
		amt1=amt1+amt[i].value+"<br>";
		
		
	}
	
	for(r=0;r<other_proc.length;r++) {
		
		other_proc1=other_proc1+other_proc[r].value+"<br>";
		
	    other_rate1=other_rate1+other_rate[r].value+"<br>";
	}
	
	/*popcontact('esi_print.php?id=<?php //echo $id; ?>&cond='+cond+'&impalnt='+implant+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&proc1='+proc1+'&other1='+other1+'&code1='+code1+'&rate1='+rate1+'&amt1='+amt1);
	
	for(i=0;i<proc.length;i++) {
		
		
	    code1=code1+code[i].value+"<br>";
		
	
	}*/
	popcontact('esi_print.php?id=<?php echo $id; ?>&cond='+cond+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&code1='+code1+'&proc1='+proc1+'&other1='+other1+'&rate1='+rate1+'&amt1='+amt1+'&implan='+implan+'&other_proc1='+other_proc1+'&other_rate1='+other_rate1);
}

var searchReq = getXMLHttp();

function getXMLHttp()

{

  var xmlHttp

// alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari

    xmlHttp = new XMLHttpRequest();

  }

  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

    catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

        return false;

      }

    }

  }

  return xmlHttp;

}
function MakeRequest()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText;//.split("___///");
//document.getElementById('cnt').value=str[0];
//alert(str);
      HandleResponse(str);

    }

  }

// alert("hi2");
var cnt=parseInt(document.getElementById('cnt').value)+1;
//alert(cnt);
 document.getElementById('cnt').value=cnt;
 xmlHttp.open("GET", "getMore.php?cnt="+cnt, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
var ni =document.getElementById('detail');

var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

var newdiv = document.createElement('tr');

var divIdName = num;

newdiv.setAttribute('id',divIdName);

newdiv.innerHTML =response;
ni.appendChild(newdiv);

}

function MakeRequest1()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText;//.split("___///");
//document.getElementById('cnt').value=str[0];
//alert(str);
      HandleResponse1(str);

    }

  }

// alert("hi2");
var cnt=parseInt(document.getElementById('cnt1').value)+1;
//alert(cnt);
 document.getElementById('cnt1').value=cnt;
 xmlHttp.open("GET", "getMore1.php?cnt="+cnt, false);

  xmlHttp.send(null);

}
function HandleResponse1(response)

{
//alert(response);
var ni =document.getElementById('detail1');
/*
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;
*/
var newdiv = document.createElement('tr');
/*
var divIdName = num;

newdiv.setAttribute('id',divIdName);
*/
newdiv.innerHTML =response;
ni.appendChild(newdiv);

}

function MakeRequest2()

{

  var xmlHttp = getXMLHttp();

//alert("hi");
  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText;//.split("___///");
//document.getElementById('cnt').value=str[0];
//alert(str);
      HandleResponse2(str);

    }

  }

// alert("hi2");
var cnt=parseInt(document.getElementById('cnts').value)+1;
//alert(cnt);
 document.getElementById('cnts').value=cnt;
 xmlHttp.open("GET", "getMore2.php?cnt="+cnt, false);

  xmlHttp.send(null);

}
function HandleResponse2(response)

{
//alert(response);
var ni =document.getElementById('detail2');
/*
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;
*/
var newdiv = document.createElement('tr');
/*
var divIdName = num;

newdiv.setAttribute('id',divIdName);
*/
newdiv.innerHTML =response;
ni.appendChild(newdiv);

}

function MakeRequest3()

{

  var xmlHttp = getXMLHttp();

//alert("hi");
  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText;//.split("___///");
//document.getElementById('cnt').value=str[0];
//alert(str);
      HandleResponse3(str);

    }

  }

// alert("hi2");
var cnt=parseInt(document.getElementById('cntst').value)+1;
//alert(cnt);
 document.getElementById('cntst').value=cnt;
 xmlHttp.open("GET", "getMore3.php?cnt="+cnt, false);

  xmlHttp.send(null);

}
function HandleResponse3(response)

{
//alert(response);
var ni =document.getElementById('detail3');
/*
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;
*/
var newdiv = document.createElement('tr');
/*
var divIdName = num;

newdiv.setAttribute('id',divIdName);
*/
newdiv.innerHTML =response;
ni.appendChild(newdiv);

}

</script>

<script>
////////////get charges

function otherproc(src1)
{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('other_rate'+src1).value=str[0];
document.getElementById('other_crate'+src1).value=str[0];
//alert(str[1]);
      HandleResponse(str[1]);

    }

  }

// alert("hi2");
var other_proc=document.getElementById('other_proc'+src1).value;
 xmlHttp.open("GET", "get_rate.php?other_proc="+other_proc, false);

  xmlHttp.send(null);

}


function proce(src)
{

  var xmlHttp = getXMLHttp();

//alert(src);

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('code'+src).value=str[1];
document.getElementById('rate'+src).value=str[0];
document.getElementById('amt'+src).value=str[0];
//alert(parseFloat(document.getElementById('amtc').value)+parseFloat(str[0]));
//document.getElementById('amtc').value=parseFloat(document.getElementById('amtc').value)+parseFloat(str[0]);
//alert(str[0]+"<>"+str[1]);
    //  HandleResponse(str[1]);

    }

  }

var proc=document.getElementById('proc'+src).value; 
 //alert(proc);
 xmlHttp.open("GET", "get_rate1.php?proc="+proc, false);

  xmlHttp.send(null);

}

function proces(src)
{

  var xmlHttp = getXMLHttp();

//alert(src);

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('codes'+src).value=str[1];
document.getElementById('rates'+src).value=str[0];
document.getElementById('amts'+src).value=str[0];
//alert(str[0]+"<>"+str[1]);
    //  HandleResponse(str[1]);

    }

  }

// alert("hi2");
var proc=document.getElementById('procs'+src).value; 

 xmlHttp.open("GET", "get_rate1.php?proc="+proc, false);

  xmlHttp.send(null);

}

function getsum()
{
// alert("callme");
 var a1 = parseInt(document.getElementById('amtc').value);
 var a2 = parseInt(document.getElementById('amtcII').value);
 var a3 = parseInt(document.getElementById('amtcIII').value);
 var a4 = parseInt(document.getElementById('amtcIV').value);
 document.getElementById('totalamt').value=a1+a2+a3+a4;
 
}

function getSum1()
{
var cnt1=parseInt(document.getElementById('cnt').value);
// alert(cnt1);
var tot=0;
for(var xy=0;xy<cnt1;xy++)
{
 if(document.getElementById('amt'+xy).value!=""){
 tot+= parseInt(document.getElementById('amt'+xy).value);
 //alert(tot);
 }
/* var a2 = parseInt(document.getElementById('amtcII').value);
 var a3 = parseInt(document.getElementById('amtcIII').value);
 var a4 = parseInt(document.getElementById('amtcIV').value);*/

 }
  document.getElementById('amtc').value=parseInt(document.getElementById('implan').value)+tot;
}

function getSum2()
{
var cnt1=parseInt(document.getElementById('cnt1').value);
// alert(cnt1);
var tot=0;
for(var xy=0;xy<cnt1;xy++)
{
 if(document.getElementById('other_crate'+xy).value!=""){
 tot+= parseInt(document.getElementById('other_crate'+xy).value);
 //alert(tot);
 }
/* var a2 = parseInt(document.getElementById('amtcII').value);
 var a3 = parseInt(document.getElementById('amtcIII').value);
 var a4 = parseInt(document.getElementById('amtcIV').value);*/

 }
  document.getElementById('amtcII').value=tot;
}

function getSum3()
{
var cnt1=parseInt(document.getElementById('cnts').value);
// alert(cnt1);
var tot=0;
for(var xy=0;xy<cnt1;xy++)
{
 if(document.getElementById('amts'+xy).value!=""){
 tot+= parseInt(document.getElementById('amts'+xy).value);
 //alert(tot);
 }
/* var a2 = parseInt(document.getElementById('amtcII').value);
 var a3 = parseInt(document.getElementById('amtcIII').value);
 var a4 = parseInt(document.getElementById('amtcIV').value);*/

 }
  document.getElementById('amtcIII').value=tot;
}

function getSum4()
{
var cnt1=parseInt(document.getElementById('cntst').value);
// alert(cnt1);
var tot=0;
for(var xy=0;xy<cnt1;xy++)
{
 if(document.getElementById('amtst'+xy).value!=""){
 tot+= parseInt(document.getElementById('amtst'+xy).value);
 //alert(tot);
 }
/* var a2 = parseInt(document.getElementById('amtcII').value);
 var a3 = parseInt(document.getElementById('amtcIII').value);
 var a4 = parseInt(document.getElementById('amtcIV').value);*/

 }
  document.getElementById('amtcIV').value=tot;
}

function netamt1(xyz)
{
//alert(xyz+"--");
var rate=document.getElementById('rate'+xyz).value; 
//alert(rate)
var qty=document.getElementById('qty'+xyz).value; 
document.getElementById('amt'+xyz).value=parseInt(rate)*parseInt(qty); 
}

function netamt2(xyz)
{
//alert(xyz+"--");
var rate=document.getElementById('other_rate'+xyz).value; 
//alert(rate)
var qty=document.getElementById('other_qty'+xyz).value; 
document.getElementById('other_crate'+xyz).value=parseInt(rate)*parseInt(qty); 
}

function netamt3(xyz)
{
//alert(xyz+"--");
var rate=document.getElementById('rates'+xyz).value; 
//alert(rate)
var qty=document.getElementById('qtys'+xyz).value; 
document.getElementById('amts'+xyz).value=parseInt(rate)*parseInt(qty); 
}

function netamt4(xyz)
{
//alert(xyz+"--");
var rate=document.getElementById('rate'+xyz).value; 
//alert(rate)
var qty=document.getElementById('qty'+xyz).value; 
document.getElementById('amt'+xyz).value=parseInt(rate)*parseInt(qty); 
}

</script>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

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
	top: 0%; left: 3%;
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
	width:200px;
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

<!--Discharge form-->
<div  class="login-popup">

            
          <form method="post" class="signin" action="process_esi.php" >		  
          
                 <input type="hidden" name="myvar" value="0" id="theValue" />
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Individual Case Format</p>
           
                <input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                <input type="hidden" name="pid" value="<?php echo $row[1]; ?>"  />
                
                <table id="ds">
				
				<tr>
                <td><label class="fdiag">Bill no. :</label></td>
                <td><input id="bill" name="bill" type="text" value="<?php if(isset($id)){echo $id;} ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr> 
            	<td width="306">Name :</td>
                <td width="168"><input id="name" name="name" type="text" value="<?php if(isset($row1[6])) {echo $row1[6];} ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Age/Sex :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php if(isset($row1[26],$row1[27])) {echo $row1[26],$row1[27];} ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php if(isset($row1[20])) {echo $row1[20];} ?></textarea></td>
				</tr>
                
                <tr>
                <td><label class="datead">Contact No:</label></td>
                <td> <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php if(isset($row1[23])) {echo $row1[23];} ?>" readonly="readonly"></td>
                </tr>
               
                <tr>
                <td><label class="fdiag">Insurance Number/Staff Card No/Pensioner Card no. :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php if(isset($row1[39])) {echo $row1[39];} ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
				
				<tr>
                <td><label class="fdiag">Insurance Pensioner Name :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php if(isset($row1[40])) {echo $row1[40];} ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
		<tr>
                <td><label class="refno">Referral S.No.(Routine) /<br />
                                         Emergency/ through SSMC/SMC :</label></td>
                <td><input id="refno" name="refno" type="text" value="<?php if(isset($row1[34])) {echo $row[34];} ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>

                <tr>
                <td><label class="datead">Date of Referral :</label></td>
                <td><input id="dateref" name="dateref" type="text" value="<?php if(isset($row[35]) and $row[35]!='0000-00-00') echo date('d/m/Y',strtotime($row[35])); ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>               
                
				 <tr>
                <td><label class="datead">Date of Admission :</label></td>
                <td><input id="datedoa" name="datedoa" type="text" value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3]))." ".$row[4]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>               
				
				<tr>
                <td><label class="inv">Department:</label></td>
                <td><input type="text" name="dept" id="dept"  /></td>
                </tr>
				
				<tr>
                <td><label class="inv">Consultant:</label></td>
                <td><input type="text" name="consult" id="consult" /></td>
                </tr>
				
                <tr>
                <td><label class="inv">Diagnosis:</label></td>
                <td><textarea name="diag" id="diag" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" ><?php if(isset($row1[9])) {echo $row[9];} ?></textarea></td>
                </tr>
                
				<tr>
                <td><label class="datead">Date of Discharge :</label></td>
                <td><input id="datedis" name="datedis" type="text" value="<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?>" style="background-color:#DCDCDC;"></td>
                </tr>               
				
				<tr>
                <td><label class="datead">Time of Discharge :</label></td>
                <td><input id="timedis" name="timedis" type="text" value="<?php if(isset($row1[6]))  {echo $row[6];} ?>" style="background-color:#DCDCDC;"></td>
                </tr>               
				
                <tr>
                <td><label>Condition of the patient at discharge:</label></td>
                <td><textarea name="condi" id="condi" rows="3" cols="22" style="resize:none;" ></textarea></td>
                </tr>
                
                <tr>
                <td><label><B>(For Package rates)</b></label><br>
                Treatment/Procedure done/performed : <br>
                <b>I. Existing in the package rate list�s</b></td>
                <td></td>
                </tr>

                <tr><td colspan="4"> CGHS/other Code no/nos for chargable procedures : 
             
                <table width="882" border="1" id="detail">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Chargeable Procedure</th>
                <th width="205">CGHS Code no with page no (1)</th>
                <th width="202">Other if not on (1) prescribed code no with page no</th>
                <th width="84">Rate</th><th width="40">Qty</th>
                <th width="202">Amt. Claimed</th>
				<th width="202">Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
             
                <?php 
		         $cnt=0;
			     for($j=0;$j<=4;$j++){
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><input type="hidden" value="<?php echo $cnt; ?>" name="sr[]" id="sr" class="sr" /><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="proc[]" id="proc<?php echo $j; ?>" class="proc" onchange="proce(<?php echo $j; ?>);">
                <option value="0">Select</option>
                <?php 
				$sq=mysqli_query($con,"select * from procedures where investigation<>'' order by investigation");
				while($ro=mysqli_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[4]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="code[]" id="code<?php echo $j; ?>" class="code"></td>
                
                <td><input type="text" name="other[]" id="other<?php echo $j; ?>" class="other"></td>        

				<td><input type="text" name="rate[]" id="rate<?php echo $j; ?>" class="rate" style="width:140px;" /></td>
                <td><input type="text" name="qty[]" id="qty<?php echo $j; ?>" value="1" class="rate" style="width:40px;" onchange="netamt1(<?php echo $j; ?>);" /></td>
                <td><input type="text" name="amt[]" id="amt<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
				<td><input type="text" name="amtdt[]" id="amtdt<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="amtad[]" id="amtad<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="rem[]" id="rem<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                </tr>

                <?php  } ?><input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>" />
                </table>
           
                <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest();">Add More </a>
                </td></tr>
               <tr>
                <td>Charges of Implant/device used : </td>
                <td><input type="text" name="implan" id="implan" value="0"> </td>
                <td width="153">Amount Claimed (I): </td>
                <td width="224"><input type="text" name="amtc" id="amtc" value="0" onfocus="getSum1();"> </td>
                </tr>
             
                <tr>
                <td>Amount Admitted (I): </td>
                <td><input type="text" name="amtad1" id="amtad1"> </td>
                <td>Remarks : </td>
                <td><input type="text" name="rem1" id="rem1"> </td>
                </tr>
               <tr><td><b>II. (Non-package Rates) For procedures done (not existing in the list of packages rates)</b></td></tr>
               <tr>
               <td colspan="4">
              
               <table border="1" id="detail1">
               <th>Sr.no</th><th>Chargeable Procedure</th><th>Rate</th><th>Qty</th><th>Amt. Claimed</th><th>Date of Claim</th><th>Amt. Admitted with date (X)</th><th>Remarks (X)</th>
               <?php 
			   $cnt1=0;
			   for($a=0;$a<=2;$a++) {
			   $cnt1=$cnt1+1; ?>
                <tr>
                <td width="17"><?php echo $cnt1; ?></td>
                <td width="151">
                <select style="width:140px;" name="other_proc[]" id="other_proc<?php echo $a; ?>" class="other_proc" onchange="otherproc(<?php echo $a; ?>);">
                <option value="0">Select</option>
                <?php $sq1=mysqli_query($con,"select * from other_charges ");
				while($ro1=mysqli_fetch_row($sq1)){
				?>
                <option value="<?php echo $ro1[0]; ?>"><?php echo $ro1[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td width="148"><input type="text" name="other_rate[]" id="other_rate<?php echo $a; ?>" class="other_rate" ></td>
		<td width="40" ><input type="text" name="other_qty[]" id="other_qty<?php echo $a; ?>" value="1" class="other_rate" onchange="netamt2(<?php echo $a; ?>);"></td>
		<td width="148"><input type="text" name="other_crate[]" id="other_crate<?php echo $a; ?>" class="other_rate" ></td>
		<td width="148"><input type="text" name="other_cdate[]" id="other_cdate<?php echo $a; ?>" class="other_rate" ></td>
                <td width="148"><input type="text" name="other_adrate[]" id="other_adrate<?php echo $a; ?>" class="other_rate" ></td>
                <td width="148"><input type="text" name="other_rem[]" id="other_rem<?php echo $a; ?>" class="other_rate" ></td>
                </tr><?php } ?><input type="hidden" name="cnt1" id="cnt1" value="<?php echo $cnt1; ?>" />
                </table>
				<a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest1();">Add More </a>
				</td></tr>
		<tr>
                <td>Amount Claimed (II): </td>
                <td><input type="text" name="amtcII" id="amtcII" onfocus="getSum2()"> </td>
                <td>Amount Admitted (II): </td>
                <td><input type="text" name="amtadII" id="amtadII"> </td>
                </tr>
                <tr><td><b>III. Additional Procedure Done with rationale and documented permission</b></td></tr>
                <tr><td colspan="4">             
                <table width="882" border="1" id="detail2">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Chargeable Procedure</th>
                <th width="205">CGHS Code no with page no (1)</th>
                <th width="202">Other if not on (1) prescribed code no with page no</th>
                <th width="84">Rate</th><th width="40">Qty</th>
                <th width="202">Amt. Claimed</th><th>Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
             
                <?php 
		         $cnt=0;
			     for($j=0;$j<=4;$j++){
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><input type="hidden" value="<?php echo $cnt; ?>" name="sr1[]" id="sr1" class="sr" /><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="procs[]" id="procs<?php echo $j; ?>" class="proc" onchange="proces(<?php echo $j; ?>);">
                <option value="0">Select</option>
                <?php 
				$sq=mysqli_query($con,"select * from procedures where investigation<>'' order by investigation");
				while($ro=mysqli_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[4]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="codes[]" id="codes<?php echo $j; ?>" class="code"></td>
                
                <td><input type="text" name="others[]" id="others<?php echo $j; ?>" class="other"></td>        

				<td><input type="text" name="rates[]" id="rates<?php echo $j; ?>" class="rate" style="width:140px;"/></td>
                		<td width="40" ><input type="text" name="qtys[]" id="qtys<?php echo $j; ?>" value="1" class="rate" style="width:40px;" onchange="netamt3(<?php echo $j; ?>);"/></td>
                <td><input type="text" name="amts[]" id="amts<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
				<td><input type="text" name="amtsdt[]" id="amtsdt<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="amtads[]" id="amtads<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="rems[]" id="rems<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                </tr>

                <?php  } ?><input type="hidden" name="cnts" id="cnts" value="<?php echo $cnt; ?>" />
                </table>
           
                <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest2();">Add More </a>
                </td></tr>
		<tr>
                <td>Amount Claimed (III): </td>
                <td><input type="text" name="amtcIII" id="amtcIII" onfocus="getSum3()"> </td>
                <td>Amount Admitted (III): </td>
                <td><input type="text" name="amtadIII" id="amtadIII"> </td>
                </tr>
				
				<tr><td><b>IV. Medicine Bills</b></td></tr>
                <tr><td colspan="4">             
                <table width="882" border="1" id="detail3">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Store Name</th>
                <th width="205">Bill No.</th>                
                <th width="202">Amt. Claimed</th><th>Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
				
				 <?php 
		         $cnt=0;
			     for($j=0;$j<=4;$j++){
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><input type="hidden" value="<?php echo $cnt; ?>" name="sr1[]" id="sr1" class="sr" /><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="medst[]" id="medst<?php echo $j; ?>" class="proc" >
                <option value="0">Select</option>
                <?php 
				$sq=mysqli_query($con,"select * from medical_stores order by name");
				while($ro=mysqli_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[0]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="bills[]" id="bills<?php echo $j; ?>" class="code"></td>                				
                <td><input type="text" name="amtst[]" id="amtst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
				<td><input type="text" name="amtstdt[]" id="amtstdt<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="amtadst[]" id="amtadst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                <td><input type="text" name="remst[]" id="remst<?php echo $j; ?>" class="amt" style="width:140px;"/></td>
                </tr>

                <?php  } ?><input type="hidden" name="cntst" id="cntst" value="<?php echo $cnt; ?>" />
                </table>
           
                <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest3();">Add More </a>
                </td></tr>
		<tr>
                <td>Amount Claimed (IV): </td>
                <td><input type="text" name="amtcIV" id="amtcIV" onfocus="getSum4()"> </td>
                <td>Amount Admitted (IV): </td>
                <td><input type="text" name="amtadIV" id="amtadIV"> </td>
                </tr>
				
                <tr>
                <td>Total Amount Claimed(I+II+III+IV) Rs.</td>
                <td><input type="text" name="totalamt" id="totalamt" value=0 onfocus="getsum();"> </td>
                <td width="153"></td>
                <td width="224"></td>
                </tr>
             
                <tr>
                <td>Total Amount Admitted (X) (I+II+III+IV) Rs.</td>
                <td><input type="text" name="totalamtad" id="totalamtad" > </td>
                <td>Remarks : </td>
                <td><input type="text" name="totalrem" id="totalrem"> </td>
                </tr>

                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                 <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button>
                </td>
                </tr>
                </table>         
                
          </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}
?>