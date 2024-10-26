<?php
include("access.php");
include("config.php");
 $id=$_GET['id'];
?>
<script>
function validate(frm){
	//alert("hi");
      with(frm){
 		
	   if(reason.value=="" )
	   {
		alert("Please Enter Reason to Reject Call.");
		reason.focus();
		return false;
		}
		
	 if(confirm('Are you sure you want to Reject this Call.')) 
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

<body bgcolor="#009999"><center>
<h2 align="center">Reject Client Service Call </h2>
<form name="frm" method="post" action="process_reject_client.php" onSubmit="return validate(this);">
<table border="1">


<tr>
<td>Reason (please do not use " sign)</td>
<td><textarea name="reason" required="" cols="30" rows="7"></textarea></td>
</tr>

<tr align="center">
<td colspan="2" align="center">
<input type="hidden" name="alertid" value="<?php echo $id ?>">
<input type="hidden" name="br" value="<?php echo $_SESSION['branch']; ?>">
<input type="submit" name="cmdsub" value="Submit" style="background:#CCCCCC; height:40px; width:80px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button" name="cmdcan" value="Cancel >> " style="background:#CCCCCC; height:40px; width:80px" onClick="window.close()"></td></tr>
</table>
</form></center></body>


