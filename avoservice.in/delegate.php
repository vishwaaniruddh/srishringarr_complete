<?php
include("access.php");
session_start();

if($_SESSION['designation']==4) {
    echo "You are not authorised to do this";
    die;
}
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delegate Call</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function validate(form)
{
with(form)
{
var x=document.getElementById('eng').value;
 	if(x=='0')
  	{
   	alert("Please Select Engineer");
   	eng.focus();
  	return false;
  	}

  	//===function call for ETA should not be before call log time ========
validlogtime();

//ETA validation
if(est.value=='')
  	{
   	alert("Please Select ETA");
   	est.focus();
  	return false;
  	}
//ETA time
if(time.value=='')
  	{
   	alert("Please Select Time");
   	time.focus();
  	return false;
  	}
//ETA time
if(min.value=='')
  	{
   	alert("Please Select Min");
   	min.focus();
  	return false;
  	}

//ETA AM or PM
if(meri.value=='')
  	{
   	alert("Please Select AM or PM");
   	meri.focus();
  	return false;
  	}
//==============For cat-DB

var alerttp=document.getElementById('alerttp').value;
var custdoc=document.getElementById('custdoc').value;
//alert(alerttp.value);
if(document.getElementById('alerttp').value!="new type"){
 if(document.getElementById('alerttp').value=='service' || document.getElementById('alerttp').value=="new" && (document.getElementById('custdoc').value=="site" || document.getElementById('custdoc').value=="amc"))
  {
var x1=document.getElementById('categ').value;

  if(x1=='0'){
   alert("Please Select Category from your Site");
   categ.focus();
  return false;
  }
}
  }

return true;
}
}
//================FUNCTION OF CHECKING, ETA TIME IS NOT BEFORE LOG time====

function validlogtime(){

logtime=document.getElementById('restime').value;
//alert(logtime);
dateSecond = document.getElementById('est').value.split('/');
rhour=document.getElementById('time').value;
rminute=document.getElementById('min').value;

var resdate = new Date(dateSecond[2], dateSecond[1], dateSecond[0]); //Year, Month, Date

	var dd = resdate.getDate(); //alert(dd);
            var mm = resdate.getMonth(); //alert(mm);
            var yyyy = resdate.getFullYear();//alert(YYYY);

	if(document.getElementById('meri').value=='pm'){
		rhour=12+parseInt(rhour);
		var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;
		var restime=document.getElementById('restime').value;

			if( Date.parse(resdatenew) <= Date.parse(restime )) {
    						alert("You Can Not Give ETA Time Befor "+ restime+" Call Log Time . Please try again...");
					document.getElementById('est').value="";
					document.getElementById('time').value="";
					document.getElementById('min').value="";
					document.getElementById('meri').value="";
					document.getElementById('est').focus();

				}else{
						//alert("ok");
					}

	}else{
		var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;

		var restime=document.getElementById('restime').value;

			if( Date.parse(resdatenew) <= Date.parse(restime )) {
    						alert("You Can Not Give ETA Time Befor "+ restime+" Call Log Time . Please try again...");
					document.getElementById('est').value="";
					document.getElementById('time').value="";
					document.getElementById('min').value="";
					document.getElementById('meri').value="";
					document.getElementById('est').focus();

				}else{
						//alert("ok");
					}
		}

}


//===========================ajax call for selection of eng onchange of branch===========

function myengshow(val)
{
alert(val);
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
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getenggdetail.php?brid="+val,true);
xmlhttp.send();
}
</script>
</head>

<body>
<center><?php include("menubar.php"); ?>
<h2>Delegate Alert</h2>
<div id="header">
<form action="process_delegation_andi.php" method="post" name="form" onsubmit="return validate(this);">
<table border="1">
<?php

 include_once('../class_files/select.php');
include('config.php');

$stateid1=$_GET['state'];
 $req=$_GET['req'];
 $atm=$_GET['atm'];
 $_city_name = $_GET['city'];
 
// echo "State:".$stateid1;

//==================SELECT entry_date FROM ALERT TABLE===============
$logcal_time=mysqli_query($con1,"select `entry_date` from `alert` where `alert_id`='".$_GET['req']."' ");
$logcal_time1=mysqli_fetch_row($logcal_time);
//echo $logcal_time1[0];
$logcal_timenew=date('m/d/Y H:i',strtotime(str_replace('-','/',$logcal_time1[0])));//echo $logcal_timenew;
  ?>
               <input type="hidden" name="restime" id="restime" value="<?php echo $logcal_timenew; ?>"  />


<?php

$cityid=mysqli_query($con1,"select `city_id` from `cities` where `city`= '".$_city_name."'");
 $cityid1=mysqli_fetch_row($cityid);

//==============SELECT BRANCH ID FROM STATE TABLE=====================================
$bran=array();

//if($_GET['br']!='all')

if ($_SESSION['branch'] !='all')
{
$br1= $_SESSION['branch'];

}else{
  $br1 = $stateid1;
}
//echo $br1;

//==============SELECT STATE ID FROM STATE TABLE=====================================
$state_id=mysqli_query($con1,"select state_id from state where branch_id in(".$br1.")");
while($staterow=mysqli_fetch_array($state_id))
{
$statid[]=$staterow[0];
}
$stateid3=implode(",",$statid);
$stateid2=str_replace(",","','",$stateid3);
$stateid2="'".$stateid2."'";
//=============================Function for distnace ====================================
//echo "Distanmce before";
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


//echo "after";

if($_GET['br']=='all' || $_SESSION['branch']==0)

$sql="select engg_id,engg_name,area,city,engg_desgn, latitude, longitude from area_engg where status=1 order by engg_name ASC";
else

$sql="select `engg_id`,`engg_name`,`area`,`city`, `engg_desgn`, latitude, longitude from `area_engg` where area in (".$br1.") and `status`=1 order by engg_name ASC";

//echo $sql;

$engg=mysqli_query($con1,$sql);

if(!$engg)
echo "failed".mysqli_error($con1);


//echo "select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type, a.assetstatus, c.cust_name,a.branch_id,a.custdoctno from alert a,customer c where a.alert_id='".$req."' and a.cust_id=c.cust_id";
$alert=mysqli_query($con1,"select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type, a.assetstatus, c.cust_name,a.branch_id,a.custdoctno from alert a,customer c where a.alert_id='".$req."' and a.cust_id=c.cust_id");


$alertro=mysqli_fetch_row($alert); 

$sitelat=$alertro[13];
$sitelong=$alertro[14];

//echo $alertro[8]."Site Type:".$alertro[9];

if($alertro[9] !='' or $alertro[9] != NULL) {
if($alertro[9] ==  'amc')
   { $atm=mysqli_query($con1,"select atmid, latitude1, longitude1 from Amc where amcid='".$alertro[2]."'");
    echo "select atmid, latitude, longitude from Amc where amcid='".$alertro[2]."'";
   }
else if($alertro[9] == 'site'){
$atm=mysqli_query($con1,"select atm_id, latitude1, longitude1 from atm where track_id='".$alertro[2]."'");
echo "select atm_id, latitude, longitude from atm where track_id='".$alertro[2]."'";
} 

if(mysqli_num_rows($atm)>0){
$atmro=mysqli_fetch_row($atm);

$sitelat=$atmro[1];
$sitelong=$atmro[2];
}
} 
//echo "site details";
?>

<tr><th>Client</th><td><?php echo $alertro[10]; ?></td><th>Site/Sol/ATM ID</th><td><?php echo $atmro[0]; ?></td></tr>
<tr><th>Docket No.</th><td><?php echo $alertro[0]; ?></td><th>End User</th><td><?php echo $alertro[3]; ?></td></tr>
<tr><th valign="top">Address</th><td valign="top"><?php echo nl2br($alertro[4]); ?></td><th valign="top">Problem</td><td valign="top"><?php echo nl2br($alertro[6]); ?></td></tr>

<!--For Branch Selection-->
<?php
if($_GET['br']=='all' || $_SESSION['branch']==0){
?>
<tr>
<td>Select Branch</td>
<td>
<!--<select name="branch" id="branch" onchange="myengshow(this.value);"> -->

<select name="branch" id="branch" >
<option value="0">Select Branch</option>
<?php
$branch_avo=mysqli_query($con1,"select * from `avo_branch`");
while($branch_avo1=mysqli_fetch_row($branch_avo)){
?>
    <option value="<?php echo $branch_avo1[0]; ?>"><?php echo $branch_avo1[1]; ?></option>
<?php
}
?>
</select>
</td>

<td></td>
<td></td>
</tr>
<?php } ?>
<tr>
<th height="35">Delegate Call To :(Mandatory) </th>

<td>
<!-- ===============SELECT ALL ENGINEERS FROM  "area_engg" ==== STATE BY HERE ==================================== -->
<div id="myDiv">
  <select name="eng" id="eng" >
<option value="0">select</option>
    <?php
while($row=mysqli_fetch_row($engg)){
    
    //==============Distance==============
$englat=$row[5];
$englong=$row[6];


if ($sitelat =='0.00' || $sitelat=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $sitelat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($sitelat, $sitelong, $englat, $englong, "K"); 
$dis=$dis1." KMs";
} 

$q2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);

$eng=$row[0].",".$dis;
?>
    <option value="<?php echo $eng; ?>"> <?php echo $row[1]."/ Distance: ".$dis." (".$row[4]."-".$r2[0].")"; ?></option>
    <?php
}
?>
  </select>
</div>

</td>
<th>Call Logged On</th><td><?php echo date('d/m/Y h:i:s a',strtotime($alertro[7])); ?></td>
<!--</tr>
<tr><th>ETA</th><td colspan="3"><input type="text" name="est" id="est" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time"><option value="">Select hrs</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>
<select name="min" id="min"><option value="00">Select minutes</option>
<?php
for($i=0;$i<60;$i++)
{
if($i%5==0){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select></td></tr>
<?php
//if($alertro[8]=="new" && ($alertro[9]=="site" || $alertro[9]=="amc"))
//{
?>
<tr>


<td>Add Category</td>
<td>
<select name="categ" id="categ">
<option value="0">Select Category</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="E">E</option>
</select>
</td>
</tr> -->
<?php
//} 
?>
<tr>
<th height="35" colspan="4" align="center">
<input type="hidden" name="req" value="<?php echo $req ?>" readonly />
<input type="hidden" name="atm" value="<?php echo $alertro[2]; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" id="brnch" name="brnch" value="<?php echo $alertro[11]; ?>">
<input type="hidden" id="alerttp" name="alerttp" value="<?php echo $alertro[8]; ?>">
<input type="hidden" id="custdoc" name="custdoc" value="<?php echo $alertro[9]; ?>">
<input type="hidden" id="distance" name="distance" value="<?php echo $dis; ?>">


<input type="submit" value="submit" class="readbutton" name="delegate" /></th>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>