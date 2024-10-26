<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');


$id=$_GET['id'];

$sql1="select * from patient where no='$id'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);
?>



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
	color:#000; 
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

form.signin td{ font-size:12px; height:30px; }
</style>

<script  type="text/javascript" >
function createList(){
//	alert("dgfr");
var i=2010;
var s=new Date().getFullYear();
//alert(s)
for (i=2010; i<=s; i++)
{
document.getElementById("img").innerHTML=document.getElementById("img").innerHTML+"<a href='#' onclick=''>"
+i+"</a><br/><p><a href='Timeline/horizontal.php?year="+i+"&month=1&pid=<?php echo $id; ?>' >January</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=2&pid=<?php echo $id; ?>' >February</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=3&pid=<?php echo $id; ?>' >March</a><br/><a href='Timeline/horizontal.php?year="
+i+"&month=4&pid=<?php echo $id; ?>'>April</a><br/><a href='Timeline/horizontal.php?year="
+i+"&month=5&pid=<?php echo $id; ?>' >May</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=6&pid=<?php echo $id; ?>' >June</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=7&pid=<?php echo $id; ?>' >July</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=8&pid=<?php echo $id; ?>' >August</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=9&pid=<?php echo $id; ?>' >September</a><br/><a href='Timeline/horizontal.php?year="
+i+"&month=10&pid=<?php echo $id; ?>' >October</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=11&pid=<?php echo $id; ?>' >November</a><br/><a href='Timeline/horizontal.php?year="+i+"&month=12&pid=<?php echo $id; ?>' >December</a></p><br/>";	
	

}}

    $("a").click(function () {
		  $("p").hide();
      $("p").slideToggle("slow");
    });
</script>
<html>
<body onLoad="createList();">
<div id="">

 <form method="post" class="signin" action="new_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
         
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient History</p>
                
            	<table border="1"  cellpadding="4" cellspacing="0" align="center"> 
                
                <tr><td colspan="4" bgcolor="#DCDCDC"><font color="#FF0000"><b> Patient Id : </b></font><b><?php echo $row1[2]; ?></b></td></tr>
                <tr><td colspan="4" bgcolor="#DCDCDC"><font color="#FF0000"><b> Patient Name : </b></font><b><?php echo $row1[6]; ?></b></td></tr>
                <tr><td colspan="4" bgcolor="#DCDCDC"><font color="#FF0000"><b> Contact No. : </b></font><b><?php echo $row1[23]; ?></b></td></tr>
         
           <th width="507" height="42"  valign="bottom"style="color:#ac0404; font-size:14px; font-weight:bold;">Select Year</th>
         
         
      

	<tr>
    
    <td> <div id="img" style="color:#000; font-size:18px;"></div>
    </td>

   
      
</tr>
</table>

<a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>

</div>
</body></html>
<?php 
}else
{ 
 header("location: index.html");
}

?>