<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from new_app where treatment_id='$id'";
$result = mysqli_query($con,$sql);
if(isset($row)){
$row = mysqli_fetch_array($result);

$pid=$row[1];
$sql1="select * from new_patient where patient_id='$pid'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

$did=$row[3];
$sql2="select * from new_doc where doc_id='$did'";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_row($result2);

$time=$row[5];
list($hr, $min) = explode(":", $time);
}
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

form.signin td{ font-size:12px; }
</style>

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
<!-- validation-->
function appvalidate(appform){
 with(appform)
 {
  

if(appdate.value=="")
{
	alert("Please select Date");
	appdate.focus();
	return false;
}
 
}
 return true;
 }
</script><!--end validation-->

<div id="" class="login-popup">

       
          <form method="post" class="signin" action="update_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Appointment</p>
                
                <label class="cdate">
                <span> Today's Date: </span>
                <input id="cdate" name="cdate" type="text"  value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly>
                </label>
                
            	<label class="name">
                <span> Name: </span>
                <input id="name" name="name" type="text" value="<?php if(isset($row1[1])) {echo $row1[1];} ?>" style="background-color:#DCDCDC;" readonly>
                </label>
                                            
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text" value="<?php if(isset($row1[5])) {echo $row1[5];} ?>" style="background-color:#DCDCDC;" readonly="readonly">
                </label>
                 
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text" value="<?php if(isset($row1[3])) {echo $row1[3];} ?>" style="background-color:#DCDCDC;" readonly="readonly">
                </label>
                
                
                <label class="appfor">
                <span>Appointment For:</span>
                <input type="text" name="appfor" id="appfor" value="<?php if(isset($row[2])) {echo $row[2];} ?>"/>
                </label>
                
               <?php 
include 'config.php';
$result = mysqli_query($con,"select doc_id,name from doctor");              
?>
            
                
                <label class="doc">
                <span>Doctor:</span>
                <select name="doc" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px;">
               
                <option value="<?php if(isset($row2[0])) {echo $row2[0];} ?>"><?php if(isset($row2[1])) {echo $row2[1];} ?></option> 
			    <?php while($row=mysqli_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
               
                </select>
                </label>
                
                <label class="Date">
                <span>Date:</span>
                <input id="appdate" name="appdate" type="text" value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>">
                <input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate');"/>
                </label>
                
                <label class="time">
                <span><b> Time: </b></span><span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $hr; ?>" ><?php if(isset($hr)) {echo $hr; }?></option>
                <option value="00" >00</option>
                <option value="01" >01</option>
                <option value="02" >02</option>
                <option value="03" >03</option>
                <option value="04" >04</option>
                </select>
                
                
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $min; ?>" ><?php if(isset($min)) {echo $min;} ?></option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                
                <label class="type">
                <span>Type:</span>
                Consultation: <input type="radio"  name="type" id="type" style=" width:40px;" value="Consultation" <?php if(isset($row)) {if ($row[7]=="Consultation") { echo "checked='checked'";}} ?>/> 
                Follow Up: <input type="radio"  name="type" id="type" style=" width:40px;" value="Follow" <?php if(isset($row)) {if ($row[7]=="Follow") { echo "checked='checked'";}} ?>/>
                </label>
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
                       
                </fieldset>
          </form>
</div>