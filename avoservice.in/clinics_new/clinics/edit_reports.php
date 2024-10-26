<?php 
include 'config.php';
session_start();

$id=$_GET['id'];
$sql="select * from med_reports where reports_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

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


<!-- Medical Reports validation-->
<script type='text/javascript'>

function medvalidate(medform){
 with(medform)
 {
  

if(name.value=="")
{
	alert("Please Enter Name");
	name.focus();
	return false;
}
 
}
 return true;
 }
</script><!--end validation--> 


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

       
        
          <form method="post" class="signin" action="update_reports.php"  name="medform" onSubmit="return medvalidate(this)" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Medical Reports</p>
                
            	<label class="name">
                <span>Name:</span>
                <input id="name" name="name" type="text" value="<?php echo $row[1]; ?>">
                </label>
                
                <label class="Desc">
                <span>Description:</span>
                <textarea name="desc" cols="38" rows="3" style="resize:none;"><?php echo $row[2]; ?></textarea>
                </label>
                
                <label class="cost">
                <span>Cost:</span>
                <input id="cost" name="cost" type="text" value="<?php echo $row[3]; ?>">
                </label>
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
                       
                </fieldset>
          </form>
</div>