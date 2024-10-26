<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html'); 
include('template_clinic.html');
include('config.php');
$result = mysql_query("select * from patient");
?>

<style>

</style>
<style type="text/css">
	
</style>
<script type="text/javascript" src="autocomplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString,id,suggest,suggestlist,ref) {
	//alert(inputString+" "+id+" "+suggest+" "+suggestlist+" "+ref);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/rpcmail.php", {
			
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
	document.getElementById('texting').value='';
var doc = obj.split("***");
	//alert(doc[0]);
		$('#'+id).val(doc[0]);
		$('#'+ref).val(doc[1]);
		setTimeout("$('#'"+suggest+").hide();", 200);
		//alert(doc[1]);
		//alert(ref);
		if(ref=='mailref1')
		{
		if(doc[1]=='')
		{
		alert("There is no email id for this doctor");
		}
		else
		{
		//alert(document.getElementById("email").value);
		if(document.getElementById("email").value=='')
		document.getElementById("email").value=document.getElementById("email").value+""+doc[1];
		else
		document.getElementById("email").value=document.getElementById("email").value+","+doc[1];
		
		}
		}
		
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
	
function newslot(hos)
{
//alert("hi");
//openchild(this.id,'new_slot.php?type=ajax&hos=<?php echo $row[16]; ?>&field=hos','app','width=600,height=450,left=200,top=100','appdate');
var hos=hos;
var type="ajax";
var field="hos1";
var dt=document.getElementById('appdate').value
  mywindow = window.open("new_slot.php?field="+field+"&type="+type+"&hos="+hos+"&dt="+dt, "mywindow", "location=400,status=1,scrollbars=1, width=600,height=600,left=350,top=200");
 
}
	
	
</script>
<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
function confirm_delete3(id)
{ 
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_app.php?id="+id;
	}
	
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



///////////////////////////////search By Id
function searchById(Mode,Page) {
 //alert("hi");
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  /*if(document.getElementById('searchdate').value=="" && document.getElementById('fname22').value=="" && document.getElementById('cont').value=="")
		  {
			  var url = 'get_app.php';
		  }else   if(document.getElementById('fname22').value=="" && document.getElementById('cont').value==""){
			  
			  var s=document.getElementById('searchdate').value;
			  var c= document.getElementById('cont').value;
			var url = 'get_app.php?searchdate='+s+'&cont='+c;
		  } else if(document.getElementById('searchdate').value=="" && document.getElementById('cont').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_app.php?fname='+s;
		  } 
		  
		  else if(document.getElementById('searchdate').value=="" && document.getElementById('fname22').value==""){
			  
			   var cont=document.getElementById('cont').value;
			var url = 'get_app.php?cont='+s; //alert(cont);
		  }
		  else{
			  var searchdate=document.getElementById('searchdate').value;
			  var s=document.getElementById('fname22').value;
			  var cont=document.getElementById('cont').value; //alert(cont);

			var url = 'get_app.php?fname='+s+'&searchdate='+searchdate+'&cont='+cont;
		  }*/
 	
		      var name=document.getElementById('name').value;//alert(id);
			  var searchdate=document.getElementById('searchdate').value;//alert(adate);
			  var cont=document.getElementById('cont').value;//alert(city);
			   var hos=document.getElementById('hos').value;//alert(city);
			   var ref=document.getElementById('ref').value;//alert(city);
			  
			  var url = 'get_app.php';
			
			var pmeters = 'mode='+Mode+'&Page='+Page+'&name='+name+'&searchdate='+searchdate+'&cont='+cont+'&hos='+hos+'&ref='+ref;

			HttPRequest.open('POST',url,true);
 
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 

			HttPRequest.onreadystatechange = function()
			{
 
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
// alert(response);
				   document.getElementById("search").innerHTML = response;
			  }
		}
  }

function SentMail()
{
var x=document.getElementById('reccnt').value;
for(i=0;i<x;i++)
{
if(document.getElementById('mail'+i).checked==true)
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
		alert(xmlhttp.responseText);
    document.getElementById("report").innerHTML=xmlhttp.responseText;
    }
  }
  value=document.getElementById('mail'+i).value;
 //alert("garmentgallery.php?cid="+id);
// alert("getcustdetail.php?id="+value+"&attr="+attr);
if(value!='')
xmlhttp.open("get","missed_app.php?patid="+value,false);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();

}
}
}

function Changestatus(appid,stat)
{
//alert(appid+" "+stat);
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
	 if(xmlhttp.responseText=='1')
	 searchById('Listing','1');
	 else
	 alert("Some Error Occurred, Try again");
    //document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
 // var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","changeappstat.php?appid="+appid+"&stat="+stat,false);

xmlhttp.send();
}






function filldate(dt)
{
document.getElementById("searchdate").value=dt;
}
function fillapptype(app)
{
document.getElementById("hos").value=app;
searchById('Listing','1');
}
//edit appointment
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
function Editapp(dt,id,hos,center)
{
	//alert(dt+""+id+""+hos);
document.getElementById("editapp").style.display='block';
document.getElementById("detail1").style.display='none';
document.getElementById("id").value=id;
document.getElementById("appdate").value=dt;
  var xmlHttp = getXMLHttp();

//alert("hello");

 xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
//alert(xmlHttp.responseText);
      HandleResponse(xmlHttp.responseText);

    }

  }

///alert("hi2");

//var str = escape(document.getElementById('hos1').value);
//var str1 = escape(document.getElementById('appdate').value);
////alert("get_timeslot1.php?hos="+str+"&appdate="+str1);
//alert("get_time1ajax.php?hos="+hos+"&appdate="+dt+"&ad="+id);
 xmlHttp.open("GET", "get_time1ajax.php?hos="+hos+"&appdate="+dt+"&ad="+id+"&center="+center, true);
 //alert("get_time1ajax.php?hos="+0+"&appdate="+dt+"&ad="+id);
//alert("get_timeslot1.php?hos="+str+"&appdate="+str1+"&ad=<?php echo $id; ?>");
  xmlHttp.send(null);

}
function HandleResponse(response)

{
////alert(response);
document.getElementById('detail').innerHTML=response;

}
function MakeRequest1(dt,id,hosp,center)
{
	//alert(dt,id,hosp,center);
	
document.getElementById("detail1").style.display='block';
var hos=document.getElementById(hosp).value;
var dt=document.getElementById(dt).value;
  var xmlHttp = getXMLHttp();
if(hos!='')
{
//alert("hello");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
//alert(xmlHttp.responseText);
      HandleResponse2(xmlHttp.responseText);

    }

  }

///alert("hi2");


////alert("get_timeslot1.php?hos="+str+"&appdate="+str1);
 xmlHttp.open("GET", "get_timeslot1.php?hos="+hos+"&appdate="+dt+"&ad="+id+"&center="+center, true);
//alert("get_timeslot1.php?hos="+hos+"&appdate="+dt+"&ad="+id);
  xmlHttp.send(null);
}
}

function appoint(id)
{ 
	if (confirm("Are you sure you want to Confirm this appointment?"))
	{
		document.location="confirmapp.php?id="+id;
	}
	
}



function HandleResponse2(response)

{
////alert(response);
document.getElementById('detail1').innerHTML=response;

}
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
function ex(){
//alert("hh");	
var a=document.getElementsByName('ch[]');
//var id=document.getElementById('patient_id').value;
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
		//alert("exchange.php?ch[0]="+ax[0]+"&ch[1]="+ax[1]);
		window.open("exchangeajax.php?ch[0]="+ax[0]+"&ch[1]="+ax[1],'_self');

}
</script>
<script>
function sendmsg(){
 var oo = document.getElementById("hos").value;
 //alert(oo);
 var opener = null;
 if (window.dialogArguments) // Internet Explorer supports window.dialogArguments
        { 
            opener = window.dialogArguments;
        } 
        else // Firefox, Safari, Google Chrome and Opera supports window.opener
        {        
            if (window.opener) 
            {
                opener = window.opener;
				//return true;
            }
        }       
//		alert(opener);
  opener.setmsg(oo);
}

function setmsg(obj)
{
 //alert("Child "+obj);
 document.getElementById("xyz1").value=obj;
}

</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<body onLoad="searchById('Listing','1')">

<div class="M_page">


<fieldset class="textbox">
<legend> <h1><img src="ddmenu/apointment.png" style="width:50px; height:50px;" /><?php  if(isset($_GET['timestamp'])){ echo  strftime("%B",$_GET['timestamp']); }else{ ?>Today's <?php } ?> Appointments</h1></legend>
     
<table width="auto" border="0px">
     <tr>
     <td width="50%" valign="top">
       <div id="calendar">
         <?php include("planner/index.php"); ?>
       </div>
            </td>
     <td valign="top" id="editapp" style="display:none"><div>
     
     <form name="editapp" method="post" action="update_appajax.php"  autocomplete='OFF'>
     <input type="hidden" name="id" id="id">
     <input type="text" name="appdate" id="appdate" onClick="displayDatePicker('appdate');">
     Remarks : <input type="text" name="rem" id="rem">
      <div id="detail1"> </div>
      
      <div id="detail"></div>
      
     <input type="hidden" id="sl" name="sl"/> 
     <input type="submit" name="cumedt" value="Update" class="submit formbutton">
     </form>
    </div>    </td>
    </tr>
</table>


<table>
   <tr>
   <td><input type="text"  name="searchdate" id="searchdate" onBlur="searchById('Listing','1');"  placeholder="Date" onClick="displayDatePicker('searchdate');" value="<?php  if(isset($_GET['searchdate'])){ echo $_GET['searchdate']; } ?>"/></td>
   <td><input type="text"  name="name" id="name"  onkeyup="searchById('Listing','1');" placeholder="Name"/></td>
   <td><input type="text"  name="cont" id="cont"  onkeyup="searchById('Listing','1');" placeholder="Contact"/></td>
   <td><input type="text"  name="ref" id="ref"  onkeyup="searchById('Listing','1');" placeholder="Reference"/></td>
   <td><input type="text"  name="hos" id="hos"  onkeyup="searchById('Listing','1');" placeholder="Appointment Type"/></td>
   </tr>
</table>

        <div id="search"></div>


    <button class="submit formbutton" type="button" onClick="var name=document.getElementById('name').value;
          var searchdate=document.getElementById('searchdate').value; var cont=document.getElementById('cont').value;
          window.open('app_print.php?name='+name+'&searchdate='+searchdate+'&cont='+cont, '_BLANK')">Print</button>
<div id="report"></div>
          </fieldset>
          </div>
   
   
</body>

