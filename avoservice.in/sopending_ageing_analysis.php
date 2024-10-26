<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
$brmain=$_SESSION['branch'];

$srno=mysqli_query($con1,"select `srno` from login where `username`='".$_SESSION['user']."'");
$srno1=mysqli_fetch_row($srno);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
</script>







<script>
</script>
</head>

<body>

<?php $branchavo= $_SESSION['branch']; ?>
<input type="hidden" value="<?php  echo $branchavo;?>" name="bravo" id="bravo"/>
<center>
<?php include("menubar.php");  ?>





<h2 class="h2color">Pending Sales Orders Ageing Analysis</h2>

<div >
 <!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->
	<br />
<form action="sopending_ageing_export.php" method="POST" target="_new">
<table cellpadding="" cellspacing="0" >

    <tr>
    
 		<th width="75"><select name="type" id="type" ><option value="cwise">Clientwise</option><option value="bwise">Branchwise</option></select></th>
     
     <th width="75">
<input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="Upto Date" required>
</th>
     
    <th width="75" ><input type="submit"  value="Export" /></th> 
  
 
  
  </tr>
  
</table>
</form>
</div>
<div id="search"></div>


</center>
</body>
</html>