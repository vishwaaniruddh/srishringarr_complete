<?php
include("access.php");
include("config.php");
//echo $_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user'];  ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
	function validate(form_non){
		//alert("hi");
		 with(form_non)
		 {
		//alert("hi2");
		var numbers = /^[0-9]+$/;  
		if(branch_avo.value=='0')
		{
		alert("Please select Branch");
		branch_avo.focus();
		return false;
		}
		if(atm.value=="")
		{
		alert("Please Enter ATM ID");
		atm.focus();
		return false;
		}
		
	}
	return true;
}

//===============================================for city
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

//============================================================================
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
//===================================================================================
function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}


//================atm id data =============================================================
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
    //alert(s);
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



//================type of alert ==============================================================
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

//==============================assets =========================================================
function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
}

//==============================Assets====================================================
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

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
//var str2=document.getElementById(po).value;
//var i=str2.split('####');
//alert(i[0]+" "+i[1]);
  xmlHttp.open("GET", "get_asset2.php?id="+id+"&j="+type, true);
 // alert("get_asset2.php?id="+id);
//alert("get_asset2.php?i="+i[0]+"&j="+i[1]);
  xmlHttp.send();

}

//====================================================================================================
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

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
//var str2=document.getElementById(po).value;
//var customer=document.getElementById(cust).value;
//var i=str2.split('####');
//alert(i[0]+" "+i[1]);
  xmlHttp.open("GET", "get_reference2.php?po="+id, true);
//alert("get_reference2.php?po="+i[0]+"&cust="+customer+"&type="+i[1]);
  xmlHttp.send(null);

}

//====================================================================================
function HandleResponse4(response)

{

  document.getElementById('asset_div').innerHTML = response;

}
//===get po no.=======================================================================
function Po_no(){ 
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
//=============================================================================
function HandleResponse4(response){
  //alert(response);
  document.getElementById('po_no').innerHTML =  response;
}

//===============================================================================
function GetRef(id,type)
{ 

//alert(type);
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

//==for Branch selection========================================
var b;
b=str[10];
//alert(b);
for (i = 0; i < document.getElementById("branch_avo").length; ++i){
		//alert(i);
    	if (document.getElementById("branch_avo").options[i].value == b){
		//alert(i);
     	document.getElementById("branch_avo").selectedIndex = i;
	
    	}
	}
//==for State selection ========================================
var b;
state=str[4];
//alert(b);
for (i = 0; i < document.getElementById("state").length; ++i){
		//alert(i);
    	if (document.getElementById("state").options[i].value == state){
		//alert(i);
     	document.getElementById("state").selectedIndex = i;
	
    	}
	}	
//======================================================	
	var mySelect = document.getElementById('po_no'),
    newOption = document.createElement('option');
	newOption.value = str[1];
	document.getElementById('po_no').value=str[1];

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
		document.getElementById("type").value=type;	
		document.getElementById("atmid_send").value=str[2];
		bb=document.getElementById("amcid1").value=str[11]; //alert(bb);
		aa=document.getElementById("sertype").value=str[12];//alert(aa);
		document.getElementById("bank").value=str[3];
		//document.getElementById("state").value=str[4];
		document.getElementById("city").value=str[5];
		document.getElementById("add").value=str[6];
		document.getElementById("pin").value=str[7];
		document.getElementById("area").value=str[8];
		document.getElementById("cat").value=str[13];
		document.getElementById("stdate").value=str[14];	
		document.getElementById("tp").value=type;
		//document.getElementById("ccemail").innerHTML=str[9];
			
		
		

}
      //alert(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
//var str=document.getElementById(id).value;
//alert(str);
//alert("get_po2.php?cust="+str);
  //alert("get_ref3.php?ref="+id+"&type="+type);
  xmlHttp.open("GET", "get_ref3.php?ref="+id+"&type="+type, true);
//alert("get_ref3.php?ref="+id);
  xmlHttp.send(null);

}


</script>
<script type="text/javascript">
//=================================================HISTORY=====================================================================
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

xmlhttp.send();
}

////////////////====================================================SERVICE SEARCH ===============================================
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
document.getElementById('searchbar').innerHTML="<img src=ajax-loader.gif height=20px width=20px>";
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

xmlhttp.open("get","non_deploysearch.php?val="+txt+"&what="+what+"&calltype="+call,false);

//alert("servicesearch.php?val="+txt+"&what="+what+"&calltype="+call);
//alert("opd_his.php?id="+id+"&Page="+page);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
}

//===================================================================ASSETS ======================
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
function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}
</script>
</head>

<body 
<?php if(isset($_GET['id'])){ ?>  onload="GetRef('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>');assets('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>');history('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>','<?php echo $_GET['atm'] ?>','<?php echo $_GET['cid'] ?>')" <?php } ?>>

<?php 
//echo "cust=".$_POST['cust']."<br>"; 
//echo "br=".$_POST['branch'];
?>

<center>
<?php include("menubar.php"); ?>

<div id="header">
<h2 class="h2color">Non Deployment</h2>

<table border="0" cols="res"> <tr> <td valign="top">
		<?php 
       		include("form/forms.php");
       	?>
       
        <?php
       if($_SERVER['REQUEST_METHOD']=='POST'){
			   	include("myclass/service.class.php");
			   	include("andi/GCM.php");
      			$service=new Service();
				
       		if($service->Process()){       
      
  
       			}else{      
            ?>
            <div class="errors">
            <?php
         		$service->ShowErrors();      
       		?>
       </div>

<form action="process_nonDeployment.php" method="post" name="form_non" onsubmit="return validate(this)" >

<div id="" style="display:block;">
<table border="0" >
<!--<tr><td>
Select Alert Type : </td>
<td width="221" colspan="2">
<select name="alerttype" id="alerttype" onchange="PCB();;" style="width:200px">


<option value="AMC">AMC</option>
<option value="PCB">Per Call Basis</option>


</select>

</td></tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td ><input type="text" name="appby" id="appby" /></td>
<td valign="top">Reason:<textarea name="how" id="how" /></textarea></td>
</tr></div>-->

<tr><td width="110">
Select Customer : </td>
<td width="190">
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">

<?php
//echo "cust=".$_POST['cust'];
$qry1=mysql_query("select * from customer");
while($row=mysql_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" <?php  if(($_POST['cust'])==$row[0]){ ?>
selected="selected" <?php }  ?>><?php echo $row[1]; ?></option>


<?php } ?>
</select>

</td><td width="93">Select PO NO:	

<!--<select name="po" onchange="PO(this.value);" id="po_no">
<option value=''>Select PO</option>
<option value="<?php   echo $_POST['po'];  ?>" selected="selected"><?php  echo $_POST['po']; ?></option>
</select>-->

<input type="text" name="po" id="po_no" value="<?php  echo $_POST['po']; ?>" onchange="PO(this.value);" />
</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<?php
//echo "hello";
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','hav_acc','Myaccounts123*','hav_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");
?>
<tr><td>Atm ID</td><td colspan="3" id="reference">
<?php
//echo "select atm_id from atm where amcid='".$_POST['ref']."'"." ".$_POST['type'];
if($_POST['type']=="amc")
$st="select atmid from Amc where amcid='".$_POST['ref']."'";
elseif($_POST['type']=="site")
$st="select atm_id from atm where track_id='".$_POST['ref']."'";

echo $st;
?>

<select name="ref" id="ref" onchange="">
<?php 
$today=new DateTime(date("Y-m-d"));
$pcb='';
$at='';

$qry=mysql_query($st);
$roqry=mysql_fetch_row($qry);
?>
<option value="<?php  echo $_POST['ref']; ?>" selected="selected"><?php  echo $roqry[0]; ?></option>

</select>

</td></tr>
<!--======================================= START ASSETS SHOW HERE============================================================-->
<tr>
<td height="35">Assets : </td>
<td id="assets" colspan="2" >


<table width="100%" bordercolor="#000" border="1">
<?php
//================================For Amc=========================================================================
if(strcasecmp($po,"amc")==0){
	
	$res=mysql_query("SELECT * FROM amcassets where siteid='".$id."'");
	while($atmrow=mysql_fetch_array($res)){ 

		$qry2=mysql_query("select * from assets_specification where ass_spc_id='".$atmrow[2]."'");
		$row=mysql_fetch_row($qry2);

		$qry3=mysql_query("select * from assets where assets_id='".$row[1]."'");
		$row2=mysql_fetch_row($qry3);

		$qry=mysql_query("select * from amcpurchaseorder where amcsiteid='".$id."'");
		$row3=mysql_fetch_row($qry);
		//echo "exp".$row3[4];a
 		$expdt=new DateTime($row3[4]);
		// echo $expdt->format("Y-m-d"); 

	
	
?>

<!---============table start for  assests==========================-->

<tr>
<!---================Sr. No.====================-->
<td><?php echo $cnt+1; ?></td>
<!---================Checkbox and Asset Name.====================-->
<td width="100"><input type="checkbox" name="assets[<?php echo $cnt ?>]" id="assets[]" onClick="astselect('assets<?php echo $cnt ?>');"  />
<b><input type="hidden" name="assid[<?php echo $cnt ?>]" value="<?php echo $atmrow[0]; ?>" /> <?php echo $row2[1]; ?></b>
</td >
<!---================Asset Specification====================-->
<td width="80">
<select name="astspec" id="astspec">
<option value="0">select</option>
<?php
$qryaspec=mysql_query("Select * from assets_specification where assets_id='".$row[1]."' ");
while($qryaspec1=mysql_fetch_row($qryaspec))
{
?>
<option value="<?php echo $qryaspec1[0]; ?>" <?php if($qryaspec1[0]==$atmrow[2]) echo "selected"; ?>><?php echo $qryaspec1[2]; ?></option>
<?php
}
?>

</select>
</td>
<!---================Asset Quantity ====================-->
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<select name="qty" id="qty">

<?php for($i=1;$i<=30; $i++) {?>

<option value="<?php echo $i; ?>" <?php if($i==$atmrow[7]) echo "selected"; ?>><?php echo $i; ?></option>

<?php }?>
</select>
</td>
<!---================Asset Warranty====================-->
<td width="50">
<span class="space">Warranty:</span>
</td>

<td width="150">
<?php 
	if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) {
		echo "Under AMC<input type='hidden' name='pcb[]' value='' id='pcb[]'>";
	 	}else {
		if($pcb!='pcb')
			$pcb='pcb';
			echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; 
			} 
	
		
			
?>
<select name="wr" id="wr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>



<!-- ========================table end for amc assets========================-->

<?php
$cnt=$cnt+1;
}
?>
<input type="hidden" name="type" value="amc" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />

<?php
}

//================================================= site details==================
else if(strcasecmp($po,"site")==0){
	
	$qry4=mysql_query("select atm_id,podate from atm where track_id='".$id."'");
	$ro4=mysql_fetch_row($qry4);
	
$qry=mysql_query("select * from site_assets where atmid='".$id."'");	
while($row=mysql_fetch_array($qry)){
	$dt=explode(",",$row[5]);
	


	
	$qry2=mysql_query("select * from assets_specification where ass_spc_id='".$row[4]."'");
	$ro=mysql_fetch_row($qry2);

	$qry3=mysql_query("select * from assets where assets_id='".$ro[1]."'");
	$row2=mysql_fetch_row($qry3);

	//echo $ro4[1];
	$date = strtotime(date("Y-m-d", strtotime($ro4[1])) . " +$dt[0] month");
 	$dt2 =date('Y-m-d',$date);
	//echo $date = date("Y-m-d", strtotime($ro4[1] +$dt[0]." months"));
	$expdt=new DateTime($ro4[1]);

?>
<!---============table start for site assests==========================-->
<tr>
<!---================Sr. No.====================-->
<td><?php echo $cnt+1;  

 ?></td>
<!---================Checkbox and Asset Name.====================-->
<td width="100"><input type="checkbox" name="assets[<?php echo $cnt ?>]" id="assets[]" onClick="astselect('assets<?php echo $cnt ?>');"  />
<b><input type="hidden" name="assid[<?php echo $cnt ?>]" value="<?php echo $atmrow[0]; ?>" /> <?php echo $row2[1]; ?></b>
</td >
<!---================Asset Specification====================-->
<td width="80">
<select name="astspec" id="astspec">
<option value="0">select</option>
<?php
$qryspec=mysql_query("Select * from assets_specification where assets_id='".$ro[1]."' ");
while($rowspec=mysql_fetch_row($qryspec))
{
?>
<option value="<?php echo $rowspec[0]; ?>" <?php if($rowspec[0]==$row[4]) echo "selected"; ?>><?php echo $rowspec[2]; ?></option>
<?php
}
?>

</select>
</td>
<!---================Asset Quantity ====================-->
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<select name="qty" id="qty">
<option value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td>
<!---================Asset Warranty====================-->
<td width="50">
<span class="space">Warranty:</span>
</td>

<td width="150">
<?php 
	if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) {
		echo "Under AMC<input type='hidden' name='pcb[]' value='' id='pcb[]'>";
	 	}else {
		if($pcb!='pcb')
			$pcb='pcb';
			echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; 
			} 
	
		
			
?>
<select name="wr" id="wr">
<?php 
$mon=stristr($row[5],"," ,'true');

?>
<option value="<?php echo $mon.",month"; ?>"><?php echo $mon / 12 ."year";  ?></option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td>

</tr>

<!-- ========================table ends for site assets=========================-->
<?php 
 $cnt=$cnt+1;
}
?>

<input type="hidden" name="type" value="site" id="tp" />
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />
<?php
}
?>
</table>

</td>
</tr>
<!--=======================================ASSETS END HERE============================================================-->

<tr>
<td height="35">Bank Name:</td>
<td colspan="2"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="2"><!--<input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly />-->

<select name="state" id="state"  style="width:150px">
<?php
$state=mysql_query("select * from state");
while($state1=mysql_fetch_row($state)){
?>
<option value="<?php echo $state1[1]; ?>" <?php  if(($_POST['state'])==$state1[1]){ ?>selected="selected" <?php }  ?>><?php echo $state1[1]; ?></option>
<?php } ?>
</select>


</td>
</tr>

<tr>
<td height="35">City Name:</td>
<td colspan="2"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">Branch:</td>
<td colspan="2">
<td width="190">


<select name="branch_avo" id="branch_avo"  style="width:150px">
<option value="0">Select</option>
<?php
$branches=mysql_query("select * from avo_branch");
while($branches1=mysql_fetch_row($branches)){
?>
<option value="<?php echo $branches1[0]; ?>" <?php  if(($_POST['branch'])==$branches1[0]){ ?>selected="selected" <?php }  ?>>      
<?php echo $branches1[1]; ?></option>

<?php } ?>
</select>


</td>
</tr>

<tr>
<td height="35">Address:</td>
<td colspan="2"><textarea name="add" id="add"   rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Pin Code:</td>
<td colspan="2"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">Area Name:</td>
<td colspan="2"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>

<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $_POST['crby']; ?>" />



<tr>
<td height="35" colspan="4">

<input type="submit" value="submit" class="readbutton" id="submit" /> 
<input type="hidden" name="amcid1" id="amcid1" value="<?php if(isset($_POST['amcid1'])){ echo $_POST['amcid1']; } ?>" />
<input type="hidden" name="sertype" id="sertype" value="<?php if(isset($_POST['sertype'])){ echo $_POST['sertype']; } ?>" />
<input type="text" name="cat" id="cat" value="<?php if(isset($_POST['cat'])){ echo $_POST['cat']; } ?>" />
<input type="text" name="atmid_send" id="atmid_send" value="" />
<input type="text" name="stdate" id="stdate" value="<?php if(isset($_POST['stdate'])){ echo $_POST['stdate']; } ?>" />
</td>
</tr>

</table>
</div>
</form>
       <?php     

       		}
       }
       else
       {      
       NonDeployment("NULL",$_SESSION['user']); 		  
 		} ?>

</td><td valign="top">
<!--======================================SEARCH PANEL GIVEN HERE===================================-->
<table border="0"><tr><td>
<select name="searchby" id="searchby">
<option value="">Search By</option>
<option value="atmid">Atm ID</option>
<option value="add">Address</option>
</select>
</td></tr><tr><td><input type="text" name="search" id="search" /></td></tr>
<tr><td><input type="button" name="searchbtn" id="searchbtn" value="Search" onclick="searchval('searchby','search','service');" /></td></tr>
<tr style="display:block"><td><div style=" width:208px; height:770px; overflow:auto;" id="searchbar"> </div></td></tr>
</table>
<!--======================================SEARCH PANEL GIVEN HERE===================================-->

</td></tr></table></div>

</center>

</body>
</html>