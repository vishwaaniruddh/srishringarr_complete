<?php 
session_start();
include('template.html');
include('config.php');


$id=$_GET['id'];

$sql="select * from admission where ad_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$sql1="select * from patient where srno='$row[1]'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$time=$row[3];
list($hr, $min) = explode(":", $time);
$dtime=$row[3];$dur= substr($dtime,6);//echo $dur;

$time1=$row[5];
list($hr1, $min1) = explode(":", $time1);
$dtime1=$row[5];$dur1= substr($dtime1,6);//echo $dur;

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
	
function addThem2(){
	
var a = document.adform.comp;
if(a.value!='Other'){
var add = a.value+',';
document.adform.comptxt.value += add;}
return true;

}

function addThem3(){
	
var a = document.adform.cli;
if(a.value!='Other'){
var add = a.value+',';
document.adform.clitxt.value += add;}
return true;
}

function addThem4(){
	
var a = document.adform.final;
//alert(a.value);
var add = a.value+',';

document.adform.finaltxt.value += add;
return true;
}

function addThem5(){
	
var a = document.adform.radio;
//alert(a.value);
var add = a.value+',';

document.adform.radiotxt.value += add;
return true;
}

function addThem6(){
	
var a = document.adform.path;
if(a.value!='Other'){
var add = a.value+',';
document.adform.pathtxt.value += add;}
return true;
}

function addThem7(){
	
var a = document.adform.pro;
if(a.value!='Other'){
var add = a.value+',';
document.adform.protxt.value += add;}
return true;
}
///////new room
function newroom()
{
	var room=document.getElementById('room');
	var val=room.options[room.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='nroom' id='nroom' placeholder='New Room'>";
	tableName1.appendChild(newName1);
	
	}
}

///////new insurance
function newinsurance()
{
	var insu=document.getElementById('insu');
	var val=insu.options[insu.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub1");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ninsu' id='ninsu' placeholder='New Insurance'>";
	tableName1.appendChild(newName1);
	
	}
}
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>

         <form method="post" class="signin" action="update_ad.php" onSubmit="return advalidate(this)" name="adform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Admission</p><br />
                
                <input type="hidden" name="ad_id" value="<?php echo $id; ?>"  />                
            	<table width="870" height="417">
                <tr>
				<?php $result2=mysql_query("select * from patient where srno='$row[1]'");
				$row2=mysql_fetch_row($result2); ?>
                <td width="117"> Name: </td>
                <td width="280"><input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row2[6]; ?>" readonly style="width:250px;"/></td>        
                <td width="142">IPD No:</td>
                <td width="311"> 
                <input type="text" id="ipd" name="ipd" style="width:250px;"/>                </td>
                </tr>

                <tr>
                <td>Admitted on :</td>
                <td><input id="addate" name="addate" type="text" style="width:250px;" onClick="displayDatePicker('addate');" value="<?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?>"></td>
                <td>Admission Time: </td>
                <td>
                  <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                  <option value="01" <?php if($hr==01){ echo "selected";} ?>>01</option>
                  <option value="02" <?php if($hr==02){ echo "selected";} ?>>02</option>
                  <option value="03" <?php if($hr==03){ echo "selected";} ?>>03</option>
                  <option value="04" <?php if($hr==04){ echo "selected";} ?>>04</option>
                  <option value="05" <?php if($hr==05){ echo "selected";} ?>>05</option>
                  <option value="06" <?php if($hr==06){ echo "selected";} ?>>06</option>
                  <option value="07" <?php if($hr==07){ echo "selected";} ?>>07</option>
                  <option value="08" <?php if($hr==08){ echo "selected";} ?>>08</option>
                  <option value="09" <?php if($hr==09){ echo "selected";} ?>>09</option>
                  <option value="10" <?php if($hr==10){ echo "selected";} ?>>10</option>
                  <option value="11" <?php if($hr==11){ echo "selected";} ?>>11</option>
                  <option value="12" <?php if($hr==12){ echo "selected";} ?>>12</option>
                  </select>
                
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00" <?php if($min==00){ echo "selected";} ?>>00</option>
                <option value="30" <?php if($min==30){ echo "selected";} ?>>30</option>
                </select>  
                
                <select name="dur" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am" <?php if($dur=='am'){ echo "selected";} ?>>am</option>
                <option value="pm" <?php if($dur=='pm'){ echo "selected";} ?>>pm</option>
                </select>
                </td></tr>
                
                <tr>
                <?php
$result17=mysql_query ( "select * from room where type<>'' order by type ASC");
?>
                <td width="117">Room Type:</td>
                <td width="280" id="sub"> 
                <select name="room" id="room" style="width:250px;" onchange="newroom()">
                <?php while ($row3=mysql_fetch_row($result17)) { ?>
				<option value="<?php echo $row3[1]; ?>" <?php if($row3[1]==$row[6]){ echo "selected"; } ?>><?php echo $row3[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>                </td>
                
                <?php
$result11=mysql_query ( "select name from insumast where name<>'' order by name ASC");
?>                 
                <td>Insurance :</td>
                <td id="sub1"> 
                <select name="insu" id="insu" style="width:250px;" onchange="newinsurance()">
                <?php while ($row11=mysql_fetch_row($result11)) { ?>
				<option value="<?php echo $row11[0]; ?>" <?php if($row11[0]==$row[17]){ echo "selected"; } ?>><?php echo $row11[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>                </td>
                </tr>
                
<!--date difference-->   
<script>
	 function formshowhide(){
      var t1=document.getElementById('addate').value;
	  var t2=document.getElementById('disdate').value;
	  
	  if(t2==''){}else{
	  
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
				}
</script>
                 <tr>
                 <td height="47">Discharged on :</td>
                 <td> <input id="disdate" name="disdate" type="text" style="width:250px;" onClick="displayDatePicker('disdate');" value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>"></td>
                 <td>Discharge Time: </td>
                 <td>
                  <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                      <option value="01" <?php if($hr1==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr1==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr1==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr1==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr1==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr1==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr1==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr1==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr1==09){ echo "selected";} ?>>09</option>
                      <option value="10" <?php if($hr1==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr1==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr1==12){ echo "selected";} ?>>12</option>
                      </select>
                
                
                <select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="05" <?php if($min1==05){ echo "selected";} ?>>05</option>
                <option value="30" <?php if($min1==30){ echo "selected";} ?>>30</option>
                </select>
                
                <select name="dur1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am" <?php if($dur1=='am'){ echo "selected";} ?>>am</option>
                <option value="pm" <?php if($dur1=='pm'){ echo "selected";} ?>>pm</option>
                </select>
                </td>
                </tr>
<?php
$result3=mysql_query ( "select * from room ");
?>              
               
                <tr>
                <td>Past History :</td>
                <td><textarea name="pastfinal" id="pastfinal" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[7]; ?></textarea></td>
                <td>Radiological Investigations :</td>

<?php
$result12=mysql_query ( "select * from xraymast where caption<>'' order by caption ASC");
?>
                <td><textarea name="radiotxt" id="radiotxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[11]; ?></textarea>
                <select name="radio" id="radio" style="width:250px;" onChange="addThem5();">
                <?php while ($row3=mysql_fetch_row($result12)) { ?>
				<option value="<?php echo $row3[1]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>                </td>
                </tr>
                 
                <tr>
                <td>Chief Complaints :</td>

<?php
$result13=mysql_query ( "select UPPER(name) from  compla where name<>'' order by name ASC");
?>
                <td><textarea name="comptxt" id="comptxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[8]; ?></textarea>
                <select name="comp" id="comp" style="width:250px;" onChange="addThem2();">
                <?php while ($row13=mysql_fetch_row($result13)) { ?>
				<option value="<?php echo $row13[0]; ?>"><?php echo $row13[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td>
                <td>Pathological Investigations :</td>

<?php
$result14=mysql_query ( "select * from investi1 where name<>'' order by name ASC");
?>
                <td><textarea name="pathtxt" id="pathtxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[12]; ?></textarea>
                <select name="path" id="path" style="width:250px;" onChange="addThem6();">
                <?php while ($row14=mysql_fetch_row($result14)) { ?>
				<option value="<?php echo $row14[0]; ?>"><?php echo $row14[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td>
                </tr>
                
                <tr>
                <td>Clinical Details :</td>
 
 <?php
$result15=mysql_query ( "select * from finding where name<>'' order by name ASC");
?>
               <td><textarea name="clitxt" id="clitxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[9]; ?></textarea>
                <select name="cli" id="cli" style="width:250px;" onChange="addThem3();">
                <?php while ($row15=mysql_fetch_row($result15)) { ?>
				<option value="<?php echo $row15[0]; ?>"><?php echo $row15[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td>
                
                <td>Provisional Diagnosis :</td>

<?php
$result16=mysql_query ( "select UPPER(name) from diag where name<>'' order by name ASC");
?>
                <td><textarea name="protxt" id="protxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[13]; ?></textarea>
                <select name="pro" id="pro" style="width:250px;" onChange="addThem7();">
                <?php while ($row16=mysql_fetch_row($result16)) { ?>
				<option value="<?php echo $row16[0]; ?>"><?php echo $row16[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>                </td>
                </tr>
                
                <tr>
                <td>Final Diagnosis :</td>
<?php
$result17=mysql_query ( "select UPPER(name) from diag where name<>'' order by name ASC");
?>
                <td><textarea name="finaltxt" id="finaltxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"><?php echo $row[10]; ?></textarea>
                <select name="final1" id="final1" style="width:250px;" onChange="addThem4();">
                <?php while ($row17=mysql_fetch_row($result17)) { ?>
				<option value="<?php echo $row17[0]; ?>"><?php echo $row17[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>                </td>
                
                <td> Occupation : </td>
                 <td> <input type="text"  id="occu" name="occu" value="<?php echo $row[14]; ?>" style="width:250px;"/></td>
                </tr>
                  <tr>
                 <td> Address :</td>
                  <td><input type="text" id="addr" name="addr" value="<?php echo $row[16]; ?>" style="width:250px;"/></td>
                  
                   <td> Admitted By : </td>
                 <td> <input type="text"  id="admit" name="admit" value="<?php echo $row[15]; ?>" style="width:250px;"/></td>
                </tr>
                </table>
				
				<input id="id" name="id" type="hidden" value="<?php echo $id; ?>">              
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="viewipd.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
<?php 
include('footer.html');
?>