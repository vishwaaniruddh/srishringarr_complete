<?php
include("access.php");
include("config.php");

$id=$_GET['id'];
date_default_timezone_set('Asia/Kolkata');
?>

<script>
function validate(form){
 with(form){
 	if(reason.value=="" )
	   {
		alert("Please Select the Reason.");
		reason.focus();
		return false;
		}
		
	 if(update.value=="" )
	   {
		alert("Please Enter Some Update.");
		update.focus();
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

</script>
<style>
h2{color:#F00;}
</style>
<body bgcolor="#009999" onLoad="">
<table border="1" width="70%">

<tbody>

<tr><td colspan="3" align="center"><h3>Cancel Supply</h3></td></tr>

<form action="process_cancel_supply.php" method="post" name="form" onSubmit="return validate(this);">

<tr>
<td width="115" height="35">Reason for Cancel: </td>
<td width="305">
<select name="reason" id="reason" required>
<option value="">Select</option>
<option value="Order Cancelled">Order Cancelled</option>
<option value="Unable to Deliver">Unable to Deliver</option>
<option value="Double Supply">Double Supply</option>
<option value="Wrong Delivery">Wrong Delivery</option>
<option value="Others">Others - Pl specify below</option>

</select>
</td>
</tr>
    <tr>
    <td width="210" height="35">Remarks: </td>
    <td width="167">
    <textarea name="update" id="update" rows="4" cols="25"></textarea>
    </td>
    </tr>
   
    <tr>
    <td height="35"><input type="submit" value="submit" class="readbutton"/></td>
    <td colspan="2"><input type="button" value="cancel" class="readbutton" onClick="self.close()"/></td>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </tr>
   
    </table>
</form>

</td>
</tr>
</tbody>
</table>

</body>