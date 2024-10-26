<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('template_clinic.html');
include('config.php');
?>

<script type="text/javascript" src="js/newpatient.js"></script>
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



</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
 <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<style>


 .M_page:-ms-input-placeholder { color:#f00; } 
 
 
</style>

<body>
  
   <div class="M_page">
   <fieldset class="textbox">
   
	<legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />Patient's Renewal</h1></legend>
    
    	   <div>
  <form name="package" method="post" action="processpackage.php">
  <input type="hidden" name="patid" value="<?php echo $_GET['id']; ?>">
  
                  <table width="1032">
                  <tr>
                  <td><label>Patient Name:</label></td><td><?php $pat=mysql_query("select name from patient where srno='".$_GET['id']."'");
				  $patro=mysql_fetch_row($pat);
				  echo $patro[0];
				    ?></td>
                  </tr>
                    <tr><td width="151"><label>Select Package:</label>&nbsp;&nbsp;<a href="#" onclick="packagewindow('pack');"><img src="images/add.png" height="15px" width="15px" title="Add New Package" /></a></td>
                    <td width="237"><select name="pack" id="pack" onchange="getpackamt(this.id,'packamt');"><option value="">-select Package-</option><?php 
				  $pack=mysql_query("select * from package where status=0 order by amt ASC ");
				  while($packro=mysql_fetch_array($pack))
				  {
				  ?>
                  <option value="<?php echo $packro[0]; ?>"><?php echo $packro[1]; ?></option>
                  <?php
				  }
				   ?></select></td><td width="178"><label>Package Start Date:</label></td>
                  <td width="446"><input type="text" name="stdt" id="stdt" value="<?php echo date("d/m/Y"); ?>"  onClick="displayDatePicker('stdt');"/></td></tr>
                   <tr><td><label>Amount :</label></td><td colspan="3"><input type="text" name="packamt" id="packamt" /></td></tr>
                    <tr><td colspan="4" align="center"><input type="submit" value="Renew" name="submit" /></td></tr>
                  </table>
                  </form>
                  </div>


  


 
            </fieldset>
              
         </div>
</body>

