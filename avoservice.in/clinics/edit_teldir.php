<?php 
include('template_clinic.html');
include('config.php');


$id=$_GET['id'];
$sql="select * from address where tel_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
<script type="text/javascript">
function addThem1(){
var a = document.opd.rec;


var add = a.value+',';

document.opd.recm.value += add;
return true;
}
</script>
<!-- end multiple selection -->


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
 td{border:none;}
</style>
         
         
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

 
<div class="M_page">
          <form method="post" class="signin" action="update_teldir.php" onSubmit="return validate(this)" name="form">
               <fieldset class="textbox">
               <legend> <h1> <img src="ddmenu/phone_directory.png" height="50" width="50" />Telephone Directory</h1></legend>
                
            	<table>
                <tr><td>
                 Name: </td>
                <td><input id="name" name="name" type="text" value="<?php echo $row[2]; ?>" >
                </td></tr>
                
                <tr>
                <td>
                 Address:</td> 
                <td><textarea name="add" cols="26" rows="3"><?php echo $row[3]; ?></textarea>
                </td></tr>
                
                <tr><td>City.:</td>
                <td><select name="city" id="city" style="width:235px;height:27px;">
                
                <?php $city=mysql_query("select * from city where name<>'' order by name ASC");
				while($city1=mysql_fetch_row($city)){
				?>
				
                 <option value="<?php echo $city1[0]; ?>" <?php if($row[5]==$city1[0]) { ?> selected="selected"<?php }?>><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select>
                </td></tr>
                                            
                <tr><td>Contact No.:</td>
                <td><input id="cn" name="cn" type="text" value="<?php echo $row[9]; ?>">
                </td></tr>
                 
                <tr><td>Pincode:</td>
                <td><input id="pin" name="pin" type="text" value="<?php echo $row[6]; ?>">
                </td></tr>
                
                
                <tr><td>
                Information For:</td>
                <td><select name="info" style="width:235px;height:26px">
                
                <option value="Patient" <?php if($row[14]=='Patient'){ echo "selected"; } ?>>Patient</option>
                <option value="Doctor" <?php if($row[14]=='Doctor'){ echo "selected"; } ?>>Doctor</option>
                </select>
                </td>
          
                <tr><td colspan="2">
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'viewtelephone.php';">Cancel</button>
                </td></tr></table>                      
                </fieldset>
          </form>
</dive>


