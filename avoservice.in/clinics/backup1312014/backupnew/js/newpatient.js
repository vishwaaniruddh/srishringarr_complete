// JavaScript Document


	function lookup(inputString,id,suggest,suggestlist,ref) {
	//alert(inputString+" "+id+" "+suggest+" "+suggestlist+" "+ref);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/rpc.php", {
			
			queryString: ""+inputString+"",
			id: ""+id+"",
			suggest: ""+suggest+"",
			suggestlist: ""+suggestlist+"",
			ref: ""+ref+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest).show();
					$('#'+suggestlist).html(data);
				}
			});
		}
	} // lookup
	
	function fill(obj,suggest,id,ref) {
	document.getElementById(suggest).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	
var doc = obj.split("***");
	//alert(doc[0]);
		$('#'+id).val(doc[0]);
		$('#'+ref).val(doc[1]);
		setTimeout("$('#'"+suggest+").hide();", 200);
		//alert(doc[1]);
		//alert(ref);
		if(ref=='docref1')
		docref(ref);
		if(ref=='tosref1')
		toss(ref);
		if(ref=='paedref1')
		paedd(ref);
		if(ref=='physref1')
		physs(ref);
		if(ref=='neuref1')
		neuu(ref);
		if(ref=='swref1')
		swwn(ref);
		if(ref=='ngref1')
		ngo(ref);
	}



	function lookup2(inputString2,id2,suggest2,suggestlist2,ref2) {
	//alert(inputString2+" "+id2+" "+suggest2+" "+suggestlist2+" "+ref2);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest2).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/cityrpc.php", {
			
			queryString2: ""+inputString2+"",
			id2: ""+id2+"",
			suggest2: ""+suggest2+"",
			suggestlist2: ""+suggestlist2+"",
			ref2: ""+ref2+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest2).show();
					$('#'+suggestlist2).html(data);
				}
			});
		}
	} // lookup
	
	function fill2(obj2,suggest2,id2,ref2) {
	document.getElementById(suggest2).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	

	//alert(doc[0]);
		$('#'+id2).val(obj2);
		
		setTimeout("$('#'"+suggest2+").hide();", 200);
		
	}





function validate(form){
 with(form)
 {
  

if(fname.value=="")
{
	alert("Please Enter Firstname");
	fname.focus();
	return false;
}
 var numbers = /^[0-9]+$/;

if(year.value=='-1')
{
	alert("Please Select Year");
	year.focus();
	return false;
}


if(cn22.value=="")
{
alert("Please Enter 10 Digits Mobile Number.");
cn22.focus();
return false;
}
if(city.value=="")
{
	alert("Please Select City.");
	city.focus();
	return false;
}
if(pattype.value=='r')
{
if(pack.value=="")
{
	alert("Please Select Package.");
	pack.focus();
	return false;
}
if(stdt.value=="")
{
	alert("Please Select Package Start Date.");
	stdt.focus();
	return false;
}
}
}
 return true;
 }

function openwin(url,winid,style)
{
//alert(url+" "+winid+" "+style);
  mywindow = window.open(url, winid, style);
  
 }
 function openedtwin(url,winid,style,ref,foc)
{
//alert(url+" "+winid+" "+style);
var par=document.getElementById(ref).value;
if(par=='')
{
alert("Please Select Some doctor to Edit");
document.getElementById(foc).focus();
}
else
{
//alert(url);
pass=url+"&id="+par;
  mywindow = window.open(pass, winid, style);
 } 
 }
 





function citywindow(field)
{

  mywindow = window.open("newcity.php?field="+field, "mywindow", "location=400,status=1,scrollbars=1, width=200,height=200,left=350,top=200");
  
 }
 
 function packagewindow(field)
{

  mywindow = window.open("newpackage.php?field="+field, "mywindow", "location=400,status=1,scrollbars=1, width=600,height=300,left=350,top=100");
  
 }
/*
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

  mywindow = window.open("doctor.php?link=doc", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 function swwindow()
{

  mywindow = window.open("newsocial.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 function ngowindow()
{

  mywindow = window.open("newngo.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }*/





/////////////doctor ref
function docref(id)
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
   //alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("city1").value=s1[0];
		document.getElementById("cn1").value=s1[1];
		document.getElementById("email3").value=s1[2];
		document.getElementById("spl").value=s1[3];
   
    }
  }
 // alert(id);
  var str=document.getElementById(id).value;
  //alert("get_ref.php?docref="+str+"&ref=df");
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=df");
xmlhttp.send();

//////new entry
var ref1=document.getElementById('ref1');
	var val=ref1.options[ref1.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='nref' id='nref' placeholder='New Reference'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}

///end of ref
function toss(id)
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
  
  var str=document.getElementById(id).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

    var tos=document.getElementById('tos');
	var val=tos.options[tos.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='ntos' id='ntos' placeholder='Orhto Surgeon' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
//////end of ortho surgeon and strting of paed

function paedd(ref)
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
   // alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("paedcity").value=s1[0];
		document.getElementById("paedtel").value=s1[1];
		document.getElementById("paedemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById(ref).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
//////new entry
    var paed=document.getElementById('paed');
	var val=paed.options[paed.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr1");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='npad' id='npad' placeholder='Paediatrician' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}


///////////phys
function physs(ref)
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
 //  alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("physcity").value=s1[0];
		document.getElementById("phystel").value=s1[1];
		document.getElementById("physemail").value=s1[2];
		
   
    }
  }
  //alert(ref);
  var str=document.getElementById(ref).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

//////new entry
    var phys=document.getElementById('phys');
	var val=phys.options[phys.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr2");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nphy' id='nphy' placeholder='Physiotherapist' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
///start of neuu
function neuu(ref)
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
  
  var str=document.getElementById(ref).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
//alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

//////new entry
    var neu=document.getElementById('neu');
	var val=neu.options[neu.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr3");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nneu' id='nneu' placeholder='Neurosergeon' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
///strt sw
function swwn(ref)
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
    var s=xmlhttp.responseText;
  
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("swcity").value=s1[0];
		document.getElementById("swtel").value=s1[1];
		document.getElementById("swemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById(ref).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=sw",true);
//alert("get_ref.php?docref="+str+"&ref=sw");
xmlhttp.send();

//////new entry
    var sw=document.getElementById('sw');
	var val=sw.options[sw.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr4");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nsw' id='nsw' placeholder='Social Worker' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}


///strt ngo
function ngo(ref)
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
    var s=xmlhttp.responseText;
  
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("ngcity").value=s1[0];
		document.getElementById("ngtel").value=s1[1];
		document.getElementById("ngemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById(ref).value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=ng",true);
//alert("get_ref.php?docref="+str+"&ref=sw");
xmlhttp.send();

//////new entry
    var ng=document.getElementById('ng');
	var val=ng.options[ng.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr5");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nng' id='nng' placeholder='NGO' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}


/////for date of birth
function createList(){
//	alert("dgfr");
year=document.getElementById('year');
var i=1950;
for (i=1950; i<=2013; i++)
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

//////Add New City////////
function newcity()
{
	var city=document.getElementById('city');
	var val=city.options[city.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ncity' id='ncity' placeholder='New City'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}

//////Add New City////////
function newcenter()
{
	var center=document.getElementById('center');
	var val=center.options[center.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ncen' id='ncen' placeholder='New Center'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}

function getpackamt(id,field)
{ 
//alert(id+" "+field);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //alert(xmlhttp);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
  document.getElementById(field).value=xmlhttp.responseText;
    }
  }
  
  var str=document.getElementById(id).value;
  
xmlhttp.open("GET","getpackageamt.php?packid="+str,true);
alert("getpackageamt.php?packid="+str);
xmlhttp.send();

	
}
function showpack(id)
{
//alert(id);
if(document.getElementById(id).value=='r')
document.getElementById("package").style.display='block';
else if(document.getElementById(id).value=='nr')
document.getElementById("package").style.display='none';
}


function setmsg(field,id,name,amt)
{
alert(field+" "+id+" "+name+" "+amt);
 //document.getElementById(field).value=id;
 var option = document.createElement("option");
option.text = name;
option.value = name;
var selected = document.getElementById(field);
selected.appendChild(option);

setSelectedValue(selected,name);

function setSelectedValue(selectObj, valueToSet) {
//alert(selectObj);
    for (var i = 0; i < selectObj.options.length; i++) {
	//alert(selectObj.options[i].text);
        if (selectObj.options[i].value==valueToSet) {
		//alert(valueToSet);
            selectObj.options[i].selected = true;
            return;
        }
    }
	
}
if(field=='pack')
document.getElementById('packamt').value=amt;

}



