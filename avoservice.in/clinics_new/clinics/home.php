<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<meta name="keywords" content="#" />
<meta name="description" content="#" />
<link href="style.css" rel="stylesheet" type="text/css" />

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
<!--month, year dropdown-->
<script type="text/javascript">
function createList(){

year=document.getElementById('year');
var i=2000;
for (i=2000; i<=new Date().getFullYear(); i++)
{
	var newOpt=year.appendChild(document.createElement('option'));	
	newOpt.text = ""+i;
	newOpt.value=""+i;
}}

function daysInMonth(month,year)
{
var dd = new Date(year, month, 0);
return dd.getDate();
}

function setDayDrop(dyear, dmonth, dday) 
{
var year = dyear.options[dyear.selectedIndex].value;
var month = dmonth.options[dmonth.selectedIndex].value;
var day = dday.options[dday.selectedIndex].value;

if (day == ' ') 
{
var days = (year == ' ' || month == ' ')
    ? 31 : daysInMonth(month,year);
dday.options.length = 0;
dday.options[dday.options.length] = new Option(' ',' ');

for (var i = 1; i <= days; i++)
dday.options[dday.options.length] = new Option(i,i);

}
}


function setDay() 
{
var year = document.getElementById('year');
var month = document.getElementById('month');
var day = document.getElementById('day');
setDayDrop(year,month,day);
}
//document.getElementById('year').onchange = setDay;
//document.getElementById('month').onchange = setDay;

</script>
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
</script>

<!-- multiple selection -->
<script type="text/javascript">
function addThem()
{
var a = document.opdform.diagnosis;
var add = a.value+',';
document.opd.diag.value += add;
return true;
}

function addThem1()
{
var a = document.opdform.rec;
var add = a.value+',';
document.opd.recm.value += add;
return true;
}
</script>
<!-- end multiple selection -->

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
//////////////Getdate
 function getDate1()
{
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
    document.getElementById("adate1").innerHTML=xmlhttp.responseText;
 �  }
  }
  var str=document.getElementById('adate').value;
xmlhttp.open("GET","getdate.php?adate="+str,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fname=Henry&lname=Ford");
}
<!--end validation-->
<!--calculate days from month-->
function caldays()
{

	var m=document.getElementById('month').value;
	var y=document.getElementById('year').value;

        if(m==01||m==03||m==05||m==07||m==08||m==10||m==12)
	{
		var dmax = 31;	
		document.getElementById('day1').value= dmax;
		return dmax;	        

	}
	else if (m==04||m==06||m==09||m==11)
	{

        	var dmax = 30;		
			document.getElementById('day1').value= dmax;	
		return dmax;		  

	}
	else
	{ 	

		if((y%400==0) || (y%4==0))
		{

			dmax = 29;		
			document.getElementById('day1').value= dmax;		
			return dmax;
			
			

		}
                else 
                {
                    dmax = 28;			
					document.getElementById('day1').value= dmax;	
                }
		return dmax;
			

	}

}	</script>
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
<!--end validation--> 
 
 <!-- Staff validation-->
function staffvalidate(staffform){
 with(staffform)
 {
  

if(fname.value=="")
{
	alert("Please Enter Name");
	fname.focus();
	return false;
}
 
 if(dob4.value=="")
{
	alert("Please select Birth Date");
	dob4.focus();
	return false;
}

if(add.value=="")
{
	alert("Please Enter Address");
	add.focus();
	return false;
}

if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please enter Telephone No. to continue.");
cn.focus();
return false;
}

if(post.value=="")
{
	alert("Please enter Post");
	post.focus();
	return false;
}

if(bsal.value=="")
{
	alert("Please enter Basic Salary");
	bsal.focus();
	return false;
}

}
 return true;
 }
<!--end validation-->

 <!--New doc validation-->

function docvalidate(docform){
 with(docform)
 {
  

if(name.value=="")
{
	alert("Please Enter Name");
	name.focus();
	return false;
}
 

if(city.value=="")
{
	alert("Please Enter City");
	city.focus();
	return false;
}
if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please Enter Contact No. ");
cn.focus();
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

<!--search doctor-->
function MakeRequest1()
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
var str1=document.getElementById('docsearch').value;
var str2=document.getElementById('searchdoc').value;
// alert(str1);
 // alert(str2);
 xmlHttp.open("POST", "view_doc.php");
 xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.send('code='+str2+'&docsearch='+str1);
 // alert('code='+str2+'&search='+str1)
//xhr.open('POST', '/front/test');
//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//xhr.send('someNumber=12');
}

function HandleResponse(response)

{ 

  document.getElementById('view_doc1').innerHTML = response;

}

</script><!--end validation-->

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
td,th{padding-left:3px; padding-right:13px;}
</style>
<script type="text/javascript" src="popup/jquery-1.6.4.min.js"></script>
<script>
$(document).ready(function() {alert("hi");
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

///////////////////////////////search By Id
function searchById()
{
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
    document.getElementById("search").innerHTML=xmlhttp.responseText;
 �  }
  }
  var id=document.getElementById('idd').value;
  var fname=document.getElementById('fname22').value;
 // alert(id);
xmlhttp.open("GET","get_ByID.php?id=" + id+"&fname="+fname,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
xmlhttp.send();
}


///////////////////////////////search Doctor
function searchdoc1()
{
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
    document.getElementById("docsearch1").innerHTML=xmlhttp.responseText;
 �  }
  }
  var id=document.getElementById('did').value;
  var dname=document.getElementById('dname').value;
  //var city=document.getElementById('city22').value;
 // alert(city);
xmlhttp.open("GET","get_docID.php?id=" + id+"&dname="+dname,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
xmlhttp.send();
}

///////////////////////////////search Surgery
function searchsur()
{
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
    document.getElementById("sursearch").innerHTML=xmlhttp.responseText;
 �  }
  }
  var type=document.getElementById('type').value;
  var head=document.getElementById('head').value;
  //var city=document.getElementById('city22').value;
 // alert(city);
xmlhttp.open("GET","get_surID.php?type=" + type+"&head="+head,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
xmlhttp.send();
}

///////////////////////////////search Appointments
function searchapp()
{
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
    document.getElementById("appsearch").innerHTML=xmlhttp.responseText;
 �  }
  }
  var pname=document.getElementById('pname').value;
  var adate=document.getElementById('adate').value;
  //var city=document.getElementById('city22').value;
 // alert(city);
xmlhttp.open("GET","get_appID.php?pname=" + pname+"&adate="+adate,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
xmlhttp.send();
}


///////////////////////////////search Telephone
function searchtel()
{
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
    document.getElementById("telsearch").innerHTML=xmlhttp.responseText;
 �  }
  }
  var tname=document.getElementById('tname').value;
  var tcon=document.getElementById('tcon').value;
  //var city=document.getElementById('city22').value;
 // alert(city);
xmlhttp.open("GET","get_telID.php?tname=" + tname+"&tcon="+tcon,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
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
        
            <div id="site_title" style="margin-bottom:-100px;">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            
            
 <!--start menu-->           
       
       <div class="sidebarmenu" style="margin-top:130px;">
					 <ul id="sidebarmenu1">
                        
                     
                      <li><a href="#" >Patient</a>
                     <ul>
                     <li><a href="newpatient.php" class="login-window">Add New</a></li>
					 <li><a href="view_patient1.php" >View Records</a></li>
                      
                  <!--   <li><a href="#receipt" class="login-window">Receipt</a></li>
                     <li><a href="#payment" class="login-window">Payment</a></li>-->
                     </ul>
                     </li>
                    
                     <li><a href="#">Appointments</a>
                    <ul>
                    <li><a href="View_app.php" >Today's Appointments</a></li>
                     <!--<li><a href="Wait_surgery.php">Surgery Appointments</a></li>-->
                                      
                     </ul>
                     </li>
                     
                        <?php // if($_SESSION['type']=="d"){ ?>
                      <li><a href="view_patient.php" >Patient Records</a></li>
                      <li><a href="view_opd.php" > View OPD </a></li>
                       <li><a href="view_surgWait.php" > Surgery Waiting List </a></li>
                  <?php //}else { ?>
					 
                                   
                     <li><a href="#">Doctor</a>
                     <ul>
                     <li><a href="newdoctor.php" class="login-window">Add New </a></li>
					 <li><a href="view_doctor.php" > View</a></li>
                     </ul>
                     </li>
                     
                    
   <li><a href="#">Accounts</a>
                    <ul>
					<li><a href="payment.php" >Payment</a></li>
                    <li><a href="accounts.php" >Collection report</a></li>
					<li><a href="paymentdetailreport.php" >Payment report</a></li>
                     <!--<li><a href="Wait_surgery.php">Surgery Appointments</a></li>-->
                                      
                     </ul>
                     </li>
                  
                     

                    <li><a href="#">Diagnosis</a>
                    <ul>
                        <li><a href="diag.php">Add New</a></li>
                        <li><a href="view_diag.php" >View List</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Medical Reports</a>
                    <ul>
                       <li><a href="newmedreport.php" class="login-window">Add New</a></li>
                       <li><a href="viewmedreport.php" class="login-window">Existing</a></li>
                    </ul>
                    </li>
     
                    
                    <li><a href="#">IPD</a>
                    <ul>
                        <li><a href="view_admission.php" >View Records</a></li>
                        <li><a href="#" >Discharge</a>
                           <ul>
                              <li><a href="adddischarge.php" class="login-window">Add Record</a></li>
                              <li><a href="viewdischarge.php" class="login-window">View Records</a></li>
                           </ul>
                        </li>
                    </ul>
                    </li>

                    <li><a href="#">Surgery Details</a>
                    <ul>
                       <li><a href="view_surgry.php" >View Records</a></li>
      
                    </ul>
                    </li>

                    <li><a href="#">Delivery Details</a>
                    <ul>
                       <li><a href="delivery.php" class="login-window">Add Details</a></li>
                       <li><a href="view_delivery.php" class="login-window">View Details</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Telephone Directory</a>
                    <ul>
                        <li><a href="teldir.php" class="login-window">Add New</a></li>
                        <li><a href="view_teldir.php" class="login-window">View Records</a></li>
                    </ul>
                    </li>
                    
                     <li><a href="#">Master</a>
                     <ul>
                     	<li><a href="#">Findings</a>
                     	<ul>
                        <li><a href="newfinding.php" class="login-window">Add Findings</a></li>
					 	<li><a href="view_finding.php" class="login-window"> View Findings</a></li>
                        </ul>
                        </li>
                       	<li><a href="#">Complaints</a>
                     	<ul>
                        <li><a href="#new_complaint" class="login-window">Add Complaints</a></li>
					 	<li><a href="#view_complaint" class="login-window"> View Complaints</a></li>
                        </ul> 
                        </li>   
                        <li><a href="#">Advise</a>
                     	<ul>
                        <li><a href="new_advise.php" class="login-window">Add Advise</a></li>
					 	<li><a href="view_advise.php" class="login-window"> View Advise</a></li>
                        </ul> 
                        </li>
                     <li><a href="#">Medical Stores</a>
                     	<ul>
                        <li><a href="newmedical.php" class="login-window">Add Medical Store</a></li>
					 	<li><a href="view_medical.php " class="login-window"> View Medical Stores</a></li>
                        </ul> 
                        </li> 
                        <li><a href="#opd_bill" class="login-window">OPD Bill Data</a></li>
                        <li><a href="#" >Medicines</a>
                           <ul>
                              <li><a href="#medicine" class="login-window">Add New</a></li>
                              <li><a href="#new_inst" class="login-window">Dosage Instruction</a></li>
                           </ul>
                        </li> 
                     <li><a href="newroom.php" class="login-window">Rooms</a></li>                             
                     </ul>
                     </li>

                    <li><a href="#">Staff</a>
                    <ul>
                      <li><a href="#">Staff Master</a>
                       <ul>
                        <li><a href="add_staff.php" class="login-window">Add New</a></li>
                        <li><a href="view_staff.php">View Records</a></li>
                      </ul>
                      </li>
				      <li><a href="#">Attendence</a>
                    <ul>
                        <li><a href="new_attendance.php">Add Attendence</a></li>
                        <li><a href="view_attendence.php">View Attendence</a></li>
                    </ul>
                    </li>
                    <li><a href="#" >Leave Report</a>
                       <ul>
                         <li><a href="leave_report.php" class="login-window">Add New</a></li>
                         <li><a href="view_leaverecord" class="login-window">View Leave Record</a></li>
                       </ul>
                    </li>
                    
                    <li><a href="#"> Salary</a>
                   <ul>
                       <li><a href="#new_salary" class="login-window">Add Salary</a></li>
                       <li><a href="#view_salary" class="login-window">View Salary</a></li>
                    </ul>
                    </li>
                    </ul>
                    </li>
                    
                     <li><a href="#">Reports</a>
                    <ul>
					  <li><a href="coverpage.php">IPD Coverpage</a></li>
   				      <li><a href="opd_coverpage.php">OPD Coverpage</a></li>
                      <li><a href="opd_reports.php">OPD Report</a></li>
                       <li><a href="sreport.php">Admission Report</a></li>
                       <li><a href="monthreport.php">Monthly IPD Report</a></li>
                      </ul>
                      </li>
                    <?php //} ?>
                    <li><a href="#" ></a></li>
                    </ul>
</div>

    <!-- end of menu -->
    </div>
        
        <div id="banner_right">
            <div id="banner_box">
           
           	  <h1>Welcome to Health Clinic </h1><br />
<a href="accounts.php" target="_new" >Accounts</a>
<br /><a href="esibill.php">ESI Bills</a>
               
              <div class="button"><a href="logout.php">Log Out</a></div> 

           
            </div>
		</div>
            
    </div> <!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->

<div id="content">


    
</div> <!-- end of content --><!-- end of footer wrapper -->

<!--New Patient -->

<!--end of New Patient -->

<!--view patient records-->

<div id="view_patient" class="login-popup">
<div id="view_patient1">
<?php 

//$id=$_GET['patient_id'];
$result = mysqli_query("select * from patient");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient's Records</p>
          
         <table  border="1">
    <tr>
    <td><input type="text" style="width:70px;" name="idd" id="idd"  onchange="searchById();" /></td>
    <td><input type="text" style="width:90px;" name="fname22" id="fname22"  onchange="searchById();"/></td>
    </tr>
       
         <tr> <td width="73" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="42" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</td>
          <td width="103" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="61" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
          <td width="135" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By </td>
          <td width="51" style="color:#ac0404; font-size:14px; font-weight:bold;">Appoint-ment</td>
          <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
          <td width="51" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="64" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>
          <td width="64" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
          <td width="77" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>
          </table>
         <div id="search"><table border="1" >
            <?php while($row=mysqli_fetch_row($result))
{  ?>

	<tr> <td width="73" ><?php echo $row[2]; ?></td>
          <td width="92" ><?php echo $row[6]; ?> </td>
          <td width="42" ><?php echo $row[26]; ?></td>
          <td width="103" ><?php echo $row[23]; ?> </td>
          <td width="61" ><?php echo $row[18]; ?> </td>
          <td width="90"><?php echo $row[20]; ?></td>
          <?php 

$result1 = mysqli_query("select * from doctor where doc_id='$row[9]'");
//$result1 = mysqli_query("select doc_id,name from new_doc ");
$row1=mysqli_fetch_row($result1)
?>
          <td width="135" ><?php echo $row1[1]; ?> </td>
          <td width="67" ><input name="code1[]" id="code1[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[2]; ?>'" /></td>
          <td width="46" ><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='opd.php?id=<?php echo $row[2]; ?>'" /> </td>
          <td width="81"><input name="code4[]" id="code4[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='admission.php?id=<?php echo $row[2]; ?>'" /></td>
          <td width="64" ><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='surgery.php?id=<?php echo $row[2]; ?>'" /></td>
          <td width="64"><input name="code3[]" id="code3[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='history.php?id=<?php echo $row[2]; ?>'" /></td>
          <td width="77" ><a href='patient_detail.php?id=<?php echo $row[2]; ?>'> Details </a></td></tr>
<?php } ?>
</table>



<div id="pageNavPosition"></div></div>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">
        var pager = new Pager('results',5); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script>
</div>
</div>
<!--end of view patient records-->

<script type="text/javascript">
function confirm_delete3(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_app.php?id="+id;
	}
}

</script>
<!--view Appointment records-->

<div id="viewapp" class="login-popup">

       </div>
<!--end of view appointment records-->


<!--telephone directory-->

<!--end of telephone directory-->

<!--view Telephone Directory-->

<!--end of view telephone directory-->

<!--New Doctor-->
<!--End of New Doctor-->

<script type="text/javascript">
function confirm_delete4(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_doc.php?id="+id;
	}
	
}
</script>

<!--view doctor-->

<div id="view_doc" class="login-popup">
<div id="view_doc1">
<?php 

$result = mysqli_query("select * from doctor");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Doctor's Records</p>
        
          <table border="1" style="border:2px #ac0404 solid;">
          
          <tr>
          <td><input type="text" style="width:50px;" name="did" id="did" onchange="searchdoc1();" /></td>
          <td><input type="text" name="dname" id="dname" onchange="searchdoc1();"/></td>
          <td><input type="text" name="city22" id="city22" onchange="searchdoc1();"/></td>
          
          </tr>
          <tr>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
          <td  style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
          <td width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</td>
          <td width="85" style="color:#ac0404; font-size:14px;font-weight:bold;">Category </td>
          <td width="85" style="color:#ac0404; font-size:14px;font-weight:bold;">Specialist </td>
          <td width="27" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
          <td width="37" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td></tr></table>
           
          <div id="docsearch1"><table border="1">     
          <?php while($row=mysqli_fetch_row($result))
{  ?>

	<tr>
    <td width="54"> <?php echo $row[0]; ?></td>
	<td width="155"> <?php echo $row[1]; ?></td>
    <td width="156"> <?php echo $row[4]; ?></td>
    <td width="80"> <?php echo $row[3]; ?></td>
    <td width="100"> <?php echo $row[6]; ?></td>
    <td width="70"> <?php echo $row[11]; ?></td>
    <td width="70"> <?php echo $row[8]; ?></td>
    <td width="70"> <?php echo $row[9]; ?></td>
   
    <td> <a href='edit_doc.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td width="50">  <a href="javascript:confirm_delete4(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
    
<?php } ?>
</table></div></div>
</div>
<!--end of view doctor-->



<!--Vew Diagnosis -->
<div id="view_diag" class="login-popup">

<?php 


?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        

</div>
<!--end of view diagnosis-->


<!--New Medical Reports -->

<!--end of New Reports -->

<!-- Vew Reports -->
<!--end of view reports-->

<!--New Delivery Details -->

<!--end of Delivery -->

<!-- Vew Delivery -->
<!--end of view delivery-->


<!--New Receipt -->

<div id="receipt" class="login-popup">
<?php
include 'config.php';
$sql="select * from new_patient";
$result=mysqli_query($con,$sql);
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_receipt.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Receipt</p>
                
                <label class="pat_id"><span>Patient ID:</span>
                <select name="pid" id="pid" style="width:235px;">
                <?php while ($row=mysqli_fetch_row($result))
				{ ?>
					<option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
				<?php } ?>
                </select>
                </label>
                
            	<label class="amount">
                <span>Amount:</span>
                <input id="amt" name="amt" type="text" >
                </label>
                
                <label class="Date">
                <span>Date:</span>
                <input id="rdate" name="rdate" type="text" onClick="displayDatePicker('rdate');">
                </label>
                
                <label class="toward">
                <span>Towards:</span>
                <select name="toward" style="width:235px;">
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                </select>
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div><!--end of receipt -->

<!--New Payment -->

<div id="payment" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_receipt.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Payment</p>
                
                <label class="date">
                <span>Date:</span>
                <input id="date" name="date" type="text" value="<?php echo date('d/m/Y');?>" readonly="readonly">
                </label>
                                         
                <label class="paid">
                <span>Paid To:</span>
                <select name="paid" style="width:235px;">
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                </select>
                </label>
                
                <label class="amount">
                <span>Amount:</span>
                <input id="amt" name="amt" type="text" >
                </label>
                
                <label class="narr">
                <span>Narration:</span>
                <textarea rows="2" cols="27" style="resize:none"></textarea>
                </label>
                
                <label class="paymode">
                <span> Payment mode: </span>
                CP<input name="cp" type="radio" value="" style="width:30px;"/>
                BP<input name="cp" type="radio" value="" style="width:30px;"/>
                </label>
                
                <label class="bank">
                <span>Bank name:</span>
                <select name="bank" style="width:235px;">
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                </select>
                </label>
                
                <label class="chq">
                <span>Cheque no.:</span>
                <input id="chq" name="chq" type="text" >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div><!--end of Payment -->


<!--New Staff master -->

<div id="new_staff" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_staffmaster.php"  name="staffform" onsubmit="return staffvalidate(this)">
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Staff Master</p>
                
                <fieldset class="textbox">
                <table>
                
                <tr> 
            	<td><label class="fname"> Full Name: </label></td>
                <td> <input id="fname" name="fname" type="text"> </td>
                <td><label class="gender"> Gender: </label></td>
                <td><font color="#FFFFFF"> Male: </font><input name="gender" id="gender" type="radio"  checked="checked" value="Male" style="width:20px;"/>
                    <font color="#FFFFFF"> Female: </font><input name="gender" id="gender" type="radio" value="Female" style="width:20px;"/>
                </td>
                </tr>
                               
                <tr>
                <td><label class="dob"> Date of Birth: </label></td>
                <td><input id="dob4" name="dob4" type="text"  onclick="displayDatePicker('dob4');"></td>
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text"></td>
                </tr>
                                
                <tr>
                <td><label class="add">Address:</label></td>
                <td><textarea id="add" name="add" cols="26" rows="3" style="resize: none"></textarea></td>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text"></td>
                
                <tr>
                <td><label class="crel">Close Relative: </label></td>
                <td> <input id="crel" name="crel" type="text"> </td>
                <td><label class="rel">Relation: </label></td>
                <td> <input id="rel" name="rel" type="text"> </td>
                </tr>
                
                <tr>
                <td><label class="mem"> Members living in the House: </label></td>
                <td><input id="mem" name="mem" type="text"> </td>
                <td><label class="house" > House: </label></td>
                <td><select name="house" style="width:200px;height:27px;border:1px #ac0404 solid;">
                    <option value="Rented">Rented</option>
                    <option value=""></option>
                    <option value=""></option>
                    </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="kids">Kids Information:</label></td>
                <td><textarea id="kids" name="kids" cols="26" rows="3" style="resize: none"></textarea></td>
                <td><label class="relation">Name and Relation of member:</label></td>
                <td><textarea id="relation" name="relation" cols="26" rows="3" style="resize: none"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="exp_home">Expenses at home:</label></td>
                <td><input id="amt" name="amt" type="text" ></td>
                <td><label class="sal">Salary Expectations:</label></td>
                <td><input id="sal" name="sal" /></td></textarea>
                </tr>
                
                <tr>
                <td><label class="work">Daily Hours:</label></td>
                <td><input id="work" name="work" /></td>
                <td><label class="post">Post:</label></td>
                <td><input id="post" name="post" /></td>
                </tr>
                              
                <tr>
                <td><label class="basic_salary">Basic Salary:</label></td>
                <td><input id="bsal" name="bsal" /></td>
                <td><label class="ot">OT Rate:</label></td>
                <td><input id="ot" name="ot" /></td>
                </tr>
                                               
                <tr><td><button class="submit formbutton" type="submit">Submit</button></td></tr>
                </table>      
                </fieldset>
          </form>
</div><!--end of Staff Master -->

<script type="text/javascript">
<!--
function confirm_deletestaff(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_staff.php?id="+id;
  }
}
</script>
<!--Start of view staff-->
<div id="view_staff" class="login-popup">

<?php 


$result = mysqli_query($con,"select * from staff");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Staff's Records</p>
        
          <table border="1" style="border:2px #ac0404 solid; width:600px;"> 
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name</th>
		  <th width="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</th>
          <th width="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</th>
		  <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Post</th>
		  <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Daily Hours</th>
		  <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Basic Salary</th>
		  <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
		  <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
            <?php while($row=mysqli_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[20]; ?></td>
	<td> <?php echo $row[0]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[1]; ?></td>
    <td> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[4]; ?></td>
	<td> <?php echo $row[15]; ?></td>
	<td> <?php echo $row[14]; ?></td>
	<td> <?php echo $row[16]; ?></td>
	<td> <a href='edit_staff.php?id=<?php echo $row[20]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletestaff(<?php echo $row[20]; ?>);"> Delete </a></td>
	<?php } ?>
    </tr>
    </table>
	
    </div>

<!--End of view staff-->

<!-- New Attendence -->
<div id="new_attendence" class="login-popup">
<?php

$result = mysqli_query($con,"select staff_id,name from staff");
?>
        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_attendence.php" >
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Staff Attendence</p><br />
                
                <fieldset class="textbox">
                
                <label class="name">Date <input type="text" name="atdate" id="atdate" onclick="displayDatePicker('atdate');" /></label>
                
                <table border="1">
                <tr>              
                
                <th><label class="name">Full Name</label></th>
                <th><label class="present">Present</label></th>
                <th><label class="time">Time </label></th>
                <th><label class="ot">OT </label></th>
                </tr>
                
                              
              
                 <?php while ($row=mysqli_fetch_row($result))
				{ ?>
                <tr>
                <td><?php echo $row[1] ?> </td>
               
                <td>
                <select name="present[]" id="present[]"  >
                <option value="Yes">Yes </option>
                <option value="No">No </option>
                </select>
                </td>
               
                <td>
                <select name="hr[]" id="hr[]" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="" selected="selected">Hour</option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min[]" id="min[]" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="" selected="selected">Min</option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td>
              
                <td><input id="ot[]" name="ot[]" type="text" style="width:50px;"/>
                <input name='name[]' id="name[]" type='hidden' value="<?php echo $row[0]; ?>" /></td>
                </tr>
                <?php } ?>
                
                </table> 
                <button class="submit formbutton" type="submit">Submit</button>    
                </fieldset>
          </form>
</div>
<!-- End of new attendence-->

<!-- View Attendence -->
<div id="view_attendence" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_attendence.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Staff Attendence</p><br />
                
                 Select Month: <input type="button" id="db" onclick="displayDatePicker('adate');" value="select" style="width:80px;">
                        <input id="adate" name="adate" type="text"   onfocus="getDate1();" onstyle="width:55px">
                 
                
                   <div id="adate1">          
               
                <table border="1" cellpadding="4" cellspacing="0">                  
                <tr>
                <th width='136'><label class='name'>Full Name</label></th>
                <th width='73'><label class='present'>Present</label></th>
                <th width='81'><label class='time'>Time </label></th>
                <th width='57'><label class='ot'>OT </label></th>
				 <th width='57'><label class='ot'>Edit </label></th>
                </tr>
                <?php 
				$dat=mysqli_query($con,"select * from attend");
				while($datt=mysqli_fetch_row($dat)){
					$nam=mysqli_query($con,"select name from staff where staff_id='$datt[2]'");
					$nam1=mysqli_fetch_row($nam);
				?>
                <tr>
                <td><?php echo $nam1[0]; ?></td>
                <td><?php echo $datt[2]; ?></td>
                <td><?php echo $datt[6]; ?></td>
                <td><?php echo $datt[3]; ?></td>
                <td><a href='edit_attendance.php?id=<?php echo $datt[0] ?>'>Edit</a></td>
                </tr>
                <?php } ?>
               
                </table>  
                </div>    
                </fieldset>
          </form>
</div>
<!-- End of view attendence-->


<!--Leave Report -->
<div id="leave_report" class="login-popup">

<?php 

$result = mysqli_query($con,"select staff_id,name from staff");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="leave_report.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Leave Report</p>

			    <table>
            	<tr>
                <td><label class="Date">From Date:</label></td>
                <td><input id="frmdate" name="frmdate" type="text" onclick="displayDatePicker('frmdate');">
                </td>
                </tr>
                
                <tr>
                <td><label class="Date">To Date:</label></td>
                <td><input id="todate" name="todate" type="text" onclick="displayDatePicker('todate');">
                </td>
                </tr>                
                
                <tr>
                <td><label class="name"> Name: </label></td>
                <td><select name="name" style="width:235px;height:27px;border:1px #ac0404 solid;">
                <?php while($row=mysqli_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td>
                <label id="remarks">Remarks:</label></td>
                <td> <textarea id="remarks" name="remarks" style="resize:none" rows="3" cols="26"></textarea></td>
                </tr>
                
                <tr>
                <td><button class="submit formbutton" type="submit">Submit</button> </td>
                </tr>
                
                </table>
                </fieldset>
                </form></div>
<!--End of Leave Report -->


<script type="text/javascript">
<!--
function confirm_deleteleave(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_leaverecord.php?id="+id;
  }
}
</script><!--Vew Leave Record -->
<div id="view_leaverecord" class="login-popup">

<?php 

$result = mysqli_query($con,"SELECT * FROM  `leave` ");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Leave Record</p><br />
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">From date</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">To Date</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Name </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Remarks </th>
         
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysqli_fetch_row($result))
{  
$result1 = mysqli_query($con,"select * from staff where staff_id='$row[2]'");
$row1=mysqli_fetch_row($result1);

?>

	<tr>
    
    <td width="105"> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
    <td width="105"> <?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
    <td width="105"> <?php echo $row1[1]; ?></td>
    <td width="105"> <?php echo $row[3]; ?></td>
    
    <td> <a href='edit_leave.php?id=<?php echo $row[4]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deleteleave(<?php echo $row[4]; ?>);"> Delete </a></td>
        
    </tr>
<?php } ?>
</table>
</div>
<!--end of view Leave Record-->

<!-- new Salary-->
<div id="new_salary" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_salary.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Salary</p><br />
                
                <table border="1" cellpadding="4" cellspacing="0">               
                <tr><td colspan="10">     
                
                Year: 
                <select name="year" id="year" size="1">
                <option value=" " selected="selected">-Year-</option>
                </select>

                Month: 
                <select name="month" id="month" size="1" onchange="caldays();">
                <option value=" " selected="selected">-Month-</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
                </select>

                Days of Month: 
                <input name="day1" id="day1" style="width:40px;" readonly="readonly">
                </td></tr>
              
                <tr> 
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="name">Full Name</label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="basic">Basic</label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="prs">Present </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="abs">Absent </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="pay">Payable </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="all">Allowance </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ot">OT </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ded">Deduction </label></th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Net </label></th>
                </tr>
<?php  
$result1 = mysqli_query($con,"select * from staff_master ");
while($row1=mysqli_fetch_row($result1)){
$result2 = mysqli_query($con,"SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='No'");
$row2=mysqli_fetch_row($result2);

$result3 = mysqli_query($con,"SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='Yes'");
$row3=mysqli_fetch_row($result3);
?>
                <tr>
                <td><?php echo $row1[1]; ?></td>
                <td><?php echo $row1[17]; ?></td>
                <td><?php echo $row3[0]; ?></td>
                <td><?php echo $row2[0]; ?></td>
                <td><input name="" type="text" style="width:70px;"/></td>
                <td><input name="" type="text" style="width:70px;"/></td>
                <td><input name="" type="text" style="width:70px;"/></td>
                <td><input name="" type="text" style="width:70px;"/></td>
                <td><input name="" type="text" style="width:70px;"/></td>
                </tr>
                <?php } ?>
                <tr>
                <td colspan="10"><button class="submit formbutton" type="submit">Submit</button></td>
                </tr>
                </table>      
                </fieldset>
          </form>
</div>
<!-- End of new salary-->


<!-- View Salary-->
<div id="view_salary" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_salary.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Salary</p><br />
                
                Month: <input id="mn" name="mn" type="text"  style="width:75px">
                Total net:<input id="tn" name="tn" type="text"  style="width:75px">  </br></br>              
                
                <table border="1">               
                <tr>
                <td><label class="name">Full Name</label></td>
                <td><label class="basic">Basic</label></td>
                <td><label class="prs">Present </label></td>
                <td><label class="abs">Absent </label></td>
                <td><label class="pay">Payable </label></td>
                <td><label class="all">Allowance </label></td>
                <td><label class="ot">OT </label></td>
                <td><label class="ded">Deduction </label></td>
                <td><label class="net">Net </label></td>
                <td><label class="Remarks">Remarks</label></td>
                </tr>
                
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                
                <tr>
                <td colspan="10"><button class="submit formbutton" type="submit">Submit</button></td>
                </tr>
                </table>      
                </fieldset>
          </form>
</div>
<!-- End of view salary-->

<script type="text/javascript">
<!--
function confirm_deletead(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_ad.php?id="+id;
  }
}
//-->
</script>


<!--Discharge -->
<!--end of Discharge-->


<!--Discharge Records-->

<!--end of Discharge Records-->

<!--Vew Surgery Details -->
<div id="view_surgery" class="login-popup">
</div></div>
<!--end of view Surgery Details-->

<!--New Finding-->
<!--End of New Finding-->

<!--View Finding-->
<!--End of View Finding-->

<!--New Complaints-->
<div id="new_complaint" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_comp.php" name="compform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Complaints</p><br />
                
            	<label class="name">
                <span>Complaint Name :</span>
                <input id="compname" name="compname" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Complaints-->

<script type="text/javascript">
function confirm_deletecomp(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_complaint.php?id="+id;
  }
}
</script>
<!--View Complaint-->
<?php 
include('config.php');
$result66 = mysqli_query($con,"select * from compla");
?>
<div id="view_complaint" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_find.php" name="viewfindform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Complaints</p><br />
                               
                <table border="1">   
               
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                       
                <?php while($row66=mysqli_fetch_row($result66))
{  
?>
	<tr>
    
    <td width="55">  <?php  echo  $row66[1]; ?></td>
	<td width="110"> <?php echo $row66[0]; ?></td>
    <td> <a href='edit_complaint.php?id=<?php echo $row66[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletecomp(<?php echo $row66[1]; ?>);"> Delete </a></td>
    </tr>
    <?php } ?>
                </table>
               
                       
                </fieldset>
          </form>
</div>
<!--End of View Complaint-->


<!--New Advise-->
<div id="new_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_advise.php" name="adviseform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Advise</p><br />
                
            	<label class="name">
                <span>Advise Name :</span>
                <input id="advisename" name="advisename" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Advise-->
<!--New Medical Store-->
<div id="new_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_medical.php" name="medicalform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Medical Store</p><br />
                
            	<label class="name">
                <span>Medical Store Name :</span>
                <input id="medicalname" name="medicalname" type="text"  >
                </label>
<label class="name">
                <span>Address :</span>
                <input id="medicaladdress" name="medicaladdress" type="text"  >
                </label>
<label class="name">
                <span>Phone :</span>
                <input id="medicalphone" name="medicalphone" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Medical Store-->

<script type="text/javascript">
function confirm_deleteadvise(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_advise.php?id="+id;
  }
}
</script>

<!--View Advise-->
<?php 
include('config.php');
$result67 = mysqli_query($con,"select * from advise");
?>
<div id="view_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_advise.php" name="viewadviseform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Advise</p><br />
                
            	 <table border="1">   
                
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                         
                <?php while($row67=mysqli_fetch_row($result67))
{  
?>
	<tr>
    
    <td width="55">  <?php  echo  $row67[1]; ?></td>
	<td width="110"> <?php echo $row67[0]; ?></td>
    <td> <a href='edit_advise.php?id=<?php echo $row67[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deleteadvise(<?php echo $row67[1]; ?>);"> Delete </a></td>
    </tr>
    <?php } ?>
                </table>
               
                       
                </fieldset>
          </form>
</div>
<!--End of View Advise-->

<!--New OPD Bill Data-->
<div id="opd_bill" class="login-popup">
<?php
include('config.php');
$result=mysqli_query($con,"select *from opdbill");
$row=mysqli_fetch_row($result)
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="update_opdbill.php" name="opdbillform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">OPD Bill Data</p><br />
                              
            	<table>
                <tr>
                <td><label class="consultation">Consultation: </label></td>
                <td><input id="con" name="con" type="text" value="<?php echo $row[0];?>"></td>
                </tr>
                
                <tr>
                <td><label class="follow">Follow Up: </label></td>
                <td><input id="fol" name="fol" type="text" value="<?php echo $row[1];?>"></td>
                </tr>
                
                <tr>
                <td><label class="Xray">Xray: </label></td>
                <td><input id="xray" name="xray" type="text" value="<?php echo $row[2];?>"></td>
                </tr>
                
                <tr>
                <td><label class="dressing">Dressing: </label></td>
                <td><input id="dr" name="dr" type="text" value="<?php echo $row[3];?>"></td>
                </tr>
                
                <tr>
                <td><label class="strapping">Strapping: </label></td>
                <td><input id="str" name="str" type="text" value="<?php echo $row[4];?>"></td>
                </tr>
                
                <tr>
                <td><label class="ecg">ECG: </label></td>
                <td><input id="ecg" name="ecg" type="text" value="<?php echo $row[5];?>"></td>
                </tr>
               
                <tr>
                <td><button class="submit formbutton" type="submit">Submit</button></td>
                </tr>
                </table>
                       
                </fieldset>
          </form>
</div>
<!--End of New opdbill-->

<!--New Medicine-->
<div id="medicine" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_medicine.php" name="medform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Medicine</p><br />
                
            	<label class="med">
                <span>Medicine Name :</span>
                <input id="medname" name="medname" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Medicine-->

<!--New Instructions-->
<div id="new_inst" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_inst.php" name="medform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Dosage Instruction</p><br />
                
            	<label class="inst">
                <span>Dosage Instructions :</span>
                <input id="inst" name="inst" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Instructions-->

<!--New Room-->

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
<?php 
}else
{ 
 header("location: index.html");
}

?>