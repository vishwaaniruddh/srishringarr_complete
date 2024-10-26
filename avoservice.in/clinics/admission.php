<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include('template.html');
include('config.php');

$id=$_GET['id'];
//$aid=$_GET['aid'];
$sql="select * from patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
<style>
 td{border:none;}
</style>
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

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<!--end menu-->

<body onLoad="createList();">

         <form method="post" class="signin" action="new_admission.php" onSubmit="return advalidate(this)" name="adform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Admission</p><br>
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
                 
                
            	<table width="900" height="417">
                <tr>
               
                <td width="170">ID: </td>
                <td width="281"><input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[3]; ?>" readonly ></td>
                 <td width="131"> Name: </td>
                <td width="298"><input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly ></td></tr>
                
<?php 

$result = mysql_query("select doc_id,name from doctor ");
?>
            <tr>
                <td width="170">IPD No:</td>
                <td width="281"> 
                <input type="text" id="ipd" name="ipd">
                </td>
                
                <td>Admitted on :</td>
                <td><input id="addate" name="addate" type="text" onClick="displayDatePicker('addate');"></td></tr>
                <tr>
                <td>Admission Time:</td>
                <td>
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
   
                <select name="min" style="background:#fff;border:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                
                <select name="dur" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                </td>
                
                <?php $result17=mysql_query ( "select * from room where type<>'' order by type ASC") ?>
                <td>Room Type:</td>
                <td id="sub"> 
                <select name="room" id="room" style="width:222px;" onchange="newroom()">
                <?php while ($row3=mysql_fetch_row($result17)) { ?>
				<option value="<?php echo $row3[1]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>
                </td>
               
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
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}
				
function pres(){

	
	var addate= document.getElementById('addate').value;
	var disdate= document.getElementById('disdate').value;
	var final=document.getElementById('final').value;
	var radiotxt= document.getElementById('radiotxt').value;
	var comptxt= document.getElementById('comptxt').value;
	var pathtxt= document.getElementById('pathtxt').value;
	var protxt= document.getElementById('protxt').value;
	var clitxt= document.getElementById('clitxt').value;
	var finaltxt =document.getElementById('finaltxt').value;
	var occu= document.getElementById('occu').value;
	var admit= document.getElementById('admit').value;
	var addr= document.getElementById('addr').value;
	var room= document.getElementById('room').value;

	popcontact('adm_print.php?id=<?php echo $id; ?>&final='+final+'&addate='+addate+'&disdate='+disdate+'&radiotxt='+radiotxt+'&comptxt='+comptxt+'&pathtxt='+pathtxt+'&protxt='+protxt+'&clitxt='+clitxt+'&finaltxt='+finaltxt+'&occu='+occu+'&admit='+admit+'&addr='+addr+'&room='+room);
}
</script>
                 <tr>
                 <td height="47">Discharged on :</td>
                 <td> <input id="disdate" name="disdate" type="text" onClick="displayDatePicker('disdate');"></td>
                 <td> Discharge Time: </td>
                 <td>
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
   
                <select name="min1" id="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="05">00</option>
                <option value="30">30</option>
                </select>
                
                <select name="dur1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                </td>
                </tr>
<?php
$result11=mysql_query ( "select UPPER(name) from insumast where name<>'' order by name ASC");
?>              <tr>  
                <td>Insurance :</td>
                <td id="sub1"> 
                <select name="insu" id="insu" style="width:222px;" onchange="newinsurance()">
                <?php while ($row11=mysql_fetch_row($result11)) { ?>
				<option value="<?php echo $row11[0]; ?>"><?php echo $row11[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>
                </td>
                 
<?php
$result3=mysql_query ( "select * from room ");
?>              
               
                <td>Past History :</td>
                <td><textarea name="pastfinal" id="pastfinal" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea></td></tr>
                
                <tr>
                <td>Radiological Investigations :</td>

<?php
$result12=mysql_query ( "select * from xraymast where caption<>'' order by caption ASC");
?>
                <td><textarea name="radiotxt" id="radiotxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="radio" id="radio" style="width:250px;" onChange="addThem5();">
                <?php while ($row3=mysql_fetch_row($result12)) { ?>
				<option value="<?php echo $row3[1]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                <td>Chief Complaints :</td>

<?php
$result13=mysql_query ( "select name,id from compla where name<>'' order by name ASC");
?>
                <td><textarea name="comptxt" id="comptxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="comp" id="comp" style="width:250px;" onChange="addThem2();">
                <?php while ($row13=mysql_fetch_row($result13)) { ?>
				<option value="<?php echo $row13[0]; ?>"><?php echo $row13[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td>
                </tr>
                <tr>
                <td>Pathological Investigations :</td>

<?php
$result14=mysql_query ( "select * from investi1 where name<>'' order by name ASC");
?>
                <td><textarea name="pathtxt" id="pathtxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="path" id="path" style="width:250px;" onChange="addThem6();">
                <?php while ($row14=mysql_fetch_row($result14)) { ?>
				<option value="<?php echo $row14[0]; ?>"><?php echo $row14[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td>
                
                
                <td>Clinical Details :</td>
 
 <?php
$result15=mysql_query ( "select * from finding where name<>'' order by name ASC");
?>
               <td><textarea name="clitxt" id="clitxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="cli" id="cli" style="width:250px;" onChange="addThem3();">
                <?php while ($row15=mysql_fetch_row($result15)) { ?>
				<option value="<?php echo $row15[0]; ?>"><?php echo $row15[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></td></tr>
                
                <tr>
                <td>Provisional Diagnosis :</td>

<?php
$result16=mysql_query ( "select name,diag_id from diag where name<>'' order by name ASC");
?>
                <td><textarea name="protxt" id="protxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="pro" id="pro" style="width:250px;" onChange="addThem7();">
                <?php while ($row16=mysql_fetch_row($result16)) { ?>
				<option value="<?php echo $row16[0]; ?>"><?php echo $row16[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>
                </td>
                
                <td>Final Diagnosis :</td>
<?php
$result17=mysql_query ( "select UPPER(name),diag_id from diag where name<>'' order by name ASC");
?>
                <td><textarea name="finaltxt" id="finaltxt" rows="4" cols="29" style="resize:none;border:1px #ac0404 solid;"></textarea>
                <select name="final" id="final" style="width:250px;" onChange="addThem4();">
                <?php while ($row17=mysql_fetch_row($result17)) { ?>
				<option value="<?php echo $row17[0]; ?>"><?php echo $row17[0]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td> Occupation :</td>
                <td>  <input type="text"  id="occu" name="occu"/></td>
                 <td> Admitted By : </td>
                 <td> <input type="text"  id="admit" name="admit"/></td></tr>
                 
                 
                 <td> Address :</td>
                 <td><input type="text" id="addr" name="addr"/>
                  </td>
                </tr>
                
                 
               
                </table>
              
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="Wait_surgery.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'Wait_surgery.php';">Cancel</button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button>
                </fieldset>
                </form>
  


<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>