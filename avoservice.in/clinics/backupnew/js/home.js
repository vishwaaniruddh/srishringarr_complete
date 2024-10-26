
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


  
<!--end menu-->


function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}


<!-- multiple selection -->

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

<!-- end multiple selection -->


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

<!--end validation-->

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
