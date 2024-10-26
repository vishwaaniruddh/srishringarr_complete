<?php 
include('config.php');
session_start();

$id=$_GET['id'];
$sql="select * from operate where ot_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$time=$row[5];
list($hr, $min) = explode(":", $time);

$time1=$row[6];
list($hr1, $min1) = explode(":", $time1);
?>
<link href="style1.css" rel="stylesheet" type="text/css" />
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

form.signin input{ 
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
	width:250px; text-transform:uppercase;
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
<!--add new hospital-->
function hoswindow()
{

  mywindow = window.open("new_hosp.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 </script>
<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
   	 
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->

       
        
         <form method="post" class="signin" action="update_ot.php" >
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Appointment</p>
                
                <p align="right"><input id="cdate1" name="cdate1" type="text" value="<?php echo date( "d/m/Y");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                
                <table width="1071" id="sub">
                  <tr>
                    <td width="93" height="33"><label class="fname"> Full Name: </label></td>
                    <td width="359"><input id="fname" name="fname" type="text"  value="<?php echo $row[2]; ?>"/>
                      <?php $result6 = mysql_query("select * from patient where name<>'' order by name ASC");?>
                    <select name="pname" id="pname" style="background:#fff;border:1px #ac0404 solid;width:250px;height:26px;" onChange="swap(this.value, 'fname')">
					
					                    
				     <?php while($row6=mysql_fetch_row($result6))
                      {  ?>
                      <option value="<?php echo $row6[2]; ?>" <?php if($row6[2]==$row[2]){ echo "selected"; } ?>><?php echo $row6[6]; ?></option>
				     <?php } ?>
			        </select>					</td>
                    
                    
                    <td width="90"> Time Given:</td>
				  <td width="302"> Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:<br />
                    <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
		     	
                      <option value="00" <?php if($hr==00){ echo "selected";} ?>>00</option>
                      <option value="01" <?php if($hr==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr==09){ echo "selected";} ?> >09</option>
                      <option value="10" <?php if($hr==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr==12){ echo "selected";} ?>>12</option>
                      <option value="13" <?php if($hr==13){ echo "selected";} ?>>13</option>
                      <option value="14" <?php if($hr==14){ echo "selected";} ?>>14</option>
                      <option value="15" <?php if($hr==15){ echo "selected";} ?>>15</option>
                      <option value="16" <?php if($hr==16){ echo "selected";} ?>>16</option>
                      <option value="17" <?php if($hr==17){ echo "selected";} ?>>17</option>
                      <option value="18" <?php if($hr==18){ echo "selected";} ?>>18</option>
                      <option value="19" <?php if($hr==19){ echo "selected";} ?>>19</option>
                      <option value="20" <?php if($hr==20){ echo "selected";} ?>>20</option>
                      <option value="21" <?php if($hr==21){ echo "selected";} ?>>21</option>
                      <option value="22" <?php if($hr==22){ echo "selected";} ?>>22</option>
                      <option value="23" <?php if($hr==23){ echo "selected";} ?>>23</option>
                    </select>
                    <select name="min" style="background:#fff;height:26px;border:1px solid #ac0404;width:60px;">
                    
                <option value="00" <?php if($min==00){ echo "selected";} ?>>00</option>
                <option value="05" <?php if($min==05){ echo "selected";} ?>>05</option>
                <option value="10" <?php if($min==10){ echo "selected";} ?>>10</option>
                <option value="15" <?php if($min==15){ echo "selected";} ?>>15</option>
                <option value="20" <?php if($min==20){ echo "selected";} ?>>20</option>
                <option value="25" <?php if($min==25){ echo "selected";} ?>>25</option>
                <option value="30" <?php if($min==30){ echo "selected";} ?>>30</option>
                <option value="35" <?php if($min==35){ echo "selected";} ?>>35</option>
                <option value="40" <?php if($min==40){ echo "selected";} ?>>40</option>
                <option value="45" <?php if($min==45){ echo "selected";} ?>>45</option>
                <option value="50" <?php if($min==50){ echo "selected";} ?>>50</option>
                <option value="55" <?php if($min==55){ echo "selected";} ?>>55</option>
                </select></td>
                    </tr>
					
                    <tr>
                    <td width="93"><label class="age"> Date : </label></td>
                    <td width="359"><input id="apdate" name="apdate" type="text" onClick="displayDatePicker('apdate');" value="<?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?>"/></td>
					
                  
				
				<td width="64">Time Given: </td>
				<td width="135">
				Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:<br />
                    <select name="hour1" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
                    <option value="00" <?php if($hr==00){ echo "selected";} ?>>00</option>
                      <option value="01" <?php if($hr1==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr1==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr1==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr1==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr1==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr1==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr1==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr1==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr1==09){ echo "selected";} ?> >09</option>
                      <option value="10" <?php if($hr1==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr1==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr1==12){ echo "selected";} ?>>12</option>
                      <option value="13" <?php if($hr1==13){ echo "selected";} ?>>13</option>
                      <option value="14" <?php if($hr1==14){ echo "selected";} ?>>14</option>
                      <option value="15" <?php if($hr1==15){ echo "selected";} ?>>15</option>
                      <option value="16" <?php if($hr1==16){ echo "selected";} ?>>16</option>
                      <option value="17" <?php if($hr1==17){ echo "selected";} ?>>17</option>
                      <option value="18" <?php if($hr1==18){ echo "selected";} ?>>18</option>
                      <option value="19" <?php if($hr1==19){ echo "selected";} ?>>19</option>
                      <option value="20" <?php if($hr1==20){ echo "selected";} ?>>20</option>
                      <option value="21" <?php if($hr1==21){ echo "selected";} ?>>21</option>
                      <option value="22" <?php if($hr1==22){ echo "selected";} ?>>22</option>
                      <option value="23" <?php if($hr1==23){ echo "selected";} ?>>23</option>
                    </select>
                    <select name="min1" style="background:#fff;height:26px;border:1px solid #ac0404;width:60px;">
                   <option value="00" <?php if($min1==00){ echo "selected";} ?>>00</option>
                <option value="05" <?php if($min1==05){ echo "selected";} ?>>05</option>
                <option value="10" <?php if($min1==10){ echo "selected";} ?>>10</option>
                <option value="15" <?php if($min1==15){ echo "selected";} ?>>15</option>
                <option value="20" <?php if($min1==20){ echo "selected";} ?>>20</option>
                <option value="25" <?php if($min1==25){ echo "selected";} ?>>25</option>
                <option value="30" <?php if($min1==30){ echo "selected";} ?>>30</option>
                <option value="35" <?php if($min1==35){ echo "selected";} ?>>35</option>
                <option value="40" <?php if($min1==40){ echo "selected";} ?>>40</option>
                <option value="45" <?php if($min1==45){ echo "selected";} ?>>45</option>
                <option value="50" <?php if($min1==50){ echo "selected";} ?>>50</option>
                <option value="55" <?php if($min1==55){ echo "selected";} ?>>55</option>
                </select>                  </td>
                  </tr>
                   
				   <tr>
                    <td height="33"><label class="cn">Telephone No.:</label></td>
                    <td><input id="tel" name="tel" type="text" value="<?php echo $row[3];?>"/></td>
                    <td height="33"><label class="mob">Mobile:</label></td>
                    <td><input id="mob" name="mob" type="text" value="<?php echo $row[4];?>"/></td>
                  </tr>
                 
                  <?php 

$result = mysql_query("select doc_id,name from doctor ");
$result1 = mysql_query("select ref_id,name from doctor_ref where name<>'' order by name ASC");
?>
                
				
              <tr>
				<tr>
				<td width="93"><label class="doc">Doctor Reference:</label></td>
                <td width="359"><select name="doc" id="doc" style="background:#fff;border:1px solid #ac0404;width:250px;height:26px;">
                <option value="0">Select</option>
                <?php while($row1=mysql_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"  <?php if($row1[0]==$row[8]){ echo "selected"; } ?>><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>				</td>
                
                <td>Hospital:</td><td>
				<?php $result5 = mysql_query("select * from hospital where name<>'' order by name ASC");?>
                <select name="hos" id="hos" style="background:#fff;height:26px;border:1px solid #ac0404;width:250px;">
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>" <?php if($row5[0]==$row[14]){ echo "selected"; } ?>><?php echo $row5[0]; ?></option>
				<?php } ?>
				</select></td>
				
				<td><button name="cityadd" id="cityadd" style="width:100px;" onClick="hoswindow();" class="submit formbutton"/>Add New </button></td>
				</tr>
                
				
				<tr>
				
				<td>Remarks :</td>
				<td ><input type="text" name="rem" id="rem" value="<?php echo $row[9];?>"/></td>
                
                <td>Anaesthetist :</td>
				<td ><input type="text" name="ane" id="ane" value="<?php echo $row[12];?>"/></td>
				</tr>
                
                <tr>
                <td>Surgery :</td>
				<td ><textarea name="surtxt" id="surtxt" cols="28" rows="3" style="border:1px #ac0404 solid;"><?php echo $row[13];?></textarea>
                <?php $result5 = mysql_query("select * from surmast where name<>'' order by name ASC");?>
                <select name="sur" id="sur" style="background:#fff;border:1px #ac0404 solid;width:120px;height:26px;" onChange="swap(this.value, 'surtxt')">
                <option value="0">Select</option>
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"><?php echo $row5[0]; ?></option>
				<?php } ?>
				</select>                </td>
				</tr>
                
                <tr>
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <td colspan="4"><button class="submit formbutton" type="submit" name="Submit"> Save</button> 
                <a href="otscheduler.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'otscheduler.php';" style="width:100px;">Cancel</button></a>
				</td>
                </tr>   
                </table>
      </form>
</div> 
	<!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->