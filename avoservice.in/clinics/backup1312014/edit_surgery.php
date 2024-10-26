<?php
include('template.html'); 
include('config.php');

$id=$_GET['id'];
$sql="select * from  surgery1 where s_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[0];
$sql2="select * from patient where srno='$pid'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);

$aid=$row[7];

$sql3="select * from doctor where doc_id='$aid'";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_row($result3);

$time=$row[9];
list($hr, $min) = explode(":", $time);

$time1=$row[10];
list($hr1, $min1) = explode(":", $time1);
?>

<style>
#se td{border:none;}
</style>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script language="javascript" type="text/javascript">

///dob
window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		no();
	};
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>


        
            <form method="post" class="signin" action="update_surgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Surgery</p><br />
                
                <input type="hidden" name="surgery_id" value="<?php echo $id; ?>"  />
                <table width="456" id="se">
                
                <tr>
                <td width="127"><label class="cdate"> Date: </label></td>
                <td width="317"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" readonly></td>
                </tr>
                
                <tr>
                <td width="127"><label class="name">Name: </label></td>
                <td width="317"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row2[6]; ?>"  readonly></td>
                </tr>
                
<?php 
include('config.php');
$result1 = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC");

?>                                          
               <tr>
               <td height="37"> <label class="an"> Anaesthetist :</label></td>
               <td> <select name="an" style="width:235px; height:25px;border:1px #ac0404 solid;">
			 
                <?php while($row1=mysql_fetch_row($result1))
                {  ?>
                 <option value="<?php echo $row1[0]; ?>" <?php if($row[7]==$row1[0]) { echo "selected"; }?>><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>
               </td>
               </tr>
               
               <tr>
               <td><label id="type">Type:</label></td>
               <td>
                 <select name="type" style="width:235px; height:25px;border:1px #ac0404 solid;">			 
                 <option value="LA" <?php if($row[8]=="LA"){ echo "selected"; } ?> >Local Anaesthetist (LA)</option>
                 <option value="GA" <?php if($row[8]=="GA"){ echo "selected"; } ?> >General Anaesthetist (GA)</option>
                 <option value="SA" <?php if($row[8]=="SA"){ echo "selected"; } ?> >Spinal Anaesthetist (SA)</option>
                 </select> 
               </td>
               </tr>
               
               <tr>
               <td width="127"><label class="timein">Time In :</label> </td>
               <td width="317">
                Hour: 
                <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;">
				<option value="00" <?php if($hr==00){ echo "selected";} ?>>00</option>
                      <option value="01" <?php if($hr==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr==09){ echo "selected";} ?> >09</option>
                      <option value="10" <?php if($hr==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr==12){ echo "selected";} ?>>12</option>
                      <option value="13" <?php if($hr==13){ echo "selected";} ?>>13</option>
                      <option value="14" <?php if($hr==14){ echo "selected";} ?>>14</option>
                      <option value="15" <?php if($hr==15){ echo "selected";} ?>>15</option>
                      <option value="16" <?php if($hr==16){ echo "selected";} ?>>16</option>
                      <option value="17" <?php if($hr==17){ echo "selected";} ?>>17</option>
                      <option value="18" <?php if($hr==18){ echo "selected";} ?>>18</option>
                      <option value="19" <?php if($hr==19){ echo "selected";} ?>>19</option>
                      <option value="20" <?php if($hr==20){ echo "selected";} ?>>20</option>
                      <option value="21" <?php if($hr==21){ echo "selected";} ?>>21</option>
                      <option value="22" <?php if($hr==22){ echo "selected";} ?>>22</option>
                      <option value="23" <?php if($hr==23){ echo "selected";} ?>>23</option>
                </select>
   
                Mins:<select name="min" style="background:#fff;border:1px solid #ac0404;width:60px;">
				 <option value="00" <?php if($min==00){ echo "selected";} ?>>00</option>
                <option value="05" <?php if($min==05){ echo "selected";} ?>>05</option>
                <option value="10" <?php if($min==10){ echo "selected";} ?>>10</option>
                <option value="15" <?php if($min==15){ echo "selected";} ?>>15</option>
                <option value="20" <?php if($min==20){ echo "selected";} ?>>20</option>
                <option value="25" <?php if($min==25){ echo "selected";} ?>>25</option>
                <option value="30" <?php if($min==30){ echo "selected";} ?>>30</option>
                <option value="35" <?php if($min==35){ echo "selected";} ?>>35</option>
                <option value="40" <?php if($min==40){ echo "selected";} ?>>40</option>
                <option value="45" <?php if($min==45){ echo "selected";} ?>>45</option>
                <option value="50" <?php if($min==50){ echo "selected";} ?>>50</option>
                <option value="55" <?php if($min==55){ echo "selected";} ?>>55</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td width="127"><label class="timeout">Time Out :</label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border:1px solid #ac0404;width:60px;">
				 <option value="00" <?php if($hr1==00){ echo "selected";} ?>>00</option>
                      <option value="01" <?php if($hr1==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr1==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr1==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr1==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr1==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr1==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr1==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr1==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr1==09){ echo "selected";} ?> >09</option>
                      <option value="10" <?php if($hr1==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr1==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr1==12){ echo "selected";} ?>>12</option>
                      <option value="13" <?php if($hr1==13){ echo "selected";} ?>>13</option>
                      <option value="14" <?php if($hr1==14){ echo "selected";} ?>>14</option>
                      <option value="15" <?php if($hr1==15){ echo "selected";} ?>>15</option>
                      <option value="16" <?php if($hr1==16){ echo "selected";} ?>>16</option>
                      <option value="17" <?php if($hr1==17){ echo "selected";} ?>>17</option>
                      <option value="18" <?php if($hr1==18){ echo "selected";} ?>>18</option>
                      <option value="19" <?php if($hr1==19){ echo "selected";} ?>>19</option>
                      <option value="20" <?php if($hr1==20){ echo "selected";} ?>>20</option>
                      <option value="21" <?php if($hr1==21){ echo "selected";} ?>>21</option>
                      <option value="22" <?php if($hr1==22){ echo "selected";} ?>>22</option>
                      <option value="23" <?php if($hr1==23){ echo "selected";} ?>>23</option>
                </select>
   
                Mins:<select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				 <option value="00" <?php if($min1==00){ echo "selected";} ?>>00</option>
                <option value="05" <?php if($min1==05){ echo "selected";} ?>>05</option>
                <option value="10" <?php if($min1==10){ echo "selected";} ?>>10</option>
                <option value="15" <?php if($min1==15){ echo "selected";} ?>>15</option>
                <option value="20" <?php if($min1==20){ echo "selected";} ?>>20</option>
                <option value="25" <?php if($min1==25){ echo "selected";} ?>>25</option>
                <option value="30" <?php if($min1==30){ echo "selected";} ?>>30</option>
                <option value="35" <?php if($min1==35){ echo "selected";} ?>>35</option>
                <option value="40" <?php if($min1==40){ echo "selected";} ?>>40</option>
                <option value="45" <?php if($min1==45){ echo "selected";} ?>>45</option>
                <option value="50" <?php if($min1==50){ echo "selected";} ?>>50</option>
                <option value="55" <?php if($min1==55){ echo "selected";} ?>>55</option>
                </select>
                </td>
                </tr>
                              
                <tr>
                <td><label class="surgeon1"> Surgeon 1:</label></td>
<?php 
include('config.php');
$result6 = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC");
$result12=mysql_query("select * from doctor where doc_id='$row[3]'");
$result13=mysql_query("select * from doctor where doc_id='$row[4]'");

?> 
                <td>
                <select name="surgeon1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:235px; height:25px;">
				<?php $row12=mysql_fetch_row($result12); ?>
				
                 <?php while($row6=mysql_fetch_row($result6))
                {  ?>
                 <option value="<?php echo $row6[0]; ?>" <?php if($row[3]==$row6[0]) { echo "selected"; }?>><?php echo $row6[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="surgeon2"> Surgeon 2:</label></td>
<?php 
include('config.php');
$result7 = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC");

?> 
                <td>
                <select name="surgeon2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:235px; height:25px;">
				
				
                <?php while($row7=mysql_fetch_row($result7))
                {  ?>
                 <option value="<?php echo $row7[0]; ?>" <?php if($row[4]==$row7[0]) { echo "selected"; }?>><?php echo $row7[1]; ?></option>
				<?php } ?>
                </select>
				</td>
                </tr>
                
                <tr>
                <td><label class="procedure"> Procedure :</label></td>
                <td><textarea name="pro" id="pro" cols="35" rows="3" style="resize:none;"><?php echo $row[6]; ?></textarea></td>
                </tr>
                </table><br />
               
               
  <table width="888" border="1" cellspacing="0" cellpadding="0" id="fees">
  <tr>
    <td width="183">Admission Fees :</td>
    <td width="262"><input type="text" name="af1" id="af1" value="<?php echo $row[30]; ?>" onKeyUp="total();"/></td>
    <td width="188">ECG Charges :</td>
    <td width="245"><input type="text" name="af9" id="af9" value="<?php echo $row[20]; ?>" onKeyUp="total();" /></td>
  </tr>
  <tr>
    <td>Pulse OX Charges :</td>
    <td><input type="text" name="af2" id="af2" value="<?php echo $row[13]; ?>" onKeyUp="total();"/></td>
    <td>Pathology Charges :</td>
    <td><input type="text" name="af10" id="af10" value="<?php echo $row[21]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>OT & Instrument :</td>
    <td><input type="text" name="af3" id="af3" value="<?php echo $row[12]; ?>" onKeyUp="total();"/></td>
    <td>Dressing Charges :</td>
    <td><input type="text" name="af11" id="af11" value="<?php echo $row[22]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>Material & Drugs :</td>
    <td><input type="text" name="af4" id="af4" value="<?php echo $row[15]; ?>" onKeyUp="total();"/></td>
    <td>Routine Nursing Charges :</td>
    <td><input type="text" name="af12" id="af12" value="<?php echo $row[23]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>Surgery Charges :</td>
    <td><input type="text" name="af5" id="af5" value="<?php echo $row[14]; ?>" onKeyUp="total();"/></td>
    <td>Spl. Nursing Charges :</td>
    <td><input type="text" name="af13" id="af13" value="<?php echo $row[18]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>Anaesthesis Charges :</td>
    <td><input type="text" name="af6" id="af6" value="<?php echo $row[17]; ?>" onKeyUp="total();"/></td>
    <td>Expert Visit Charges :</td>
    <td><input type="text" name="af14" id="af14" value="<?php echo $row[24]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>Lithotripsy Charges :</td>
    <td><input type="text" name="af7" id="af7" value="<?php echo $row[16]; ?>" onKeyUp="total();"/></td>
    <td>Physiotherapy Charges :</td>
    <td><input type="text" name="af15" id="af15"  value="<?php echo $row[25]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>X-Ray Charges :</td>
    <td><input type="text" name="af8" id="af8" value="<?php echo $row[19]; ?>" onKeyUp="total();"/></td>
    <td>Ambulance Charges :</td>
    <td><input type="text" name="af16" id="af16" value="<?php echo $row[27]; ?>" onKeyUp="total();"/></td>
  </tr>
  <tr>
    <td>Misc. Charges :</td>
    <td><input type="text" name="af17" id="af17" value="<?php echo $row[28]; ?>" onKeyUp="total();"/></td>
    <td colspan="2" align="right">Total :<input type="text" style="width:170px;"  name="af18" id="af18" value="<?php echo $row[29]; ?>" readonly/></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Discount :<input type="text" name="af19" id="af19" value="<?php echo $row[31]; ?>" onKeyUp="gtotal();"/></td>
    <td colspan="2">&nbsp;Grand Total :<input type="text" style="width:170px;" name="af20" id="af20" value="<?php echo $row[32]; ?>" readonly/></td>
  </tr>
</table>

               
               
               
               
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="view_surgry.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_surgry.php';">Cancel</button></a>
                       
                </fieldset>
                </form>

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
<?php include('footer.html'); ?>