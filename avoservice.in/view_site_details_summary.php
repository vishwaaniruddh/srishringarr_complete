<?php include("access.php");
include("config.php");
//include("search_pmalert_new.php");
$getdata=$_GET['id'];
$datatyp=$_GET['type'];
//echo $datatyp;
$br=$_GET['br'];

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>


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
//var str=document.getElementById('state').value;
//alert(str);
 // xmlHttp.open("GET", "get_city.php?state="+str, true);

  //xmlHttp.send(null);

}

function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;

}
</script>
</head>
<body>
<?php

if($datatyp=="amc")
{

//echo "braaachhh ".$br;

if($br=="0")
{
$queryalert=mysqli_query($con1,"SELECT b.cust_name, a.BANKNAME,a.ATMID,a.ADDRESS,a.STATE,a.AMC_ST_DATE,a.AMC_EX_DATE,a.AMCID FROM Amc a, customer b  WHERE a.CID = '".$getdata."' AND a.CID = b.cust_id   AND active= 'Y'");

//echo "SELECT b.cust_name, a.BANKNAME,a.ATMID,a.ADDRESS,a.STATEc.name,a.AMC_ST_DATE,a.AMC_EX_DATE,a.AMCID FROM Amc a, customer b,avo_branch  WHERE a.CID = '".$getdata."' AND a.CID = b.cust_id and a.branch=c.id  AND active= 'Y'";
}
else
{

$queryalert=mysqli_query($con1,"SELECT b.cust_name, a.BANKNAME,a.ATMID,a.ADDRESS,a.STATE,a.AMC_ST_DATE,a.AMC_EX_DATE,a.AMCID,c.name FROM Amc a, customer b,avo_branch c  WHERE a.CID = '".$getdata."' AND a.CID = b.cust_id AND branch ='".$br."' AND active = 'Y' and a.branch=c.id");

//echo "SELECT b.cust_name, a.BANKNAME,a.ATMID,a.ADDRESS,a.STATE,c.name,a.AMC_ST_DATE,a.AMC_EX_DATE,a.AMCID FROM Amc a, customer b,avo_branch c  WHERE a.CID = '".$getdata."' AND a.CID = b.cust_id AND branch ='".$br."' AND active = 'Y' and a.branch=c.id";
}

//$queryalert=mysqli_query($con1,"SELECT b.cust_name, a.BANKNAME,a.ATMID,a.ADDRESS,a.STATE,a.AMC_ST_DATE,a.AMC_EX_DATE,c.name FROM Amc a, customer b,avo_branch c  WHERE a.CID = '".$getdata."' AND a.CID = b.cust_id AND branch ='".$br."' AND active = 'Y' and a.branch=c.id");


}
else
{
if($br=="0")
{
$queryalert=mysqli_query($con1,"select b.cust_name,a.bank_name,a.atm_id,a.address,a.state1,a.podate,a.expdt,a.track_id,c.name from atm a,customer b,avo_branch c where  a.cust_id=b.cust_id and a.cust_id='".$getdata."' and a.branch_id=c.id  and a.active='Y'");

//echo "select b.cust_name,a.bank_name,a.atm_id,a.address,a.state1,c.name,a.podate,a.expdt,a.track_id from atm a,customer b,avo_branch c where  a.cust_id=b.cust_id and a.cust_id='".$getdata."' and a.branch_id=c.id  and a.active='Y'";
}
else
{

$queryalert=mysqli_query($con1,"select b.cust_name,a.bank_name,a.atm_id,a.address,a.state1,a.podate,a.expdt,a.track_id,c.name from atm a,customer b,avo_branch c where  a.cust_id=b.cust_id and a.branch_id=c.id and c.id='".$br."' and a.cust_id='".$getdata."' and a.active='Y'");


//$queryalert=mysqli_query($con1,"select b.cust_name,a.bank_name,a.atm_id,a.address,a.state1,c.name,a.podate,d.assets_name from atm a,customer b,avo_branch c,site_assets d where a.cust_id=d.cust_id and a.cust_id=b.cust_id and a.branch_id=c.id and a.cust_id='".$getdata."' and a.active='Y'");

//echo "select b.cust_name,a.bank_name,a.atm_id,a.address,a.state1,c.name,a.podate,a.expdt,a.track_id from atm a,customer b,avo_branch c where  a.cust_id=b.cust_id and a.branch_id=c.id and c.id='".$br."' and a.cust_id='".$getdata."' and a.active='Y'";
}
}

?>
<table>
<th>sr.no.</th>
<th>Customer Name</th>
<th>Bank Name</th>
<th>atm id</th>
<th>Address</th>
<th>State</th>
<th>Branch</th>

<th>Start Date</th>
<th>End date</th>
<th>Assets Details</th>
<?php 
$i=1;
while($fetchqry=mysqli_fetch_array($queryalert))
{
//echo "hello".$datatyp;


$strr="";
if(trim($datatyp)=="atm")
{
$qryassets=mysqli_query($con1,"select assets_name from site_assets where atmid='".$fetchqry[7]."'");



while($fetchqry1=mysqli_fetch_array($qryassets))
{
//echo "testinggg";
if($strr=="")
{
$strr=$strr.$fetchqry1[0];
}
else
{
$strr=$strr.",".$fetchqry1[0];
}

}
}

if(trim($datatyp)=="amc")
{
$qryassets1=mysqli_query($con1,"select assets_name from amcassets where siteid='".$fetchqry[7]."'");



while($fetchqry2=mysqli_fetch_array($qryassets1))
{
//echo "testinggg";
if($strr=="")
{
$strr=$strr.$fetchqry2[0];
}
else
{
$strr=$strr.",".$fetchqry2[0];
}

}
}
?>

<tr>
<td><?php echo $i; ?></td>
<td><?php echo $fetchqry[0]?></td>
<td><?php echo $fetchqry[1]?></td>
<td><?php echo $fetchqry[2]?></td>
<td><?php echo $fetchqry[3]?></td>
<td><?php echo $fetchqry[4]?></td>

<td><?php echo $fetchqry[8]?></td>

<!--<td><?php echo ""//$fetchqry[8]?></td>-->
<td><?php echo $fetchqry[5]?></td>
<td><?php echo $fetchqry[6];?></td>
<td><?php echo $strr;?></td>

</tr>
<?php $i++; } ?>

</table>


</center>
</body>
</html>