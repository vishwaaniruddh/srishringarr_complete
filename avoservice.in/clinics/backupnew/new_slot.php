<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');




include('config.php');
include('template_clinic.php');
if(isset($_GET['hos']))
$hos= $_GET['hos'];
//include('template.html');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Slot</title>
<script type="text/javascript">
function validate()
{
//alert("hi");
if(document.getElementById('center').value=='')
{
alert("Please Enter Place of Appointment");
document.getElementById('center').focus();
return false;
}
if(document.getElementById('apptype').value=='')
{
alert("Please select Appointment Type");
document.getElementById('apptype').focus();
return false;
}

return true;
}
</script>

<style>
td{border:none;}
</style>
<script type="text/javascript" src="autocomplete/jquery-1.2.1.pack.js"></script>
<style type="text/css">
	body {
		font-family: Helvetica;
		font-size: 11px;
		color: #000;
	}
	
	h3 {
		margin: 0px;
		padding: 0px;	
	}

	.suggestionsBox {
		position: relative;
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		z-index:10
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #659CD8;
	}
	
	select.my_dropdown {
    width:225px;
	height:30px;
	}
}
</style>
<script type="text/javascript">
	function lookup(inputString,id,suggest,suggestlist,ref) {
	//alert(inputString+" "+id+" "+suggest+" "+suggestlist+" "+ref);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/rpc.php", {
			
			queryString: ""+inputString+"",
			id: ""+id+"",
			suggest: ""+suggest+"",
			suggestlist: ""+suggestlist+"",
			ref: ""+ref+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest).show();
					$('#'+suggestlist).html(data);
				}
			});
		}
	} // lookup
	
	function fill(obj,suggest,id,ref) {
	document.getElementById(suggest).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	
var doc = obj.split("***");
	//alert(doc[0]);
		$('#'+id).val(doc[0]);
		$('#'+ref).val(doc[1]);
		setTimeout("$('#'"+suggest+").hide();", 200);
		//alert(doc[1]);
		//alert(ref);
		if(ref=='docref1')
		docref(ref);
		if(ref=='tosref1')
		toss(ref);
		if(ref=='paedref1')
		paedd(ref);
		if(ref=='physref1')
		physs(ref);
		if(ref=='neuref1')
		neuu(ref);
		if(ref=='swref1')
		swwn(ref);
		if(ref=='ngref1')
		ngo(ref);
	}
</script>
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
	document.getElementById(suggest2).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	

	//alert(doc[0]);
		$('#'+id2).val(obj2);
		
		setTimeout("$('#'"+suggest2+").hide();", 200);
		
	}
	</script>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script>
function sendmsg(field,type,center){
//alert(field+" "+type+" "+center);
var field=field;
var type=type;
var center=center;
 //var oo = document.getElementById("hos").value;
 //alert(oo);
 var opener2 = null;
 if (window.dialogArguments) // Internet Explorer supports window.dialogArguments
        { 
            opener2 = window.dialogArguments;
        } 
        else // Firefox, Safari, Google Chrome and Opera supports window.opener
        {        
            if (window.opener) 
            {
                opener2 = window.opener;
				//return true;
            }
        }       
	//alert(opener2);

  opener2.setmsg22(field,type,center);
 // window.close();
}

function citywindow(field,center)
{
var center=document.getElementById(center).value;
  mywindow = window.open("apptype.php?field="+field+"&center="+center, "mywindow", "location=400,status=1,scrollbars=1, width=400,height=300,left=350,top=200");
  
 }

function settypemsg(field,id,name,amt)
{
//alert(field+" "+id+" "+name+" "+amt);
 //document.getElementById(field).value=id;
 var option = document.createElement("option");
option.text = name;
option.value = id;
var selected = document.getElementById(field);
selected.appendChild(option);

setSelectedValue(selected, id);

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

}
</script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

</head>

<body>

<?php
if(isset($_POST['submit']))
{
include('config.php');
$hos=$_POST['apptype'];
$appdate=$_POST['appdate'];
$appdate2=$_POST['appdate2'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$dur=$_POST['dur'];
$dur1=$_POST['dur1'];
$appdate=str_replace('/','-',$appdate);
$appdate2=str_replace('/','-',$appdate2);
 $start=date("Y-m-d",strtotime($appdate));
 $end=date("Y-m-d",strtotime($appdate2));
//$start = strtotime('2010-01-25');
//$end = strtotime('2010-02-20');
$fail=array();

 $days = ceil(abs(strtotime($end) - strtotime($start)) / 86400);
//$newhos=$_POST['apptype'];

if($dur=="pm" && $hr!=12){
	$hr+=12;
		}
if($dur=="am" && $hr==12){
			$hr="00";
			}
if($dur1=="pm" && $hr1!=12){
	$hr1+=12;
		}
if($dur1=="am" && $hr1==12){
			$hr1="00";
			}
$time=$hr.":".$min;
$time1=$hr1.":".$min1;

for($i=0;$i<=$days;$i++)
{

$sql="insert into slot (hospital,app_date,start_time,end_time,center) values ('$hos','".date('Y-m-d', strtotime($appdate .' +'.$i.' days'))."','$time','$time1','".$_POST['center']."')";
//echo $sql." <br>";
$res=mysql_query($sql);
if($res)
{
$fail[]=date('Y-m-d', strtotime($appdate .' +'.$i.' days'));
}
}
//echo $sql;
//echo count($fail);
if(count($fail)>0)
{
if($_POST['field']!='')
{
?>
<script type="text/javascript">
alert("Slot has been created successfully");
sendmsg('<?php echo $_POST['field']; ?>','<?php echo $_POST['apptype'] ?>','<?php echo $_POST['center'] ?>');
window.onunload = refreshParent;
        function refreshParent() {
		child.myParent = window;
            window.opener.location.reload(true);
        }
		window.close();
</script>
<?php	//header('Location:view_slot.php');
}
else
{
?>
<script type="text/javascript">
alert("slot added Successfully");
window.location='new_slot.php';
</script>
<?php
}
}
else
{
echo "<h2>Creation of slot for following days Failed</h2>";
for($i=0;$i<count($fail);$i++)
echo "<br>".$fail[$i]." <br>";
}

}
?>
<div class="M_page" align="left">

<table><tr><td>

<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" name="frmslot" onsubmit="return validate();" autocomplete='OFF'>
<fieldset class="textbox">

<legend><h1>New Slot</h1></legend>
<table id="sub">
<tr>
<td width="129" height="54"><label>Appointment Place</label></td>
<td width="239" height="54">
 <input type="text" name="center" id="center" onkeyup="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');" value="Borivali"  />
              <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:300px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div>
</td>
</tr>
<tr>
<td width="129" height="54"><label>Select Type of Appointment</label>&nbsp;&nbsp;<a href="#" onclick="citywindow('apptype','center');"><img src="images/add.png" height="15px" width="15px" title="Add New Type" /></a></td>
<td width="239" height="54">
<?php 
include('config.php');
$result5 = mysql_query("select type from apptype where type<>'' order by type ASC");?>
              <select name="apptype" id="apptype">
                <option value="">Select</option>
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>" <?php if($hos==$row5[0]){ ?> selected="selected" <?php } ?>><?php echo $row5[0]; ?></option>
				<?php } ?>
				
				</select>
				
</td>
</tr>
<tr id="slotting"><td colspan="2" align="right"></td>  </tr>
<tr>
<td height="54"><label>From Date </label></td>
<td>
<input id="appdate" name="appdate" type="text" value="<?php if(isset($_GET['dt'])){ echo $_GET['dt'];  }else{ echo date('d/m/Y'); } ?>" readonly="readonly">
<input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate');"/>
</td>
</tr>
<tr>
<td height="54"><label>To Date</label></td>
<td>
<input id="appdate2" name="appdate2" type="text" value="<?php if(isset($_GET['dt'])){ echo $_GET['dt'];  }else{ echo date('d/m/Y'); } ?>" readonly="readonly">
<input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate2');"/>
</td>
</tr>
<tr>
<td height="54"><label>Start Time</label></td>
<td>

                <select name="hour" id="hour" style="width:50px">
                
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
   
                <select name="min"  style="width:50px">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                <select name="dur"  style="width:50px">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
                
</td>
</tr>

<tr>
<td height="54"><label>End Time</label></td>
<td>

                <select name="hour1"  style="width:50px">
               
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
   
                <select name="min1"  style="width:50px">
                <option value="00">00</option>
                <option value="30">30</option>
                </select>
                <select name="dur1"  style="width:50px">
                <option value="am">am</option>
                <option value="pm">pm</option>
                </select>
</td>
</tr>

<tr>
<td height="54"><input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field']; } ?>" /><input class="submit formbutton" type="submit" name="submit" value="create Slot" style="height:30px; width:80px"> </td> 
<td><a href="view_patient1.php" > <button class="submit formbutton" type="button" onClick="window.close()">Cancel</button></a></td>
</tr>
</table> 
</fieldset>               
</form>
</td><!--<td valign="top"><table><tr><td height="200px">&nbsp;</td><td><input class="submit formbutton" type="button" onClick="showdiv();" id="crthos" value="New Hospital">
				<div id="createhos" style="display:none">
				<?php
include("config.php");
if(isset($_POST['hossub']))
{
if(($_POST['hos']==''))
{
echo "Please Add hospital Name";
}
else
{
$qry=mysql_query("Insert into hospital(`name`) Values('".$_POST['hos']."')");
if($qry)
{
?>
<script type="text/javascript">
alert("Hospital created Successfully");
window.location="new_slot.php?dt=<?php echo date('d/m/Y'); ?>&hos=<?php echo $_POST['hos'] ?>";
</script>
<?php	
}
else
echo "Some Error occurred. Try again";
}
}
?>

				<form name="newhos" method="post" action="<?php $_SERVER['PHP_SELF']  ?>">
Hospital Name : <input type="text" name="hos" id="hos" />
<br />
<input type="submit" name="hossub" value="Add Hospital" />
</form></div></td></tr></table> </td>-->
</tr>
</table>


</div>

</body>
</html>

