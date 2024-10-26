<?php 
include('config1.php');


$id=$_GET['id'];
$sql="select * from patient where no='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$fid=$row[9]; 
$sql3="select * from doctor where doc_id='$fid'";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_row($result3);

$sql4="select * from appoint where no='$id'";
$result4 = mysql_query($sql4);
$row4 = mysql_fetch_row($result4);
$time=$row4[5];
list($hr, $min) = explode(":", $time);

$did=$row4[14]; 
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2); 

?>

<!--date picker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<!-- Patient validation-->
<script type='text/javascript'>

function validate(form){
 with(form)
 {
  

if(fname.value=="")
{
	alert("Please Enter Firstname");
	fname.focus();
	return false;
}
 
if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please enter Telephone No. to continue.");
cn.focus();
return false;
}

if(city.value=="")
{
	alert("Please Enter City");
	city.focus();
	return false;
}

}
 return true;
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
	width:220px;
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

form.signin td{ font-size:12px; height:40px;}
td,th{padding-left:3px; padding-right:3px;}
</style>

<div id="" class="login-popup">

       
        
          <form method="post" class="signin" action="update_patient.php" onSubmit="return validate(this)" name="form">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Patient</p>
                <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date( "d/m/Y");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                <table>
                
                <tr> 
            	<td><label class="fname"> Full Name: </label></td>
                <td> <input id="fname" name="fname" type="text" value="<?php echo $row[6]; ?>" > </td>
                </tr>
                
                <tr>
                <td><label class="age"> Date of Birth: </label></td>
                <td><input id="dob" name="dob" type="text" onClick="displayDatePicker('dob');" value="<?php if(isset($row[25]) and $row[25]!='0000-00-00') echo date('d/m/Y',strtotime($row[25])); ?>"></td>
                </tr>
                               
                <tr>
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text" value="<?php echo $row[26]; ?>"></td>
                </tr>
                
                <tr>
                <td><label class="gender"> Gender: </label></td>
                <td> <font color="#FFFFFF"> Male: </font><input name="gen" id="gen" type="radio" value="Male" style="width:20px;" <?php if ($row[27]=="Male") { echo "checked='checked'";} ?>/>
                     <font color="#FFFFFF"> Female: </font><input name="gen" id="gen" type="radio" value="Female" style="width:20px;" <?php if ($row[27]=="Female") { echo "checked='checked'";} ?>/>
                </td>
                </tr>
                
                <tr>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text" value="<?php echo $row[23]; ?>">
                </td>
                </tr>
                
                <tr>
                <td><label class="city">City :</label></td>
                <td><input id="city" name="city" type="text" value="<?php echo $row[18]; ?>"></td>
                </tr>
                                
                <tr>
                <td><label class="add">Address:</label></td>
                <td><textarea name="add" rows="3" cols="25" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[20]; ?></textarea>
                </td>
                </tr>
                
                <tr>
                <td><label class="bg">Blood Group:</label></td>
                <td><select name="bg" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:220px;">
                <option value="<?php echo $row[37]; ?>"><?php echo $row[37]; ?></option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="Dont Know">Dont Know</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="ms"> Marital Status:</label></td>
                <td><select name="ms" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:220px;">
                <option value="<?php echo $row[38]; ?>"><?php echo $row[38]; ?></option>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="height"> Height:</label></td>
                <td><input id="height" name="height" type="text" value="<?php echo $row[36]; ?>"></td>
                </tr>
                
                <tr>
                <td>
                <label class="timegiven">Time Given:</label></td>
                <td>
                <span>Hour: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $hr; ?>" ><?php echo $hr; ?></option>
                <option value="00" >00</option>
                <option value="01" >01</option>
                <option value="02" >02</option>
                <option value="03" >03</option>
                <option value="04" >04</option>
                </select>
                
                
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="<?php echo $min; ?>" ><?php echo $min; ?></option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                </td>
                </tr>
               
<?php 
include('config1.php');
$result = mysql_query("select doc_id,name from doctor ");
$result1 = mysql_query("select doc_id,name from doctor ");
?>
            
                <tr>
                <td><label class="ref"> Doctor Reference:</label></td>
                <td><select name="ref" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:220px;">
                <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option> 
				<?php while($row11=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row11[0]; ?>"><?php echo $row11[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="doc"> Doctor :</label></td>
                <td><select name="doc" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:220px;">
                <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option> 
				<?php while($row1=mysql_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="type"> Type: </label></td> 
                <td> Consultation: <input type="radio"  name="follow" style=" width:20px;" value="Consultation" <?php if ($row[0]=="Consultation") { echo "checked='checked'";} ?>/> 
                     Follow Up: <input type="radio"  name="follow" style=" width:20px;" value="Follow" <?php if ($row[0]=="Follow") { echo "checked='checked'";} ?>/></td>
                </tr>
                
                <tr>
                <td>
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                </td>
                <td> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></td>
                </tr>
                
                </table>     
                </fieldset>
          </form>
</div>