<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where srno='$id'");
	$row1=mysql_fetch_row($result1);
?>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
function investi(){
	var com=document.getElementById('invest');
	var text=document.getElementById('status').value+="\n\n"+com.value;
}
</script>

<html>
	<body>
	 <br><br><br><br><br><br><br><br><br><hr>
    <form action="clinic_print.php" method="post">
    <input type="hidden" name="print1"  value="ip"/>
     Date : <input type="text" name="dt" id="dt" onClick="displayDatePicker('dt');"/><br><br>
     
    Centre : <select name="centre" id="centre" style="width:350px;">
    <option value="0">-Select-</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Saurashtra">Saurashtra</option>
    </select><br><br>
    
    Select Investigation : <select name="invest" id="invest" style="width:350px;" onChange="investi();">
    <?php $result2=mysql_query("select * from investi"); ?>
    <option value="0">-Select-</option>
     <?php while ($row2=mysql_fetch_row ($result2))
				{ ?>
            	<option value="<?php echo $row2[1];?>"><?php echo $row2[1];?></option>
           		<?php } ?>
    </select><br><br>
    
    <textarea name="status" id="status" rows="15" cols="100"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="print" id="print" value="Print" style="width:100px;"/>
    </form>
    </body>
</html>