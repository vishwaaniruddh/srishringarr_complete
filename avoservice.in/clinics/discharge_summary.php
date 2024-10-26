<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include('template.html');
include('config.php');
$id=$_GET['id'];

$sql="select * from admission where ad_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$sql1="select * from patient where srno='$row[1]'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

?>
<style>
td{border:none;}
</style>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<script language="javascript" type="text/javascript">
////add more

var searchReq = getXMLHttp();

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


function MakeRequest()

{

  var xmlHttp = getXMLHttp();

 ///alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");

 xmlHttp.open("GET", "getMore.php", false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
alert(response);
var ni =document.getElementById('detail');

var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

var newdiv = document.createElement('div');

var divIdName = num;

newdiv.setAttribute('id',divIdName);

newdiv.innerHTML =response;
ni.appendChild(newdiv);


document.getElementById('barcode').value='';
}

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

<script>
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

////for print
function pres(){

	
	var inv=document.getElementById('inv').value;
	var fd=document.getElementById('fd').value;
	var op=document.getElementById('op').value;
	/*var datead=document.getElementById('datead').value;
	var datedis=document.getElementById('datedis').value;
	var hour=document.getElementById('hour').value;
	var minn=document.getElementById('minn').value;
	var hour1=document.getElementById('hour1').value;
	var min1=document.getElementById('min1').value;
	var room=document.getElementById('room').value;*/
	
	popcontact('discharge_print.php?id=<?php echo $id; ?>&inv='+inv+'&fd='+fd+'&op='+op);
	
}


</script>
<body onLoad="createList();">

          <form method="post" class="signin" action="new_discharge.php" enctype="multipart/form-data" >
          
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge Summary</p><br />
           
                <input type="hidden" name="ad_id" value="<?php echo $row[18]; ?>"  />
                <table id="ds">
                  <tr>
                    <td width="332" ><label class="patientid"> Patient ID : </label></td>
                    <td width="427" ><input id="pid" name="pid" type="text"  value="<?php echo $row[1]; ?>"readonly style="background-color:#DCDCDC;"></td>
                    <td width="154" colspan="2"><input id="name" name="name" type="text" value="<?php echo $row1[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                  </tr>
                  <tr>
                    <td ><label class="datead">Date of Admission:</label></td>
                    <td ><input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>" readonly="readonly"></td>
                    <td ><label class="datead">Date of Discharge:</label></td>
                    <td width="148" ><input id="datedis" name="datedis" type="text"  value="<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>" onClick="displayDatePicker('datedis');"></td>
                  </tr>
                  <tr>
                    <td><label class="pro_diag">Provisional Diagnosis:</label></td>
                    <td><textarea name="pd" id="pd" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                  <tr>
                    <td><label class="inv">His examination findings are as follows:</label></td>
                    <td><textarea name="ef" id="ef" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                  <tr>
                    <td><label class="fdiag">Final Diagnosis:</label></td>
                    <td><input id="fd" name="fd" type="text" ></td>
                  </tr>
                  <tr>
                    <td><label class="advice">Operation Notes:</label></td>
                    <td><textarea name="operation_notes" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                  <tr>
                    <td><label class="oper"><br>
                      Name of Operation:</label></td>
                    <td><textarea name="oper" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                  <tr>
                    <td><label class="proc">Treatment Advised on Discharge:</label></td>
                    <td><textarea name="treat" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                  <tr>
                    <td><label class="post">Finding on discharge:</label></td>
                    <td><textarea name="find_on" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                  </tr>
                 
                
                  <tr>
                    <tr>
                    <td><label class="add_proc">Discharge Prescription</label></td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr>
                    <td colspan="2">
					<div id="detail">            
					<table border="1">
                        <tr>
                          <th>Medicine Name </th>
                          <th>How to Take </th>
                          <th>Dosage </th>
                          <th>Days </th>
                        </tr>
                        <?php for($j=0;$j<=2;$j++){?>
                        <tr>
                          <td><select style="width:140px;" name="med[]" id="med" class="med">
                              <option value="0">Select</option>
                              <?php $result3 = mysql_query("select UPPER(name),med_id from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
                              <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                          <?php 

$result4 = mysql_query("select * from medicine");
?>
                          <td><select style="width:140px;" name="tak[]" id="tak[]" class="tak">
                              <option value="0">Select</option>
                              <?php 
				    while($row=mysql_fetch_row($result4)){ ?>
                              <option value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                          <td><select style="width:140px;" name="dos[]" id="dos[]" class="dos">
                              <option value="0">Select</option>
                              <option value="1..0..0">1..0..0</option>
                              <option value="1..0..1">1..0..1</option>
                              <option value="1..1..1">1..1..1</option>
                              <option value="0..0..1">0..0..1</option>
                              <option value="0..1..1">0..1..1</option>
                              <option value="1..1..1..1">1..1..1..1</option>
                              <option value="1/2..0..0">1/2..0..0</option>
                            </select>
                          </td>
                          <td><input type="text" name="days[]" id="days[]" style="width:140px;"/>
                          </td>
                        </tr>
                        <?php 
				}
			
			?>
                      </table>
					  </div>
					     <input type="hidden" name="myvar" value="0" id="theValue" />
					   <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest();">Add More </a><br/>
					  </td>
                  </tr>
				  <tr><td>Pre Operation                                                                                                      </td>
				  <td><input type="file" name="pre" /></td></tr>
				   <tr><td>                                                                                                      Intra Operation</td>
				  <td><input type="file" name="intra" /></td></tr>
                  <!--end discharge form-->
                  <tr>
                    <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>
                         <a href="home.php" >
                      <button class="submit formbutton" type="button" onClick="javascript:location.href = 'discharge.php';">Cancel</button>
                        </a>&nbsp;&nbsp;
                      <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button></td>
                  </tr>
                </table>
                </fieldset>
          </form>
          </body>
       

<?php
include('footer.html'); 
}else
{ 
 header("location: index.html");
}

?>