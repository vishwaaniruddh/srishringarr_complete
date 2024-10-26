<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

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

<div id="discharge" class="login-popup">

<?php 
include 'config.php';
$result = mysqli_query($con,"select * from admission where ad_id not in(select ad_id from discharge)");
?>

        <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>

        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge</p><br />
        
          <table border="1" style="border:2px #ac0404 solid; text-align:left;">
          
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
          <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Doctor</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Discharge Date </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Days </th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Room no. </th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Discharge</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">ESI</th>
        
                   
            <?php while($row=mysqli_fetch_row($result))
{  
$result1 = mysqli_query($con,"select * from patient where no='$row[1]'");
$row1=mysqli_fetch_row($result1);
$result2 = mysqli_query($con,"select * from doctor where doc_id='$row[2]'");
$row2=mysqli_fetch_row($result2);
?>

	<tr>
	<//?php if(isset($row1[6])){ if($row1[6]==""){ echo  $row[1]; }else { echo $row1[6]; }}?>
    <td width="110"> <?php if(isset($row1[6])){ if($row1[6]==""){ echo  $row[1]; }else { echo $row1[6]; }}?>
	<td width="110"> <?php if(isset($row2[1])){ if($row2[1]==""){ echo  $row[2]; }else { echo $row2[1]; }}?></td>
    <td width="105"> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td width="105"> <?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td width="105"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php echo $row[8]; ?></td>
    <td> <a href='discharge_summary.php?id=<?php echo $row[0]; ?>'> Discharge </a></td>
    <td> <a href='esi.php?id=<?php echo $row[0]; ?>'> ESI </a></td>
        
    </tr>
<?php } ?>
</table>
</div>
</body></html>