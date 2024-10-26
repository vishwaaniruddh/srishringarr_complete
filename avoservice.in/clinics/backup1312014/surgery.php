<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include('template.html');
include('config.php');

$id=$_GET['id'];
$sql="select * from  patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
<style>
td{border:none;}
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<body onload="createList();">

         <form method="post" class="signin" action="new_surgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Surgery</p><br />
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
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
$result = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC");
?>                                          
               <tr>
               <td> <label class="an"> Anaesthetist :</label></td>
               <td> <select name="an" style="width:300px; height:25px;border:1px #ac0404 solid;">
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
                 <select name="type" style="width:300px; height:25px;border:1px #ac0404 solid;">
                 <option value="LA">Local Anaesthetist (LA)</option>
                 <option value="GA">General Anaesthetist (GA)</option>
                 <option value="SA">Spinal Anaesthetist (SA)</option>
                 </select> 
               </td>
               </tr>
               
               <tr>
               <td width="127"><label class="timein">Time In :</label> </td>
               <td width="317">
                Hour: 
                <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;">
                <option value="00" >00</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09" >09</option>
                      <option value="10">10</option>
                      <option value="11" >11</option>
                      <option value="12" >12</option>
                      <option value="13">13</option>
                      <option value="14" >14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17" >17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20" >20</option>
                      <option value="21" >21</option>
                      <option value="22" >22</option>
                      <option value="23">23</option>
                </select>
   
                Mins:<select name="min" style="background:#fff;border:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                <option value="05" >05</option>
                <option value="10" >10</option>
                <option value="15" >15</option>
                <option value="20" >20</option>
                <option value="25">25</option>
                <option value="30" >30</option>
                <option value="35">35</option>
                <option value="40" >40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td width="127"><label class="timeout">Time Out :</label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border:1px solid #ac0404;width:60px;">
                <option value="00" >00</option>
                      <option value="01">01</option>
                      <option value="02" >02</option>
                      <option value="03">03</option>
                      <option value="04" >04</option>
                      <option value="05">05</option>
                      <option value="06" >06</option>
                      <option value="07" >07</option>
                      <option value="08">08</option>
                      <option value="09"  >09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12" >12</option>
                      <option value="13">13</option>
                      <option value="14" >14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19" >19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                </select>
   
                Mins:<select name="min1" style="background:#fff;border:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                <option value="05" >05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20" >20</option>
                <option value="25" >25</option>
                <option value="30" >30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45" >45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                </select>
                </td>
                </tr>
                
<!--                <tr>
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
    -->            
                <tr>
                <td><label class="surgeon1"> Surgeon 1:</label></td>
                <td>
<?php 
include('config.php');
$result6 = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC");
?>   
                <select name="surgeon1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
                <?php while($row6=mysql_fetch_row($result6))
                {  ?>
                <option value="<?php echo $row6[0]; ?>"><?php echo $row6[1]; ?></option>
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
                <select name="surgeon2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
                 <?php while($row7=mysql_fetch_row($result7))
                {  ?>
                <option value="<?php echo $row7[0]; ?>"><?php echo $row7[1]; ?></option>
				<?php } ?>
                </select>
				</td>
                </tr>
                
                <tr>
                <td><label class="procedure"> Procedure :</label></td>
                <td><textarea name="pro" id="pro" cols="35" rows="3" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                </tr>
                </table><br />

               
               
  <table width="670" border="1" cellspacing="0" cellpadding="0" id="fees">
  <tr>
    <td width="171">Admission Fees :</td>
    <td width="120"><input type="text" name="af1" id="af1" onChange="total();" style="width:100px;"/></td>
    <td width="206">ECG Charges :</td>
    <td width="163"><input type="text" name="af9" id="af9"  onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>Pulse OX Charges :</td>
    <td><input type="text" name="af2" id="af2" onChange="total();" style="width:100px;"/></td>
    <td>Pathology Charges :</td>
    <td><input type="text" name="af10" id="af10" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>OT & Instrument :</td>
    <td><input type="text" name="af3" id="af3" onChange="total();" style="width:100px;"/></td>
    <td>Dressing Charges :</td>
    <td><input type="text" name="af11" id="af11" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>Material & Drugs :</td>
    <td><input type="text" name="af4" id="af4" onChange="total();" style="width:100px;"/></td>
    <td>Routine Nursing Charges :</td>
    <td><input type="text" name="af12" id="af12" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td height="46">Surgery Charges :</td>
    <td><input type="text" name="af5" id="af5" onChange="total();" style="width:100px;"/></td>
    <td>Spl. Nursing Charges :</td>
    <td><input type="text" name="af13" id="af13" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>Anaesthesis Charges :</td>
    <td><input type="text" name="af6" id="af6" onChange="total();" style="width:100px;"/></td>
    <td>Expert Visit Charges :</td>
    <td><input type="text" name="af14" id="af14" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>Lithotripsy Charges :</td>
    <td><input type="text" name="af7" id="af7" onChange="total();" style="width:100px;"/></td>
    <td>Physiotherapy Charges :</td>
    <td><input type="text" name="af15" id="af15"  onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>X-Ray Charges :</td>
    <td><input type="text" name="af8" id="af8" onChange="total();" style="width:100px;"/></td>
    <td>Ambulance Charges :</td>
    <td><input type="text" name="af16" id="af16" onChange="total();" style="width:100px;"/></td>
  </tr>
  <tr>
    <td>Misc. Charges :</td>
    <td><input type="text" name="af17" id="af17" onChange="total();" style="width:100px;"/></td>
    <td colspan="2" align="right">Total :<input type="text" style="width:170px;background-color:#DCDCDC;"  name="af18" id="af18" readonly="readonly" onclick="total()"//></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Discount :<input type="text" name="af19" id="af19" onChange="gtotal();" style="width:100px;"/></td>
    <td colspan="2">&nbsp;Grand Total :<input type="text" style="width:170px; background-color:#DCDCDC;" name="af20" id="af20" onclick="gtotal()" readonly="readonly"/></td>
  </tr>
</table>

               
               
               
               
                <button class="submit formbutton" type="submit">Submit</button> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="viewipd.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'viewipd.php';">Cancel</button></a>
                       
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

<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>