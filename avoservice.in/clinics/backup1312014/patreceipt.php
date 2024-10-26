
<div id="not" align="center"></div>
<?php
include("config.php");
//session_start();
 $patientid=$_GET['pid'];
 $id=$_GET['id'];
 //$date=$_POST['date'];
 //$paidamt=$_POST['amt'];
//$mode=$_POST['mode'];
//$date=str_replace("/","-",$date);
//echo "select * from patient where srno='".$patientid."'";
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
$collect=mysql_query("select * from opd_collection where id='".$id."'");
$collectro=mysql_fetch_row($collect);
$collect2=mysql_query("select sum(amt) from opd_collection where patientid='".$patientid."' and date<='".$collectro[3]."' ");
$collectamt=mysql_fetch_row($collect2);

//echo "amt=".$collectamt[0];
?>
<style>
h1,h2,h3{text-align:center; vertical-align:top; background-color:transparent; color:#000;}

h6{position:absolute; clear:both;}
p {text-align:left; font-size:14px; background-color:transparent; color:#000;}


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
<div id="print_div">

<table>
    <thead>
     <tr>
     <th colspan="6"><h1>DR. RAI'S HEALTH CARE PVT. LTD.</h1></th>
     </tr>
     <tr><th colspan="6"> ----------------------------------------------------------------------------------------------------------------------- </th></tr>
     <tr>
     <th colspan="6"><b>SHOP NO-103, GANJAWALA ELEGANCE , GANJAWALA LANE , ABOVE PUNJAB NATIONAL BANK, BORIVALI-WEST, MUMBAI-400092.<br /> TEL. NO.-022-65670700/022-28901790</b></th>
     </tr>
     </thead>
     <tbody>
     <tr>
     <td colspan="6">
    <p>
     <h2> Bill / Receipt </h2>
    </p>
    </td>
     </tr>
    
        <tr>
            <td colspan="4" class="td_bg_col" >
                <p>
                    <b>Bill No. : 2013-14/008<br>
                
                    Patient Name : <?php echo $row[6]; ?>.<br><br>
                
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
                    <strong> <?php echo $row2[6]; ?>/-</strong>
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
            <td colspan="5">
                <p>
                    <strong>Receipt Particulars</strong>
                </p>
            </td>
            <td colspan="0">
                <p>
                    <strong>Amount (Rs.)</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="td_bg_col" >
                <p>
                    <strong>Membership Fees </strong>
                </p>
            </td>
            
            <td colspan="0" class="td_bg_col" >
                <p>
                    <strong> </strong>
                </p>
            </td>
            
        </tr>
        <tr>
            <td width="20%">
                <p>
                    <strong>Receipt No.</strong>
                </p>
            </td>
            <td width="15%">
                <p>
                    <strong>Date of Payment</strong>
                </p>
            </td>
            <td width="15%">
                <p>
                    <strong>Payment Mode</strong>
                </p>
            </td>
            <td width="15%">
                <p>
                    <strong>Amount</strong>
                </p>
            </td>
            <td width="15%">
                <p>
                    <strong>Description</strong>
                </p>
            </td>
            <td width="18%">
                <p>
                    <strong>Rs<?php echo $row2[6]; ?>./-</strong>
                </p>
                
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    <strong><?php
					
					if(date('m')<4)
					echo date('Y',strtotime('-1 year'))."-".date('y');
					else
					echo date('Y')."-".date('y',strtotime('+1 year'));
					 echo $id; ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo date("d/m/Y",strtotime($collectro[3])); ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo $collectro[7]; ?></strong>
                </p>
            </td>
            <td>
                <p>
                    <strong><?php echo $collectro[2];  ?>/-</strong>
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
            <td colspan="6" height="130" valign="top">
                <p>
                   <h6 align="left" ><strong>Patient Signature</strong></h6>
                </p>
                
                <p>
                   <h5 align="right"> <strong>For Dr. Rai's Health Care Pvt. Ltd. </strong></h5>
                </p>
                
            </td>
        </tr>
        <tr>
            <td  colspan="6" class="td_bg_col" >
               
                    Note :
                
                     <ul>
                        <li>As per the registration form duly accepted &amp; signed by the patient charges paid are non refundable and cannot be adjusted either.</li>
                        <li>  Consultation &amp; treatment can be availed of only during the membership period.</li>                   
                        <li>Cheques are subject to realization.</li>                                    
                        <li>Subject to Mumbai Jurisdication only.</li>
                    </ul>
               
                
            </td>
        </tr>
    </tbody>
</table></div>
