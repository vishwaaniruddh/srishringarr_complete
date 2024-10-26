<?php
include("access.php");
//echo $_SESSION['user'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script>
///customer date
function Showform(id)

{ //alert("GGG");

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
		document.getElementById("form"+id).style.display='block';
    document.getElementById("form"+id).innerHTML=xmlhttp.responseText;
    }
  }
 // alert(id);
  xmlhttp.open("GET","feedbackform.php?cid="+id,false);
xmlhttp.send();

}


////search


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
  var cont=document.getElementById('cont').value;
  var sr=document.getElementById('sr').value;
  var s=document.getElementById('cname').value;
  var s1=document.getElementById('pin').value;

  xmlHttp.open("GET", "searchopen.php?cont="+cont+"&cid="+s+"&pin="+s1, true);

  xmlHttp.send(null);

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>

<body onload="">
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>
<h2>Engineer Details</h2>
<?php
include('config.php');
$eng=$_GET['engid'];
//echo $eng;
$qry2=mysql_query("select * from phppos_engineer where id='".$eng."'");
$row2=mysql_fetch_row($qry2);
?>
<table width="826"><tr><td align="center"><h3><b style="color:#FFF">Engineer Name :</b> <?php echo $row2[1]; ?></h3></td><td align="left"><h3><b style="color:#FFF">Contact number :</b> <?php echo $row2[2]; ?></h3></td></tr></table><br /><br />
<table width="826" border="1">
<tr>
<th>
Sr NO
</th>
<th>Client Name</th>
<th>Issue</th><th>Start Date</th><th>Close Date</th><th>FeedBack</th>
</tr>

<?php

$cnt=0;

$qry=mysql_query("select * from phppos_request where assign_to='".$eng."'");
while($row=mysql_fetch_array($qry))
{
	$cnt=++$cnt;

	?>
    <tr>
    
    <td><?php echo $cnt;  ?></td>
   <td> <?php echo $row[10]; ?></td>
    <td><?php echo $row[2];  ?></td>
    <td><?php echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td><?php echo date('d/m/Y',strtotime($row[6])); ?></td>
    <td><?php echo $row[7];  ?></td>
    </tr> 
    
    <?php
}
$qry3=mysql_query("select * from phppos_request where assign_to='".$eng."' and status='Close'");
$row3=mysql_num_rows($qry3);
$row4=mysql_num_rows($qry);
if($row4==0)
$perfoma=0;
else
$perfoma=($row3/$row4)*100;
?>


</table>
<h2>Performance of this Engineer is : <?php echo $perfoma; ?> %</h2>
</center>

</body>
</html>
