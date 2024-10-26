<?php
include("access.php");
include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<title>Untitled Document</title>
</head>
<script type="text/javascript">
//////atm id data
function atmid()
{ //alert("h");
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
    var s=xmlhttp.responseText;
  ////alert(s);
  document.getElementById('br_no').value=s;
  if(s==3){
  
  document.getElementById('detail').style.display='none';
  document.getElementById('msg').style.display='block';
 //// alert("done");
  }else{
  document.getElementById('detail').style.display='block';
  document.getElementById('msg').style.display='none';
  }
	 ///document.getElementById('asset_div').innerHTML = s;	
    }
  }
   var city=document.getElementById('city').value;
   
  
 //////alert("get_data.php?cust="+cust+"&po="+po+"&ref="+ref);
  
xmlhttp.open("GET","get_branch.php?city="+city,true);

xmlhttp.send();
}


//////////////////////////////site type function

function validate1(){
var a=document.getElementById("form1");
//alert(a);
 with(a)
 {

 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;
if(state.value==0)
{
	alert("Please Select State");
	state.focus();
	return;
}
if(bradd.value=='')
{
	alert("Please Enter Branch Address");
	bradd.focus();
	return;
}
if(brcity.value=='')
{
	alert("Please Enter City");
	brcity.focus();
	return;
}
if(brpin.value=='')
{
	alert("Please Enter Pincode");
	brpin.focus();
	return;
}
//alert(hname.length);
//var i=document.getElementById('hname').length;
//alert(hname[0]);
if(document.getElementById('hname1').value=='' && document.getElementById('hname2').value=='' && document.getElementById('hname3').value=='')
{
alert("Give atleast one Name");
return;
}
for(i=1;i<=3;i++)
{
if(document.getElementById('hname'+i).value!='')
{
if(document.getElementById('cont'+i).value=='')
{
alert("Please Provide Contact Number");
return;
}
if(document.getElementById('cont'+i).value!='')
{
//alert("hello");
 var y = document.getElementById('cont'+i).value;
// alert(y);
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Contact Number");
              document.getElementById('cont'+i).value='';
              document.getElementById('cont'+i).focus();
              return;
           }
            if (y.length<10)
           {
                alert("Invalid Contact Number");
                document.getElementById('cont'+i).focus();
                return;
           }
           if (y.length>11)
           {
                alert("Enter 11 characters starting with 0");
                document.getElementById('cont'+i).focus();
                return;
           }
           if (y.charAt(0)!="0")
           {
           document.getElementById('cont'+i).value='0'+y;
               // alert("Phone1 should start with 0 ");
                //ph1.focus();
               return;
           }
}
if(document.getElementById('email'+i).value=='')
{
alert("Please Provide Email ID");
document.getElementById('email'+i).focus();
return;
}
if(document.getElementById('email'+i).value!='')
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(!document.getElementById('email'+i).value.match(mailformat))  
{   
alert("You have entered an invalid email address!");  
document.getElementById('email'+i).focus();  
return;  
}  

}
}
}
a.submit();

 
 }
 }
 

</script>
<body>
<center>
<?php include("menubar.php"); ?>

<h2> New Branch</h2>
<div id="header">
<form action="process_cityhead.php" method="post" name="form"  id="form1">
<table>
<tr>
<td width="108" height="35">Select Branch: </td>
<td width="181" colspan=2>
<select name="state" id="state">
<?php

$city_tab=mysqli_query($con1,"select id, name from avo_branch order by name ASC");
?>
<option value="0">select</option>
<?php while($row=mysqli_fetch_row($city_tab)){ ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td width="108" height="35">Branch Address : </td>
<td width="181" colspan=2>
<textarea name="bradd"></textarea>
</td>
</tr>
<tr>
<td width="108" height="35">City : </td>
<td width="181" colspan=2>
<input type="text" name="brcity">
</td>
</tr>
<tr>
<td width="108" height="35">Pincode : </td>
<td width="181" colspan=2>
<input type="text" name="brpin">
</td>
</tr>
<tr>
<td colspan="3">
<fieldset><legend>Branch Head Details</legend>
<table id="detail" width="100%" >
<tr>
<td height="35">Head Name :<br><input type="text" name="hname[]" id="hname1" /> </td><td> &nbsp;</td>
<td height="35">Contact :<br><input type="text" name="cont[]" id="cont1" /> </td><td> &nbsp;</td>
<td height="35">Email :<br><input type="text" name="email[]" id="email1" /> </td>

</tr>
<tr>
<td height="35">Subordinate 1:<br><input type="text" name="hname[]" id="hname2" /> </td><td> &nbsp;</td>
<td height="35">Contact1 :<br><input type="text" name="cont[]" id="cont2" /> </td><td> &nbsp;</td>
<td height="35">Email1 :<br><input type="text" name="email[]" id="email2" /> </td>

</tr>
<tr>
<td height="35">Subordinate 2 :<br><input type="text" name="hname[]" id="hname3" /> </td><td> &nbsp;</td>
<td height="35">Contact2 :<br><input type="text" name="cont[]" id="cont3" /> </td><td> &nbsp;</td>
<td height="35">Email2 :<br><input type="text" name="email[]" id="email3" /> </td>

</tr>
<input type="hidden" name="br_no" id="br_no" />

</table>
</fieldset>
</td></tr>
<tr>
<td height="35" colspan=3><input type="button" value="submit" class="readbutton" onclick="validate1()"/></td>
</tr>
</table>
<div id="msg" style="display:none;">No More Coordinator's Can be added on this branch </div>
</form>
</div>
</center>
</body>
</html>