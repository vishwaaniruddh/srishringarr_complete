<?php
//include("access.php");
// include("config.php");
include("db_connection.php");
//include("Whatsapp_delegation/delegation_fun_test.php");
// echo $_SESSION['user'];

$con1 = OpenCon1();

if($con1){echo 1; } else { echo 0; } 

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
<table border="0" cols="res">
    <tr>
        <td valign="top">
<?php 

include("form/forms1_test.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    // echo "hii";
include("myclass/service.class_test.php");
include("andi/GCM.php");
$service=new Service();
if($service->Process())        
{
    //====If process fail=old call getting open=====So change the code
            
        //$aidqry=mysqli_query($con1,"select max(alert_id) from alert where atm_id='".$_POST['ref']."'");
        $cdate=date('Y-m-d');
        $aidqry=mysqli_query($con1,"select max(alert_id) from alert where atm_id='".$_POST['ref']."' and date(entry_date) ='".$cdate."'");
        $aidrow=mysqli_fetch_row($aidqry);
        echo $aidqry; 
        $req=$aidrow[0];
        
        if($_POST['type']=='site'){
           $at=mysqli_query($con1,"select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$_POST['ref']."'");
        }elseif($_POST['type']=='amc'){
           $at=mysqli_query($con1,"select atmid,latitude,longitude,address,city,state from Amc where amcid='".$_POST['ref']."'");
        }
        
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
            
            if($_POST['type']=='site'){
                   mysqli_query($con1,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$_POST['ref']."'");
            }elseif($_POST['type']=='amc'){
                   mysqli_query($con1,"update Amc set latitude='".$latitude."',longitude='".$longitude."' where amcid='".$_POST['ref']."'");
            }
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
        // include_once 'andi/GCM.php';
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
        // include_once 'andi/GCM.php';
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
        // include_once 'andi/GCM.php';
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
            
            
                    // break;
                   }
                }
                   
               }
              
               } 
            //==============Delegation end   Cust whatsApp start here====================
    
}


    
} else{
     ServiceForm("NULL",$_SESSION['user']); 
}


?>

 </td>
<td valign="top">

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