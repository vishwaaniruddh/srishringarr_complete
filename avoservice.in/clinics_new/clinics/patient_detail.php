<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{

include 'config.php';
if(isset($_GET['id'])){

	$id=$_GET['id'];
}

// echo $id;
$result = mysqli_query($con,"select * from patient where no='$id'");
// echo $result;


?>

<script type="text/javascript">
function confirm_delete5(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_patient.php?id="+id;
	}
	
}
</script>

<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
	
var a = document.opdform.diagnosis;
//alert(a.value);
var add = a.value+',';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+',';

document.opdform.recm.value += add;
return true;
}
</script>
<!-- end multiple selection -->

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
	top: 1%; left: 30%;
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

.link { 
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
	width:60px;
}

form.signin td{ font-size:12px; }
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div id="" class="login-popup">

 <form method="post" class="signin" action="new_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
         
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient Details</p>
                
        <table border="1"  width="105%" style="border:2px #ac0404 solid;"> 
        
         <?php while($row=mysqli_fetch_row($result))
{  ?> 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td><td width="175"><?php echo $row[2]; ?></td></tr>
<tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">ESI NO.</td><td width="175"><?php echo $row[39]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name</td><td> <?php echo $row[6]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">DOB</td><td> <?php if(isset($row[25]) and $row[25]!='0000-00-00') echo date('d/m/Y',strtotime($row[25])); ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</td><td> <?php echo $row[26]; ?></td></tr>
  
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</td> <td> <?php echo $row[27]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td><td> <?php echo $row[23]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td><td> <?php echo $row[18]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td><td> <?php echo $row[20]; ?></td></tr
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Addhar No:</td><td> <?php echo $row[45]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Blood group</td><td> <?php echo $row[37]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Marital Status</td> <td> <?php echo $row[38]; ?></td></tr>
 
 <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Height</td><td> <?php echo $row[36]; ?></td></tr>
 
 
          
<?php 

$result1 = mysqli_query($con,"select * from doctor where doc_id='$row[9]'");
$row1=mysqli_fetch_row($result1);

/*$fid=$row[13]; 

$result2 = mysqli_query($con,"select doc_id,name from doctor where doc_id='$fid'");
$row2=mysqli_fetch_row($result2);*/
?>
   
         <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By</td><td> <?php if(isset($row1[1])){ if($row1[1]==""){ echo  $row[1]; }else { echo $row1[1]; }}?></td></tr>
         
       <!--  <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Constultation/Follow-up</td><td> <?php echo $row[0]; ?></td></tr>
         
         <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Diagnosis</td><td> <?php echo $row[41]; ?></td></tr>
          
         <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Referral Date</td><td> <?php if(isset($row[40]) and $row[40]!='0000-00-00') echo date('d/m/Y',strtotime($row[40])); ?></td></tr>
         
         <tr><td width="118" height="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Ref No</td><td> <?php echo $row[42]; ?></td></tr>
         --> 
          <td height="30" colspan="2"> <a href='edit_patient.php?id=<?php echo $row[2]; ?>' class="link"> Edit </a> &nbsp;&nbsp;&nbsp;
          <a href="javascript:confirm_delete5(<?php echo $row[2]; ?>);" class="link">  Delete </a> &nbsp;&nbsp;&nbsp;
          <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_patient.php';">Go Back</button>
          </td>
         </tr>
<?php } ?> 

</table>
</fieldset></form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>