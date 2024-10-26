<?php
session_start();
include "config.php";
$what = $_GET['what'];
$val = $_GET['val'];
$type = $_GET['calltype'];
$desig = $_GET['desig'];
$atmid = '';
$qry2 = '';
$client = "select cust_id from customer where 1";
if ($desig == '6') {
    $cust = mysqli_query($concs,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");
    $cc = array();
    while ($custr = mysqli_fetch_array($cust)) {
        $cc[] = $custr[0];
    }

    $ccl = implode(",", $cc);
    $ccl = str_replace(",", "','", $ccl);
    $ccl = "'" . $ccl . "'";
    $client .= " and cust_name in($ccl)";

}
$client .= " order by cust_name ASC";
// echo $client;
//echo $what;
if ($what == 'atmid') {
    //echo "Select bankname,address,amcid from Amc where atmid LIKE '%".$val."%'";;
    $atmid = "Select bankname,address,amcid,atmid from Amc where active='Y' and atmid LIKE '%" . trim($val) . "%' and cid in($client)";
    //echo "Select bankname,address,amcid,atmid from Amc where active='Y' and atmid LIKE '%".trim($val)."%' and cid in($client)";
    $qry2 = "Select bank_name,address,track_id,atm_id from atm where active='Y' and atm_id LIKE '%" . trim($val) . "%'  and cust_id in($client)";
} elseif ($what == 'add') {
    //echo "Select bankname,address from Amc where address LIKE '%".$val."%'";
    $atmid = "Select bankname,address,amcid,atmid from Amc where active='Y' and address LIKE '%" . $val . "%' and cid in($client)";
    $qry2 = "Select bank_name,address,track_id,atm_id from atm where active='Y' and address LIKE '%" . $val . "%'  and cust_id in($client)";
    //echo "Select bank_name,address,track_id from atm where address LIKE '%".$val."%'";
}
//echo $atmid."<br>".$qry2;
$flag = 0;
$qry = mysqli_query($concs, $atmid);
if (mysqli_num_rows($qry) > 0) {
    $flag = 1;
//echo "No result found<br>";
    while ($row = mysqli_fetch_array($qry)) {
        ?>
<a href="service.php?id=<?php echo $row[2]; ?>&type=amc"><?php	echo $row[0] . "-" . $row[3] . "(Amc Site)"; ?></a></br>
<?php	echo $row[1]; ?><br><br>
    <?php
}}
//echo $qry2;
$qr = mysqli_query($concs, $qry2);
if (mysqli_num_rows($qr) > 0) {
    $flag = 1;
    while ($row2 = mysqli_fetch_array($qr)) {
        ?>
<a href="service.php?id=<?php echo $row2[2]; ?>&type=site"><?php	echo $row2[0] . "-" . $row[3] . "(New Site)"; ?></a></br>
<?php	echo $row2[1]; ?><br><br>
    <?php
}}
if ($flag == 0) {
    echo "No result found or ATM is not active<br>";
}

?>