<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
<!--
function confirm_deldelete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_delivery.php?id="+id;
  }
}
//-->
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

<div id="view_delivery" class="login-popup">

<?php 

include 'config.php';

$result = mysqli_query($con,"select * from delivery");

?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center"> Delivery Details</p> <br />
        
          <table border="1" style="border:2px #ac0404 solid;">
               
          <th width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Ad_date</th>
          <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Dis_date</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;"> Ad_time</th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Dis_time </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">BirthDate </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Birth_time </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Weight </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">BloodGroup </th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Type </th>
          
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
            <?php while($row=mysqli_fetch_row($result))
{  
?>
	<tr>
    
    <td> <?php echo $row[1]; ?></td>
	<td width="150"> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[7]; ?></td>
    <td> <?php echo $row[8]; ?></td>
    <td> <?php echo $row[9]; ?></td>
    <td> <?php echo $row[10]; ?></td>
    <td> <a href='edit_delivery.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deldelete(<?php echo $row[0]; ?>);"> Delete </a></td>
    </tr>
<?php } ?>
</table>
<button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
</div>
</body></html>