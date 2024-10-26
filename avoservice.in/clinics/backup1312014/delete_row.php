<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<meta name="keywords" content="#" />
<meta name="description" content="#" />
<link href="style.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>



  <!--menu-->
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css">
		<link rel="stylesheet" href="menu/css/style.css" type="text/css" media="all" charset="utf-8" />
		<link rel="stylesheet" href="menu/css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
        <script src="menu/js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- Create a MenuMatic Instance -->
	<script type="text/javascript" >
		window.addEvent('domready', function() {			
			var myMenu = new MenuMatic({ orientation:'vertical' });			
		});		
	</script>
	
	<!-- begin google tracking code -->
	 <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        var pageTracker = _gat._getTracker("UA-2180518-1");
        pageTracker._initData();
        pageTracker._trackPageview();
    </script>
    
<!--end menu-->

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
var a = document.opd.diagnosis;

var add = a.value+',';

document.opd.diag.value += add;
return true;
}
</script>

<script type="text/javascript">
function addThem1(){
var a = document.opd.rec;

var add = a.value+',';

document.opd.recm.value += add;
return true;
}
</script>
<!-- end multiple selection -->

<!-- validation-->
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
</script><!--end validation-->

<!-- Appointment validation-->
<script type='text/javascript'>

function appvalidate(appform){
 with(appform)
 {
  

if(name.value=="")
{
	alert("Please Enter Name");
	name.focus();
	return false;
}
 
if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please Enter Contact No. ");
cn.focus();
return false;
}
if(appdate.value== "")
{
alert("Please Select Appointment Date");
appdate.focus();
return false;
}

}
 return true;
 }
</script><!--end validation-->

<!--Telephone Directory validation-->
<script type='text/javascript'>

function telvalidate(telform){
 with(telform)
 {
  

if(name.value=="")
{
	alert("Please Enter Name");
	name.focus();
	return false;
}
 
if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please Enter Contact No. ");
cn.focus();
return false;
}
if(pin.value.search(/[0-9]+/)== -1)
  {
alert("Please Enter Pincode ");
pin.focus();
return false;
}

}
 return true;
 }
 
 
 
 //////////////list
var searchReq = getXMLHttp();
function getXMLHttp()

{

  var xmlHttp
  // alert("hi1");
  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {

    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }
    catch(e)
    {
      try

      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
 return xmlHttp;

}

function MakeRequest()
{
  var xmlHttp = getXMLHttp();
 //alert("hi");
  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)
    {
      HandleResponse(xmlHttp.responseText);
    }
  }

 //alert("hi2");

var str=document.getElementById('submit').value;
var str1=document.getElementById('search').value;
var str2=document.getElementById('searchtxt').value;
// alert(str1);
 // alert(str2);
 xmlHttp.open("POST", "view.php");
 xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.send('code='+str2+'&search='+str1);
 // alert('code='+str2+'&search='+str1)
//xhr.open('POST', '/front/test');
//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//xhr.send('someNumber=12');
}

function HandleResponse(response)

{ 

  document.getElementById('view_teldir1').innerHTML = response;

}
</script><!--end validation-->

<!-- popup window -->
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
	display:none;
	background: #00a4ae;
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.1em;
	position: fixed;
	top: 50%; left: 40%; color:#FFF;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { /*Position the close button*/
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

form.signin td{ font-size:12px;}
td,th{padding-left:3px; padding-right:3px;}
</style>
<script type="text/javascript" src="popup/jquery-1.6.4.min.js"></script>
<script>
$(document).ready(function() {
	$('a.login-window').click(function() {
		
                //Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});

</script>
<!-- end of popup window -->
<script>
function OpenWindow(info) {
	alert(info);
  window.open(info,'WinName','height=400,width=600,resizable=yes,scrollbars=yes');
 
}
$(document).ready(function(){

		//Hide div w/id extra
	   $("#extra").css("display","none");

		// Add onclick handler to checkbox w/id checkme
	   $("#checkme").click(function(){

		// If checked
		if ($("#checkme").is(":checked"))
		{
			//show the hidden div
			$("#extra").show("fast");
		}
		else
		{
			//otherwise, hide it
			$("#extra").hide("fast");
		}
	  });

	});
</script>
</head>
<body>

<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
    	<div id="banner_left">
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete heart care</span>
                </a></h1>
            </div><!--end of site title-->
            
       <div id="menu">
            
       <ul id="nav">

			<li><a href="#">Patient</a>
		
				<ul>
					<li><a href="#login-box" class="login-window">Add New</a></li>
					 <li><a href="#view_patient" class="login-window">View Records</a></li>
					
				</ul>
			</li>
		
			 <li><a href="#">Doctor</a></li>
             <li><a href="#">OPD</a>
                <ul>
					<li><a href="#new_opd" class="login-window"> New </a></li>
					 <li><a href="#ex_opd" class="login-window">Existing</a></li>
					
				</ul>
             </li>
             <li><a href="#">Diagnosis</a></li>
             <li><a href="#">Medical Reports</a></li>
             
		      <li><a href="#">Appointments</a>
		
				<ul>
					<li><a href="#newapp" class="login-window">Add New</a></li>
                    <li><a href="#view_patient" class="login-window">Existing</a></li>
					<li><a href="#viewapp" class="login-window">View Records</a></li>
	           </ul>
			  </li>
			
		      <li><a href="#">Telephone Directory</a>
                 <ul>
					<li><a href="#teldir" class="login-window">Add New</a></li>
                    <li><a href="#view_teldir" class="login-window">View Records</a></li>
	             </ul>
              </li>
             
		</ul><!--end of nav-->
	
	
    </div> <!-- end of menu -->
    </div>
        
        <div id="banner_right">
            <div id="banner_box">
           
           	  <h1>Welcome to Health Clinic </h1><br /><br />
               
              <div class="button"><a href="index.html">Log Out</a></div>
           
            </div>
		</div>
            
    </div> <!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->

<div id="content">


    
</div> <!-- end of content --><!-- end of footer wrapper -->

<!--New Patient -->

<div id="login-box" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_patient.php" onSubmit="return validate(this)" name="form">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Patient</p>
                
            	<label class="fname">
                <span>First Name:</span>
                <input id="fname" name="fname" type="text"  >
                </label>
                
                <label class="lname">
                <span>Last Name:</span>
                <input id="lname" name="lname" type="text">
                </label>
                
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text">
                </label>
                
                <label class="gender">
                <span><b> Gender: </b></span>
                <font color="#FFFFFF"> Male: </font><input name="gen" id="gen" type="radio"  checked="checked" value="Male" style="width:20px;"/>
                <font color="#FFFFFF"> Female: </font><input name="gen" id="gen" type="radio" value="Female" style="width:20px;"/>
                </label>
                
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text">
                </label>
                
                <label class="add">
                <span>Address:</span>
                <textarea name="add" rows="3" cols="42" style="resize:none;"></textarea>
                </label>
                
                <label class="bg">
                <span>Blood Group:</span>
                <select name="bg" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:320px;">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                </select>
                </label>
                
                <label class="ms">
                <span>Marital Status:</span>
                <select name="ms" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:320px;">
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                </select>
                </label>
                
                <label class="height">
                <span>Height:</span>
                <input id="height" name="height" type="text">
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div><!--end of New Patient -->


<!--view patient records-->

<div id="view_patient" class="login-popup">

<?php 

include('config.php');
//$id=$_GET['patient_id'];
$result = mysql_query("select * from new_patient");
//$row = mysql_fetch_row($result);



?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <table border="1" style="border:2px #ac0404 solid;"> 
          <th width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Fname</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Lname</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Bloodgroup</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Marital Status</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Height</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
           <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Select</th>
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
	<td> <?php echo $row[1]; ?></td>
    <td> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[7]; ?></td>
    <td> <?php echo $row[8]; ?></td>
    <td> <?php echo $row[9]; ?></td>
    <td> <a href='edit_patient.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href='delete_patient.php?id=<?php echo $row[0]; ?>'> Delete </a></td>
     <td><input name="code1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="if(this.checked){OpenWindow(this.value)}" /> </td>
   
</tr>
<?php } ?></table>
</div>
<!--end of view patient records-->



<!--New Appointment -->

<div id="newapp" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Appointment</p>
                
            	<label class="name">
                <span> Name: </span>
                <input id="name" name="name" type="text" autocomplete="on" >
                </label>
                                            
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text">
                </label>
                 
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text">
                </label>
                
                
                <label class="appfor">
                <span>Appointment For:</span>
                <select name="appfor" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:320px;">
                <option value="Audiogram">Audiogram</option>
                <option value="Syringe-Audiogram">Syringe-Audiogram</option>
                <option value="Syringe-Audiogram-Doctor">Syringe-Audiogram-Doctor</option>
                </select>
                </label>
                
                <label class="Date">
                <span>Date:</span>
                <input id="appdate" name="appdate" type="text">
                <input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate');"/>
                </label>
                
              <label class="time">
                <span><b> Time: </b></span><span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
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
                
<?php 

include('config.php');
//$id=$_GET['patient_id'];
$result = mysql_query("SELECT app_date,app_time FROM new_app WHERE app_date >= CURRENT_DATE order by app_date;");
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
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!-- end of New Appointment -->


<!--view Appointment records-->

<div id="viewapp" class="login-popup">

<?php 

include('config.php');
//$id=$_GET['patient_id'];
$result = mysql_query("select * from new_app");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <table border="1" style="border:2px #ac0404 solid;"> 
          <th width="75" style="color:#ac0404; font-size:14px; font-weight:bold;">Treat_ID</th>
          <th width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</th>
          <th width="210" style="color:#ac0404; font-size:14px;font-weight:bold;">Appointment For</th>
          <th width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Time</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
         
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
	<td width="110"> <?php echo $row[1]; ?></td>
    <td width="105"> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td width="103"> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <a href='edit_app.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href='delete_app.php?id=<?php echo $row[0]; ?>'> Delete </a></td>

   
</tr>
<?php } ?></table>
</div>
<!--end of view appointment records-->


<!--telephone directory-->

<div id="teldir" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_directory.php" onSubmit="return telvalidate(this)" name="telform"> 
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Telephone Directory</p>
                
            	<label class="name">
                <span> Name: </span>
                <input id="name" name="name" type="text" autocomplete="on" >
                </label>
                
                <label class="address">
                <span> Address: </span>
                <textarea name="add" cols="42" rows="3" style="resize:none;"></textarea>
                </label>
                                            
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text">
                </label>
                 
                <label class="pin">
                <span>Pincode:</span>
                <input id="pin" name="pin" type="text">
                </label>
                
                
                <label class="info">
                <span>Information For:</span>
                <select name="info" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:320px;">
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
                </select>
                </label>
          
                <button class="submit formbutton" type="submit">Submit</button>
                                       
                </fieldset>
          </form>
</div>
<!--end of telephone directory-->



<!--view Telephone Directory-->

<div id="view_teldir" class="login-popup">
<div id="view_teldir1">
<?php 

include('config.php');
//$id=$_GET['patient_id'];
$result = mysql_query("select * from tel_directory");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <table border="1" style="border:2px #ac0404 solid;"> 
          
          <th width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Pincode</th>
          <th width="130" style="color:#ac0404; font-size:14px;font-weight:bold;">Information For</th>
          <th width="70" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="70" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
	<td width="110"> <?php echo $row[1]; ?></td>
    <td width="105"> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td> <a href='edit_teldir.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href='delete_teldir.php?id=<?php echo $row[0]; ?>'> Delete </a></td>
    </tr>
<?php } ?>
</table></div>
<br />

Search By: 

<select name="search" id="search" onchange="document.getElementById('searchtxt').value=''">
      <option value="contact">Contact No.</option>
      <option value="pincode">Pincode</option>
</select>
           
           <input type="text" onkeyup="ajax_showOptions(this,document.getElementById('search').value,event);" id="searchtxt" name="searchtxt"/>
           <input name="submit" type="submit" value="SEARCH" id="submit" onclick="MakeRequest();" style="width:90px; height:25px; background-color:#ac0404; border:1px #ac0404 solid; color:#FFF; cursor:pointer;"/>
</div>
<!--end of view telephone directory-->



<!--New OPD -->

<div id="new_opd" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_opd.php" name="opd">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">OPD</p>
                
            	<label class="name">
                <span>Name:</span>
                <input id="name" name="name" type="text"  >
                </label>
                
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text">
                </label>
                                
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text">
                </label>
                                
                <label class="diagnosis">
                <span>Diagnosis:</span>
                <select name="diagnosis" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:315px;" onChange="addThem()">
                <option value="abc">abc</option>
                <option value="xyz">xyz</option>
                <option value="pqr">pqr</option>
                <option value="def">def</option>
                </select><br />
                <textarea name="diag" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <label class="rec">
                <span>Recommendations:</span>
                <select name="rec" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:315px; alignment-adjust:central;" onChange="addThem1()">
                <option value="X-ray">X-ray</option>
                <option value="Blood Test">Blood Test</option>
                <option value="Cardiogram">Cardiogram</option>
                </select><br />
                <textarea name="recm" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <label class="comments">
                <span> Comments: </span>
                <textarea name="comment" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--end of New opd -->



<!--Existing OPD -->

<div id="ex_opd" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
       
          <form method="post" class="signin" action="new_opd.php" name="opd">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">OPD</p>
                
            	<label class="name">
                <span>Name:</span>
                <input id="name" name="name" type="text"  >
                </label>
                
                <label class="age">
                <span>Age:</span>
                <input id="age" name="age" type="text">
                </label>
                                
                <label class="cn">
                <span>Contact No.:</span>
                <input id="cn" name="cn" type="text">
                </label>
                                
                <label class="diagnosis">
                <span>Diagnosis:</span>
                <select name="diagnosis" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:315px;" onChange="addThem()">
                <option value="abc">abc</option>
                <option value="xyz">xyz</option>
                <option value="pqr">pqr</option>
                <option value="def">def</option>
                </select><br />
                <textarea name="diag" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <label class="rec">
                <span>Recommendations:</span>
                <select name="rec" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:315px; alignment-adjust:central;" onChange="addThem1()">
                <option value="X-ray">X-ray</option>
                <option value="Blood Test">Blood Test</option>
                <option value="Cardiogram">Cardiogram</option>
                </select><br />
                <textarea name="recm" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <label class="comments">
                <span> Comments: </span>
                <textarea name="comment" cols="37" rows="3" style="resize:none;"></textarea>
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--end of Existing OPD -->



</body>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ajax-dynamic-list.js"></script>
<style type="text/css" media="screen">
.style1 {color: #FF0000}
.style4 {color: #000000; font-weight: bold; }
.style8 {font-family: Arial, Helvetica, sans-serif}
.style10 {color: #993399}

	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:175px;	/* Width of box */
		height:250px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
		text-align:left;
		font-size:0.9em;
		z-index:100000;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#317082;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}

</style>	

</html>