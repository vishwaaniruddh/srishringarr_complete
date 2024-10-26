<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include 'config.php';

$strPage = $_REQUEST['Page'];

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr>

<th width="50">Name</th>
<th width="50">Site/ATM ID</th>
<th width="120">Address</th>
<th width="50">AVO Branch</th>
<th width="75">AVO Call No.</th>
<th width="50">Call Date</th>
<th width="50">Problem Reported</th>
<th width="50">Battery Type</th>
<th width="30">Battery Ah</th>
<th width="20">Failed Qty</th>
<th width="50">OEM Vendor Name.</th>
<th width="50">OEM Call No.</th>
<th width="30">OEM Call Date</th>

<th width="50"> AVO Contact Name</th>
<th width="30"> Contact No.</th>

<th>Completed Date</th>
<th>No. Of Batt Replaced</th>
<th>Comments</th>
<th width="25"> Status</th>
</tr>
<?php

$cid = $_POST['cid'];

$sql .= "Select * from BRF_form where 1";

$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == 6) {
    // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($conc,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");

    $cc = array();
    while ($custr = mysqli_fetch_array($cust)) {
        $cc[] = $custr[0];
    }

    // print_r($cc);
    $ccl = implode(",", $cc);
    $ccl = str_replace(",", "','", $ccl);
    $ccl = "'" . $ccl . "'";
    $client .= " and cust_name in($ccl)";

}
$client .= " order by cust_name ASC";

$cl = mysqli_query($conc,$client);
while ($clro = mysqli_fetch_row($cl)) {
    $custid[] = $clro[1];
}
$cust = implode(",", $custid);
$cust=str_replace(",","','",$cust);
$sql .= " and Customer_Name in('$cust') ";

//echo $sql;

$sta = $_POST['status'];
if (isset($_POST['status']) && $_POST['status'] != '') {
    $sql .= " and statu='" . $sta . "'";
} 

if (isset($_POST['state']) && $_POST['state'] != '') {$stt = $_POST['state'];

    $sql .= " and Branch = '" . $stt . "' ";
}

if (isset($_POST['fromdt']) && $_POST['fromdt'] != '' && isset($_POST['todt']) && $_POST['todt'] != '') {
    $fromdt = $_POST['fromdt'];
    $todt = $_POST['todt'];
    $sql .= " and CallAlertDate Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}
if (isset($_POST['atmid']) && $_POST['atmid'] != '') {
    $id = $_POST['atmid'];
    $sql .= " and ATM_ID LIKE '%" . $id . "%'";
}

if (isset($_POST['complaintno']) && $_POST['complaintno'] != '') {
    $complaintno = $_REQUEST['complaintno'];
    $sql .= " and Call_Ticket LIKE '%" . $complaintno . "%'";
}
//echo $sql;

$table = mysqli_query($conc,$sql);
$count = 0;
$Num_Rows = mysqli_num_rows($table);
?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
for ($i = 1; $i <= $Num_Rows; $i++) {
    if ($i % 50 == 0) {
        ?>
 <option value="<?php echo $i; ?>" <?php if (isset($_POST['perpg']) && $_POST['perpg'] == $i) {?>  selected="selected" <?php }?>><?php echo $i . "/page"; ?></option>
 <?php
}
}

?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>

 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page = $_POST['perpg']; // Records Per Page

$Page = $strPage;
if (!$strPage) {
    $Page = 1;
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;

$Page_Start = (($Per_Page * $Page) - $Per_Page);
if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int) $Num_Pages;
}

$qr22 = $sql;

$sql .= " order by Brf_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table = mysqli_query($conc,$sql);

if (mysqli_num_rows($table) > 0) {
    while ($row = mysqli_fetch_row($table)) {
// ATM Id Select======
        //echo "select atm_id from alert where created_by='".$row[1]."'";
        $alrtqr = mysqli_query($conc,"select atm_id,assetstatus from alert where createdby='" . $row[1] . "'");
        $alertr = mysqli_fetch_row($alrtqr);

        if ($alertr[1] == 'site') {
            $atmry = mysqli_query($conc,"select atm_id from atm where track_id='" . $alertr[0] . "'");
        } elseif ($alertr[1] == 'amc') {
            $atmry = mysqli_query($conc,"select atmid from Amc where amcid='" . $alertr[0] . "'");
        }

        $atmid = mysqli_fetch_row($atmry);

        ?>
<tr>
<td width="50" valign="top">&nbsp;<?php echo $row[4]; ?></td> <!--Cust -->
<td width="50" valign="top">&nbsp;<?php echo $atmid[0]; ?></td> <!--ATM Id -->
<td width="100" valign="top">&nbsp;<?php echo $row[5]; ?></td> <!--Add -->
<td width="72" valign="top">&nbsp;<?php echo $row[6]; ?> </td><!--Branch -->
<td width="71" valign="top">&nbsp;<?php echo $row[1] ?></td>
<td valign="top">&nbsp;<?php echo $row[2] ?></td>   <!-- call date -->
<td width="71" valign="top">&nbsp;<?php echo $row[11] ?></td> <!--Prob-->
<td width="75" valign="top">&nbsp;<?php echo $row[12] ?></td> <!--Batt Type-->
<td width="75" valign="top">&nbsp;<?php echo $row[13] . " Ah" ?></td> <!--batt AH-->

<td width="75" valign="top">&nbsp;<?php echo $row[15] . " Out of " . $row[14] ?></td> <!--batt AH-->
<td width="75" valign="top">&nbsp;<?php echo $row[3] ?></td> <!--Vend Name-->
<td width="75" valign="top">&nbsp;<?php echo $row[30] ?></td> <!--OEM Tkt-->
<td width="75" valign="top">&nbsp;<?php echo $row[31] ?></td> <!--Date-->

<td width="75" valign="top">&nbsp;<?php echo $row[9] ?></td> <!--AVO Cont-->
<td width="75" valign="top">&nbsp;<?php echo $row[10] ?></td> <!--Date-->

<td width="75" valign="top">&nbsp;<?php echo $row[32] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[34] ?></td>

<?
  $result3=mysqli_query($conc,"select * from UpdateStatus where brf_id='$row[0]' order by currentdate desc limit 1 ");
$fetchBrf_id=mysqli_fetch_array($result3);

if($row[28]=="0" || $row[28]=="" ) { $status="Pending";}
elseif($row[28]=="2") {  $status="Rejected";}
elseif($row[28]=="1") {  $status="Completed";} ?>

<td><?php echo $fetchBrf_id[1]; ?></td>
<td width="75" valign="top">&nbsp;<?php echo $status ?></td>

</tr>
<?php
}
    ?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if ($Prev_Page) {
    echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if ($Page != $Num_Pages) {
    echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
close($conc);
?>
<!--<form name="frm" method="post" action="export_viewalert.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>-->

<div id="bg" class="popup_bg"> </div>
