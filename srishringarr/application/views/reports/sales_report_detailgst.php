<?php

include('config.php');
$id=$_GET['id'];

//echo "SELECT * FROM  `approval` where bill_id='$id'";
$result1 = mysql_query("SELECT * FROM  `approval` where bill_id='$id'");
 $rowordno = mysql_fetch_array($result1);
 
 $statetype=$rowordno['statetyp'];
 //echo "okl".$statetype;
 
 $result = mysql_query("SELECT * FROM  `phppos_people` where person_id='$rowordno[1]'");
	$row = mysql_fetch_row($result);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHRINGAAR</title>
</head>

<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

         function PrintDiv1() {    
           var divToPrint = document.getElementById('bill1');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
				 function PrintDiv2() {    
           var divToPrint = document.getElementById('sold');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<body>

<div id="bill">
<table width="787" border="0" align="center">
<tr>
    <td width="781" height="42">
    
    <table width="780" >
       <tr>
        <td colspan="3" align="center" style="padding-left:100px;">
          <font size="2">
            <B><U> <?php echo $rowordno[8]; ?> </U></B></font></td>
         </tr>            
  <tr>
  <td width="346" align="left" valign="top"><b>
    <p><font size="-1" >MANUFACTURERS AND RETAILERS</font>
      <font size="-1">OF BRIDAL SETS</font>,<br />
      <font size="-1">HAIR ACCESSORIES AND  BROOCHES,</font><br/>
      <font size="-1">BRIDAL DUPATTAS</font>,<br />
      <font size="-1">CHANIYA CHOLI,<br/>&amp; ALL KINDS OF ACCESSARIES.</font><br />
    </p></b></td>
    
    <td height="42" colspan="2" align="right" style="padding-left:10px;" valign="bottom"><img src="bill.PNG" width="408" height="165"/></td>
    </tr>
    
  <tr>
    <td colspan="2" ></td>
    </tr>
    
  <tr>
    <td height="21" colspan="2"><font size="2" >M/s.&nbsp;:&nbsp;&nbsp;<b><?PHP echo $row[0] . " ".$row[1]; ?></b></font></td><td width="128">Date: <b><?php  if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2])); ?></b></td>
    </tr>
    
  <tr>
    <td colspan="2" height="23"><font size="2" >Address</font><font size="2" >.: &nbsp;&nbsp;&nbsp;
      <b><?php echo $row[4]; ?><br/><?php echo $row[6]; ?><?php echo $row[8]; ?>
      <?php echo $row[9]; ?></b></font></td>
    <td>Bill No:<b><?php echo $rowordno[0]; ?></b></td></tr>
    <tr>
    <td><font size="2" >Contact No.: &nbsp;&nbsp;&nbsp; <b><?php echo $row[2]; ?></b></font></td><td width="290"></td></tr>
  </table><font size="2" >
    <table width="780" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
  <th width="58"><font size="2" >SR. NO.</font></th>
    <th width="123"><font size="2">ITEM CODE</font></th>
    <th width="89"><font size="2" >PARTICULARS</font></th>

    <th width="72"><font size="2">PRICE</font></th>
    <th width="61"><font size="2">QTY</font></th>
    <th width="93"><font size="2">AMOUNT</font></th>
     <th width="86"><font size="2">DISCOUNT</font></th>
     <?php if($statetype=="1"){  ?><th width="112" ><font size="2" >GST %</font></th><?php } ?>
    <?php if($statetype=="1"){  ?><th width="112" ><font size="2" >SGST AMT</font></th><?php }  ?>
    <th width="112"  style="display:none;"><font size="2" >CGST %</font></th>
    <?php if($statetype=="1"){ ?><th width="112"  ><font size="2" >CGST AMT</font></th><?php }  ?>
    <?php if($statetype=="2"){ ?><th width="112" ><font size="2" >IGST %</font></th><?php } ?>
    <?php if($statetype=="2"){ ?><th width="112" ><font size="2" >IGST AMT</font></th> <?php } ?>
     <th width="116"><font size="2">Total Amount</font></th>
    
  </tr>
  <?php
   $s2=0;
   $k=1;
  $sql2=mysql_query("SELECT * FROM  `approval_detail` where bill_id='$id'");
while($row2=mysql_fetch_array($sql2)){ 
$sq="SELECT * FROM phppos_items WHERE name='$row2[1]'";
$res2 = mysql_query($sq);
$num2=mysql_num_rows($res2);
$row1=mysql_fetch_row($res2);
if($row1[6]==""){
	$p=round(($row2[6]+$row2[7])/$row2[2]);
	$pz=$p.".00";
	//echo $pz."<br/>";
}else {
$pz=$row1[6];
}

$s=$row2[2]*$pz;
  ?>
  <tr>
  <td align="center"><font size="2" ><?php echo $k++; ?></font></td>
    <td align="center"><font size="2" ><?php if($row1[0]==""){ echo $row2[1]; }else { echo $row1[0]; } ?></font></td>
    <td align="center"><font size="2" ><?php echo $row1[1]; ?></font></td>
    <td align="center"><font size="2" ><?php echo $pz; ?></font></td>
    <td align="center"><font size="2" ><?php echo $row2[2]; ?></font></td>
      <td align="center"><font size="2" ><?php echo $s-$row2['cgstamt']-$row2['sgstamt']-$row2['igstamt'];  ?></font></td>
    <td align="center"><font size="2" ><?php echo $row2[6];
   ?></font></td>
   
       <?php if($statetype=="1"){ ?><td align="center"><font size="2" ><?php echo $row2['gstpec']; ?></font></td><?php } ?>
    <?php if($statetype=="1"){ ?><td align="center" ><font size="2" ><?php echo $row2['sgstamt']; ?></font></td><?php } ?>
    <td align="center" style="display:none;" ><font size="2" ><?php echo $row2['cgstperc']; ?></font></td>
    <?php if($statetype=="1"){ ?> <td align="center" ><font size="2" ><?php echo $row2['cgstamt']; ?></font></td><?php } ?>
    <?php if($statetype=="2"){ ?><td align="center" ><font size="2" ><?php echo $row2['igstperc']; ?></font></td><?php } ?>
    <?php if($statetype=="2"){ ?><td align="center" ><font size="2" ><?php echo $row2['igstamt']; ?></font></td><?php } ?>

   
     <td align="center"><font size="2" ><?php echo $row2[7]; $s2+=$row2[7];?></font></td>
  </tr>
  <?php $total+=$row2[7]; 
  $totalq+=$row2[2]; 
  }  
  $sum=0; 
  $sum4=0;?>
  


  <tr>
  <td colspan="4" align="right"><font size="2" ><b>Total Quantity: <?php echo $totalq; ?></b></font></td>
    <td colspan="3" align="right"><font size="2" ><b>Gross Total: <?php echo "Rs.". $s2; ?> </b></font></td>
  <td colspan="4" align="right"><b><font size="2">Net Payable : <?php echo "Rs.". $total; ?></font> </b></td></tr>
   <tr>
   
     <td colspan="3" align="left"><font size="2" ><b>Date: 
       <?php  if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2])); ?></b></font>
           <td colspan="3" align="left"><font size="2" ><b>Amount Paid : <?php echo "Rs.". $rowordno[4]; ?> </b></font></td>
     <?php $aa=$total-$rowordno[4]; 
    // echo $aa;
    ?>
     <td colspan="11" align="center"><font size="2" ><b>Balance : <?php echo "Rs.".$aa; ?> </b></font></td></tr>
	 <tr>
	 <td colspan="11"><font size="2" ><b>Note : <?php echo $rowordno[11]; ?></b></font>
	 </td>
	 </tr>
</table></font>

    
    </td>
    </tr>
     <tr><td>
  <hr/>
  <table width="784" border="0">
  <tr>
    <td width="419" valign="top"><ul>
      <li ><font>Subject to Mumbai jurisdiction</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>E. & O . E</b></li>
      <li> <font>Time 11 a.m. to 6 p.m.</font></li></ul></td>
    <td width="355" valign="top"align="right">
      <img src="shringaar.png" width="163" height="57"/>
      <br/><br/><br/>
      <font>Auth. Signatory</font>&nbsp;</td>
  </tr>
</table>

  </td></tr>
</table>

</div><br/><br/><div id="pageNavPosition"></div>
<center>
  <a href="#" onclick='PrintDiv();'>Print Bill </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../../index.php/reports">Back</a>
</center><br /><br />
<div id="bill1">
<table align="center">
<tr>
<td width="530" valign="top">
<table width="538" border="1" cellpadding="4" cellspacing="0">
	<tr>
    	<td colspan="4">Approval Return Quantity Details</td>
    </tr>
    <tr>
    	<td width="73">Sr. No.</td>
        <td width="133">Item Code</td>
        <td width="126">Return Quantity</td>
        <td width="156">Return Date</td>
          <td width="156">Return Amount</td>
    </tr>
    <?php
		$i=1;
		$sql="select * from return_qty where bill_id='$id'";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		if($num==0){
			$sql11=mysql_query("select * from approval_detail where bill_id='$id' and return_qty<>0");
			while($row11=mysql_fetch_row($sql11)){
				$amt=($row11[7]/$row11[2])*$row11[4];
				?>
        <tr>
        	<td><font size="2" ><?php echo $i++; ?></font></td>
            <td><font size="2" ><?php echo $row11[1]; ?></font></td>
            <td><font size="2" ><?php echo $row11[4]; $sum+=$row11[4]; ?></font></td>
            <td><font size="2" ><?php echo date('d/m/Y',strtotime($row[3])); ?></font></td>
             <td><font size="2" ><?php echo $amt; $sum4+=$amt1; ?></font></td>
            <td></td>
        </tr>
		<?php }
		}else{
		while($row=mysql_fetch_row($result)){
			
			$sqlret=mysql_query("select * from approval_detail where bill_id='$id' and item_id='$row[4]'");
			$rowret=mysql_fetch_row($sqlret);
			$amt1=($rowret[7]/$rowret[2])*$row[2];
			
			?>
        <tr>
        	<td><font size="2" ><?php echo $i++; ?></font></td>
            <td><font size="2" ><?php echo $row[4]; ?></font></td>
            <td><font size="2" ><?php echo $row[2]; $sum+=$row[2];?></font></td>
            <td><font size="2" ><?php echo date('d/m/Y',strtotime($row[3])); ?></font></td>
            <td><font size="2" ><?php echo $amt1; $sum4+=$amt1; ?></font></td>
        </tr>
		<?php }}
	?>
    <tr><td colspan="2" align="right">Total Qty : </td><td><?php echo $sum; ?></td>
    <td colspan="2" align="right">Total Amount : <?php echo $sum4; ?></td>
    </tr>
</table>


<!--
<table width="468" border="1" cellpadding="4" cellspacing="0">
	<tr>
    	<td colspan="4">Approval Return Paid Amount Details</td>
    </tr>
    <tr>
    	<td width="120">Sr. No.</td>
        <td width="171">Amount</td>
        <td width="161">Return Date</td>
    </tr>
    <?php
		$i1=1;
		$sql3="select * from paid_amount where bill_id='$id'";
		$result3=mysql_query($sql3);
		
		while($row3=mysql_fetch_row($result3)){?>
        <tr>
        	<td><?php echo $i1++; ?></td>
            <td><?php echo $row3[2]; ?></td>
            <td><?php echo date('d/m/Y',strtotime($row3[3])); ?></td>
        </tr>
		<?php }$sum1=0; $sum2=0;
	?>
</table>-->
</td>
</tr>
</table>
</div>
<br/><center>
  <a href="#" onclick='PrintDiv1();'>Print Approval Return</a><br/><br/>
  <div id="sold">
  <table width="59%" border="1" cellpadding="4" cellspacing="0">
  <tr>
    	<td colspan="4">Sold Quantity Details</td>
    </tr>
    <tr>
      <th>Sr.No</th>
      <th>Item Code</th>
      <th>Return Qty</th>
      <th>Bill Date</th>
      <th>Amount</th>
    </tr>
    <?php
	$i2=1;
	
			$sql12=mysql_query("select * from approval_detail where bill_id='$id'");
			while($row12=mysql_fetch_row($sql12)){
				
				$to=$row12[2]-$row12[4];
				if($to==0){}else{ 
					$amt2=($row12[7]/$row12[2])*$to;
				?>
    <tr>
      <td><font size="2" ><?php echo $i2++; ?></font></td>
      <td><font size="2" ><?php echo $row12[1]; ?></font></td>
      <td><font size="2" ><?php echo $to; $sum1+=$to; ?></font></td>
      <td><font size="2">
        <?php if(isset($rowordno[2]) and $rowordno[2]!='0000-00-00') echo date('d/m/Y',strtotime($rowordno[2]));  ?>
      </font></td>
        <td><font size="2" ><?php echo $amt2;  $sum3+=$amt2;?></font></td>
    </tr>
    <?php } }?>
    <tr>
      <td colspan="2">Total Qty:</td>
      <td><?php echo $sum1; ?></td>
       <td colspan="2" align="right">Total Amount : <?php echo $sum3; ?></td>
    </tr>
  </table>
  </div>
<a href="#" onclick='PrintDiv2();'>Print Sold Quantity</a>
</center>


</body>
</html>