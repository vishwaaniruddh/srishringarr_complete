<?php
include("access.php");
include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
if(isset($_GET['id']))
$id=$_GET['id'];
if(isset($_GET['br']))
$br=$_GET['br'];
if(isset($_GET['ctype']))
$ctype=$_GET['ctype'];
if(isset($_GET['alerts_id']))
$alertid=$_GET['alerts_id'];

if(isset($_GET['eng_id']))
$eng_id=$_GET['eng_id'];


date_default_timezone_set('Asia/Kolkata');
//echo "select `caller_email`,`call_status` ,`reached_date`,`reached_time`,`update_status` from alert where alert_id='".$id."'";
//echo "<br>";
$qr=mysqli_query($con1,"select `caller_email`,`call_status` ,`reached_date`,`reached_time`,`update_status` from alert where alert_id='".$id."'");
$ro1=mysqli_fetch_row($qr);
$rolhide= date('d-m-Y',strtotime($ro1[2]));
//echo $ro1[4];
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script>
    window.onunload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
</script>

<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script>

function mail_value(){}


</script>

<script>
function validate(form){
 with(form){
 		
	   if(up_revise.value=="" )
	   {
		alert("Please Enter Some Update.");
		up_revise.focus();
		return false;
		}
		
	 if(confirm('Are you sure you want to Enter this Update.')) 
		   {
			return true;
		   }
		   else 
		    {
			return false;
			} 
	 
	}
		  
//return true;			 
 }


//================check log time and response time here

function validlogtime(){
	
	//logtime=document.getElementById('clogtime').value;
	//alert(logtime);
	dateSecond = document.getElementById('rest').value.split('/');
	rhour=document.getElementById('eng_reach_time').value;
	rminute=document.getElementById('rminute').value;
	
	//alert(document.getElementById('rmeri').value);
	//if(document.getElementById('rmeri').value=='pm')
	//rhour=12+parseInt(rhour);
	//alert("24hr="+rhour);
	//alert(dateSecond);
	var resdate = new Date(dateSecond[2], dateSecond[1], dateSecond[0]); //Year, Month, Date
	//alert(resdate);
	//var rdate = new Date(document.getElementById("rest").value);
	//alert(rdate);
			var dd = resdate.getDate(); //alert(dd);
            var mm = resdate.getMonth(); //alert(mm);
            var yyyy = resdate.getFullYear();//alert(YYYY);
			
			if(document.getElementById('rmeri').value=='pm'){
				rhour=12+parseInt(rhour);
				var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;
				var logtime=document.getElementById('clogtime').value;
				//alert(logtime);
				//alert(resdatenew);
				//alert(Date.parse(logtime ));
				//alert(Date.parse(resdatenew ));
					if( Date.parse(resdatenew) <= Date.parse(logtime )) {
    						alert("You Can Not Enter Rsponse Time Befor "+ logtime+" Call Log. Please try again...");
							document.getElementById('rest').value="";
							document.getElementById('eng_reach_time').value="";
							document.getElementById('rminute').value="";
							document.getElementById('rmeri').value="";
							document.getElementById('rest').focus();
							
						}else{
								//alert("ok");	 
							}
						
			}else{
				var resdatenew = mm+'/'+dd+'/'+yyyy+' '+rhour+':'+rminute;
				//alert(resdatenew);
				var logtime=document.getElementById('clogtime').value;
				//alert(logtime);
				//alert(resdatenew);
					if( Date.parse(resdatenew) <= Date.parse(logtime )) {
    					alert("You Can Not Enter Rsponse Time Befor "+ logtime+" Call Log. Please try again...");
								document.getElementById('rest').value="";
								document.getElementById('eng_reach_time').value="";
								document.getElementById('rminute').value="";
								document.getElementById('rmeri').value="";
								document.getElementById('rest').focus();
								
						}else{
								//alert("ok");	 
							}
				}

	}		 
	 
</script>
<style>
h2{color:#F00;}
</style>


<!--<h2 align="center">Updates <a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a></h2>-->

<body bgcolor="#009999" onLoad="">
<table border="1" width="70%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Revise Update</h2> </th> </tr>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Updating Person</th>

</tr>
</thead>

<tbody>
<!--========PREVIOUS UPDATE DATA SHOW HERE ============================-->
<?php
    //============= SELECT DATA FROM  eng_feedback AND login TABLE==================
	$qryfirst="select f.feedback,f.engineer,f.feed_date,l.designation from eng_feedback f,login l where f.alert_id='".$id."' and f.engineer=l.srno order by f.feed_date DESC";
	$tab=mysqli_query($con1,$qryfirst);
 
 	while ($row=mysqli_fetch_row($tab)) {
	 $upby="Masteradmin";
	 if($row[3]=='4')
	 $str="select `engg_name`, from area_engg where loginid='".$row[1]."'";
	 elseif($row[3]=='3')
	 $str="select head_name from branch_head where loginid='".$row[1]."'";
	 
	 $up=mysqli_query($con1,$str);
	 $upro=mysqli_fetch_array($up);
	 $upby=$upro[0];
	  ?>    

<tr>
<td><?php echo $row[0]; ?></td>
<td><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[2])); ?></td>
<td><?php echo $upby; ?></td>
</tr>
<?php } ?>

		
        
<tr><td colspan="3" align="center"><h2>New Revise Update</h2></td></tr>
<tr>
<td colspan="3" align="center"> 
<form action="process_eta_revise.php" method="post" name="form" onSubmit="return validate(this);">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />

	<!--===========UPDATE ROW SHOW HERE===========================-->
    <table width="400">
    <tr>
    <td width="210" height="35">Reason for revise ETA : </td>
    <td width="167">
    <textarea name="up_revise" id="up_revise" rows="4" cols="25"></textarea>
    </td>
    </tr>    
    <?php 
   $upst=mysqli_query($con1,"select `update_status`,`pending_update` from `alert` where `alert_id`='".$alertid."'");
   $upst=mysqli_fetch_row($upst);
   $exists_update_progress_qry=mysqli_query($con1,"SELECT * FROM `alert_progress` WHERE `alert_id` = '".$alertid."'");
   //echo mysqli_num_rows($exists_update_progress_qry);
   
   				//==================SELECT entry_date FROM ALERT TABLE===============
				$logcal_time=mysqli_query($con1,"select `entry_date` from `alert` where `alert_id`='".$id."' ");
		  		$logcal_time1=mysqli_fetch_row($logcal_time);
				$logcal_time1[0];
				$logcal_timenew=date('m/d/Y H:i',strtotime(str_replace('-','/',$logcal_time1[0])));
     ?>
   			 <!--CLL LOG TIME HIDDEN VALUE SHOW HERE-->
            <input type="hidden" name="clogtime" id="clogtime" value="<?php echo $logcal_timenew;?>" >          
<!---=====================Revise ETA start here========-->          
    <tr>
    <?php 
		//====GETTING ETA FROM ALERT TABLE HERE==============
    
		//echo "<br> select `eta`,`update_status` from `alert` where `alert_id`='".$id."'";
		$eta=mysqli_query($con1,"select `eta`,`update_status`,`pending_update` from `alert` where `alert_id`='".$id."'");
		$eta1=mysqli_fetch_row($eta);
		//echo date('d-m-Y h:i:s.a',strtotime($eta1[5]));
		//echo "<br>";
	 	$date1=date('d/m/Y',strtotime($eta1[0]));
		//echo $date1."<h1>Hello</h1>";
		//echo "<br>";
		$time=date('h',strtotime($eta1[0]));
		//echo "<br>";
	 	$minut=date('i',strtotime($eta1[0]));
		//echo "<br>";
	 	$meri=date('a',strtotime($eta1[0]));
?>    
    <td> Revise ETA</td>
    <td>   
    	<!--===========For Date ==========-->
        <input type="text" name="rest" id="rest" value="<?php echo $date1; ?>" readonly onClick="displayDatePicker('rest');" onBlur="reviseDate(this.value)" >
        
        
        <!--===========For Hour ==========-->
        <select name="time" id="time"  onChange="reviseTime(this.value)">
            <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
            <?php
            for($i=1;$i<=12;$i++)
            {
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
            }
            ?>
        </select>
        
        <!--===========For Minute ==========-->
        	<select name="minute" id="minute"  onChange="reviseMinute(this.value)">
            	<option value="<?php echo $minut.":00:00"; ?>"><?php echo $minut; ?></option>
            	<?php
            	for($i=1;$i<=60;$i++)
            	{
            	?>
            	<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
            	<?php
            	}
            	?>
        	</select>
           
    		<!--===========For Meridian ==========-->
        	<select name="meri" id="meri"  onChange="reviseMeri(this.value)">
                <option value="<?php echo $meri?>"><?php echo $meri?></option>
                <option value="am">am</option>
                <option value="pm">pm</option>
        	</select>
             
    </td>
    
    </tr>			
            <input type="hidden" name="restb" id="restb"  value="<?php date('m/d/Y'); ?>" />
            <input type="hidden" name="eng_reach_timeb" id="eng_reach_timeb"  value="" />
            <input type="hidden" name="rminuteb" id="rminuteb" value="" />
            <input type="hidden" name="rmerib" id="rmerib" value="" /> 
            <input type="hidden" name="rcheckbox" id="rcheckbox" value="" />           
			<tr>
			<td colspan="3" align="center">
			<table width="394">
    </table>   
    </td>
    </tr>   
    <tr>
    <td height="35"><input type="submit" value="submit" class="readbutton"/></td>
    <td colspan="2"><input type="button" value="cancel" class="readbutton" onClick="self.close()"/></td>
    <input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="br" value="<?php echo $br; ?>" />
    <input type="hidden" name="ctype" value="<?php echo $ctype; ?>" />
    <input type="hidden" name="dt" value="<?php echo date("d/m/Y"); ?>" id="dt" />
    </tr>
   
    </table>
</form>

</td>
</tr>
</tbody>
</table>

</body>