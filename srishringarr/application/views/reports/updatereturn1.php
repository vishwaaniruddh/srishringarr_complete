<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

       function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back, keeping the data secure. Please refresh this page to complete the transaction!";
			}
     </script>
<body id="bdy">

<div id="bill">

<?php
ini_set( "display_errors", 0);

include('config.php');
mysql_query("BEGIN;"); 
$qty11=$_POST['qty11'];
$prz=$_POST['qty'];
$cid=$_POST['id'];
$it=$_POST['it'];
$amt=$_POST['amt'];
$radio2=$_POST['radio2'];
$bill_date=$_POST['bill_date'];
$a=count($it);
$d=count($prz);
$pm=$_POST['command'];
 $j=1;
  $ramt=0;
 $sum=0;
$a1=0;
$totr=0;
echo $pm;
//
///if($pm=="Approval Return"){

	/////echo "submit";
////insert amount/////

if($amt=="" || $amt=="0"){$t1=true;}
else{
$t1=mysql_query("insert into `paid_amount`(bill_id,amount,return_date,payment_by) values('$cid','$amt',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$radio2')");
}
///echo "update approval set return_date=STR_TO_DATE('".$bill_date."','%d/%m/%Y'),paid_amount=paid_amount+$amt where bill_id='$cid'";


$sq3=mysql_query("select * from approval where cust_id='$cid' and status='A'  Order By bill_id DESC");

$sum1=$amt;

while($sqrow3=mysql_fetch_row($sq3)){
//echo $it[$i]."/ ".$sqrow[0]."/".$sqrow[1]."/".$sqrow[2]."/".$sqrow[3]."<br/>";
 $qry2="SELECT sum(paid_amount) FROM  `approval` where bill_id ='$sqrow3[0]'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry13="SELECT sum(`amount`) FROM `approval_detail` WHERE bill_id ='$sqrow3[0]'";
$res13=mysql_query($qry13);
$row13=mysql_fetch_row($res13);

$ss1=$row13[0]-$row2[0];
///echo  $row13[0]."/".$row2[0]."/".$ss1."/".$sqrow3[0]."hi<br/>";
if($amt=="" || $amt=="0"){$t2=true;$t3=true;}
else{
$aa=$ss1;

if($aa>$sum1){
////////echo $sum1."/".$sqrow3[0]."><br/>";
//echo "update approval set return_date=STR_TO_DATE('".$bill_date."','%d/%m/%Y'),paid_amount=paid_amount+$sum1 where bill_id='$sqrow3[0]'";

$t2=   mysql_query("update approval set paid_amount=paid_amount+$sum1 where bill_id='$sqrow3[0]'");
$t3=   mysql_query("update approval set `return_date` = STR_TO_DATE('".$bill_date."','%d/%m/%Y') where bill_id='$sqrow3[0]'"); 
  
 ////mysql_query("insert into `paid_amount`(bill_id,amount,return_date) values('$sqrow3[0]','$sum1',STR_TO_DATE('".$bill_date."','%d/%m/%Y'))"); 
 break;
 
}else{


$t2=  mysql_query("update approval set paid_amount=paid_amount+$aa where bill_id='$sqrow3[0]'");
$t3=    mysql_query("update approval set `return_date` = STR_TO_DATE('".$bill_date."','%d/%m/%Y') where bill_id='$sqrow3[0]'");
   
 //mysql_query("insert into `paid_amount`(bill_id,amount,return_date) values('$sqrow3[0]','$aa',STR_TO_DATE('".$bill_date."','%d/%m/%Y'))");
 ///echo "b amount:".$aa; 
 $sum1-=$aa;
///////////////echo "break=".$sum1."/ bill no=".$sqrow3[0]."<br/>";
 }
}



}

 $result = mysql_query("SELECT * FROM  `phppos_people` where person_id='$cid'");
	$row = mysql_fetch_row($result);

?>


<table width="787" border="0" align="center">
<tr>
    <td width="781" height="42">
    
    <table width="780" >
       <tr>
        <td colspan="3" align="center" style="padding-left:100px;">
          <font size="2">
            <B><U> <?php echo $by; ?> </U></B></font></td>
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
    <td height="21" colspan="2"><font size="3" >M/s.&nbsp;:&nbsp;&nbsp;<b><?PHP echo $row[0] . " ".$row[1]; ?></b></font></td><td width="128"><font size="2" >Date: </font><b><?php echo $bill_date; ?></b></td>
    </tr>
    
  <tr>
    <td colspan="2" height="23"><font size="3" >Address</font><font size="2" >.: &nbsp;&nbsp;&nbsp;
      <b><?php echo $row[4]; ?><br/><?php echo $row[6]; ?><?php echo $row[8]; ?>
      <?php echo $row[9]; ?></b></font></td>
    <td>&nbsp;</td></tr>
    <tr>
    <td><font size="3" >Contact No.: &nbsp;&nbsp;&nbsp; <b><?php echo $row[2]; ?></b></font></td><td width="290"></td></tr>
  </table><font size="2" >
    <table width="780" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
  <th width="101"><font size="2" >Sr. No.</font></th>
    <th width="118"><font size="2" >ITEM CODE</font></th>
    <!--<th width="130">PARTICULARS</th>-->

    <th width="193"><font size="2" >PRICE</font></th>
    <th width="326"><font size="2" >RETURN QTY</font></th>
   <th width="326"><font size="2" >RETURN AMOUNT</font></th>
     <th width="326"><font size="2" >BILL DATE</font></th>
    
  </tr>
  <?php 
 /////echo $a."<br/>";

  for($i=0;$i<$a;$i++)
{

$sq=mysql_query("SELECT bill_id,qty,return_qty,aid,amount FROM `approval_detail` WHERE item_id='$it[$i]' and  bill_id in (select bill_id from approval where cust_id='$cid' and status='A' ) Order By bill_id DESC");

$sum=$prz[$i];


while($sqrow=mysql_fetch_row($sq)){
	$perpiece=0;
	$bdate=mysql_query("select * from approval where bill_id='$sqrow[0]'");
	$blrow=mysql_fetch_row($bdate);
	
//echo $prz[$i]. " ".$it[$i]."hi";
	
$perpiece=$sqrow[4]/$sqrow[1];
$retamt=$perpiece*$sum;
$bal=$sqrow[1]-$sqrow[2];
//echo $bal."<br/>";
if($bal>$sum){
if($sum==0){$t4=true;$t5=true;}else{
		////echo "qty--".$sqrow[0]."<br/>";
$t4=  mysql_query("update approval_detail set return_qty=return_qty+$sum where aid='".$sqrow[3]."'");
$t5=  mysql_query("insert into `return_qty`(bill_id,qty,return_date,item_code) values('$sqrow[0]','$sum',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$it[$i]')");
 $bdate1=mysql_query("select * from approval_detail where bill_id='$sqrow[0]' and item_id='$it[$i]'");
	$blrow1=mysql_fetch_row($bdate1);
	$ramt= $blrow1[7];
	$am=$ramt/$sum;
	$ax=round(($ramt/$sum)*$blrow1[4]);
	$ax=round(($ramt/$blrow1[2])*$bal);
	$a1+=$ax;
	$qry12=mysql_query("SELECT * FROM  `phppos_items` where name='$it[$i]' ");
	$row12=mysql_fetch_row($qry12);
 ?>
  <tr>
  <td><font size="2" ><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><?php echo $it[$i]; ?></font></td>
    <!--<td align="center"><?php //echo $row1[1]; ?></td>-->
    <td align="center"><font size="2" ><?php echo $perpiece; //echo $row12[6]; ?></font></td>
    <td align="center"><font size="2" ><?php echo $sum; ?></font></td>
     <td align="center"><font size="2" ><?php echo $perpiece*$sum; $totr=$totr+$perpiece*$sum; ?></font></td>
      <td align="center"><font size="2" ><?php if(isset($blrow[2]) and $blrow[2]!='0000-00-00') echo date('d-m-Y',strtotime($blrow[2])); ?></font></td>
   


  </tr>
  <?php 
}
 break;
 
}else{
if($bal==0){$t4=true;$t5=true;}else{
		////echo "qty--".$sqrow[0]."AE<br/>";
		
$t4= mysql_query("update approval_detail set return_qty=return_qty+$bal where aid='".$sqrow[3]."'");
$t5=   mysql_query("insert into `return_qty`(bill_id,qty,return_date,item_code) values('$sqrow[0]','$bal',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$it[$i]')");
  
$bdate1=mysql_query("select * from approval_detail where bill_id='$sqrow[0]' and item_id='$it[$i]'");
	$blrow1=mysql_fetch_row($bdate1);
	$ramt= $blrow1[7];
	
	$ax=round(($ramt/$blrow1[2])*$bal);
	$a1+=$ax;
	//echo $blrow1[7]."/".$bal."/".$blrow1[4]."/".$a."<br/>";
?>
 <tr>
  <td><font size="2" ><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><?php echo $it[$i]; ?></font></td>
    <!--<td align="center"><?php //echo $row1[1]; ?></td>-->
    <td align="center"><font size="2" ><?php echo $perpiece;//echo $row12[6]; ?></font></td>
    <td align="center"><font size="2" ><?php echo $bal; ?></font></td>
     <td align="center"><font size="2" ><?php  echo $perpiece*$bal; $totr=$totr+$perpiece*$bal; ?></font></td>
        <td align="center"><font size="2" ><?php if(isset($blrow[2]) and $blrow[2]!='0000-00-00') echo date('d-m-Y',strtotime($blrow[2])); ?></font></td>
   
  </tr>	
	
<?php }
 $sum-=$bal;
 
 }
///echo $it[$i]."/ ".$prz[$i]."<br/>";
 

?>
 
 <?php 
}
//echo $prz[$i]. " ".$it[$i]."hello";
$t6= mysql_query("update `phppos_items` set quantity=quantity+$prz[$i] WHERE name='".$it[$i]."'");
}
//echo "update `phppos_items` set quantity=quantity+$prz[$i] WHERE name='".$it[$i]."'";
 ?>
  <tr>
  <td colspan="4" align="right"><font size="2" ><b>Total Qty : <?php echo $qty11; ?></b></font></td>
   <td align="center"><font size="2" ><b>Total Return Amount :</b><?php echo $totr; ?></font></td>
    <td align="center">&nbsp;</td>  
 </tr>
   <tr>
     <td colspan="3" align="left">
     <td colspan="3" align="left"><font size="2" ><b>Amount Paid : <?php echo "Rs.". $amt; ?> </b></font></td>
     <?php $aa=$total-$amt; 
    // echo $aa;
    ?>
  </tr>
     <tr><td colspan="8"> <font size="2" ><b>Payment By : <?php echo $radio2; ?></b></font></td></tr>
	
</table></font>

    
    </td>
    </tr>
     <tr><td>
  <hr/>
  <table width="784" border="0">
  <tr>
    <td width="419" valign="top"><ul>
      <li ><font size="2">Subject to Mumbai jurisdiction</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font size="2">E. & O . E</font></b></li>
      <li> <font size="2">Time 11 a.m. to 6 p.m.</font></li></ul></td>

    <td width="355" valign="top"align="right">
      <img src="shringaar.png" width="163" height="57"/>
      <br/><br/><br/>
      <font>Auth. Signatory</font>&nbsp;</td>
  </tr>
</table>

  </td></tr>
</table>

<?php
$t7=mysql_query("DELETE FROM `return_qty` WHERE qty=0");

//}
////final approval 
///else if($pm=="Final Approval Return") {

///echo "final";
/*
if($amt=="" || $amt=="0"){}
else{
mysql_query("insert into `paid_amount`(bill_id,amount,return_date,payment_by) values('$cid','$amt',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$radio2')");
}
///echo "update approval set return_date=STR_TO_DATE('".$bill_date."','%d/%m/%Y'),paid_amount=paid_amount+$amt where bill_id='$cid'";


$sq3=mysql_query("select * from approval where cust_id='$cid' and status='A' Order By bill_id DESC");

$sum1=$amt;

while($sqrow3=mysql_fetch_row($sq3)){
//echo $it[$i]."/ ".$sqrow[0]."/".$sqrow[1]."/".$sqrow[2]."/".$sqrow[3]."<br/>";
 $qry2="SELECT sum(paid_amount) FROM  `approval` where bill_id ='$sqrow3[0]'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry13="SELECT sum(`amount`) FROM `approval_detail` WHERE bill_id ='$sqrow3[0]'";
$res13=mysql_query($qry13);
$row13=mysql_fetch_row($res13);

$ss1=$row13[0]-$row2[0];
///echo  $row13[0]."/".$row2[0]."/".$ss1."/".$sqrow3[0]."hi<br/>";
if($amt=="" || $amt=="0"){}
else{
$aa=$ss1;

if($aa>$sum1){
/////////echo $sum1."/".$sqrow3[0]."final sale ><br/>";
//echo "update approval set return_date=STR_TO_DATE('".$bill_date."','%d/%m/%Y'),paid_amount=paid_amount+$sum1 where bill_id='$sqrow3[0]'";

    mysql_query("update approval set paid_amount=paid_amount+$sum1 where bill_id='$sqrow3[0]'");
   mysql_query("update approval set `return_date` = STR_TO_DATE('".$bill_date."','%d/%m/%Y') where bill_id='$sqrow3[0]'"); 
  
 ////mysql_query("insert into `paid_amount`(bill_id,amount,return_date) values('$sqrow3[0]','$sum1',STR_TO_DATE('".$bill_date."','%d/%m/%Y'))"); 
 break;
 
}else{
//////////////echo $aa."/".$sqrow3[0]."final sale ><br/>";

     mysql_query("update approval set paid_amount=paid_amount+$aa where bill_id='$sqrow3[0]'");
   mysql_query("update approval set `return_date` = STR_TO_DATE('".$bill_date."','%d/%m/%Y') where bill_id='$sqrow3[0]'");
 
 //mysql_query("insert into `paid_amount`(bill_id,amount,return_date) values('$sqrow3[0]','$aa',STR_TO_DATE('".$bill_date."','%d/%m/%Y'))");
 ///echo "b amount:".$aa; 
 $sum1-=$aa;
///echo "break=".$sum1."/ bill no=".$sqrow3[0]."<br/>";
 }
}

 

//
}
	
?>
<table width="787" border="0" align="center">
<tr>
    <td width="781" height="42">
    
    <table width="780" >
       <tr>
        <td colspan="3" align="center" style="padding-left:100px;">
          <font size="2">
            <B><U> <?php echo $by; ?> </U></B></font></td>
         </tr>            
  <tr>
  <td width="346" align="left" valign="top"><b>
    <p><font size="-1" >MANUFACTURERS AND RETAILERS</font>
      <font size="-1">OF BRIDAL SETS</font>,<br />
      <font size="-1">HAIR ACCESSORIES AND  BROOCHES,</font><br/>
      <font size="-1">BRIDAL DUPATTAS</font>,<br />
      <font size="-1">CHANIYA CHOLI,<br/>&amp; ALL KINDS OF ACCESSARIES.</font><br />
    </p></b></td>
    
    <td height="42" colspan="2" align="right" style="padding-left:10px;" valign="bottom"><img src="bill.png" width="408" height="165"/></td>
    </tr>
    
  <tr>
    <td colspan="2" ></td>
    </tr>
    
  <tr>
    <td height="21" colspan="2"><font size="3" >M/s.&nbsp;:&nbsp;&nbsp;<b><?PHP echo $row[0] . " ".$row[1]; ?></b></font></td><td width="128"><font size="2" >Date: </font><b><?php echo $bill_date; ?></b></td>
    </tr>
    
  <tr>
    <td colspan="2" height="23"><font size="3" >Address</font><font size="2" >.: &nbsp;&nbsp;&nbsp;
      <b><?php echo $row[4]; ?><br/><?php echo $row[6]; ?><?php echo $row[8]; ?>
      <?php echo $row[9]; ?></b></font></td>
    <td>&nbsp;</td></tr>
    <tr>
    <td><font size="3" >Contact No.: &nbsp;&nbsp;&nbsp; <b><?php echo $row[2]; ?></b></font></td><td width="290"></td></tr>
  </table><font size="2" >
    <table width="780" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
  <th width="101"><font size="2" >Sr. No.</font></th>
    <th width="118"><font size="2" >ITEM CODE</font></th>
    <!--<th width="130">PARTICULARS</th>-->

    <th width="193"><font size="2" >PRICE</font></th>
    <th width="326"><font size="2" >RETURN QTY</font></th>
   <th width="326"><font size="2" >RETURN AMOUNT</font></th>
     <th width="326"><font size="2" >BILL DATE</font></th>
    
  </tr>
  <?php 
  

  for($i=0;$i<$a;$i++)
{
$ab=0;
$sq=mysql_query("SELECT bill_id,qty,return_qty,aid FROM `approval_detail` WHERE item_id='$it[$i]' and  bill_id in (select bill_id from approval where cust_id='$cid' and status='A' ) Order By bill_id DESC");

$sum=$prz[$i];

while($sqrow=mysql_fetch_row($sq)){
	
	$bdate=mysql_query("select * from approval where bill_id='$sqrow[0]'");
	$blrow=mysql_fetch_row($bdate);
	

	
//echo $it[$i]."/ ".$sqrow[0]."/".$sqrow[1]."/".$sqrow[2]."/".$sqrow[3]."<br/>";
$bal=$sqrow[1]-$sqrow[2];
//echo $bal."<br/>";
if($bal>$sum){
if($sum==0){}else{
		///echo "qty--".$sqrow[0]."<br/>11";
		$ab=$sqrow[0];
  mysql_query("update approval_detail set return_qty=return_qty+$sum where aid='".$sqrow[3]."'");
  mysql_query("insert into `return_qty`(bill_id,qty,return_date,item_code) values('$sqrow[0]','$sum',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$it[$i]')");
 $bdate1=mysql_query("select * from approval_detail where bill_id='$sqrow[0]' and item_id='$it[$i]'");
	$blrow1=mysql_fetch_row($bdate1);
	$ramt= $blrow1[7];
	$am=$ramt/$sum;
	$a=round(($ramt/$sum)*$blrow1[4]);
	$a=round(($ramt/$blrow1[2])*$bal);
	$a1+=$a;
 ?>
  <tr>
  <td><font size="2" ><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><?php echo $it[$i]; ?></font></td>
    <!--<td align="center"><?php //echo $row1[1]; ?></td>-->
    <td align="center"><font size="2" ><?php echo $row12[6]; ?></font></td>
    <td align="center"><font size="2" ><?php echo $sum; ?></font></td>
     <td align="center"><font size="2" ><?php echo $blrow1[7]; ?></font></td>
      <td align="center"><font size="2" ><?php if(isset($blrow[2]) and $blrow[2]!='0000-00-00') echo date('d-m-Y',strtotime($blrow[2])); ?></font></td>
   


  </tr>
  <?php 
}
 break;

 
}else{
if($bal==0){}else{
		////echo "qty--".$sqrow[0]."q<br/>";
		///echo "update satuts ".$sqrow[0]."final sale ><br/>";
		$ab=$sqrow[0];
 mysql_query("update approval_detail set return_qty=return_qty+$bal where aid='".$sqrow[3]."'");
  mysql_query("insert into `return_qty`(bill_id,qty,return_date,item_code) values('$sqrow[0]','$bal',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$it[$i]')");
  
$bdate1=mysql_query("select * from approval_detail where bill_id='$sqrow[0]' and item_id='$it[$i]'");
	$blrow1=mysql_fetch_row($bdate1);
	$ramt= $blrow1[7];
	
	$a=round(($ramt/$blrow1[2])*$bal);
	$a1+=$a;
	//echo $blrow1[7]."/".$bal."/".$blrow1[4]."/".$a."<br/>";
?>
 <tr>
  <td><font size="2" ><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><?php echo $it[$i]; ?></font></td>
    <!--<td align="center"><?php //echo $row1[1]; ?></td>-->
    <td align="center"><font size="2" ><?php echo $row12[6]; ?></font></td>
    <td align="center"><font size="2" ><?php echo $bal; ?></font></td>
     <td align="center"><font size="2" ><?php echo $a; ?></font></td>
        <td align="center"><font size="2" ><?php if(isset($blrow[2]) and $blrow[2]!='0000-00-00') echo date('d-m-Y',strtotime($blrow[2])); ?></font></td>
   
  </tr>	
	
<?php }
 $sum-=$bal;
 
 }
///echo $ab."UP<BR/>";
 
  mysql_query("update approval set status='S' where bill_id='$ab'");
  
  




?>
 
 <?php 
}
 mysql_query("update `phppos_items` set quantity=quantity+$prz[$i] WHERE name='".$it[$i]."'");
}
 ?>
  <tr>
  <td colspan="4" align="right"><font size="2" ><b>Total Qty : <?php echo $qty11; ?></b></font></td>
   <td align="center"><font size="2" ><b>Total Return Amount :</b><?php echo $a1; ?></font></td>
    <td align="center">&nbsp;</td>  
 </tr>
   <tr>
     <td colspan="3" align="left">
     <td colspan="3" align="left"><font size="2" ><b>Amount Paid : <?php echo "Rs.". $amt; ?> </b></font></td>
     <?php $aa=$total-$amt; 
    // echo $aa;
    ?>
  </tr>
     <tr><td colspan="8"> <font size="2" ><b>Payment By : <?php echo $radio2; ?></b></font></td></tr>
	
</table></font>

    
    </td>
    </tr>
     <tr><td>
  <hr/>
  <table width="784" border="0">
  <tr>
    <td width="419" valign="top"><ul>
      <li ><font size="2">Subject to Mumbai jurisdiction</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font size="2">E. & O . E</font></b></li>
      <li> <font size="2">Time 11 a.m. to 6 p.m.</font></li></ul></td>

    <td width="355" valign="top"align="right">
      <img src="shringaar.png" width="163" height="57"/>
      <br/><br/><br/>
      <font>Auth. Signatory</font>&nbsp;</td>
  </tr>
</table>

  </td></tr>
</table>




<?php */
///} 
 ?>

</div><br/><br/><div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../../index.php/reports">Back</a></center>

</body>
</html><?php 
if($t1 && $t2 && $t3 && $t4 && $t5 && $t6 && $t7){
	mysql_query("COMMIT;");
	}
	else{
		mysql_query("ROLLBACK;");
		echo "<script> rollback(); </script>";
		}
?>