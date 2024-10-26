<?php
include("access.php");
 
 include("config.php");
 
 $id=$_GET['id'];
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function validation(){
	
	with(form){
		
		if(document.getElementById('spec').value==""){
			alert("Please Enter Spec.");
			return false;
			document.getElementById('spec').focus();
			}
		/*if(document.getElementById('cname').value==""){
			alert("Please Enter Company name.");
			document.getElementById('cname').focus();
			return false;			
			}	*/
		
		
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
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2 class="h2color">New Assets</h2>

<form action="process_editasset.php" method="post" name="form" onSubmit="return validation();">
<table>
<tr>
<td>Asset Name:</td>
<td>Specification:</td>
<td>Company Name :</td>
</tr>
<?php 

$query=mysqli_query($con1,"select * from `assets_specification` where `ass_spc_id`='".$id."'");
while($query1=mysqli_fetch_row($query)){;
?>
<tr>
<td><?php
 $assname=mysqli_query($con1,"select `assets_name` from `assets` where `assets_id`='".$query1[1]."'");
 $assname1=mysqli_fetch_row($assname);
 echo $assname1[0]; ?></td> 
<td><input type="text" name="spec" id="spec" value="<?php echo $query1[2]; ?>" /></td>
<td><input type="text" name="cname" id="cname" value="<?php echo $query1[3]; ?>" /></td>
</tr>
<?php } ?>

<tr><td colspan="3" align="center"><input type="submit" value="Submit"  />
<input type="hidden" name="asset_id" id="asset_id" value="<?php echo $id; ?>" />
</td></tr>
</table>

</form>




</center>
</body>
</html>