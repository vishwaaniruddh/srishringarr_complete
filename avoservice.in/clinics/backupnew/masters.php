<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
	include('template_clinic.html');
    include('config.php');
?>
<style>
 td{border:none;}
</style>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script language="javascript" type="text/javascript">

window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		no();
	};
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>
<style>
#master input{
	background:#C2EDE4;
	border-color:#CCC; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
        -webkit-border-radius: 4px;
	color:#000;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 3px;
	margin-top:10px;
	font:12px; 
	width:197px;}
	</style>
    
    <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

	<div class="M_page">
          
                
            
           
        <fieldset class="textbox">
        <legend><h1><img src="ddmenu/master.png" height="50" width="50">Master Info</h1></legend>
        <table id="master">
                
                <tr> 
            	<td width="174" height="33"><a href="view_admitorder.php"><input type="button" value="Admit Orders" onClick="javascript:location.href = 'view_admitorder.php';"/></a></td>
                <td width="233"><a href="view_phygoal.php"><input type="button" value="Physiotherapy Goals" onClick="javascript:location.href = 'view_phygoal.php';"/></a> </td>                
                <td width="217"><a href="view_opdcollheads.php"><input type="button" value="OPD Collection Heads" onClick="javascript:location.href = 'view_opdcollheads.php';"/></a></td>
                <td width="278"><a href="view_treatgiven.php"><input type="button" value="Treatment Given" onClick="javascript:location.href = 'view_treatgiven.php';"/></a></td>
                </tr>
	
                <tr>
                <td height="33"><a href="view_dosage.php"><input type="button" value="Dosage Instructions" onClick="javascript:location.href = 'view_dosage.php';"/></a></td>
                <td><a href="viewhospital.php"><input type="button" value="Hospitals"  onClick="javascript:location.href = 'viewhospital.php';"/></a></td>
                
                <td><a href="viewcity.php"><input type="button" value="City"  onClick="javascript:location.href = 'viewcity.php';"/></a></td>
                <td><a href="viewaction.php"><input type="button" value="Action Plan" onClick="javascript:location.href = 'viewaction.php';"/></a></td>
                </tr>
                                
                <tr>
                <td height="33"><a href="view_treatadvise.php"><input type="button" value="Treatment Advised" onClick="javascript:location.href = 'view_treatadvise.php';"/></a></td>
                <td><a href="view_clinicaldetail.php"><input type="button" value="Clinical Details" onClick="javascript:location.href = 'view_clinicaldetail.php';"/></a></td>
                
                <td><a href="view_diagkey.php"><input type="button" value="Diagnosis Keywords" onClick="javascript:location.href = 'view_diagkey.php';"/></a></td>
                <td>
                <a href="viewarea.php"><input type="button" onClick="javascript:location.href = 'viewarea.php';" value="Areas" /></a>
                </td>
                </tr>
                             
                <tr>
                <td><a href="viewspecial.php"><input type="button" value="Specialities" onClick="javascript:location.href = 'viewspecial.php';"/></a></td>
                <td><a href="viewcomplain.php"><input type="button" value="Complaints" onClick="javascript:location.href = 'newcomplain.php';"/></a></td>
                
                <td><a href="view_diagnosis.php"><input type="button" value="Diagnosis" onClick="javascript:location.href = 'view_diagnosis.php';"/></a></td>
                <td>
                <a href="view_invest.php"><input type="button" value="X-Ray Reports OR Investigations" onClick="javascript:location.href = 'view_invest.php';"/></a></td>
                </tr>
                
                <tr>
                <td height="33"><a href="viewmedicines.php"><input type="button" value="Medicines" onClick="javascript:location.href = 'viewmedicines.php';"/></a></td>
                <td><a href="#"><input type="button" value="Operations" onClick="javascript:location.href = '#';"/></a></td>
                
                <td><a href="view_instruction.php"><input type="button" value="Instructions" onClick="javascript:location.href = 'view_instruction.php';"/></a></td>
                <td>
               <a href="view_dosage.php"><input type="button" value="Dosage" onClick="javascript:location.href = 'view_dosage.php';"/></a>
                </td>
                </tr>
          </table>
          
          
        </fieldset>
          </form>
	
</div>