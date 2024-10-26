<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
function confirm_delete2(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_teldir.php?id="+id;
	}
}

</script>

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
	margin:auto; width:1100px;
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
</head>
<body>
<?php 
include 'config.php';
?>

<div id="view_teldir" class="login-popup">
<div id="view_teldir1">
<?php 


$result = mysqli_query($con,"select * from tel_directory");
?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Telephone Directory</p><br />
        
          <table border="1" style="border:2px #ac0404 solid;"> 
          
         <!-- <tr>
          <td><input type="text" style="width:70px;" name="tname" id="tname"  onchange="searchtel();" /></td>
          <td><input type="text" style="width:90px;" name="tcon" id="tcon"  onchange="searchtel();"/></td>
          </tr> -->
          <tr>
          <td width="115" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
          <td width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
		  <td width="105" style="color:#ac0404; font-size:14px; font-weight:bold;">City</td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Pincode</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Information For</td>
        <!--  <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td></tr>
		  -->
		  </table>
           
           <div id="telsearch"><table border="1" >       
           <?php while($row=mysqli_fetch_row($result))
{  ?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
	<td width="110"> <?php echo $row[1]; ?></td>
    <td width="105"> <?php echo $row[2]; ?></td>
    <td> <?php if(isset($row[3])) {echo $row[3];}?></td>
    <td> <?php echo $row[4]; ?></td>
	<td width="95"> <?php echo $row[5]; ?></td>
    <td> <a href='edit_teldir.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete2(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
<?php } ?>
</table></div>
</div>
<button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
<!--
Search By: 

<select name="search" id="search" onchange="document.getElementById('searchtxt').value=''">
      <option value="contact">Contact No.</option>
      <option value="pincode">Pincode</option>
</select>
           
           <input type="text" onkeyup="ajax_showOptions(this,document.getElementById('search').value,event);" id="searchtxt" name="searchtxt"/>
           <input name="submit" type="submit" value="SEARCH" id="submit" onclick="MakeRequest();" style="width:90px; height:25px; background-color:#ac0404; border:1px #ac0404 solid; color:#FFF; cursor:pointer;"/>
--></div>
</body></html>