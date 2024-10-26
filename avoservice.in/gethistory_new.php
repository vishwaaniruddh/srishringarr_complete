<?php
include ("config.php");
$id = $_GET['id'];
$type = $_GET['type'];
$qry = "";

$stat = 0;

// ======= Repeat calls Block==============================
$tmb = date('Y-m-d 00:00:00', strtotime('-2 days'));
$ly = date('Y-m-d 00:00:00', strtotime('-1 year'));
if ($type == 'amc') {
    $qry = "select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status, a.alert_type,a.close_date from alert a,Amc b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.amcid order by alert_id DESC limit 6";


}
if ($type == 'site') {
    $qry = "select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status,a.alert_type, a.close_date from alert a,atm b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.track_id order by alert_id DESC limit 6";

}
//echo $qry;
?>
<ul style="list-style:none; padding:0">
<?php
$sql = mysqli_query($con1, $qry);
$rcnt = mysqli_num_rows($sql);
$tmcnt = 0;
while ($row = mysqli_fetch_array($sql)) {
    if ($row[9] > $tmb) {
        $tmcnt++;
    }

    $bm = mysqli_query($con1,"select up from alert_updates where alert_id='" . $row[6] . "' order by id DESC limit 1");
    $bmro = mysqli_fetch_row($bm);
    $eng = mysqli_query($con1,"select feedback from eng_feedback where alert_id='" . $row[6] . "' order by id DESC limit 1");
    $engro = mysqli_fetch_row($eng);
//echo $row[5];
    if ($row[5] != 'Done' && $row[5] != 'Rejected' && $row[7] != 'Done' && $row[8] != 'new') {
        $stat = 1;
    }

    ?>
<li>
<b>SIte ID</b> <?php echo $row[0]; ?><br />
<b>Address</b> <?php echo $row[1]; ?><br />
<b>State</b> <?php echo $row[2]; ?><br />
<b>Date</b> <?php echo $row[3]; ?><br />
<b>Call Type:</b> <?php if ($row[5] == 'Done') {echo "Done";} else {echo "<font color='#FF0000'>Open</font>";}?> <br />
<b>Problem:</b> <?php echo $row[4]; ?><br />
<b>AVO Last Feedback:</b> <?php echo $bmro[0]; ?>
<br />
<b>Engineer Feedback:</b> <?php echo $engro[0]; ?>
</li>
<li><hr /></li>
<?php
}
?></ul><?php echo "##" . $stat . "##" . $rcnt . "##" . $tmcnt; ?>