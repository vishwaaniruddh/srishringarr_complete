<div id="not" align="center"></div>
<?php
include("config.php");
//session_start();
 $patientid=$_GET['pid'];
 $id=$_GET['id'];
 $packidme=$_GET['packidme'];
 $dtme=$_GET['dtme'];


//echo "select * from patient where srno='".$patientid."'";
$qry=mysql_query("select * from patient where srno='".$patientid."'");
$row=mysql_fetch_row($qry);

//echo "select * from patient_package where patientid='".$patientid."' and id='".$packidme."' order by id DESC limit 1";

$qry2=mysql_query("select * from patient_package where patientid='".$patientid."' and id='".$packidme."' order by id DESC limit 1");
$row2=mysql_fetch_row($qry2);


//echo "select * from opd_collection where id='".$id."'";

$collect=mysql_query("select * from opd_collection where id='".$id."'");
$collectro=mysql_fetch_row($collect);

//echo "select sum(amt) from opd_collection where patientid='".$patientid."' and date<='".$collectro[3]."' and packid='".$packidme."'";
$collect2=mysql_query("select sum(amt) from opd_collection where patientid='".$patientid."' and packid='".$packidme."'");
$collectamt=mysql_fetch_row($collect2);

//echo "select * from opd_collection where patientid='".$patientid."'and date<='".$collectro[3]."' and packid='".$packidme."'";
$qrydet=mysql_query("select * from opd_collection where patientid='".$patientid."' and packid='".$packidme."'");


?>

<style>
h1,h2,h3{text-align:center; vertical-align:top; background-color:transparent; color:#000;}

h6 strong{text-align:center; position:absolute; clear:both;}
p {text-align:center; font-size:14px; background-color:transparent; color:#000;}


table{border:px solid #F00; width:90%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:1px solid #333; padding:5px; }

.td_bg_col{ }
img{}
p span{font-size:12px;}
/*th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}*/

ul{display:block;}
ul li{list-style:decimal; list-style-position:inside;}
</style>
<script>
function printpage()
{
window.print();
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
@media print {
#print_div {
display:block;
}
#not {
display:none;
}
#nottoprint {
display:none;
}

}
td
{
text-align:left;
}
</style>

 


   <!-- <h2><strong>Bill / Receipt</strong></h2>-->
<form method="post" action="process_patreceipt_edit.php"/>
<div id="print_div">

<table>
    <thead>
     <tr>
     <th colspan="6"><h1>DR. RAIS HEALTH CARE PVT. LTD.</h1></th>
     </tr>
     
   
     <?php
	 if (0 === strpos($patientid, 'B-'))
	 {?>
     <tr>
     <th colspan="6"><b>SHOP NO-103, GANJAWALA ELEGANCE , GANJAWALA LANE , ABOVE PUNJAB NATIONAL BANK, BORIVALI-WEST, MUMBAI-400092.<br /> TEL. NO.-022-65670700/022-28901790</b></th>
    <?php
	 }
	 else
	 {?>
		  <th colspan="6"><b>LINK ROAD, MALAD-WEST, MUMBAI<br /> TEL. NO.-022-65670700/022-28901790</b></th>
     <?php
	 }?>
     </tr>
     </thead>
     <tbody>
    
    
        <tr>
            <td colspan="4" class="td_bg_col" >
                <p>
                    <b>Bill No. :<?php echo $row2[0];?><br>
                
                    Patient Name : <?php echo $row[6]; ?>.<br>
                
                   Address : <?php echo $row[20]; ?></b>
                   
                    
                </p>
            </td>
            <td class="td_bg_col" colspan="2" >
                <p>
                   <strong>Date : <?php echo date("Y-m-d",strtotime($collectro[3])); ?></strong><br>
                
                    <strong>Doctor Name :Dr. Rai</strong>
                </p>
            </td>
        </tr>
        
        
        <tr>
            <td colspan="6" class="td_bg_col" >
               
                    <p><strong>Patient code : <?php echo $patientid; ?></strong></p>
               
            </td>
        </tr>
        <tr>
           <td colspan="6" class="td_bg_col" >
               
                    <p><strong>Ailment/Problems : <?php echo $collectro[8]; ?></strong></p>
               
            </td>
        </tr>
        <tr>
            <td  colspan="5"  >
                <p>
                    <strong>Bill Particulars </strong>
                </p>
            </td>
            <td   >
                <p>
                    <strong>Amount (Rs.)</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td  colspan="5" >
                <p>
                    <strong>Being Membership fees for Professional Consultation charges for Treatment of Miscellaneous<br> From <?php 
					//echo "date=".$row[4];
					echo date("d/m/Y",strtotime($row2[3])); ?> to <?php echo date("d/m/Y",strtotime($row2[4])); ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong>Rs.<?php echo $row2[6]; ?>/-</strong>
                </p>
            </td>
        </tr>
        
        
        <tr>
            <td colspan="5" >
                <p>
                    <strong>Net Bill amount</strong>
                </p>
            </td>
            <td >
                <p>
                    <strong>Rs.<?php echo $row2[6]; ?>/-</strong>
                </p>
            </td>
        </tr>

<tr>
            <td  colspan="6">
                <p>
                    <strong>RUPEES: <?php require('numtowords.php');

   echo convert_number_to_words($row2[6]);?> only.</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <p>
                    <strong>Receipt Particulars Amount (Rs.)</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="td_bg_col" >
                <p>
                    <strong>Membership Fees </strong>
                </p>
            </td>
            
        </tr>
        <tr>
            <td >
                <p>
                    <strong>Receipt No.</strong>
                </p>
            </td>
            <td>
                <p>
                    <strong>Date of Payment</strong>
                </p>
            </td>
            <td >
                <p>
                    <strong>Payment Mode / Date of Cheque</strong>
                </p>
            </td>
            <td >
                <p>
                    <strong>Amount</strong>
                </p>
            </td>
            <td >
                <p>
                    <strong>Description</strong>
                </p>
            </td>
            <td>
                <p>
                   <!-- <strong>Rs<?php echo $row2[6]; ?>./-</strong>-->
                </p>
                
            </td>
        </tr>

<?php
	$i=0;
   while($detres=mysql_fetch_row($qrydet))
   {
      //echo "Select * from paydetails where payid='".$detres[0]."'";
  $chkdet=mysql_query("Select * from paydetails where payid='".$detres[0]."'");
   $chkres=mysql_fetch_row($chkdet);
      
?>
        <tr>
            <td>
                <p>
                   <?php
                  $dtc=date('Y');

                 $dtx=date('Y', strtotime('+1 year'));
                  $dtxx=substr($dtx, -2);
                 // echo $dtx; 
                  ?>
                  <strong><?php echo $dtc."-".$dtxx." / ".$detres[0];?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo date("d/m/Y",strtotime($detres[3])); ?></strong>
                </p>
            </td>
            <td>
          <p>
       <?php
        if($detres[7]=="Cheque")
       {?>
         <strong><?php echo $detres[7]."(".$chkres[3].")"." / ".$chkres[5]; ?></strong>
        <?php
        }
       else
        {?>
        <strong><?php echo $detres[7]; ?></strong>
         <?php
        }?>
                </p>
                
            </td>
            <td>               
                <input type="text" name="amt_<?php echo $detres[0]; ?>" id="amt_<?php echo $detres[0]; ?>" value="<?php echo $detres[2];?>" />
                <input type="hidden" name="amt1_<?php echo $detres[0]; ?>" id="amt1_<?php echo $detres[0]; ?>" value="<?php echo $detres[2];?>" />
                <input type="hidden" name="opdid[]" id="opdid_<?php echo $i; ?>" value="<?php echo $detres[0];?>" />
            </td>
            <td>
                <p>
                    <strong>PAID</strong>
                </p>
            </td>
            <td>
                <p>
                    <strong></strong>
                </p>
            </td>
            
        </tr>
<?php
$i++;
}
?>




<tr>
            <td>
                <p>
                    
                </p>
            </td>
            <td>
                <p>
                    
                </p>
            </td>
            <td>
          <p>
               <strong>Toatal Paid Amount</strong>
                </p>
                
            </td>
            <td>
                <p>
                      <strong>
                    <?php
					$paidx=$collectamt[0];
					echo $paidx;
					?>                    /-</strong>
                    
                </p>
            </td>
            <td>
                <p>
                    
                </p>
            </td>
            <td>
                <p>
                    
                </p>
            </td>
            
        </tr>



<tr>
            <td colspan="6">
                <p>
                    <strong>Total Paid (RUPEES) : <?php //require('numtowords.php');
//echo $paidamt;
   echo convert_number_to_words($paidx);?> only.</strong>
                </p>
            </td>
            
        </tr>





     


        <tr>
            <td colspan="5">
                <p>
                    <strong>Balance Amount</strong>
                </p>
            </td>
            <td>
                <p>
                    <strong>Rs.
                    <?php
					$bal=($row2[6]-($collectamt[0]));
					echo $bal;
					?>                    /-</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <p>
                    <strong>RUPEES : <?php //require('numtowords.php');
//echo $paidamt;
   echo convert_number_to_words($bal);?> only.</strong>
                </p>
            </td>
            
        </tr>
        
        
    </tbody>
</table>
<input type="submit" value="Edit"/>
</div>
</form>