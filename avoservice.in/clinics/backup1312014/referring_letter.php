<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where srno='$id'");
	$row1=mysql_fetch_row($result1);
?>

<script type="text/javascript">
function refer(){
	var com=document.getElementById('ref');
	var text=document.getElementById('status').value+="\n\n"+com.value;
}
</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<html>
	<body>
	 <br><br><br><br><br><br><br><br><br><hr>
    <?php $result2=mysql_query("select * from doctor where doc_id='$row1[9]'");
	$row2=mysql_fetch_row($result2);
	?>
    <form action="clinic_print.php" method="post">
    
     Date : <input type="text" name="dt" id="dt" onClick="displayDatePicker('dt');"/><br><br>
     To, <br>
    Reference Doctor : <input type="text" name="doc" id="doc" style="width:250px;" value="<?php echo $row2[1]; ?>"/><br><br>
    <input type="hidden" name="print1"  value="rp"/>
    <b>  Dear Doctor, Respected Doctor, Dear Sir, Respected Sir,</b><br><br>
    <select name="dear" style="width:250px;">
    <option value="0">-Select-</option>
    <option value="Dear Doctor">Dear Doctor</option>
    <option value="Respected Doctor">Respected Doctor</option>
    <option value="Dear Sir">Dear Sir</option>
    <option value="Respected Sir">Respected Sir</option>
    <option value="Dear Madam">Dear Madam</option>
    <option value="Respected Madam">Respected Madam</option>
    </select><br><br>
    Referring Patient For : <select name="ref" id="ref" style="width:200px;" onChange="refer();">
    <option value="0">-Select-</option>
    <option value="Expert Opinion">Expert Opinion</option>
    <option value="Evaluation">Evaluation</option>
    <option value="Further Management">Further Management</option>
    </select><br><br>
    
    <textarea name="status" id="status" rows="20" cols="100"></textarea>
    <p>Thanking you, With warm Regards, Dr. Taral Nagda.</p>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="print" id="print" value="Print" style="width:100px;"/>
    </form>
    </body>
</html>