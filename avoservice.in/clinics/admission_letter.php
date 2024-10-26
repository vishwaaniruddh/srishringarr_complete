<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where srno='$id'");
	$row1=mysql_fetch_row($result1);
?>

<script type="text/javascript">
function ord(){
	var com=document.getElementById('order');
	var text=document.getElementById('status').value+="\n\n"+com.value;
}
</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<html>
	<body>
	 <br><br><br><br><br><br><br><br><br><hr>
    <form action="clinic_print.php" method="post">
    <input type="hidden" name="print1"  value="ap"/>
    Date : <input type="text" name="dt" id="dt" onClick="displayDatePicker('dt');"/><br><br>
    Hospital : <select name="hosp" id="hosp" style="width:350px;">
    <option value="0">-Select-</option>
    <?php $result2=mysql_query("select * from hospital");
     while ($row2=mysql_fetch_row ($result2))
				{ ?>
            	<option value="<?php echo $row2[0];?>"><?php echo $row2[0];?></option>
           		<?php } ?>
    </select><br><br>
    
    Select Orders : <select name="order" id="order" style="width:350px;" onChange="ord();">
    <?php $result3=mysql_query("select * from orders"); ?>
    <option value="0">-Select-</option>
    <?php while ($row3=mysql_fetch_row ($result3))
				{ ?>
            	<option value="<?php echo $row3[0];?>"><?php echo $row3[0];?></option>
           		<?php } ?>
    </select><br><br>
    
    <textarea name="status" id="status" rows="15" cols="100"></textarea><br><br>
    <input type="text" name="note" id="note" style="width:618px;" value="Please inform  on 9320129888 once the patient is admitted."/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="print" id="print" value="Print" style="width:100px;"/>
    </form>
    </body>
</html>