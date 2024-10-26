<?php
include("access.php");
// include("config.php");
include("db_connection.php");
$con1 = OpenCon1();

 $id=$_GET['id'];
?>
<script>
function validate(frm){
	//alert("hi");
 with(frm){
 		
	   if(reason.value=="" )
	   {
		alert("Please Enter Reason to convert.");
		reason.focus();
		return false;
		}
		
	 if(confirm('Are you sure you want to Enter this Conversion.')) 
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
<h2 align="center">Convert into PCB </h2>
<form name="frm" method="post" action="process_convet_pcb.php" onSubmit="return validate(this);">
<table border="1">

<tr><td>Convert To</td>
<td><?php
$qry=mysqli_query($con1,"select `assetstatus` from `alert` where `alert_id`='".$id."'");
$row=mysqli_fetch_array($qry);
?>
<select name="convert" id="convert">

<?php if($row[0]=='site'){ ?>
<option value="wtopcb">UW-PM to Service</option>
<?php } else {?>
<option value="amctopcb">AMC-PM to Service</option>
<?php }?>
</select></td></tr>
<tr><td>Reason (please do not use " sign)</td><td><textarea name="reason" required="" cols="30" rows="7"></textarea></td></tr>
<tr align="center"><td colspan="2" align="center">
<input type="hidden" name="alertid" value="<?php echo $id ?>">
<input type="hidden" name="br" value="<?php echo $_SESSION['branch']; ?>">
<input type="submit" name="cmdsub" value="Convert" style="background:#CCCCCC; height:40px; width:80px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="cmdcan" value="Cancel >> " style="background:#CCCCCC; height:40px; width:80px" onClick="window.close()"></td></tr>
</table>
</form></center></body>
<?php
    CloseCon($con1);
?>