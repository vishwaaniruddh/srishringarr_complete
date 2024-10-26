<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where no='$id'");
	$row1=mysql_fetch_row($result1);
?>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<html>
<body>
<form action="addhospital.php" method="post">
Date : <input type="text" name="dat" id="dat" style="width:150px;" onClick="displayDatePicker('dat');"/><br /><br />
Hospital : <select name="hosp" id="hosp" style="width:250px;">
<?php $result3=mysql_query("select * from hospital"); ?>
    <option value="0">-Select-</option>
    <?php while ($row3=mysql_fetch_row ($result3))
				{ ?>
            	<option value="<?php echo $row3[0];?>"><?php echo $row3[0];?></option>
           		<?php } ?>
</select><br><br>
<center><input type="submit" name="add" id="add" value="Add" style="width:100px;"/></center>
</form>
</body>
</html>