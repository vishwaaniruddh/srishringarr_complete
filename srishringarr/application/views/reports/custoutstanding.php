<?php
ini_set( "display_errors", 0);
include('config.php');

 $total2=0;     

$qry="SELECT * FROM `phppos_people` WHERE `person_id` not in (SELECT `person_id` FROM `phppos_suppliers` )  ORDER BY `phppos_people`.`first_name` ASC";
$res=mysql_query($qry);                
$num=mysql_num_rows($res);
				 				 
?>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           divToPrint.style.fontSize = "10px";
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
  <font size="+1"><center>
<a href="../../../index.php/reports" style="font-size:18px;font-weight:bold;">Back</a>&nbsp;&nbsp;&nbsp;<a href="#" style="font-size:18px;font-weight:bold;" onclick='PrintDiv();'>Print</a></center></font>

<div style="text-align: center;" id="bill">

<table align="center"><tr><td width="853" align="center">
<img src="bill.PNG" width="408" height="165"/><br><br>

Customer Balance Amount Report(Approval & Sales)<br/>
<br/></td></tr>
<tr><td>
<form name="frm1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table><tr><td>
From Date (dd/mm/yyyy): <input type="text" name="frmdt" id="frmdt"></td><td>
To Date (dd/mm/yyyy): <input type="text" name="todt" id="todt"></td><td><input type="submit" name="cmdsub" value="submit"></td></tr></table>
</form></td></tr>
<tr><td>
<table  border="1" cellpadding="4" cellspacing="0" width="881" align="left" id="bill">
 <tr>
 <th width='43' height="34"><U>Sr.No.</U></th>
    
    <th width='208'><u>Customer Name</u></th>
    <th width='73'><u>Mobile No.</u></th>
   
    <th width='217'><U>Net Amount</U></th>
     <!--<th width='217'><U>Payment</U></th>-->
  </tr>
<?php 
$i=1;
$frmdt=date('Y-m-d');
$todt=date('Y-m-d');
if(isset($_POST['frmdt']) && isset($_POST['todt'])){
$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['frmdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
}


while($row = mysql_fetch_row($res)) 
 {
 ///echo $row[11]."<br/>";
 $sum=0;

$qry1="SELECT * FROM  `approval` where cust_id='$row[11]' and bill_date between($frmdt and $todt)";
echo $qry1;
$res1=mysql_query($qry1);                
$num1=mysql_num_rows($res1);
while($row1=mysql_fetch_row($res1)){

$pd=0;
 $s1=0;			

$ba=0;
$na=0;	
$ra=0;

$qry2="SELECT sum(paid_amount) FROM  `approval` where bill_id ='$row1[0]'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry3="SELECT sum(`amount`) FROM `approval_detail` WHERE bill_id ='$row1[0]'";
$res3=mysql_query($qry3);
$row3=mysql_fetch_row($res3);
$a=0;
$a1=0;
$qry4="SELECT *  FROM `approval_detail` WHERE bill_id ='$row1[0]'";
$res4=mysql_query($qry4);
	

while($row4=mysql_fetch_row($res4)){

$a=round(($row4[7]/$row4[2])*$row4[4]);
$a1+=$a;
//echo $row4[7]."/".$row4[2].")*".$row4[4]."=".$a1."<br/>";

//echo "c-".$row[11]."pd-".$row2[0]."bll-".$row1[0]."/".$a1."k<br/>";
$ba+=$row4[7];
}


$na=$ba;
$s1=($ba-$a1);
//echo "cust=".$row[11]." amt=".$ba." bal amt=".$na." return".$a1." net amt=".$s1."<br/>";

$s=$row3[0]-$row2[0];
 $sum+=$s1;  
}
//echo "paid=".$pd."<br/>";

 $qry41="SELECT sum(amount) FROM `paid_amount` WHERE `bill_id`='$row[11]'";
$res41=mysql_query($qry41);
$num411=mysql_num_rows($res41);
$row41=mysql_fetch_row($res41);
///echo $id."/".$num411."<br/>";

 $qry42="SELECT SUM( paid_amount ) FROM  `approval` WHERE  `cust_id` ='$row[11]'";
$res42=mysql_query($qry42);
$row42=mysql_fetch_row($res42);

if($num41==0 || $num41=="") { $pd11=$row42[0]; }else{  $pd11=$row41[0]; }
////echo "Cust=".$row[11]."/".$sum."-".$pd11."<br/>";
$ab=$sum-$pd11;

?>				   
<tr>

<td width="43"><?php echo $i; ?></td>

<td width="208" align="left"><?php echo $row[0]." " .$row[1]; ?></td>
<td width="73"> <?php echo $row[2]; ?></td>

<td width='217'><?php echo "Rs. ".$ab."/-";  ?></td>
<td width='60'  align="right"><a href="Approval_payment.php?cid=<?php echo $row[11]; ?>&amt=<?php echo $ab; ?>"><b>Payment</b></a></td>
 </tr>
<?php $i++; $total2+=$ab;   } ?>
<tr>
<td width="43"></td>
<td width="208" align="center" colspan="2"></td>
<td width='60'  align="right"><b>Total Amount: <?php echo "Rs. ".$total2."/-"; ?></b></td>

 </tr>			
</table>
		  
   
   </td></tr></table>  </div>          