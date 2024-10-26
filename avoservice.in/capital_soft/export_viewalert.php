<?php
include 'config.php';
$sqlme = $_POST['qr'];
//echo $sqlme;
$table = mysqli_query($concs,$sqlme);

$contents = '';
$contents .= "Complain ID\t Client Docket Number\t Name\t ATM\t Bank\t City\t Address\t Branch\t Problem \t Alert Date\t Call Type\t Call Status\t Contact Person\t Phone\t Delegated To\t Engg Number\t Customer Status\t ETA\t Engr Reach site\t Close Date\t Remarks Update\t";

while ($row = mysqli_fetch_row($table)) {

    if (($row[17] == 'service' || $row[17] == 'pm' || $row[17] == 'dere') && $row[21] == 'amc') {
        $atm = mysqli_query($concs,"select atmid from Amc where amcid='" . $row[2] . "'");
    }

//echo "select atmid from Amc where amcid='".$row[2]."'";

    if (($row[17] == 'service' || $row[17] == 'pm' || $row[17] == 'dere') && $row[21] == 'site') {
        $atm = mysqli_query($concs,"select atm_id from atm where track_id='" . $row[2] . "'");
    }

//echo "select atm_id from atm where track_id='".$row[2]."'";

    $tab = mysqli_query($concs,"select feedback,standby from eng_feedback where alert_id='" . $row[0] . "' order by id DESC");
    $row1 = mysqli_fetch_row($tab);
    //echo "eng stat".$row[15];

    $qry = mysqli_query($concs,"select cust_name from customer where cust_id='" . $row[1] . "'");
    $custrow = mysqli_fetch_row($qry);

//======Complian ID========
    $contents .= "\n" . $row[25];
//======Client Docket Number========
    $contents .= "\t" . $row[30];
//======Name========
    $contents .= "\t" . $custrow[0];
//======Atm ========
    if ($row[17] == 'new' || $row[17] == 'new temp' || $row[17] == 'temp_pm') {$contents .= "\t" . $row[2];} else {
        $atmrow = mysqli_fetch_row($atm);

        $contents .= "\t" . $atmrow[0];
//echo "atm :".$atmrow[0];

    }
//======Bank========
    $contents .= "\t" . $row[3];

//======city========
    $contents .= "\t" . $row[6];
//======Address========
    $contents .= "\t" . preg_replace('/\s+/', ' ', $row[5]);
//======Branch========
    $branch = mysqli_query($concs,"select name from avo_branch where id='" . $row[7] . "'");
    $branchro = mysqli_fetch_row($branch);
    $contents .= "\t" . $branchro[0];

//$contents.="\t".str_replace("\n","",preg_replace('/\s+/', '', $row[7]));
    //======problem========
    $contents .= "\t" . str_replace("\n", "", preg_replace('/\s+/', '', $row[9]));

//======Alert Date========
        $contents .= "\t" . $row[10];

    // Call Type===========

    if ($row[17] == 'service' || $row[17] == 'new temp') {$contents .= "\t" . "Service Call";}
    if ($row[17] == 'new') {$contents .= "\t" . "Installation Call";}
    if ($row[17] == 'dere' || $row[17] == 'temp_dere') {$contents .= "\t" . "Re-Installation";}
    if ($row[17] == 'pm' || $row[17] == 'temp_pm') {$contents .= "\t" . "PM Call";}

//======Call close========
    if ($row[15] == 'done' or $row[16] == 'done') {$contents .= "\t" . "Call closed";} else if ($row[16] == 'Rejected') {$contents .= "\t" . "Rejected";} else { $contents .= "\t" . "Call still active";}

    //======Remarks
    //if ($row[16]=='Rejected'){$contents.="\t"."Rejected by AVO";} else {
    //======Contact Person========
    $contents .= "\t" . $row[12];
//======Phone========
    $contents .= "\t" . $row[13];
//======Delegate to========
    $oldeng = mysqli_query($concs,"select engineer from alert_delegation where alert_id='" . $row[0] . "'");
    $getold = mysqli_fetch_row($oldeng);
    $fetchengid = mysqli_query($concs,"Select engg_name,phone_no1 from area_engg where engg_id='" . $getold[0] . "'");
    $getoldname = mysqli_fetch_row($fetchengid);
    $contents .= "\t" . $getoldname[0];

//======engg number========
    $contents .= "\t" . $getoldname[1];
//======Contact statue========
    if (0 === strpos($row[2], 'temp')) {
        $contents .= "\t" . "PCB";
    } else
    if ($row[21] == '' || $row[21] == 'site') {$contents .= "\t" . "Under Warrenty";} else if ($row[21] == 'amc') {$contents .= "\t" . "AMC";} else { $contents .= "\t" . "PCB";}

//===========ETA===
    $contents .= "\t" . $row[31];
    
//===========Resp===
    $contents .= "\t" . date($row[24]);
    
//===========Close date===
    $contents .= "\t" . date($row[18]);    

//========Last FeedBack ========
    if ($row1[0] != '') {
        $contents .= "\t" . str_replace("\n", "  ", preg_replace('/\s+/', ' ', $row1[0]));
    } else {
        $al = mysqli_query($concs,"select max(id),feedback from eng_feedback where alert_id='" . $row[0] . "'");
        $alro = mysqli_fetch_row($al);
        $engf = preg_replace('/\s+/', ' ', $alro[1]);
        //$engf=str_replace("\n"," ",$alro[1]);
        $contents .= "\t" . $engf;
    }
    $contents .= "\t";



}
$contents = strip_tags($contents);

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");

header("Content-Disposition: attachment; filename=mis.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;
