<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<meta name="keywords" content="#" />
<meta name="description" content="#" />
<link href="style1.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


  <!--menu-->
<style type="text/css">

.sidebarmenu ul{
margin: 0;
padding: 0;
list-style-type: none;
font: bold 14px Verdana;
width: 180px; /* Main Menu Item widths */
border-bottom: 1px solid #ccc;
border-radius:10px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
-khtml-border-radius:10px;
}
 
.sidebarmenu ul li{
position: relative;
}


/* Top level menu links style */
.sidebarmenu ul li a{
display: block;
overflow: auto; /*force hasLayout in IE7 */
color: white;
text-decoration: none;
padding: 6px;
border-bottom: 1px solid #fff;
border-right: 1px solid #fff;
border-radius:10px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
-khtml-border-radius:10px;
}

.sidebarmenu ul li a:link, .sidebarmenu ul li a:visited, .sidebarmenu ul li a:active{
background-color: #01a3ae; /*background of tabs (default state)*/
}

.sidebarmenu ul li a:visited{
color: white;
}

.sidebarmenu ul li a:hover{
background-color: #ac0404;
}

/*Sub level menu items */
.sidebarmenu ul li ul{
position: absolute;
width: 170px; /*Sub Menu Items width */
top: 0;
visibility: hidden;
}

.sidebarmenu a.subfolderstyle{
background: url(images/right.gif) no-repeat 97% 50%;
}

 
/* Holly Hack for IE \*/
* html .sidebarmenu ul li { float: left; height: 1%; }
* html .sidebarmenu ul li a { height: 1%; }
/* End */
.pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color:#00F;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }
</style>

<script type="text/javascript">

//Nested Side Bar Menu (Mar 20th, 09)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

function initsidebarmenu(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
  if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
   ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
  else //else if this is a sub level submenu (ul)
    ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
  ultags[t].style.visibility="visible"
  ultags[t].style.display="none"
  }
  }
}

if (window.addEventListener)
window.addEventListener("load", initsidebarmenu, false)
else if (window.attachEvent)
window.attachEvent("onload", initsidebarmenu)

</script>
  
<!--end menu-->

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

///dob
window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		no();
	};
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>
<!-- popup window -->
<style>
#child td{border:0;}
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
		background-color:#01a3ae;
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

form.signin input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#fff; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:220px; background-color:#01a3ae;
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
td,th{padding-left:3px; padding-right:13px;}
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


function citywindow()
{

  mywindow = window.open("newcity.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 
 function centerwindow()
{

  mywindow = window.open("newcenter.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
}
 
 
 function splwindow()
{

  mywindow = window.open("newspl.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
}

function docwindow()
{

  mywindow = window.open("newrefdoc.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
</script>

<script type="text/javascript">

/////////////doctor ref
function docref()
{ //alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("city1").value=s1[0];
		document.getElementById("cn1").value=s1[1];
		document.getElementById("email3").value=s1[2];
		document.getElementById("spl").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('ref1').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=df");
xmlhttp.send();
}

///end of ref
function toss()
{ ////alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
   // alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("toscity").value=s1[0];
		document.getElementById("tostel").value=s1[1];
		document.getElementById("tosemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('tos').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
}
//////end of ortho surgeon and strting of paed

function paedd()
{ //alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("paedcity").value=s1[0];
		document.getElementById("paedtel").value=s1[1];
		document.getElementById("paedemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('paed').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
}
///////////phys
function physs()
{ //alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("physcity").value=s1[0];
		document.getElementById("phystel").value=s1[1];
		document.getElementById("physemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('phys').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
}
///start of neuu
function neuu()
{ ///alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("neucity").value=s1[0];
		document.getElementById("neutel").value=s1[1];
		document.getElementById("neuemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('neu').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
//alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
}
///strt sw
function swwn()
{ alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
    alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("swcity").value=s1[0];
		document.getElementById("swtel").value=s1[1];
		document.getElementById("swemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('sw').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=sw",true);
alert("get_ref.php?docref="+str+"&ref=sw");
xmlhttp.send();
}
</script>



<!-- end of popup window -->

</head>
<body onload="createList();">

<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
    	<div id="banner_left">
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            
            
 <!--start menu-->           
       
       <div class="sidebarmenu">
					 <ul id="sidebarmenu1">
                        <li><a href="#" ></a></li>
                     
                      <li><a href="view_patient.php" >Patient</a>
                     <ul>
                     <li><a href="newpatient.php">Add New</a></li>
		  <li><a href="view_patient1.php" >View Records</a></li>
                      
                  <!--   <li><a href="#receipt" class="login-window">Receipt</a></li>
                     <li><a href="#payment" class="login-window">Payment</a></li>-->
                     </ul>
                     </li>
                    
                     <li><a href="#">Appointments</a>
                     <ul>
                     <li><a href="View_app.php" >OPD Appointments</a></li>
                     <li><a href="Wait_surgery.php">Surgery Appointments</a></li>
                     </ul>
                     </li>
                     
                       
                      <li><a href="view_patient.php" >Waiting List</a></li>
                      <!--<li><a href="otscheduler.php" >OT Scheduler</a></li>-->
                      <li><a href="#"> OPD </a>
                      <ul>
                      <li><a href="view_opd.php">View OPD </a></li>
                      <li><a href="opdcollection.php">OPD Collection</a></li>
                      </ul>
                      </li>
                      
                  <?php //}else { ?>
					 
                                   
                   
                    

                     

                    <li><a href="#">Diagnosis</a>
                    <ul>
                        <li><a href="diag.php">Add New</a></li>
                        <li><a href="view_diag.php" >View List</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Medical Reports</a>
                    <ul>
                       <li><a href="medreports.php">Add New</a></li>
                      
                    </ul>
                    </li>
     
                    
                    <li><a href="#">IPD</a>
                    <ul>
                        <li><a href="viewipd.php">View Records</a></li>
                        <li><a href="#" >Discharge</a>
                           <ul>
                              <li><a href="discharge.php">Add Record</a></li>
                              <li><a href="viewdischarge.php">View Records</a></li>
                           </ul>
                        </li>
                    </ul>
                    </li>

                    <li><a href="#">Surgery Details</a>
                    <ul>
                       <li><a href="view_surgry.php" >View Records</a></li>
                        <li><a href="view_surgWait.php" > Surgery Waiting List </a></li>
      
                    </ul>
                    </li>

                    <li><a href="#">Delivery Details</a>
                    <ul>
                       <li><a href="delivery.php">Add Details</a></li>
                       <li><a href="viewdelivery.php">View Details</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Telephone Directory</a>
                    <ul>
                        <li><a href="telephone.php">Add New</a></li>
                        <li><a href="viewtelephone.php">View Records</a></li>
                    </ul>
                    </li>
                    
                     <li><a href="masters.php">Master</a>
                     <ul>
                       <li><a href="masters.php">View Masters </a></li>
                       <li><a href="#">Doctor</a>

                     <ul>
                     <li><a href="doctor.php">Add New </a></li>
					 <li><a href="view_doctor.php" > View</a></li>
                     </ul>
                     </li>
                     
                     	<!--<li><a href="#">Findings</a>
                     	<ul>
                        <li><a href="newfinding.php">Add Findings</a></li>
					 	<li><a href="viewfinding.php"> View Findings</a></li>
                        </ul>
                        </li>
                       	<li><a href="#">Complaints</a>
                     	<ul>
                        <li><a href="newcomplain.php">Add Complaints</a></li>
					 	<li><a href="viewcomplain.php"> View Complaints</a></li>
                        </ul> 
                        </li>   
                        <li><a href="#">Advise</a>
                     	<ul>
                        <li><a href="newadvise.php">Add Advise</a></li>
					 	<li><a href="viewadvise.php"> View Advise</a></li>
                        </ul> 
                        </li> 
                        <li><a href="#opd_bill" class="login-window">OPD Bill Data</a></li>
                        <li><a href="#" >Medicines</a>
                           <ul>
                              <li><a href="newmedicine.php">Add New</a></li>
                              <li><a href="dosage.php">Dosage Instruction</a></li>
                           </ul>
                        </li> 
                                                    
                     </ul>
                     </li>

                    <li><a href="#">Staff</a>
                    <ul>
                      <li><a href="#">Staff Master</a>
                       <ul>
                        <li><a href="staff.php">Add New</a></li>
                        <li><a href="view_staff.php">View Records</a></li>
                      </ul>
                      </li>
				      <li><a href="#">Attendence</a>
                    <ul>
                        <li><a href="newattendance.php">Add Attendence</a></li>
                        <li><a href="viewattendence.php">View Attendence</a></li>
                    </ul>
                    </li>
                    <li><a href="#" >Leave Report</a>
                       <ul>
                         <li><a href="leavereport.php">Add New</a></li>
                         <li><a href="view_leaverecord.php">View Leave Record</a></li>
                       </ul>
                    </li>
                    
                    <li><a href="#"> Salary</a>
                   <ul>
                       <li><a href="#new_salary" class="login-window">Add Salary</a></li>
                       <li><a href="#view_salary" class="login-window">View Salary</a></li>
                    </ul>
                    </li>-->
                    
                     
                    </ul>
                    </li>
                    <li><a href="#">Reports</a>
                     <ul>
                       <li><a href="#">List of New Patients</a></li>
                       <li><a href="#">OPD Collection Register</a></li>
                       <li><a href="#" class="login-window">OT Register</a></li>
                       <li><a href="#" class="login-window">Hospital wise Summary</a></li>
                       <li><a href="#" class="login-window">Operation Head wise Summary</a></li>
                       <li><a href="#" class="login-window">Address wise List of Patients</a></li>
                       <li><a href="#" class="login-window">Hospital wise List of Patients</a></li>
                       <li><a href="#" class="login-window">Check List for IPD Patients</a></li>
                       <li><a href="#" class="login-window"> O.T. Waiting List</a></li>
                    </ul>
                    </li>
                   
                    <li><a href="http://sarmicrosystems.in/accounts/" target="_new">Accounts</a></li>
                    
                    </ul>
</div>

    <!-- end of menu -->
    </div>
        <div id="banner_right">
         <form method="post" class="signin" action="new_patient.php" onSubmit="return validate(this)" name="form" enctype="multipart/form-data">
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Patient</p><br />
                
              
                
                <table id="sub">
                  <tr>
                    <td width="107" height="33"><label class="fname"> Full Name: </label></td>
                    <td width="236"><input id="fname" name="fname" type="text" /></td>
                    <td width="117"><label class="age"> Date of Birth: </label></td>
                   <td width="254"><input id="dob" name="dob" type="text"  /><input id="age" name="age" type="text" onClick="ageCount();" style="width:70px;" readonly="readonly"/></td>
                  </tr>
                  <script type="text/javascript">
    
    function ageCount() {
     var d =document.getElementById('dob1').value.split('/'); 
var today=new Date(); 
var bday=new Date(d[2],d[1],d[0]); 
var by=bday.getFullYear(); 
var bm=bday.getMonth()-1; 
var bd=bday.getDate(); 
var age=0; var dif=bday; 
while(dif<=today){ 
var dif = new Date(by+age,bm,bd); 
age++; 
} 

age +=-2 ; 	     //calculating age 
           document.getElementById("age").value= age;
   }

</script>
                  <tr>
                    <td height="33"><label class="gender"> Sex: </label></td>
                    <td><font color="#000"> Male: </font>
                        <input name="gen" id="gen" type="radio" value="Male" style="width:20px;"/>
                        <font color="#000"> Female: </font>
                      <input name="gen" id="gen" type="radio" value="Female" style="width:20px;"/>
                    </td>
                    <td height="33"><label class="cn">Mobile1 :</label></td>
                    <td><input id="cn22" name="cn22" type="text" /></td>
                   
                  </tr>
                  <tr>
                     <td><label class="city">City :</label></td>
                    <td><select name="city" id="city" style="background:#fff;border:1px solid #ac0404;width:222px;height:27px;">
                        <option value="0">Select</option>
                        <?php $city=mysql_query("select * from city where name<>'' ORDER BY name ASC ");
				while($city1=mysql_fetch_row($city)){
				?>
                        <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                        <?php } ?>
                    </select>
                    
                    <input type="button" name="cityadd" id="cityadd" style="width:100px;" value="Add New" onClick="citywindow();"/>
                    </td>
                    <td height="33"><label class="cn">Mobile2 :</label></td>
                    <td><input id="mob2" name="mob2" type="text" /></td>
                   
                  </tr>
                  <tr>
                    <td><label class="add">Address:</label></td>
                    <td><textarea name="add" rows="3" cols="25" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  
                    <td height="33"><label class="cn">Telephone No.:</label></td>
                    <td><input id="cn12" name="cn12" type="text" /></td>
                  </tr>
				  
				  <tr>
				  <td> Reference: </td>
                    <td>
                    <select name="ref" id="ref" style="width:222px; height:27px;">
                    <option value="0">Select</option>
                    <option value="Dr">Dr</option>
                    <option value="Website">Website</option>
                    <option value="Newspaper">Newspaper</option>
                    <option value="Another Patient">Another Patient</option>
                    <option value="Social Worker">Social Worker</option>
                    <option value="None">None</option>
                    </select>                    
                    </td>
                 
                    <td> Email Id 1 : </td>
                    <td><input type="text"  name="email1"  id="email1"/>
				  
				  </tr>
                  <tr>
                   
                    
                  </tr>
                  <?php 

$result = mysql_query("select doc_id,name from doctor where name<>'' order by ASC");
$result1 = mysql_query("select ref_id,name from doctor_ref where name<>'' order by ASC");
?>
                  <tr>
                   <td><label class="timegiven"> Centre:</label></td>
                    <td><select name="center" id="center" style="background:#fff;border:1px solid #ac0404;width:222px;height:26px;">
                        <option value="0">Select</option>
                <?php $area1=mysql_query("select * from area ORDER BY name ASC");
				while($area=mysql_fetch_row($area1)){
				?>
                <option value="<?php echo $area[0]; ?>"><?php echo $area[0]; ?></option>
                <?php } ?>
                    </select>
                    <input type="button" name="centreadd" id="centreadd" style="width:100px;" value="Add New" onClick="centerwindow();"/>
                    </td>
                  
                  <td> Email Id 2 :</td>
                    <td><input type="text"  name="email2"  id="email2"/>
                    
                  </tr>
                  </table>
                  
                  <button class="submit formbutton" type="button" name="newref" style="width:150px;" onClick="docwindow();">Add New Reference </button>
                <table width="884">
				<tr>
				<td width="195"><label class="ref1">Doctor Reference:</label>
                <label class="ref1">
                <select name="ref1" id="ref1" onchange="docref();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php 
				$resultd = mysql_query("SELECT * FROM  `doctor` WHERE  `NAME` <>  ' 'ORDER BY name ASC ");
				while($rowd=mysql_fetch_row($resultd))
                {  ?>
                <option value="<?php echo $rowd[0]; ?>"><?php echo $rowd[1]; ?></option>
				<?php } ?>
                </select></label>
                </td>
				
				<td width="175"><label class="city">City :</label>
                <label class="ref1">
                <input type="text" name="city1" id="city1" style="width:130px;"/></label></td>
				
				<td width="142"><label class="cn">Telephone No.:</label>
                <label class="ref1"><input id="cn1" name="cn1" type="text" style="width:100px;"></label></td>
				
				<td width="166" height="87"><label class="cn"> Email: </label>
				<label class="ref1"> <input type="text"  name="email3"  id="email3" style="width:150px;"/></label></td>
				
				<td width="182" > 
                <label class="spl">Specialist :</label>
                <label class="splt"><input type="text" name="spl" id="spl" style="width:120px;"></label></td>
				</tr>
                
                <tr>
				<td><label class="ref">Treating Ortho Surgeon:</label>
				<?php
				$result2 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Orthopaedic Surgeon' OR `SPECIAL` LIKE 'Orthopaedic Surgeon' order by name ASC");?>
                <label class="ref">
                <select name="tos" id="tos" onchange="toss();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row2=mysql_fetch_row($result2))
                {  ?>
                <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
				<?php } ?>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input  type="text" name="toscity" id="toscity" style="width:130px;"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="tostel" name="tostel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email:</label>
				<label class="ref"><input type="text"  name="tosemail"  id="tosemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
				
				<tr>
				<td><label class="ref">Treating Paediatrician:</label>
				<?php
				$result3 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Paediatrician' OR `SPECIAL` LIKE 'Paediatrician' order by name ASC");?>
                <label class="ref">
                <select name="paed" id="paed"  onchange="paedd();"style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row3=mysql_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="paedcity" id="paedcity" style="width:130px;"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="paedtel" name="paedtel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"> <input type="text"  name="paedemail"  id="paedemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
				
				<tr>
				<td><label class="ref">Treating Physiotherapist:</label>
				<?php
				$result4 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Physiotherapist' OR `SPECIAL` LIKE 'Physiotherapist' order by name ASC");?>
                <label class="ref">
                <select name="phys" id="phys" onchange="physs();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row4=mysql_fetch_row($result4))
                {  ?>
                <option value="<?php echo $row4[0]; ?>"><?php echo $row4[1]; ?></option>
				<?php } ?>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input type="text" name="physcity" id="physcity" style="width:130px;"> </label>
                 </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="phystel" name="phystel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51"> <label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="physemail"  id="physemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
				
				<tr>
				<td><label class="ref">Treating Neurologist:</label>
				<?php
				$result5 = mysql_query("select doc_id,name from doctor where SPECIAL='Neuro Surgeon' OR  SPECIAL='Neurologist' or CATEGORY ='Neurologist' order by name ASC");?>
                <label class="ref">
                <select name="neu" id="neu" onchange="neuu();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"><?php echo $row5[1]; ?></option>
				<?php } ?>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input type="text" name="neucity" id="neucity" style="width:130px;">  </label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="neutel" name="neutel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51" > <label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="neuemail"  id="neuemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
				
				<tr>
				<td><label class="ref">Social Workers Name:</label>
				<?php
				$result6 = mysql_query("select * from social where name<>''");?>
                <label class="ref">
                <select name="sw" id="sw" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;" onchange="swwn();">
                <option value="0">Select</option>
                <?php while($row6=mysql_fetch_row($result6))
                {  ?>
                <option value="<?php echo $row6[4]; ?>"><?php echo $row6[0]; ?></option>
				<?php } ?>
                </select>
                </label>
                </td>
                
                <td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="swcity" id="swcity" style="width:130px;" ></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="swtel" name="swtel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"> <input type="text"  name="swemail"  id="swemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
                
				
				<tr>
				<td><label class="ref">NGO Reference:</label>
				<?php
				$result7 = mysql_query("select * from ngo where name<>''");?>
                <label class="ref">
                <select name="ng" id="ng" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;" onChange="swap(this.value, 'ngotxt')">
                <option value="0">Select</option>
                <?php while($row7=mysql_fetch_row($result7))
                {  ?>
                <option value="<?php echo $row7[0]; ?>"><?php echo $row7[0]; ?></option>
				<?php } ?>
                </select>
                </label>
                </td>
                
                
				<td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="ngcity" id="ngcity" style="width:130px;"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="ngtel" name="ngtel" type="text" style="width:100px;"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="ngemail" id="ngemail" style="width:150px;"/></label>
                </td>
                
                <td width="49"> <button class="submit formbutton" type="button" name="newref" style="width:70px;" onClick="docwindow();">Add New  </button></td>
				</tr>
				
				<td>Remarks :</td>
				<td colspan="4"><input type="text" name="rem" id="rem" style="width:530px;"/></td>
				</tr>
                
                <tr>
                <td><button class="submit formbutton" type="submit" name="Submit">Save & Exit</button> </td>
			
				<td colspan="2"><a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';" style="width:100px;">Cancel</button></a></td>
                </tr> 
                </table>
                  </fieldset>
         </form>
        </div>
        
            
    </div> <!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->

<div id="content">


    
</div> <!-- end of content --><!-- end of footer wrapper -->


</body>


</html>
<?php 
}else
{ 
 header("location: index.html");
}

?>