<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script>
//==load parent page after submit or cancel
    window.onunload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
</script>

<script type="text/javascript">
function validate(){
	with(form){ 
	//===call validlogtime() function for checking closing time should not be before response time=============
	validlogtime();
	
	//===Date
		if(document.getElementById("cdate").value=='')
			{
			alert("Please select Date");
			document.getElementById("cdate").focus();
			return false;
			}
			//===Hour
			if(document.getElementById("close_hr").value=='')
			{
			alert("Please select Hour");
			document.getElementById("close_hr").focus();
			return false;
			}
			//===Min
			if(document.getElementById("close_min").value=='')
			{
			alert("Please select Minute");
			document.getElementById("close_min").focus();
			return false;
			}
			//===Meri
			if(document.getElementById("close_meri").value=='')
			{
			alert("Please select AM or PM");
			document.getElementById("close_meri").focus();
			return false;
			}
	
	
					
	
	}
				if(confirm('Are you sure you want to Enter this Update.')) 
			   	{
				return true;
			   	}
			   else 
				{
				return false;
				}	
return true;
}

//================FUNCTION OF CHECKING, CLOSING TIME IS NOT BEFORE RESPONSE TIME====

function validlogtime(){
	
	logtime=document.getElementById('restime').value;
	//alert(logtime);
	dateSecond = document.getElementById('cdate').value.split('/');
	rhour=document.getElementById('close_hr').value;
	rminute=document.getElementById('close_min').value;
	
	var resdate = new Date(dateSecond[2], dateSecond[1], dateSecond[0]); //Year, Month, Date
	//alert(resdate);
	//var rdate = new Date(document.getElementById("rest").value);
	//alert(rdate);
			var dd = resdate.getDate(); //alert(dd);
            var mm = resdate.getMonth(); //alert(mm);
            var yyyy = resdate.getFullYear();//alert(YYYY);
			
			if(document.getElementById('close_meri').value=='pm'){
				rhour=12+parseInt(rhour);
				var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;
				var restime=document.getElementById('restime').value;
				//alert(logtime);
				//alert(resdatenew);
				//alert(Date.parse(logtime ));
				//alert(Date.parse(resdatenew ));
					if( Date.parse(resdatenew) <= Date.parse(restime )) {
    						alert("You Can Not Enter Closing Time Befor "+ restime+" Response Time . Please try again...");
							document.getElementById('cdate').value="";
							document.getElementById('close_hr').value="";
							document.getElementById('close_min').value="";
							document.getElementById('close_meri').value="";
							document.getElementById('cdate').focus();
							
						}else{
								//alert("ok");	 
							}
						
			}else{
				var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;
				//alert(resdatenew);
				var restime=document.getElementById('restime').value;
				//alert(logtime);
				//alert(resdatenew);
					if( Date.parse(resdatenew) <= Date.parse(restime )) {
    					alert("You Can Not Enter Closing Time Befor Response "+ restime+" Time . Please try again...");
								document.getElementById('cdate').value="";
								document.getElementById('close_hr').value="";
								document.getElementById('close_min').value="";
								document.getElementById('close_meri').value="";
								document.getElementById('cdate').focus();
								
						}else{
								//alert("ok");	 
							}
				}

	}	

</script>
</head>

<body bgcolor="#009999">

<h2 align="center" style="color:#FF0;">Data is submited Successfully Now Please Enter the Assets.</h2>
<center>

<form action="process_update_call_close.php" method="post" name="form" onsubmit="return validate();" >
<?php 
include("config.php");

$calltype=$_GET['calltype'];
//echo "asstname".$calltype."<br>";
$id=$_GET['id'];
//echo "id".$id."<br>";


		//==================SELECT entry_date FROM ALERT TABLE===============
				$logcal_time=mysqli_query($con1,"select `entry_date`,`responsetime` from `alert` where `alert_id`='".$id."' ");
		  		$logcal_time1=mysqli_fetch_row($logcal_time);
				//echo $logcal_time1[1];
				$logcal_timenew=date('m/d/Y H:i',strtotime(str_replace('-','/',$logcal_time1[1])));

if(isset($calltype) && $calltype=='close'){
?>
			<input type="hidden" name="restime" id="restime" value="<?php echo $logcal_timenew; ?>"  />
<table border="1">

<tr style="visibility:hidden" id="hrow">
    <td height="35" >Confirm : </td>
    <td width="250" colspan="5">
    <input type="checkbox" name="confirm" id="confirm"   />
    </td>
    </tr>
<tr>

<!--<tr>
    <td height="35" >Update : </td>
    <td width="250" colspan="5">
    <textarea name="up" id="up" rows="4" cols="25"></textarea>
    </td>
    </tr>
<tr>-->
    <td>Closing Date:</td>
	<td colspan="5">
     <!--===========For Date ==========-->
    <input type="text" name="cdate" id="cdate" onClick="displayDatePicker('cdate');" value="<?php echo date('d/m/Y'); ?>" readonly/>
    
    <!--===========For Hour ==========-->
			<select name="close_hr"  id="close_hr" >
			<option value="">Select time</option>
			<?php
			for($i=1;$i<=12;$i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php }?>
			</select>
            
			<!--===========For Minute ==========-->
			 <select name="close_min" id="close_min" >
					<option value="">Select Min</option>
					<option value="<?php echo 0 . ":00:00"; ?>">0</option>
					<?php
					for($i=01;$i<=60;$i++)
					{
					?>
					<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
               
			<!--===========For Meridain ==========-->
			<select name="close_meri" id="close_meri" >
				<option value="" >Select</option>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
            
    </td>
</tr>
<tr>
 <td height="35" colspan="3" align="center">
     <input type="hidden" name="ctype" id="ctype" value="<?php  echo $calltype; ?>" /> 
     <input type="hidden" name="pmcnt" id="pmcnt" value="<?php echo $cnt; ?>" /> 
     <input type="hidden" name="id" value="<?php echo $id; ?>" readonly /> 
     <input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" /> 
    
    <input type="submit" value="submit" class="readbutton" name="cmdsub" />
</td> 
<td colspan="3" align="center">
<input type="button" value="Cancel" class="readbutton" onClick="self.close()" />
</td>
</tr>
</table>
<?php } ?>
</form>


<?php if(isset($calltype) && $calltype=='pending'){ ?>
<table>
<tr><td>
<input type="button" value="Close" class="readbutton" onClick="self.close()" />
</td></tr></table>
<?php } ?>

</center>

<script type="text/javascript">
	function CheckCheckboxes1(chk){
    var txt = chk.parentNode.parentNode.cells[3].getElementsByTagName('input')[0];
    var sel1 = chk.parentNode.parentNode.cells[2].getElementsByTagName('select')[0];
    var sel2 = chk.parentNode.parentNode.cells[4].getElementsByTagName('select')[0];
    var txt2 = chk.parentNode.parentNode.cells[5].getElementsByTagName('textarea')[0];
    if(chk.checked == true)
    {
        txt.value = "";
        txt.disabled= false;
        sel1.disabled= false;
        sel2.disabled= false;
        txt2.disabled= false;
    }
    else
    {
        txt.value = "";
        txt.disabled= true;
        sel1.disabled= true;
        sel2.disabled= true;
        txt2.disabled= true;
    }
}


</script>
</body>
</html>