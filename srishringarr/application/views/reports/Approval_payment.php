<?php
ini_set( "display_errors", 0);
include('config.php');
$cid=$_GET['cid'];
$amt=$_GET['amt'];
    

$qry="SELECT * FROM `phppos_people` WHERE `person_id`='$cid'";
$res=mysql_query($qry); 
$row=mysql_fetch_row($res);               
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
				
function formSubmit()
{
///alert("H");
if(document.getElementById('amt_date').value=="")
 {
alert("Please Select Payment Date to continue.");
document.getElementById('amt_date').focus();
return false;
}
else if(document.getElementById('amt').value=="")
 {
alert("Please Enter Amount to continue.");
document.getElementById('amt').focus();
return false;
}
else{
/////alert(v.value);
//document.listForm.command.value =v.value;
//document.listForm.submit( );
document.getElementById("subbutton").disabled=true;
document.getElementById("frm1").submit();
 return true;
 }

}
</script>
  <font size="+1"><center>
<a href="../../../index.php/reports" style="font-size:18px;font-weight:bold;">Back</a>&nbsp;&nbsp;&nbsp;<a href="#" style="font-size:18px;font-weight:bold;" onclick='PrintDiv();'>Print</a></center></font>
<div style="text-align: center;" id="bill">
 <form name="listForm" action="payment.php" method="post" id="frm1">
<table align="center"><tr><td width="853" align="center">
<img src="bill.PNG" width="408" height="165"/><br><br>
Customer Payment(Approval & Sales)<br/>
<br/></td></tr>
<tr><td align="center">

<table width="674" border="1" cellpadding="4" cellspacing="0">

<tr><td width="331" height="32">Customer Name:&nbsp;&nbsp;<b><?php echo $row[0]." ".$row[1]; ?></b></td>
<td width="321">Balance Amount: &nbsp;<b><?php echo $amt; ?></b></td>
</tr>
<tr>
 <td height="42" colspan="2">Payment Date:&nbsp;
   <input type="text"  name="amt_date" id="amt_date"  value="<?php echo date('d/m/Y'); ?>"/></td></tr>
<tr>
 <td height="42" colspan="2">Paid Amount:&nbsp;
   <input type="text"  name="amt" id="amt" /></td></tr>
    <td colspan="2">  Payment By : Cheque
	  <input name="pay_By" type="radio" value="Cheque" checked="checked">
        &nbsp;Cash
        <input name="pay_By" type="radio" value="Cash" ></td>
      </tr>
<tr><td>In Account</td><td><select id="acc" name='acc'><option value="0">Select </option>
      <?php 
      
      $qryitem=mysql_query("select bank_name, bank_id from banks");
       while($row=mysql_fetch_row($qryitem))
		 {
				echo "<option value='".$row[1]."'>".$row[0]."</option>";
			}?></select></td> </tr>


<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>"/>
<tr><td colspan="2"><input type="button" onClick="formSubmit()" name="Submit" id="subbutton" value="Add Payment" ></td></tr>
</table></td></tr></table></form>  </div>          