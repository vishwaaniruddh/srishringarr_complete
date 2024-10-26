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
	position:relative;
	top: 1%; left: 35%;
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

form.signin td{ font-size:12px;height:35px; }

form #fees input{ width:60px; height:20px;}

form #fees td{padding-left:3px; height:25px;}
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div id="" class="login-popup">

            <form method="post" class="signin" action="new_surgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Surgery</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $row[0]; ?>"  />
                <table width="456">
                
                <tr>
                <td width="127"><label class="cdate"> Date: </label></td>
                <td width="317"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td width="127"><label class="name">Name: </label></td>
                <td width="317"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
<?php 
include('config.php');
$result = mysql_query("select doc_id,name from doctor where special='Anaesthetist'");
?>                                          
               <tr>
               <td> <label class="an"> Anaesthetist :</label></td>
               <td> <select name="an" style="width:300px; height:25px;">
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
               </td>
               </tr>
               
               <tr>
               <td><label id="type">Type:</label></td>
               <td>
                 <select name="type" style="width:300px; height:25px;">
                 <option value="Local Anaesthetist (LA)">Local Anaesthetist (LA)</option>
                 <option value="General Anaesthetist (GA)">General Anaesthetist (GA)</option>
                 <option value="Spinal Anaesthetist (SA)">Spinal Anaesthetist (SA)</option>
                 </select> 
               </td>
               </tr>
               
               <tr>
               <td width="127"><label class="timein">Time In :</label> </td>
               <td width="317">
                Hour: 
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                </select>
   
                Mins:<select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td width="127"><label class="timeout">Time Out :</label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                </select>
   
                Mins:<select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="surgery">Surgery Head:</label></td>
                <td>
                <select name="surgery" style="width:300px; height:25px;">
                <option value="Bones, Joints & Tendons ">Bones, Joints & Tendons  </option>
                <option value="Cardiology">Cardiology  </option>
                <option value="Ear, Nose and Throat">Ear, Nose and Throat  </option>
                <option value="Eye Surgery ">Eye Surgery  </option>
                <option value="General Surgery ">General Surgery  </option>
                <option value="Kidney and Urinary System ">Kidney and Urinary System  </option>
                <option value="Stomach and Bowel">Stomach and Bowel</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="surgeon1"> Surgeon 1:</label></td>
                <td>
                <select name="surgeon1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
                <option value="Kevin Pieterson">Kevin Pieterson</option>
                <option value="Sachin Tendulkar">Sachin Tendulkar </option>
                <option value="Kumara Sangakara">Kumara Sangakara</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="surgeon2"> Surgeon 2:</label></td>
                <td>
                <select name="surgeon2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
                <option value="Kevin Pieterson">Kevin Pieterson</option>
                <option value="Sachin Tendulkar">Sachin Tendulkar </option>
                <option value="Kumara Sangakara">Kumara Sangakara</option>
                </select>
				</td>
                </tr>
                
                <tr>
                <td><label class="procedure"> Procedure :</label></td>
                <td><textarea name="pro" id="pro" cols="35" rows="3" style="resize:none;"></textarea></td>
                </tr>
                </table><br />
               
               
  <table width="489" border="1" cellspacing="0" cellpadding="0" id="fees">
  <tr>
    <td width="169">Admission Fees :</td>
    <td width="55"><input type="text" name="af1" id="af1" onChange="total();"/></td>
    <td width="202">ECG Charges :</td>
    <td width="53"><input type="text" name="af9" id="af9"  onChange="total();"/></td>
  </tr>
  <tr>
    <td>Pulse OX Charges :</td>
    <td><input type="text" name="af2" id="af2" onChange="total();"/></td>
    <td>Pathology Charges :</td>
    <td><input type="text" name="af10" id="af10" onChange="total();"/></td>
  </tr>
  <tr>
    <td>OT & Instrument :</td>
    <td><input type="text" name="af3" id="af3" onChange="total();"/></td>
    <td>Dressing Charges :</td>
    <td><input type="text" name="af11" id="af11" onChange="total();"/></td>
  </tr>
  <tr>
    <td>Material & Drugs :</td>
    <td><input type="text" name="af4" id="af4" onChange="total();"/></td>
    <td>Routine Nursing Charges :</td>
    <td><input type="text" name="af12" id="af12" onChange="total();"/></td>
  </tr>
  <tr>
    <td>Surgery Charges :</td>
    <td><input type="text" name="af5" id="af5" onChange="total();"/></td>
    <td>Spl. Nursing Charges :</td>
    <td><input type="text" name="af13" id="af13" onChange="total();"/></td>
  </tr>
  <tr>
    <td>Anaesthesis Charges :</td>
    <td><input type="text" name="af6" id="af6" onChange="total();"/></td>
    <td>Expert Visit Charges :</td>
    <td><input type="text" name="af14" id="af14" onChange="total();"/></td>
  </tr>
  <tr>
    <td>Lithotripsy Charges :</td>
    <td><input type="text" name="af7" id="af7" onChange="total();"/></td>
    <td>Physiotherapy Charges :</td>
    <td><input type="text" name="af15" id="af15"  onChange="total();"/></td>
  </tr>
  <tr>
    <td>X-Ray Charges :</td>
    <td><input type="text" name="af8" id="af8" onChange="total();"/></td>
    <td>Ambulance Charges :</td>
    <td><input type="text" name="af16" id="af16" onChange="total();"/></td>
  </tr>
  <tr>
    <td>Misc. Charges :</td>
    <td><input type="text" name="af17" id="af17" onChange="total();"/></td>
    <td colspan="2" align="right">Total :<input type="text" style="width:170px;background-color:#DCDCDC;"  name="af18" id="af18" readonly="readonly" onclick="total()"//></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Discount :<input type="text" name="af19" id="af19" onChange="gtotal();"/></td>
    <td colspan="2">&nbsp;Grand Total :<input type="text" style="width:170px; background-color:#DCDCDC;" name="af20" id="af20" onclick="gtotal()" readonly="readonly"/></td>
  </tr>
</table>

               
               
               
               
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>
<script type="text/javascript"> 
function total() { 
var a=Number(document.getElementById("af1").value); 
var b=Number(document.getElementById("af2").value); 
var c=Number(document.getElementById("af3").value);
var d=Number(document.getElementById("af4").value);
var e=Number(document.getElementById("af5").value);
var f=Number(document.getElementById("af6").value);
var g=Number(document.getElementById("af7").value);
var h=Number(document.getElementById("af8").value);
var i=Number(document.getElementById("af9").value);
var j=Number(document.getElementById("af10").value);
var k=Number(document.getElementById("af11").value);
var l=Number(document.getElementById("af12").value);
var m=Number(document.getElementById("af13").value);
var n=Number(document.getElementById("af14").value);
var o=Number(document.getElementById("af15").value);
var p=Number(document.getElementById("af16").value);
var q=Number(document.getElementById("af17").value); 

 if (isNaN(a) || isNaN(b) || isNaN(c) || isNaN(d) || isNaN(e) || isNaN(f) || isNaN(g) || isNaN(h)  || isNaN(i) || isNaN(j)|| isNaN(k) || isNaN(l) || isNaN(m) || isNaN(n) || isNaN(o) || isNaN(p) || isNaN(q) ) { alert("Please enter only numbers."); return false; } 
var grandtotal=a+b+c+d+e+f+g+h+i+j+k+l+m+n+o+p+q; 
document.getElementById("af18").value=grandtotal.toFixed(2); 
return false; 
} 


function gtotal() { 

var r=Number(document.getElementById("af18").value); 
var s=Number(document.getElementById("af19").value);

 if (isNaN(r) || isNaN(s)) { alert("Please enter only numbers."); return false; } 
var gtotal=r-s; 
document.getElementById("af20").value=gtotal.toFixed(2); 
return false; 
} 
</script> 