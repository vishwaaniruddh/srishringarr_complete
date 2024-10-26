<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<style>
.text{ width:200px; height:23px;}
</style>
    
<script type='text/javascript'>//<![CDATA[ 
////get end date
$(function() {
	
	
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
			var str1=document.getElementById('pack').value;
			var m=str1.split(" ");
			var a=Number(m[0]);
			
			var mon=m[1]+"()";
			//alert(mon);
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			if(m[1]=="Year"){
			//alert(date.getFullYear()+3);
			 date.setYear(date.getFullYear() + a);
			 date.setDate(date.getDate() -1);
			}else{
            date.setMonth(date.getMonth() + a);
			 date.setDate(date.getDate() -1);
			}
			
            $(".secondcal").datepicker("setDate", date);
        }
    });
    $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
});



/////display items
var searchReq = getXMLHttp();
function getXMLHttp()
{

  var xmlHttp

// alert("hi1");

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

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");



var str = escape(document.getElementById('cname').value);
//alert(str);
 xmlHttp.open("GET", "getitem.php?cname="+str, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
document.getElementById('detail').innerHTML=response;

}
</script>
</head>
<?php include('config.php');
$cid=$_GET['cid'];
$id=$_GET['id'];
//echo $cid." ".$id;
if($cid=="sales"){
	//echo "select * from phppos_service where id='$id'";
$query =mysql_query("select * from phppos_service where id='$id'");
}
else 
{
$query =mysql_query("select * from phppos_service1 where id='$id'");
//echo "select * from phppos_service1 where id='$id'";
}
$row=mysql_fetch_row($query);
$qry="";
if($row[16]=='domestic'||$row[7]=='domestic')
{
//  echo "select start_date from phppos_amc where person_id='".$row[0]."'";
$qry=mysql_query("select `start_date` from phppos_amc where `person_id`='".$row[0]."'");


}
else
{
//echo "select start_date from phppos_servicestatus1 where id='".$row[0]."'";
$qry=mysql_query("select `service_date` from phppos_servicestatus1 where id='".$row[0]."' limit 1");

}
$dt=mysql_fetch_array($qry);
?>
<body>
<center>
<input type="button" value="PR Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';" />&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"  />&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Customer AMC</h2>
<form action="update_amc.php" method="post">
<table>
<tr>
<td width="137" height="40">Date : </td><td width="218"><?php echo date('d/m/Y'); ?></td>
</tr>

<tr>
<td height="40"> Customer Name : </td>
<td><input type="text" name="cname" id="cname" class="text" value="<?php echo $row[2]; ?>"/></td>
</tr>

<tr>
<td height="40">Contact : </td>
<td><input type="text" name="cont" id="cont" class="text" value="<?php echo $row[3]; ?>"/></td>
</tr>

<tr>
<td height="40">Email : </td>
<td><input type="text" name="email" id="email" class="text" value="<?php echo $row[4]; ?>"/></td>
</tr>

<tr>
<td height="40">Address : </td>
<td><textarea name="add" id="add" rows="4" cols="30"><?php echo $row[5]; ?></textarea></td>
</tr>

<tr>
<td height="40">Pincode : </td>
<td><input type="text" name="pin" id="pin" class="text" value="<?php  if($cid=='sales') echo $row[17]; else echo $row[8]; ?>"/></td>
</tr>

<tr>
<td height="40">Item : </td>
<td><textarea name="item" id="item" rows="3" cols="30" readonly="readonly"><?php echo $row[6]; ?></textarea></td>
</tr>

<tr>
<td height="40">Date of Purchase : </td>
<td><input type="text" name="email" id="email" class="text" readonly="readonly" value="<?php  echo date('d/m/Y',strtotime($dt[0])); ?>"/></td>
</tr>

<tr>
<td height="34">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</center>
</body>
</html>