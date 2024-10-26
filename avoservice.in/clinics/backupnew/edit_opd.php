<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");

include('template_clinic.html');
include('config.php');


$id=$_GET['id'];
//echo "select * from opd where opd_real_id='$id'";
$sql="select * from opd where opd_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[1];
//echo $row[8];
$sql1="select * from patient where srno='$pid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$time=$row[39];
list($hr, $min) = explode(":", $time);

$time1=$row[39];$dur= substr($time1,6);//echo $dur;

$soi=$row[34];
list($ho,$sur,$dt) = explode(",", $soi);//echo $ho."".$sur."$dt";

?>
<style>

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
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>


<!-- validation-->
<script type="text/javascript">

function opdvalidate(opdform){
 with(opdform)
 {
  

if(date.value=="")
{
	alert("Please select Date");
	date.focus();
	return false;
}
 
}
 return true;
 }
</script><!--end validation-->

<!-- multiple selection -->
<script type="text/javascript">
function addThem(){
	
var a = document.opdform.diagn;
//alert(a.value);
var add = a.value+'\n';

document.opdform.diag.value += add;
return true;
}

function addThem1(){
var a = document.opdform.rec;

var add = a.value+'\n';

document.opdform.adv.value += add;
return true;
}

function addThem2(){
	
var a = document.opdform.compl;
//alert(a.value);
var add = a.value+'\n';

document.opdform.comp.value += add;
return true;
}

function addThem3(){
	
var a = document.opdform.findi;
//alert(a.value);
var add = a.value+'\n';

document.opdform.findin.value += add;
return true;
}


function addThemsoi(){
	
var a = document.opdform.hos;
//alert(a.value);
var add = a.value+'\n';

document.opdform.soi.value += add;
return true;
}

function addThemaction(){
	
var a = document.opdform.act;
//alert(a.value);
var add = a.value+'\n';

document.opdform.actxt.value += add;
return true;
}

<!--add surgery-->
function addsurgery(){
	
var a = document.opdform.surgery;
//alert(a.value);
var add = a.value+'\n';

document.opdform.soi.value += add;
return true;
}
///add date
function adddt(){
	
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var s=daym+"/"+month+"/"+year;
document.getElementById("cdate").value = s

document.opdform.soi.value += s;
return true;
}

 ////upload image
function upp(){
var newdiv=document.createElement("div");
var aTextBox=document.createElement('input');
aTextBox.type = 'file';
aTextBox.name = 'image[]';
aTextBox.style='background:none; border:none;';

 //append text to new div
newdiv.appendChild(aTextBox); //append text to new div
//alert(aTextBox)
document.getElementById("img").appendChild(newdiv); 
}

/////////////////////
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

<!-- examination template -->

function temp()
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
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
  var str=document.getElementById('examtemp').value;
  
xmlhttp.open("GET","get_exm.php?exm="+str,true);
xmlhttp.send();
}
///
function temp1()
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
   /// alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("comp").value=s1[0];
		document.getElementById("findin").value=s1[1];
		document.getElementById("adv").value=s1[2];
		document.getElementById("diag").value=s1[3];
   
    }
  }
  
 
  var str=document.getElementById('opdtemp').value;
 
xmlhttp.open("GET","get_exm1.php?exm1="+str,true);
xmlhttp.send();
}
function pres(){
//alert ("isuhgf");
	var comp=document.getElementById('comp').value;
	comp = comp.replace(/\n/g, '<br>');
	var findin=document.getElementById('findin').value;
	findin=findin.replace(/\n/g, '<br>');
	var adv=document.getElementById('adv').value;
	adv=adv.replace(/\n/g, '<br>');
	var diag=document.getElementById('diag').value;
	diag=diag.replace(/\n/g, '<br>');
	var date1=document.getElementById('date1').value;
	var invest=document.getElementById('invest').value;
	invest=invest.replace(/\n/g, '<br>');
	var med=document.getElementsByClassName('med'); 
	var tak=document.getElementsByClassName('tak'); 
	var dos=document.getElementsByClassName('dos'); 
	var med1=""; 
	var tak1=""; 
	var dos1="";
	
	for(i=0;i<med.length;i++) {
		
		med1=med1+med[i].value+", ";
		
	    tak1=tak1+tak[i].value+", ";
	
	    dos1=dos1+dos[i].value+", ";
	}
	
	popcontact('clinic1_print.php?id=<?php echo $pid; ?>&comp='+comp+'&findin='+findin+'&adv='+adv+'&diag='+diag+'&date1='+date1+'&invest='+invest+'&med1='+med1+'&tak1='+tak1+'&dos1='+dos1);
}
//////new hospital
function newhos()
{
	var hos=document.getElementById('hospital');
	var val=hos.options[hos.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='newhospital' id='newhospital' placeholder='New Hospital'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}
function getXMLHttp()

{

  var xmlHttp

// alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari

    xmlHttp = new XMLHttpRequest();

  }

  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

    catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

        return false;

      }

    }

  }

  return xmlHttp;

}

function MakeRequest(cnt)

{
//alert(cnt);
document.getElementById(cnt).value=Number(document.getElementById(cnt).value)+1;
var cnt=document.getElementById(cnt).value;
  var xmlHttp = getXMLHttp();

 ///alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
//alert(xmlHttp.responseText);
     HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");

 xmlHttp.open("GET", "getMore.php?cnt="+cnt, false);
//alert("getMore.php?cnt="+cnt);
  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
var ni =document.getElementById('detail');

var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

var newdiv = document.createElement('div');

var divIdName = num;

newdiv.setAttribute('id',divIdName);

newdiv.innerHTML =response;
ni.appendChild(newdiv);


//document.getElementById('barcode').value='';
document.getElementById('theValue').focus();
}

function getpotency(id,field)
{ //alert(id+" "+field);
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
    		///alert(s1[0]+"/"+s1[1]);
			alert(xmlhttp.responseText);
		document.getElementById(field).innerHTML=xmlhttp.responseText;
		
    }
  }
  
  var str=document.getElementById(id).value;
 // alert(str);
xmlhttp.open("GET","getpotency.php?medid="+str,true);
//alert("getpotency.php?medid="+str);
xmlhttp.send();
}

</script>


<!-- end of popup window -->

</head>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<body onLoad="createList();">


<div class="M_page">

         <form method="post" class="signin" action="update_opd.php" name="opdform" onSubmit="return opdvalidate(this)" enctype="multipart/form-data">
                <fieldset class="textbox">
               <legend> <h1><img src="ddmenu/opd.png" height="50" width="50">OPD</h1></legend>
                
                 <input type="hidden" name="patient_id" value="<?php echo $row[1]; ?>"/>
                <input type="hidden" name="myvar" value="0" id="theValue" />
                
                 <input type="hidden" name="aid" value="<?php echo $aid; ?>"/>
                <input type="hidden" name="print1" value="opd"/>
                <table id="sub">
                
                <tr>
                <td><label> Upload Report : </label></td>
                <td colspan="3"><div id="img">
                <?php 
                $r=1;
                $pho=mysql_query("select * from patient_photo where opd_id='$id' and patient_id='$pid'");
				while($pho1=mysql_fetch_row($pho)){
				if($r==4){
				echo "<br/>"; } $r++;?>
   <img src="<?php echo $pho1[3]; ?>" width="62" height="62"/> <input type="hidden" name="old[]" value="<?php echo $pho1[3]; ?>" /><input type="file" name="image1[]" id="image1[]" style="background:none; border:none;">
                <?php }?></div>
                <br/>
                <a href="#" onClick="upp()">Add More</a><br/></td>
               
                
                <td>
                <?php $rs=mysql_query("select * from opd where patient_id='$id'");
				$s=mysql_num_rows($rs);
				if($s==0){
				?>
             <!--   <input style="background:none; border:none; width:20px; height:20px;" name="ode1[]" id="code1[]" type="checkbox" onClick="window.location.href='pre_inves.php?id=<?php echo $id ?>&aid=<?php echo $aid; ?>'" />Pre- Investigation-->
                <?php } ?>
                &nbsp;&nbsp;<font size="+1"><a href="Timeline/horizontal.php?id=<?php echo $id; ?>" target="_blank" >History</a></font></td>
                </tr>
                <tr>
                <td><label>Name:</label></td>
                <td><input id="name" name="name" type="text" value="<?php echo $row1[6]; ?>" readonly /> </td>

               <td><label>Select Hospital:</label></td>
                <td>
               
                <select name="hospital" id="hospital" style="width:250px;height:25px;" onChange="newhos()">
                
                <?php $resulth = mysql_query("select name,hospital_id from hospital");
				    while($rowh=mysql_fetch_row($resulth)){ ?>
                 
			    <option value="<?php echo $rowh[0]; ?>" <?php if($rowh[0]==$row[8]){ echo "selected"; } ?>><?php echo $rowh[0]; ?></option>
				<?php } ?>
                <option value="Other">OTHER</option>
                </select>
                </td>
                </tr>
                
                
                <tr>
                <td><label>Date:</label> </td>
                <td><input id="date1" name="date1" type="text"  value="<?php if(isset($row[76]) and $row[76]!='0000-00-00') echo date('d/m/Y',strtotime($row[76])); ?>" onClick="displayDatePicker('date1');"></td>
				
				<td  colspan="3">
				&nbsp;&nbsp;&nbsp;&nbsp;<button class="submit formbutton" type="button"  name="print11" id="print11" style="width:140px;" onClick="javascript:pres();"><b>Print Prescription</b></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="submit formbutton" type="button"  name="copy" id="copy" style="width:150px;" onClick=";">Copy Data from Patient</button>
				</td><td><button class="submit formbutton" type="button"  name="newfollow" id="newfollow" style="width:140px;" onClick="">New/Follow Up</button>
				</td>
                </tr>
                </table>
                
                <table>
                <tr>
                <td width="250">
                <?php $result11=mysql_query("select name from templa");?>
                <label>Select Examination Template:</label>


                <select name="examtemp" id="examtemp" style="width:250px;" onChange="temp();">
                
                <?php while ($row11=mysql_fetch_row($result11))
				{ ?>
            	<option value="<?php echo $row11[0]; ?>" <?php if($row11[0]==$row[87]){ echo "selected"; } ?>><?php echo $row11[0]; ?></option>
           		<?php } ?>
                </select>
                </td>
                
                <td>
                <?php $result12=mysql_query("select heading from templa1 where heading<>''");?>
				<label>Select OPD Template:</label>
                <select name="opdtemp" id="opdtemp" style="width:250px;" onChange="temp1();">
                
                <?php while ($row12=mysql_fetch_row ($result12))
				{ ?>
            	<option value="<?php echo $row12[0]; ?>" <?php if($row12[0]==$row[88]){ echo "selected"; } ?>><?php echo $row12[0]; ?></option>
            	<?php } ?>
                </select>
                </td>
                </tr>
                </table>

<?php
include ('config.php');
$result4=mysql_query("select name,id from compla");
?>
<table>
  <tr>
    <td width="324"> <label>Complaints: </label>
          <select name="compl"  onChange="addThem2()">
            
            <?php while ($row4=mysql_fetch_row ($result4))
				{ ?>
           <option value="<?php echo $row4[0]; ?>" <?php if($row4[0]==$row[29]){ echo "selected"; } ?>><?php echo $row4[0]; ?></option>
            <?php } ?>
          </select>
          
          <textarea name="comp" id="comp" cols="29" rows="5" style="resize:none;"><?php echo $row[29]; ?></textarea>
          </td>
    <?php

$result5=mysql_query("select name,clinic_id from clinic");
?>
    <td width="327"><label> Clinical Details: </label>
          <select name="findi"  onChange="addThem3()">
            
            <?php while ($row5=mysql_fetch_row ($result5))
				{ ?>
            <option value="<?php echo $row5[0]; ?>" <?php if($row5[0]==$row[73]){ echo "selected"; } ?>><?php echo $row5[0]; ?></option>
            <?php } ?>
          </select>
          
          <textarea name="findin" id="findin" cols="29" rows="5" style="resize:none;"><?php echo $row[73]; ?></textarea>
          </td>
    <?php 
$sql41="select name,hospital_id from hospital ";
$result41 = mysql_query($sql41);
?>
    <td width="214"><select name="hos" onChange="addThemsoi();" >
      <option value="0">Select Hospital</option>
      <?php while($row41=mysql_fetch_row($result41)) { ?>
      <option value="<?php echo $row41[0]; ?>" <?php if($ho==$row41[0]){ echo "selected"; }?>><?php echo $row41[0]; ?></option>
      <?php } ?>
    </select>
        <br /><br />
<?php 
$sql14="select * from surmast where name<>'' order by name ASC";
$result14 = mysql_query($sql14);
?>
        <select name="surgery"  onChange="addsurgery()">
          <option value="0">Select Surgery</option>
          <?php while($row14=mysql_fetch_row($result14)) { ?>
          <option value="<?php echo $row14[0]; ?>"  <?php if($sur==$row14[0]){ echo "selected"; }?>><?php echo $row14[0]; ?></option>
          <?php } ?>
        </select>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;<button class="submit formbutton" type="button"  name="cdate" id="cdate" style="width:100px;" onClick="adddt();">Insert Date</button></td>

      </tr>
  <?php

$result6=mysql_query("select * from advise");
?>
  <tr>
    <td><label> Advised:</label>
          <select name="rec"  onChange="addThem1()">
            
            <?php while ($row6=mysql_fetch_row ($result6))
				{ ?>
             <option value="<?php echo $row6[1]; ?>" <?php if($row6[1]==$row[36]){ echo "selected"; } ?>><?php echo $row6[1]; ?></option>
            <?php } ?>
          </select>
      
          <textarea name="adv" id="adv" cols="29" rows="5" ><?php echo $row[36]; ?></textarea>
          </td>
    <?php 

$result33 = mysql_query("select name,diag_id from diag");
?>
    <td> <label> Diagnosis: </label>
          <select name="diagn"  onChange="addThem()">
            
            <?php while($row33=mysql_fetch_row($result33))
                {  ?>
            <option value="<?php echo $row33[0]; ?>" <?php if($row33[0]==$row[30]){ echo "selected"; } ?>><?php echo $row33[0]; ?></option>
            <?php } ?>
          </select>
      
        <textarea name="diag" id="diag" cols="29" rows="5" ><?php echo $row[30]; ?></textarea>
          </td>
	  
	  <td>Summary of Interventions: 
          <textarea name="soi" cols="33" rows="7" ><?php echo $row[34]; ?></textarea>
          
      <?php $result13=mysql_query("select name,keyword_id from keyword where name<>''"); ?>
	  <label>Keyword:</label> <select name="key1" >
	  
      <?php while($row13=mysql_fetch_row($result13))
                {  ?>
            <option value="<?php echo $row13[0]; ?>" <?php if($row13[0]==$row[58]){ echo "selected"; } ?>><?php echo $row13[0]; ?></option>
            <?php } ?>
	  </select>
	  </td>
	  
	 
	  
  </tr>
  <tr>
    <td> <label>Impression: </label>
          <textarea name="impr" cols="30" rows="4" style="resize:none;"><?php echo $row[81]; ?></textarea>
          </td>
    <td> <label> Investigations Advised: </label>
      <textarea name="invest" id="invest" cols="30" rows="4" ><?php echo $row[64]; ?></textarea>
        </td>
    <td>  <label>Physiotherapy Goals: </label>
          <textarea name="physio" cols="30" rows="4" ><?php echo $row[72]; ?></textarea>
          </td>
	  
	 
  </tr>
  
  <?php 
$result23 = mysql_query("select name,action_id from action");
?>
  <td> <label> Action Plan: </label>
            <select name="act"  onChange="swap(this.value, 'actxt')">
             
              <?php while($row23=mysql_fetch_row($result23))
                {  ?>
              <option value="<?php echo $row23[0]; ?>" <?php if($row23[0]==$row[35]){ echo "selected"; } ?>><?php echo $row23[0]; ?></option>
              <?php } ?>
            </select>
    <br />
    <input type="text" id="actxt" name="actxt"  value="<?php echo $row[35]; ?>"/><br />
   
 <label> Cost:</label> 
            <input type="text" name="cost" id="cost" style="width:200px;" value="<?php echo $row[82]; ?>"/>
         
   </td>
      <td valign="top"><label> Comments: </label>
            <textarea rows="4" cols="30" name="comm"><?php echo $row[62]; ?></textarea>
                 </td>
		
		<td valign="top">
		<label>Instructions:</label>
		<textarea name="instruc" cols="30" rows="4" ><?php echo $row[40]; ?></textarea>
        
		</td>
		
		<td>
		<br /><br /><br /><br />
		</td>
  </tr>
</table>
           

               <div id="detail"> <?php
              $med=explode(",",$row[78]);
$pot=explode(",",$row[92]);
$days=explode(",",$row[23]);
$how=explode(",",$row[79]);
$dos=explode(",",$row[80]);
$cmnt=explode(",",$row[93]);
$i=0;
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
?>
<table border="0" width="75%">
  <tr>
<td width="19%" align="center"><b>Medicine</b></td>
<td width="19%" align="center"><b>Potency</b></td>
<td width="16%" align="center"><b>Duration/week</b></td>
<td width="13%" align="center"><b>Repetition</b></td>
<td width="33%" align="center"><b>Comment</b></td>
</tr><?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tr><td align="center"><?php //echo $med[$i]; ?>
<select style="width:140px;" name="med[]" id="med<?php echo $i ?>" class="med" onChange="getpotency('med<?php echo $i ?>','pot<?php echo $i; ?>')" >
                <option value="0">Select</option>
                <?php $result3 = mysql_query("select name from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>" <?php if($med[$i]==$row[0]){ ?> selected<?php } ?>><?php echo $row[0]; ?></option>
				<?php } ?>
                </select>
</td><td align="center"><?php //echo $pot[$i];
 ?>
 <select name="pot[]" id="pot<?php echo $i; ?>">
                <option value="<?php echo $pot[$i];  ?>"><?php echo $pot[$i];  ?></option>
                </select></td><td align="center"><?php //echo $days[$i]; ?> <input type="text" name="days[]" id="days<?php echo $i; ?>" style="width:50px;" value="<?php echo $days[$i]; ?>"/>weeks</td>
<td align="center"><?php //echo $dos[$i]; ?><input type="text" name="dos[]" id="dos[]" style="width:50px;" value="<?php echo $dos[$i]; ?>"/></td>
<td align="center"><input type="text" name="cmnt[]" id="cmnt[]" style="width:140px;" value="<?php echo $cmnt[$i]; ?>"/></td>
</tr>
<?php
}

}
}
 ?>
 <tr><td colspan="5" align="right"><input type="hidden" name="forcnt" id="forcnt" value="<?php echo $i;  ?>"> <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest('forcnt');">Add More Medicine</a></td></tr>
 </table></div>
                      
                        
				<!--<table width="687">
				<tr>
				
				<td width="322">
				<label>Next Visit (Date):</label> <input type="text" name="nxtdate"  id="nxtdate" onClick="displayDatePicker('nxtdate');" value="<?php if(isset($row[38]) and $row[38]!='0000-00-00') echo date('d/m/Y',strtotime($row[38])); ?>"/>
				</td>
								
				<td width="299">
				<label>Next Visit (Text):</label> <input type="text" name="nxttext"  id="nxttext" value="<?php echo $row[83]; ?>"/>
				</td>
				</tr></table>-->
                
               <table> <tr>
                <td>
                <button class="submit formbutton" type="button"  name="csl" id="csl" style="width:150px;" onClick="javascript:popcontact('clinical_letter.php?id=<?php echo $id; ?>');">Clinical Status Letter</button>
	 </td><td><button class="submit formbutton" type="button"  name="adml" id="adml" style="width:150px;" onClick="javascript:popcontact('admission_letter.php?id=<?php echo $id; ?>');">Admission Letter</button>
	  
	  	  </td><td><button class="submit formbutton" type="button"  name="thankl" id="thankl" style="width:150px;" onClick="javascript:popcontact('thanking_letter.php?id=<?php echo $id; ?>');">Thanking Letter</button></td>
	 <td><button class="submit formbutton" type="button"  name="refl" id="refl" style="width:150px;" onClick="javascript:popcontact('referring_letter.php?id=<?php echo $id; ?>');">Referring Letter</button></td>
           <td> <button class="submit formbutton" type="button"  name="physiol" id="physiol" style="width:150px;" onClick="javascript:popcontact('physiotherapy_letter.php?id=<?php echo $id; ?>');">Physiotherapy Letter</button>    </td>
                </tr>
                
                <tr>
                <td>
                
	  <button class="submit formbutton" type="button"  name="investl" id="investl" style="width:150px;" onClick="javascript:popcontact('investigation_letter.php?id=<?php echo $id; ?>');">Investigation Letter</button></td>
	  
	 <td><button class="submit formbutton" type="button"  name="medcerti" id="medcerti" style="width:150px;" onClick="javascript:popcontact('medical_certificate.php?id=<?php echo $id; ?>');">Medical Certificate</button></td>
	 <td><button class="submit formbutton" type="button"  name="print2" id="print2" style="width:150px;" onClick="javascript:pres();"><b>Print Prescription</b></button></td>
       <td><button class="submit formbutton" type="button"  name="personal" id="personal" style="width:150px;" onClick=""><b>Edit Personal Info</b></button>        </td></tr>
				
				<input type="hidden" name="id" value="<?php echo $id; ?>" />                                                            
               <tr><td>  <button class="submit formbutton" type="submit" name="Submit">Submit</button>
				</td>
              <td>   <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_opd.php';">Cancel</button>
                  </td>
<td> <button class="submit formbutton" type="button" style="width:150px;" onClick="javascript:popcontact('opt_surgery.php?id=<?php echo $id; ?>');">Surgery Waiting List</button>
</td>
<td> <button class="submit formbutton" type="button" style="width:150px;" onClick="javascript:popcontact('app_surgery.php?id=<?php echo $id; ?>');">Surgery Appointment</button>  </td></tr></table>  
                </fieldset>
    </form>
</div>



<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript">
$(function()
{

$("#add").click(function(event) {
event.preventDefault();
$("#med").slideToggle();
});

$("#med a").click(function(event) {
event.preventDefault();
$("#med").slideUp();
});
});
</script>
