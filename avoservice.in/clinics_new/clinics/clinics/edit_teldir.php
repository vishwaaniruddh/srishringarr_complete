<?php 
include('config.php');


$id=$_GET['id'];
$sql="select * from tel_directory where tel_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
<script type="text/javascript">
function addThem1(){
var a = document.opd.rec;


var add = a.value+',';

document.opd.recm.value += add;
return true;
}
</script>
<!-- end multiple selection -->


<script type='text/javascript'>

function validate(form){
 with(form)
 {
  

if(fname.value=="")
{
	alert("Please Enter Name.");
	fname.focus();
	return false;
}
 if(lname.value== "")
{
alert("Please Enter Last Name");
lname.focus();
return false;
}

if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please enter Telephone No. to continue.");
cn.focus();
return false;
}

}
 return true;
 }


</script>
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

<div id="" class="login-popup">

       
        
          <form method="post" class="signin" action="update_teldir.php" onSubmit="return validate(this)" name="form">
               <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Telephone Directory</p>
                
            	<label class="name">
                <span> Name: </span>
                <input id="name" name="name" type="text" value="<?php echo $row[1]; ?>" >
                </label>
                
                <label class="address">
                <span> Address: </span>
                <textarea name="add" cols="35" rows="3" style="resize:none;"><?php echo $row[2]; ?></textarea>
                </label>
                                            
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text" value="<?php echo $row[3]; ?>">
                </label>
                 
                <label class="pin">
                <span>Pincode:</span>
                <input id="pin" name="pin" type="text" value="<?php echo $row[4]; ?>">
                </label>
                
                
                <label class="info">
                <span>Information For:</span>
                <select name="info" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:320px;">
                <option value="<?php echo $row[5]; ?>"><?php echo $row[5]; ?></option>
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
                </select>
                </label>
          
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
                                       
                </fieldset>
          </form>
</div>