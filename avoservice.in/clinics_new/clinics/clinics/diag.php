<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');

$sql="select * from category";
$result=mysql_query($sql);

?>
<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript">
$(function()
{

$("#click_here").click(function(event) {
event.preventDefault();
$("#div1").slideToggle();
});

$("#div1 a").click(function(event) {
event.preventDefault();
$("#div1").slideUp();
});
});
</script>

<script type='text/javascript'>

function diagvalidate(diagform){
 with(diagform)
 {
  

if(name.value=="")
{
	alert("Please Enter Diagnosis Name");
	name.focus();
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
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<div id="" class="login-popup">

               <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Diagnosis</p>
                
               <p style="color:#ac0404; font-weight:bold; font-size:16px;">&nbsp;</p>
               
<div id="div1" style="background-color:#666;padding-left:5px;color:#FFF; display:none;">
<form method="post" action="new_cat.php" >

<label class="cat"><span>Category: </span>
<input id="cat" name="cat" type="text" style="width:180px; height:27px;"/>
</label>
                
<button class="submit formbutton" type="submit">Submit</button>
 </form>              
</div>
                <form method="post" class="signin" action="new_diag.php" name="diag" onSubmit="return diagvalidate(this)">
                <fieldset class="textbox">
                  <label class="name">
                <span>Name Diagnosis:</span>
                <input id="name" name="name" type="text" style="width:350px;">
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
          </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>