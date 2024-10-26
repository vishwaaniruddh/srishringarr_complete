<?php
include('config.php');

$it=$_GET['barcode'];
$bar=$_GET['barcode2'];
//echo $it."/".$bar;

       if($bar==""){
      // echo "1";
       $barcode=$_GET['barcode'];
       $qry="select item_number,name,category,unit_price,quantity from  phppos_items where name='$barcode' ";
       
}else if($it==""){
//echo "2";
 $barcode=$_GET['barcode2'];
 $qry="select item_number,name,category,unit_price,quantity from  phppos_items where item_number='$barcode'";
 
}

$res=mysql_query($qry);                
$num=mysql_num_rows($res);
			
if($num==0){
	echo "0";
}else{
?>
<table border="0"  width="730" align="left">
<?php

$suggest = mysql_fetch_row($res);


$item_number =$suggest[0]; 
$name=$suggest[1]; 
$category=$suggest[2]; 
$unit_price=$suggest[3]; 
?>				   
				   
<tr>

<td width="83"><?php echo $name; ?><input name="design[]" type="hidden" value="<?php echo $name; ?>" class="design"/>
<input name="barc[]" type="hidden" value="<?php echo $item_number; ?>" class="barc"/></td>
<td width="131" align="center"><?php echo $category; ?></td>
<td width="111"> <?php echo $unit_price; ?><input name="prz[]" type="hidden"  class="prz" value="<?php echo $unit_price; ?>"/></td>
 <td  align="left" width="202"> <input name="qty[]" type="text" value="1" class="qty" onkeyup="checkTotal();Totalamount();"/></td>
<td  align="left" width="181"> Rs<input name="<?php echo $name; ?>" type="radio" class="ds" value="Rs" checked onClick="Totalamount();">&nbsp;&nbsp;%<input name="<?php echo $name; ?>" type="radio" value="%" class="ds1" onClick="Totalamount();"><br/>

<input name="dis1[]" type="text" value="" class="disamt" onKeyUp="Totalamount();" /></td>
 <td width="83"><?php echo $suggest[4]; ?><input type="hidden" name="total_qty[]" class="total_qty" value="<?php echo $suggest[4]; ?>"></td>
     </tr>
				
			<?php 	?>
            </table>
			  <?php } ?>
             