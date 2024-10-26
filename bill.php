<?php session_start();
include('config.php');
include('functions.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_product($id)
{
    global $con;
    $qrydt = "select product_code from product where product_id='" . $id . "'";
    $qrypro = mysqli_query($con, $qrydt);
    if ($fetchp = mysqli_fetch_array($qrypro)) {
        return $fetchp[0];
    } else {
        $qrydt = "select gproduct_code from garment_product where gproduct_id='" . $id . "'";
        $qrypro = mysqli_query($con, $qrydt);
        $fetchp = mysqli_fetch_array($qrypro);
        return $fetchp[0];
    }
}


$order_id = $_REQUEST['oid'];

$sql = mysqli_query($con , "SELECT * FROM Order_ent WHERE id = '".$order_id."'");

$sql_result = mysqli_fetch_assoc($sql);
$total_amount = $sql_result['amount'];
$txn_id = $sql_result['transaction_id'];
$shipping = $sql_result['shipping_charges'];
$userid = $sql_result['user_id'];
$date = $sql_result['date'];
$total_gst = $sql_result['cgst']+$sql_result['igst']+$sql_result['igst'];


$pickup_add = $sql_result['pickup_add'];
$delivery_add = $sql_result['delivery_add'];

// $shipping_charges = get_shipping_charges($total_amount);


 $date=date("d-M-Y h:i:s A", strtotime($date)); 

$user_sql = mysqli_query($con,"select * from Registration where registration_id = '".$userid."'");
$user_sql_result = mysqli_fetch_assoc($user_sql);

$fname = $user_sql_result['Firstname'];
$lname = $user_sql_result['Lastname'];
$address = $user_sql_result['address'];
$name = $fname.' '.$lname;
$mobile = $user_sql_result['Mobile'];









?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHRINGAAR</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
		function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back. Please refresh this page to complete the transaction!";
			//document.getElementById("pageNavPosition").innerHTML="";
			}
		
</script>
<body id="bdy">

<style>
body{
    font-size:10px;
}
td{
    padding:3px;
}
    .tnc li{
        font-size:12px;
    }
    p{
        margin:0;
        padding:0;
    }
    pre{
        display:none;
    }
    #middleInfo td{
        width:33%;
    }
</style>

<div id="bill">

        <p style="text-align:center;"><B><U> CONFIRMATION MEMO </U></B></font></p>
        
        
        
<table width="826" border="0" align="center">
<tr>
<td width="820" height="42">
    
    <table width="100%">
       <tr>
          
          <td style="padding:0px; margin:0px;">
              <div><u><b style="font-size:11px;">We Rent, Sell And Customise </b></u></div>
              <ul style="margin:0;font-size:10px;">
                  <li>Bridal Jewellery & Accessories</li>
                  <li>Lehenga, Evening Gowns, Blouse</li>
                  <li>All Kinds Of Jewellery & Outfits</li>
              </ul>
              <br>
              
              <div><b><u style="font-size:10px;">Bank Account Details</u></b></div>
              <div style="font-size:9px;">SRI SHRINGARR FASHION STUDIO</div>
              <div style="font-size:9px;">A/C No : 756305000529</div>
              <div style="font-size:9px;">IFSC: ICICI0007563</div>
              <div style="font-size:9px;">Vile Parle (E) Branch</div>
          </td>
          
          <td style="padding:0px; margin:0px;text-align:center;">
              <img src="sri_logo.jpg" width="50%"/>
          </td>
          
          <td style="padding:0px; margin:0px;" style="font-size:11px;">
              <div>Shyamkamal Building B,</div>
              <div>Wing B/1, Flat No.104,1st Floor,</div>
              <div>Agarwal Market, Vile Parle (East),</div>
              <div>Mumbai-400057, India.</div>
              <div>Phone - +91-9324243011/ +91-7400413163</div>
              <div>Email - rajanipodar@gmail.com</div>
              <div>GST - 27ADRPP988P1ZW</div>
        </td>
       
       </tr>
       </table>
       
       <hr style="margin:3px;border-top: 1px solid #000;">








    <table id="middleInfo" width="100%">
       <tr>
           <td>
               <b>UPI ID: srishringarrfashionstudio@icici</b><br />
               <img src="./asset/ssQR.png" style="width: 60px;">
               
           </td>
           <td>
               <td>
                   <b>Bill No. </b> . <?= $order_id ; ?><br/>
                   <b> Date: </b><?php echo $date; ?>
               </td>
           </td>
       </tr>
       
       <tr>
           <td>
            <div style="width: 300px;"><b> Name :</b><?php echo $name ; ?>
            <br/><b>Contact No: </b><?php echo $mobile; ?><br />
            <b>Pickup Address :</b> <? echo get_shippingaddress($pickup_add); ?>
               <br/>
               <b>Delivery Address :</b> <? echo get_shippingaddress($delivery_add); ?> 
            </div>
            

           </td>

           <td></td>
           <td>
               
               <div style="width: 320px;">
                   <br>
                   <b><u>TERMS & CONDITION:</u></b>
          <ul style="padding: 0;">
              <li><b>Once An Order Is Booked, It Will Not Be Changed, Exchange Or Cancelled.</b></li>
              <li>No Money Will Be Refunded.</li>
              <li>The Full Amount Of Rent Is To Be Given On The Day Of Booking.</li>
              <li>Rental Is For 3 Days Only, 10% Extra For Each Day.</li>
              <li>Security Deposit Is Compulsory.</li>
              <li>Any Damage Done Will Be Deducted From The Security Deposit.</li>
              <li>Subject To Mumbai Jurisdiction.</li>
              <li>Fixed Price No Bargaining.</li>
            </ul>
               </div>
           </td>
        </tr>
        
    
</table>



<style>
    #table th,#table td{
        border:1px solid black;
        text-align:center;
    }
</style>

<table id="table" style="text-align:center;width:100%;" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>SR NO</th>
            <th>ITEM CODE</th>
            <th>MRP</th>
            <th>QTY</th>
            <th>RENT</th>
            <th>DEPOSIT</th>
            <th>CGST ( 9% ) </th>
            <th>SGST ( 9% ) </th>
            <th>IGST ( 18% ) </th>
            <th>TOTAL GST</th>
            <th>TOTAL RENT(inc. gst)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total_qty = 0;
        $total_rent = 0;
        $grandTotalGST = 0 ; 
        $grandTotalfinalRentPrice = 0 ;
        $detail_sql = mysqli_query($con, "select * from order_details where order_id='" . $order_id . "'");
        while ($pro_sql_result = mysqli_fetch_assoc($detail_sql)) {
            $pro_amount = $pro_sql_result['product_amt'];
            $pro_qty = $pro_sql_result['qty'];
            $pro_type = $pro_sql_result['product_type'];
            $product_id = $pro_sql_result['product_id'];
            $deposit_amt = $pro_sql_result['deposit_amt'];

            $total_qty += $pro_qty;

            if ($pro_type == 1) {
                $product_name = get_product($product_id);
            } else {
                $product_name = get_product($product_id);
            }

            $mrpsql = mysqli_query($con3, "select unit_price from phppos_items where name like '" . $product_name . "'");
            $mrpsqlResult = mysqli_fetch_assoc($mrpsql);
            $mrp = $mrpsqlResult['unit_price'];

            if (!$product_name) {
                $product_name = '--';
            }

            $total_rent_row = $pro_qty * $pro_amount;
            $finalRentPrice = $total_rent_row/1.18 ; 
            
            $total_rent += $finalRentPrice;
            $cgst = 0.09 * $finalRentPrice; // 9% CGST
            $sgst = 0.09 * $finalRentPrice; // 9% SGST
            $igst = 0 ; 
            $total_gst = $cgst + $sgst + $igst ; 

            ?>

            <tr>
                <td><?= $i; ?></td>
                <td><?= $product_name; ?></td>
                <td><?= $mrp; ?></td>
                <td><?= $pro_qty; ?></td>
                <td><?= round($finalRentPrice,2); ?></td>
                <td><?= $deposit_amt; ?></td>
                <td><?= round($cgst,2); ?></td>
                <td><?= round($sgst,2); ?></td>
                <td><?= round($igst); ?></td>
                <td><?= round($total_gst,2); ?></td>
                <td><?= round($total_rent_row,2); ?></td>
            </tr>

            <?php
            $i++;
            
            $grandTotalGST = $total_gst + $grandTotalGST ; 
            $grandTotalfinalRentPrice = $total_rent_row + $grandTotalfinalRentPrice ;  
        } ?>

        <!-- Calculate and display the total CGST, SGST, IGST, and Total GST for the whole table -->
        <tr>
            <td colspan="6">Total:</td>
            <td><?= round(0.09 * $total_rent,2); ?></td> <!-- Total CGST -->
            <td><?= round(0.09 * $total_rent,2); ?></td> <!-- Total SGST -->
            <td><?= 0 * $total_rent; ?></td> <!-- Total IGST -->
            <td><?=  round($grandTotalGST,2); ?></td> <!-- Total GST -->
            <td><?= round($grandTotalfinalRentPrice,2); ?></td> <!-- Total Rent -->
        </tr>
    </tbody>
</table>


</td>
</tr>
     
</tr>



</table>

<div style="width:826px; margin:auto; padding-top: 30px; text-align: right; padding-bottom: 11px;">
    <p><b>SRI SHRINGARR FASHION STUDIO</b></p>
</div>

<div style="width:826px; margin:auto; text-align: right; padding: 40px;"> 
    <p><b>AUTH. SIGNATORY</b></p>
</div>



</div>
<br/><br/>
<div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Home</a></center>
<br><br>
<br><br>
</body>
</html>