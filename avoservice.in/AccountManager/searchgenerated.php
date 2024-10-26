<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include '../config.php';
//require("myfunction/function.php");
############# must create your db base connection

$strPage = $_REQUEST['Page'];
//echo "Select * from alert where alert_type='new'";
$sql = "Select * from alert where alert_type='new'";
//==========search by ATM id======================================================
if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];

    $sql .= " and atm_id IN(select `track_id` from atm where `atm_id`='" . $id . "') ";
//echo $sql;
}
//==========search by DOC NO =====================================================
if (isset($_POST['doct_no']) && $_POST['doct_no'] != '') {
    $doct_no = $_POST['doct_no'];
    $sql .= " and createdby LIKE '%" . $doct_no . "%'";
//echo $sql;
}
//==========search by PO NO =====================================================
if (isset($_POST['po_no']) && $_POST['po_no'] != '') {
    $po_no = $_POST['po_no'];
    $sql .= " and po LIKE '%" . $po_no . "%' ";
//echo $sql;
}
//==========search by customer id ======================================================
if (isset($_POST['cid']) && $_POST['cid'] != '') {
    $cid = $_POST['cid'];
    $sql .= " and cust_id IN(select cust_id from customer where cust_id= '" . $cid . "')";

}
//==========search by customer Call Status ======================================================
if (isset($_POST['call_status']) && $_POST['call_status'] != '') {
    $call_status = $_POST['call_status'];
    if ($call_status == 'pending') {
        $sql .= " and (call_status='1' and status != 'Done')";
    } elseif ($call_status == '') {
    } elseif ($call_status == 'close') {
        $sql .= " and (call_status = 'Done' or status = 'Done')";
    } elseif ($call_status == 'hold') {
        $sql .= " and call_status = '2'";
    }

    //echo $sql;
}
//==========search by Bank======================================================
if (isset($_POST['bank']) && $_POST['bank'] != '') {
    $bank = $_REQUEST['bank'];
    $sql .= " and bank_name LIKE '%" . $bank . "%'";
}
//==========search by Area======================================================
if (isset($_POST['area']) && $_POST['area'] != '') {
    $area = $_REQUEST['area'];
    $sql .= " and address LIKE '%" . $area . "%'";
}
//==========search by City======================================================
if (isset($_POST['city']) && $_POST['city'] != '') {
    $city = $_REQUEST['city'];
    $sql .= " and address LIKE '%" . $city . "%'";
}
//==========search by State======================================================
if (isset($_POST['state']) && $_POST['state'] != '') {
    $state = $_REQUEST['state'];
//$sql.=" and state1 LIKE '%".$state."%'";
    $sql .= " and branch_id ='" . $state . "'";
}
//echo $state;

//==========search by Date======================================================
if (isset($_POST['sdate']) && $_POST['sdate'] != '' && isset($_POST['edate']) && $_POST['edate'] != '') {
    $fromdt = $_REQUEST['sdate'];
    $todt = $_REQUEST['edate'];
    if ($call_status == 'close') {
        $sql .= " and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
    } else {
        $sql .= " and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
    }

}
$sqlr = $sql;

$table = mysqli_query($con1, $sql);

$Num_Rows = mysqli_num_rows($table);

?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">


 <?php
for ($i = 1; $i <= $Num_Rows; $i++) {
    if ($i % 10 == 0) {
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
$sql .= " order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table = mysqli_query($con1, $sql);

//include("../config.php");
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable">
<tr>
<th width="75">SN</th>
<th width="77">Docket No</th>
<th width="77">PO No</th>
<th width="77">Invoice No</th>
<th width="150">Call Log Time</th>
<th width="75">ATM ID</th>
<th width="75">Customer</th>
<th width="75">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="75">Branch</th>
<th width="75">Address</th>
<th width="95">ETA</th>
<!--<th width="70">Assets</th>-->
<th width="75">Delegated To</th>
<th width="75">Name</th>
<th width="75">Number</th>
<th width="75">Closing Date-Time</th>
<th width="75">Update</th>
<th width="75">Status</th>
<!--<th width="75"> </th>-->
<!--<th width="75">Branch Manr Last Feedback</th>-->
</tr>

<?php
$i = 1;
// Insert a new row in the table for each person returned
if (mysqli_num_rows($table) > 0) {
    while ($row = mysqli_fetch_row($table)) {

        $qry1 = mysqli_query($con1, "select * from customer where cust_name='$cid'");
        $crow = mysqli_fetch_row($qry1);
        $stat = array();
//echo "select * from site_assets where cust_id='$row[2]' and po='$row[11]' and atmid='".$row[0]."'";
        //echo "Select * from site_assets where atmid = '".$row[0]."' ";
        $qry2me = mysqli_query($con1, "Select * from site_assets where atmid = '" . $row[0] . "' ");
        $tab = mysqli_query($con1, "select feedback,standby from eng_feedback where alert_id='" . $row[0] . "' order by id DESC");
        $row1 = mysqli_fetch_row($tab);
//echo "<br>".in_array(0,$stat);

        ?><div align="center">

<tr>
<td width="77"><?php echo $i++; ?></td>
<!---Doct No-->
<td width="77"><?php echo $row[25]; ?></td>
<!---po no-->
<td width="75"><?php echo $row[20]; ?></td>
<!-- Invoice Number--------->
<?php

//echo "select so_id from atm where atm_id='".$row[2]."'";
        $atmqry = mysqli_query($con1, "select so_id from atm where track_id='" . $row[2] . "'");
        $atm = mysqli_fetch_row($atmqry);

//echo "select inv_no from so_order where po_id='".$atm[0]."'";
        $invqry = mysqli_query($con1, "select inv_no from so_order where po_id='" . $atm[0] . "'");
        $atm = mysqli_fetch_row($invqry);

        ?>
<td width="75"><?php echo $atm[0]; ?></td>
<!--call log date and time--->
<td width="200"><?php echo $row[10]; ?></td>
<!---atm id-->
<td width="95">
<?php
//echo "select `atm_id` from atm where `track_id`='".$row[2]."'";
        $atmid = mysqli_query($con1, "select `atm_id` from atm where `track_id`='" . $row[2] . "'");
        if (mysqli_num_rows($atmid) == 0) {
            $atmid = mysqli_query($con1, "select `atmid` from Amc where `amcid`='" . $row[2] . "'");
        }

        $atmid1 = mysqli_fetch_row($atmid);
        echo $atmid1[0];
        if (mysqli_num_rows($atmid) == 0) {echo $row[2];}
        ?></td>
<!---customer-->
<td width="95"><?php
$custname = mysqli_query($con1, "select `cust_name` from `customer` where `cust_id`='" . $row[1] . "'");
        $custname1 = mysqli_fetch_row($custname);
        echo $custname1[0];
        ?></td>
<!---bank-->
<td width="95"><?php echo $row[3]; ?></td>
<!--Area--->
<td width="70"><?php echo $row[4]; ?></td>
<!---City-->
<td width="70"><?php echo $row[6]; ?></td>
<!---state-->
<td width="70">
<?php
$branch = mysqli_query($con1, "select * from avo_branch where id='" . $row[7] . "'");
        $branch1 = mysqli_fetch_row($branch);
        echo $branch1[1];?></td>
<!---address-->
<td width="70"><?php echo $row[5]; ?></td>
<!---ETA-->
<td width="95"><?php echo $row[31]; ?></td>

<!---assets-->
<!--<td width="70">

<?php
/*$asst=mysqli_query($con1,"Select assets from alert_assets where alert_id='".$row[0]."'");
        while($resasst=mysqli_fetch_row($asst))
        {
        echo $resasst[0]."\n";
        }*/
        ?></td>-->
 <!---Delegate To eng name -->
<td width="95">
 <?php
$oldeng = mysqli_query($con1, "select engineer from alert_delegation where alert_id='" . $row[0] . "'");
        $getold = mysqli_fetch_row($oldeng);
        $fetchengid = mysqli_query($con1, "Select `engg_name`,`phone_no1` from area_engg where engg_id='" . $getold[0] . "'");
        $getoldname = mysqli_fetch_row($fetchengid);
        echo ucfirst($getoldname[0]);
        echo "<br>";
        echo $getoldname[1];?>
</td>
<!---Name-->
<td width="75"><?php echo $row[12]; ?></td>

<!---Number-->
<td width="75"><?php echo $row[13]; ?></td>

 <!---closing date and time-->
<td width="95">
<?php if (isset($row[18]) and $row[18] != '0000-00-00 00:00:00') {
            echo wordwrap(date('d/m/Y h:i a', strtotime($row[18])), 8, "<br />\n", true);
        }
        ?> </td>
<!---update-->
<td width="75">
<?php if ($row1[0] != '') {?>
<a href="javascript:void(0);" onclick="newwin('masteralertaccmang.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo $row1[0]; ?></a><?php } else {
            $al = mysqli_query($con1, "select feedback from eng_feedback where alert_id='" . $row[0] . "' order by id DESC limit 1");
            $alro = mysqli_fetch_row($al);
            echo $alro[0];
        }?>
</td>
<!---status=====================-->
<td width="95"><?php
if (($row[16] == '1') & ($row[15] != 'Done')) {
            echo "Pending";
        } elseif ($row[16] == '2') {
            echo "Hold";
        } elseif (($row[16] == 'Done') or ($row[15] == 'Done')) {
            echo "Close";
        }
        ?></td>

<!--<td width="75" valign="top">&nbsp;<?php
if ($row[28] == '1') {
            $buy = mysqli_query($con1, "select * from buyback where alertid='" . $row[0] . "'");
            $buyro = mysqli_fetch_row($buy);
            echo "<br><b>Buy Back :</b>" . $buyro[2] . "<br>";

        }
        echo "NA";
        ?></td>-->


<!--<td width="75">
<a class="update" href="#" onclick="newwin('../call_update.php?id=<?php echo $row[0] ?>','display')" >View Feedback</a>


</td>-->

</tr></div><?php

    }

    ?></table>
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
?>

<form name="frm" method="post" action="export_instcall.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
