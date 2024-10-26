<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
include('template_clinic.html');
include('config.php');
//include('textedit.php');

$id=$_GET['id'];
$aid=$_GET['aid'];
$type=$_GET['type'];
$dt=$_GET['dt'];
//echo "select * from  patient where srno='$id'";
$sql="select * from  patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
//echo "select diagnosis,opddate from opd where patient_id='$id'";
$op=mysql_query("select diagnosis,opddate from opd where patient_id='$id'");
$oprow = mysql_fetch_row($op);
$app=mysql_query("select * from appoint where app_real_id='".$aid."'");
$appro=mysql_fetch_row($app);
//echo "date=".$oprow[1];
?>

<style>
td{border:none;
text-transform:none;}
</style>
<script type="text/javascript">
var $ = function(e){ return document.getElementById(e); }
var swap = function(val, el){
  $(el).value = val;
}

</script>
<script type="text/javascript" src="autocomplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
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
</script>
<style type="text/css">

</style>
<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
	
var a = document.opdform.diagn;
//alert(a.value);
var add = a.value+'\n';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+'\n';

document.opdform.adv.value += add;
return true;
}

function addThem2(){
	
var a = document.opdform.compl;
//alert(a.value);
var add = a.value+'\n';

document.opdform.comp.value += add;
return true;
}

function addThem3(){
	
var a = document.opdform.findi;
//alert(a.value);
var add = a.value+'\n';

document.opdform.findin.value += add;
return true;
}


function addThemsoi(){
	
var a = document.opdform.hos;
//alert(a.value);
var add = a.value+'\n';

document.opdform.soi.value += add;
return true;
}

function addThemaction(){
	
var a = document.opdform.act;
//alert(a.value);
var add = a.value+'\n';

document.opdform.actxt.value += add;
return true;
}

<!--add surgery-->
function addsurgery(){
	
var a = document.opdform.surgery;
//alert(a.value);
var add = a.value+'\n';

document.opdform.soi.value += add;
return true;
}

///add date
function adddt(){
	
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var s=daym+"/"+month+"/"+year;
document.getElementById("cdate").value = s

document.opdform.soi.value += s;
return true;
}
//////////////subcat
function loadXMLDoc()
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
    {// alert(xmlhttp.responseText);
    document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
  var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","sub_cat.php?cat="+cat,true);

xmlhttp.send();
}
</script>
<!-- end multiple selection -->

<!-- validation-->
<script type="text/javascript">

function opdvalidate(opdform){
 with(opdform)
 {
  

if(date.value=="")
{
	alert("Please select Date");
	date.focus();
	return false;
}
 
}
 return true;
 }
 ////upload image
function upp(){
var newdiv=document.createElement("div");
var aTextBox=document.createElement('input');
aTextBox.type = 'file';
aTextBox.name = 'image[]';
aTextBox.style='background:none; border:none;';

 //append text to new div
newdiv.appendChild(aTextBox); //append text to new div
//alert(aTextBox)
document.getElementById("img").appendChild(newdiv); 
}
/////////////////////
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}
////add more

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


function MakeRequest(cnt)

{
//alert(cnt);
document.getElementById(cnt).value=Number(document.getElementById(cnt).value)+1;
var cnt=document.getElementById(cnt).value;
  var xmlHttp = getXMLHttp();

 ///alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
//alert(xmlHttp.responseText);
      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");

 xmlHttp.open("GET", "getMore.php?cnt="+cnt, false);
//alert("getMore.php?cnt="+cnt);
  xmlHttp.send(null);

}
function HandleResponse(response)

{
///alert(response);
var ni =document.getElementById('detail');

var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

var newdiv = document.createElement('div');

var divIdName = num;

newdiv.setAttribute('id',divIdName);

newdiv.innerHTML =response;
ni.appendChild(newdiv);


//document.getElementById('barcode').value='';
document.getElementById('theValue').focus();
}

</script><!--end validation-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script language="javascript" type="text/javascript">


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



<script type="text/javascript">
function getpotency(id,field)
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
    		///alert(s1[0]+"/"+s1[1]);
			//alert(xmlhttp.responseText);
		document.getElementById(field).innerHTML=xmlhttp.responseText;
		
    }
  }
  
  var str=document.getElementById(id).value;
  
xmlhttp.open("GET","getpotency.php?medid="+str,true);
//alert("getpotency.php?medid="+str);
xmlhttp.send();
}

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
<script language="javascript">
  /*  function InsertBreak(e,id){
	
	//var id=document.getElementById(id).value;
        //check for return key=13
        if (parseInt(e.keyCode)==13) {
		//alert("hi");
            //get textarea object
            var objTxtArea;
            objTxtArea=document.getElementById(id);
		
    //insert the existing text with the <br>
        objTxtArea.value=objTxtArea.value+"<br>";
		//	alert(objTxtArea.value);
        }
    
    }*/
</script>
<script>
/*function temp()
{
	alert("hi");
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
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('examtemp').value;
  
xmlhttp.open("GET","get_exm.php?exm="+str,true);
alert("get_exm.php?exm="+str);
xmlhttp.send();
}*/
///
function temp1()
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
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
 
  var str=document.getElementById('opdtemp').value;
 
xmlhttp.open("GET","get_exm1.php?exm1="+str,true);
xmlhttp.send();
}

<!--add new hospital-->
function hoswindow()
{

  mywindow = window.open("new_hosp.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

<!-- examination template -->
/*function temp()
{
	alert("hi");
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
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('examtemp').value;
  
xmlhttp.open("GET","get_exm.php?exm="+str,true);
alert("get_exm.php?exm="+str);
xmlhttp.send();
}*/
///
function temp1()
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
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
 
  var str=document.getElementById('opdtemp').value;
 
xmlhttp.open("GET","get_exm1.php?exm1="+str,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
/*function addThem(){
	
var a = document.opdform.diagn;
//alert(a.value);
var add = a.value+',';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+',';

document.opdform.adv.value += add;
return true;
}

function addThem2(){
	
var a = document.opdform.compl;
//alert(a.value);
var add = a.value+',';

document.opdform.comp.value += add;
return true;
}

function addThem3(){
	
var a = document.opdform.findi;
//alert(a.value);
var add = a.value+',';

document.opdform.findin.value += add;
return true;
}


function addThemsoi(){

	
var a = document.opdform.hos;
//alert(a.value);
var add = a.value+',';

document.opdform.soi.value += add;
return true;
}

function addThemaction(){
	
var a = document.opdform.act;
//alert(a.value);
var add = a.value+',';

document.opdform.actxt.value += add;
return true;
}

<!--add surgery-->
function addsurgery(){
	
var a = document.opdform.surgery;
//alert(a.value);
var add = a.value+',';

document.opdform.soi.value += add;
return true;
}*/
///add date
function adddt(){
	
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var s=daym+"/"+month+"/"+year;
document.getElementById("cdate").value = s

document.opdform.soi.value += s;
return true;
}

 ////upload image
function upp(){
var newdiv=document.createElement("div");
var aTextBox=document.createElement('input');
aTextBox.type = 'file';
aTextBox.name = 'image[]';
aTextBox.style='background:none; border:none;';

 //append text to new div
newdiv.appendChild(aTextBox); //append text to new div
//alert(aTextBox)
document.getElementById("img").appendChild(newdiv); 
}

/////////////////////
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

<!-- examination template -->
function temp()
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
   // alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('examtemp').value;
  
xmlhttp.open("GET","get_exm.php?exm="+str,true);
xmlhttp.send();
}
///
function temp1()
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
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
 
  var str=document.getElementById('opdtemp').value;
 
xmlhttp.open("GET","get_exm1.php?exm1="+str,true);
xmlhttp.send();
}
function pres(){
//alert ("isuhgf");
	var comp=document.getElementById('comp').value;
	comp = comp.replace(/\n/g, '<br>');
	var findin=document.getElementById('findin').value;
	findin=findin.replace(/\n/g, '<br>');
	var adv=document.getElementById('adv').value;
	adv=adv.replace(/\n/g, '<br>');
	var diag=document.getElementById('diag').value;
	diag=diag.replace(/\n/g, '<br>');
	var date1=document.getElementById('date1').value;
	var invest=document.getElementById('invest').value;
	invest=invest.replace(/\n/g, '<br>');
	var med=document.getElementsByClassName('med'); 
	var tak=document.getElementsByClassName('tak'); 
	var dos=document.getElementsByClassName('dos'); 
	var med1=""; 
	var tak1=""; 
	var dos1="";
	


//alert(findin);




//document.write('string');
	for(i=0;i<med.length;i++) {
		
		med1=med1+med[i].value+", ";
		
	    tak1=tak1+tak[i].value+", ";
	
	    dos1=dos1+dos[i].value+", ";
	}
	
	popcontact('clinic1_print.php?id=<?php echo $id; ?>&comp='+comp+'&findin='+findin+'&adv='+adv+'&diag='+diag+'&date1='+date1+'&invest='+invest+'&med1='+med1+'&tak1='+tak1+'&dos1='+dos1);
}

function newhos()
{
	var hos=document.getElementById('hospital');
	var val=hos.options[hos.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='newhospital' id='newhospital' placeholder='New Hospital'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}


//////get start date
function MakeRequest3()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse3(xmlHttp.responseText);

    }

  }

//alert("hi2");

//var str = escape(document.getElementById('hos').value);
var str1 = escape(document.getElementById('nxtdate').value);
//var str1 = escape(document.getElementById('type').value);

//alert(str1);
 xmlHttp.open("GET", "get_opdtime.php?nxtdate="+str1, true);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlHttp.send(null);

}
function HandleResponse3(response)

{
//alert(response);
document.getElementById('detail3').innerHTML=response;

}


function ex(){
	
var a=document.getElementsByName('ch[]');
var id=document.getElementById('patient_id').value;
	var x=0;
	var ax=new Array();
	for(counter=0;counter<a.length;counter++)
	{
		if(a[counter].checked)
		{
			ax[x]=a[counter].value;
			x=x+1;
			
		}	
		
	}
	//alert(x);
		if(x>2 || x<2)
		{
			alert("Select Only 2 Hospital");
			a[counter].checked=false;
			return;
	    }
		//alert(x);
		window.open("exchange.php?ch[0]="+ax[0]+"&ch[1]="+ax[1]+"&id="+id,'_self');

}


//////get start date
function MakeRequest4()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse4(xmlHttp.responseText);

    }

  }

//alert("hi2");

var str = escape(document.getElementById('hos1').value);
var str1 = escape(document.getElementById('nxtdate').value);
 xmlHttp.open("GET", "get_opdtimeslot.php?hos1="+str+"&nxtdate="+str1, true);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlHttp.send(null);

}
function HandleResponse4(response)

{
//alert(response);
document.getElementById('detail4').innerHTML=response;

}


var x=0;
function colorchange(obj,src){
//alert(src);

  obj.style.backgroundColor='#F00';
  for(i=1;i<=12;i++){
  if(i!=src){
	  if(document.getElementById(i)!=null)
 document.getElementById(i).style.backgroundColor='#FFC';
  }
  }
  //x=src;
  document.getElementById('sl').value=src;


//alert(document.getElementById("1").innerHTML);

var e = document.getElementById("slot").innerHTML;

}

 
var	childWin2 = null;
function openchild(id,url,winname,style,field){
//alert("hi");
//alert(id+" "+url+" "+winname+" "+style+" "+field);
url=url+"&field="+field;

 childWin2 = window.open(url,winname, style);
 }
 function setmsg(obj,field)
{
// alert("Parent "+obj);
 select = document.getElementById(field);
 var opt = document.createElement('option');
    opt.value = obj;
    opt.innerHTML = obj;
    select.appendChild(opt);
	var objSelect = document.getElementById(field);

//Set selected
setSelectedValue(objSelect, obj);

function setSelectedValue(selectObj, valueToSet) {
    for (var i = 0; i < selectObj.options.length; i++) {
	//alert(selectObj.options[i].text);
        if (selectObj.options[i].text== obj) {
		//alert(obj);
            selectObj.options[i].selected = true;
            return;
        }
    }
}
if(field=='examtemp')
temp();
else if(field=='opdtemp')
temp1();
//MakeRequest();
//MakeRequest1();
}

</script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<!-- end of popup window -->

</head>

<body onLoad="createList();">


<div class="M_page">

         <form method="post" class="" action="new_opd.php" name="opdform" onSubmit="return opdvalidate(this)" enctype="multipart/form-data" style="font-variant:normal">
                <fieldset class="textbox">
                <legend><h1><img src="ddmenu/opd.png" height="50" width="50">OPD</h1></legend>
                
                <input type="hidden" name="myvar" value="0" id="theValue" />
                <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $id; ?>"/>
                 <input type="hidden" name="aid" value="<?php echo $aid; ?>"/>
                  <input type="hidden" id="sl" name="sl"/> 
                 
                
                <table width="858" id="sub">
                <tr>
                <td width="62"><label>Upload Report</label></td>
                <td colspan="2"><div id="img"><input type="file" name="image[]" id="image[]" style="background:none; border:none;"></div>
                <br/>
                <a href="#" onClick="upp()">Add More</a><br/></td>
                <td width="419">
                <?php
			//echo "select * from opd where patient_id='$id'";
				 $rs=mysql_query("select * from opd where patient_id='$id'");
				$s=mysql_num_rows($rs);
				///echo $s;
				if($s==0){
				?>
                <input style="background:none; border:none; width:20px; height:20px;" name="ode1[]" id="code1[]" type="checkbox" onClick="window.location.href='pre_inves.php?id=<?php echo $id ?>&aid=<?php echo $aid; ?>'" /><label>Pre- Investigation</label>
                <?php } ?>
                &nbsp;&nbsp;<font size="+1"><a href="Timeline/horizontal.php?id=<?php echo $id; ?>" target="_blank" >History</a></font></td>
                </tr>
                <tr>
                <td><label class="name">Name:</label></td>
                <td width="239"><input id="name" name="name" type="text" value="<?php echo $row[6]; ?>" readonly /> </td>

<?php 
//echo $s[8];
$sql4="select  type from apptype where type<>'' order by type ASC";
$result4 = mysql_query($sql4);
?>              <td width="118"><label class="hospital">Appointment Type:</label></td>
                <td valign="top">
                <select name="hospital" id="hospital" >
                <option value="0">Select</option>
                <?php while($row4=mysql_fetch_row($result4)) { ?>
                <option value="<?php echo $row4[0]; ?>" <?php if($row4[0]==$appro[18]){  echo "selected";  } ?>><?php echo $row4[0]; ?></option>
                <?php } ?>
                
                </select>
             
                </td>
                </tr>
                
                
                <tr>
                <td><label class="date1">Date: </label></td>
                <td ><input id="date1" name="date1" type="text" value="<?php if($oprow[1]!='0000-00-00' || $oprow[1]!='' || $oprow[1]!='null'){ echo date('d/m/Y',strtotime($dt)); }else { echo date('d/m/Y'); }    ?>" onClick="displayDatePicker('date1');"></td>
				
				<td colspan="3">
				&nbsp;&nbsp;&nbsp;&nbsp;<button class="submit formbutton" type="button"  name="print1" id="print1" style="width:140px;" onClick="javascript:pres();"><b>Print Prescription</b></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="submit formbutton" type="button"  name="copy" id="copy" style="width:150px;" onClick=";">Copy Data from Patient</button>
				&nbsp;&nbsp;&nbsp;&nbsp;<!--<button class="submit formbutton" type="button"  name="newfollow" id="newfollow" style="width:140px;" onClick="">New/Follow Up</button>-->
				</td>
                </tr>
                </table>
                
                <table>
                <tr>
                <td width="456">
                <?php $result11=mysql_query("select name from templa where name<>''");?>
               <label> Select Examination Template :</label>&nbsp;&nbsp;<a href="#" onClick="openchild(this.id,'newtemplate.php?type=ajax&tbl=templa','template','width=600,height=450,left=200,top=100','examtemp')"><img src="images/add.png" height="15px" width="15px" title="Add New Template" /></a>
                <select name="examtemp" id="examtemp"  onChange="temp();">
                <option value="0">-Select-</option>
                <?php while ($row11=mysql_fetch_row ($result11))
				{ ?>
            	<option value="<?php echo $row11[0];?>"><?php echo $row11[0];?></option>
           		<?php } ?>
                </select>
                </td>
                
                <td>
                <?php $result12=mysql_query("select heading from templa1 where heading<>''");?>
				<label>Select OPD Template :</label>&nbsp;&nbsp;<a href="#" onClick="openchild(this.id,'newtemplate.php?type=ajax&tbl=templa1','template','width=600,height=700,left=200,top=100','opdtemp')"><img src="images/add.png" height="15px" width="15px" title="Add New Template" /></a>
                <select name="opdtemp" id="opdtemp"  onChange="temp1();">
                <option value="0">-Select-</option>
                <?php while ($row12=mysql_fetch_row ($result12))
				{ ?>
            	<option value="<?php echo $row12[0];?>"><?php echo $row12[0];?></option>
            	<?php } ?>
                </select>
                </td>
				<td>   <!--Summary of Interventions: 
         <br /> <textarea name="soi" cols="33" rows="7" style="resize:none;font-variant:normal" onKeyDown="InsertBreak(event,'soi');"></textarea>--></td>
                </tr>
                
<?php
//$sql="select * from  opdbill ";
//$res = mysql_query($sql);
//$row5 = mysql_fetch_row($res);
?>
<?php
include ('config.php');
$result4=mysql_query("select name,id from compla");
?>

  <tr>
    <td width="456" ><label> History: </label>
          <select name="compl" onChange="addThem2()">
            <option value="0">-Select-</option>
            <?php while ($row4=mysql_fetch_row ($result4))
				{ ?>
            <option value="<?php echo $row4[0];?>"><?php echo $row4[0];?></option>
            <?php } ?>
          </select>
      <br />
          <textarea name="comp" id="comp" cols="28" rows="5" style="resize:none;font-variant:normal"></textarea>
      </td>
    <?php

$result5=mysql_query("select name,clinic_id from clinic");
?>
    <td width="336" > <label>Clinical Details:</label> 
         
  <select name="findi"  onChange="addThem3()">
            <option value="0">-Select-</option>
            <?php while ($row5=mysql_fetch_row ($result5))
				{ ?>
            <option value="<?php echo $row5[0];?>"><?php echo $row5[0];?></option>
            <?php } ?>
          </select>
      <br />
          <textarea name="findin" id="findin" cols="28" rows="5" style="resize:none;font-variant:normal"></textarea>
      </td>
    <td width="284">
<!--<?php 
$sql4="select name,hospital_id from hospital ";
$result4 = mysql_query($sql4);
?>
    <select name="hos" onChange="addThemsoi();" style="width:200px;">
      <option value="0">Select Hospital</option>
      <?php while($row4=mysql_fetch_row($result4)) { ?>
      <option value="<?php echo $row4[0]; ?>"><?php echo $row4[0]; ?></option>
      <?php } ?>
    </select>
    
        <br /><br />
<?php 
$sql14="select * from surmast where name<>'' order by name ASC";
$result14 = mysql_query($sql14);
?>
        <select name="surgery" style="width:200px;" onChange="addsurgery()">
          <option value="0">Select Surgery</option>
          <?php while($row14=mysql_fetch_row($result14)) { ?>
          <option value="<?php echo $row14[0]; ?>"><?php echo $row14[0]; ?></option>
          <?php } ?>
        </select>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;<button class="submit formbutton" type="button"  name="cdate" id="cdate" style="width:100px;" onClick="adddt();">Insert Date</button>--></td>
     
   
  </tr>
  
  <tr>
  <?php

$result6=mysql_query("select name,id from advise");
?>
    <td><label>Advised:</label>
          <select name="rec"  onChange="addThem1()">
            <option value="0">-Select-</option>
            <?php while ($row6=mysql_fetch_row ($result6))
				{ ?>
            <option value="<?php echo $row6[0];?>"><?php echo $row6[0];?></option>
            <?php } ?>
          </select>
      <br />
          <textarea name="adv" id="adv" cols="28" rows="5" style="resize:none;font-variant:normal" onKeyDown="InsertBreak(event,'adv');"></textarea>
      </td>
    <?php 

$result3 = mysql_query("select name,diag_id from diag");
?>
    <td><label> Diagnosis: </label>
          <select name="diagn"  onChange="addThem()" <?php if($type=='O') { ?> disabled <?php } ?>>
            <option value="0">-Select-</option>
            <?php while($row=mysql_fetch_row($result3))
                {  ?>
            <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
            <?php } ?>
          </select>
      <br />
          <textarea name="diag" id="diag" cols="28" rows="5" style="resize:none;font-variant:normal" <?php if($type=='O') { ?>  readonly<?php } ?> onKeyDown="InsertBreak(event,'diag');"><?php echo $oprow[0]; ?></textarea>
      </td>
	  
	  <td valign="top">

   <!--
      
      <?php $result13=mysql_query("select name,keyword_id from keyword where name<>''"); ?>
	  Keyword:<select name="key1" style="width:250px;">
	  <option value="0">-Select-</option>
      <?php while($row13=mysql_fetch_row($result13))
                {  ?>
            <option value="<?php echo $row13[0]; ?>"><?php echo $row13[0]; ?></option>
            <?php } ?>
	  </select>-->
	  </td>
	  
	  
	  
  </tr>
  <tr>
    <td>  <!--Impression: 
          <textarea name="impr" id="impr" cols="30" rows="4" style="resize:none;" onKeyDown="InsertBreak(event,'impr');"></textarea>-->
          <label>Investigations Advised: </label>
      <textarea name="invest" id="invest" cols="30" rows="4" style="resize:none;" onKeyDown="InsertBreak(event,'invest');"></textarea>
      </td>
    <td>  
    <label>Physiotherapy Goals: </label>
          <textarea name="physio" id="physio" cols="30" rows="4" style="resize:none;" onKeyDown="InsertBreak(event,'physio');"></textarea>
      </td>
    <td>  
      </td>
	 
  </tr>
  <?php 

$result13 = mysql_query("select name,action_id from action");
?>
 <tr> <td>
  <label>Status: </label>
            <br />
             <textarea rows="4" cols="30" name="comm" id="comm" value><?php echo $row[70]; ?></textarea>
  <!-- Action Plan: 
            <select name="act" id="act" style="width:200px; border:1px #ac0404 solid;" onChange="swap(this.value, 'actxt')">
              <option value="0">-Select-</option>
              <?php while($row13=mysql_fetch_row($result13))
                {  ?>
              <option value="<?php echo $row13[0]; ?>"><?php echo $row13[0]; ?></option>
              <?php } ?>
            </select>
    <br />
    <input type="text" id="actxt" name="actxt" style="width:200px;"/>
    <br />
  
  Cost: <br />  
            <input type="text" name="cost" id="cost" style="width:200px;"/>-->
  </td>
      <td valign="top"><label>Instructions:</label><br />
		<textarea name="instruc" id="instruc" cols="30" rows="4" style="resize:none;" onKeyDown="InsertBreak(event,'instruc');"></textarea></td>
            
         </td>
		
		
		
		</tr>
</table>
<div id="detail">            
                <table border="1">
                <tr><th>Medicine Name </th><th>Potency</th><th>Repetition </th><th>Duration/week</th><th>Others</th></tr>
                <?php for($j=0;$j<=2;$j++){?>
                <tr>
                <td>
                <select style="width:140px;" name="med[]" id="med<?php echo $j ?>" class="med" onChange="getpotency('med<?php echo $j ?>','pot<?php echo $j; ?>')">
                <option value="0">Select</option>
                <?php $result3 = mysql_query("select name from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td><td><select name="pot[]" id="pot<?php echo $j; ?>">
                <option value="">-select-</option>
                </select>
                </td>
                <td>
				<input type="text" name="dos[]" id="dos[]" style="width:140px;"/>
				</td>
           
				
				<td>
				<input type="text" name="days[]" id="days[]" style="width:140px;"/>
				</td>
                 <td><input type="text" name="cmnt[]" id="cmnt[]" style="width:140px;"/></td>
                </tr>

<?php 
				}
			
			?>
            <input type="hidden" name="forcnt" id="forcnt" value="2">
			<tr><td colspan="4" align="right"> <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest('forcnt');">Add More </a></td></tr>
                </table> 
				
                </div>  
                       <br/>
                        
				<!--<table width="696">
				<tr>
				<td width="345" height="38">Next Visit (Date):
				  <input type="text" name="nxtdate" style="width:170px;" id="nxtdate" onClick="displayDatePicker('nxtdate');" /></td>
				
				<td width="339">Next Visit (Text):<input type="text" name="nxttext" style="width:170px;" id="nxttext"/></td>
				</tr>
                
                <tr><td colspan="2">
				 <input type="text" name="hos1" id="center" onKeyUp="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" style="background:#fff;border:1px solid #ac0404;width:150px;" value="<?php echo $appro[24]; ?>"  />
               <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:350px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>
			</td>
               
                </tr>
               </table>-->
               <table>
                <tr>
                <td>
	  <button class="submit formbutton" type="button"  name="csl" id="csl" style="width:150px;" onClick="javascript:popcontact('clinical_letter.php?id=<?php echo $id; ?>');">Clinical Status Letter</button></td>
      <td> <button class="submit formbutton" type="button"  name="thankl" id="thankl" style="width:150px;" onClick="javascript:popcontact('thanking_letter.php?id=<?php echo $id; ?>');">Thanking Letter</button> </td>
      
	  <td> <button class="submit formbutton" type="button"  name="adml" id="adml" style="width:150px;" onClick="javascript:popcontact('admission_letter.php?id=<?php echo $id; ?>');">Admission Letter</button></td>
      <td><button class="submit formbutton" type="button"  name="refl" id="refl" style="width:150px;" onClick="javascript:popcontact('referring_letter.php?id=<?php echo $id; ?>');">Referring Letter</button></td>
      
     <td> <button class="submit formbutton" type="button"  name="physiol" id="physiol" style="width:150px;" onClick="javascript:popcontact('physiotherapy_letter.php?id=<?php echo $id; ?>');">Physiotherapy Letter</button></td>
     
  
   </tr>
   <tr>
   <td height="66">
	  <button class="submit formbutton" type="button"  name="medcerti" id="medcerti" style="width:150px;" onClick="javascript:popcontact('medical_certificate.php?id=<?php echo $id; ?>');">Medical Certificate</button></td>
       <td><button class="submit formbutton" type="button"  name="investl" id="investl" style="width:150px;" onClick="javascript:popcontact('investigation_letter.php?id=<?php echo $id; ?>');">Investigation Letter</button></td>
      <td><button class="submit formbutton" type="button"  name="print2" id="print2" style="width:150px;" onClick="javascript:pres();">Print Prescription</button></td>
     <td><button class="submit formbutton" type="button"  name="personal" id="personal" style="width:150px;" onClick=""><b>Edit Personal Info</b></button>
      </td>
	  
	  </tr>
				<tr><td>                                                         
                <button class="submit formbutton" type="submit" name="Submit">Submit</button></td>
				<td>
                 <button class="submit formbutton" type="button" onClick="javascript:location.href = 'View_app.php';">Cancel</button>
                  </td><td>
 <button class="submit formbutton" type="button" style="width:150px;" onClick="javascript:popcontact('opt_surgery.php?id=<?php echo $id; ?>');">Surgery Waiting List</button>
</td><td>
 <button class="submit formbutton" type="button" style="width:150px;" onClick="javascript:location.href='app_surgery.php?id=<?php echo $id; ?>';">Surgery Appointment</button> </td></tr></table>   
                </fieldset>
    </form>
</div>
</boady>

<script>
function ab(){
var cb=document.getElementById('xr');
if (cb.checked==true)
{
	document.getElementById('xray').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('xray').value);
	
}
	else { document.getElementById('xray').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('xray').value);
}
}
function dresfun(){
var dc=document.getElementById('dres');
if (dc.checked==true)
{
	document.getElementById('drestxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('drestxt').value);
}
	else 
	{
		document.getElementById('drestxt').style.display='none';
		document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('drestxt').value);
}
}

function strfun(){
var sc=document.getElementById('str');
if (sc.checked)
{
	document.getElementById('strtxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('strtxt').value);
}
	else { document.getElementById('strtxt').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('strtxt').value);
	}
}

function ecgfun(){
var ec=document.getElementById('ecg');
if (ec.checked)
{
	document.getElementById('ecgtxt').style.display='inline';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('ecgtxt').value);
}
	else { document.getElementById('ecgtxt').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('ecgtxt').value);
}
}
function confun(){
var cc=document.getElementById('con');
var fc=document.getElementById('fol');
if (cc.checked)
{
	document.getElementById('cons').style.display='inline';
	document.getElementById('foll').style.display='none';
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('cons').value);


}
	else if (fc.checked) { 
	document.getElementById('foll').style.display='inline';
	document.getElementById('cons').style.display='none'; 
	document.getElementById("tot").value=Number(document.getElementById("tot").value)+Number(document.getElementById('foll').value);
	document.getElementById("tot").value=Number(document.getElementById("tot").value)-Number(document.getElementById('cons').value);
	}
}

function paid() {
		 
var a=Number(document.getElementById("cons").value); 
var b=Number(document.getElementById("foll").value); 
var c=Number(document.getElementById("xray").value);
var d=Number(document.getElementById("drestxt").value);
var e=Number(document.getElementById("strtxt").value);
var f=Number(document.getElementById("ecgtxt").value);
var g=Number(document.getElementById("inj").value);
var h=Number(document.getElementById("pa").value);
var i=Number(document.getElementById("pr").value);
var j=Number(document.getElementById("red").value);
var k=Number(document.getElementById("op").value);
var l=Number(document.getElementById("sut").value);
var m=Number(document.getElementById("cer").value);
var n=Number(document.getElementById("oth").value);
var cc=document.getElementById('con');
var fc=document.getElementById('fol');


 if (isNaN(a) || isNaN(b)  || isNaN(g) || isNaN(h)  || isNaN(i) || isNaN(j)|| isNaN(k) || isNaN(l) || isNaN(m) || isNaN(n) ) { alert("Please enter only numbers."); return false; } 

if (cc.checked)
{
var grandtotal=a+g+h+i+j+k+l+m+n; } else var grandtotal=b+g+h+i+j+k+l+m+n;

document.getElementById("tot").value=grandtotal.toFixed(2); 
return false; 
} 

</script>


