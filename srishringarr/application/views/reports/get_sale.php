<script type="text/javascript" src="datepick_js.js"></script>
<link rel="stylesheet" type="text/css" href="date_css.css"  />
<?php
//ini_set( "display_errors", 0);
include('config.php');
$cid=$_GET['id'];

 $result1 = mysql_query("SELECT * FROM  `approval` where bill_id='$cid'");
	$rowordno = mysql_fetch_row($result1);
	
 $result = mysql_query("SELECT * FROM  `phppos_people` where person_id='$rowordno[1]'");
	$row = mysql_fetch_row($result);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHRINGAAR</title>
</head>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

       
     </script>
     
     
<body>
 <table align="center"><tr>
    <td width="204"><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://sarmicrosystems.in/shringaar/application/views/reports/app_return.php">Back</a></td></tr></table>

<div id="bill" style="font-size:12px;">

    
    <table width="675"  align="center">
       <tr>
        <td colspan="2" align="center" style="padding-left:100px;">
          <font size="+1">
          <?php
          $result5=mysql_query("select * from   `phppos_app_config`");
$row5 = mysql_fetch_array($result5);
mysql_data_seek($result5,1);
$row6=mysql_fetch_array($result5);
mysql_data_seek($result5,10);

$row7=mysql_fetch_array($result5);

?>
<img src="bill.png" width="408" height="165"/><br/><br/>

            <B><U> SALE RETURN DETAIL</U></B></font></td>
      </tr>            
  <tr>
  <td height="42" colspan="2" align="left"><br /></td>
    </tr>
    
  <tr>
    <td width="667" ></td>
    </tr>
    
  <tr>
    <td height="21"><p><font size="+1" >M/s.&nbsp;:&nbsp;&nbsp;<?PHP echo $row[0] . " ".$row[1]; ?></font></p>
      </td><!--<td width="437">Date: <?php// if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2])); ?></td>-->
    </tr>
    
  <tr>
    <td height="23">Contact No.: &nbsp;&nbsp;&nbsp;
      <?php echo $row[2]; ?>
   <br/>Bill Date: &nbsp;&nbsp;<?php  if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2])); ?></td>
   </tr>
   <!--  <tr>
     <?php  /*$qry2="SELECT sum(paid_amount) FROM  `approval` where bill_id ='$cid'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry3="SELECT sum(`amount`) FROM `approval_detail` WHERE bill_id ='$cid'";
$res3=mysql_query($qry3);
$row3=mysql_fetch_row($res3);
$s=$row3[0]-$row2[0];*/
?>
    <td height="23">Paid Amount.: &nbsp;&nbsp;&nbsp;
      <?php// echo $row2[0]; ?></td>
    <td>Balance Amount:<?php //echo $s; ?></td>
    
    </tr>-->
    <!--<tr>
     <form action="updatereturn.php" method="post" >
      <td>Approval Return Date: 
        <input type="text" name="bill_date" id="bill_date" value="<?php //echo date('d/m/Y'); ?>" onClick="displayDatePicker('bill_date');"/></td>-->
 <!-- </table><font size="2" >
 
  
    <table width="851" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
    <th width="77"><font size="2">ITEM CODE</font></th>
    <th width="83">PARTICULARS</th>
    <th width="75"><font size="2">PRICE</font></th>
    <th width="102"><font size="2">ORIGINAL QTY</font></th>
     <th width="98"><font size="2"> RETURN QTY</font></th>
      <th width="109"><font size="2">DISCOUNT</font></th>
       <th width="81"><font size="2"> AMOUNT</font></th>
      <th width="144"><font size="2">QTY</font></th>
    
  </tr>
  <?php
 $result2 = mysql_query("SELECT * FROM  `approval_detail` where bill_id='$cid'");
	while($row2 = mysql_fetch_row($result2))
{
//echo "SELECT * FROM phppos_items WHERE name=".$design[$i];

$sq="SELECT * FROM phppos_items WHERE name='$row2[1]'";
$res2 = mysql_query($sq);
$num2=mysql_num_rows($res2);
$row1=mysql_fetch_row($res2);
$sum1=0;
$sum=0;
//echo $rowordno[0]."/ ".$design[$i]." / ".$prz[$i]." / ".$dep[$i]."<br/>";
  ?>
  <tr>
  <input name="aid[]" type="hidden" value="<?php echo $row2[3]; ?>" />
<input name="it[]" type="hidden" value="<?php echo $row1[0]; ?>" />
    <td align="center"><?php echo $row1[0]; ?></td>
    <td align="center"><?php echo $row1[1]; ?></td>
    <td align="center"><?php echo $row1[6] ?></td>
    <td align="center"><?php echo $row2[2] ?></td>
    <td align="center"><?php echo $row2[4] ?></td>
     <td align="center"><?php echo $row2[5]."%" ?></td>
     <td align="center"><?php echo $row1[6]*$row2[2]-$row2[6] ?></td>
    <td align="center"><input name="qty[]" type="text" value="" /></td>
    
  </tr>
  <?php   } ?>
  <input name="id" type="hidden" value="<?php echo $cid ?>" />

<tr><td colspan="8" align="center">
  Paid Amount : &nbsp; <input type="text" name="amt" id="amt" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Submit" value="Return Detail" /> &nbsp;&nbsp;&nbsp;<input type="submit" name="final" value="Final Sale" /></td></tr>
</table></font></td>
    </tr>
     <tr><td>
</td></tr>
</table>

</div><br/><br/>-->
<br /><br /><br />
<tr><td>
<table width="651" align="center">
<tr>
  <td width="305" height="31"><b>Sale's  Retrun Qty Detail's</b></td>
  <td width="26" height="31">&nbsp;&nbsp;</td>
  <td width="304" height="31"><b>Sold Qty Detail's</b></td>
</tr>
  
<tr>
  <td valign="top">
    <table width="100%" border="1" cellpadding="4" cellspacing="0">
      <tr>
        <th>Sr.No</th>
        <th>Item Code</th>
        <th>Return Qty</th>
        <th>Return Date</th>
        </tr>
      <?php
	$i=1;
	 $sql=mysql_query("SELECT * FROM  `return_qty` where bill_id='$cid'");
	 $num=mysql_num_rows($sql);
		if($num==0){
			$sql11=mysql_query("select * from approval_detail where bill_id='$cid' and return_qty<>0");
			while($row11=mysql_fetch_row($sql11)){?>
        <tr>
        	<td><font size="2" ><?php echo $i++; ?></font></td>
            <td><font size="2" ><?php echo $row11[1]; ?></font></td>
            <td><font size="2" ><?php echo $row11[4]; $sum+=$row11[4]; ?></font></td>
            <td></td>
        </tr>
		<?php }}else {
			
	while($rowb=mysql_fetch_row($sql)){?>
      <tr>
        <td><font size="2" ><?php echo $i++; ?></font></td>
        <td><font size="2" ><?php echo $rowb[4];?></font></td>
        <td><font size="2" ><?php echo $rowb[2]; $sum+=$rowb[2];?></font></td>
        <td><font size="2" ><?php if(isset($rowb[3]) and $rowb[3]!='0000-00-00') echo date('d/m/Y',strtotime($rowb[3]));  ?></font></td>
        </tr>
      <?php } }?>
      <tr><td colspan="2">Total Qty:</td><td><?php echo $sum; ?></td></tr>
    </table></td>
     <td width="26" height="31">&nbsp;&nbsp;</td>
    
    <td><table width="100%" border="1" cellpadding="4" cellspacing="0">
      <tr>
        <th>Sr.No</th>
        <th>Item Code</th>
        <th>Return Qty</th>
        <th>Bill Date</th>
      </tr>
      <?php
	$i2=1;
	
			$sql12=mysql_query("select * from approval_detail where bill_id='$cid' ");
			while($row12=mysql_fetch_row($sql12)){
				
				$to=$row12[2]-$row12[4];
				if($to==0){}else{ ?>
      <tr>
        <td><font size="2" ><?php echo $i2++; ?></font></td>
        <td><font size="2" ><?php echo $row12[1]; ?></font></td>
        <td><font size="2" ><?php echo $to; $sum1+=$to; ?></font></td>
        <td><font size="2"><?php if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2]));  ?></font></td>
      </tr>
     
			
	<?php } }?>
      <tr>
        <td colspan="2">Total Qty:</td>
        <td><?php echo $sum1; ?></td>
      </tr>
    </table>
    </td>
    </tr>
   
  </table>
  <div id="pageNavPosition"></div></td></tr></table>
</div>

</body>
</html>