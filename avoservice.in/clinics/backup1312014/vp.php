<?php 



?>
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
 // alert(id);
xmlhttp.open("GET","get_ByID.php?id=" + id,true);
//alert("get_ByID.php?id=" + id);
xmlhttp.send();
}</script>

<!--date picker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<!-- Patient validation-->
<script type='text/javascript'>

function validate(form){
 with(form)
 {
  

if(fname.value=="")
{
	alert("Please Enter Firstname");
	fname.focus();
	return false;
}
 
if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please enter Telephone No. to continue.");
cn.focus();
return false;
}

if(city.value=="")
{
	alert("Please Enter City");
	city.focus();
	return false;
}

}
 return true;
 }
</script><!--end validation-->

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
	position: relative;
	top: 1%; left: 15%;
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
	width:220px;
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

form.signin td{ font-size:12px; height:40px;}
td,th{padding-left:3px; padding-right:3px;}
</style>

<div id="view_patient" class="login-popup">
<div id="view_patient1">
<?php 

include('config.php');
//$id=$_GET['patient_id'];
$result = mysql_query("select * from new_patient");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient's Records</p>
          
        
          
    <table  border="1">
    <tr>
    <td><input type="text" style="width:70px;" name="idd" id="idd"  onchange="searchById();" /></td>
    <td><input type="text" style="width:90px;" /></td>
    </tr>
       
         <tr> <td width="73" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="42" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</td>
          <td width="103" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="61" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="116" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
          <td width="135" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By </td>
          <td width="81" style="color:#ac0404; font-size:14px; font-weight:bold;">Appoint-ment</td>
          <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
          <td width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="74" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>
          <td width="74" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
          <td width="77" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>
          </table>
         <div id="search"><table border="1" >
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr> <td width="73" ><?php echo $row[0]; ?></td>
          <td width="92" ><?php echo $row[1]; ?> </td>
          <td width="42" ><?php echo $row[3]; ?></td>
          <td width="103" ><?php echo $row[5]; ?> </td>
          <td width="61" ><?php echo $row[6]; ?> </td>
          <td width="90"><?php echo $row[7]; ?></td>
          <?php 
include('config.php');
$result1 = mysql_query("select * from new_doc where doc_id='$row[11]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1)
?>
          <td width="135" ><?php echo $row1[1]; ?> </td>
          <td width="81" ><input name="code1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[0]; ?>'" /></td>
          <td width="46" ><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='opd.php?id=<?php echo $row[0]; ?>'" /> </td>
          <td width="92"><input name="code4[]" id="code4[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='admission.php?id=<?php echo $row[0]; ?>'" /></td>
          <td width="74" ><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='surgery.php?id=<?php echo $row[0]; ?>'" /></td>
          <td width="74"><input name="code3[]" id="code3[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='history.php?id=<?php echo $row[0]; ?>'" /></td>
          <td width="77" ><a href='patient_detail.php?id=<?php echo $row[0]; ?>'> Details </a></td></tr>
<?php } ?>
</table>



<div id="pageNavPosition"></div></div>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">
        var pager = new Pager('results',5); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script>
</div>
</div>
<!--end of view patient records-->