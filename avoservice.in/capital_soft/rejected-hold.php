<?php
include("access.php");
include("config.php");
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
if(isset($_GET['id']))
$id=$_GET['id'];

date_default_timezone_set('Asia/Kolkata');


$qr=mysqli_query($concs,"select `caller_email`,`call_status` ,`reached_date`,`reached_time`,`update_status` from alert where alert_id='".$id."'");
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
function validate(form){
 with(form){
 		
	   if(up.value=="" )
	   {
		alert("Please Enter Some Update.");
		up.focus();
		return false;
		}
		
	if(reason.value=="" )
	   {
		alert("Please Select the Reason.");
		reason.focus();
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


//=======Hide dvi of eta
function showMe(it,box){
	//alert("hi");
	var vis = (box.checked) ? "block" : "none"; 
	document.getElementById(it).style.display = vis;			
	}


function showHide (id) 
{ 
var style = document.getElementById('hiderow').style 
if (style.visibility == "hidden") 
style.visibility = "visible"; 
else 
style.visibility = "hidden"; 
} 
</script>
<style>
h2{color:#F00;}
</style>
<!--<h2 align="center">Updates <a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a></h2>-->
<body bgcolor="#009999" onLoad="">
<table border="1" width="70%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Previous Update</h2> </th> </tr>
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
//echo $qryfirst;

	$tab=mysqli_query($concs,$qryfirst);
 
 	while ($row=mysqli_fetch_row($tab)) {
	 
	 $upby="Masteradmin";
	 if($row[3]=='4')
	 $str="select `engg_name` from area_engg where loginid='".$row[1]."'";
	 elseif($row[3]=='3')
	 $str="select head_name from branch_head where loginid='".$row[1]."'";	 
	 $up=mysqli_query($concs,$str);
	 $upro=mysqli_fetch_array($up);
	 $upby=$upro[0];
//	echo $str; 
	  ?>    


<tr>
<td><?php echo $row[0]; ?></td>
<td><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[2])); ?></td>
<td><?php echo $upby; ?></td>
</tr>

<?php } ?>

		
        
<tr><td colspan="3" align="center"><h3>Reject/Hold Call</h3></td></tr>

<form action="process-rejected-hold.php" method="post" name="form" onSubmit="return validate(this);">

<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />

	<!--===========UPDATE ROW SHOW HERE===========================-->
   
    
    	<tr>
			<td height="35" width="167" >Rejected</td>
			<td colspan="1" align="center"><input type="radio"   name="callclose" id="callclose4" value="Rejected"   <?php if($actstat=='rejected'){echo "checked='checked'";} ?> /></td>
			</tr>			
		    <td  height="35" width="167" >Hold Call</td>
			<td colspan="1" align="center"><input type="radio"   name="callclose" id="callclose4" value="hold"   <?php if($actstat=='hold'){echo "checked='checked'";} ?> /></td>
			</tr>
			
			<tr>
<td width="115" height="35">Reason: </td>
<td width="305">
<select name="reason" id="reason" required>
<option value="">Select</option>
<option value="Repeat Call">Repeat Call</option>
<option value="Customer not responding">Customer not responding</option>
<option value="Electrical issue not resolved">Electrical issue not resolved</option>
<option value="Customer Approval Pending">Customer Approval Pending</option>
<option value="Hold By management">Hold By management</option>
<option value="SIte Not Ready">Site Not Ready for Installation</option>
<option value="Material not Delivered">Material not Delivered for Inst</option>
<option value="Others">Others - Pl specify below</option>

</select>
</td>
</tr>
    
    <tr>
    <td width="210" height="35">Remarks: </td>
    
    
    <td width="167">
    <textarea name="up" id="up" rows="4" cols="25"></textarea>
    </td>
    </tr>
   			
          
			
<!--===============================================TYPE OF PROBLEM OCCURRED ROW SHOW HERE=============================-->
	
    
    <tr>
    <td height="35"><input type="submit" value="submit" class="readbutton"/></td>
    <td colspan="2"><input type="button" value="cancel" class="readbutton" onClick="self.close()"/></td>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    
    <input type="hidden" name="dt" value="<?php echo date("d/m/Y"); ?>" id="dt" />
    </tr>
   
    </table>
</form>

</td>
</tr>
</tbody>
</table>

</body>