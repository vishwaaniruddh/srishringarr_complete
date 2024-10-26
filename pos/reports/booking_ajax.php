<?php
include('../db_connection.php');
$con = OpenSrishringarrCon();

// Retrieve and sanitize input
$barcode = isset($_REQUEST['barcode']) && $_REQUEST['barcode'] !== '' ? $_REQUEST['barcode'] : (isset($_REQUEST['barcode2']) && $_REQUEST['barcode2'] !== '' ? $_REQUEST['barcode2'] : '');
$fromdate = isset($_REQUEST['fromdate']) && $_REQUEST['fromdate'] !== '' ? date('Y-m-d', strtotime($_REQUEST['fromdate'])) : '';
$todate = isset($_REQUEST['todate']) && $_REQUEST['todate'] !== '' ? date('Y-m-d', strtotime($_REQUEST['todate'])) : '';

// Initialize the base query for future bookings
$future_qry = "SELECT a.*, b.pick_date as rentpickdate, b.delivery_date as rentdeliverydate FROM `order_detail` a 
               INNER JOIN phppos_rent b ON a.bill_id = b.bill_id";

// Build conditions based on input
$conditions = [];

if ($barcode !== '') {
    $conditions[] = "a.item_id = '$barcode'";
}

if ($fromdate !== '' && $todate !== '') {
    // Both fromdate and todate are provided
    $conditions[] = "b.pick_date BETWEEN '$fromdate' AND '$todate'";
} elseif ($fromdate !== '') {
    // Only fromdate is provided
    $conditions[] = "b.pick_date >= '$fromdate'";
} elseif ($todate !== '') {
    // Only todate is provided
    $conditions[] = "b.pick_date <= '$todate'";
}

// Append conditions to the future query if any are set
if (count($conditions) > 0) {
    $future_qry .= " WHERE " . implode(' AND ', $conditions);
}

// Add condition for future bookings and finalize the query
$future_qry .= " AND b.pick_date >= CURDATE() GROUP BY a.bill_id ORDER BY b.pick_date";

$res_future = mysqli_query($con, $future_qry);
$num_future = mysqli_num_rows($res_future);

// Initialize the base query for past bookings
$past_qry = str_replace("b.pick_date >= CURDATE()", "b.pick_date < CURDATE()", $future_qry);
$res_past = mysqli_query($con, $past_qry);
$num_past = mysqli_num_rows($res_past);
?>

<style>
    td,th{
        border:1px solid black;
        font-size:12px;
    }
    table{
            margin: auto;
    }
    th{
        text-align:center;
    }
</style>

<!-- Future Bookings -->
<div id="futureBookings">
    <h3 align="center">Future Bookings <?php echo  ' - ' . $barcode ; ?></h3>
    <?php if ($num_future > 0) { ?>
    <div class="table-responsive">
        <table border="1">
            <tr>
                <th style="font-size:12px;border:1px solid black;">Sr. No</th>
                <th style="font-size:12px;border:1px solid black;">Bill No.</th>
                <th style="font-size:12px;border:1px solid black;">Item Code.</th>
                <th style="font-size:12px;border:1px solid black;">Customer Name</th>
                <th style="font-size:12px;border:1px solid black;">Contact No.</th>
                <th style="font-size:12px;border:1px solid black;">Description</th>
                <th style="font-size:12px;border:1px solid black;">Pick Date</th>
                <th style="font-size:12px;border:1px solid black;">Delivery Date</th>
                <th style="font-size:12px;border:1px solid black;">Trail Date</th>
                <th style="font-size:12px;border:1px solid black;">Measurement</th>
                <th style="font-size:12px;border:1px solid black;">Is Delivery</th>
            </tr>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($res_future)) {
                $resrent = mysqli_fetch_row(mysqli_query($con, "SELECT pick_date, delivery_date, cust_id, trail_date, measurement, is_delivery FROM phppos_rent WHERE bill_id='$row[0]'"));
                $gtdsfr = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM phppos_people WHERE person_id='$resrent[2]'"));
            ?>
                <tr align="center">
                    <td style="font-size:12px;border:1px solid black;"><?php echo $i; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $row[0] ; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo   $barcode ; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $gtdsfr[0] . " " . $gtdsfr[1]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $gtdsfr[2]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $row[7]; ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;"><?php echo date('d-m-Y', strtotime($resrent[0])); ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;"><?php echo date('d-m-Y', strtotime($resrent[1])); ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;">
                        <?php 
                        if($resrent[3]=='0000-00-00'){
                            echo '';
                        }else{
                            echo 'this ' . date('d-m-Y', strtotime($resrent[3])); 
                        }
                            
                        ?>
                    </td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $resrent[4]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $resrent[5]; ?></td>
                </tr>
            <?php $i++; } ?>
        </table>
    <?php } else { ?>
        <p align="center">No Future Bookings</p>
    <?php } ?>
</div>


</div>

<br>
<!-- Print button for Future Bookings -->
<div align="center">
    <button onclick="printFuture()" class="btn btn-primary">Print Future Bookings</button>
</div>



<hr>

<!-- Past Bookings -->
<div id="pastBookings">
    <h3 align="center">Past Bookings <?php echo  ' - ' . $barcode?></h3>
    <?php if ($num_past > 0) { ?>
    <div class="table-responsive">
        <table border="1">
            <tr>
                <th style="font-size:12px;border:1px solid black;">Sr. No</th>
                <th style="font-size:12px;border:1px solid black;">Bill No.</th>
                <th style="font-size:12px;border:1px solid black;">Item Code.</th>
                <th style="font-size:12px;border:1px solid black;">Customer Name</th>
                <th style="font-size:12px;border:1px solid black;">Contact No.</th>
                <th style="font-size:12px;border:1px solid black;">Description</th>
                <th style="font-size:12px;border:1px solid black;">Pick Date</th>
                <th style="font-size:12px;border:1px solid black;">Delivery Date</th>
                <th style="font-size:12px;border:1px solid black;">Trail Date</th>
                <th style="font-size:12px;border:1px solid black;">Measurement</th>
                <th style="font-size:12px;border:1px solid black;">Is Delivery</th>
            </tr>
            <?php 
            $i = 1;
            while ($row = mysqli_fetch_array($res_past)) {
                $resrent = mysqli_fetch_row(mysqli_query($con, "SELECT pick_date, delivery_date, cust_id, trail_date, measurement, is_delivery FROM phppos_rent WHERE bill_id='$row[0]'"));
                $gtdsfr = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM phppos_people WHERE person_id='$resrent[2]'"));
            ?>
                <tr align="center">
                    <td style="font-size:12px;border:1px solid black;"><?php echo $i; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $row[0]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo   $barcode ; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $gtdsfr[0] . " " . $gtdsfr[1]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $gtdsfr[2]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $row[7]; ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;"><?php echo date('d-m-Y', strtotime($resrent[0])); ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;"><?php echo date('d-m-Y', strtotime($resrent[1])); ?></td>
                    <td style="font-size:12px;border:1px solid black;white-space:nowrap;">
                        <?php 
                        if($resrent[3]=='0000-00-00'){
                            echo '';
                        }else{
                            echo 'this ' . date('d-m-Y', strtotime($resrent[3])); 
                        }
                            
                        ?>
                        </td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $resrent[4]; ?></td>
                    <td style="font-size:12px;border:1px solid black;"><?php echo $resrent[5]; ?></td>
                </tr>
            <?php $i++; } ?>

        </table>
    <?php } else { ?>
        <p align="center">No Past Bookings</p>
    <?php } ?>
</div>

</div>
<br>

<!-- Print button for Past Bookings -->
<div align="center">
    <button onclick="printPast()" class="btn btn-primary">Print Past Bookings</button>
</div>


<?php
CloseCon($con);
?>
