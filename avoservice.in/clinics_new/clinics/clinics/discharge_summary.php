<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$sql1="select * from new_patient where patient_id='$row[1]'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

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

<!--Discharge form-->
<div  class="login-popup">

            
          <form method="post" class="signin" action="new_discharge.php" >
          
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge Summary</p>
           
                <input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                
                <table id="ds">
                
                <tr> 
            	<td ><label class="patientid"> Patient ID : </label></td>
                <td ><input id="pid" name="pid" type="text"  value="<?php echo $row[1]; ?>"readonly style="background-color:#DCDCDC;">&nbsp;<input id="name" name="name" type="text" value="<?php echo $row1[1]; ?>" readonly style="background-color:#DCDCDC;"></td>
                
                </tr>
                
                <tr>
                <td ><label class="datead">Date of Admission:</label></td>
                <td > <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>" readonly="readonly"></td>
                </tr>  
                
                <tr>
                <td ><label class="datead">Date of Discharge:</label></td>
                <td > <input id="datedis" name="datedis" type="text" onClick="displayDatePicker('datedis');" value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>"></td>
                </tr>               
                
                <tr>
                <td><label class="pro_diag">Provisional Diagnosis:</label></td>
                <td><input id="pd" name="pd" type="text" ></td>
				</tr>
                
                <tr>
                <td><label class="inv">Investigations:</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Final Diagnosis:</label></td>
                <td><input id="fd" name="fd" type="text" ></td>
                </tr>
                
                <tr>
                <td>JJ stent:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="jj" name="jj" type="text"  style="width:50px;"></td>
                <td>Removal Date:&nbsp;<input id="jjdate" name="jjdate" type="text" onClick="displayDatePicker('jjdate');"></td>
                </tr>
                
                <tr>
                <td>Uretric Cath:<input id="uc" name="uc" type="text"  style="width:50px;"></label></td>
                <td>Removal Date:&nbsp;<input id="ucdate" name="ucdate" type="text" onClick="displayDatePicker('ucdate');"></td>
               
                </tr>
                
                <tr>
                <td><label class="oper">Operations:</label></td>
                <td><input id="op" name="op" type="text"  ></td>
                </tr>
                
                <tr>
                <td><label class="proc">Procedure:</label></td>
                <td><textarea name="proc" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="post">Post Operative T/t:</label></td>
                <td><input id="po" name="po" type="text" ></td>
                </tr>
                
                <tr>
                <td><label class="add_proc">Additional Procedure:</label></td>
                <td><textarea name="add_proc" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="treatment">Treatment on Discharge:</label></td>
                <td><textarea name="treat" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="advice">Advice:</label></td>
                <td><textarea name="advice" rows="2" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="visit">Visit at OPD On:</label></td>
                <td><input id="visit" name="visit" type="text" ></td>
                </tr>
               
<!--end discharge form-->
                                              
                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
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