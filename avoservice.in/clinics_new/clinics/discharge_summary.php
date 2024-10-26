<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql1="select * from patient where no='$row[1]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

?>

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
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.2em;
	position: relative;
	top: 0%; left: 3%;
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
	width:200px;
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
<script>
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

////for print
function pres(){

	var pd=document.getElementById('pd').value; 
	var fd=document.getElementById('fd').value;
	var inv=document.getElementById('inv').value;
	var jj=document.getElementById('jj').value;
	var jjdate=document.getElementById('jjdate').value;
	var uc=document.getElementById('uc').value;
	var ucdate=document.getElementById('ucdate').value;
	var op=document.getElementById('op').value;
	var po=document.getElementById('po').value;
	var proc=document.getElementById('proc').value;
	var add_proc=document.getElementById('add_proc').value;
	var treat=document.getElementById('treat').value;
	var adv=document.getElementById('adv').value;
	var visit=document.getElementById('visit').value;
	
	popcontact('discharge_print.php?id=<?php echo $id; ?>&pd='+pd+'&fd='+fd+'&inv='+inv+'&jj='+jj+'&jjdate='+jjdate+'&uc='+uc+'&ucdate='+ucdate+'&op='+op+'&po='+po+'&proc='+proc+'&add_proc='+add_proc+'&treat='+treat+'&adv='+adv+'&visit='+visit);
	
	//popcontact('discharge_print.php?id=<?php //echo $id; ?>&pd='+pd+'&fd='+fd+'&inv='+inv+'&jj='+jj+'&jjdate='+jjdate+'&uc='+uc+'&ucdate='+ucdate);
	
}


</script>
<!--Discharge form-->
<div  class="login-popup">

            
          <form method="post" class="signin" action="new_discharge.php" >
          
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge Summary</p>
           
                <input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                
                <table id="ds">
                
                <tr> 
            	<td ><label class="patientid"> Patient ID : </label></td>
                <td ><input id="pid" name="pid" type="text"  value="<?php echo $row[1]; ?>"readonly style="background-color:#DCDCDC;"></td>
                <td><input id="name" name="name" type="text" value="<?php echo $row1[1]; ?>" readonly style="background-color:#DCDCDC;"></td>
                
                </tr>
                
                <tr>
                <td ><label class="datead">Date of Admission:</label></td>
                <td > <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>" readonly="readonly"></td>
                
                <td ><label class="datead">Date of Discharge:</label></td>
                <td > <input id="datedis" name="datedis" type="text" onClick="displayDatePicker('datedis');" value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>"></td>
                </tr>               
                
                <tr>
                <td><label class="pro_diag">Provisional Diagnosis:</label></td>
                <td><input id="pd" name="pd" type="text" ></td>
				
                <td><label class="fdiag">Final Diagnosis:</label></td>
                <td><input id="fd" name="fd" type="text" ></td>
                </tr>
                
                 <tr>
                <td><label class="inv">Investigations:</label></td>
                <td><textarea name="inv" id="inv" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td>JJ stent: </td><td><input id="jj" name="jj" type="text"></td>
                <td>Removal Date:</td><td><input id="jjdate" name="jjdate" type="text" onClick="displayDatePicker('jjdate');"></td></tr>
               
               <tr> <td>Uretric Cath: </td><td><input id="uc" name="uc" type="text" ></label></td>
                <td>Removal Date:</td><td><input id="ucdate" name="ucdate" type="text" onClick="displayDatePicker('ucdate');"></td>
               
                </tr>
                
                <tr>
                <td><label class="oper">Operations:</label></td>
                <td><input id="op" name="op" type="text"  ></td>
               
                <td><label class="post">Post Operative T/t:</label></td>
                <td><input id="po" name="po" type="text" ></td>
                </tr>
                
                <tr>
                <td><label class="proc">Procedure:</label></td>
                <td><textarea name="proc" id="proc" rows="3" cols="22" style="resize:none;"></textarea></td>
                
                <td><label class="add_proc">Additional Procedure:</label></td>
                <td><textarea name="add_proc" id="add_proc" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="treatment">Treatment on Discharge:</label></td>
                <td><textarea name="treat" id="treat" rows="3" cols="22" style="resize:none;"></textarea></td>
                
                <td><label class="advice">Advice:</label></td>
                <td><textarea name="adv" id="adv" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="visit">Visit at OPD On:</label></td>
                <td><input id="visit" name="visit" type="text" ></td>
                </tr>
               
<!--end discharge form-->
                                              
                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>&nbsp;&nbsp;
                <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button>
                </td>
                </tr>
                </table>         
                </fieldset>
          </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>