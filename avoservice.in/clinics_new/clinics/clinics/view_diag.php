<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 

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
	position:relative;
	top: 1%; left: 5%;
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

form.signin td{ font-size:12px;height:35px; }

form #fees input{ width:60px; height:20px;}

form #fees td{padding-left:3px; height:25px;}

#opdrec td {height:30px;}
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div id="ex_opd" class="login-popup">

<script type="text/javascript">
function confirm_delete1(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_diag.php?id="+id;
	}
	
}
</script>


<script>
///////////////////////////////search By Id
function searchById()
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
    document.getElementById("search").innerHTML=xmlhttp.responseText;
    }
  }
  var id=document.getElementById('idd').value;
  var fname=document.getElementById('fname22').value;
 // alert(id);
xmlhttp.open("GET","get_opdID.php?id=" + id+"&fname="+fname,true);
//alert("get_ByID.php?id=" +  id+"&fname="+fname);
xmlhttp.send();
}
</script>


<?php 

include('config.php');

$result = mysql_query("select * from diag");

?>

       
        
       <center>
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Diagnosis</p><br />
        
          <table width="468" border="1"  cellpadding="4" cellspacing="0" id="dia"style="border:2px #ac0404 solid;">
          
          <th width="71" style="color:#ac0404; font-size:14px; font-weight:bold;">Sr No</th>
          <th width="244" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          
          <th width="49" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="60" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php $i=1; while($row=mysql_fetch_row($result))
{  
?>

	<tr>
    <td width="71"> <?php echo $i++; ?></td>
    <td width="244"> <?php echo $row[0]; ?></td>
	<td> <a href='edit_diag.php?id=<?php echo $row[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete1(<?php echo $row[1]; ?>);"> Delete </a></td>
        
    </tr>
<?php } ?>
</table><a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button></a>
</center>

<?php 
}else
{ 
 header("location: index.html");
}

?>
