<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");

 include('template_clinic.php');
 include('config.php');
 
 $id=$_GET['id'];
  $sql="select * from patient where srno='$id'";

$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$packr=mysql_query("select * from patient_package where patientid='".$id."' and status=0 order by id DESC limit 1");
$pac=mysql_fetch_row($packr);

?>
<script>
function getpackamt(id,field)
{ 
//alert(id+" "+field);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //alert(xmlhttp);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
  document.getElementById(field).value=xmlhttp.responseText;
    }
  }
  
  var str=document.getElementById(id).value;
 // alert("getpackageamt.php?packid="+str);
xmlhttp.open("GET","getpackageamt.php?packid="+str,true);
//alert("getpackageamt.php?packid="+str);
xmlhttp.send();	
}
</script>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<div class="M_page">
	<fieldset class="textbox">
                <legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />Degrade Package</h1></legend>
                <form method="POST" action="process_degrade_pack.php">
		<table width="50%">
			<tr>
				<td><label>Select Package:<?php echo $pac[2]; ?></label></td>
				<td>
					<select name="pack" id="pack" onchange="getpackamt(this.id,'packamt');">
						<option value="">-select Package-</option>
						<?php
							$pack=mysql_query("select * from package where status=0 order by amt ASC ");
						  	while($packro=mysql_fetch_array($pack))
						  	{
						?>
						<option value="<?php echo $packro[0]; ?>"<?php if($packro[1]==$pac[2]){?> selected="selected"<?php } ?>><?php echo $packro[1]; ?></option>
		                  		<?php
							}
						?>
					</select>
					<input type="hidden" name="patid" value="<?php echo $id; ?>" />
				</td>
			</tr>
			<tr>
				<td><label>Package Amount :</label></td>
				<td><input type="text" readonly="readonly" name="packamt" id="packamt" value="<?php echo $pac[6]; ?>" /></td>
			</tr>
			<tr>
				<td><label>Discount Amount :</label></td>
				<td><input type="text" name="disamt" id="disamt" value="<?php echo $pac[7]; ?>" /></td>
			</tr>
			<tr>
				<td><label>Reason :</label></td>
				<td><input type="text" name="degrade" required placeholder="Reason"/></td>
			</tr>
			<tr>
				<th colspan="2"><input type="submit" value="submit"/></th>
			</tr>
		</table>
		</form>
	</fieldset>
</div>