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

document.opdform.comp.value += add;
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
		document.getElementById("comp").value=s1[0]+"\n"+s1[1];
		//document.getElementById("findin").value=s1[1];
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
		document.getElementById("comp").value=s1[0]+"\n"+s1[1];
		//document.getElementById("findin").value=s1[1];
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
	//var findin=document.getElementById('findin').value;
	//findin=findin.replace(/\n/g, '<br>');
	//var adv=document.getElementById('adv').value;
	//adv=adv.replace(/\n/g, '<br>');
	//var diag=document.getElementById('diag').value;
	//diag=diag.replace(/\n/g, '<br>');
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
	
	//popcontact('clinic1_print.php?id=<?php echo $pid; ?>&comp='+comp+'&adv='+adv+'&diag='+diag+'&date1='+date1+'&invest='+invest+'&med1='+med1+'&tak1='+tak1+'&dos1='+dos1);
	popcontact('clinic1_print.php?id=<?php echo $pid; ?>&comp='+comp+'&date1='+date1+'&invest='+invest+'&med1='+med1+'&tak1='+tak1+'&dos1='+dos1);
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
			//alert(xmlhttp.responseText);
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
                
                <?php $sql4="select  type from apptype where type<>'' order by type ASC";
$result4 = mysql_query($sql4);
				     while($row4=mysql_fetch_row($result4)) { ?>
                <option value="<?php echo $row4[0]; ?>" <?php if($row4[0]==$row[8]){  echo "selected";  } ?>><?php echo $row4[0]; ?></option>
                <?php } ?>
                
                </select>
                </td>
                </tr>
                
                
                <tr>
                <td><label>Date:</label> </td>
                <td><input id="date1" name="date1" type="text"  value="<?php if(isset($row[76]) and $row[76]!='0000-00-00') echo date('d/m/Y',strtotime($row[76])); ?>" onClick="displayDatePicker('date1');"></td>
				
				<td  colspan="3">
				&nbsp;&nbsp;&nbsp;&nbsp;<button class="submit formbutton" type="button"  name="print11" id="print11" style="width:140px;" onClick="javascript:pres();"><b>Print Prescription</b></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="submit formbutton" type="button"  name="copy" id="copy" style="width:150px;" onClick=";">Copy Data from Patient</button>
				</td>
                </tr>
                </table>
                
                <table width="913">
                <tr>
                <td width="409">
                <?php $result11=mysql_query("select name from templa");?>
                <label>Select Examination Template:<br></label>


                <select name="examtemp" id="examtemp" style="width:250px;" onChange="temp();">
                
                <?php while ($row11=mysql_fetch_row($result11))
				{ ?>
            	<option value="<?php echo $row11[0]; ?>" <?php if($row11[0]==$row[87]){ echo "selected"; } ?>><?php echo $row11[0]; ?></option>
           		<?php } ?>
                </select>
                </td>
                
                <td width="492">
                <?php $result12=mysql_query("select heading from templa1 where heading<>''");?>
				<label>Select OPD Template:<br></label>
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
<table width="921">
  <tr>
    <td width="476" colspan="2"> <label>History: </label>
          <select name="compl"  onChange="addThem2()">
            
            <?php while ($row4=mysql_fetch_row ($result4))
				{ ?>
           <option value="<?php echo $row4[0]; ?>" <?php if($row4[0]==$row[29]){ echo "selected"; } ?>><?php echo $row4[0]; ?></option>
            <?php } ?>
          </select>
          
          <textarea name="comp" id="comp" cols="29" rows="10" style="resize:none; width:800px"><?php echo $row[29]; ?></textarea>
         
    <?php

$result5=mysql_query("select name,clinic_id from clinic");
?>
   <label> Clinical Details: </label>
          <select name="findi"  onChange="addThem3()">
            
            <?php while ($row5=mysql_fetch_row ($result5))
				{ ?>
            <option value="<?php echo $row5[0]; ?>" <?php if($row5[0]==$row[73]){ echo "selected"; } ?>><?php echo $row5[0]; ?></option>
            <?php } ?>
          </select>
          
         <!-- <textarea name="findin" id="findin" cols="29" rows="5" style="resize:none;"><?php echo $row[73]; ?></textarea>-->
        
    <?php 
$sql41="select name,hospital_id from hospital ";
$result41 = mysql_query($sql41);
?>
    
      </tr>
  <?php

$result6=mysql_query("select * from advise");
?>
  <!--<tr>
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

$result33 = mysql_query("select name,diag_id from keyword");
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
	  
	  
	  
	 
	  
  </tr>-->
  <tr>
    
    <td> <label> Investigations Advised: </label>
      <textarea name="invest" id="invest" cols="30" rows="4" ><?php echo $row[64]; ?></textarea>
        </td>
   <!-- <td width="433">  <label>Physiotherapy Goals: </label>
          <textarea name="physio" cols="30" rows="4" ><?php echo $row[72]; ?></textarea>
          </td>
	  
	 
  </tr>
 
 <tr> -->
  
      <td valign="top"><label>Instructions:</label>
		<textarea name="instruc" cols="30" rows="4" ><?php echo $row[40]; ?></textarea>
        
                 </td></tr><tr>
		
		<td valign="top" colspan="2">
        <label> Status: </label>
            <textarea rows="4" cols="30" name="comm"><?php echo $row[62]; ?></textarea>
		
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
$drugs=explode(",",$row[94]);
$dosage=explode(",",$row[95]);
$blis=explode(",",$row[96]);
$inst=explode(",",$row[97]);
$i=0;
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
?>
<table border="0" width="75%" class="results"><thead>
  <tr><th>Medicine Name </th><th>Drugs</th><th>Potency</th><th>Repetition </th><th>dosage</th>
<th>Duration/week</th><th>Blister</th><th>Instruction</th><th>Others</th></tr></thead><?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tbody><tr><td align="center"><?php //echo $med[$i]; ?>
<select style="width:140px;" name="med[]" id="med<?php echo $i ?>" class="med[]" onChange="getpotency('med<?php echo $i ?>','pot<?php echo $i; ?>')" >
                <option value="">Select</option>
                <?php $result3 = mysql_query("select name from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]; ?>" <?php if($med[$i]==$row[0]){ ?> selected<?php } ?>><?php echo $row[0]; ?></option>
				<?php } ?>
                </select><p></p>
</td>
<td><input type="text" name="drugs[]" id="drugs[]" value="<?php echo $drugs[$i]; ?>"></td>
<td align="center"><?php //echo $pot[$i];
 ?>
 <select name="pot[]" id="pot<?php echo $i; ?>">
                <option value="<?php echo $pot[$i];  ?>"><?php echo $pot[$i];  ?></option>
              <!--<option value="3X"></option>
<option value="6X">6X</option>
<option value="6C">6C</option>
<option value="30">30</option>
<option value="200">200</option>
<option value="1m">1m</option>
<option value="10m">10m</option>
<option value="50m">50m</option>
<option value="cm">cm</option>
<option value="Q">Q</option>
<option value="biocombination">biocombination</option>
<option value="syrups">syrups</option>
<option value="ointments">ointments</option>
<option value="pentarkans">pentarkans</option>
<option value="combinations">combinations</option>
<option value="others">others</option>
<option value="POWDER">POWDER</option>-->
                </select></td> <td>
				<select name="dos[]" id="dos">
                <option value="">Select</option>
                <option value="1DOSE">1DOSE</option>
<option value="2DOSE" <?php if($dos[$i]=='2DOSE'){ ?> selected<?php } ?>>2DOSE</option>
<option value="3DOSE" <?php if($dos[$i]=='3DOSE'){ ?> selected<?php } ?>>3DOSE</option>
<option value="4DOSE" <?php if($dos[$i]=='4DOSE'){ ?> selected<?php } ?>>4DOSE</option>
<option value="5DOSE" <?php if($dos[$i]=='5DOSE'){ ?> selected<?php } ?>>5DOSE</option>
<option value="1hrly" <?php if($dos[$i]=='1hrly'){ ?> selected<?php } ?>>1hrly</option>
<option value="2hrly" <?php if($dos[$i]=='2hrly'){ ?> selected<?php } ?>>2hrly</option>
<option value="4DROPS" <?php if($dos[$i]=='4DROPS'){ ?> selected<?php } ?>>4DROPS</option>
<option value="5DROPS" <?php if($dos[$i]=='5DROPS'){ ?> selected<?php } ?>>5DROPS</option>
<option value="6DROPS" <?php if($dos[$i]=='6DROPS'){ ?> selected<?php } ?>>6DROPS</option>
<option value="7DROPS" <?php if($dos[$i]=='7DOSE'){ ?> selected<?php } ?>>7DROPS</option>
<option value="8DROPS" <?php if($dos[$i]=='8DOSE'){ ?> selected<?php } ?>>8DROPS</option>
<option value="10DROPS" <?php if($dos[$i]=='10DOSE'){ ?> selected<?php } ?>>10DROPS</option>
<option value="12DROPS" <?php if($dos[$i]=='12DOSE'){ ?> selected<?php } ?>>12DROPS</option>
<option value="15DROPS" <?php if($dos[$i]=='15DOSE'){ ?> selected<?php } ?>>15DROPS</option>
</select>
                
				</td>
                 <td><select name="dosage[]" id="dosage[]">
           <option value="">Select</option>
        <option value="daily" <?php if($dos[$i]=='daily'){ ?> selected<?php } ?>>daily</option>
<option value="sos" <?php if($dosage[$i]=='sos'){ ?> selected<?php } ?>>sos</option>
<option value="stat" <?php if($dosage[$i]=='stat'){ ?> selected<?php } ?>>stat</option>
<option value="1/4weeks" <?php if($dosage[$i]=='1/4weeks'){ ?> selected<?php } ?>>1/4weeks</option>
<option value="2/4weeks" <?php if($dosage[$i]=='2/4weeks'){ ?> selected<?php } ?>>2/4weeks</option>
<option value="3/4weeks" <?php if($dosage[$i]=='3/4weeks'){ ?> selected<?php } ?>>3/4 weeks</option>
<option value="4/4weeks" <?php if($dosage[$i]=='4/4weeks'){ ?> selected<?php } ?>>4/4weeks</option>
<option value="LA" <?php if($dosage[$i]=='LA'){ ?> selected<?php } ?>>LA</option>
<option value="WEEKLY ONCE" <?php if($dosage[$i]=='WEEKLY ONCE'){ ?> selected<?php } ?>>WEEKLY ONCE</option> 
<option value="WEEKLY TWICE" <?php if($dosage[$i]=='WEEKLY TWICE'){ ?> selected<?php } ?>>WEEKLY TWICE</option> 

           </select></td>
<td>
				<select name="days[]" id="days[]" style="width:140px;" class="days[]">
                <option value="">Select</option>
                <option value="NA" <?php if($days[$i]=='NA'){ ?> selected<?php } ?>>NA</option>
<option value="5DAYS" <?php if($days[$i]=='5DAYS'){ ?> selected<?php } ?>>5DAYS</option>
<option value="1WEEK" <?php if($days[$i]=='1WEEK'){ ?> selected<?php } ?>>1WEEK</option>
<option value="10DAYS" <?php if($days[$i]=='10DAYS'){ ?> selected<?php } ?>>10DAYS</option>
<option value="2WEEKS" <?php if($days[$i]=='2WEEKS'){ ?> selected<?php } ?>>2WEEKS</option>
<option value="3WEEKS" <?php if($days[$i]=='3WEEKS'){ ?> selected<?php } ?>>3WEEKS</option> 
<option value="4WEEKS" <?php if($days[$i]=='4WEEKS'){ ?> selected<?php } ?>>4WEEKS</option>
<option value="5WEEKS" <?php if($days[$i]=='5WEEKS'){ ?> selected<?php } ?>>5WEEKS</option> 
<option value="pls make it" <?php if($days[$i]=='pls make it'){ ?> selected<?php } ?>>pls make it</option> 
<option value="till" <?php if($days[$i]=='till'){ ?> selected<?php } ?>>till</option>
<option value="52weeks" <?php if($days[$i]=='52weeks'){ ?> selected<?php } ?>>52weeks</option> 

			</select>	</td>
             <td>
            <select name="blis[]"><option value="">Select</option>
           <option value="white" <?php if($blis[$i]=='white'){ ?> selected<?php } ?>>white</option>
<option value="green" <?php if($blis[$i]=='green'){ ?> selected<?php } ?>>green</option>
<option value="yellow" <?php if($blis[$i]=='yellow'){ ?> selected<?php } ?>>yellow</option>
<option value="red" <?php if($blis[$i]=='red'){ ?> selected<?php } ?>>red</option>
<option value="brown" <?php if($blis[$i]=='brown'){ ?> selected<?php } ?>>brown</option>

            </select>
            </td>
             <td>
            <select name="inst[]">
            <option value="">Select</option>
            <option value="diabetic dose" <?php if($inst[$i]=='diabetic dose'){ ?> selected<?php } ?>>diabetic dose</option>
<option value="fill it full" <?php if($inst[$i]=='fill it full'){ ?> selected<?php } ?>>fill it full</option>
<option value="3pills" <?php if($inst[$i]=='3pills'){ ?> selected<?php } ?>>3pills</option>
<option value="2 biochemic tablets" <?php if($inst[$i]=='2 biochemic tablets'){ ?> selected<?php } ?>>2 biochemic tablets</option>
<option value="zig zag" <?php if($inst[$i]=='zig zag'){ ?> selected<?php } ?>>zig zag</option>
<option value="no zig zag" <?php if($inst[$i]=='no zig zag'){ ?> selected<?php } ?>>no zig zag</option>
<option value="morning" <?php if($inst[$i]=='morning'){ ?> selected<?php } ?>>morning</option>
<option value="afternoon" <?php if($inst[$i]=='afternoon'){ ?> selected<?php } ?>>afternoon</option>
<option value="night" <?php if($inst[$i]=='night'){ ?> selected<?php } ?>>night</option>
<option value="sos headache" <?php if($inst[$i]=='sos headache'){ ?> selected<?php } ?>>sos headache</option>
<option value="sos cold" <?php if($inst[$i]=='sos cold'){ ?> selected<?php } ?>>sos cold</option>
<option value="sos cough" <?php if($inst[$i]=='sos cough'){ ?> selected<?php } ?>>sos cough</option>
<option value="sos stomach pain" <?php if($inst[$i]=='sos stomach pain'){ ?> selected<?php } ?>>sos stomach pain</option>
<option value="sos loose motiosn" <?php if($inst[$i]=='sos loose motiosn'){ ?> selected<?php } ?>>sos loose motiosn</option>
<option value="sos vomitting" <?php if($inst[$i]=='sos vomitting'){ ?> selected<?php } ?>>sos vomitting</option>
<option value="sos breathlessness" <?php if($inst[$i]=='sos breathlessness'){ ?> selected<?php } ?>>sos breathlessness</option>
<option value="sos hernia" <?php if($inst[$i]=='sos hernia'){ ?> selected<?php } ?>>sos hernia</option>
<option value="sos pain" <?php if($inst[$i]=='sos pain'){ ?> selected<?php } ?>>sos pain</option>
<option value="sos sleep" <?php if($inst[$i]=='sos sleep'){ ?> selected<?php } ?>>sos sleep</option>
<option value="sos gases" <?php if($inst[$i]=='sos gases'){ ?> selected<?php } ?>>sos gases</option>
<option value="sos throat" <?php if($inst[$i]=='sos throat'){ ?> selected<?php } ?>>sos throat</option>
<option value="sos fever" <?php if($inst[$i]=='sos fever'){ ?> selected<?php } ?>>sos fever</option>
<option value="sos vertigo" <?php if($inst[$i]=='sos vertigo'){ ?> selected<?php } ?>>sos vertigo</option>
<option value="sos menses" <?php if($inst[$i]=='sos menses'){ ?> selected<?php } ?>>sos menses</option>
<option value="sos bleeding" <?php if($inst[$i]=='sos bleeding'){ ?> selected<?php } ?>>sos bleeding</option>
<option value="sos piles/fissure" <?php if($inst[$i]=='sos piles/fissure'){ ?> selected<?php } ?>>sos piles/fissure</option>
<option value="sos" <?php if($inst[$i]=='sos'){ ?> selected<?php } ?>>sos</option>
<option value="1BTL" <?php if($inst[$i]=='1BTL'){ ?> selected<?php } ?>>1BTL</option>
<option value="2BTLS" <?php if($inst[$i]=='2BTLS'){ ?> selected<?php } ?>>2BTLS</option>
<option value="3BTLS" <?php if($inst[$i]=='3BTLS'){ ?> selected<?php } ?>>3BTLS</option>
<option value="4BTLS" <?php if($inst[$i]=='4BTLS'){ ?> selected<?php } ?>>4BTLS</option>
<option value="5BTLS" <?php if($inst[$i]=='5BTLS'){ ?> selected<?php } ?>>5BTLS</option>
<option value="6BTLS" <?php if($inst[$i]=='6BTLS'){ ?> selected<?php } ?>>6BTLS</option>
<option value="7BTLS" <?php if($inst[$i]=='7BTLS'){ ?> selected<?php } ?>>7BTLS</option>
<option value="8BTLS" <?php if($inst[$i]=='8BTLS'){ ?> selected<?php } ?>>8BTLS</option>
<option value="9BTLS" <?php if($inst[$i]=='9BTLS'){ ?> selected<?php } ?>>9BTLS</option>
<option value="10BTLS" <?php if($inst[$i]=='10BTLS'){ ?> selected<?php } ?>>10BTLS</option>
<option value="11BTLS" <?php if($inst[$i]=='11BTLS'){ ?> selected<?php } ?>>11BTLS</option>
<option value="12BTLS" <?php if($inst[$i]=='12BTLS'){ ?> selected<?php } ?>>12BTLS</option>

            </select>
            </td>
<td align="center"><input type="text" name="cmnt[]" id="cmnt[]" class="cmnt[]" style="width:140px;" value="<?php echo $cmnt[$i]; ?>"/></td>
</tr></tbody>
<?php
}

}
}
 ?>
 <tr><td colspan="5" align="right"><input type="hidden" name="forcnt" id="forcnt" value="<?php echo $i;  ?>"> <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest('forcnt');">Add More Medicine</a></td></tr>
 </table></div>
                       <br/>
              
                        
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
<td>
</td>
<td>  </td></tr></table>  
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
