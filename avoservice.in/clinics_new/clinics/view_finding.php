<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
function confirm_deletefind(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_finding.php?id="+id;
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
$result6 = mysqli_query($con,"select * from finding");
?>
<div id="view_finding" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="view_find.php" name="viewfindform" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Findings</p><br />
                
            	                
                <table border="1">   
               
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                           
                <?php while($row6=mysqli_fetch_row($result6))
{  
?>
	<tr>
    
    <td width="55">  <?php  echo  $row6[1]; ?></td>
	<td width="110"> <?php echo $row6[0]; ?></td>
    <td> <a href='edit_finding.php?id=<?php echo $row6[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletefind(<?php echo $row6[1]; ?>);"> Delete </a></td>
    </tr>
    <?php } ?>
                </table>
               
             <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
          
                </fieldset>
          </form>
</div>
</body></html>