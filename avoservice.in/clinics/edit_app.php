<?php

include('config.php');
include('template.html');

$id=$_GET['id'];

$sql="select * from `appoint` where app_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[11];
//echo "select * from patient where srno='$pid'";
$sql1="select * from patient where srno='$pid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$did=$row1[9];
//echo "select * from doctor where doc_id='$did'";
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);

//$time=$row[5];
//list($hr, $min) = explode(":", $time);
?>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="paging.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
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
if(mob.value=="")
{
	alert("Please enter Mobile No.");
	mob.focus();
	return false;
}
 
}
 return true;
 }
 
 <!--add new hospital-->
function hoswindow()
{

  mywindow = window.open("new_hosp.php", "mywindow", "location=1,status=1,scrollbars=1, width=500,height=300");
    //mywindow.moveTo(300, 250);
 }
 
 
 ///////////////////////////////////////////
 
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
function MakeRequest()

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
//var str1 = escape(document.getElementById('type').value);

//alert(str1);
 xmlHttp.open("GET", "get_time1.php?appdate="+str1+"&hospital=<?php echo $row[18]; ?>", true);
////alert("get_time1.php?appdate="+str1+"&hos=<?php //echo $row[18]; ?>");
  xmlHttp.send(null);

}
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

  var xmlHttp = getXMLHttp();

//alert("hello");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
//alert(xmlHttp.responseText);
      HandleResponse(xmlHttp.responseText);

    }

  }

///alert("hi2");

var str = escape(document.getElementById('hos1').value);
var str1 = escape(document.getElementById('appdate').value);
////alert("get_timeslot1.php?hos="+str+"&appdate="+str1);
 xmlHttp.open("GET", "get_timeslot1.php?hos="+str+"&appdate="+str1+"&ad=<?php echo $id; ?>", true);
//alert("get_timeslot1.php?hos="+str+"&appdate="+str1+"&ad=<?php echo $id; ?>");
  xmlHttp.send(null);

}
function HandleResponse(response)

{
////alert(response);
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
</script><!--end validation-->
</head>
<body onLoad="MakeRequest();MakeRequest1();">

       
         <form method="post" class="signin" action="update_app.php" onSubmit="return appvalidate(this)" name="appform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Appointment</p>
                <table>
				<tr><td>              
                
            	<label class="name">
                <span> Name: </span>				</label>
				</td><td>
                <input id="name" name="name" type="text" value="<?php echo $row1[6]; ?>" style="background-color:#DCDCDC;" readonly="readonly">
                </label>
                 </td></tr>
				 <tr><td>
				 
                  
                <label class="doc">
                <span>Ref By :</span>				</label>
				</td><td>
                <input type="text" name="doc" id="doc" value="<?php if (is_numeric($row1[9])) echo $row2[1]; else echo $row1[9]; ?>" style="background-color:#DCDCDC;" readonly="readonly">
                </label>
                </td></tr>
				<tr><td>
                <label class="age">
                <span>Type:</span>				</label>
				</td><td>
                <select name="type" id="type" style="width:235px;height:26px;border:1px solid #ac0404;">
				
                   
                    <option value="Computer"<?php if($row[9]=='Computer'){ echo "selected"; } ?>>Computer</option>
                    <option value="Telephone"<?php if($row[9]=='Telephone'){ echo "selected"; } ?>>Telephone</option>
					</select>
                </td></tr>  
				<tr><td>   
                <label class="Date">
                <span>Appointment Date:</span>				</label></td><td>
                <input id="appdate" name="appdate" type="text" value="<?php if(isset($row[15]) and $row[15]!='0000-00-00') echo date('d/m/Y',strtotime($row[15])); ?>" onBlur="MakeRequest();">
                <button name="appbutton" type="button" style="width:80px;" onClick="displayDatePicker('appdate');" class="submit formbutton">select</button>
                </td></tr>
               <!-- 
                <label class="time">
                <span><b> Time: </b></span><span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00" <?php //if($hr==00){ echo "selected";} ?>>00</option>
                      <option value="01" <?php //if($hr==01){ echo "selected";} ?>>01</option>
                      <option value="02" <?php //if($hr==02){ echo "selected";} ?>>02</option>
                      <option value="03" <?php //if($hr==03){ echo "selected";} ?>>03</option>
                      <option value="04" <?php //if($hr==04){ echo "selected";} ?>>04</option>
                      <option value="05" <?php //if($hr==05){ echo "selected";} ?>>05</option>
                      <option value="06" <?php //if($hr==06){ echo "selected";} ?>>06</option>
                      <option value="07" <?php //if($hr==07){ echo "selected";} ?>>07</option>
                      <option value="08" <?php //if($hr==08){ echo "selected";} ?>>08</option>
                      <option value="09" <?php //if($hr==09){ echo "selected";} ?>>09</option>
                      <option value="10" <?php //if($hr==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php //if($hr==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php //if($hr==12){ echo "selected";} ?>>12</option>
                      <option value="13" <?php //if($hr==13){ echo "selected";} ?>>13</option>
                      <option value="14" <?php //if($hr==14){ echo "selected";} ?>>14</option>
                      <option value="15" <?php //if($hr==15){ echo "selected";} ?>>15</option>
                      <option value="16" <?php //if($hr==16){ echo "selected";} ?>>16</option>
                      <option value="17" <?php //if($hr==17){ echo "selected";} ?>>17</option>
                      <option value="18" <?php //if($hr==18){ echo "selected";} ?>>18</option>
                      <option value="19" <?php //if($hr==19){ echo "selected";} ?>>19</option>
                      <option value="20" <?php //if($hr==20){ echo "selected";} ?>>20</option>
                      <option value="21" <?php //if($hr==21){ echo "selected";} ?>>21</option>
                      <option value="22" <?php //if($hr==22){ echo "selected";} ?>>22</option>
                      <option value="23" <?php //if($hr==23){ echo "selected";} ?>>23</option>
                </select>
                
                
                <select name="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00" <?php //if($min==00){ echo "selected";} ?>>00</option>
                <option value="05" <?php //if($min==05){ echo "selected";} ?>>05</option>
                <option value="10" <?php //if($min==10){ echo "selected";} ?>>10</option>
                <option value="15" <?php //if($min==15){ echo "selected";} ?>>15</option>
                <option value="20" <?php //if($min==20){ echo "selected";} ?>>20</option>
                <option value="25" <?php //if($min==25){ echo "selected";} ?>>25</option>
                <option value="30" <?php //if($min==30){ echo "selected";} ?>>30</option>
                <option value="35" <?php //if($min==35){ echo "selected";} ?>>35</option>
                <option value="40" <?php //if($min==40){ echo "selected";} ?>>40</option>
                <option value="45" <?php //if($min==45){ echo "selected";} ?>>45</option>
                <option value="50" <?php //if($min==50){ echo "selected";} ?>>50</option>
                <option value="55" <?php //if($min==55){ echo "selected";} ?>>55</option>
                </select>
                </label>-->
                <tr><td>
                <label class="type">
                <span>New/Old:</span>				</label></td><td>
                <select name="new" id="new" style="width:235px;height:26px;border:1px solid #ac0404;">
		
                    <option value="N" <?php if($row[10]=="N"){ echo "selected"; }?>>New</option>
                    <option value="O" <?php if($row[10]=="O"){ echo "selected"; }?>>Old</option>
					</select>
                </td></tr>
				<tr>
				<td>
				<label>
				<span>Remarks:</span>				</label></td><td>
				<input type="text" name="rem" id="rem" style="width:300px;" value="<?php echo $row[8]; ?>"/>
				</td></tr>
				
				<tr>
                   <td colspan="2"><div id="detail1"></div></td>
                   
               
               
                </tr></table>
                   <div id="detail" style="width:250px;"></div>
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
				    <input type="hidden" id="sl" name="sl"/> 
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_app.php';">Cancel</button>
                       
                </fieldset>
          </form>
         
         
        
</body>
<?php include('footer.html'); ?>