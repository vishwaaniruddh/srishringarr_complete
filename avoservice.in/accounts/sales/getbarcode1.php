<?php
include('config.php');

$it=$_GET['barcode'];
$bar=$_GET['barcode2'];
//echo $it."/".$bar;

       if($bar==""){
      // echo "1";
       $barcode=$_GET['barcode'];
       $qry="select stock_id,description,long_description from  1_stock_master where description='$barcode' ";	   
       
}else if($it==""){
//echo "2";
 $barcode=$_GET['barcode2'];
 $qry="select stock_id,description,long_description from  1_stock_master where stock_id='$barcode'";
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
 $qryp="select * from  item_details where item_code='".$suggest[0]."'";
  $resp=mysql_query($qryp);                
$suggestp = mysql_fetch_row($resp);
$item_number =$suggest[0]; 
$name=$suggest[1]; 
$category=$suggest[2]; 
$gw=$suggestp[2];
$kt=$suggestp[1];
$dw2=$suggestp[5];
$dw=$suggestp[4];
$nw=$suggestp[3];
$csw=$suggestp[6]; 
$qryprz=mysql_query("select price from  1_prices where stock_id='".$suggest[0]."'");
$rowprz = mysql_fetch_row($qryprz);
?>				   
				   
<tr>
<td width='30'>1</td>
<td width='200'><?php echo $name; ?><input name="design[]" type="hidden" value="<?php echo $name; ?>" class="design"/>
<input name="barc[]" type="hidden" value="<?php echo $item_number; ?>" class="barc"/></td>
<td width='92'><?php echo $kt; ?></td>
<td width='40'><?php echo $gw; ?><input name="gwt[]" type="hidden" value="<?php echo $gw; ?>" class="gwt"/></td></td>
<td width='40'><?php echo $nw; ?></td>
<td width='72'><?php echo $dw; ?><input name="dwt[]" type="hidden" value="<?php echo $dw; ?>" class="dwt"/></td></td>
<td width='72'><?php echo $dw2; ?></td>
    <td width='72'><?php echo $csw; ?></td>
    <td width='72'><input name="gwr[]" type="text" value="" class="gwr" size="3" onkeyup="Totalamount();"/></td>
    <td width='72'><input name="dwr[]" type="text" value="" class="dwr" size="3" onkeyup="Totalamount();"/></td>
    <td width='72'><input name="mkr[]" type="text" value="" class="mkr" size="3" onkeyup="Totalamount();"/></td>
    <td width='72'><input name="csr[]" type="text" value="" class="csr" size="3" onkeyup="Totalamount();"/></td>
<td width="72"><input name="prz[]" type="text"  class="prz" value="<?php echo $rowprz[0]; ?>" size="6" onkeyup="Netamount();" onchange="Netamount();"/></td>
     </tr>
				
			<?php 	?>
            			  <?php } ?>
             