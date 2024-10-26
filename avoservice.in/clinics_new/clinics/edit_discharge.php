<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from discharge_summary where dis_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

if(isset($sql1)){
$sql1="select * from admission where ad_id='$row[2]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);
}
if(isset($sql2)){
$sql2="select * from new_patient where patient_id='$row[1]'";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_row($result2);
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

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<div id="" class="login-popup">

       
          <form method="post" class="signin" action="update_disharge.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Discharge</p>
                
            	<input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                
                <table id="ds">
                
                <tr> 
            	<td ><label class="patientid"> Patient ID : </label></td>
                <td ><input id="pid" name="pid" type="text"  value="<?php if(isset($row1[1])) {echo $row1[1];} ?>"readonly>&nbsp;<input id="name" name="name" type="text" value="<?php if(isset($row2[1])) {echo $row2[1];} ?>" readonly></td>
                
                </tr>
                
                <tr>
                <td ><label class="datead">Date of Admission:</label></td>
                <td > <input id="datead" name="datead" type="text" readonly value="<?php if(isset($row1[3]) and $row1[3]!='0000-00-00') echo date('d/m/Y',strtotime($row1[3])); ?>"></td>
                </tr>  
                
                <tr>
                <td ><label class="datead">Date of Discharge:</label></td>
                <td > <input id="datead" name="datead" type="text" onClick="displayDatePicker('datead');" value="<?php if(isset($row1[4]) and $row1[4]!='0000-00-00') echo date('d/m/Y',strtotime($row1[4])); ?>"></td>
                </tr>               
                
                <tr>
                <td><label class="pro_diag">Provisional Diagnosis:</label></td>
                <td><input id="pd" name="pd" type="text" value="<?php if(isset($row[3])) {echo $row[3];} ?>"></td>
				</tr>
                
                <tr>
                <td><label class="inv">Investigations:</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;"><?php if(isset($row[4])) {echo $row[4];} ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Final Diagnosis:</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php if(isset($row[5])) {echo $row[5];} ?>"></td>
                </tr>
                
                <tr>
                <td>JJ stent:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="jj" name="jj" type="text"  style="width:50px;" value="<?php if(isset($row[8])) {echo $row[8];} ?>"></td>
                <td>Removal Date:&nbsp;<input id="jjdate" name="jjdate" type="text" onClick="displayDatePicker('jjdate');" value="<?php if(isset($row[10]) and $row[9]!='0000-00-00') echo date('d/m/Y',strtotime($row[9])); ?>"></td>
                </tr>
                
                <tr>
                <td>Uretric Cath:<input id="uc" name="uc" type="text"  style="width:50px;" value="<?php if(isset($row[9])) {echo $row[9];} ?>"></label></td>
                <td>Removal Date:&nbsp;<input id="ucdate" name="ucdate" type="text" onClick="displayDatePicker('ucdate');" value="<?php if(isset($row[11]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>"></td>
               
                </tr>
                
                <tr>
                <td><label class="oper">Operations:</label></td>
                <td><input id="op" name="op" type="text" value="<?php if(isset($row[6])) {echo $row[6];} ?>" ></td>
                </tr>
                
                <tr>
                <td><label class="proc">Procedure:</label></td>
                <td><textarea name="proc" rows="3" cols="22" style="resize:none;"><?php if(isset($row[7])) {echo $row[7];} ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="post">Post Operative T/t:</label></td>
                <td><input id="po" name="po" type="text" value="<?php if(isset($row[12])) {echo $row[12];} ?>"></td>
                </tr>
                
                <tr>
                <td><label class="add_proc">Additional Procedure:</label></td>
                <td><textarea name="add_proc" rows="3" cols="22" style="resize:none;"><?php if(isset($row[13])) {echo $row[13]; }?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="treatment">Treatment on Discharge:</label></td>
                <td><textarea name="treat" rows="3" cols="22" style="resize:none;"><?php if(isset($row[14])) {echo $row[14];} ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="advice">Advice:</label></td>
                <td><textarea name="advice" rows="2" cols="22" style="resize:none;"><?php if(isset($row[15])) {echo $row[15];} ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="visit">Visit at OPD On:</label></td>
                <td><input id="visit" name="visit" type="text" value="<?php if(isset($row[16])) {echo $row[16];} ?>"></td>
                </tr>
               
                                           
                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                </td>
                </tr>
                </table>         
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                
                       
                </fieldset>
                </form>
</div>