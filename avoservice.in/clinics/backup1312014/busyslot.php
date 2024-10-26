<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');

include('template_clinic.html');
 
include('config.php');
include('getcenter.php');

 $id=$_GET['id'];
// $dt=$_GET['dt'];
//echo "select * from  patient where srno='$id'";
$sql="select * from  patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>

<script type="text/javascript">
	function lookup2(inputString2,id2,suggest2,suggestlist2,ref2) {
	
	//alert(inputString2+" "+id2+" "+suggest2+" "+suggestlist2+" "+ref2);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest2).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/cityrpc.php", {
			
			queryString2: ""+inputString2+"",
			id2: ""+id2+"",
			suggest2: ""+suggest2+"",
			suggestlist2: ""+suggestlist2+"",
			ref2: ""+ref2+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest2).show();
					$('#'+suggestlist2).html(data);
				}
			});
		}
	} // lookup
	
	function fill2(obj2,suggest2,id2,ref2) {
	//alert(obj+" "+suggest+" "+id);
	document.getElementById(suggest2).style.display='none';
	
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	

	//alert(doc[0]);
		$('#'+id2).val(obj2);
		
		setTimeout("$('#'"+suggest2+").hide();", 200);
		//MakeRequest();
	}
	</script>
    
<script type="text/javascript">
window.onload=MakeRequest;
<!-- validation-->

function appvalidate(appform){
 with(appform)
 {
if(appdate.value=="")
{
	alert("Please select Date");
	appdate.focus();
	return false;
}
if(appdate.value<curdt.value)
{
alert("Appointment Date is invalid");
appdate.focus();
	return false;
}
if(hos.value=="0")
{
	alert("Please select Appointment Type.");
	hos.focus();
	return false;
}
}
 return true;
 }
 
 function confirm_appdelete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		
		document.location="delete_app.php?id="+id;
	}
}


<!--add new hospital-->
function hoswindow()
{

  mywindow = window.open("new_hosp.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 

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

//////get start date
/*function MakeRequest()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse1(xmlHttp.responseText);

    }

  }

//alert("hi2");

//var str = escape(document.getElementById('hos').value);
var str1 = escape(document.getElementById('appdate').value);
var center=escape(document.getElementById('center').value);
//var str1 = escape(document.getElementById('type').value);

//alert(str1);
 xmlHttp.open("GET", "get_time.php?appdate="+str1+"&center="+center, true);
//alert("get_time.php?appdate="+str1);
  xmlHttp.send(null);

}*/
function HandleResponse1(response)

{
//alert(response);
document.getElementById('detail').innerHTML=response;

}

function ex(){
//alert("hh");	
var a=document.getElementsByName('ch[]');
var id=document.getElementById('patient_id').value;
	var x=0;
	var ax=new Array();
	for(counter=0;counter<a.length;counter++)
	{
		if(a[counter].checked)
		{
			ax[x]=a[counter].value;
			x=x+1;
			
		}	
		
	}
	//alert(x);
		if(x>2 || x<2)
		{
			alert("Select Only 2 Hospital");
			a[counter].checked=false;
			return;
	    }
		//alert(x);
		window.open("exchange.php?ch[0]="+ax[0]+"&ch[1]="+ax[1]+"&id="+id,'_self');

}



//////get start date
function MakeRequest1()

{
//alert("hi");
var str = escape(document.getElementById('apptype').value);
var str1 = escape(document.getElementById('appdate').value);
var str2 = escape(document.getElementById('center').value);
if(str!='' && str1!='' && str2!='')
{
  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

//alert("hi2");


 xmlHttp.open("GET", "get_busytimeslot.php?hos="+str+"&appdate="+str1+"&center="+str2, true);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlHttp.send(null);
  }

}
function HandleResponse(response)

{
//alert(response);
document.getElementById('detail1').innerHTML=response;

}

var x=0;
function colorchange(obj,src){
//alert(src);

  obj.style.backgroundColor='#F00';
  for(i=1;i<=12;i++){
  if(i!=src){
	  if(document.getElementById(i)!=null)
 document.getElementById(i).style.backgroundColor='#FFC';
  }
  }
  //x=src;
  document.getElementById('sl').value=src;


//alert(document.getElementById("1").innerHTML);

var e = document.getElementById("slot").innerHTML;

}

function check()
{
var a=document.getElementsByClassName('ch');//alert(a);
	var x=0;
	for(counter=0;counter<a.length;counter++)
	{
		if(a[counter].checked)
		{
			x=x+1;
		}
		if(x>2)
		{
			alert("Select Only 2 Hospital");
			a[counter].checked=false;
	    }
		
	}
}
function openedtwin(url,winid,style,ref,foc)
{
//alert(url+" "+winid+" "+style);
var par=document.getElementById(ref).value;
if(par=='')
{
alert("Please Select Some doctor to Edit");
document.getElementById(foc).focus();
}
else
{
//alert(url);
pass=url+"&dt="+par;
  mywindow = window.open(pass, winid, style);
 } 
 }
 
</script>

<!--Datepicker-->
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div class="M_page">

        <form method="post" class="signin" action="processbusyslot.php" onSubmit="return appvalidate(this)" name="appform" autocomplete='OFF' >
                <fieldset class="textbox">
                <legend><h1> <img src="ddmenu/apointment.jpg" height="50" width="50" />Busy Slot</h1></legend>
          
                 
                  <table id="sub">
                  <tr>
                    <td>
                <label class="newold">Place of Appointment :</label></td>
                <td>
				<input type="text" name="center" id="center" onKeyUp="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" style="background:#fff;border:1px solid #ac0404;width:150px;" value="<?php echo $center=getcenter($_SESSION['ip']); ?>" onBlur="MakeRequest1();"  />
              <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:500px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>
                </td>
                    <td width="137"><label> Date : </label></td>
                   <td width="445"> <input id="appdate" name="appdate" type="text" onBlur="MakeRequest1();" onClick="displayDatePicker('appdate');" style="width:100px;" value="<?php echo date('d/m/Y'); ?>"><!--<input type="button" name="appbutton" class="submit formbutton"   value="" id="se" value="Select Date" >-->
                   
                </td>
                  
                  </tr>
                 
                 
               
                <tr>
                <td>select Appointment Type:</td><td><select name="apptype" id="apptype" onChange="MakeRequest1();">
                <option value="">Select Appointment type</option>
                <?php
				$qry=mysql_query("Select * from apptype where status='0'");
				while($row=mysql_fetch_array($qry))
				{
				?>
                <option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>
                <?php
				}
				?>
                </select></td>
                
                <td>
                <label class="newold">Remarks :</label></td>
                <td colspan="3"><input type="text" id="rem" name="rem" /></td> 
                </tr>
                  
                 <tr>
                
                
                
                </tr>
                <tr>
                <td colspan="4"><div id="detail1"></div></td>
                </tr>
                <tr>
                <td height="74"><!----><button class="submit formbutton" type="submit" name="submit">Submit</button> 
               <a href="view_patient1.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_patient1.php';">Cancel</button></a></td>
                 
               <!--<td colspan="3"><button class="submit formbutton" type="submit" >Add to Tentative Appointment</button>
                <button class="submit formbutton" type="button" onClick="openedtwin('new_slot.php?type=slot','slot','width=600,height=450,left=200,top=100','appdate','appdate')">Create Slot</button></td>-->
                </tr>
                
                 <tr>
                   <td colspan="2">
				   <br/>
				       <div id="detail" style="width:250px;"></div></td>
                   
               
               
                </tr>
                </table>
                
                <!--<table width="1200" border="1" cellpadding="4" cellspacing="0" style="font-size:13px;">
                <tr> 
                <th width="86" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="name">Date</label></th>
                <th width="43" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="basic">Time</label></th>
                <th width="194" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="prs">Name of the Patient</label></th>
                <th width="42" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="abs">N_F </label></th>
                <th width="69" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="pay">Type</label></th>
                <th width="72" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="all">Tel.No. </label></th>
                <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ot">Mobile No. </label></th>
                <th width="164" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ded">Hospital</label></th>
                <th width="112" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Reference By</label></th>
                <th width="99" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Remarks</label></th>
				<th width="49" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="pay">Edit</label></th>
				<th width="58" style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="pay">Delete</label></th>
                </tr>
               <?php  
$result1 = mysql_query("select * from appoint ");
while($row5=mysql_fetch_row($result1)){

$result21 = mysql_query("SELECT * FROM  `patient` where no='$row5[11]'");
$row21=mysql_fetch_row($result21);
//echo $row5[11]."<br/>";
?> 
                
                <tr>
                <td><?php echo $row5[15]; ?></td>
                <td><?php echo $row5[5]; ?></td>
                <td><?php if($row5[2]=="") { echo $row21[6]; }else{ echo $row5[2]; }?></td>
                <td><?php if($row5[10]=="N"){ echo "New";}else if($row5[10]=="O"){ echo "Old"; }  ?></td>
                <td><?php echo $row5[9]; ?></td>
                <td><?php echo $row21[22]; ?></td>
                <td><?php echo $row21[23]; ?></td>
                <td><?php echo $row5[18]; ?></td>
                <?php
                $result2 = mysql_query("select * from doctor where doc_id='$row5[14]' ");
$row55=mysql_fetch_row($result2);?>
                <td><?php echo $row55[1]; ?></td>
                <td><?php echo $row5[8]; ?></td>
				<td> <a href='edit_app.php?id=<?php echo $row5[12]; ?>'> Edit </a></td>
    			<td>  <a href="javascript:confirm_appdelete(<?php echo $row5[12]; ?>);"> Delete </a></td>
                </tr>
                <?php } ?>
                </table> -->
            
                  </fieldset>
         </form>
    </div>   
