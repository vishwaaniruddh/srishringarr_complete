<script>
var isCtrl = false;
document.onkeyup=function(e){
	if(e.which == 17) isCtrl=false;
}
document.onkeydown=function(e){
	if(e.which == 17) isCtrl=true;
	if(e.which == 66 && isCtrl == true) {
		document.getElementById("barcode").focus(); 
		return false;
	}
	
}
/////////////////
function formSubmit()
{
	if(document.getElementById('cid').value== -1)
 {
alert("Please enter Customer Id to continue.");
document.getElementById('cid').focus();
return false;
}
else{

document.getElementById("frm1").submit();
 return true;
 }
}

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

// alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");



var str = escape(document.getElementById('cid').value);
//alert(str);
 xmlHttp.open("GET", "getDetail1.php?barcode="+str, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
document.getElementById('detail').innerHTML=response;

}

	
////remove div
	 function removeElement(divNum) {
	 
            var d = document.getElementById('detail');
            var olddiv = document.getElementById(divNum);
            d.removeChild(olddiv);
        }


////////////// phone no	
function loadPhoneNo()
{
	//alert("hi");
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
		///alert(xmlhttp.responseText);
		var s=xmlhttp.responseText;
	    //alert(s);
		var s1=s.split('&&');
		//alert(s1[0]+"/"+s1[1]);
		if(s1[0]=="0")
		alert("No such Phone Number"); 
		else{
		document.getElementById("cid").value=s1[1];
		MakeRequest();
		}
		//document.getElementById("").value=s1[];
    //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;

    }
  }
   var str=document.getElementById('phoneNo').value;
   //alert(str);
   xmlhttp.open("GET","getbyphone.php?cid="+str,true);
   xmlhttp.send();
}

  
</script>
<script type="text/javascript">

function confirm_delete(id)
{
	
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_rent.php?id="+id;
  }
}

</script>

<div style="text-align: center;">
<font size="+1">
<a href="../../../index.php/reports">Back</a></font>
<table width="788" height="300" border="1" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  align="center">
  
<tr><td  valign="top" align="center"><font size="+1">
<?php
 include('config.php');
 
$result5=mysql_query("select * from   `phppos_app_config`");
$row5 = mysql_fetch_array($result5);
mysql_data_seek($result5,1);
$row6=mysql_fetch_array($result5);
mysql_data_seek($result5,10);

$row7=mysql_fetch_array($result5);

?>
<img src="bill.PNG" width="408" height="165"/><br/><br/>
Rent Return</font><br/><br/><center>
<form  action="approval_detail.php" id="frm1" name="frm1" method="POST">

Phone Number: <input type="text" name="phoneNo" id="phoneNo" value=""  /> <a href="#" onClick="loadPhoneNo();">Find</a> <br /><br />

Customer Name:&nbsp;&nbsp;&nbsp;<select name="cid" id="cid" onchange="MakeRequest();"><option value="-1" >select</option>
      <?php 
	 
	  $result = mysql_query("SELECT * FROM  phppos_people order by first_name");
	  while($row = mysql_fetch_row($result)){ 
	  ?>
      
      <option value="<?php echo $row[11]; ?>" ><?php echo $row[0] ."  ". $row[1]; ?></option>
      <?php } ?>   </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="hidden" name="myvar" value="0" id="theValue" /><br/><br/>
     
      <table width="778" border="0" cellpadding="4" cellspacing="0">
  <tr><td>
 <div id="detail"></div>

     </td></tr>
    </table>
      
      <br/>
</form></center>
 </td></tr>
 
 </table>
	

	
</div>
<div align="center">You are using Point Of Sale Version 10.5 .</div>