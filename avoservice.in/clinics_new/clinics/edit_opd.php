<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from opd where opd_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$pid=$row[1];

$sql1="select * from patient where no='$pid'";
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
	position: relative;
	top: 1%; left: 20%;
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

form.signin p, form.signin span,label { 
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

<!-- validation-->
<script type="text/javascript">

function opdvalidate(opdform){
 with(opdform)
 {
  

if(date.value=="")
{
	alert("Please select Date");
	date.focus();
	return false;
}
 
}
 return true;
 }
</script><!--end validation-->

<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
	
var a = document.opdform.diagn;
//alert(a.value);
var add = a.value+',';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+',';

document.opdform.adv.value += add;
return true;
}

function addThem2(){
	
var a = document.opdform.compl;
//alert(a.value);
var add = a.value+',';

document.opdform.comp.value += add;
return true;
}

function addThem3(){
	
var a = document.opdform.findi;
//alert(a.value);
var add = a.value+',';

document.opdform.findin.value += add;
return true;
}

 ////upload image
function upp(){
var newdiv=document.createElement("div");
var aTextBox=document.createElement('input');
aTextBox.type = 'file';
aTextBox.name = 'image[]';
aTextBox.style='background:none; border:none;';

 //append text to new div
newdiv.appendChild(aTextBox); //append text to new div
//alert(aTextBox)
document.getElementById("img").appendChild(newdiv); 
}
</script>

<div id="" class="login-popup">

       
          <form method="post" class="signin" action="update_opd.php" onSubmit="return opdvalidate(this)" name="opdform" enctype="multipart/form-data">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit OPD</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $row[1]; ?>"/>
                
            	<table>
                 <tr>
                <td>Upload Report</td>
                <td colspan="3"><div id="img">
                <?php $pho=mysqli_query($con,"select * from patient_photo where opd_id='$id' and patient_id='$pid'");
				while($pho1=mysqli_fetch_row($pho)){?>
               <img src="<?php echo $pho1[3]; ?>" width="62" height="62"/> <input type="Text" name="old[]" value="<?php echo $pho1[3]; ?>" /><input type="file" name="image[]" id="image[]" style="background:none; border:none;">
                <?php }?></div>
                <br/>
                <a href="#" onclick="upp()">Add More</a><br/></td>
                </tr>
                <tr><td> <label class="name">
                Name: </label></td>
                <td><input id="name" name="name" type="text" value="<?php if(isset($row1[6])) {echo $row1[6]; }?>" readonly style="background-color:#DCDCDC;"/>
                </td>
                
               <td> <label class="age">
                Age: </label></td><td>
                <input id="age" name="age" type="text" value="<?php if(isset($row1[26])) {echo $row1[26];} ?>" readonly style="background-color:#DCDCDC;"/>
                </td></tr>
                                
               <tr><td> <label class="cn">
               Contact No.: </label></td><td>
                <input id="cn" name="cn" type="text" value="<?php if(isset($row1[23])) {echo $row1[23];} ?>" readonly style="background-color:#DCDCDC;"/>
               </td>
                
               <td> <label class="date">
                 Date:  </label></td><td>
                <input id="date" name="date" type="text" onClick="displayDatePicker('date');" value="<?php if(isset($row[76]) and $row[76]!='0000-00-00') echo date('d/m/Y',strtotime($row[76])); ?>">
               </td></tr></table>
               
                <?php
include 'config.php';
$result4=mysqli_query($con,"select * from compla");
?>     
                <table><tr><td> <label class="comp">
                <span> Complaints: </span>
                <select name="compl" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem2()">
                <?php while ($row4=mysqli_fetch_row ($result4))
				{ ?>
                <option value="<?php echo $row4[0];?>"><?php echo $row4[0];?></option>
                <?php } ?>
					
                </select><br />
                <textarea name="comp" cols="35" rows="3" style="resize:none;"><?php echo $row[29]; ?></textarea>
                </label></td>
                
              <?php
$result5=mysqli_query($con,"select * from finding");
?><td><label class="find">
                <span> Findings: </span>
                <select name="findi" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem3()">
                <?php while ($row5=mysqli_fetch_row ($result5))
				{ ?>
                <option value="<?php echo $row5[0];?>"><?php echo $row5[0];?></option>
                <?php } ?>
                </select><br />
                <textarea name="findin" cols="35" rows="3" style="resize:none;"><?php echo $row[77]; ?></textarea>
                </label></td></tr>
<?php
include 'config.php';
$result6=mysqli_query($con,"select * from advise");
?>                
                <tr><td><label class="rec">
                <span>Advised:</span>
                <select name="rec" style="background:#fff; border:1px #ac0404 solid;width:300px; alignment-adjust:central;" onChange="addThem1()">
                <?php while ($row6=mysqli_fetch_row ($result6))
				{ ?>
                <option value="<?php echo $row6[0];?>"><?php echo $row6[0];?></option>
                <?php } ?>
                </select><br />
                <textarea name="adv" cols="35" rows="3" style="resize:none;"><?php echo $row[36]; ?></textarea>
                </label></td>
<?php 
include 'config.php';
$result3 = mysqli_query($con,"select * from diag");
?>               
                <td><label class="diagnosis">
                <span> Diagnosis: </span>
                <select name="diagn" style="width:300px; border:1px #ac0404 solid;" onChange="addThem()">
                <?php while($row3=mysqli_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row3[0]; ?>"><?php echo $row3[0]; ?></option>
				<?php } ?>
                </select><br />
                <textarea name="diag" cols="35" rows="3" style="resize:none;"><?php echo $row[30]; ?></textarea>
                </label></td></tr></table>
                
<?php 
$med = explode(',',$row[78]);

$tak= explode(',',$row[79]);
$dos = explode(',',$row[80]);



?>               
                <table border="1">
                <th>Medicine Name </th><th>How to Take </th><th>Dosage </th>
               <?php  for($i = 0; $i < count($med); $i++){ ?>
                <tr>
                <td><select style="width:140px;" name="med[]">
                <option value="0">Select</option>
                <?php $result3 = mysqli_query($con,"select * from medicine ");
				    while($row=mysqli_fetch_row($result3)){ ?>
                 
					<option value="<?php echo $row[0]; ?>" <?php if($med[$i]==$row[0]) echo "selected"; ?>><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td>


                
<?php 

$result4 = mysqli_query($con,"select * from medicine");
?>                  
                <td><select style="width:140px;" name="tak[]">
                <option value="0">Select</option>
                 <?php 
				    while($row=mysqli_fetch_row($result4)){ ?>
					<option value="<?php echo $row[2]; ?>" <?php if($tak[$i]==$row[2]) echo "selected"; ?>><?php echo $row[2]; ?></option>
				 <?php } ?>
                </select>
                </td>
                
                <td><select style="width:140px;" name="dos[]">
                <option value="0">Select</option>
                <option value="1..0..0" <?php if($dos[$i]=="1..0..0") echo "selected"; ?>>1..0..0</option>
                <option value="1..0..1" <?php if($dos[$i]=="1..0..1") echo "selected"; ?>>1..0..1</option>
                <option value="1..1..1" <?php if($dos[$i]=="1..1..1") echo "selected"; ?>>1..1..1</option>
                <option value="0..0..1" <?php if($dos[$i]=="0..0..1") echo "selected"; ?>>0..0..1</option>
                <option value="0..1..1" <?php if($dos[$i]=="0..1..1") echo "selected"; ?>>0..1..1</option>
                <option value="1..1..1..1" <?php if($dos[$i]=="1..1..1..1") echo "selected"; ?>>1..1..1..1</option>
                <option value="1/2..0..0" <?php if($dos[$i]=="1/2..0..0") echo "selected"; ?>>1/2..0..0</option>
                </select>

                </td>
                </tr>
                

               

<?php 
			   }
//include 'config.php';
//$result3 = mysqli_query($con,"select * from medicines");
?>
             </table>
              <input id="id" name="id"  readonly type="text" value="<?php if($id!=''){ echo $id; } ?>">                             
                <button class="submit formbutton" type="submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_opd.php';">Cancel</button></a>
                  

                <tr>
                <td colspan="3">
                     
                <table border="1" id="med" style="display:none;" >
                <?php for($r=1;$r<=3;$r++){ ?>
                <tr>
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                <?php  $result3 = mysqli_query($con,"select * from medicines ");
				    while($row=mysqli_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
                </td>
                
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                 <?php  $result4 = mysqli_query($con,"select * from how_to_take ");
				    while($row=mysqli_fetch_row($result4)){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
				 <?php } ?>
                </select>
                </td>
                
                <td>
                <select style="width:140px;">
                <option value="0">Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
                </td>
                </tr>

<?php } ?>
                </table>
                
                </td></tr>
                <tr><td align="right" colspan="3" style="border:none;"><a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;">Add More </a>    </td></tr>
                                  
                                               
                
                    
                </fieldset>
          </form>
</div>
<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript">
$(function()
{

$("#add").click(function(event) {
event.preventDefault();
$("#med").slideToggle();
});

$("#med a").click(function(event) {
event.preventDefault();
$("#med").slideUp();
});
});
</script>