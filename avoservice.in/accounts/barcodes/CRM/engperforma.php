<?php
include("access.php");
//echo $_SESSION['user'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<h2>Engineer Performance</h2>
<div align="center"><a href="#" onClick="window.open('neweng.php','xyz','width=600,height=300')">New Engineer</a></div>
<table width="826" border="1">
<tr>
<th>
Sr NO
</th>
<th>Name</th><th>Contact Number</th><th>Performance</th>
</tr>

<?php
include('config.php');
$cnt=0;
$date=date("Y-m-d");
$qry=mysql_query("select * from phppos_engineer where status=0");
while($row=mysql_fetch_array($qry))
{
	$cnt=++$cnt;
	//echo "select * from phppos_request where assign_to='".$row[0]."' and status='Close'";
$qry2=mysql_query("select * from phppos_request where assign_to='".$row[0]."' and status='Close'");	
$row2=mysql_num_rows($qry2);
$qry3=mysql_query("select * from phppos_request where assign_to='".$row[0]."'");	
$row3=mysql_num_rows($qry3);
if($row3==0)
$performa=0;
else
$performa=($row2/$row3)*100;

//echo $row2." ".$row3."<br>";
	?>
    <tr><td><?php echo $cnt;  ?></td>
    <td><?php echo $row[1];  ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><table width="100%"><tr><td align="left"><?php echo round($performa,2)." %";  ?></td>
    <td align="right"><a href="performadet.php?engid=<?php echo $row[0]; ?>" target="_parent" title="Delete Engineer"> View Detail</a></td>
    <td align="right"><a href="#" onclick="window.open('editeng.php?engid=<?php echo $row[0]; ?>','xyz','width=600,height=300')"> <img src="edit.png" height="20px" width="20px" /></a></td>
    <td align="right"><a href="deleng.php?engid=<?php echo $row[0]; ?>" target="_parent" onclick="return confirm('Are you sure you would like to delete this engineer?');"> <img src="delete.png" height="20px" width="20px" /></a></td></tr></table></td>
    </tr> 
    
    <?php
}



?>


</table>

</center>

</body>
</html>
