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
width: 200px; /*Sub Menu Items width */
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
</script>
<script type="text/javascript">
function searchval(what,val)
{
if(document.getElementById(what).value=='' ||document.getElementById(val).value=='' )
{
alert("Please provide both the data for searching");
}
else
{
document.getElementById('searcheddata').innerHTML="<img src=loader.gif height=20px width=20px>";
var what=document.getElementById(what).value;
var txt=document.getElementById(val).value;
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
		//alert(xmlhttp.responseText);
    document.getElementById('searcheddata').innerHTML=xmlhttp.responseText;
    }
  }
   
 //alert("garmentgallery.php?cid="+id);
// alert("getcustdetail.php?id="+value+"&attr="+attr);

xmlhttp.open("get","searchengine.php?val="+txt+"&what="+what,false);


//alert("opd_his.php?id="+id+"&Page="+page);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
}
</script>
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
	color:#000; 
	font-size:13px; 
	line-height:18px;
} 

form.signin input,textarea{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:12px Arial, Helvetica, sans-serif;
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

form.signin td{ font-size:12px; height:40px;}
td,th{padding-left:3px; padding-right:13px;}
</style>

</head>
<body>

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
                     
                      <li><a href="#" >Patient</a>
                     <ul>
                     <li><a href="newpatient.php">Add New</a></li>
		  <li><a href="view_patient1.php">View Records</a></li>
                      
                  <!--   <li><a href="#receipt" class="login-window">Receipt</a></li>
                     <li><a href="#payment" class="login-window">Payment</a></li>-->
                     </ul>
                     </li>
                    
                     <li><a href="#">Appointments</a>
                     <ul>
                     <li><a href="View_app.php">OPD Appointments</a></li>
                     <li><a href="Wait_surgery.php">Surgery Appointments</a></li>
                      <li><a href="opd_reports.php">Mail OPD Appointments</a></li>
					   <li><a href="surgery_mail.php">Mail Surgery Appointments</a></li>
                     <li><a href="#">Slot</a>
                      <ul>
                      <li><a href="new_slot.php">Create New </a></li>
                      <li><a href="view_slot.php">View Slot</a></li>
                      </ul>
                     </li>
                     </ul>
                     </li>
                     
                       
                      <li><a href="#" >Waiting List</a>
                      <ul>
                      <li><a href="view_patient.php">OPD Waiting</a></li>
                      <li><a href="view_surgWait.php">Surgery Waiting</a></li>
                      </ul>
                      </li>
                      <li><a href="#"> OPD </a>
                      <ul>
                      <li><a href="view_opd.php">View OPD </a></li>
                      <li><a href="opdcollection.php">OPD Collection</a></li>
                      </ul>
                      </li>
                      
              

                    <li><a href="#">Diagnosis</a>
                    <ul>
                        <li><a href="diag.php">Add New</a></li>
                        <li><a href="view_diag.php">View List</a></li>
                    </ul>
                    </li>

                    <li><a href="#">Medical Reports</a>
                    <ul>
                       <li><a href="medreports.php">Add New</a></li>
                      
                    </ul>
                    </li>
     
                    
                    <li><a href="#">IPD</a>
                    <ul>
                        <li><a href="viewipd.php" >View Records</a></li>
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
                       <li><a href="view_surgry.php">View Records</a></li>
                    </ul>
                    </li>

                 <!--   <li><a href="#">Delivery Details</a>
                    <ul>
                       <li><a href="delivery.php">Add Details</a></li>
                       <li><a href="viewdelivery.php">View Details</a></li>
                    </ul>
                    </li>-->


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
					 <li><a href="view_doctor.php"> View</a></li>
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
                       <li><a href="#">OT Register</a></li>
                       <li><a href="hos_summary.php">Hospital wise Summary</a></li>
                       <li><a href="#">Operation Head wise Summary</a></li>
                       <li><a href="#">Address wise List of Patients</a></li>
                       <li><a href="#">Hospital wise List of Patients</a></li>
                       <li><a href="#">Check List for IPD Patients</a></li>
                       <li><a href="#"> O.T. Waiting List</a></li>
                    </ul>
                    </li>
                   
                    <li><a href="http://sarmicrosystems.in/accounts/" target="_new">Accounts</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
</div>
<div id="search">
<fieldset><legend></legend>
<select name="what" id="what">
<option value="patient">Patient</option>
<option value="doctor">Doctor</option>
<!--<option value="hospital">Hospital</option>-->
</select>
<br />
<input type="text" name="searchtxt" id="searchtxt" />
<br />
<input type="button" class="link" value="Search" placeholder="Search" onclick="searchval('what','searchtxt');" /></fieldset>
<div id='searcheddata' style="overflow:auto; height:100px;"></div>
</div>
    <!-- end of menu -->
    </div>
        
        <div id="banner_right">
           
		