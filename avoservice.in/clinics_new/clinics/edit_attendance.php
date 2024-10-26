<?php 
include 'config.php';

session_start();
$id=$_GET['id'];


$sql="select * from  attendence where att_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);


$sql1="select name from staff_master where staff_id='$row[2]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);


$time=$row[4];
list($hr, $min) = explode(":", $time);

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

       
          <form method="post" class="signin" action="update_attendence.php"  name="attform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Attendence</p>
                
                <label class="cdate">
                <span> Attendance Date: </span>
                <input id="cdate" name="cdate" type="text"  value="<?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?>" style="background-color:#DCDCDC;" readonly>
                </label>
                
                <label class="name">
                <span>Full Name: </span>
                <input id="name" name="name" type="text" value="<?php echo $row1[0]; ?>" readonly="readonly" style="background-color:#DCDCDC;">
                </label>
                                            
                                
                <label class="present"><span>Present</span>
                <select name="present" id="present"  >
                <option value="Yes" <?php if($row[3]=="Yes")echo "selected"; ?>  >Yes </option>
                <option value="No" <?php if($row[3]=="No")echo "selected"; ?> >No </option>
                </select>
                </label>
          
                <label class="time">
                <span><b> Time: </b></span><span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00" <?php if($hr==00)echo "selected"; ?>>00</option>
                <option value="01" <?php if($hr==01)echo "selected"; ?>  >01</option>
                <option value="02" <?php if($hr==02)echo "selected"; ?> >02</option>
                <option value="03" <?php if($hr==03)echo "selected"; ?> >03</option>
                <option value="04" <?php if($hr==04)echo "selected"; ?> >04</option>
                </select>
                
                
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00" <?php if($min==00)echo "selected"; ?>>00</option>
                <option value="05" <?php if($min==05)echo "selected"; ?>>05</option>
                <option value="10" <?php if($min==10)echo "selected"; ?>>10</option>
                <option value="15" <?php if($min==15)echo "selected"; ?>>15</option>
                <option value="20" <?php if($min==20)echo "selected"; ?>>20</option>
                </select>
                </label>
                
                <label id="ot">
                <span>OT: </span>
                <input type="text" name="ot" id="ot" value="<?php echo $row[5]; ?>" />
                </label>
                 
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;&nbsp;
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button>
                       
                </fieldset>
          </form>
</div>