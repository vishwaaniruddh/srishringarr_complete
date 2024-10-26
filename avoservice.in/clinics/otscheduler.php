<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 include('config.php');
 
$id=$_GET['id'];
?>
<script>
function validate(form){
 with(form)
 {
  

if(fname.value=="")
{
	alert("Please Enter Firstname");
	fname.focus();
	return false;
}


if(bg.value=="0")
{
	alert("Please Select Blood Group.");
	bg.focus();
	return false;
}
if(city.value=="0")
{
	alert("Please Select City.");
	city.focus();
	return false;
}
if(mob.value=="")
{
	alert("Please enter Mobile No.");
	mob.focus();
	return false;
}

}
 return true;
 }

function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
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
	
	border: 2px solid #ac0404;
	
	font-size: 1.2em;
	position: relative;
	margin:auto; width:1250px;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
        padding:0 7px;
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

form.signin  input{ 
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
	width:220px; text-transform:uppercase;
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
#banner_box .button a {
	margin: 0 auto;
	background: url(images/button_02.png) no-repeat;
}
#banner_box .button a:hover {
	color: #f8e836;
}
#site_title_bar_wrapper_outter {
	width: 100%;
	height: 50px;
	margin: 0 auto;
	background: url(images/header_bg_wrapper_outter.gif) top repeat-x;
}
#sub input{
width:222px;
}
</style>

<script type="text/javascript">
function confirm_deleteot(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_ot.php?id="+id;
  }
}
</script>

<!--patient name -->
<script type="text/javascript">
var $ = function(e){ return document.getElementById(e); }
var swap = function(val, el){
  $(el).value = val;
}
</script>

<!--surgery-->
<script type="text/javascript">
var $ = function(e){ return document.getElementById(e); }
var swap = function(val, el){
  $(el).value = val;
}




function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

<!--add new hospital-->
function hoswindow()
{

  mywindow = window.open("new_hosp.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
</script>


<link href="style1.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
</head>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<body >
<div id="view_patient" class="login-popup">
<div id="view_patient1">
     
     <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->      
 
  <form method="post" class="signin" action="processot.php" >
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Appointment</p>
                
                <p align="right"><input id="cdate1" name="cdate1" type="text" value="<?php echo date( "d/m/Y");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                
                <table><tr>
                  <td><table width="1200" id="sub">
                  <tr>
                    <td width="120" height="33"><label class="fname"> Full Name: </label></td>
                    <td width="319">
                    <input id="fname" name="fname" type="text" />
                    <?php $result6 = mysql_query("select * from patient where name<>'' order by name ASC");?>
                    <select name="pname" id="pname" style="background:#fff;border:1px #ac0404 solid;width:120px;height:26px;" onChange="swap(this.value, 'fname')">
                     <option value="0">Select</option>
				     <?php while($row6=mysql_fetch_row($result6))
                      {  ?>
                      <option value="<?php echo $row6[2]; ?>"><?php echo $row6[6]; ?></option>
				     <?php } ?>
			        </select>                    </td></tr>
                    <tr>
                    <td width="120"><label class="age"> Date : </label></td>
                    <td width="319"><input id="apdate" name="apdate" type="text" onClick="displayDatePicker('apdate');" /></td>
                  <td width="90"> Time In:</td>
				  <td width="239"> Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:<br />
                    <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;">
                      <option value="00">00</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                    </select>
                    <select name="min" style="background:#fff;height:20px;border:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                </select></td>
				
				<td width="142">Time Out: </td>
				<td width="262">
				Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:<br />
                    <select name="hour1" style="background:#fff;border:1px solid #ac0404;width:60px;">
                      <option value="00">00</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                    </select>
                    <select name="min1" style="background:#fff;height:20px;border:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                </select>
                  </td>
                  </tr>
                  <!--<script type="text/javascript">
    function ageCount() {
        var date3 = new Date();
		var date1=date3.format("dd/mm/yy");
		alert(date1);
        var  dob= document.getElementById("dob").value;
        var date2=new Date(dob);
        var pattern = /^\d{1,2}\/\d{1,2}\/\d{4}$/; //Regex to validate date format (dd/mm/yyyy)
        if (pattern.test(dob)) {
			alert(dob);
            var y1 = date1.getFullYear(); //getting current year
			
            var y2 = date2.getFullYear(); //getting dob year
			
            var age = y1 - y2;           //calculating age 
           document.getElementById("age").value= age;
            return true;
        } else {
            alert("Invalid date format. Please Input in (dd/mm/yyyy) format!");
            return false;
        }

    }
</script>-->
                  
                  <tr>
                    <td height="33"><label class="cn">Telephone No.:</label></td>
                    <td><input id="tel" name="tel" type="text" /></td>
                    <td height="33"><label class="mob">Mobile:</label></td>
                    <td><input id="mob" name="mob" type="text" /></td>
                  </tr>
                 
                  <?php 

$result = mysql_query("select doc_id,name from doctor where name<>'' order by ASC");

?>
                
				
              
				<tr>
				<td width="120"><label class="doc">Doctor Reference:</label></td>
                <td width="319">
                <?php $result1 = mysql_query("select ref_id,name from doctor_ref"); ?>
                <select name="doc" id="doc" style="background:#fff;border:1px solid #ac0404;width:222px;height:26px;">
                <option value="0">Select</option>
                <?php while($row1=mysql_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>				</td>
                
                <td>Hospital:</td><td>
				<?php $result5 = mysql_query("select * from hospital where name<>'' order by name ASC");?>
                <select name="hos" id="hos" style="background:#fff;height:26px;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:222px;"><option value="0">Select</option>
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"><?php echo $row5[0]; ?></option>
				<?php } ?>
				</select></td>
				
				<td><button name="cityadd" id="cityadd" style="width:100px;" onClick="hoswindow();" class="submit formbutton"/>Add New </button></td>
				</tr>
                
				
				<tr>
				
				<td>Remarks :</td>
				<td ><input type="text" name="rem" id="rem" /></td>
                
                <td>Anaesthetist :</td>
				<td ><input type="text" name="ane" id="ane" /></td>
				</tr>
                
                <tr>
                <td>Surgery :</td>
				<td ><textarea name="surtxt" id="surtxt" cols="26" rows="3" style="border:1px #ac0404 solid;"></textarea>
                <?php $result5 = mysql_query("select * from surmast where name<>'' order by name ASC");?>
                <select name="sur" id="sur" style="background:#fff;border:1px #ac0404 solid;width:120px;height:26px;" onChange="swap(this.value, 'surtxt')">
                <option value="0">Select</option>
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"><?php echo $row5[0]; ?></option>
				<?php } ?>
				</select>                </td>
				</tr>
                
                <tr>
                <td colspan="4"><button class="submit formbutton" type="submit" name="Submit"> Save</button>   
				<!--<button class="submit formbutton" type="button" onClick="javascript:popcontact('opt_surgery.php?id=<?php echo $id; ?>');" style="width:150px;">Add to Waiting List</button>-->&nbsp;&nbsp;
				<a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';" style="width:100px;">Cancel</button></a>
				 <button class="submit formbutton" type="button" onClick="var s=document.getElementById('fname').value; javascript:popcontact('opt_surgery.php?id='+s);" style="width:150px;">Add to Waiting List</button>
				
				<a href="newpatient.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'newpatient.php';" style="width:150px;">Register Patient</button></a>
				</td>
                </tr>   
                </table>
                </tr>
                <table width="1200" border="1">
                <tr> 
                <th width="54" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="name">Date</label></th>
                <th width="184" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="prs">Name of the Patient</label></th>
				 <th width="66" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="basic">Time1</label></th>
				 <th width="66" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="basic">Time2</label></th>
                <th width="75" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="all">Tel.No. </label></th>
                <th width="98" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ot">Mobile No. </label></th>
                <th width="182" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ded">Operation</label></th>
                <th width="112" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Anaesthetist</label></th>
                <th width="106" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Remarks</label></th>
				<th width="94" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Edit</label></th>
				<th width="93" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Delete</label></th>
                </tr>
               <?php  
$result1 = mysql_query("select * from operate");
while($row5=mysql_fetch_row($result1)){

$result21 = mysql_query("SELECT * FROM  `patient` where no='$row5[2]'");
$row21=mysql_fetch_row($result21);
//echo $row5[11]."<br/>";
?> 
                
                <tr>
                <td><?php if(isset($row5[0]) and $row5[0]!='0000-00-00') echo date('d/m/Y',strtotime($row5[0])); ?></td>
                <td><?php if ($row21[2]==$row5[2]) {echo $row21[6];} else {echo $row5[2];} ?></td>
                <td><?php echo $row5[5]; ?></td>
                <td><?php echo $row5[6]; ?></td>
                <td><?php echo $row5[3]; ?></td>
                <td><?php echo $row5[4]; ?></td>
                <td><?php echo $row5[13]; ?></td>
                <td><?php echo $row5[12]; ?></td>
                <td><?php echo $row5[9]; ?></td>
				<td> <a href='edit_ot.php?id=<?php echo $row5[15]; ?>'> Edit </a></td>
                <td> <a href="javascript:confirm_deleteot(<?php echo $row5[15]; ?>);"> Delete </a></td>
                
                </tr>
                <?php } ?>
                </table>
                 
                  </fieldset>
      </form>


    
</div></div>
</body>
</html>
<?php 
}else
{ 
 header("location: index.html");
}
?>