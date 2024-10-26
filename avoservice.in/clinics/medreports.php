<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 
include('config.php');
include('template_clinic.html'); 
?>


<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

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

if(cost.value=="")
{
	alert("Please enter cost");
	cost.focus();
	return false;
}
 
}
 return true;
 }
</script><!--end validation-->


<div class="M_page">
        <form method="post" class="signin" action="new_med.php" name="medform" onSubmit="return medvalidate(this)">
                <fieldset class="textbox">
               
                <legend><h1><img src="ddmenu/Medical-Report.png" height="50" width="50">New Medical Reports</h1></legend>
                
            	<label class="name">
                <span>Name:</span>
                <input id="name" name="name" type="text" />
                </span></label>
                
                <label class="Desc">
                <span>Description:</span>
                <textarea name="desc" cols="40" rows="3"></textarea>
                </label>
                
                <label class="cost">
                <span>Cost:</span>
                <input id="cost" name="cost" type="text" >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
               
          </form>
</div>
