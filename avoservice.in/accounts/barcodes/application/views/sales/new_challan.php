<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ajax-dynamic-list.js"></script>	
<script>

////search school
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

      HandleResponse1(xmlHttp.responseText);
    }
  }

//alert("hi2");
 //alert("getarea.php?ccode="+document.forms[0].city.value);
var item=document.getElementById('item').value;
//alert(city);
  xmlHttp.open("GET", "getchallan.php?item="+item, true);
 // alert("getflat.php?society="+str1+"&wing="+str);

  xmlHttp.send(null);

}

function HandleResponse1(response)

{

  document.getElementById('detail').innerHTML = response;

}

</script>
    <style>

            /* Demo styles */
          .style1 {color: #FF0000}
.style4 {color: #000000; font-weight: bold; }
.style8 {font-family: Arial, Helvetica, sans-serif}
.style10 {color: #993399}

	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:175px;	/* Width of box */
		height:100px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:1.2em; color:#000;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#f93;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:650px;margin:1px;}
             .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:260px}
			
.input{ background:url(images/input_bg.gif) top repeat-x;border:1px solid #fff;font:14px Arial, Helvetica, sans-serif;height:16px;padding:5px 10px;color:#aaa;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;behavior:url(js/PIE.htc);position:relative}  
td #submit{ width:90px; height:28px; cursor:pointer;padding:5px 10px;}

body {background:url(../images/bg_top.jpg) top center no-repeat #eee}
.readbutton {
	border-top: 1px solid #f2d309;
	background: #ed9d13;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2ce18), to(#ed9d13));
	background: -webkit-linear-gradient(top, #f2ce18, #ed9d13);
	background: -moz-linear-gradient(top, #f2ce18, #ed9d13);
	background: -ms-linear-gradient(top, #f2ce18, #ed9d13);
	background: -o-linear-gradient(top, #f2ce18, #ed9d13);
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	-webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
	-moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
	box-shadow: rgba(0,0,0,1) 0 1px 0;
	text-shadow: rgba(0,0,0,.4) 0 1px 0;
	color: #735509;
	font-size: 14px;
	font-family: Georgia, serif;
	text-decoration: none;
	vertical-align: middle;
	float: left;
	height: 20px;
	width: 70px;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	text-align: center;
   }
.readbutton:hover {
   border-top-color: #f79e05;
   background: #f79e05;
   color: #1b2129;
   }
.readbutton:active {
   border-top-color: #ed5e11;
   background: #ed5e11;
   }

</style>
</head>
<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

$uid=$_GET['uid'];
//echo $uid;
?>
<body>
<center>
<form method="get" action="process_challan.php">
<table>
<tr>
<?php

$sql=mysql_query("select person_id from phppos_customers");
?>
<td height="38">Select Customer : </td>
<td>
<select name="cust" id="cust">
<option value="0">Select</option>
<?php 
while($row=mysql_fetch_row($sql)){ 
$sql1=mysql_query("select * from phppos_people where person_id='$row[0]'");
$row1=mysql_fetch_row($sql1);
?>
<option value="<?php echo $row1[11]; ?>"><?php echo $row1[0]." ".$row1[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="38">Find/Scan Item : </td>
<td><input type="text" name="item" id="item" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" /></td>
</tr>
</table>
<div id="detail"></div>
<table id="data">
<th>Item No</th>
<th>Item Name </th>
<th>Quantity</th>
</table>
<input type="hidden" value="<?php echo $uid; ?>" name="uid"/>
<input type="submit" value="submit" name="submit"/>
</form>
</center>
</body>
</html>