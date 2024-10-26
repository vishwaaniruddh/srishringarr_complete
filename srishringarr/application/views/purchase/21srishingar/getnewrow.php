<?php include('config.php');
 $qryitem=mysql_query("select * from phppos_items");?>

<div>Item Name : <select name="item_id[]" class="item_id"><option value="0">Select Item</option><?php while($row=mysql_fetch_row($qryitem)){ echo "<option value='".$row[9]."'>".$row[0]."</option>";}?></select>&nbsp; Price : <input type="text" align="right" name="price[]" onChange="subtotal()" value="0" onkeypress="return isNumberKey(event)" class="price">&nbsp; Quantity : <input type="text" name="qty[]" align="right" id="qty" class="qty" value="0" onkeypress="return isNumberKey(event)" onChange="subtotal()"> Amount : <input type="text" name="subtotal[]" class="subtotal" align="right" readonly>
