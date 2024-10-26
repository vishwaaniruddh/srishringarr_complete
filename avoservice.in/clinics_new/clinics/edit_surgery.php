<?php
 
include 'config.php';

$id=$_GET['id'];
$sql="select * from  surgery where s_id='$id'";   //surgery1 to surgery
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$pid=$row[0];
$sql2="select * from patient where no='$pid'";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_row($result2);

$aid=$row[7];

$sql3="select * from doctor where doc_id='$aid'";
$result3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_row($result3);

$time=$row[9];
list($hr, $min) = explode(":", $time);

$time1=$row[10];
list($hr1, $min1) = explode(":", $time1);
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

            <form method="post" class="signin" action="update_surgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Surgery</p>
                
                <input type="hidden" name="surgery_id" value="<?php echo $row[0]; ?>"  />
                <table width="456">
                
                <tr>
                <td width="127"><label class="cdate"> Date: </label></td>
                <td width="317"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td width="127"><label class="name">Name: </label></td>
                <td width="317"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row2[6]; ?>" readonly></td>
                </tr>
                
<?php 
include 'config.php';
$result1 = mysqli_query($con,"select doc_id,name from doctor where special='Anaesthetist'");

?>                                          
               <tr>
               <td> <label class="an"> Anaesthetist :</label></td>
               <td> <select name="an" style="width:300px; height:25px;">
			   <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
                <?php while($row1=mysqli_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>
               </td>
               </tr>
               
               <tr>
               <td><label id="type">Type:</label></td>
               <td>
                 <select name="type" style="width:300px; height:25px;">			 
                 <option value="LA" <?php if($row[8]=="LA"){ echo "selected"; } ?> >Local Anaesthetist (LA)</option>
                 <option value="GA" if($row[8]=="GA"){ echo "selected"; } ?> >General Anaesthetist (GA)</option>
                 <option value="SA" if($row[8]=="SA"){ echo "selected"; } ?> >Spinal Anaesthetist (SA)</option>
                 </select> 
               </td>
               </tr>
               
               <tr>
               <td width="127"><label class="timein">Time In :</label> </td>
               <td width="317">
                Hour: 
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				<option value="<?php echo $hr; ?>"><?php echo $hr; ?></option>	
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
				<option value="<?php echo $min; ?>"><?php echo $min; ?></option>	
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
				<option value="<?php echo $hr1; ?>"><?php echo $hr1; ?></option>	
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
				<option value="<?php echo $min1 ?>"><?php echo $min1 ?></option>	
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
                <td><label class="surgeon1"> Surgeon 1:</label></td>
                <td>
                <select name="surgeon1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
				<option value="<?php echo $row[3]; ?>"><?php echo $row[3]; ?></option>
                <option value="kp">Kevin Pieterson</option>
                <option value="st">Sachin Tendulkar </option>
                <option value="ks">Kumara Sangakara</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="surgeon2"> Surgeon 2:</label></td>
                <td>
                <select name="surgeon2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px; height:25px;">
				<option value="<?php echo $row[4]; ?>"><?php echo $row[4]; ?></option>
                <option value="kp">Kevin Pieterson</option>
                <option value="st">Sachin Tendulkar </option>
                <option value="ks">Kumara Sangakara</option>
                </select>
				</td>
                </tr>
                
                <tr>
                <td><label class="procedure"> Procedure :</label></td>
                <td><textarea name="pro" id="pro" cols="35" rows="3" style="resize:none;"><?php echo $row[6]; ?></textarea></td>
                </tr>
                </table><br />
               
               
  <table width="489" border="1" cellspacing="0" cellpadding="0" id="fees">
  <tr>
    <td width="169">Admission Fees :</td>
    <td width="55"><input type="text" name="af1" id="af1" value="<?php echo $row[11]; ?>"/></td>
    <td width="202">ECG Charges :</td>
    <td width="53"><input type="text" name="af9" id="af9" value="<?php echo $row[19]; ?>" /></td>
  </tr>
  <tr>
    <td>Pulse OX Charges :</td>
    <td><input type="text" name="af2" id="af2" value="<?php echo $row[12]; ?>"/></td>
    <td>Pathology Charges :</td>
    <td><input type="text" name="af10" id="af10" value="<?php echo $row[20]; ?>"/></td>
  </tr>
  <tr>
    <td>OT & Instrument :</td>
    <td><input type="text" name="af3" id="af3" value="<?php echo $row[13]; ?>"/></td>
    <td>Dressing Charges :</td>
    <td><input type="text" name="af11" id="af11" value="<?php echo $row[21]; ?>"/></td>
  </tr>
  <tr>
    <td>Material & Drugs :</td>
    <td><input type="text" name="af4" id="af4" value="<?php echo $row[14]; ?>"/></td>
    <td>Routine Nursing Charges :</td>
    <td><input type="text" name="af12" id="af12" value="<?php echo $row[22]; ?>"/></td>
  </tr>
  <tr>
    <td>Surgery Charges :</td>
    <td><input type="text" name="af5" id="af5" value="<?php echo $row[15]; ?>"/></td>
    <td>Spl. Nursing Charges :</td>
    <td><input type="text" name="af13" id="af13" value="<?php echo $row[23]; ?>"/></td>
  </tr>
  <tr>
    <td>Anaesthesis Charges :</td>
    <td><input type="text" name="af6" id="af6" value="<?php echo $row[16]; ?>"/></td>
    <td>Expert Visit Charges :</td>
    <td><input type="text" name="af14" id="af14" value="<?php echo $row[24]; ?>"/></td>
  </tr>
  <tr>
    <td>Lithotripsy Charges :</td>
    <td><input type="text" name="af7" id="af7" value="<?php echo $row[17]; ?>"/></td>
    <td>Physiotherapy Charges :</td>
    <td><input type="text" name="af15" id="af15"  value="<?php echo $row[25]; ?>"/></td>
  </tr>
  <tr>
    <td>X-Ray Charges :</td>
    <td><input type="text" name="af8" id="af8" value="<?php echo $row[18]; ?>" /></td>
    <td>Ambulance Charges :</td>
    <td><input type="text" name="af16" id="af16" value="<?php echo $row[26]; ?>"/></td>
  </tr>
  <tr>
    <td>Misc. Charges :</td>
    <td><input type="text" name="af17" id="af17" value="<?php echo $row[27]; ?>"/></td>
    <td colspan="2" align="right">Total :<input type="text" style="width:170px;background-color:#DCDCDC;"  name="af18" id="af18" value="<?php echo $row[28]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Discount :<input type="text" name="af19" id="af19" value="<?php echo $row[29]; ?>" /></td>
    <td colspan="2">&nbsp;Grand Total :<input type="text" style="width:170px; background-color:#DCDCDC;" name="af20" id="af20" value="<?php echo $row[30]; ?>"/></td>
  </tr>
</table>

               
               
               
               
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
</div>
