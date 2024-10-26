<?php 
include 'config.php';
session_start();
if(isset($id)){
$id=$_GET['id']; 

$sql="select * from staff where staff_id='$id'";		// changed staff_master to staff
$result = mysqli_query($con,$sql);		
$row = mysqli_fetch_row($result);
}

?>

<style type="text/javascript">
 <!-- Staff validation-->
<!--end validation-->

</style>

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
<script>
function seaffvalidate(){
  
var fname=document.getElementById('fname').value;
var dob=document.getElementById('dob4').value;
var age=document.getElementById('age').value;
	var cn=document.getElementById('cn').value;
	if(fname.trim()=="")
	{
		
		alert("Enter Name");
		document.getElementById('fname').focus();
		return false;
	}
	else if(dob.trim()=="")
	{
		
		alert("Enter Date of birth");
		document.getElementById('dob4').focus();
		return false;
		
	}
	else if(age.trim()=="")
	{
		
		alert("Enter Age");
		document.getElementById('age').focus();
		return false;
		
	}
	else if(cn.trim()=="")
	{
		
		alert("Enter Contact no");
		document.getElementById('cn').focus();
		return false;
		
	}
	else{
		
		
		return true;
	}
 }



</script>
<div id="" class="login-popup">

       
          <form method="post" class="signin" action="new_staffmaster.php" onSubmit="return seaffvalidate()" name="staffform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Staff</p>
                
            	<table>
                
                <tr> 
            	<td><label class="fname"> Full Name: </label></td>
                <td> <input id="fname" name="fname" type="text" value="<?php if(isset($row[1])){echo $row[1];} ?>"> </td>
                <td><label class="gender"> Gender: </label></td>
                <td><font color="#FFFFFF"> Male: </font><input name="gender" id="gender" type="radio" value="M" style="width:20px;" <?php if(isset($row[2])) { if($row[2]=="M") { echo "checked='checked'";} }?>/>
                    <font color="#FFFFFF"> Female: </font><input name="gender" id="gender" type="radio" value="F" style="width:20px;" <?php if(isset($row[2])) { if ($row[2]=="F") { echo "checked='checked'";} }?>/>
                </td>
                </tr>
                               
                <tr>
                <td><label class="dob"> Date of Birth: </label></td>
                <td><input id="dob4" name="dob4" type="text"  onclick="displayDatePicker('dob4');" value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>"></td>
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text" value="<?php if(isset($row[4])) {echo $row[4];} ?>"></td>
                </tr>
                                
                <tr>
                <td><label class="address">Address:</label></td>
                <td><textarea id="add" name="add" cols="26" rows="3" style="resize: none"><?php if(isset($row[5])){ echo $row[5];} ?></textarea></td>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text" value="<?php if(isset($row[6])) { echo $row[6];} ?>"></td>
                
                 
                </table>     
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
                       
                </fieldset>
          </form>
</div>