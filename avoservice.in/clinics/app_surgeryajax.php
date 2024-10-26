<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
//include('template.html');
$id=$_GET['id'];
$sql="select * from  patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);


?>
<style>
#sub td{border:none;}
#se{
	width:60px;
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
	color:#fff;
	}

#linkd { 
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
	width:80px;
}
</style>

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>



        <form method="post" class="signin" action="procajaxsurgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Surgery Appointment</p><br />
          
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
                <input type="hidden" name="wait" value="No"  />
                  
                  <table id="sub">
                   <tr>
                <td width="211"><label class="cdate">Today's date :</label></td>
                <td width="601"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td width="211"><label class="name">Patient name</label></td>
                <td width="601"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
               
                
<!--                <tr>
                <td><label class="surgery">Surgery Head:</label></td>
                <td>
                <select name="surgery" style="width:300px; height:25px;">
                <option value="Bones, Joints & Tendons ">Bones, Joints & Tendons  </option>
                <option value="Cardiology">Cardiology  </option>
                <option value="Ear, Nose and Throat">Ear, Nose and Throat  </option>
                <option value="Eye Surgery ">Eye Surgery  </option>
                <option value="General Surgery ">General Surgery  </option>
                <option value="Kidney and Urinary System ">Kidney and Urinary System  </option>
                <option value="Stomach and Bowel">Stomach and Bowel</option>
                </select>
                </td>
                </tr>
    -->            
                
               
				
          
                               
                <?php $result = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC"); ?>
               <!-- <tr>
                <td><label class="doc">Doctor:</label></td>
                <td>
                <select name="doc"  id="doc" style="background:#fff;border:1px solid #ac0404;width:235px;height:25px;">
                <option value="">Select</option>
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>                </td>
                </tr>-->

                <tr>
                <td><label class="Date">Surgery Date:</label></td>
                <td><input id="next_date" name="next_date" type="text" onClick="displayDatePicker('next_date');"></td>
                </tr>
				
				
				
				 <tr>
                <td height="43"><label class="time"> <span class="Date">Surgery</span> Time: </label></td>
                <td>
                <span>Hours: &nbsp; Mins:</span>
                <select name="hour" id="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
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
                </select>
   
                <select name="min"  id="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                
                <select name="dur" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                </label>
                
               <br> <span>To &nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour1" id="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
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
                </select>
   
                <select name="min1"  id="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                
                <select name="dur1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                </label>
                </td>
                </tr>
		
				 <tr>
                <td><label class="Date"> OT Type:</label></td>
                <td><input id="ot_type" name="ot_type" type="text" ></td>
                </tr>
				<?php 
$sql4="select  UPPER(name),hospital_id from hospital where name<>'' order by name ASC";
$result4 = mysql_query($sql4);
?>              <td width="211"><label class="hospital">Select Hospital:</label></td>
                <td valign="top">
                <select name="hospital" id="hospital" style="width:250px;height:25px;" onChange="newhos()">
                <option value="0">Select</option>
                <?php while($row4=mysql_fetch_row($result4)) { ?>
                <option value="<?php echo $row4[0]; ?>"><?php echo $row4[0]; ?></option>
                <?php } ?>
                <option value="Other">OTHER</option>
                </select>
             
                </td>
                </tr>
				
				<tr>
                <td><label class="Date"> Pts. HB:</label></td>
                <td><input id="pts" name="pts" type="text" ></td>
                </tr>
				
				<tr>
                <td><label class="Date"> Implant:</label></td>
                <td><input id="imp" name="imp" type="text" ></td>
                </tr>
				
				
				  <tr>
			   <td>Admission Date: </td>
			   <td><input type="text" name="adm" id="adm" onclick="displayDatePicker('adm');" /></td>
			   </tr>
			   				 <tr>
                <td height="43"><label class="time">Admission Time: </label></td>
                <td>
                <span>Hours: &nbsp;&nbsp; Mins:</span>
                <select name="ad_hour" id="ad_hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
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
                </select>
   
                <select name="ad_min"  id="ad_min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                
                <select name="ad_dur" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                </label>                </td>
                </tr>
				
                <tr>
                <td><label class="Date"> Diagnosis:</label></td>
                <td><input id="diag" name="diag" type="text" ></td>
                </tr>
				
				  <tr>
                <td><label class="Date"> Suregery:</label></td>
                <td><input id="sur" name="sur" type="text" ></td>
                
			    <?php $result = mysql_query("select doc_id,name from doctor where name<>'' order by name ASC"); ?>
                <tr>
                <td><label class="doc"><span class="Date">Anesthetic</span>:</label></td>
                <td>
                <select name="doc"  id="doc" style="background:#fff;border:1px solid #ac0404;width:235px;height:25px;">
                <option value="">Select</option>
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                <tr>
			   <td>Room Type. : </td>
			   <?php $result17=mysql_query("select * from roomtype "); ?>
			   <td>
			   <input type="text" name="room" id="room" /></td>
			   </tr>
			   
				<tr>
                <td><label class="Date">NBM:</label></td>
                <td><input id="nbm" name="nbm" type="text" ></td>
                </tr>
                 <tr>
                <td height="29"> <label class="type">Type:</label></td>
                <td>
               New: <input type="radio"  name="type" style=" width:40px;" value="New"/> 
                Follow Up: <input type="radio"  name="type" style=" width:40px;" value="Follow"/>
                </td>
                </tr>
				
				<tr>
                <td><label class="Date"> Cat:</label></td>
                <td><input id="cat" name="cat" type="text" ></td>
                </tr>
                
                <tr>
                <td height="39"><button class="submit formbutton" type="submit">Submit</button> </td>
                <td><button class="submit formbutton" type="button" onClick="javascript:location.href='opd.php?id=<?php echo $id; ?> ';">Cancel</button></td>
                </tr>   
                </table>
                
               
                
          </fieldset>
                 
         </form>
       
<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>