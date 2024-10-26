<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from leave_report where leave_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql1="select staff_id,name from staff_master where staff_id='$row[2]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);



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
	top: 1%; left: 35%;
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


<div id="" class="login-popup">

       
          <form method="post" class="signin" action="update_leave.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Leave Record</p>
                
            	<table>
            	<tr>
                <td><label class="Date">From Date:</label></td>
                <td><input id="frmdate" name="frmdate" type="text" onclick="displayDatePicker('frmdate');" value="<?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?>">
                </td>
                </tr>
                
                <tr>
                <td><label class="Date">To Date:</label></td>
                <td><input id="todate" name="todate" type="text" onclick="displayDatePicker('todate');" value="<?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?>">
                </td>
                </tr>                
                
                <tr>
                <td><label class="name"> Name: </label></td>
                <td><select name="name" style="width:300px; height:26px;">
                
				<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				 <?php
				 $sql2="select staff_id,name from staff_master ";
                 $result2 = mysqli_query($con,$sql2);
                 while($row2=mysqli_fetch_row($result2))
                {  ?>
                <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td>
                <label id="remarks">Remarks:</label></td>
                <td> <textarea id="remarks" name="remarks" style="resize:none" rows="3" cols="35"><?php echo $row[3]; ?></textarea></td>
                </tr>
                
                </table>
         
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
</div>