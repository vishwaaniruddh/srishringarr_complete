<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 include 'config.php';
?>

<!--Datepicker-->
<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
//////////////subcat
function loadXMLDoc()
{
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
    {// alert(xmlhttp.responseText);
    document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
  var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","sub_cat.php?cat="+cat,true);

xmlhttp.send();
}



///////////////////////////////search By Id
function searchById(Mode,Page) {
 //alert("hi");
 try
 {
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
		 
		 var frdt=document.getElementById('frdt').value;
		 var todt=document.getElementById('todt').value;
		 var pay=document.getElementById('pay').value;
		 var payto=document.getElementById('payto').value;
		 
		 
		 //alert(frdt);
		var url = 'getpaymentrepdetails.php';
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&frdt='+frdt+'&todt='+todt+'&pay='+pay+'&payto='+payto;

			HttPRequest.open('POST',url,true);
 
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 

			HttPRequest.onreadystatechange = function()
			{
 
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
//alert(response);
				   document.getElementById("search").innerHTML = response;
			  }
		}
 }catch(exc)
 {
	 alert(exc);
	 
 }
  }

function getdata()
{
	try
	{
		
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
		//alert("ok");
		//alert(xmlhttp.responseText);
    document.getElementById("pay").innerHTML=xmlhttp.responseText;
    }
  }
var str=document.getElementById('payto').value;
xmlhttp.open("POST","getdatasel.php?id="+str+'&sts=1',true);
xmlhttp.send();
	}
	catch(exc)
	{
		
		alert(exc);
		
	}
}


</script>
<!-- end multiple selection -->


<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	
	background: #00a4ae;
	
	border: 2px solid #ac0404;
	
	font-size: 1.2em;
	position: relative;
	margin:auto; width:1200px;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#fff; 
	font-size:13px; 
	line-height:18px;
} 

form.signin .textbox input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:300px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.formbutton { 
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
	border-color:#ac0404; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;

        -webkit-border-radius: 4px;
	color:#fff;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:100px;
}

form.signin td{ font-size:12px; }
#banner_box .button a {
	margin: 0 auto;
	background: url(images/button_02.png) no-repeat;
}
#banner_box .button a:hover {
	color: #f8e836;
}
#site_title_bar_wrapper_outter {
	width: 100%;
	height: 50px;
	margin: 0 auto;
	background: url(images/header_bg_wrapper_outter.gif) top repeat-x;
}



</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

</head>

<body onLoad="searchById('Listing','1')">
<div id="view_patient" class="login-popup">
<div id="view_patient1">
           
           	  <h1 style="font-size:19px;">Welcome to Health Clinic </h1>
               
    <a href="home.php"> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button></a>&nbsp;&nbsp;&nbsp;    <a href="home.php"> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'logout.php';">Log Out</button></a>


           
    
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Payment Report</p>
          <table>
          <tr>
    <td>From date<input id="frdt" name="frdt" type="text" value="<?php echo date('d/m/Y');?>" onClick="displayDatePicker('frdt');"/></td>
    <td>To date<input id="todt" name="todt" type="text" value="<?php echo date('d/m/Y');?>" onClick="displayDatePicker('todt');"/></td>
      <td>Paid to 
				<select style="width:250px;"  name="payto" id="payto" onchange="getdata();">
				<option value=""> select</option>
				<?php $gtpty=mysqli_query($con,"select * from pay_to");
				
				while($rwty=mysqli_fetch_array($gtpty))
				{
				?>
				<option value="<?php echo $rwty[0];?>"> <?php echo $rwty[1];?></option>
                <?php } ?>
				</select>
				
				</td>
				<td><label class=""> Select </label></td>
                <td>
				<select style="width:250px;" name="pay" id="pay">
				<option value=""> select</option>
				</select>
				
				</td>
               
  <td>
  <button type="button" onclick="searchById('Listing','1');">Search</button>
  </td>
  </tr></table>

        <div id="search"></div>



    
</div></div>
</body>
</html>
<?php 
}else
{ 
 header("location: index.html");
}
?>