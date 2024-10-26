<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate(form)
{
var a=document.getElementById("custform");
//alert(a);
with(a)
{
if(cust.value=='')
{
alert("Please Enter Customer Name");
cust.focus();
return;
}
if(ph1.value=='')
{
alert("Please Enter Customer Phone Number");
ph1.focus();
return;
}
if(ph1.value!='')
{
//alert("hello");
 var y = ph1.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Phone 1");
              ph1.value='';
              ph1.focus();
              return;
           }
           if (y.length>10)
           {
                alert("Enter 10 digits only");
                ph1.focus();
                return;
           }
          
}
/*if(ph2.value!='')
{
 var z = ph2.value;
 if(isNaN(z)||z.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for phone2");
              ph2.value='';
              ph2.focus();
              return;
           }
           if (z.length>11)
           {
                alert("enter 11 characters starting with 0");
                ph2.focus();
                return;
           }
           if (z.charAt(0)!="0")
           {
                ph2.value='0'+z;
               // alert("Phone1 should start with 0 ");
               // ph2.focus();
                return;
           }
}*/
if(email.value=='')
{
alert("Please Enter Email ID of Custmer");
email.focus();
return;
}
if(email.value!='')
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(!email.value.match(mailformat))  
{   
alert("You have entered an invalid email address!");  
email.focus();  
return;  
}  

}
if(conper.value=='')
{
alert("Please Enter Contact Person Name");
conper.focus();
return;
}
if(percon.value=='')
{
alert("Please Enter contact Person Numer");
percon.focus();
return;
}
if(percon.value!='')
{
//alert("hello");
 var b = percon.value;
 if(isNaN(b)||b.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Contact Person Number");
             percon.value='';
             percon.focus();
              return;
           }
           if (b.length>10)
           {
                alert("Enter 10 Digits");
                percon.focus();
                return;
           }
        /*   if (b.charAt(0)!="0")
           {
           percon.value='0'+b;
               // alert("Phone1 should start with 0 ");
                //conper.focus();
                return;
           } */
}
if(add.value=='')
{
alert("Please Enter Customer address");
add.focus();
return;
}
if(city.value=='')
{
alert("Please Enter Customer City");
city.focus();
return;
}
if(state.value=='')
{
alert("Please Enter Customer state");
stete.focus();
return;
}
if(pin.value=='')
{
alert("Please Enter Customer Pincode");
pin.focus();
return;
}

//alert(a);
a.submit();
}
}
</script>
<title>Untitled Document</title>
</head>

<body>
<center>
<?php include("menubar.php");
include("form/forms.php");
include('config.php');
 ?>

<h2>New Customer</h2>
<div id="header">
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	include("myclass/newcustomer.class.php");
	$newcust=new NewCustomer();
	if($newcust->Process())
	{
		///header("location:newsite.php");
	}
	else
	{
		$newcust->ShowErrors();
	newcustomer();	
	}
}
else
newcustomer();
?>
</div>
</center>
</body>
</html>
