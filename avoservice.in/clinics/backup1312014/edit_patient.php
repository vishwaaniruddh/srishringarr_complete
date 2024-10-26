<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");

 include('template_clinic.html');
 include('config.php');
 
 $id=$_GET['id'];
$sql="select * from patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$birth=$row[25];
list($yr, $mon,$day) = explode("-", $birth);

$fid=$row[9]; 
$sql3="select * from doctor where doc_id='$fid'";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_row($result3);
$packr=mysql_query("select * from patient_package where patientid='".$id."' and status=0 order by id DESC limit 1");
$pac=mysql_fetch_row($packr);

/*$sql4="select * from appoint where no='$id'";
$result4 = mysql_query($sql4);
$row4 = mysql_fetch_row($result4);
$time=$row4[5];
list($hr, $min) = explode(":", $time);

$did=$row4[14]; 
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);*/ 
?>
<style>
td{border:none;}
</style>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script>
/*
function citywindow()
{

  mywindow = window.open("newcity.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 
 function centerwindow()
{

  mywindow = window.open("newcenter.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
}
 
 
 function splwindow()
{

  mywindow = window.open("newspl.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
}

function docwindow()
{

  mywindow = window.open("newrefdoc.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }*/
</script>

<script type="text/javascript">

/////////////doctor ref
function docref()
{ //alert("h");
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
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("city1").value=s1[0];
		document.getElementById("cn1").value=s1[1];
		document.getElementById("email3").value=s1[2];
		document.getElementById("spl").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('ref1').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=df");
xmlhttp.send();

//////new entry
var ref1=document.getElementById('ref1');
	var val=ref1.options[ref1.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='nref' id='nref' placeholder='New Reference'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}

///end of ref
function toss()
{ ////alert("h");
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
    var s=xmlhttp.responseText;
   // alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("toscity").value=s1[0];
		document.getElementById("tostel").value=s1[1];
		document.getElementById("tosemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('tos').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

    var tos=document.getElementById('tos');
	var val=tos.options[tos.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='ntos' id='ntos' placeholder='Orhto Surgeon' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
//////end of ortho surgeon and strting of paed

function paedd()
{ //alert("h");
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
    var s=xmlhttp.responseText;
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("paedcity").value=s1[0];
		document.getElementById("paedtel").value=s1[1];
		document.getElementById("paedemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('paed').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();
//////new entry
    var paed=document.getElementById('paed');
	var val=paed.options[paed.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr1");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='npad' id='npad' placeholder='Paediatrician' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}


///////////phys
function physs()
{ //alert("h");
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
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("physcity").value=s1[0];
		document.getElementById("phystel").value=s1[1];
		document.getElementById("physemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('phys').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
///alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

//////new entry
    var phys=document.getElementById('phys');
	var val=phys.options[phys.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr2");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nphy' id='nphy' placeholder='Physiotherapist' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
///start of neuu
function neuu()
{ ///alert("h");
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
    var s=xmlhttp.responseText;
    ///alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("neucity").value=s1[0];
		document.getElementById("neutel").value=s1[1];
		document.getElementById("neuemail").value=s1[2];

		
   
    }
  }
  
  var str=document.getElementById('neu').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=df",true);
//alert("get_ref.php?docref="+str+"&ref=tos");
xmlhttp.send();

//////new entry
    var neu=document.getElementById('neu');
	var val=neu.options[neu.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr3");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nneu' id='nneu' placeholder='Neurosergeon' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}
///strt sw
function swwn()
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
    var s=xmlhttp.responseText;
  
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("swcity").value=s1[0];
		document.getElementById("swtel").value=s1[1];
		document.getElementById("swemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('sw').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=sw",true);
//alert("get_ref.php?docref="+str+"&ref=sw");
xmlhttp.send();

//////new entry
    var sw=document.getElementById('sw');
	var val=sw.options[sw.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr4");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nsw' id='nsw' placeholder='Social Worker' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}


///strt ngo
function ngo()
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
    var s=xmlhttp.responseText;
  
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("ngcity").value=s1[0];
		document.getElementById("ngtel").value=s1[1];
		document.getElementById("ngemail").value=s1[2];
		
   
    }
  }
  
  var str=document.getElementById('ng').value;
  
xmlhttp.open("GET","get_ref.php?docref="+str+"&ref=ng",true);
//alert("get_ref.php?docref="+str+"&ref=sw");
xmlhttp.send();

//////new entry
    var ng=document.getElementById('ng');
	var val=ng.options[ng.selectedIndex].value;
	if(val=='Other'){
	var newtr1 = document.getElementById("tr5");
	var newName1 = document.createElement("TD");
	newName1.innerHTML="<br><input type='text'  name='nng' id='nng' placeholder='NGO' style='width:110px'>";
	newtr1.appendChild(newName1);
	}
}

function getpackamt(id,field)
{ 
//alert(id+" "+field);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //alert(xmlhttp);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
  document.getElementById(field).value=xmlhttp.responseText;
    }
  }
  
  var str=document.getElementById(id).value;
  
xmlhttp.open("GET","getpackageamt.php?packid="+str,true);
//alert("getpackageamt.php?packid="+str);
xmlhttp.send();

	
}


////date of birth
function createList(){
//	alert("dgfr");
year=document.getElementById('year');
var i=1950;
for (i=1950; i<=2013; i++)
{
	var newOpt=year.appendChild(document.createElement('option'));	
	newOpt.text = ""+i;
	newOpt.value=""+i;
}}

function daysInMonth(month,year)
{
var dd = new Date(year, month, 0);
return dd.getDate();
}

function setDayDrop(dyear, dmonth, dday) 
{
var year = dyear.options[dyear.selectedIndex].value;
var month = dmonth.options[dmonth.selectedIndex].value;
var day = dday.options[dday.selectedIndex].value;

if (day == ' ') 
{
var days = (year == ' ' || month == ' ')
    ? 31 : daysInMonth(month,year);
dday.options.length = 0;
dday.options[dday.options.length] = new Option(' ',' ');

for (var i = 1; i <= days; i++)
dday.options[dday.options.length] = new Option(i,i);

}
}


function setDay() 
{
var year = document.getElementById('year');
var month = document.getElementById('month');
var day = document.getElementById('day');
setDayDrop(year,month,day);
}


//////Add New City////////
function newcity()
{
	var city=document.getElementById('city');
	var val=city.options[city.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ncity' id='ncity' placeholder='New City'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}

function showpack(id)
{
//alert(id);
if(document.getElementById(id).value=='r')
document.getElementById("package").style.display='block';
else if(document.getElementById(id).value=='nr')
document.getElementById("package").style.display='none';
}

//////Add New Center////////
function newcenter()
{
	var center=document.getElementById('center');
	var val=center.options[center.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ncen' id='ncen' placeholder='New Center'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}
function packagewindow(field)
{

  mywindow = window.open("newpackage.php?field="+field, "mywindow", "location=400,status=1,scrollbars=1, width=600,height=300,left=350,top=100");
  
 }
 function setmsg(field,id,name,amt)
{
alert(name);
 //document.getElementById(field).value=id;
 var option = document.createElement("option");
option.text = name;
option.value = name;
var selected = document.getElementById(field);
selected.appendChild(option);

setSelectedValue(selected, name);

function setSelectedValue(selectObj, valueToSet) {
//alert(selectObj);
    for (var i = 0; i < selectObj.options.length; i++) {
	//alert(selectObj.options[i].text);
        if (selectObj.options[i].value==valueToSet) {
		//alert(valueToSet);
            selectObj.options[i].selected = true;
            return;
        }
    }
	
}
if(field=='pack')
document.getElementById('packamt').value=amt;

}
</script>

<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>


<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />


<div class="M_page">

         <form method="post" class="signin" action="update_patient.php" onSubmit="return validate(this)" name="form" enctype="multipart/form-data">
                <fieldset class="textbox">
                <legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />Edit Patient</h1></legend>
                
                
               
                 <table  id="sub">
                 <tr>
                <td><input type="hidden" name="oldimg" value="<?php echo $row[69]; ?>" /> <input type="file" name="image" id="image"  onchange="show_pic()"/></td>
                </tr>
                  <tr>
                    <td width="181" height="33"><label class="fname"> Full Name: </label></td>
                    <td width="298"><input id="fname" name="fname" type="text" value="<?php echo $row[6]; ?>"/></td>
                     <td width="109"><label class="age"> Date of Birth: </label></td>
                    <td width="418">
                    
                    <table>
                    <tr><td>
  <label for="year">Year: </label>   
                 
<select name="year" id="year" size="1" onfocus="createList();">
<option value="<?php echo $yr; ?>" ><?php echo $yr; ?></option>
</select>
</td>
<td>
<label for="month">Month: </label>
<select name="month" id="month" size="1" onchange="setDay();">
<option value="01" <?php if($mon==01){ echo "selected";} ?>>select</option>
<option value="1" <?php if($mon==1){ echo "selected";} ?>>January</option>
<option value="2" <?php if($mon==2){ echo "selected";} ?>>February</option>
<option value="3" <?php if($mon==3){ echo "selected";} ?>>March</option>
<option value="4" <?php if($mon==4){ echo "selected";} ?>>April</option>
<option value="5" <?php if($mon==5){ echo "selected";} ?>>May</option>
<option value="6" <?php if($mon==6){ echo "selected";} ?>>June</option>
<option value="7" <?php if($mon==7){ echo "selected";} ?>>July</option>
<option value="8" <?php if($mon==8){ echo "selected";} ?>>August</option>
<option value="9" <?php if($mon==9){ echo "selected";} ?>>September</option>
<option value="10" <?php if($mon==10){ echo "selected";} ?>>October</option>
<option value="11" <?php if($mon==11){ echo "selected";} ?>>November</option>
<option value="12" <?php if($mon==12){ echo "selected";} ?>>December</option>
</select>
</td>
<td>
<label for="day">Day: </label>

<select name="day" id="day" style="width:40px;">
<option value="01" <?php if($day==01){ echo "selected";} ?>> select</option>
<option value="1" <?php if($day==1){ echo "selected";} ?>>1</option>
<option value="2" <?php if($day==2){ echo "selected";} ?>>2</option>
<option value="3" <?php if($day==3){ echo "selected";} ?>>3</option>
<option value="4" <?php if($day==4){ echo "selected";} ?>>4</option>
<option value="5" <?php if($day==5){ echo "selected";} ?>>5</option>
<option value="6" <?php if($day==6){ echo "selected";} ?>>6</option>
<option value="7" <?php if($day==7){ echo "selected";} ?>>7</option>
<option value="8" <?php if($day==8){ echo "selected";} ?>>8</option>
<option value="9" <?php if($day==9){ echo "selected";} ?>>9</option>
<option value="10" <?php if($day==10){ echo "selected";} ?>>10</option>
<option value="11" <?php if($day==11){ echo "selected";} ?>>11</option>
<option value="12" <?php if($day==12){ echo "selected";} ?>>12</option>
<option value="13" <?php if($day==13){ echo "selected";} ?>>13</option>
<option value="14" <?php if($day==14){ echo "selected";} ?>>14</option>
<option value="15" <?php if($day==15){ echo "selected";} ?>>15</option>
<option value="16" <?php if($day==16){ echo "selected";} ?>>16</option>
<option value="17" <?php if($day==17){ echo "selected";} ?>>17</option>
<option value="18" <?php if($day==18){ echo "selected";} ?>>18</option>
<option value="19" <?php if($day==19){ echo "selected";} ?>>19</option>
<option value="20" <?php if($day==20){ echo "selected";} ?>>20</option>
<option value="21" <?php if($day==21){ echo "selected";} ?>>21</option>
<option value="22" <?php if($day==22){ echo "selected";} ?>>22</option>
<option value="23" <?php if($day==23){ echo "selected";} ?>>23</option>
<option value="24" <?php if($day==24){ echo "selected";} ?>>24</option>
<option value="25" <?php if($day==25){ echo "selected";} ?>>25</option>
<option value="26" <?php if($day==26){ echo "selected";} ?>>26</option>
<option value="27" <?php if($day==27){ echo "selected";} ?>>27</option>
<option value="28" <?php if($day==28){ echo "selected";} ?>>28</option>
<option value="29" <?php if($day==29){ echo "selected";} ?>>29</option>
<option value="30" <?php if($day==30){ echo "selected";} ?>>30</option>
<option value="31" <?php if($day==31){ echo "selected";} ?>>31</option>
</select>

</td></tr></table>
              <input id="age" name="age" type="hidden" onClick="ageCount();" style="width:70px;" readonly="readonly" value="<?php echo $row[26]; ?>"/>
                    </td>
                  </tr>
                  <script type="text/javascript">
    
    function ageCount() {
var y =document.getElementById('year').value
var m =document.getElementById('month').value
var d =document.getElementById('day').value 
var today=new Date(); 
var bday=new Date(y,m,d); 
var by=bday.getFullYear(); 
var bm=bday.getMonth()-1; 
var bd=bday.getDate(); 
var age=0; var dif=bday; 
while(dif<=today){ 
var dif = new Date(by+age,bm,bd); 
age++; 
} 

age +=-2 ; 	     //calculating age 
           document.getElementById("age").value= age;
   }

</script>
                  <tr>
                    <td height="33"><label class="gender"> Sex: </label></td>
                    <td><font color="#000"><label> <input name="gen" id="gen" type="radio" value="Male" style="width:20px;" <?php if ($row[27]=="Male") { echo "checked='checked'";} ?>/> Male</label></font>
                        
                        <font color="#000"><label><input name="gen" id="gen" type="radio" value="Female" style="width:20px;" <?php if ($row[27]=="Female") { echo "checked='checked'";} ?>/> Female</label></font>
                      
                    </td>
                    <td height="33"><label class="cn">Mobile1 :</label></td>
                    <td><input id="cn22" name="cn22" type="text" value="<?php echo $row[23]; ?>"/></td>
                   
                  </tr>
                  <tr>
                     <td><label class="city">City :</label></td>
                    <td>
                    <select name="city" id="city"  onchange="newcity()">
                    <option value="<?php echo $row[18]; ?>"><?php echo $row[18]; ?></option>
                        <?php $city=mysql_query("select * from city where name<>'' ORDER BY name ASC ");
				while($city1=mysql_fetch_row($city)){
				?>
                        <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                        <?php } ?>
                        <option value="Other">OTHER</option>
                    </select>
                    </td>
                    <td height="33"><label class="cn">Mobile2 :</label></td>
                    <td><input id="mob2" name="mob2" type="text" value="<?php echo $row[68]; ?>"/></td>
                   
                  </tr>
                  <tr>
                    <td><label class="add">Address:</label></td>
                    <td><textarea name="add" rows="3" cols="25" ><?php echo $row[20]; ?></textarea></td>

                  
                    <td height="33"><label class="cn">Telephone No.:</label></td>
                     <td><input id="cn12" name="cn12" type="text" value="<?php echo $row[22]; ?>"/></td>
                  </tr>
				  
				  <tr>
				  <td> <label>Reference: </label> </td>
                    <td>
                    <select name="ref" id="ref">
                    <option value="0" <?php if($row[29]=='0') echo "selected"; ?>>select</option>
                    <option value="Just Dial" <?php if($row[29]=='Just Dial') echo "selected"; ?>>Just Dial</option>
                    <option value="Dr" <?php if($row[29]=='Dr') echo "selected"; ?>>Dr</option>
                    <option value="Website" <?php if($row[29]=='Website') echo "selected"; ?>>Website</option>
                    <option value="Newspaper" <?php if($row[29]=='Newspaper') echo "selected"; ?>>Newspaper</option>
                    <option value="Another Patient" <?php if($row[29]=='Another Patient') echo "selected"; ?>>Another Patient</option>
                    <option value="Social Worker" <?php if($row[29]=='Social Worker') echo "selected"; ?>>Social Worker</option>
                    <option value="None" <?php if($row[29]=='None') echo "selected"; ?>>None</option>
                    </select>                  
                    </td>
                 
                    <td><label> Email Id 1 :</label> </td>
                    <td><input type="text"  name="email1"  id="email1" value="<?php echo $row[24]; ?>"/></td>
				    </tr>
                    
               
                  <?php 

$result = mysql_query("select doc_id,name from doctor where name<>'' order by ASC");
$result1 = mysql_query("select ref_id,name from doctor_ref where name<>'' order by ASC");
?>

                  <tr>
                   <td><label class="timegiven"> Centre:</label></td>
                    <td>
                    <select name="center" id="center">
                   <option value="">Select</option>
                <?php $area1=mysql_query("select * from area ORDER BY name ASC");
				while($area=mysql_fetch_row($area1)){
				?>
                <option value="<?php echo $area[0]; ?>" <?php if($row[19]==$area[0]) echo "selected"; ?>><?php echo $area[0]; ?></option>
                <?php } ?>
                
                    </select>
                    </td>
                  
                  <td><label> Email Id 2 :</label></td>
                  <td><input type="text"  name="email2"  id="email2" value="<?php echo $row[41]; ?>" /></td>
                  </tr>
                  <tr><td><label>Occupation:</label></td><td><input type="text" name="occu" value="<?php echo $row[28]; ?>" /></td><td><label>Marital Status:</label></td><td><select name="marit">
                  <option value="">Marital status</option>
 <option value="married" <?php if($row[71]=='married'){ ?> selected="selected"<?php }  ?>>Married</option>
  <option value="unmarried" <?php if($row[71]=='unmarried'){ ?> selected="selected"<?php }  ?>>Unmarried</option>
                  </select></td></tr>
                   <tr><td><label>Type :</label></td><td colspan="3"><select name="pattype" id="pattype" onchange="showpack('pattype');">
                  <option value="">-select Type-</option>
                  <option value="r" <?php if($row[0]=='r' || $row[0]=='R'){ ?> selected="selected"<?php } ?>>Registered</option>
                  <option value="nr" <?php if($row[0]=='nr' ||$row[0]=='NR'){ ?> selected="selected"<?php } ?>>Non Registered</option>
                  </select></td></tr>
                  </table>
       </table>
                <div id="package" style="display:<?php if($row[0]=='nr'){ ?>none<?php }else{ ?> block <?php } ?>">
                  <table width="1026"><tr><td width="262"><label>Select Package:<?php echo $pac[2]; ?></label>&nbsp;&nbsp;<a href="#" onclick="packagewindow('pack');"><img src="images/add.png" height="15px" width="15px" title="Add New Package" /></a></td><td width="261"><select name="pack" id="pack" onchange="getpackamt(this.id,'packamt');"><option value="">-select Package-</option><?php 
				  $pack=mysql_query("select * from package where status=0 order by amt ASC ");
				  while($packro=mysql_fetch_array($pack))
				  {
				  ?>
                  <option value="<?php echo $packro[1]; ?>"<?php if($packro[1]==$pac[2]){?> selected="selected"<?php  } ?>><?php echo $packro[1]; ?></option>
                  <?php
				  }
				   ?></select></td><td width="108"><label>Package Start Date:</label></td><td width="375"><input type="text" name="stdt" id="stdt" value="<?php if(mysql_num_rows($packr)>0){ echo date("d/m/Y",strtotime($pac[3])); }else{ echo date("d/m/Y");  } ?>"  onClick="displayDatePicker('stdt');"/></td></tr>
                   <tr><td><label>Amount :</label></td><td colspan="3"><input type="text" name="packamt" id="packamt" value="<?php echo $pac[6]; ?>" /></td></tr>
                   <tr><td><label>Remarks :</label></td> <td colspan="4"><input type="text" name="rem" id="rem"  value="<?php echo $row[35]; ?>"/></td></tr>
                  </table></div>
               <!-- <table width="884" id="sub1">
				<tr>
				<td width="195"><label class="ref1">Doctor Reference:</label>
                <label class="ref1">
                <select name="ref1" id="ref1" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="docref();">
                <option value="0">select</option>
                <?php $result21=mysql_query("SELECT * FROM  `doctor` WHERE  `NAME` <>  ' 'ORDER BY name ASC ");
                
                while($row21=mysql_fetch_row($result21))
                {  ?>
                <option value="<?php echo $row21[0]; ?>"<?php if($row[9]==$row21[0] || $row[9]==$row21[1]){ echo "selected"; } ?>><?php echo $row21[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>
                </label>
                </td>
				
				<td width="175"><label class="city">City :</label>
                <label class="ref1">
                <input type="text" name="city1" id="city1" style="width:130px;" value="<?php echo $row[38]; ?>"/></label></td>
				
				<td width="142"><label class="cn">Telephone No.:</label>
                <label class="ref1"><input id="cn1" name="cn1" type="text" style="width:100px;" value="<?php echo $row[39]; ?>"></label></td>
				
				<td width="166" height="87"><label class="cn"> Email: </label>
				<label class="ref1"> <input type="text"  name="email3"  id="email3" style="width:150px;" value="<?php echo $row[40]; ?>"/></label></td>
				
				<td width="182" > 
                <label class="spl">Specialist :</label>
                <label class="splt"><input type="text" name="spl" id="spl" style="width:120px;" value="<?php echo $row[37]; ?>"></label></td>
				</tr>
                
                <tr id="tr">
				<td><label class="ref">Treating Ortho Surgeon:</label>
				<?php
				$result2 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Orthopaedic Surgeon' OR `SPECIAL` LIKE 'Orthopaedic Surgeon' order by name ASC");?>
                <label class="ref">
                <select name="tos" id="tos" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="toss();">
                <option value="0">select</option>
                <?php while($row2=mysql_fetch_row($result2))
                {  ?>
                 <option value="<?php echo $row2[0]; ?>"<?php if($row[43]==$row2[0] || $row[43]==$row2[1]){ echo "selected"; } ?>><?php echo $row2[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input  type="text" name="toscity" id="toscity" style="width:130px;" value="<?php echo $row[44]; ?>"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="tostel" name="tostel" type="text" style="width:100px;" value="<?php echo $row[45]; ?>"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email:</label>
				<label class="ref"><input type="text"  name="tosemail"  id="tosemail" style="width:150px;" value="<?php echo $row[46]; ?>"/></label>
                </td>
                </tr>
				
				<tr id="tr1">
				<td><label class="ref">Treating Paediatrician:</label>
				<?php
				$result3 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Paediatrician' OR `SPECIAL` LIKE 'Paediatrician' order by name ASC");?>
                <label class="ref">
                <select name="paed" id="paed" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="paedd();">
                
                <?php while($row3=mysql_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row3[0]; ?>"<?php if($row[47]==$row3[0] || $row[47]==$row3[1]){ echo "selected"; } ?>><?php echo $row3[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="paedcity" id="paedcity" style="width:130px;" value="<?php echo $row[48]; ?>"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="paedtel" name="paedtel" type="text" style="width:100px;" value="<?php echo $row[49]; ?>"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"> <input type="text"  name="paedemail"  id="paedemail" style="width:150px;" value="<?php echo $row[50]; ?>"/></label>
                </td>
                </tr>
				
				<tr id="tr2">
				<td><label class="ref">Treating Physiotherapist:</label>
				<?php
				$result4 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Physiotherapist' OR `SPECIAL` LIKE 'Physiotherapist' order by name ASC");?>
                <label class="ref">
               <select name="phys" id="phys" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="physs();">
                 <option value="0">select</option>
                <?php while($row4=mysql_fetch_row($result4))
                {  ?>
                <option value="<?php echo $row4[0]; ?>"<?php if($row[51]==$row4[0] || $row[51]==$row4[1]){ echo "selected"; } ?>><?php echo $row4[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input type="text" name="physcity" id="physcity" style="width:130px;" value="<?php echo $row[52]; ?>"> </label>
                 </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="phystel" name="phystel" type="text" style="width:100px;" value="<?php echo $row[53]; ?>"></label>
                </td>
				
				<td width="51"> <label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="physemail"  id="physemail" style="width:150px;" value="<?php echo $row[54]; ?>"/></label>
                </td>
                </tr>
				
				<tr id="tr3">
				<td><label class="ref">Treating Neurologist:</label>
				<?php
				$result5 = mysql_query("select doc_id,name from doctor where SPECIAL='Neuro Surgeon' OR  SPECIAL='Neurologist' or CATEGORY ='Neurologist' order by name ASC");?>
                <label class="ref">
                <select name="neu" id="neu" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="neuu();">

                 <option value="0">select</option>
                <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"<?php if($row[55]==$row5[0]){ echo "selected"; } ?>><?php echo $row5[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
				
				<td width="67"><label class="city">City :</label>
                <label class="ref">
                <input type="text" name="neucity" id="neucity" style="width:130px;" value="<?php echo $row[64]; ?>">  </label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="neutel" name="neutel" type="text" style="width:100px;" value="<?php echo $row[57]; ?>"></label>
                </td>
				
				<td width="51" > <label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="neuemail"  id="neuemail" style="width:150px;" value="<?php echo $row[58]; ?>"/></label>
                </td>
                </tr>
				
				<tr id="tr4">
				<td><label class="ref">Social Workers Name:</label>
				<?php
				$result6 = mysql_query("select * from social where name<>'' order by name ASC");?>
				
                <label class="ref"><select name="sw" id="sw" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="swwn();">
                <option value="0">select</option>
                <?php while($row6=mysql_fetch_row($result6))
                {  ?>
                <option value="<?php echo $row6[4]; ?>"<?php if($row[59]==$row6[0]){ echo "selected"; } ?>><?php echo $row6[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
                
                <td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="swcity" id="swcity" style="width:130px;" value="<?php echo $row[60]; ?>"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="swtel" name="swtel" type="text" style="width:100px;" value="<?php echo $row[61]; ?>"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"> <input type="text"  name="swemail"  id="swemail" style="width:150px;" value="<?php echo $row[62]; ?>"/></label>
                </td>
                </tr>
                
				
				<tr id="tr5">
				<td><label class="ref">NGO Reference:</label>
				<?php
				$result7 = mysql_query("select * from ngo where name<>'' order by name ASC");?>
				<?php $result27=mysql_query("select * from ngo where name='$row[63]'");
				 $row27=mysql_fetch_row($result27);?>
                <label class="ref"><select name="ng" id="ng" style="background:#fff;border:1px solid #ac0404;width:180px;height:27px;text-transform:uppercase" onchange="ngo();">
                <option value="0">select</option>
                <?php while($row7=mysql_fetch_row($result7))
                {  ?>
                <option value="<?php echo $row7[4]; ?>"<?php if($row[63]==$row7[0]){ echo "selected"; } ?>><?php echo $row7[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select></label>
                </td>
                
                
				<td width="67"><label class="city">City :</label>
                <label class="ref"><input type="text" name="ngcity" id="ngcity" style="width:130px;" value="<?php echo $row[64]; ?>"></label>
                </td>
				
				<td width="107" height="33"><label class="cn">Telephone No.:</label>
                <label class="ref"><input id="ngtel" name="ngtel" type="text" style="width:100px;" value="<?php echo $row[65]; ?>"></label>
                </td>
				
				<td width="51" ><label class="ref"> Email: </label>
				<label class="ref"><input type="text"  name="ngemail" id="ngemail" style="width:150px;" value="<?php echo $row[66]; ?>"/></label>
                </td>
                </tr>
				
                </table>-->
              
               
                
                <tr>
                <td>
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                <input type="submit" class="" name="submit" value="Save & Exit" />
                </td>
			
				<td colspan="2"><button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_patient1.php';" style="width:100px;">Cancel</button></td>
                </tr> 
                </table>
                  </fieldset>
         </form>

</div>