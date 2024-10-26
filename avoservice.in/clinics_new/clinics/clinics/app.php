<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');

$id=$_GET['id'];
$sql="select * from  patient where no='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
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

       
        
         <form method="post" class="signin" action="new_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Appointment</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
                
                <label class="cdate">
                <span> Today's Date: </span>
                <input id="cdate" name="cdate" type="text"  value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly>
                </label>
                
            	<label class="name">
                <span> Name: </span>
                <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;">
                </label>
                                            
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text" value="<?php echo $row[23]; ?>" readonly style="background-color:#DCDCDC;">
                </label>
                 
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text" value="<?php echo $row[26]; ?>" readonly style="background-color:#DCDCDC;">
                </label>
                
                
                <label class="appfor">
                <span>Appointment For:</span>
                <input type="text" name="appfor" id="appfor" />
                </label>
                
                <?php 
include('config.php');
$result = mysql_query("select doc_id,name from doctor ");
?>
            
                
                <label class="doc">
                <span>Doctor:</span>
                <select name="doc" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px;">
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </label>

                
                <label class="Date">
                <span>Date:</span>
                <input id="appdate" name="appdate" type="text">
                <input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate');"/>
                </label>
                
                <label class="time">
                <span><b> Time Given: </b></span><span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                
                <label class="type">
                <span>Type:</span>
                Consultation: <input type="radio"  name="type" style=" width:40px;" value="Consultation"/> 
                Follow Up: <input type="radio"  name="type" style=" width:40px;" value="Follow"/>
                </label>
                <br />
                
<?php 


$result = mysql_query("SELECT date,time FROM appoint WHERE date >= CURRENT_DATE order by date;");
//$row = mysql_fetch_row($result);
?>

<table style="border:2px #ac0404 solid;" border="1">
<th><b><font color="#FFFFFF"> Date </font></b></th>
<th><b><font color="#FFFFFF"> Booked Time </font></b></th>
<?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td width="120" style="color:#ac0404;font-weight:bold;"> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0]));?></td>
    <td width="120" style="color:#ac0404;font-weight:bold;"> <?php echo $row[1];?></td>
    </tr>
<?php } ?>
</table>
                
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
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