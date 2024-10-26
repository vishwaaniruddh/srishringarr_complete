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
function addThem(){
var a = document.opdform.diagnosis;

var add = a.value+',';

document.opd.diag.value += add;
return true;
}

function addThem1(){
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
    }
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
    }
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
    }
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
    }
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
    }
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
    }
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
                      <li><a href="view_patient.php" >Patient Records</a></li>
                  
					 <li><a href="#" >Patient</a>

                     <ul>
                     <li><a href="#">Records</a>
                     <ul>
                     <li><a href="#login-box" class="login-window">Add New</a></li>
					 <li><a href="view_patient.php" >View Records</a></li>
                     </ul>
                     </li>
                     
					
                     <li><a href="#receipt" class="login-window">Receipt</a></li>
                     <li><a href="#payment" class="login-window">Payment</a></li>
                     </ul>
                     </li>
                     
                     <li><a href="#">Doctor</a>
                     <ul>
                     <li><a href="#new_doc" class="login-window">Add New </a></li>
					 <li><a href="view_doctor.php" > View</a></li>
                     </ul>
                     </li>
                     
                    

                     <li><a href="view_opd.php" > View OPD </a></li>

                    <li><a href="#">Diagnosis</a>
                    <ul>
                        <li><a href="diag.php">Add New</a></li>
                        <li><a href="view_diag.php" >View List</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Medical Reports</a>
                    <ul>
                       <li><a href="#new_med" class="login-window">Add New</a></li>
                       <li><a href="#view_reports" class="login-window">Existing</a></li>
                    </ul>
                    </li>

                    <li><a href="View_app.php">View Appointments</a></li>
                    
                    <li><a href="#">Admission</a>
                    <ul>
                        <li><a href="#view_ad" class="login-window">View Records</a></li>
                        <li><a href="#" >Discharge</a>
                           <ul>
                              <li><a href="#discharge" class="login-window">Add Record</a></li>
                              <li><a href="#view_discharge" class="login-window">View Records</a></li>
                           </ul>
                        </li>
                    </ul>
                    </li>

                    <li><a href="#">Surgery Details</a>
                    <ul>
                       <li><a href="#view_surgery" class="login-window">View Records</a></li>
      
                    </ul>
                    </li>

                    <li><a href="#">Delivery Details</a>
                    <ul>
                       <li><a href="#delivery" class="login-window">Add Details</a></li>
                       <li><a href="#view_delivery" class="login-window">View Details</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Telephone Directory</a>
                    <ul>
                        <li><a href="#teldir" class="login-window">Add New</a></li>
                        <li><a href="#view_teldir" class="login-window">View Records</a></li>
                    </ul>
                    </li>
                    
                     <li><a href="#">Master</a>
                     <ul>
                     	<li><a href="#">Findings</a>
                     	<ul>
                        <li><a href="#new_finding" class="login-window">Add Findings</a></li>
					 	<li><a href="#view_finding" class="login-window"> View Findings</a></li>
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
                        <li><a href="#new_advise" class="login-window">Add Advise</a></li>
					 	<li><a href="#view_advise" class="login-window"> View Advise</a></li>
                        </ul> 
                        </li> 
                        <li><a href="#opd_bill" class="login-window">OPD Bill Data</a></li>
                        <li><a href="#" >Medicines</a>
                           <ul>
                              <li><a href="#medicine" class="login-window">Add New</a></li>
                              <li><a href="#new_inst" class="login-window">Dosage Instruction</a></li>
                           </ul>
                        </li> 
                                                    
                     </ul>
                     </li>

                    <li><a href="#">Staff</a>
                    <ul>
                      <li><a href="#">Staff Master</a>
                       <ul>
                        <li><a href="#new_staff" class="login-window">Add New</a></li>
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
                         <li><a href="#leave_report" class="login-window">Add New</a></li>
                         <li><a href="#view_leaverecord" class="login-window">View Leave Record</a></li>
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
                    <li><a href="#" ></a></li>
                    </ul>
</div>

    <!-- end of menu -->
    </div>
        
        <div id="banner_right">
            <div id="banner_box">
           
           	  <h1>Welcome to Health Clinic </h1><br /><br />
               
              <div class="button"><a href="logout.php">Log Out</a></div>
           
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
        
          <form method="post" class="signin" action="new_patient.php" onSubmit="return validate(this)" name="form" enctype="multipart/form-data">
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Patient</p>
                
                <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date( "d/m/Y");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                
                <fieldset class="textbox">
                <table>
                
                <tr> 
            	<td><label class="fname"> Full Name: </label></td>
                <td><input id="fname" name="fname" type="text"> </td>
                
                <td><label class="age"> Date of Birth: </label></td>
                <td><input id="dob" name="dob" type="text" onClick="displayDatePicker('dob');"></td>
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
                <td><label class="gender"> Gender: </label></td>
                <td><font color="#FFFFFF"> Male: </font><input name="gen" id="gen" type="radio"  checked="checked" value="M" style="width:20px;"/>
                    <font color="#FFFFFF"> Female: </font><input name="gen" id="gen" type="radio" value="F" style="width:20px;"/>
                </td>
                
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text" ></td>
                </tr>
                                
                <tr>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text"></td>
                
                <td><label class="bg">Blood Group:</label></td>
                <td>
                <select name="bg" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="Dont Know">Dont Know</option>
                </select>
                </td>
                </tr>
                             
                <tr>
                <td><label class="add">Address:</label></td>
                <td><textarea name="add" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                
                <td><label class="city">City :</label></td>
                <td>
                <select name="city" id="city">
                <?php $city=mysql_query("select * from city");
				while($city1=mysql_fetch_row($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select></td>
                </tr>
                
                <tr>
                <td><label class="height"> Height:</label></td>
                <td><input id="height" name="height" type="text"></td>
                
                <td><label class="timegiven"> Time Given:</label></td>
                <td>
                <span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td>
                </tr>
               
<?php 

$result = mysql_query("select doc_id,name from doctor ");
$result1 = mysql_query("select doc_id,name from doctor ");
?>
            
                <tr>
                <td><label class="doc"><span>Doctor:</span></label></td>
                <td><select name="doc" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <?php while($row1=mysql_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                
                <td><label class="ref"><span>Doctor Reference:</span></label></td>
                <td><select name="ref" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                <option value="No Reference">No Reference</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="ms"> Marital Status:</label></td>
                <td><select name="ms" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                </select>
                </td>
                
                <td colspan="2"> 
                Consultation: <input type="radio"  name="follow" style=" width:40px;" value="Consultation"/> 
                Follow Up: <input type="radio"  name="follow" style=" width:40px;" value="Follow"/></td>
                </tr>

 <tr>
                <td><label class="ms"> Hospital Name:</label></td>
                <td>
                <select name="hos" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                 <option value="0">Select Hospital</option>
                <?php $hos=mysql_query("select * from hospital");
				while($hos1=mysql_fetch_row($hos)){?>
               
                <option value="<?php echo $hos1[7]; ?>"><?php echo $hos1[0]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td > 
                Email Id:</td><td> <input type="text"  name="email"  /> 
                </td>
                </tr>
                
                <tr>
                <td><button class="submit formbutton" type="submit" name="Submit">Submit</button> </td>
                </tr>   
                    
                </table>
                </fieldset>
          </form>
</div><!--end of New Patient -->

<!--view patient records-->

<div id="view_patient" class="login-popup">
<div id="view_patient1">
<?php 

//$id=$_GET['patient_id'];
$result = mysql_query("select * from patient");

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
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr> <td width="73" ><?php echo $row[2]; ?></td>
          <td width="92" ><?php echo $row[6]; ?> </td>
          <td width="42" ><?php echo $row[26]; ?></td>
          <td width="103" ><?php echo $row[23]; ?> </td>
          <td width="61" ><?php echo $row[18]; ?> </td>
          <td width="90"><?php echo $row[20]; ?></td>
          <?php 

$result1 = mysql_query("select * from doctor where doc_id='$row[9]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1)
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
                <textarea name="add" cols="26" rows="3" style="resize:none;border:1px #ac0404 solid;"></textarea>
                </label>
                 
                <label class="city">
                <span>City.:</span>
               <select name="city" id="city">
                <?php $city=mysql_query("select * from city");
				while($city1=mysql_fetch_row($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select>
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
                <select name="info" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:235px;">
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
                </select>
                </label>
          
                <button class="submit formbutton" type="submit">Submit</button>
                                       
                </fieldset>
          </form>
</div>
<!--end of telephone directory-->

<script type="text/javascript">
function confirm_delete2(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_teldir.php?id="+id;
	}
}

</script>
<!--view Telephone Directory-->

<div id="view_teldir" class="login-popup">
<div id="view_teldir1">
<?php 


$result = mysql_query("select * from address");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Telephone Directory</p><br />
        
          <table border="1" style="border:2px #ac0404 solid;"> 
          
          <tr>
          <td><input type="text" style="width:70px;" name="tname" id="tname"  onchange="searchtel();" /></td>
          <td><input type="text" style="width:90px;" name="tcon" id="tcon"  onchange="searchtel();"/></td>
          </tr>
          <tr>
          <td width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
          <td width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Pincode</td>
          <td width="130" style="color:#ac0404; font-size:14px;font-weight:bold;">Information For</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td></tr></table>
           
           <div id="telsearch"><table border="1" >       
           <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[2]; ?></td>
	<td width="110"> <?php echo $row[4]; ?></td>
    <td width="105"> <?php echo $row[9]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[14]; ?></td>
    <td> <a href='edit_teldir.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete2(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
<?php } ?>
</table></div>
</div>

<!--
Search By: 

<select name="search" id="search" onchange="document.getElementById('searchtxt').value=''">
      <option value="contact">Contact No.</option>
      <option value="pincode">Pincode</option>
</select>
           
           <input type="text" onkeyup="ajax_showOptions(this,document.getElementById('search').value,event);" id="searchtxt" name="searchtxt"/>
           <input name="submit" type="submit" value="SEARCH" id="submit" onclick="MakeRequest();" style="width:90px; height:25px; background-color:#ac0404; border:1px #ac0404 solid; color:#FFF; cursor:pointer;"/>
--></div>
<!--end of view telephone directory-->

<!--New Doctor-->
<div id="new_doc" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
         <form method="post" class="signin" action="new_doc.php" name="docform" onSubmit="return docvalidate(this)">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Doctor</p><br />
                <table width="353"><tr><td width="106">
            	<label class="name">
                <span>Name:</span></label></td><td width="235">
                <input id="name" name="name" type="text"  >
               </td></tr>
               <tr><td>
                
                <label class="add">
                <span>Address:</span></label></td><td>
                <textarea name="add" cols="26" rows="3" style="resize:none;border:1px #ac0404 solid;"></textarea>
             </td></tr>
              <tr><td>
                
                <label class="city">
                <span>Country:</span></label></td><td>
                <select name="country" id="country"> 
<option value="" selected="selected">Select Country</option> 
<option value="United States">United States</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="Afghanistan">Afghanistan</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="American Samoa">American Samoa</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Anguilla">Anguilla</option> 
<option value="Antarctica">Antarctica</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option> 
<option value="Aruba">Aruba</option> 
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option> 
<option value="Azerbaijan">Azerbaijan</option> 
<option value="Bahamas">Bahamas</option> 
<option value="Bahrain">Bahrain</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bermuda">Bermuda</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Bouvet Island">Bouvet Island</option> 
<option value="Brazil">Brazil</option> 
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burundi">Burundi</option> 
<option value="Cambodia">Cambodia</option> 
<option value="Cameroon">Cameroon</option> 
<option value="Canada">Canada</option> 
<option value="Cape Verde">Cape Verde</option> 
<option value="Cayman Islands">Cayman Islands</option> 
<option value="Central African Republic">Central African Republic</option> 
<option value="Chad">Chad</option> 
<option value="Chile">Chile</option> 
<option value="China">China</option> 
<option value="Christmas Island">Christmas Island</option> 
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
<option value="Colombia">Colombia</option> 
<option value="Comoros">Comoros</option> 
<option value="Congo">Congo</option> 
<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
<option value="Cook Islands">Cook Islands</option> 
<option value="Costa Rica">Costa Rica</option> 
<option value="Cote D'ivoire">Cote D'ivoire</option> 
<option value="Croatia">Croatia</option> 
<option value="Cuba">Cuba</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="Ecuador">Ecuador</option> 
<option value="Egypt">Egypt</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
<option value="Faroe Islands">Faroe Islands</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option> 
<option value="French Guiana">French Guiana</option> 
<option value="French Polynesia">French Polynesia</option> 
<option value="French Southern Territories">French Southern Territories</option> 
<option value="Gabon">Gabon</option> 
<option value="Gambia">Gambia</option> 
<option value="Georgia">Georgia</option> 
<option value="Germany">Germany</option> 
<option value="Ghana">Ghana</option> 
<option value="Gibraltar">Gibraltar</option> 
<option value="Greece">Greece</option> 
<option value="Greenland">Greenland</option> 
<option value="Grenada">Grenada</option> 
<option value="Guadeloupe">Guadeloupe</option> 
<option value="Guam">Guam</option> 
<option value="Guatemala">Guatemala</option> 
<option value="Guinea">Guinea</option> 
<option value="Guinea-bissau">Guinea-bissau</option> 
<option value="Guyana">Guyana</option> 
<option value="Haiti">Haiti</option> 
<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
<option value="Honduras">Honduras</option> 
<option value="Hong Kong">Hong Kong</option> 
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
<option value="Iraq">Iraq</option> 
<option value="Ireland">Ireland</option> 
<option value="Israel">Israel</option> 
<option value="Italy">Italy</option> 
<option value="Jamaica">Jamaica</option> 
<option value="Japan">Japan</option> 
<option value="Jordan">Jordan</option> 
<option value="Kazakhstan">Kazakhstan</option> 
<option value="Kenya">Kenya</option> 
<option value="Kiribati">Kiribati</option> 
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of">Korea, Republic of</option> 
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macao">Macao</option> 
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar">Madagascar</option> 
<option value="Malawi">Malawi</option> 
<option value="Malaysia">Malaysia</option> 
<option value="Maldives">Maldives</option> 
<option value="Mali">Mali</option> 
<option value="Malta">Malta</option> 
<option value="Marshall Islands">Marshall Islands</option> 
<option value="Martinique">Martinique</option> 
<option value="Mauritania">Mauritania</option> 
<option value="Mauritius">Mauritius</option> 
<option value="Mayotte">Mayotte</option> 
<option value="Mexico">Mexico</option> 
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
<option value="Moldova, Republic of">Moldova, Republic of</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montserrat">Montserrat</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
<option value="Myanmar">Myanmar</option> 
<option value="Namibia">Namibia</option> 
<option value="Nauru">Nauru</option> 
<option value="Nepal">Nepal</option> 
<option value="Netherlands">Netherlands</option> 
<option value="Netherlands Antilles">Netherlands Antilles</option> 
<option value="New Caledonia">New Caledonia</option> 
<option value="New Zealand">New Zealand</option> 
<option value="Nicaragua">Nicaragua</option> 
<option value="Niger">Niger</option> 
<option value="Nigeria">Nigeria</option> 
<option value="Niue">Niue</option> 
<option value="Norfolk Island">Norfolk Island</option> 
<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option> 
<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option> 
<option value="Pitcairn">Pitcairn</option> 
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option> 
<option value="Puerto Rico">Puerto Rico</option> 
<option value="Qatar">Qatar</option> 
<option value="Reunion">Reunion</option> 
<option value="Romania">Romania</option> 
<option value="Russian Federation">Russian Federation</option> 
<option value="Rwanda">Rwanda</option> 
<option value="Saint Helena">Saint Helena</option> 
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option> 
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Sweden">Sweden</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
<option value="Thailand">Thailand</option> 
<option value="Timor-leste">Timor-leste</option> 
<option value="Togo">Togo</option> 
<option value="Tokelau">Tokelau</option> 
<option value="Tonga">Tonga</option> 
<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
<option value="Tunisia">Tunisia</option> 
<option value="Turkey">Turkey</option> 
<option value="Turkmenistan">Turkmenistan</option> 
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
<option value="Tuvalu">Tuvalu</option> 
<option value="Uganda">Uganda</option> 
<option value="Ukraine">Ukraine</option> 
<option value="United Arab Emirates">United Arab Emirates</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="United States">United States</option> 
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Viet Nam">Viet Nam</option> 
<option value="Virgin Islands, British">Virgin Islands, British</option> 
<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
<option value="Wallis and Futuna">Wallis and Futuna</option> 
<option value="Western Sahara">Western Sahara</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option>
</select>
                </td></tr>
             <tr><td>
                
                <label class="city">
                <span>City:</span></label></td><td>
               <select name="city" id="city">
                <?php $city=mysql_query("select * from city");
				while($city1=mysql_fetch_row($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select>
                </td></tr>
                <tr><td>
                                 
                <label class="cn">
                <span>Telephone No.:</span></label></td><td>
                <input id="cn" name="cn" type="text">
              </td></tr>
              <tr><td>
                                 
                <label class="cn">
                <span>Mobile No.:</span></label></td><td>
                <input id="mobile" name="mobile" type="text">
              </td></tr>
              <tr><td>
                 
                <label class="gender">
                <span><b> Gender: </b></span></label></td>
                <td>
                <font color="#FFFFFF"> Male: </font><input name="gen" id="gen" type="radio"  checked="checked" value="Male" style="width:20px;"/>
                <font color="#FFFFFF"> Female: </font><input name="gen" id="gen" type="radio" value="Female" style="width:20px;"/>
                
                </td></tr>
                <tr><td>
                
                <label class="Email">
              <span> Email:</span></label></td><td>
                <input id="email" name="email" type="text">
               </td></tr>
               <tr><td>           
                                
                <label class="category">
                <span>Category:</span></label></td><td>
                <select name="cat" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;alignment-adjust:central;">
                <?php $cat=mysql_query("select * from category");
                while($cat1=mysql_fetch_row($cat)){ ?>
                            
                <option value="<?php echo $cat1[0]; ?>"><?php echo $cat1[0]; ?></option>
                <?php } ?>
                </select>
             </td></tr>
             <tr><td>
                
                <label class="spl">
                <span>Specialist In:</span></label></td><td>
               
                <select name="spl" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;alignment-adjust:central;" onChange="addThem1()">
                <?php $sp=mysql_query("select * from special");
                while($sp1=mysql_fetch_row($sp)){ ?>
                            
                <option value="<?php echo $sp1[0]; ?>"><?php echo $sp1[0]; ?></option>
                <?php } ?>
                </select>
                </td></tr>
                <tr><td>
                
                <label class="add">
                <span>Remarks:</span></label></td><td>
                <textarea name="rem" cols="26" rows="3" style="resize:none;border:1px #ac0404 solid;"></textarea>
             </td></tr>
                <tr><td colspan="2">
                
                <button class="submit formbutton" type="submit">Submit</button>
                      </td></tr></table> 
                </fieldset>
          </form>
</div>
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

$result = mysql_query("select * from doctor");
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
          <?php while($row=mysql_fetch_row($result))
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

<div id="new_med" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_med.php" name="medform" onSubmit="return medvalidate(this)">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Medical Reports</p>
                
            	<label class="name">
                <span>Name:</span>
                <input id="name" name="name" type="text" >
                </label>
                
                <label class="Desc">
                <span>Description:</span>
                <textarea name="desc" cols="26" rows="3" style="resize:none;"></textarea>
                </label>
                
                <label class="cost">
                <span>Cost:</span>
                <input id="cost" name="cost" type="text" >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div><!--end of New Reports -->

<script type="text/javascript">
<!--
function confirm_delete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_reports.php?id="+id;
  }
}
//-->
</script>
<!-- Vew Reports -->
<div id="view_reports" class="login-popup">

<?php 

include('config.php');

$result = mysql_query("select * from med_reports");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center"> Medical Reports</p>
        
          <table border="1" style="border:2px #ac0404 solid;">
                   
          <th width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Description</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Cost </th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[1]; ?></td>
	<td width="150"> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <a href='edit_reports.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
<?php } ?>
</table>
</div>
<!--end of view reports-->

<!--New Delivery Details -->

<div id="delivery" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_delivery.php" >
          
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Delivery Details</p>
                
                <table>
                <tr>
                <td>
            	<label class="datead">Date of Admission:</label></td>
                <td><input id="datead" name="datead" type="text" onClick="displayDatePicker('datead');"></td>
                
                <td>
                <label class="timead"><span>Time of Admission:</span></label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                Mins:<select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                </td>
                </tr>
                
                <tr>
                <td><label class="disdate"><span>Date of Discharge:</span></label></td>
                <td> <input id="disdate" name="disdate" type="text" onClick="displayDatePicker('disdate');"></td>
                
                <td><label class="timedis"><span>Time of Discharge:</span></label></td>
                <td>
                Hour: 
                <select name="hour2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                Mins:<select name="min2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td>
                </tr>
                
                <tr><td colspan="6">  
                
                <table width="700" border="0" cellspacing="0" cellpadding="0"  id="child" style="border:2px #ac0404 solid;">
                 <tr>
                 <td colspan="6"><font color="#ac0404" size="2"><b> Details of Child Birth : </b></font></td>
                 </tr>
  
                 <tr>
                 <td>Date:</td>
                 <td><input id="date1" name="date1" type="text" onClick="displayDatePicker('date1');"  style="width:100px;"></td>
                 <td>Time:</td>
                 <td colspan="3">
                 Hour:<select name="hour3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 </select>
   
                 Mins: <select name="min3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="05">05</option>
                 <option value="10">10</option>
                 <option value="15">15</option>
                 <option value="20">20</option>
                 </select>
                 </td>
                 </tr>
    
                 <tr>
                 <td>Weight:</td>
                 <td><input id="weight" name="weight" type="text" style="width:100px;" ></td>
                 <td>Sex:</td>
                 <td><select name="gender">
                 <option value="male">Male</option>
                 <option value="female">Female</option>
                 </select></td>
       
                 <td>Blood Group:</td>
                 <td><select name="bg" style="background:#fff; width:100px;">
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Dont Know</option></select></td>
                 </tr>
    	         </table></td></tr>

                 <tr>
                 <td><label class="typedel">Type of Delivery:</label></td>
                 <td><input id="typedel" name="typedel" type="text" ></td>
                
                 <td><label class="apgar">Apgar Score:</label></td>
                 <td><input id="apgar" name="apgar" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td><label class="indi"> Indication:</label></td>
                 <td><textarea name="indi" id="indication" cols="30" rows="2" style="resize:none"></textarea></td>
                
                 <td> <label class="pmcreg">PMC Registration no. :</label></td>
                 <td><input id="pmc" name="pmc" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td><label class="husband">Husband's Name:</label></td>
                 <td><input id="hname" name="hname" type="text" ></td>
                 <td><label class="education">Education:</label></td>
                 <td><input id="edu" name="edu" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td colspan="4">Birth Notification sent to Municipal Authorities ? 
                 <select name="notification">
                 <option value="Y">Yes</option>
                 <option value="N">No</option>
                 </select></td>
                 </tr>
                
                 <tr>
                 <td><label class="Motherrel"> Mother's Religion:</label></td>
                 <td><input id="mrel" name="mrel" type="text" ></td>
                 <td><label class="education"> Education:</label></td>
                 <td><input id="medu" name="medu" type="text" ></td>
                 </tr>
                
                <tr>               
                <td>Blood Group:</td>
                <td><select name="bg2" style="background:#fff; width:100px;">
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Dont Know</option></select></td>
                </tr>
        
                <tr><td><button class="submit formbutton" type="submit">Submit</button></td></tr>
                
                </table>      
                </fieldset>
          </form>
</div><!--end of Delivery -->

<script type="text/javascript">
<!--
function confirm_deldelete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_delivery.php?id="+id;
  }
}
//-->
</script>
<!-- Vew Delivery -->
<div id="view_delivery" class="login-popup">

<?php 

include('config.php');

$result = mysql_query("select * from delivery");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center"> Delivery Details</p> <br />
        
          <table border="1" style="border:2px #ac0404 solid;">
               
          <th width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Ad_date</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Dis_date</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;"> Ad_time</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Dis_time </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">BirthDate </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Birth_time </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Weight </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">BloodGroup </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Type </th>
          
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysql_fetch_row($result))
{  
?>
	<tr>
    
    <td> <?php echo $row[1]; ?></td>
	<td width="150"> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[7]; ?></td>
    <td> <?php echo $row[8]; ?></td>
    <td> <?php echo $row[9]; ?></td>
    <td> <?php echo $row[10]; ?></td>
    <td> <a href='edit_delivery.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deldelete(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
<?php } ?>
</table>
</div>
<!--end of view delivery-->


<!--New Receipt -->

<div id="receipt" class="login-popup">
<?php
include('config.php');
$sql="select * from new_patient";
$result=mysql_query($sql);
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_receipt.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Receipt</p>
                
                <label class="pat_id"><span>Patient ID:</span>
                <select name="pid" id="pid" style="width:235px;">
                <?php while ($row=mysql_fetch_row($result))
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


$result = mysql_query("select * from staff");

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
            <?php while($row=mysql_fetch_row($result))
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

$result = mysql_query("select staff_id,name from staff");
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
                
                              
              
                 <?php while ($row=mysql_fetch_row($result))
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
				$dat=mysql_query("select * from attend");
				while($datt=mysql_fetch_row($dat)){
					$nam=mysql_query("select name from staff where staff_id='$datt[2]'");
					$nam1=mysql_fetch_row($nam);
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

$result = mysql_query("select staff_id,name from staff");
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
                <?php while($row=mysql_fetch_row($result))
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

$result = mysql_query("SELECT * FROM  `leave` ");
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
                   
            <?php while($row=mysql_fetch_row($result))
{  
$result1 = mysql_query("select * from staff where staff_id='$row[2]'");
$row1=mysql_fetch_row($result1);

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
$result1 = mysql_query("select * from staff_master ");
while($row1=mysql_fetch_row($result1)){
$result2 = mysql_query("SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='No'");
$row2=mysql_fetch_row($result2);

$result3 = mysql_query("SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='Yes'");
$row3=mysql_fetch_row($result3);
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

<!--Vew Admission -->
<div id="view_ad" class="login-popup">

<?php 


$result = mysql_query("select * from admission");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Admisssion</p><br />
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Doctor</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Discharge Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Days </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Room no. </th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysql_fetch_row($result))
{  
$result1 = mysql_query("select * from patient where no='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2 = mysql_query("select * from doctor where doc_id='$row[2]'");
$row2=mysql_fetch_row($result2);
?>

	<tr>
    
    <td width="110"> <?php echo $row1[6]; ?></td>
	<td width="110"> <?php echo $row2[1]; ?></td>
    <td width="105"> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td width="105"> <?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td width="105"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php echo $row[8]; ?></td>
    <td> <a href='edit_ad.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletead(<?php echo $row[0]; ?>);"> Delete </a></td>
        
    </tr>
<?php } ?>
</table>
</div>
<!--end of view Admission-->


<!--Discharge -->
<div id="discharge" class="login-popup">

<?php 
include('config.php');
$result = mysql_query("select * from admission");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge</p><br />
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Doctor</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Discharge Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Days </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Room no. </th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Discharghe</th>
        
                   
            <?php while($row=mysql_fetch_row($result))
{  
$result1 = mysql_query("select * from patient where no='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2 = mysql_query("select * from doctor where doc_id='$row[2]'");
$row2=mysql_fetch_row($result2);
?>

	<tr>
    
    <td width="110"> <?php echo $row1[6]; ?></td>
	<td width="110"> <?php echo $row2[1]; ?></td>
    <td width="105"> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td width="105"> <?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td width="105"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php echo $row[8]; ?></td>
    <td> <a href='discharge_summary.php?id=<?php echo $row[0]; ?>'> Discharge </a></td>
    
        
    </tr>
<?php } ?>
</table>
</div>
<!--end of Discharge-->


<!--Discharge Records-->
<script type="text/javascript">
<!--
function confirm_deletedis(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_discharge.php?id="+id;
  }
}
//-->
</script>

<div id="view_discharge" class="login-popup">

<?php 
include('config.php');
$result = mysql_query("select * from discharge_summary");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Discharge</p><br />
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Discharge Date</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Investigations</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Final Diagnosis </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Operation </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Procedure </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Treatment </th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
        
                   
            <?php while($row=mysql_fetch_row($result))
{  
$result1 = mysql_query("select * from new_patient where patient_id='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2 = mysql_query("select * from admission where ad_id='$row[2]'");
$row2=mysql_fetch_row($result2);

?>

	<tr>
    
    <td width="110"> <?php echo $row1[1]; ?></td>
    <td width="110"> <?php if(isset($row2[3]) and $row2[3]!='0000-00-00') echo date('d/m/Y',strtotime($row2[3])); ?></td>
	<td width="110"> <?php echo $row[4]; ?></td>
    <td width="110"> <?php echo $row[5]; ?></td>
    <td width="110"> <?php echo $row[6]; ?></td>
    <td width="105"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php echo $row[14]; ?></td>
    <td> <a href='edit_discharge.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletedis(<?php echo $row[0]; ?>);"> Delete </a></td>
    
        
    </tr>
<?php } ?>
</table>
</div>
<!--end of Discharge Records-->

<!--Vew Surgery Details -->
<div id="view_surgery" class="login-popup">

<?php 
include('config.php');
$result = mysql_query("select * from surgery");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Surgery Details</p><br />
        <p style="color:#ac0404; font-weight:bold; font-size:12px;">Search Surgery:</p>
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          <tr>
          <td colspan="2">By Type:<input type="text" style="width:100px;" name="type" id="type" onchange="searchsur();" /></td>
          <td colspan="2">By Surgery:<input type="text" style="width:110px;" name="head" id="head" onchange="searchsur();"/></td>
          
          <tr>
          <td width="55" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
          <td width="55" style="color:#ac0404; font-size:14px; font-weight:bold;">Anaesthetist</td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Type </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery Head </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgeon 1 </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgeon 2 </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Fees</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td></tr></table>
            
            <div id="sursearch"><table border="1">       
            <?php while($row=mysql_fetch_row($result))
{  
$result1=mysql_query("select doc_id,name from new_doc where doc_id='$row[3]' and specialist='Anaesthetist'");
$row1=mysql_fetch_row($result1);?>
	<tr>
    
    <td width="55">  <?php  echo  $row[1]; ?></td>
	<td width="110"> <?php echo $row1[1]; ?></td>
    <td width="105"> <?php echo $row[4]; ?></td>
    <td width="105"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php echo $row[8]; ?></td>
    <td width="105"> <?php echo $row[9]; ?></td>
    <td width="105"> <?php echo $row[30]; ?></td>
    <td> <a href='edit_surgery.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletead(<?php echo $row[0]; ?>);"> Delete </a></td>
        
    </tr>
<?php } ?>
</table>
</div></div>
<!--end of view Surgery Details-->

<!--New Finding-->
<div id="new_finding" class="login-popup">


        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_find.php" name="findform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Findings</p><br />
                              
            	<label class="name">
                <span>Finding Name:</span>
                <input id="findname" name="findname" type="text"  >
                </label>
                
                <button class="submit formbutton" type="submit">Submit</button>
                       
                </fieldset>
          </form>
</div>
<!--End of New Finding-->

<script type="text/javascript">
function confirm_deletefind(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_finding.php?id="+id;
  }
}
</script>
<!--View Finding-->
<?php 
include('config.php');
$result6 = mysql_query("select * from findings");
?>
<div id="view_finding" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_find.php" name="viewfindform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Findings</p><br />
                
            	                
                <table border="1">   
               
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                           
                <?php while($row6=mysql_fetch_row($result6))
{  
?>
	<tr>
    
    <td width="55">  <?php  echo  $row6[1]; ?></td>
	<td width="110"> <?php echo $row6[0]; ?></td>
    <td> <a href='edit_finding.php?id=<?php echo $row6[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletefind(<?php echo $row6[1]; ?>);"> Delete </a></td>
    </tr>
    <?php } ?>
                </table>
               
                       
                </fieldset>
          </form>
</div>
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
$result66 = mysql_query("select * from complaints");
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
                       
                <?php while($row66=mysql_fetch_row($result66))
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
$result67 = mysql_query("select * from advise");
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
                         
                <?php while($row67=mysql_fetch_row($result67))
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
$result=mysql_query("select *from opdbill");
$row=mysql_fetch_row($result)
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