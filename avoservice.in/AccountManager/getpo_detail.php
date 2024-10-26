<?php
include 'config.php';

if (isset($_GET['po'])) {
    $pordr = $_GET['po'];
}

$dataco = mysqli_query($con1, "select `no_sites` from `purchase_order` where `po_no`='" . $pordr . "'");
$dataco1 = mysqli_fetch_row($dataco);

$ponum = mysqli_query($con1, "select count(`po`),`bank_name`,count(`atm_id`) from `atm` where `po`='" . $pordr . "'");
$ponum1 = mysqli_fetch_row($ponum);
echo $ponum1[2] . "**##";
echo $ponum1[1] . "**##";

$data = mysqli_query($con1, "select * from `purchase_order` where `po_no`='" . $pordr . "'");
if (mysqli_num_rows($data) == 0) {
    echo '-1';
} else {
    $data1 = mysqli_fetch_row($data);

// **## split for one by one value
    echo $data1[1] . "**##";
    echo $data1[2] . "**##";
    echo $data1[3] . "**##";
    echo $data1[4] . "**##";
    echo date('d/m/Y', strtotime($data1[5])) . "**##";

    $assets = mysqli_query($con1, "select * from `po_assets` where `po_no`='" . $pordr . "'");

    while ($assets1 = mysqli_fetch_row($assets)) {
        // **** split for all assets in array
        $allassets = $assets1[1] . "****" . $assets1[2] . "****" . $assets1[3] . "****" . $assets1[4] . "****" . $assets1[5] . "****";

        echo $allassets;

    }
}
