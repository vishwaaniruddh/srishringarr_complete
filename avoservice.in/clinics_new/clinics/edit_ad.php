<?php 
include 'config.php';

session_start();
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$pid=$row[1];
$sql1="select * from patient where no='$pid'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

$did=$row[2];
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_row($result2);

$time=$row[4];
list($hr, $min) = explode(":", $time);

$time1=$row[6];
list($hr1, $min1) = explode(":", $time1);

?>

<!-- validation-->
<script type="text/javascript">

function advalidate(adform){
 with(adform)
 {
  

if(addate.value=="")
{
	alert("Please select Admission Date");
	addate.focus();
	return false;
}

if(disdate.value=="")
{
	alert("Please select Discharge Date");
	disdate.focus();
	return false;
}
 
}
 return true;
 }
 
/////////////////////////////
function chkroom()
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
    {
		
    document.getElementById("room1").innerHTML=xmlhttp.responseText;
    }
  }
    var disdate=document.getElementById('disdate').value;
	 var addate=document.getElementById('addate').value;

xmlhttp.open("GET", 'room.php?disdate='+disdate+'&addate='+addate, true);
xmlhttp.send();
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
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.2em;
	position: relative;
	top: 1%; left: 15%;
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

       
          <form method="post" class="signin" action="update_ad.php" onSubmit="return advalidate(this)" name="adform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Admission</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />                
            	<table>
                <tr>
                <td><label class="name"><span> Name: </span></label></td>
                <td><input id="name" name="name" type="text" autocomplete="on"  value="<?php if(isset($row1[6])) {echo $row1[6];} ?>" readonly style="background-color:#DCDCDC;"></td>
                
<?php 

$result3 = mysqli_query($con,"select doc_id,name from doctor ");
?>
            
                <td><label class="doc">
                <span>Doctor:</span></label></td>
				<td>				
                <select name="doc" style="background:#fff;border:1px solid #ac0404;width:300px; height:27px; border-radius: 3px 3px 3px 3px; -moz-border-radius: 3px;-webkit-border-radius: 3px;">
               
                <option value="<?php echo $row2[0]; ?>"><?php if(isset($row2[1])) {echo $row2[1];} ?></option> 
			    
				<?php while($row3=mysqli_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>

                <tr>
                <td><label class="addate"><span>Admitted on :</span></label></td>
                <td><input id="addate" name="addate" type="text" onClick="displayDatePicker('addate');" value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>" /></td>
                <td><label class="time"><span><b> Time Given: </b></span></label></td>
                <td>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				<option value="<?php echo $hr; ?>" ><?php echo $hr; ?></option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                 <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                </select>
   
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				<option value="<?php echo $min; ?>" ><?php echo $min; ?></option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                </select>
                </td>
                </tr>
                
<!--date difference-->   
<script>
	 function formshowhide(){
      var t1=document.getElementById('addate').value;
	  var t2=document.getElementById('disdate').value;
	  var one_day=1000*60*60*24; 

        var x=t1.split("/");     
        var y=t2.split("/");
  //date format(Fullyear,month,date) 

     var date1=new Date(x[2],(x[1]-1),x[0]);
  
     var date2=new Date(y[2],(y[1]-1),y[0])
     var month1=x[1]-1;
     var month2=y[1]-1;
        
        //Calculate difference between the two dates, and convert to days
               
     _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day)); 
		
document.getElementById('stay').value = _Diff;
				}
</script>
                 <tr>
                 <td><label class="disdate"><span>Discharged on :</span> </label></td>
                 <td>  <input id="disdate" name="disdate" type="text" onClick="displayDatePicker('disdate');" value="<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?>"></td>
                 <td><label class="time"><span><b> Time Given: </b></span></label></td>
                 <td>
                 <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				 <option value="<?php echo $hr1; ?>" ><?php echo $hr1; ?></option>
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                 </select>
   
                 <select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
				 <option value="<?php echo $min1; ?>" ><?php echo $min1; ?></option>
                 <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                 </select>
                 </td>
                 </tr>
<?php
$result3=mysqli_query ($con, "select * from room ");
?>                
                <tr>
                <td><label class="stay"><span>Stay in Days</span> </label></td>
                <td><input type="text" id="stay" name="stay"  readonly="readonly" onclick="formshowhide();chkroom()" onfocus="formshowhide();" value="<?php echo $row[7]; ?>" ></td>
                <td><label class="room"><span>Room no :</span> </label></td>
                <td> <div id="room1">
                <select name="room" id="room" style="width:125px;">
				
                <?php while ($row3=mysqli_fetch_row($result3)) { ?>
				<option value="<?php echo $row3[0]; ?>" <?php if($row3[0]==$row[8]){ echo "selected"; }?>><?php echo $row3[1]; ?></option>
				<?php } ?>
                </select>
                </div></td>
                </tr>
               
                <tr>
                <td><label class="final"><span>Final Diagnosis :</span>  </label></td>
                <td><textarea name="final" id="final" rows="3" cols="36" style="resize:none"><?php echo $row[9]; ?></textarea></td>
                <td><label class="allergies"><span>Allergies :</span>  </label></td>
                <td><textarea name="all" id="all" rows="3" cols="36" style="resize:none"><?php echo $row[10]; ?></textarea></td>
                </tr>
                 
                <tr>
                <td><label class="present"><span>Symptoms of present illness :</span>  </label></td>
                <td><textarea name="present" id="present" rows="3" cols="36" style="resize:none"><?php echo $row[11]; ?></textarea></td>
                <td><label class="past"><span>Past illness :</span>  </label></td>
                <td><textarea name="past" id="past" rows="3" cols="36" style="resize:none"><?php echo $row[12]; ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="sys"><span>Systematic Examination :</span>  </label></td>
                <td><textarea name="sys" id="sys" rows="3" cols="36" style="resize:none"><?php echo $row[13]; ?></textarea></td>
                <td><label class="local"><span>Local Examination :</span>  </label></td>
                <td><textarea name="local" id="local" rows="3" cols="36" style="resize:none"><?php echo $row[14]; ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="pro"><span>Provisional Diagnosis :</span>  </label></td>
                <td><textarea name="pro" id="pro" rows="3" cols="36" style="resize:none"><?php echo $row[15]; ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="general"><span><b><u> General Examination : </u></b></span> </label></td>
                </tr>
                 
                <tr>
                <td> <label class="built"><span>Built :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="built" name="built" value="<?php echo $row[16]; ?>"/></td>
                <td> <label class="temp"><span>Temperature :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="temp" name="temp" value="<?php echo $row[17]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="nourish"><span>Nourishment :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="nour" name="nour" value="<?php echo $row[18]; ?>"/></td>
                <td> <label class="pulse"><span>Pulse :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="pulse" name="pulse" value="<?php echo $row[19]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="aneama"><span>Anaema :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="aneama" name="aneama" value="<?php echo $row[20]; ?>"/></td>
                <td> <label class="rspiration"><span>Respiration :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="resp" name="resp" value="<?php echo $row[21]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="cyanosis"><span>Cyanosis :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="cya" name="cya" value="<?php echo $row[22]; ?>"/></td>
                <td> <label class="lying"><span>Lying BP Down :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="lying" name="lying" value="<?php echo $row[23]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="oedema"><span>Oedema :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="oedema" name="oedema" value="<?php echo $row[24]; ?>"/></td>
                <td> <label class="bp"><span>BP Sitting :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="bp" name="bp" value="<?php echo $row[25]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="jaundice"><span>Jaundice :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="jau" name="jau" value="<?php echo $row[26]; ?>"/></td>
                <td> <label class="skin"><span>Skin :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="skin" name="skin" value="<?php echo $row[27]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="throat"><span>Throat :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="throat" name="throat" value="<?php echo $row[28]; ?>"/></td>
                <td> <label class="nails"><span>Nails :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="nail" name="nail" value="<?php echo $row[29]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="tongue"><span>Tongue :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="tongue" name="tongue" value="<?php echo $row[30]; ?>"/></td>
                <td> <label class="other"><span>Other :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="other" name="other" value="<?php echo $row[31]; ?>"/></td>
                </tr>
                
                <tr>
                <td> <label class="remarks"><span>Lymph Nodes :</span> </label></td>
                <td> <input type="text" style="width:120px;" id="lymph" name="lymph" value="<?php echo $row[32]; ?>"/></td>
                </tr>
                </table>
				
				<input id="id" name="id" type="hidden" value="<?php echo $id; ?>">              
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
</div>