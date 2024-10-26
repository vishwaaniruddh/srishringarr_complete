<?php 
include 'config.php';

session_start();
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
  

?>

<style type="text/javascript">
 <!-- Staff validation-->
<!--end validation-->

</style>

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
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 1%; left: 20%;
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
</style>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<script language="javascript" >

function validate()
{
	
	var amt=document.getElementById('amt').value;
	
	if(amt.trim()=="")
	{
		
		alert("Enter amount");
		document.getElementById('amt').focus();
		return false;
	}
	else if(parseFloat(amt.trim())<=0)
	{
		
		alert("Amount must be greater than 0");
		document.getElementById('amt').focus();
		return false;
		
	}else{
		
		
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
xmlhttp.open("POST","getdatasel.php?id="+str,true);
xmlhttp.send();
	}
	catch(exc)
	{
		
		alert(exc);
		
	}
}




</script>
<body onload="getdata()">
<center>
<div id="" class="login-popup" align="center" style="width:50%">

       
          <form method="post" class="signin" action="process_payment.php" onSubmit="return validate();" name="staffform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Payment</p>
                
            	<table>
                
                <tr> 
            	<td><label class="fname"> Payment date </label></td>
               <td><input id="paydt" name="paydt" type="text" value="<?php echo date('d/m/Y');?>" readonly/></td>
			   </tr>
			   <tr>
                <td><label class="gender"> Pay to </label></td>
                
				<td>
				<select style="width:250px;"  name="payto" id="payto" onchange="getdata();">
				<?php $gtpty=mysqli_query($con,"select * from pay_to");
				while($rwty=mysqli_fetch_array($gtpty))
				{
				?>
				<option value="<?php echo $rwty[0];?>"> <?php echo $rwty[1];?></option>
                <?php } ?>
				</select>
				
				</td>
                </tr>
                               
                <tr> 
            	<td><label class=""> Select </label></td>
                <td>
				<select style="width:250px;" name="pay" id="pay">
				</select>
				
				</td>
                </tr>
               
                <tr> 
            	<td><label class=""> Amount </label></td>
                <td>
				<input type="text" name="amt" id="amt">
				
				</td>
                </tr>
               
				<tr> 
            	<td><label class=""> Description </label></td>
				<td><textarea id="desc" name="desc"></textarea></td>
				
				</td>
                </tr>
               
				
				
				
				</table>     
                
                <CENTER>
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
               </CENTER>
                </fieldset>
				
				<table>     
				<tr>
				<td ALIGN="CENTER">
				<?php 
				if(isset($_GET['st']))		//CHECK HERE
				{
					if($_GET['st']=="1"){
						echo "Data Inserted Successfully";
					}
					if($_GET['st']=="2")
				    {
						echo "Error inserting data";
				    }   
					
				}
				
				?>
				</td>
				</tr>
				</table>     
          </form>
		  </center>
</div>
</body>