<?php
include("access.php");
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Asset</title>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
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
function MakeRequest()

{ 
//alert("hi");
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
//alert(xmlHttp.responseText);
      HandleResponse3(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('assets').value;
//alert(str);
  xmlHttp.open("GET", "getassetspec.php?id="+str, true);
//alert("getassetspec.php?id="+str);
  xmlHttp.send(null);

}

function HandleResponse3(response)

{

  document.getElementById('spec').innerHTML = response;

}
</script>
</head>

<body>
<center>Add New Asset<?php
if(isset($_POST['cmdasset']))
{
	if($_POST['assets']!='' && $_POST['spec']!='' && $_POST['id']!='' && $_POST['type']!=''&& $_POST['quan']!='')
	{
	//echo "select po,cid,servicetype from Amc where amcid='".$_POST['id']."'";
		if($_POST['type']=='amc')
		$qry2=mysqli_query($con1,"select po,cid,servicetype from Amc where amcid='".$_POST['id']."'");
		elseif($_POST['atm']=='atm')
		$qry2=mysqli_query($con1,"select po,cust_id from atm where track_id='".$_POST['id']."'");
		 $qry2row=mysqli_fetch_row($qry2);
		 $qry4=mysqli_query($con1,"select assets_name from assets where assets_id='".$_POST['assets']."'");
		 $qryrow4=mysqli_fetch_row($qry4);
		
		if($_POST['type']=='amc')
		$qry3=mysqli_query($con1,"Insert into amcassets(`assets_name`,`assetspecid`,`amcid`,`amcpoid`,`siteid`,`quantity`,`warranty_strtdate`,`warranty_period`) Values('".$qryrow4[0]."','".$_POST['spec']."','".$qry2row[1]."','".$qry2row[0]."','".$_POST['id']."','".$_POST['quan']."','".$_POST['adate']."','".$_POST['war']."')");
		if($_POST['type']=='amc')
		{
		//echo "hi".$qry2row[2];
		$dt=str_replace("/","-",$_POST['adate']);
	$start=date('Y-m-d', strtotime($dt));
		if($qry2row[2]=='3')
{
	
	for($i=1;$i<=4;$i++)
	{
		//echo $i."<br>";
	$j=$qry2row[2]*$i;
	//echo "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	//echo "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $start))."','AMC','".$_POST['id']."')";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $start))."','AMC','".$_POST['id']."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
elseif($qry2row[2]=='6')
{
	
	for($i=1;$i<=2;$i++)
	{
		//echo $i."<br>";
	$j=$qry2row[2]*$i;
	//echo "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	echo "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $start))."','AMC','".$_POST['id']."')";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $start))."','AMC','".$_POST['id']."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
	}	
		if($qry3)
		{
		?>
        <script type="text/javascript">
		/*if (confirm('Do you want to add more asset on this site?')) {
    // Save it!
	window.location='addmoreasset.php?id=<?php echo $_POST['id'] ?>&type=<?php echo $_POST['type'] ?>';
} else {
    // Do nothing!
	alert("Assets has been Added successfully");
	window.onunload = refreshParent;
        function refreshParent() {
            window.opener.location.reload();
        }
		window.close();
}*/

		</script>
        <?php	
		}
		else
		echo "failed ".mysqli_error();
	}
	else
	echo "<br>All details are compulsory<br>";
}
?>
<form name="asset" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<table border="1" width="100%"><tr><td>Select Asset:</td>
<td>
<select name="assets" id="assets" onchange="MakeRequest();">
<?php
$qry=mysqli_query($con1,"select * from assets");
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php	
}
?></select>
</td></tr>
<tr><td>Select Specification:</td>
<td><select name="spec" id="spec"><option value="">Select </option></select></td></tr>
<tr>
<td>Quantity:</td><td><input type="text" name="quan" id="quan" value="1" /></td>
</tr>
<tr>
<td>Warranty Start Date:</td><td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y'); ?>" /></td>
</tr>

<tr><td>Warranty Period:</td>
<td>
<select  name="war" id="war" >
<option value="6month">6month</option>
<option value="1year">1year</option>
</select>
</td></tr>

<tr><td colspan="2" align="center">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" />
<input type="submit" name="cmdasset" value="Add Asset" /></td></tr>

</table>
</form></center>
</body>
</html>