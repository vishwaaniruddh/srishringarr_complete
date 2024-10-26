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
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
	
 }
return true;
}

/////for city
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
</script>
<script type="text/javascript">
function history(cid)
{
//alert(cid);
//document.getElementById('searchbar').innerHTML="<img src='loader.gif' height='20px' width='20px'/>";
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
	//alert(str[0]);	
	//document.getElementById('searchbar').innerHTML="";
    	document.getElementById('searchbar').innerHTML=str[0];	
    	//document.getElementById('searchbar').innerHTML=str[0];
	//alert(str[1]);
	if(str[1]=='1')
	{
	alert("Call is still open for this ATM");
	document.getElementById('submit').disabled=true;
	}
    }
  }
 //alert(cid);
xmlhttp.open("get","gethistorylocal.php?cid="+cid,false);
xmlhttp.send();
}



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

xmlhttp.open("get","localservicesearch.php?val="+txt+"&what="+what+"&calltype="+call,false);

//alert("servicesearch.php?val="+txt+"&what="+what+"&calltype="+call);
//alert("opd_his.php?id="+id+"&Page="+page);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
}







function astselect(id)
{
	//alert(id);
	var x=Number(document.getElementById('ascn').value);
	//alert(x);
	//alert(id);
	//alert(document.getElementById(id).value);
	if(document.getElementById(id).checked==true)
		document.getElementById('ascn').value=x+1;
	else if(document.getElementById(id).checked==false)
		document.getElementById('ascn').value=x-1;
	
	//alert(document.getElementById('ascn').value);
}

//===========================================================

function getfield()
{
alert("hi");
//document.getElementById('searchbar').innerHTML="<img src='loader.gif' height='20px' width='20px'/>";
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
	
    	document.getElementById('header').innerHTML=xmlhttp.responseText;	
    	
	
    }
  }
 //alert(cid);
xmlhttp.open("get","pagelocal.php",true);
xmlhttp.send();
}

</script>
</head>

<body <?php if(isset($_GET['id'])){ ?>  onload="history('<?php echo $_REQUEST['cid']; ?>')" <?php } ?>>

<center>
<?php include("menubar.php"); ?>
<!--<table>

<tr><td colspan="2">Local Temp Service Call</td>
<td><input type="checkbox" name="locltemcall" id="locltemcall" onclick="getfield()" /></td></tr>

</table>-->

 <form action="process_localservice.php" method="post" name="form" onsubmit="return validate(this)" >
 
	
    <div id="header">
    <h2 class="h2color">Local service Alert</h2>
    
    <table border="0" cols="res"><tr><td valign="top">
    <table border="0" >
    <?php
    //echo "select atm_id from atm where amcid='".$_POST['ref']."'"." ".$_POST['type'];
    
    $st="select * from local_site where track_id='".$_GET['cid']."'";
    
    //echo $st;
    $qry=mysqli_query($con1,$st);
    $roqry=mysqli_fetch_row($qry);
    ?>
    <tr>
    <td height="35">Subject: <input type="text" name="sub" id="sub" value="<?php if(isset($_POST['sub'])){ echo $_POST['sub']; } ?>" /></td>
    <td colspan="3">Site Status:
<select name="docket" id="docket" required>
<option value="">select</option>
<option value="Operational" <?php if(isset($_POST['sub'])=="Operational"){?>selected <? } ?>>Operational </option>
<option value="Non Operational" <?php if(isset($_POST['sub'])=="Non Operational"){?>selected <? } ?>>Non Operational</option>
<option value="Chargeable" <?php if(isset($_POST['sub'])=="Chargeable"){?>selected <? } ?>>Chargeable</option>
</select>

<!--<input type="text" name="docket" id="docket" value="<?php if(isset($_POST['sub'])){ echo $_POST['docket'];} ?>" /></td>-->
    </tr>
    <tr><td width="110">
    Customer Name: </td>
    <td width="190">
    <input type="hidden" name="cust" id="cust" value="<?php if(isset($_POST['cust'])){ echo $_POST['cust']; }else{ if(isset($_GET['cid'])){ echo $_GET['cid'];} } ?>">
    
    <input type="text" name="custname" id="custname" style="width:150px" value="<?php if(isset($_POST['custname'])){ echo $_POST['custname']; }else{ if(isset($_GET['cid'])){ echo $roqry[2];} } ?>" >
    
    </td><td width="93"> PO NO:	
    <?php 
    //echo $_POST['po'];
    //$asst=	explode("####",$_POST['po']);
    //echo $asst[0];
    ?>
    <input type="text" name="po" id="po_no" value="<?php if(isset($_POST['po'])){ echo $_POST['po']; }else{ if(isset($_GET['cid'])){ echo $roqry[11]; } } ?>" >
    </td></tr>
    
    
    <input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />
    <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid']; ?>"/>
    <input type="hidden" name="ascn" value="0" id="ascn" />
    <input type="hidden" name="type" value="site" id="tp" />
    <?php
    //echo "hello";
    //include_once('class_files/select.php');
    //$sel_obj=new select();
    //$atm=$sel_obj->select_rows('localhost','hav_acc','Myaccounts123*','hav_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");
    ?>
    <tr><td>Customer unique ID</td><td colspan="3" id="reference">
    
    <input type="text" name="ref" id="ref"  value="<?php if(isset($_POST['ref'])){ echo $_POST['ref']; }else{ if(isset($_GET['cid'])){ echo $roqry[1]; } } ?>">
    </td></tr>
    
    <?php
        if(isset($_REQUEST['cid'])){
    ?>
    <tr>
    <td height="35">Assets : </td>
    
    <td id="assets" colspan="2" >
    <table>
    <tr><th>Sr No</th><th>Asset</th><th>Warranty</th></tr>
    <?php
    /*$assetid=array();
    $assetname=array();
    $asst=mysqli_query($con1,"select * from assets where status=0");
    if(!$asst)
    echo mysqli_error();
    while($astro=mysqli_fetch_array($asst))
    {
    $assetid[]=$astro[0];
     $assetname[$astro[0]]=$astro[1];
    }
    print_r($assetname);*/
    
    $aststr ="select * from installed_sitesmelocal where atm_id ='".$_REQUEST['cid']."'";
    
    //echo $aststr;
    $ast=mysqli_query($con1,$aststr);
    $abc=0;
    while($astr=mysqli_fetch_array($ast))
    {
    ?>
    <tr><td><?php echo $abc+1; ?></td>
    <td><input type="checkbox" name="ast[]" id="ast<?php echo $abc ?>" onchange="astselect(this.id);" value="<?php echo $astr[0]; ?>"><?php echo $astr[3]; if($astr[5]!=""){echo "<br/>Sr No.: ".$astr[5];} ?></td>
    <td>
        <?php if($astr[7]>date('Y-m-d')){echo "Under Warranty";}else { echo "PCB";}?>
        <input type="hidden" name="pcb[]" value="<?php if($astr[7]>date('Y-m-d')){echo "Under Warranty";}else { echo "PCB";} ?>"/>
    </td>
    </tr>
    <?php
    ++$abc;
    }
    //echo $abc;
    ?>
    </table>
    </td>
    </tr>
    <?php
        }
    ?>
    
    <!--<tr>
    <td height="35">Bank Name:</td>
    <td colspan="2"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" /></td>
    </tr>-->
    <!----Branch wise----->
     <tr>
    <td height="35">Branch Name:</td>
    <td colspan="2"><input type="text" name="branch" id="branch" value="<?php if(isset($_POST['branch'])){ echo $_POST['branch']; }else{ if(isset($_GET['cid'])){ echo $roqry[7]; } } ?>"  /></td>
    </tr>
    
    <tr>
    <td height="35">State Name:</td>
    <td colspan="2"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; }else{ if(isset($_GET['cid'])){ echo $roqry[7]; } } ?>"  /></td>
    </tr>
    <tr>
    <td height="35">City Name:</td>
    <td colspan="2"><input type="text" name="city" id="city"  value="<?php if(isset($_POST['city'])){ echo $_POST['city']; }else{ if(isset($_GET['cid'])){ echo $roqry[6]; } } ?>" /></td>
    </tr>
    <tr>
    <td height="35">Address:</td>
    <td colspan="2"><textarea name="add" id="add"   rows=5 cols=25><?php if(isset($_POST['add'])){ echo $_POST['add']; }else{ if(isset($_GET['cid'])){ echo trim($roqry[9]); } } ?></textarea></td>
    </tr>
    <tr>
    <td height="35">Pin Code:</td>
    <td colspan="2"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; }else{ if(isset($_GET['cid'])){ echo $roqry[5]; } } ?>" /></td>
    </tr>
    <tr>
    <td height="35">Area Name:</td>
    <td colspan="2"><input type="text" name="area"  id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; }else{ if(isset($_GET['cid'])){ echo $roqry[4]; } } ?>" /></td>
    </tr>
    <!-- <tr>
    <td height="35">Alert Date : </td>
    <td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if(isset($_POST['adate'])){ echo $_POST['adate']; } else { echo date('d/m/Y'); } ?>" /></td>
    </tr>-->
    
    <tr>
    <td height="35">Problem : </td>

<td><select id="ddl_prob" name="ddl_prob" onchange="DDL_Problem()" required>
<option value="">Select Problems</option>

<option value="UPS Down">UPS Down</option>
<option value="UPS Backup issue">UPS Backup issue </option>
<option value="UPS Beep Sound">UPS Beep Sound</option>
<option value="Servo Issue">Servo Issue</option>
<option value="IT Not Working">IT Not Working</option>

<option value="UPS Output abnormal">UPS Output abnormal</option>
<option value="Solar Issue">Solar Issue</option>
<option value="Others">Others</option>
</select>

    <td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob" readonly><?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
    </tr>
    
    <tr>
    <td height="35">Contact Person : </td>
    <td colspan="3"><input type="text" name="cname" id="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
    </tr>
    
    <tr>
    <td height="35">Contact : </td>
    <td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
    </tr>
    
    <tr>
    <td height="35">Email : </td>
    <td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
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
    
    </table></td><td valign="top">
    
   
<table border="0"><tr><td>
<select name="searchby" id="searchby">
<option value="">Search By</option>
<option value="atmid">Atm ID</option>
<option value="add">Address</option>

</select>
</td></tr><tr><td><input type="text" name="search" id="search" /></td></tr>
<tr><td><input type="button" name="searchbtn" id="searchbtn" value="Search" onclick="searchval('searchby','search','service');" /></td></tr>
<tr style="display:block"><td><div style=" width:208px; height:770px; overflow:auto;" id="searchbar"></div></td></tr></table></td></tr></table></div>

</form>


</center>

</body>
<?php
	if(isset($_REQUEST['cid'])){
?>
<script>
history('<?php echo $_REQUEST['cid']; ?>');
</script>
<?php
	}
?>
</html>

<script>
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