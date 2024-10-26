<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from delivery where delivery_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$adtime=$row[3];
list($hr1, $min1) = explode(":", $adtime);

$distime=$row[4];
list($hr2, $min2) = explode(":", $distime);

$btime=$row[6];
list($hr3, $min3) = explode(":", $btime);

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
	position: fixed;
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

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<div id="" class="login-popup">

       
          <form method="post" class="signin" action="update_delivery.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Delivery</p>
                
            	<table>
                <tr>
                <td>
            	<label class="datead">Date of Admission:</label></td>
                <td><input id="datead" name="datead" type="text" onClick="displayDatePicker('datead');" value="<?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?>"></td>
                
                <td>
                <label class="timead">Time of Admission:</label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $hr1; ?>"><?php echo $hr1; ?></option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                Mins:<select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $min1; ?>"><?php echo $min1; ?></option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                </td>
                </tr>
                
                <tr>
                <td><label class="disdate">Date of Discharge:</label></td>
                <td> <input id="disdate" name="disdate" type="text" onClick="displayDatePicker('disdate');" value="<?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?>"></td>
                
                <td><label class="timedis">Time of Discharge:</label></td>
                <td>
                Hour: 
                <select name="hour2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $hr2; ?>"><?php echo $hr2; ?></option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                Mins:<select name="min2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $min2; ?>"><?php echo $min2; ?></option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td>
                </tr>
                
                <tr><td colspan="6">  
                
                 <table width="700" border="0" cellspacing="0" cellpadding="0"  id="child" style="border:2px #ac0404 solid;">
                 <tr>
                 <td colspan="6"><font color="#ac0404" size="2"><b> Details of Child Birth : </b></font></td>
                 </tr>
  
                 <tr>
                 <td>Date:</td>
                 <td><input id="date1" name="date1" type="text" onClick="displayDatePicker('date1');" style="width:100px;" value="<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?>"></td>
                 <td>Time:</td>
                 <td colspan="3">
                 Hour:<select name="hour3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="<?php echo $hr3; ?>"><?php echo $hr3; ?></option>
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 </select>
   
                 Mins: <select name="min3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="<?php echo $min3; ?>"><?php echo $min3; ?></option>
                 <option value="00">00</option>
                 <option value="05">05</option>
                 <option value="10">10</option>
                 <option value="15">15</option>
                 <option value="20">20</option>
                 </select>
                 </td>
                 </tr>
    
                 <tr>
                 <td>Weight:</td>
                 <td><input id="weight" name="weight" type="text" style="width:100px;" value="<?php echo $row[7]; ?>"></td>
                 <td>Sex:</td>
                 <td><select name="gender">
                 <option value="<?php echo $row[8]; ?>"><?php echo $row[9]; ?></option>
                 <option value="male">Male</option>
                 <option value="female">Female</option>
                 </select></td>
       
                 <td>Blood Group:</td>
                 <td><select name="bg" style="background:#fff; width:100px;">
                 <option value="<?php echo $row[9]; ?>"><?php echo $row[9]; ?></option>
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Dont Know</option></select></td>
                 </tr>
    	         </table></td></tr>

                 <tr>
                 <td><label class="typedel">Type of Delivery:</label></td>
                 <td><input id="typedel" name="typedel" type="text" value="<?php echo $row[10]; ?>"></td>
                
                 <td><label class="apgar">Apgar Score:</label></td>
                 <td><input id="apgar" name="apgar" type="text" value="<?php echo $row[11]; ?>"></td>
                 </tr>
                
                 <tr>
                 <td><label class="indi"> Indication:</label></td>
                 <td><textarea name="indi" id="indication" cols="36" rows="2" style="resize:none"><?php echo $row[12]; ?></textarea></td>
                
                 <td> <label class="pmcreg">PMC Registration no. :</label></td>
                 <td><input id="pmc" name="pmc" type="text" value="<?php echo $row[13]; ?>"></td>
                 </tr>
                
                 <tr>
                 <td><label class="husband">Husband's Name:</label></td>
                 <td><input id="hname" name="hname" type="text" value="<?php echo $row[14]; ?>"></td>
                 <td><label class="education">Education:</label></td>
                 <td><input id="edu" name="edu" type="text" value="<?php echo $row[15]; ?>"></td>
                 </tr>
                
                 <tr>
                 <td colspan="4">Birth Notification sent to Municipal Authorities ? 
                 <select name="notification">
                 <option value="<?php echo $row[16]; ?>"><?php echo $row[16]; ?></option>
                 <option value="Y">Yes</option>
                 <option value="N">No</option>
                 </select></td>
                 </tr>
                
                 <tr>
                 <td><label class="Motherrel"> Mother's Religion:</label></td>
                 <td><input id="mrel" name="mrel" type="text" value="<?php echo $row[17]; ?>"></td>
                 <td><label class="education"> Education:</label></td>
                 <td><input id="medu" name="medu" type="text" value="<?php echo $row[18]; ?>"></td>
                 </tr>
                
                <tr>               
                <td>Blood Group:</td>
                <td><select name="bg2" style="background:#fff; width:100px;">
                 <option value="<?php echo $row[19]; ?>"><?php echo $row[19]; ?></option>
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Dont Know</option></select></td>
                </tr>
        
                
                
                </table>      
         
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
</div>