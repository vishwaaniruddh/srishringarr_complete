<?php
include("access.php");
include("config.php");
include("Whatsapp_delegation/delegation_fun.php");
//echo $_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user'];  ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->


<script>

function CheckNumeric(e) {
     console.log(e.which)
        if (window.event) // IE
        {
            if ((e.keyCode <48 || e.keyCode > 57) & e.keyCode != 8 && e.keyCode != 44) {
                event.returnValue = false;
                return false;
                console.log(false)
            }
        }
        else { // Fire Fox
            if ((e.which <48 || e.which > 57) & e.which != 8 && e.which != 44) {
                e.preventDefault();
                return false;
               
            }
        }
    } 
    
    
    function getno(val)
{ 
//alert(val);
  var xmlHttp = getXMLHttp();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
   // alert(xmlHttp.responseText);
    if(xmlHttp.responseText==0)
    alert("sorry, your session has expired");
    else
document.getElementById('whatsno').innerHTML=xmlHttp.responseText;
      //HandleResponse3(xmlHttp.responseText);
    }
  }
  xmlHttp.open("GET", "ClientPanel/get_whatsno.php?cust="+val, true);
  xmlHttp.send();
}

//==================== Disable fields========================

function pmdisable(d){
	//alert(d);
	if(d=='pm'){
		// alert("hi");
		document.getElementById('prob').disabled=true;
		document.getElementById('cemail').disabled=true;
		document.getElementById('sendmail').disabled=true;
		document.getElementById('ccemail').disabled=true;
		document.getElementById('appby').disabled=true;
		document.getElementById('how').disabled=true;
		document.getElementById('cc').disabled=true;
		}else{
			document.getElementById('prob').disabled=false;
			document.getElementById('cemail').disabled=false;
			document.getElementById('sendmail').disabled=false;
			document.getElementById('ccemail').disabled=false;
			document.getElementById('appby').disabled=false;
			document.getElementById('how').disabled=false;
			document.getElementById('cc').disabled=false;
			}
	
	}
//===================== Validation Here ===============================================
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(atm.value=="")
{
alert("Please Enter ATM ID");
atm.focus();
return false;
}
if(branch.value=="")
{
alert("Please select Branch");
branch.focus();
return false;
}

}
return true;
}

//======================================for city
function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

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

//======================================================================
function MakeRequest()

{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse3(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('state').value;
//alert(str);
  xmlHttp.open("GET", "get_city.php?state="+str, true);

  xmlHttp.send(null);

}
//==========================================================================
function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}


//=============================================================atm id data
function atmid(id,type)
{
//alert("Atm function"+id);
//alert(document.getElementById(id).value);
// alert("h");
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
    var s=xmlhttp.responseText;
   // alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		//document.getElementById("cust").value=s1[0];
		document.getElementById("bank").value=s1[1];
		document.getElementById("state").value=s1[2];
		document.getElementById("city").value=s1[3];
		document.getElementById("add").value=s1[4];
		document.getElementById("pin").value=s1[5];
		document.getElementById("area").value=s1[6];
		//document.getElementById("add").value=s1[7];
   //alert(s1[4]);
    }
  }
  
  //var str=document.getElementById(id).value;
 // var i=str.split('####');
  //if(str!="")
xmlhttp.open("GET","get_data2.php?atm="+id+"&type="+type,true);
//alert("get_data2.php?atm="+id+"&type="+type);
xmlhttp.send();
}



//=============================================================================type of alert
function alert_type(){
if(document.getElementById('call').value=='new')
{
	document.getElementById('assets').style.display='block';
}

else
{
	document.getElementById('assets').style.display='none';
	
}
}

//========================================================================assets===================
function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
}

//==================================================================================Assets
function assets(id,type)
{ 
//alert(po+" "+document.getElementById(po).value);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
		//alert(xmlHttp.responseText);
st=(xmlHttp.responseText);
str=st.split('###***')
//alert(str[0]+" "+str[1])
document.getElementById('assets').innerHTML='';
      document.getElementById('assets').innerHTML=str[0];
       document.getElementById('pcbpres').value=str[1];
    }
  }

 
  xmlHttp.open("GET", "get_asset2.php?id="+id+"&j="+type, true);
 // alert("get_asset2.php?id="+id);
//alert("get_asset2.php?i="+i[0]+"&j="+i[1]);
  xmlHttp.send();

}
//===================================================================================
function PO(id)
{ 
//alert(id);
//alert(po+" "+document.getElementById(po).value);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
//alert(xmlHttp.responseText);
      document.getElementById('ref').innerHTML=(xmlHttp.responseText);
    }
  }


  xmlHttp.open("GET", "get_reference2.php?po="+id, true);
//alert("get_reference2.php?po="+i[0]+"&cust="+customer+"&type="+i[1]);
  xmlHttp.send(null);

}

//=======================================================================
function HandleResponse4(response)
{

  document.getElementById('asset_div').innerHTML = response;

}
//=======================================================================get po no.
function Po_no()
{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
//alert(xmlHttp.responseText);
      HandleResponse4(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('cust').value;
//alert("get_po2.php?cust="+str);
  xmlHttp.open("GET", "get_po2.php?cust="+str, true);
//alert("get_po2.php?cust="+str);
  xmlHttp.send(null);

}

//============================================================================================
/*function HandleResponse4(response)
{
//alert(response);
  document.getElementById('po_no').innerHTML =  response;

}*/

//=============================================================================================
function GetRef(id,type)
{ 

//alert(id);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
if(xmlHttp.responseText==0)
{
alert("Invalid Refernce ID");
document.getElementById(id).value='';
}
else
{
//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("***");
//===================for customer selection Start =====================
var v;
v=str[0];
//alert(v);
for (i = 0; i < document.getElementById("cust").length; ++i){
	//alert(i);
    if (document.getElementById("cust").options[i].value == v){
		//alert(i);
     document.getElementById("cust").selectedIndex = i;
	
    }
}
//===================for customer selection End =====================

//==for Branch selection start========================================
var b;
b=str[10];
//alert(b);
for (i = 0; i < document.getElementById("branch").length; ++i){
		//alert(i);
    	if (document.getElementById("branch").options[i].value == b){
		//alert(i);
     	document.getElementById("branch").selectedIndex = i;
	
    	}
	}
//===================for Branch selection End========================================	

	var mySelect = document.getElementById('po_no'),
    newOption = document.createElement('option');

newOption.value = str[1];

// Not all browsers support textContent (W3C-compliant)
// When available, textContent is faster (see http://stackoverflow.com/a/1359822/139010)
if (typeof newOption.textContent === 'undefined')
{
    newOption.innerText = str[1];
}
else
{
    newOption.textContent = str[1];
}

mySelect.appendChild(newOption);

var atmsel= document.getElementById('ref'),
    newOption2 = document.createElement('option');

newOption2.value = id;
if(str[2]=='')
{
alert("Atm ID not present");
document.getElementById('submit').disabled=true;
}
// Not all browsers support textContent (W3C-compliant)
// When available, textContent is faster (see http://stackoverflow.com/a/1359822/139010)
if (typeof newOption2.textContent === 'undefined')
{
    newOption2.innerText = str[2];
}
else
{
    newOption2.textContent = str[2];
}

atmsel.appendChild(newOption2);
		document.getElementById("bank").value=str[3];
		document.getElementById("state").value=str[4];
		document.getElementById("city").value=str[5];
		document.getElementById("add").value=str[6];
		document.getElementById("pin").value=str[7];
		document.getElementById("area").value=str[8];	
		document.getElementById("tp").value=type;
		document.getElementById("ccemail").innerHTML=str[9];	

}
      //HandleResponse4(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
//var str=document.getElementById(id).value;
//alert(str);
//alert("get_po2.php?cust="+str);

  xmlHttp.open("GET", "get_ref3.php?ref="+id+"&type="+type, true);
//alert("get_ref3.php?ref="+id);
  xmlHttp.send(null);

}
</script>

<script type="text/javascript">
//===========================================================================================================
function history(id,type,atm,cid)
{
	//alert(id+" "+type);
	//alert(document.getElementById(what).value);

	//alert("hi");
document.getElementById('searchbar').innerHTML="<img src=loader.gif height=20px width=20px>";

//alert(what+" "+txt);
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
		var str=xmlhttp.responseText.split("##");
		
    document.getElementById('searchbar').innerHTML=str[0];
	//alert(str[1]);
	if(str[1]=='1')
	{
	alert("Call is still open for this ATM");
	document.getElementById('submit').disabled=true;
	}
    }
  }
//alert('type');
xmlhttp.open("get","gethistory.php?id="+id+"&type="+type+"&atm="+atm+"&cid="+cid,false);
//alert("gethistory.php?id="+id+"&type="+type+"&atm="+atm+"&cid="+cid);
xmlhttp.send();
}

//==========================================================================================
function searchval(what,val,call)
{
	//alert(what+" "+val);
	//alert(document.getElementById(what).value);
if(document.getElementById(what).value=='' ||document.getElementById(val).value=='' )
{
alert("Please provide both the data for searching");
}
else
{
	//alert("hi");
document.getElementById('searchbar').innerHTML="<img src=loader.gif height=20px width=20px>";
var what=document.getElementById(what).value;
var txt=document.getElementById(val).value;
//alert(what+" "+txt);
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
    document.getElementById('searchbar').innerHTML=xmlhttp.responseText;
    }
  }
   
 //alert("garmentgallery.php?cid="+id);
// alert("getcustdetail.php?id="+value+"&attr="+attr);

xmlhttp.open("get","servicesearch1.php?val="+txt+"&what="+what+"&calltype="+call,false);

//alert("servicesearch.php?val="+txt+"&what="+what+"&calltype="+call);
//alert("opd_his.php?id="+id+"&Page="+page);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
}
//===========================================================================================
function astselect(id)
{
//alert(id);
	var x=document.getElementById('ascn').value;
	//alert(x);
	//alert(id);
	//alert(document.getElementById(id).value);
	if(document.getElementById(id).checked==true)
	document.getElementById('ascn').value=1;
	elseif(document.getElementById(id).checked==false)
	document.getElementById('ascn').value=0;
	
	//alert(document.getElementById('ascn').value);
}

//==============================================================================================
function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}
</script>




<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 


function DDL_Problem(){

var ddlprob=document.getElementById('ddl_prob').value;

 //$("#prob").attr("value", "");
if(ddlprob=="Others"){

document.getElementById('prob').innerHTML=ddlprob;
  document.getElementById('prob').readOnly = false;
}else{

 document.getElementById('prob').innerHTML=ddlprob; 
  document.getElementById('prob').readOnly = true;
}

}

</script>

</head>

<body <?php if(isset($_GET['id'])){ ?>  onload="GetRef('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>');assets('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>');history('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>','<?php echo $_GET['atm'] ?>','<?php echo $_GET['cid'] ?>')" <?php } ?>>
<center>
<?php include("menubar.php"); ?>

<div align="center"><h2>Service Alert</h2></div><br />

<div id="header">
<table border="0" cols="res"><tr><td valign="top">

<?php 
  
           include("form/forms1.php");
      
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
			   include("myclass/service.class.php");
			   include("andi/GCM.php");
      $service=new Service();
       if($service->Process())        
       {
    //====If process fail=old call getting open=====So change the code
    
//$aidqry=mysqli_query($con1,"select max(alert_id) from alert where atm_id='".$_POST['ref']."'");
$cdate=date('Y-m-d');
$aidqry=mysqli_query($con1,"select max(alert_id) from alert where atm_id='".$_POST['ref']."' and date(entry_date) ='".$cdate."'");
           $aidrow=mysqli_fetch_row($aidqry);
           
           $req=$aidrow[0];
          // ================GPS delegation==========
          if($_POST['type']=='site')
	$at=mysqli_query($con1,"select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$_POST['ref']."'");
	elseif($_POST['type']=='amc')
	$at=mysqli_query($con1,"select atmid,latitude,longitude,address,city,state from Amc where amcid='".$_POST['ref']."'");
	
	$atro=mysqli_fetch_row($at);
	$atm_no=$atro[0];
	if ($atm_no=='') {$atm_no= $_POST['ref'];}
	
	
	if($atro[1]==0.0000000000)
	{
        $address=$atro[3].','.$atro[4].','.$atro[5];
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        //$data['latitude']  = $output->results[0]->geometry->location->lat; 
        //$data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        //print_r($output);
        //echo $data['latitude'];
        //echo $data['longitude'];
        
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 
        
        if($_POST['type']=='site')
	           mysqli_query($con1,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$_POST['ref']."'");
	    elseif($_POST['type']=='amc')
	           mysqli_query($con1,"update Amc set latitude='".$latitude."',longitude='".$longitude."' where amcid='".$_POST['ref']."'");
        
	}
    else
    {
        $latitude=$atro[1]; 
        $longitude=$atro[2];
    }
//=============Function for distnace ====================================

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}



//=======WhatsApp-------==========

$alertqry=mysqli_query($con1,"select * from alert where alert_id='".$req."' ");
$alertr=mysqli_fetch_row($alertqry);

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$alertr[1]."' ");
$custname=mysqli_fetch_row($custqry);

if ($alertr[21]=='site') { 
$atm1qry=mysqli_query($con1,"select atm_id, expdt from atm where track_id ='".$alertr[2]."' ");
$atmr=mysqli_fetch_row($atm1qry);
    $asstatus="Under Warranty. Expires on: ".$atmr[1];
    $atm_id=$atmr[0];
} 
elseif ($alertr[21]=='amc') {
$amcqry=mysqli_query($con1,"select atmid from Amc where amcid='".$alertr[2]."' ");
$amc=mysqli_fetch_row($amcqry);
$atm_id=$amc[0];
$atmqry=mysqli_query($con1,"select track_id from atm where atm_id ='".$atm_id."' ");

if(mysqli_num_rows($atmqry) > 0){
    $asset=mysqli_fetch_row($atmqry);

$batwarqry=mysqli_query($con1,"select * from site_assets where atmid='".$asset[0]."' and assets_name='Battery' order by site_ass_id DESC"); 
$bat=mysqli_fetch_row($batwarqry);
$bstatus=$bat[11];
$bexp=$bat[18];

if($bstatus==1) { $asstatus="UPS in AMC. Battery Under Warranty and Expires on: ".$bexp; }
else {$asstatus="UPS in AMC. Battery out of Warranty. Expired on: ".$bexp;}
} else {$asstatus="UPS in AMC. No any Battery supply";}

} else $asstatus="Chargeable or Temp Call"; 

if ($atm_id=='') {$atm_id= $alertr[2];}


if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}
        $MassageNew = "*Switching AVO Electro Power Ltd*";
        $Massage1 = "New Call Logged" ;
        $Massage2="*Customer Name:* ".$custname[0] ;
        $Massage3="*ATM Id:* ".$atm_no;
        $Massage4="*Ticket No:* ".$alertr[25] ;
        $Massage5="*End User:* ".$alertr[3] ;
        $Massage6="*Address:* ".$alertr[5];
        $Massage7="*Type Of Call:* ".$calltp;
        $Massage8="*Problem Reported:* ".$alertr[9];
        $Massage9="*Asset Status:* ".$asstatus;
        

  //=====If repeat call Stop delegation==================================

  $delegate_flag=0;
  
 $atm_id=$_POST['ref'];
 $cutoff_date=date('Y-m-d 00:00:00', strtotime('-30 days'));

$last="select alert_id, entry_date from alert where atm_id='$atm_id' and entry_date >'$cutoff_date' and entry_date < NOW() and call_status !='Rejected' order by alert_id DESC limit 5";

$sql2=mysqli_query($con1,$last);


if(mysqli_num_rows($sql2) > 0) {

 $rowre=mysqli_fetch_row($sql2);

 $repet=mysqli_query($con1,"update alert set repeat_callid='".$rowre[0]."' where alert_id='".$req."'");
  
} else {
   //=================WhatsApp data========= 

    //$radius = 20; // in miles
      $radius = 25*0.621371192; // in km

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
 
 //==== Using Engr Current Location========   
   /* $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM engg_current_location WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) ORDER BY distance"; */
   //=======or Engineer Residence========
   
   $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM area_engg WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and status=1 ORDER BY distance";
   
 
    $res=mysqli_query($con1,$qry);
    $num=mysqli_num_rows($res);
    if($num>0){
        $row=mysqli_fetch_row($res);
        
$englat=$row[18];
$englong=$row[19];


if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
} 
        
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));
         $delegate_flag=1;

$tab=mysqli_query($con1,"update alert set status='Delegated',call_status='1',eta='".$etdt."', convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
	
		$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$row[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
                }
                if($tab2){
              echo "Successfully Delegated"; 
                }
                
    mysqli_query($con1,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',1,'".$ctime."')");
  
  
                
                $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where pid='".$row[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
   
   
   //===============Whatsapp message======================== 
 $engqry=mysqli_query($con1,"select phone_no1,engg_name from area_engg where engg_id='".$row[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
$engg_name=$engph[1];
       
        $Massage1="[GPS]You have New Alert !!";
        
    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;
   
 SendWhatmsg($mobile,$Message);
    
    
    }
    //========== GPS delegation ends======== Delegation from History starts
    if($delegate_flag==0){
   
      $delqry=mysqli_query($con1,"SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `alert_id` in(select `alert_id` from alert where atm_id='".$_POST['ref']."' and assetstatus='".$_POST['type']."') group by engineer order by cnt desc");
      
      $bidqry=mysqli_query($con1,"select branch_id from alert where alert_id='".$req."'");
      $bidrow=mysqli_fetch_row($bidqry);
      $branch_id=$bidrow[0];
      $delegate_flag=0;
       while($delrow=mysqli_fetch_row($delqry))
       {
        $enqry=mysqli_query($con1,"select * from area_engg where engg_id='".$delrow[0]."' and area='".$branch_id."' and status=1"); 
        if(mysqli_num_rows($enqry)>0)
        {  // delegate
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));

 $engrow=mysqli_fetch_row($enqry);      
$englat=$engrow[18];
$englong=$engrow[19];


if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
}  
         
         $delegate_flag=1;
$tab=mysqli_query($con1,"update alert set status='Delegated',call_status='1',eta='".$etdt."',convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$delrow[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
                }
                if($tab2){
              echo "Successfully Delegated"; 
                }
                
                mysqli_query($con1,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',2,'".$ctime."')");
            
            $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where pid='".$delrow[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    //===========WhatsApp for History del============
  $engqry=mysqli_query($con1,"select  phone_no1, engg_name from area_engg where engg_id='".$delrow[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
 $engg_name=$engph[1];
       
        $Massage1="[H]You have New Alert !!";
      
    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;
    
 SendWhatmsg($mobile,$Message);
    
  break;
        }
        else
        continue;        
       }
    }
    // Delegation from History Ends
      //============Engr Mapping with engr_site_map Table=======================
       if($delegate_flag==0){
           
        if($_POST['type']=='site')
	$qrymap=mysqli_query($con1,"select engg_id from engg_site_mapping_warr where atm_='".$_POST['ref']."' and engg_id in (select engg_id from area_engg where status=1)");
	elseif($_POST['type']=='amc')
	$qrymap=mysqli_query($con1,"select engg_id from engg_site_mapping where atm_id='".$_POST['ref']."' and engg_id in (select engg_id from area_engg where status=1)");
	
       if($fetchmap= mysqli_fetch_array($qrymap)) {
           if($fetchmap[0]!=0){
    $engqrye=mysqli_query($con1,"select latitude,longitude from area_engg where engg_id='".$fetchmap[0]."'");

$englatrow=mysqli_fetch_row($engqrye);           
$englat=$englatrow[0];
$englong=$englatrow[1];

if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
} 
           $delegate_flag=1;
           
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));
         
         $tab=mysqli_query($con1,"update alert set status='Delegated',call_status='1',eta='".$etdt."',convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$fetchmap[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
        
                }
                if($tab2){
              echo "Successfully Delegated"; 
                }
                
                mysqli_query($con1,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',3,'".$ctime."')");
                
            $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where pid='".$fetchmap[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);

//================WhatsApp for Mapping sites===========  
  $engqry=mysqli_query($con1,"select phone_no1, engg_name from area_engg where engg_id='".$fetchmap[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
 $engg_name=$engph[1];

$Massage1="[Map]You have New Alert !!";
        

    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;   
 SendWhatmsg($mobile,$Message);
    
    
            break;
           }
        }
           
       }
      
       } 
    //==============Delegation end   Cust whatsApp start here====================          
$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;
    
 if($delegate_flag==1){
$cmessage="*[A]Call is Logged and Delegated to:* ".$engg_name;
$cmmessage="*Mobile No:* ".$mobile;
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

SendWhatmsg($whats_no,$allMessage);
  } else {

$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;

$cmessage="*Call is Logged with Us !!*" ;
$cmmessage="*Engineer Will be deligated shortly* ";
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

SendWhatmsg($whats_no,$allMessage);     
      
  }       


       }
       else
       {
            ?>
            <div class="errors">
            <?php
         $service->ShowErrors();      

   //  echo "hii";
       ?></div>
      
       <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form" onsubmit="return validate(this)" >


<?php //echo $_POST['po'] ?>

<div id="" style="display:block;">
<table border="0" >
<!--<tr><td>
Select Alert Type : </td>
<td width="221" colspan="2">
<select name="alerttype" id="alerttype" onchange="PCB();" style="width:200px">


<option value="AMC">AMC</option>
<option value="PCB">Per Call Basis</option>


</select>

</td></tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td ><input type="text" name="appby" id="appby" /></td>
<td valign="top">Reason:<textarea name="how" id="how" /></textarea></td>
</tr></div>-->
<tr>
<td height="35">Subject: <input type="text" name="sub" id="sub" value="<?php echo $_POST['sub']; ?>" /></td>
<td colspan="3">Client Docket number:



<input type="text" name="docket" id="docket" value="<?php echo $_POST['docket']; ?>" /></td>
</tr>
<tr><td width="110">
Select Customer : </td>
<td width="190">
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">

<?php
$qry1=mysqli_query($con1,"select * from customer");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" <?php  if(($_POST['cust'])==$row[0]){ ?>
selected="selected" <?php }  ?>><?php echo $row[1]; ?></option>


<?php } ?>
</select>

</td>

<td width="93">Select PO NO:	
<?php 
echo $_POST['po'];
//$asst=	explode("####",$_POST['po']);
//echo $asst[0];
?>
<select name="po" onchange="PO(this.value);" id="po_no"><option value=''>Select PO</option>

<option value="<?php   echo $_POST['po'];  ?>" selected="selected"><?php  echo $_POST['po']; ?></option>
<?php  ?>
</select>

</td> 
</tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<tr><td>Atm ID</td><td colspan="3" id="reference">
<?php

if($_POST['type']=="amc")
$st="select atmid from Amc where amcid='".$_POST['ref']."'";
//echo "select atmid from Amc where amcid='".$_POST['ref']."'";

 if($_POST['type']=="site")
$st="select atm_id from atm where track_id='".$_POST['ref']."'";

//echo $st;
?>
<select name="ref" id="ref" onchange="">
<?php 
$today=new DateTime(date("Y-m-d"));
$pcb='';
$at='';

$qry=mysqli_query($con1,$st);
$roqry=mysqli_fetch_row($qry);
?>
<option value="<?php  echo $_POST['ref']; // $_POST['ref']; ?>" selected="selected"><?php  echo $roqry[0]; ?></option>

</select></td></tr>
<tr>
<td height="35">Assets : </td>
<td id="assets" colspan="2" >


<table class="">

<tr><th>Sr No</th><th>Assests with specification</th><th>Warranty</th></tr>

<?php
 //echo $_POST['ref']." ".$asst[1];
 if(isset($_POST['ref'])){ 
 //echo $_POST['ref']." ".$asst[1];
 $cnt=0;
  if($_POST['type']=="amc")
{
//echo "SELECT * FROM amcassets where amcpoid='".$asst[0]."'";
$res=mysqli_query($con1,"SELECT * FROM amcassets where siteid='".$_POST['ref']."'");
//echo "SELECT * FROM amcassets where siteid='".$id."'";

while($atmrow=mysqli_fetch_array($res)){ 
//echo "select * from assets_specification where ass_spc_id='".$atmrow[2]."'";
$qry2=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$atmrow[2]."'");
$row=mysqli_fetch_row($qry2);
//echo "select * from assets where assets_id='".$row[1]."'";
$qry3=mysqli_query($con1,"select * from assets where assets_id='".$row[1]."'");
$row2=mysqli_fetch_row($qry3);
//echo "select * from amcpurchaseorder where amcsiteid='".$id."'";
$qry=mysqli_query($con1,"select * from amcpurchaseorder where amcsiteid='".$_POST['ref']."'");
$row3=mysqli_fetch_row($qry);
//echo "exp".$row3[4];
 $expdt=new DateTime($row3[4]);
 //echo $expdt->format("Y-m-d"); 
?>

<tr><td><?php echo $cnt+1; ?></td>
<td><input type="checkbox" name="assets[]" id="assets[]" onClick="astselect('assets<?php echo $cnt ?>');"  />
<input type="hidden" name="assid[]" value="<?php echo $row[0]; ?>" /><?php echo $row2[1]." (".$row[2].")"; ?></td>
<td><?php if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) { echo "Under AMC<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {
 if($pcb!='pcb')
 $pcb='pcb';
echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } ?></td></tr>

<?php
$cnt=$cnt+1;
}
?>
<input type="hidden" name="type" value="amc" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}
elseif($_POST['type']=="site")
{
$id=$_POST['ref'];
//echo "hi";
$qry4=mysqli_query($con1,"select atm_id,podate from atm where track_id='".$id."'");
	$ro4=mysqli_fetch_row($qry4);
	//echo "select * from installed_sites where Ref_id='".$ro4[0]."'";
//echo "select * from installed_sites where Ref_id='".$ref."'";
//$qry=mysqli_query($con1,"select * from installed_sites where Ref_id='".$ro4[0]."'");
//echo "select * from site_assets where atmid='".$id."'";
$qry=mysqli_query($con1,"select * from site_assets where atmid='".$id."'");	
while($row=mysqli_fetch_array($qry))
{
//echo "select * from assets_specification where ass_spc_id='".$row[4]."'";
	
	$dt=explode(",",$row[5]);
	
	
	$qry2=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$row[4]."'");
$ro=mysqli_fetch_row($qry2);
//echo "select * from assets where assets_id='".$ro[1]."'";
$qry3=mysqli_query($con1,"select * from assets where assets_id='".$ro[1]."'");
$row2=mysqli_fetch_row($qry3);

//echo $ro4[1];
$date = strtotime(date("Y-m-d", strtotime($ro4[1])) . " +$dt[0] month");
 $dt2 =date('Y-m-d',$date);

//echo $date = date("Y-m-d", strtotime($ro4[1] +$dt[0]." months"));
$expdt=new DateTime($ro4[1]);
//echo $today->format("Y-m-d");
// echo $expdt->format("Y-m-d");
// echo $row[0];
?>
<tr><td><?php echo $cnt+1; ?></td><td><input type="checkbox" name="assets[]" id="assets<?php echo $cnt; ?>" onClick="approval('pcb',this.id);" value="<?php echo $row[0]; ?>"  />
<input type="hidden" name="assid[]" value="<?php echo $row[0]; ?>" />
<?php echo $row2[1]." (".$ro[2].")"; ?></td><td><?php if(date('Y-m-d')<=$dt2) { echo "UW<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {
if($pcb!='pcb')
 $pcb='pcb'; 
echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } 

?></td></tr>
<?php 
 $cnt=$cnt+1;
}
?>
<input type="hidden" name="type" value="site" id="tp" />

<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}

 }
?></table>
</td>
</tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="2"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="2"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="2"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>
<!----================Branch=======----------->
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<select id="branch" name="branch" required="true">

<option value="">Select</option>
<?php
$qrystate=mysqli_query($con1,"select * from avo_branch");
while($qrystate1=mysqli_fetch_row($qrystate)){
?>

<option value="<?php echo $qrystate1[0]; ?>" <?php  if(($_POST['branch'])==$qrystate1[0]){ ?>
selected="selected" <?php }  ?>><?php echo $qrystate1[1]; ?></option>

<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">Address:</td>
<td colspan="2"><textarea name="add" id="add"  rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="2"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="2"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>
<!-- <tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if(isset($_POST['adate'])){ echo $_POST['adate']; } else { echo date('d/m/Y'); } ?>" /></td>
</tr>-->



<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname"  value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" onkeypress="return isNumber(event)" maxlength="10"  value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Type Of Call : </td>
<td colspan="3">
<select name="type_call" id="type_call" onchange="pmdisable(this.value);">
<option value="service">Service Call</option>
<option value="pm">PM Call</option>
<option value="dere"> De-Re Installation</option>
</select>
</td>
</tr>

<tr>
<!--<td height="35">Problem : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>-->

<td><label>problems:</label></td>
<td><select class="form-control" id="prob"  name="prob">
             <option value="">Select</option>
             <option value="UPS Not Working">UPS Not Working</option>
             <option value="Low Backup Issue">Low Backup Issue</option>
             <option value="Earthing Issue">Earthing Issue</option>
             <option value="Joint Visit">Joint Visit</option>
             <option value="Noice In UPS">Noice In UPS</option>
             <option value="UPS Output Issue">UPS Output Issue</option>
              
      </select></td>

</tr>


<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>

<tr>
<td height="35">WhatsApp Group: </br> Enter only whatsApp numbers</td>
<td colspan="3"><?php
include ("config.php");
$whatcc=mysqli_query($con1,"select a.id,a.groupname, b.cust_name from whatsapp_groupname a,customer b where a.cust_id=b.cust_id and a.status=1 and b.cust_id = '".$_POST['cust']."' and a.type='service' order by a.groupname ASC");

$whatarray=array();
?>
<input type="checkbox" name="whatsgrp" id="whatsgrp" checked>
<select name='whatsgroup' id='whatsgroup' onchange="getno(this.value);">
<option value=""> Select Groups</option>
<?php
while($whatsrow=mysqli_fetch_row($whatcc))
{
?>
<option value="<?php echo $whatsrow[0]; ?>"><?php echo $whatsrow[2]." - ".$whatsrow[1]; ?></option>
<?php
}
?>
</select>

<textarea name="whatsno" id="whatsno"  onkeypress="CheckNumeric(event);" rows=3 cols=25><?php if(isset($_POST['whatsno'])){ echo $_POST['whatsno']; } ?></textarea></td>
</tr>

<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 order by c.cust_name,e.bank ASC");
?>
<input type="checkbox" name="sendmail" id="sendmail" checked>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select><textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>

<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if(isset($_POST['appby'])){ echo $_POST['appby']; } ?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $_POST['crby']; ?>" />
</td>

</tr></div>	
<tr>
<td height="35" colspan="4"><input type="submit" value="submit" class="readbutton" id="submit" /></td>
</tr>

</table>
</div>
</form>
       <?php
      

       }
       }
       else
       {
      
      

       ServiceForm("NULL",$_SESSION['user']); 
      
      
		  
 } ?>

</td><td valign="top">

<table border="0"><tr><td>
<select name="searchby" id="searchby">
<option value="">Search By</option>
<option value="atmid">Site ID</option>
<option value="add">Address</option>

</select>
</td></tr><tr><td><input type="text" name="search" id="search" /></td></tr>
<tr><td><input type="button" name="searchbtn" id="searchbtn" value="Search" onclick="searchval('searchby','search','service');" /></td></tr>
<tr style="display:block"><td><div style=" width:208px; height:770px; overflow:auto;" id="searchbar"></div></td></tr></table></td></tr></table></div>

</center>

</body>
</html>
