<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.php");
include('template_clinic.php');
include('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Take Care</title>

<link href="style_clinic.css" rel="stylesheet" type="text/css" />

<!--<link href="ddmenu/ddmenu.css" rel="stylesheet" type="text/css" />
<script src="ddmenu/ddmenu.js" type="text/javascript"></script>-->

<script type="text/javascript" src="autocomplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="js/newpatient.js"></script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<script>
function validate(form){
 with(form)
 {
   if(fname.value=="")/*Name validation*/
   {
	alert("Please Enter Firstname");
	fname.focus();
	return false;
    }
  if(year.value=='-1')/*year validation*/
   {
	alert("Please Select Year");
	year.focus();
	return false;
    }
	if((gen[0].checked==false)&& (gen[1].checked==false))/*Gender validation*/
    {
	alert("Please choose your Gender: Male or Female.");
	gen[0].focus();
	return false;
    }
   if(cn22.value=="")/*mobile no. validation*/
    {
    alert("Please Enter 10 Digits Mobile Number.");
	cn22.focus();
	return false;
	}else {    	        
		 phoneno = /^\d{10}$/;
		 x=document.getElementById('cn22').value;
		 if(x.match(phoneno))
         {
       
        }
        else
        {
        alert("Enter Mobile number not valid.");		
		cn22.focus();
        return false;
        }	
}
	
    
  if(city.value=="")/*city validation*/
    {
	alert("Please Select City.");
	city.focus();
	return false;
    }
   if(center.value=="")/*center validation*/
    {
	alert("Please Select Center.");
	center.focus();
	return false;
    }
	if(marit.value=='-1')/*marital validation*/
   {
	alert("Please Marital status.");
	marit.focus();
	return false;
    }
    if(pattype.value=='r')/*in Register patient package validation*/
    {
    if(pack.value=="")
    {
	alert("Please Select Package."); /*Package validation*/
	pack.focus();
	return false;
    }
   if(stdt.value=="")
   {
	alert("Please Select Package Start Date.");/*package start date validation*/
	stdt.focus();
	return false;
    }
   if(disamt.value=="")/*Discount validation*/
    {
	alert("Please Enter Discount.");  
	disamt.focus();
	return false;
    }
   }
 }
   if(confirm('Are you sure you want to Enter this new patient.')) 
   {
    return true;
   }
   else 
   {
    return false;
}
 return true;
 }
</script>
</head>
<body>
<!--HEADER STARTE HERE-->
	

    <div class="M_page">
    
   

       <form method="post" class="signin" action="new_patient.php" onSubmit="return validate(this)" name="form" enctype="multipart/form-data" autocomplete='OFF' >
       
                <fieldset class="textbox">
                <legend><h1> <img src="ddmenu/img1.png" style="width:50px; height:50px;" />New Patient </h1></legend>
                 
                
                <input id="cdate" name="cdate" type="hidden" value="<?php echo date( "d/m/Y");?>" readonly>
                
               <table width="1029" id="sub">
               
               <!--from here-->
               <tr>
                <td width="128"> <label>Upload Photo:</label> </td>
                <td colspan="3"><div id="img">
                
               <input type="file" name="photo" id="photo" style="background:none; border:none;" onchange="show_pic()"/>
  
                <?php // }?></div>
                <br/>             
                
                
                </tr>
               <!--till here-->
                  <tr>
                    <td ><label class="fname"> Full Name: </label></td>
                    <td width="340" ><input id="fname" name="fname" type="text" />
                    </td>
                    <td width="109" ><label class="age"> Date of Birth: </label></td>
                    <td width="432" >
                    <table>
                    <tr>
 <td>              
<label>Year:</label> 
<select name="year" id="year" size="1" onfocus="createList();" onblur="ageCount();">
<option value="-1" selected="selected"> </option>
</select></td>
<td>

<label for="month">Month: </label>
<select name="month" id="month" size="1" onchange="setDay();" onblur="ageCount();">
<option value="01" selected="selected"> </option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</td>

<td>
<label for="day">Day: </label>
<select name="day" id="day" size="1" onblur="ageCount();">
<option value="01" selected="selected"> </option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
                   <!-- <input id="dob" name="dob" type="text" onclick="displayCalendar(document.forms[0].dob,'dd/mm/yyyy',this)"/>-->
                    <input id="age" name="age" type="hidden"  readonly="readonly"/>
                    </td>
                    
                    </tr>
                    </table>
                    </td>
                    
                    
                    
                    
                    
                  </tr>
                  <script type="text/javascript">
    
function ageCount() {
var y =document.getElementById('year').value
var m =document.getElementById('month').value
var d =document.getElementById('day').value 
if(y!='0' && m!='0' && d!='0')
{
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
   }
function refrence(val)
{
document.getElementById("ref").value=val;
}
</script>

                  <tr>
                    <td height="33"><label > Sex: </label></td>
                    <td> 
                         <table> <tr> <td ><label> Male:</label></td> <td ><input name="gen" id="gen" type="radio" value="Male" /></td></tr>
                        
                       <tr> <td><label> Female: </label> </td> <td><input name="gen" id="gen" type="radio" value="Female" /></td></tr>
                      </table>
                    </td>
                   
                    
                    <td ><label class="cn">Mobile1 :</label></td>
                    <td><input id="cn22" name="cn22" type="text" /></td>
                  </tr>
                  
                  <tr id="cy"><td><label class="city">City :&nbsp;&nbsp;<a href="#" onclick="citywindow('city');"><img src="images/add.png" height="15px" width="15px" title="Add New City" /></a></label></td>
                  <td>
                   
                <input type="text" name="city" id="city" onkeyup="lookup2(this.value,this.id,'citysuggestions','cityautoSuggestionsList','cityref1');" value="Mumbai"   />
               
               <div class="suggestionsBox" id="citysuggestions" style="display: none; position:absolute; left:250px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
				
                <div class="suggestionList" id="cityautoSuggestionsList">
                
					&nbsp;
				</div>
			</div>
                  <!--<select name="city" id="city" style="background:#fff;border:1px solid #ac0404;width:222px;height:27px;" onchange="newcity()">
                   <option value="MUMBAI">MUMBAI</option>
                   <?php $city=mysql_query("select name,city_id from city where name<>'' ORDER BY name ASC ");
				   while($city1=mysql_fetch_row($city)){?>
                        <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                        <?php } ?>
                       
                  </select>-->
                   </td>
                    
                   <td height="33"><label class="cn">Mobile2 :</label></td>
                   <td><input id="mob2" name="mob2" type="text" /></td>
                  </tr>
                  
                  <tr>
                    <td><label class="add">Address:</label></td>
                    <td><textarea name="add" rows="3" cols="25"></textarea></td>
                   
                   <td height="33"><label >Telephone No.:</label></td>
                   <td><input id="cn12" name="cn12" type="text" /></td>
                  </tr>
				  
				  <tr>
				  <td><label> Reference Template:</label> <label> Referred By:</label></td>
                  <td>
                    <select name="refferd" id="reffered" onchange="refrence(this.value)">
                    <option value="">Select</option>
                    <?php
                    	$refqry=mysql_query("SELECT * FROM `reference`");
                    	while($refrow=mysql_fetch_array($refqry))
                    	{
                    ?>
                    	<option value="<?php echo $refrow['desc']; ?>"><?php echo $refrow['desc']; ?></option>
                    <?php
                    	}
                    ?>
                    </select>
                    &nbsp;&nbsp;<a href="#" onclick="addreference('ref');"><img src="images/add.png" height="15px" width="15px" title="Add New Reference" /></a><br />  
                    <input type="text" name="ref" id="ref" />                 
                   </td>
                    
                   <td> <label>Email Id 1 : </label></td>
                   <td><input type="text"  name="email1"  id="email1" style="text-transform:lowercase;"/></td>
				  </tr>
                  
                 
                  <?php 

$result = mysql_query("select doc_id,name from doctor where name<>'' order by ASC");
$result1 = mysql_query("select ref_id,name from doctor_ref where name<>'' order by ASC");
?>
                  <tr>
                   <td><label class="timegiven"> Centre:&nbsp;&nbsp;<a href="#" onclick="citywindow('area');"><img src="images/add.png" height="15px" width="15px" title="Add New Center" /></a></label></td>
                    <td>
                    <select name="center" id="center" >
                    <option value="Andheri">Andheri</option>  
                    <option value="Borivali">Borivali</option>
                    <option value="Malad">Malad</option>
                    
                    </select>
                    
               <!-- <input type="text" name="center" id="center" onkeyup="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" value="Borivali"  />-->
               <!--<div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:160px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>-->
                    <!--<select name="center" id="center" style="background:#fff;border:1px solid #ac0404;width:222px;height:26px;" onchange="newcenter();">
                        <option value="0">Select</option>
                <?php $area1=mysql_query("select UPPER(name),area_id from area ORDER BY name ASC");
				while($area=mysql_fetch_row($area1)){
				?>
                <option value="<?php echo $area[0]; ?>"><?php echo $area[0]; ?></option>
                <?php } ?>
                
                    </select>-->
                    </td>
                  
                  <td> <label>Email Id 2 :</label></td>
                    <td><input type="text"  name="email2"  id="email2" style="text-transform:lowercase;"/>
                    </td>
                  </tr>
                  <tr><td><label>Occupation:</label></td><td><input type="text" name="occu" /></td><td><label>Marital Status:</label></td><td><select name="marit">
                  <option value="">Marital status</option>
 <option value="married">Married</option>
  <option value="unmarried">Unmarried</option>
                  </select></td></tr>
                  <tr>
                  <td><label>Type:</label></td>
                  <td><select name="pattype" id="pattype" onchange="showpack('pattype');">
                  <option value="">-select Type-</option>
                  <option value="r">Registered</option>
                  <option value="nr">Non Registered</option>
                  </select>
                  </td>
                  <td><label>Reference:</label></td>
                  <td>
                  	<select name="patref" id="patref">
		                  <option value="">-select Patient-</option>
		                  <?php
		                  	$patient_qry=mysql_query("SELECT `SRNO`,`NAME` FROM `patient` where NAME!='' order by NAME");
		                  	while($patient_row=mysql_fetch_array($patient_qry))
		                  	{
		                  ?>                  
		                  <option value="<?php echo $patient_row['SRNO']; ?>"><?php echo $patient_row['NAME']; ?></option>
		                  <?php
		                  	}
		                  ?>
                  	</select>
                  </td>
                  </tr>
                 	
                </table>
                <div id="package">
                  <table width="1032">
                    <tr><td width="151"><label>Select Package:</label>&nbsp;&nbsp;<a href="#" onclick="packagewindow('pack');">
                    <img src="images/add.png" height="15px" width="15px" title="Add New Package" /></a></td>
                    <td width="237"><select name="pack" id="pack" onchange="getpackamt(this.id,'packamt');">
                    <option value="">-select Package-</option>
					<?php 
				  $pack=mysql_query("select * from package where status=0 order by amt ASC ");
				  while($packro=mysql_fetch_array($pack))
				  {
				  ?>
                  <option value="<?php echo $packro[0]; ?>"><?php echo $packro[1]; ?></option>
                  <?php
				  }
				   ?></select>
                   </td><td width="178"><label>Package Start Date:</label></td>
                  <td width="446"><input type="text" name="stdt" id="stdt" value="<?php echo date("d/m/Y"); ?>"  onClick="displayDatePicker('stdt');"/></td></tr>
                   <tr>
                       <td><label>Package Amount :</label></td><td><input type="text" name="packamt" id="packamt" readonly="readonly" /> </td>
                       <td><label>Discount Amount Rs. :</label></td><td><input type="text" name="disamt" id="disamt" onkeyup="displayDiss();" value="0" /> </td>
                   </tr>
                   
     <tr><td ><label>Net Amount :</label></td> <td colspan="3"><input type="text" readonly="readonly" name="netamt"  id="netamt" value="" /></tr>
                  </table></div>

              <!--  <table id="sub1">
				<tr>
				<td width="343"><label class="ref1">Doctor Reference:&nbsp;&nbsp;<a href="#" onclick="openwin('newdoctor.php?link=doc','doctor','width=900px,height=auto,left=200,top=100')"><img src="images/add.png" height="15px" width="15px" title="Add New Doctor" /></a>&nbsp;&nbsp;<a href="#" onclick="openedtwin('editdoctor.php?link=doc','Editdoctor','width=900px,height=auto,left=200,top=100','docref1','ref1')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label>
                <label class="ref2">
               
                <input type="hidden" name="docref1" id="docref1" />
                <input type="text" name="ref1" id="ref1" onkeyup="lookup(this.value,this.id,'ref1suggestions','ref1autoSuggestionsList','docref1');" style="background:#fff;border:1px solid #ac0404;width:150px;" onblur="docref('docref1');"  />
               <div class="suggestionsBox" id="ref1suggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="ref1autoSuggestionsList">
					&nbsp;
				</div>
			</div>
                <!--<select name="ref1" id="ref1" onchange="docref();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php 
				$cond=" WHERE  `NAME` <>  ' '";
				$resultd = mysql_query("SELECT * FROM  `doctor` WHERE  `NAME` <>  ' 'ORDER BY name ASC ");
				while($rowd=mysql_fetch_row($resultd))
                {  ?>
                <option value="<?php echo $rowd[0]; ?>"><?php echo $rowd[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>&nbsp;&nbsp;<a href="#" onclick="window.open('newdoctor.php?id=doctor','supplier','width=600,height=300,left=200,top=100')"><img src="images/add.png" height="10px" width="10px" /></a>&nbsp;&nbsp;<a href="#" onclick="window.open('editdoctor.php?id=doctor&field=document.getElementById('ref1').value','supplier','width=600,height=300,left=200,top=100')"><img src="images/edit.png" height="10px" width="10px" /></a>--><!--</label>	</td>
				
				<td width="137" valign="top"><label class="city">City :</label>
                <label class="city1">
                <input type="text" name="city1" id="city1" style="width:130px;" readonly="readonly"/></label>				</td>
				
				<td width="116" valign="top"><label class="cn">Telephone No.:</label>
                <label class="cn1"><input id="cn1" name="cn1" type="text" style="width:100px;" readonly="readonly"></label></td>
				
				<td width="151" height="33" valign="top"><label class="email"> Email: </label>
				<label class="email1"> <input type="text"  name="email3"  id="email3" style="width:150px;" readonly="readonly"/></label>
                </td>
				
				<td width="211" valign="top" > 
                <label class="spl">Specialist :</label>
                <label class="spl1"><input type="text" name="spl" id="spl" style="width:150px;" readonly="readonly">
				</label></td>
                </tr>
				
				<tr id="tr">
				<td><label class="ref">Treating Ortho Surgeon:&nbsp;&nbsp;<a href="#" onclick="openedtwin('editdoctor.php?link=doc','Editdoctor','width=900px,height=auto,left=200,top=100','tosref1','tos')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label>
                 <input type="hidden" name="tosref1" id="tosref1" />
                <input type="text" name="tos" id="tos" onkeyup="lookup(this.value,this.id,'tossuggestions','tosautoSuggestionsList','tosref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="toss('tosref1');"  />
               <div class="suggestionsBox" id="tossuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="tosautoSuggestionsList">
					&nbsp;
				</div>
			</div>
			<!--	<?php
				$result2 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Orthopaedic Surgeon' OR `SPECIAL` LIKE 'Orthopaedic Surgeon' order by name ASC");?>
                <label class="tos1">
                <select name="tos" id="tos" onchange="toss();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row2=mysql_fetch_row($result2))
                {  ?>
                <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label>
                </td>
				
				<td width="137"><label class="city">City :</label>
                <label class="toscity">
                <input  type="text" name="toscity" id="toscity" style="width:130px;" readonly="readonly"></label>                </td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="toscn"><input id="tostel" name="tostel" type="text" style="width:100px;" readonly="readonly"></label>
                </td>
				
				<td width="151" > <label class="cn"> Email: </label>
				<label class="emailtos"><input type="text"  name="tosemail"  id="tosemail" style="width:150px;" readonly="readonly"/></label>
                </td>
                </tr>
				
				<tr id="tr1">
				<td><label class="ref">Treating Paediatrician:&nbsp;&nbsp;<a href="#" onclick="openedtwin('editdoctor.php?link=doc','Editdoctor','width=900px,height=auto,left=200,top=100','paedref1','paed')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label><label class="paedref">
                 <input type="hidden" name="paedref1" id="paedref1" />
                <input type="text" name="paed" id="paed" onkeyup="lookup(this.value,this.id,'paedsuggestions','paedautoSuggestionsList','paedref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="paedd('paedref1');"  />
               <div class="suggestionsBox" id="paedsuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="paedautoSuggestionsList">
					&nbsp;
				</div>
			</div>
			<!--	<?php
				$result3 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Paediatrician' OR `SPECIAL` LIKE 'Paediatrician' order by name ASC");?>
                
                <select name="paed" id="paed"  onchange="paedd();"style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row3=mysql_fetch_row($result3))
                {  ?>
                <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label>
                </td>
				
				<td width="137"><label class="city">City :</label>
                <label class="paedcity">
                <input type="text" name="paedcity" id="paedcity" style="width:130px;" readonly="readonly"> </label>	</td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="paedcn"><input id="paedtel" name="paedtel" type="text" style="width:100px;" readonly="readonly"></label></td>
				
				<td width="151" ><label class="paedemail"> Email: </label>
				<label class="paedemail1"><input type="text"  name="paedemail"  id="paedemail" style="width:150px;" readonly="readonly"/></label></td>
                </tr>
				
				<tr id="tr2">
				<td><label class="ref">Treating Physiotherapist:&nbsp;&nbsp;<a href="#" onclick="openedtwin('editdoctor.php?link=doc','Editdoctor','width=900px,height=auto,left=200,top=100','physref1','phys')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label> <label class="phys1">
                <input type="hidden" name="physref1" id="physref1" />
                <input type="text" name="phys" id="phys" onkeyup="lookup(this.value,this.id,'physsuggestions','physautoSuggestionsList','physref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="physs('physref1');"  />
               <div class="suggestionsBox" id="physsuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="physautoSuggestionsList">
					&nbsp;
				</div>
			</div>
				<!--<?php
				$result4 = mysql_query("SELECT *  FROM `doctor` WHERE `CATEGORY` LIKE 'Physiotherapist' OR `SPECIAL` LIKE 'Physiotherapist' order by name ASC");?>
               
                <select name="phys" id="phys" onchange="physs();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row4=mysql_fetch_row($result4))
                {  ?>
                <option value="<?php echo $row4[0]; ?>"><?php echo $row4[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label></td>
				
				<td width="137"><label class="city">City :</label>
                <label class="physcity">
                <input type="text" name="physcity" id="physcity" style="width:130px;" readonly="readonly"> </label>
                </td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="phystel"><input id="phystel" name="phystel" type="text" style="width:100px;" readonly="readonly"></label>
                </td>
				
				<td width="151" ><label class="pysmail"> Email: </label>
				<label class="physmail1"> <input type="text"  name="physemail"  id="physemail" style="width:150px;" readonly="readonly"/></label>
                </td>
                </tr>
				
				<tr id="tr3">
				<td><label class="ref">Treating Neurologist:&nbsp;&nbsp;<a href="#" onclick="openedtwin('editdoctor.php?link=doc','Editdoctor','width=900px,height=auto,left=200,top=100','neuref1','neu')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label>
				<label class="tn">
				<input type="hidden" name="neuref1" id="neuref1" />
                <input type="text" name="neu" id="neu" onkeyup="lookup(this.value,this.id,'neusuggestions','neuautoSuggestionsList','neuref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="neuu('neuref1');"  />
               <div class="suggestionsBox" id="neusuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="neuautoSuggestionsList">
					&nbsp;
				</div>
			</div>
				<!--<?php
				$result5 = mysql_query("select doc_id,name from doctor where SPECIAL='Neuro Surgeon' OR  SPECIAL='Neurologist' or CATEGORY ='Neurologist' order by name ASC");?>
                <label class="tn"><select name="neu" id="neu" onchange="neuu();" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;">
                <option value="0">Select</option>
                <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>"><?php echo $row5[1]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label></td>
				
				<td width="137"><label class="city">City :</label>
                <label class="neu1">
                <input type="text" name="neucity" id="neucity" style="width:130px;" readonly="readonly"></label></td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="neutel1"><input id="neutel" name="neutel" type="text" style="width:100px;" readonly="readonly"></label></td>
				
				<td width="151" > <label class="neumail">Email: </label>
				<label class="neumail1"><input type="text"  name="neuemail"  id="neuemail" style="width:150px;" readonly="readonly"/></label></td>
                </tr>
				
				<tr id="tr4">
				<td><label class="ref">Social Workers:&nbsp;&nbsp;<a href="#" onclick="openwin('newsocial.php?link=doc','social','width=900px,height=auto,left=200,top=100')"><img src="images/add.png" height="15px" width="15px" title="Add New Social Worker" /></a>&nbsp;&nbsp;<a href="#" onclick="openedtwin('editsocial.php?link=socialajax','Editdoctor','width=900px,height=auto,left=200,top=100','swref1','sw')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label><label class="sc">
                <input type="hidden" name="swref1" id="swref1" />
                <input type="text" name="sw" id="sw" onkeyup="lookup(this.value,this.id,'swsuggestions','swautoSuggestionsList','swref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="swwn('swref1');"  />
               <div class="suggestionsBox" id="swsuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="swautoSuggestionsList">
					&nbsp;
				</div>
			</div>
			<!--	<?php
				$result6 = mysql_query("select * from social where name<>'' order by name");?>
                <label class="sc"><select name="sw" id="sw" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;" onchange="swwn();">
                <option value="0">Select</option>
                <?php while($row6=mysql_fetch_row($result6))
                {  ?>
                <option value="<?php echo $row6[4]; ?>"><?php echo $row6[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label></td>
                
                <td width="137"><label class="city">City :</label>
                <label class="scity"><input type="text" name="swcity" id="swcity" style="width:130px;"  readonly="readonly"></label>
                </td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="swtel"><input id="swtel" name="swtel" type="text" style="width:100px;" readonly="readonly"></label></td>
				
				<td width="151" > <label class="swmail"> Email:</label>
				<label class="swmail1"><input type="text"  name="swemail"  id="swemail" style="width:150px;" readonly="readonly"/></label></td>
                </tr>
                
				<tr id="tr5">
				<td><label class="ref" style="width:160">NGO Reference::&nbsp;&nbsp;<a href="#" onclick="openwin('newngo.php?link=doc','ngo','width=900px,height=auto,left=200,top=100')"><img src="images/add.png" height="15px" width="15px" title="Add New NGO" /></a>&nbsp;&nbsp;<a href="#" onclick="openedtwin('editsocial.php?link=ngoajax','Ngo','width=900px,height=auto,left=200,top=100','ngref1','ng')"><img src="images/edit.png" height="15px" width="15px" title="Edit Doctor" alt="Edit" /></a></label><label class="ng">
                <input type="hidden" name="ngref1" id="ngref1" />
                <input type="text" name="ng" id="ng" onkeyup="lookup(this.value,this.id,'ngsuggestions','ngautoSuggestionsList','ngref1');" style="background:#fff;border:1px solid #ac0404;width:150px;"  onblur="ngo('ngref1');"  />
               <div class="suggestionsBox" id="ngsuggestions" style="display: none; position:absolute; left:370px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="ngautoSuggestionsList">
					&nbsp;
				</div>
			</div>
				<!--<?php
				$result7 = mysql_query("select * from ngo where name<>'' order by name");?>
                <label class="ng"><select name="ng" id="ng" style="background:#fff;border:1px solid #ac0404;width:150px;height:27px;" onchange="ngo();">
                <option value="0">Select</option>
                <?php while($row7=mysql_fetch_row($result7))
                {  ?>
                <option value="<?php echo $row7[4]; ?>"><?php echo $row7[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>--><!--</label></td>
                
                
				<td width="137"><label class="city">City :</label>
                <label class="ngcity">
                <input type="text" name="ngcity" id="ngcity" style="width:130px;" readonly="readonly"> </label></td>
				
				<td width="116" height="33"><label class="cn">Telephone No.:</label>
                <label class="ngtel1"><input id="ngtel" name="ngtel" type="text" style="width:100px;" readonly="readonly"></label></td>
				
				<td width="151" > <label class="ngmail">Email: </label>
				<label class="ngmail1"> <input type="text"  name="ngemail" id="ngemail" style="width:150px;" readonly="readonly"/></label></td>
                </tr>
				
				
                </table>-->
                <table>
                <tr>
                <td>Remarks : </td>
				<td colspan="4"><input type="text" name="rem" id="rem" /></td>
				</tr
                
                ><tr>
                <td><button class="formbutton" type="submit" name="Submit">Save & Exit</button> </td>
			
				<td colspan="2"><a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a></td>
				<td><!--<button class="submit formbutton" type="submit" >Save & Clinical Info</button>--> </td> 
                </tr>   
                </table>
                 
                </fieldset>  
              </form>
              
   </div>

</body>
</html>