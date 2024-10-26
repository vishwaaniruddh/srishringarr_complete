<?php 
session_start();
include('template.html');
include('config.php');


$id=$_GET['id'];

$sql="select * from discharge_summary where dis_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$sql1="select * from admission where ad_real_id='$row[2]'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$sql2="select * from patient where srno='$row[1]'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);


?>
<style>
td{border:none;}
</style>

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>



<script language="javascript" type="text/javascript">

///dob
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
	
	function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

////for print
	
	function pres(){

	
	var inv=document.getElementById('inv').value;
	var fd=document.getElementById('fd').value;
	var op=document.getElementById('op').value;
	/*var datead=document.getElementById('datead').value;
	var datedis=document.getElementById('datedis').value;
	var hour=document.getElementById('hour').value;
	var minn=document.getElementById('minn').value;
	var hour1=document.getElementById('hour1').value;
	var min1=document.getElementById('min1').value;
	var room=document.getElementById('room').value;*/
	
	popcontact('discharge_print.php?id=<?php echo $id; ?>&inv='+inv+'&fd='+fd+'&op='+op);
	
}


</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>

<body onload="createList();">

        
          <form method="post" class="signin" action="update_disharge.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Discharge</p><br />
                
            	<input type="hidden" name="ad_id" value="<?php echo $row[18]; ?>"  />
                
                <input id="pd" name="pd" type="text" value="<?php echo $row[3]; ?>">
                <table id="ds">
                
                <tr> 
            	<td >Patient ID : </td>
                <td ><input id="pid" name="pid" type="text"  value="<?php echo $row1[1]; ?>"readonly>&nbsp;<input id="name" name="name" type="text" value="<?php echo $row2[6]; ?>" readonly></td>
                
                </tr>
                
                <tr>
                <td >Date of Admission:</td>
                <td > <input id="datead" name="datead" type="text" readonly value="<?php if(isset($row1[2]) and $row1[2]!='0000-00-00') echo date('d/m/Y',strtotime($row1[2])); ?>"></td>
                </tr>  
                
                <tr>
                <td >Date of Discharge:</td>
                <td > <input id="datedis" name="datedis" type="text" onClick="displayDatePicker('datedis');" value="<?php if(isset($row1[4]) and $row1[4]!='0000-00-00') echo date('d/m/Y',strtotime($row1[4])); ?>"></td>
                </tr>               
                
                <tr>
                <td>Provisional Diagnosis:</td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row[3]; ?>"></td>
                </tr>
                
                <tr>
                <td>Investigations:</td>
                <td><textarea name="inv" id="inv" rows="3" cols="22" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[4]; ?></textarea></td>
                </tr>
                
                <tr>
                <td>Final Diagnosis:</td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row[5]; ?>"></td>
                </tr>
                
                <tr>
                <td>JJ stent:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="jj" name="jj" type="text"  style="width:50px;" value="<?php echo $row[8]; ?>"></td>
                <td>Removal Date:&nbsp;<input id="jjdate" name="jjdate" type="text" onClick="displayDatePicker('jjdate');" value="<?php if(isset($row[10]) and $row[9]!='0000-00-00') echo date('d/m/Y',strtotime($row[9])); ?>"></td>
                </tr>
                
                <tr>
                <td>Uretric Cath:<input id="uc" name="uc" type="text"  style="width:50px;" value="<?php echo $row[9]; ?>"></label></td>
                <td>Removal Date:&nbsp;<input id="ucdate" name="ucdate" type="text" onClick="displayDatePicker('ucdate');" value="<?php if(isset($row[11]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>"></td>
               
                </tr>
                
                <tr>
                <td>Operations:</td>
                <td><input id="op" name="op" type="text" value="<?php echo $row[6]; ?>" ></td>
                </tr>
                
                <tr>
                <td>Procedure:</td>
                <td><textarea name="proc" rows="3" cols="22" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[7]; ?></textarea></td>
                </tr>
                
                <tr>
                <td>Post Operative T/t:</td>
                <td><input id="po" name="po" type="text" value="<?php echo $row[12]; ?>"></td>
                </tr>
                
                <tr>
                <td>Additional Procedure:</td>
                <td><textarea name="add_proc" rows="3" cols="22" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[13]; ?></textarea></td>
                </tr>
                
                <tr>
                <td>Treatment on Discharge:</td>
                <td><textarea name="treat" rows="3" cols="22" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[14]; ?></textarea></td>
                </tr>
                
                <tr>
                <td>Advice:</td>
                <td><textarea name="advice" rows="2" cols="22" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[15]; ?></textarea></td>
                </tr>
                
                <tr>
                <td>Visit at OPD On:</td>
                <td><input id="visit" name="visit" type="text" value="<?php echo $row[16]; ?>"></td>
                </tr>
               
                                           
                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>
                <a href="viewdischarge.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'viewdischarge.php';">Cancel</button></a>
				<button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button>
                </td>
                </tr>
                </table>         
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                
                       
                </fieldset>
                </form>
<?php include('footer.html'); ?>