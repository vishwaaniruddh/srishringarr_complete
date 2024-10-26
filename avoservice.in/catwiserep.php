<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category Wise Report</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function getBank(id)
{
//alert(id);
var prob=document.getElementById('prob').value;
//alert(prob);
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
    document.getElementById('bank').innerHTML=xmlhttp.responseText;

    }
  }
  
xmlhttp.open("GET","catwiserep_bank.php?id="+id+"&prob="+prob,true);
xmlhttp.send();
//alert("catwiserep_bank.php?id="+id);
}

	
///////////////////////////////search 
function searchById(a,b,perpg) {
alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='30';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
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
		
		
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			 var name=document.getElementById('name').value;//alert(id);
			 var email=document.getElementById('email').value;//alert(cid);
			 var con=document.getElementById('number').value;//alert(bank);
			  //var state=document.getElementById('state').value;//alert(cid);
			 
			  }
			
			var url = 'searchcatwise.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+"&name="+name+'&perpg='+ppg+"&email="+email+'&number='+con;
			// alert(pmeters);
			}
			else
			{
				 pmeters = "Page="+b+'&perpg='+ppg;
			}
			alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }


</script>
<script>

/////for city
function getXMLHttp()
{

  var xmlHttp

alert("hi1");

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

	function HandleResponse3(response){
	  document.getElementById('res').innerHTML = response;
	}
}
function Approve(id)

{ 
//alert(id);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
if((xmlHttp.responseText)==0)
document.getElementById('app'+id).innerHTML="Done";
else
{
}
    //  HandleResponse3(xmlHttp.responseText);
    }
  }

 
  xmlHttp.open("GET", "appeng.php?id="+id, true);
//alert("appeng.php?id="+id);
  xmlHttp.send();

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
</head>

<body onload="<?php if(isset($_POST['cust']) && isset($_POST['prob'])){echo "getBank(".$_POST['cust'].")"; }?>">
<center>
<?php include("menubar.php"); ?>

<h2>Category Wise Report</h2>
<form name="catwise" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<table><th>Select Problem</th><th width="77"><select name="prob" id="prob"><option value=""></option>
<?php
$prob=mysqli_query($con1,"select * from problemtype order by problem ASC");
while($probro=mysqli_fetch_row($prob))
{
?>
<option value="<?php echo $probro[0];?>" <?php if($_POST['prob']==$probro[0]){echo selected;}?>><?php echo $probro[1]; ?></option>
<?php
}
?></select>
</th>
<th>Select Customer : <select name="cust" id="cust" onchange="getBank(this.value)" style="width:200;"><option value="">Select</option>
<?php
	$cust_qry=mysqli_query($con1,"select cust_id,cust_name from customer where cust_id in (select distinct(`cust_id`) from alert)");
	while($cust=mysqli_fetch_row($cust_qry))
	{
?>
<option value="<?php echo $cust[0]; ?>" <?php if($_POST['cust']==$cust[0]){echo selected;}?>><?php echo $cust[1]; ?></option>
<?php
	}
?>
<th>Select Bank : <select name="bank" id="bank" style="width:200;"><option value="">Select</option>
<?php if(isset($_POST['bank'])){ ?><option value="<?php echo $_POST['bank'];?>" selected><?php echo $_POST['bank'];?></option><?php }?></select>
    <th width="75"><input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
    <th><input type="text" name="todt" id="todt"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/>
    </th>
    <th><input type="submit" name="cmdexcel" id="cmdexcel" value="Convert to Excel" /></th>
    </table>
<!--<input type="submit" name="cmdpdf" id="cmdpdf" value="Convert to PDF" />-->
</form>
<?php
if(isset($_POST['cmdexcel']))
{
if(isset($_POST['prob']) && $_POST['prob']!='')
{
$probid=$_POST['prob'];
$qry="select * from alert where alert_id in (select alertid from siteproblem where probid='".$probid."')";
if(isset($_POST['fromdt']) && isset($_POST['todt']) && $_POST['fromdt']!='' && $_POST['todt']!='')
$qry.=" and entry_date between STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y') AND STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y')";
if(isset($_POST['cust'])&& $_POST['cust']!='')
$qry.=" and cust_id='".$_POST['cust']."'";
if(isset($_POST['bank'])&& $_POST['bank']!='')
$qry.=" and bank_name like '%".$_POST['bank']."%'";

//echo $qry;
$sql=mysqli_query($con1,$qry);
if(mysqli_num_rows($sql)>0)
{
?>
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr><td colspan="14" align="center"><?php $pro=mysqli_query($con1,"select problem from problemtype where probid='".$probid."'");
$proro=mysqli_fetch_row($pro);
echo "<h2>".$proro[0]."</h2>";
 ?></td></tr>
<tr><th width="77">Complain ID</th> 
<th width="77">Client Docket Number</th> 
<th width="77">Name</th>
<th width="72">ATM</th>
<th width="71">Bank</th>
<th width="71">State</th>
<th width="55">City</th>
<th width="57">Area</th>
<th width="207">Address</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>
<th width="100">Engineer Last FeedBack</th>
</tr>

<?php
while($row=mysqli_fetch_array($sql))
{
	if($row[17]=='service' &&  $row[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='service' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");


	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	
	$row1=mysqli_fetch_row($tab);
	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } ?>>
<td width="77" valign="top"><?php echo $row[25]; ?></td>
<td width="77" valign="top"><?php echo $row[30]; ?></td>
<td width="77" valign="top"><?php echo $custrow[0]; ?></td>
<td width="72" valign="top"><?php // echo $row[17]." ".$row[2];
  if($row[17]=='new' || $row[17]=='new temp'){ echo $row[2]; } else {  
  $atmrow=mysqli_fetch_row($atm);
   echo $atmrow[0];  }?></td>
<td width="71" valign="top"><?php echo $row[3] ?></td>
<td width="71" valign="top"><?php echo $row[27] ?></td>
<td width="55" valign="top"><?php echo $row[6] ?></td>
<td width="57" valign="top"><?php echo $row[4] ?></td>
<td valign="top"><?php echo $row[5] ?></td>
<td width="75" valign="top"><?php
// echo $row[9];
 if($row[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);
 echo "<br><b>Buy Back :</b>".$buyro[2]."<br>";
 
 }
 echo $row[9];
 ?></td>
<td width="75" valign="top"><?php
if($row[17]=='service' || $row[17]=='new temp'){ echo date('d/m/Y h:i:s a',strtotime($row[10]));  } else{ if(isset($row[11]) and $row[11]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[11])); }
?></td>
<td width="75" valign="top"><?php echo $row[12] ?></td>
<td width="75" valign="top"><?php echo $row[13] ?></td>
<td valign="top"><?php if($row1[0]!=''){echo $row1[0];}else{ 
/*$al=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
$alro=mysqli_fetch_row($al);
echo $alro[0];*/
 } ?></td>


</tr>
<?php
}
?>
</table>
<?php
}

}
else
echo "Please Select Category";
}
?>

</div>
<div id="search"></div>
</center>


</body>
</html>