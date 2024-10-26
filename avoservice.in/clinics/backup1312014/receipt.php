<?php
include("config.php");
session_start();
 $patientid=$_POST['patientid'];
 $date=$_POST['date'];
 $paidamt=$_POST['amt'];
$mode=$_POST['mode'];
$date=str_replace("/","-",$date);
$qry=mysql_query("select * from patient where srno='".$patientid."'");
$row=mysql_fetch_row($qry);
//echo "select * from patient_package where patientid='".$patientid."' order by id DESC limit 1";
$qry2=mysql_query("select * from patient_package where patientid='".$patientid."' order by id DESC limit 1");
$row2=mysql_fetch_row($qry2);
/*if(!$qry2)
echo "failed".mysql_error();*/
/*$pay=mysql_query("select * from ".$cid."_bank_accounts where id='".$row2[7]."'");
$paymode=mysql_fetch_row($pay);*/
//echo "select sum(amt) from opd_collection where patientid='".$patientid."'";
$collect=mysql_query("select sum(amt) from opd_collection where patientid='".$patientid."'");
$collectamt=mysql_fetch_row($collect);
//echo "amt=".$collectamt[0];
?>
<style>
h1,h2,h3,h6,h5{text-align:center; vertical-align:top;}
p {text-align:left; font-size:14px;}
div p{text-align:center;}

table{border:px solid #F00; width:70%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:1px solid #333; padding:5px; }

.td_bg_col{background-color:#CCC;}
img{}
p span{font-size:12px;}
th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}
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

}
</style>

 


   <!-- <h2><strong>Bill / Receipt</strong></h2>-->
<div id="print_div">

<table>
    <thead>
     <tr>
     <th colspan="6"><h1>DR. RAI'S HEALTH CARE PVT. LTD.</h1></th>
     </tr>
     </thead>
     <tbody>
     <tr>
     <td colspan="6"><div>
    <p>
    <strong>SHOP NO-103, GANJAWALA ELEGANCE , GANJAWALA LANE , ABOVE PUNJAB NATIONAL BANK,</strong>

    <strong>BORIVALI-WEST, MUMBAI-400092.</strong>

    <strong>TEL. NO.-022-65670700/022-28901790</strong>
    </p>
    </div></td>
     </tr>
    
        <tr>
            <td colspan="5" class="td_bg_col" >
                <p>
                    <strong>Bill No. : 2013-14/008</strong><br>
                
                    <strong>Patient Name : <?php echo $row[6]; ?>.</strong><br>
                
                    <strong>Address : <?php echo $row[20]; ?></strong>
                   
                    
                </p>
            </td>
            <td class="td_bg_col" >
                <p>
                   <strong>Date : <?php echo date("Y-m-d",strtotime($date)); ?></strong><br>
                
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
            <td  colspan="5" >
                <p>
                    <strong>Bill Particulars </strong>
                </p>
            </td>
            <td>
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
                    <strong> <?php echo $row[6]; ?>/-</strong>
                </p>
            </td>
        </tr>
        
        
        <tr>
            <td colspan="5">
                <p>
                    <strong>Net Bill amount</strong>
                </p>
            </td>
            <td>
                <p >
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
                    <strong>Payment Mode</strong>
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
                    <strong>Rs<?php echo $row2[6]; ?>./-</strong>
                </p>
                
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    <strong>2013-14 /10</strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo date("d/m/Y",strtotime($date)); ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo $row2[7]; ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo $paidamt;  ?>/-</strong>
                </p>
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
        <tr>
            <td colspan="2" height="50" valign="top">
                <p>
                   <h6><strong>Patient Signature</strong></h6>
                </p>
                </td>
                <td colspan="4" height="50" valign="top">
                <p>
                   <h6> <strong>For Dr. Rai's Health Care Pvt. Ltd. </strong></h6>
                </p>
                
            </td>
        </tr>
        <tr>
            <td  colspan="6" class="td_bg_col" >
                <p><span>
                    <strong>Note :</strong><br>
                
                    <strong>1. </strong>
                    <strong>
                        As per the registration form duly accepted &amp; signed by the patient charges paid are non refundable and cannot be adjusted
                          either.Consultation &amp; treatment can be availed of only during the membership period.
                    </strong><br>
                
                    <strong>2. </strong>
                    <strong>Cheques are subject to realization.</strong><br>
                
                    <strong>3. </strong>
                    <strong>Subject to Mumbai Jurisdication only.</strong>
                   
               </span> </p>
                
            </td>
        </tr>
    </tbody>
</table></div>
<div id="not" align="center"><input type="button" onclick="printpage();" value="Print Report" />&nbsp;&nbsp;<input type="button" onclick="window.close();" value="Cancel" /></div>