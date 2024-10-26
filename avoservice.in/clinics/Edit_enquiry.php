<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");

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


</head>
<body>
<!--HEADER STARTE HERE-->


    <div class="M_page">
    
   <?php
   

if(isset($_GET['id']));
 $id=$_GET['id'];
if(isset($_GET['center']));
 $center=$_GET['center'];
 
	//echo "select * from enquiryperson where id='".$id."' and center='".$center."'";
	$query=mysql_query("select * from enquiryperson where trackid='".$id."'");
	//if(!$query)
	//echo "failed".mysql_error();
	  $row=mysql_fetch_row($query);
	//echo $row[1];

   ?>

       <form method="post" class="signin" action="Edit_enquery_processenq.php" onSubmit="return validateenq(this)" name="form" enctype="multipart/form-data" autocomplete='OFF' >
       
                <fieldset class="textbox">
                <legend><h1> <img src="ddmenu/img1.png" style="width:50px; height:50px;" />Edit Enquiry </h1></legend>
                 
                
                <input id="cdate" name="cdate" type="hidden" value="<?php echo date( "d/m/Y");?>" readonly>
                
               <table width="1029" id="sub">
               <?php
			   if(isset($_SESSION['success']) || isset($_SESSION['fail']))
{			   ?>
               <tr><td align="center" colspan="4"><h2><?php echo $_SESSION['fail']." ".$_SESSION['success'];
			   if(isset($_SESSION['success']) || isset($_SESSION['fail'])){
			   unset($_SESSION['fail']);
			   unset($_SESSION['success']);
			   }
			    ?></h2></td></tr>
               <?php
			   }
			   ?>
               
              
               
               
               <?php

	?>

               
                  <tr>
                    <td ><label class="fname"> Full Name: </label></td>
                    <td width="340" ><input id="name" readonly="readonly" name="name" type="text" value="<?php echo $row[1]; ?> " />
                    </td>
                   <!-- <td width="109" ><label class="age" > Date of Birth: </label></td>
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
                   
                    <input id="age" name="age" type="hidden"  readonly="readonly"/>
                    </td>
                    
                    </tr>
                    </table>-->
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

                  <!--<tr>
                    <td height="33"><label > Sex: </label></td>
                    <td> 
                         <table> <tr> <td ><label> Male:</label></td> <td ><input name="gen" id="gen" type="radio" value="Male" /></td></tr>
                        
                       <tr> <td><label> Female: </label> </td> <td><input name="gen" id="gen" type="radio" value="Female" /></td></tr>
                      </table>
                    </td>
                   
                    
                    <td ><label class="cn">Mobile1 :</label></td>
                    <td><input id="cn22" name="cn22" type="text" value="<?php echo $row[11]; ?> "/></td>
                  </tr>-->
                  
                  <!--<tr id="cy"><td><label class="city">City :&nbsp;&nbsp;<a href="#" onclick="citywindow('city');"><img src="images/add.png" height="15px" width="15px" title="Add New City" /></a></label></td>
                  <td>
                   
                <input type="text" name="city" id="city" onkeyup="lookup2(this.value,this.id,'citysuggestions','cityautoSuggestionsList','cityref1');" value="<?php// echo $row[6]; ?> "  />
               
               <div class="suggestionsBox" id="citysuggestions" style="display: none; position:absolute; left:250px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
				
                <div class="suggestionList" id="cityautoSuggestionsList">
                
					&nbsp;
				</div>
			</div>
                  
                   <?php //$city=mysql_query("select name,city_id from city where name<>'' ORDER BY name ASC ");
				   //while($city1=mysql_fetch_row($city)){?>
                        <option value="<?php //echo $city1[0]; ?>"><?php //echo $city1[0]; ?></option>
                        <?php //} ?>
                       
                  </select>-->
                  
                  
                   <!--</td>
                    
                   <td height="33"><label class="cn">Mobile2 :</label></td>
                   <td><input id="mob2" name="mob2" type="text" value="<?php //echo $row[12]; ?> " /></td>
                  </tr>
                  
                  <tr>
                    <td><label class="add">Address:</label></td>
                    <td><textarea name="add" rows="3" value="<?php// echo $row[8]; ?> " cols="25"></textarea></td>
                   
                   <td height="33"><label >Telephone No.:</label></td>
                   <td><input id="cn12" name="cn12" type="text" value="<?php// echo $row[10]; ?> " /></td>
                  </tr>
				  
				  <tr>
				  <td><label> Reference Template:</label> <label> Referred By:</label></td>
                  <td>
                    <select name="refferd" id="reffered" onchange="refrence(this.value)">
                    <option value="">Select</option>
                    <option value="Just Dial">Just Dial</option>
                    <option value="Dr">Dr</option>
                    <option value="Website">Website</option>
                    <option value="Newspaper">Newspaper</option>
                    <option value="Another Patient">Another Patient</option>
                    <option value="Social Worker">Social Worker</option>
                    <option value="None">None</option>
                    </select><br />  
                    <input type="text" name="ref" id="ref" value="<?php //echo $row[5]; ?>" />                 
                   </td>
                    
                   <td> <label>Email Id 1 : </label></td>
                   <td><input type="text"  name="email1"  id="email1" value="<?php //echo $row[14]; ?> " style="text-transform:lowercase;"/></td>
				  </tr>
-->                  
                 
                  <?php 

$result = mysql_query("select doc_id,name from doctor where name<>'' order by ASC");
$result1 = mysql_query("select ref_id,name from doctor_ref where name<>'' order by ASC");
?>
                  <tr>
                   <td><label class="timegiven"> Centre:&nbsp;&nbsp;<a href="#" onclick="citywindow('area');"><img src="images/add.png" height="15px" width="15px" title="Add New Center" /></a></label></td>
                    <td>
                    
                <input type="text" name="center" id="center" readonly="readonly" onkeyup="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" value="Borivali"  />
               <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:170px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>
                    <!--<select name="center" id="center" style="background:#fff;border:1px solid #ac0404;width:222px;height:26px;" onchange="newcenter();">
                        <option value="0">Select</option>
                <?php //$area1=mysql_query("select UPPER(name),area_id from area ORDER BY name ASC");
				//while($area=mysql_fetch_row($area1)){
				?>
                <option value="<?php //echo $area[0]; ?>"><?php //echo $area[0]; ?></option>
                <?php //} ?>
                
                    </select>-->
                    </td>
                  
                  <td>Next Call </td>
                    <td><input type="text" name="nxtdate" style="width:170px;" id="nxtdate" onClick="displayDatePicker('nxtdate');" value="<?php echo date("d/m/Y",strtotime("+1 day")); ?>" />
                    </td>
                  </tr>
                
                 	
                </table>
                

            
                <table width="1030">
                <tr>
                <td>Remarks : </td>
				<td colspan="4"><input type="text"  name="rem" id="rem" /></td>
				</tr>
                
                <tr>
                
                <td><input type="hidden" name="srno" value="<?php echo $id; ?>" /><button class="formbutton" type="submit" name="Submit">Save & Exit</button> </td>
			
 				<td colspan="2"><a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a></td>
				<td> </td> 
                </tr>   
                </table>
                 
                </fieldset>  
              </form>
              
   </div>

</body>
</html>

