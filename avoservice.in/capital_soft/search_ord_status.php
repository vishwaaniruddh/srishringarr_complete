<?php
session_start();

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['logid'];

include 'config.php';
############# must create your db base connection

$strPage = $_REQUEST['Page'];
//echo $_POST['br'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="custtable" >
<tr>
<th width="2%">SN</th>
<th width="7%">Customer Name</th>
<th width="5%">ATM Id</th>
<th width="5%">PO No.</th>
<th width="5%">DO No.</th>
<th width="7%">End User Name</th>
<th width="15%">Address</th>
<th width="7%">Branch</th>

<th width="7%">Current Status</th>
<th width="7%">Last update</th>

<th width="8%">Invoice No</th>
<th width="5%">Invoice Date</th>
<th width="5%">Dispatch Date</th>
<th width="5%">Delivery Date</th>
<th width="8%">Call Log Date time</th>
<th width="5%">Call Ticket No</th>
<th width="5%">Installed Date</th>

</tr>
<?php

$cust = mysqli_query($conc,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");
$custr = mysqli_fetch_array($cust);
$client = "select cust_id,cust_name from customer where 1";
$client .= " and cust_name LIKE '" . $custr[0] . "'";
$cl = mysqli_query($conc,$client);
$clro = mysqli_fetch_row($cl);
//================
$cid = $_POST['cid'];
$sql .= "Select * from new_sales_order where po_custid='" . $cid . "' ";

//========================================for branch============

if (isset($_POST['branch']) && $_POST['branch'] != '') {
    $branch = $_POST['branch'];
    $sql .= " and branch_id =" . $branch . " ";
}

if (isset($_POST['site_id']) && $_POST['site_id'] != '') {
    $site_id = $_POST['site_id'];
    $sql .= " and atm_id like '%" . $site_id . "%' ";
}

//========================================From Date to Date============
if (isset($_POST['fromdt']) && $_POST['fromdt'] != '' && isset($_POST['todt']) && $_POST['todt'] != '') {

    $date1 = str_replace('/', '-', $_POST['fromdt']);
    $fromdt = date("Y-m-d", strtotime($date1));

    $date2 = str_replace('/', '-', $_POST['todt']);
    $todt = date("Y-m-d", strtotime($date2));

    $sql .= " and so_time Between '" . $fromdt . " 00:00:00' AND '" . $todt . " 23:59:59'";

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

//echo $sql;
$qr22 = $sql;
$sql .= " order by so_trackid DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table = mysqli_query($conc,$sql);

if (mysqli_num_rows($table) > 0) {
    $sn = 1;

    while ($row = mysqli_fetch_row($table)) {
        include "config.php";

//==== demo ATm table=======

        $atmqry = mysqli_query($conc,"Select bank_name, address, so_date from demo_atm where so_id='" . $row[0] . "'");
        $atm = mysqli_fetch_row($atmqry);

//=========SO Order ======
        $soqry = mysqli_query($conc,"Select * from so_order where po_id='" . $row[0] . "'");
        $so = mysqli_fetch_row($soqry);

//=====Call Log & status====

        $alertqry = mysqli_query($conc,"Select entry_date, createdby, close_date from alert where alert_id='" . $so[24] . "'");

        $alert = mysqli_fetch_row($alertqry);

        ?>
<tr>
<!--===SN===-->
<td  valign="top" width="200">&nbsp;<?php echo $sn; ?></td>

<!--===Customer Name===-->
<td  valign="top">&nbsp;<?php
$cuname = mysqli_query($conc,"select `cust_name` from `customer` where `cust_id`='" . $row[3] . "'");
        $cuname1 = mysqli_fetch_row($cuname);
        echo $cuname1[0];?></td>

<!--===ATM ID===-->
<td  valign="top">&nbsp;<?php echo $row[7]; ?></td>

<!--===PO===-->
<td  valign="top">&nbsp;
<?php $poname = mysqli_query($conc,"select `po_no` from `purchase_order` where `id`='" . $row[1] . "'");
        $po_no = mysqli_fetch_row($poname);
        echo $po_no[0];?></td>

<!--===DO===-->
<td  valign="top">&nbsp;<?php echo $row[2]; ?></td>

<!--===Bank Name===-->
<td  valign="top">&nbsp;<?php echo $atm[0]; ?></td>


<!--===Address===-->
<td  valign="top">&nbsp;<?php echo $atm[1]; ?></td>

<!--===Branch===-->
<td  valign="top">
<?php
$branch_qry = mysqli_query($conc,"select * from avo_branch where id='" . $row[4] . "'");
        $branch_row = mysqli_fetch_array($branch_qry);
        echo $branch_row['name'];
        ?>
</td>
<!--=== Status ===-->
<td  valign="top">
<? if ($row[14]==1) echo "SO Pending";
   if ($row[14]=='c') echo "SO Cancelled";
   if ($row[14]=='h') echo "SO on Hold";


   if ($row[14]=='2' && $so[19]=='c' ) echo "Invoice Cancelled";
   if ($row[14]=='2' && $so[19]=='h' ) echo "Invoice on Hold";
   if ($so[19]=='1' && $so[9]=='0000-00-00' && $so[8]=='0000-00-00') echo "Invoice Raised";
   if ($so[19]=='1' && $so[9]=='0000-00-00' && $so[8] !='0000-00-00') echo "Dispatched";
   if ($so[19]=='1' && $so[9]!='0000-00-00' && $so[8] !='0000-00-00') echo "Delivered";
//=== Check Inst request If no Fulfill=======
   if ($so[19]=='2' && $row[8]=='0') echo "Supply Fulfilled";

   if ($so[19]=='2' &&  $row[8]=='1' && $alert[2]=='0000-00-00 00:00:00') echo "Installion U/Process";
   if ($so[19]=='2' &&  $row[8]=='1' && $alert[2] !='0000-00-00 00:00:00') echo "Installion Complete";

?>
</td>
<!--        Last updates -->
<td  valign="top">

<?
if ($row[14]!='2'  || $so[19]!='2' ){
$soupdate= mysqli_query($conc,"Select Remarks_Update from SO_Update where so_id= '".$row[0]."' Order by updt_id DESC LIMIT 1");

//echo "Select Remarks_update from SO_Update where so_id= '".$row[0]."' Order by updt_id DESC LIMIT 1";

$update=mysqli_fetch_row($soupdate);
echo $update[0];  }

else if ($so[19]=='2'){
$call= mysqli_query($conc,"Select feedback from eng_feedback where alert_id= '".$so[24]."' order by id DESC LIMIT 1");
$update1=mysqli_fetch_row($call);
echo $update1[0];  }
else echo "No Updates found";

?>

</td>


<!--===Invoice no ===  -->
<td  valign="top">&nbsp;<?php echo $so[2]; ?></td>

<!--===Invoice date ===  -->
<td  valign="top">&nbsp;<?php echo $so[3]; ?></td>

<!--===Disp date ===  -->
<td  valign="top">&nbsp;<?php echo $so[8]; ?></td>

<!--===Delivery Date ===  -->

<td  valign="top">&nbsp;<?php

        if ($so[9] == '0000-00-00') {
            echo "ETA: " . $so[7];
        } else {
            echo $so[9];
        }

        ?>  </td>
<!--===Call Log Time=== -->
<td  valign="top">&nbsp;<?php echo $alert[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $alert[1]; ?></td>
<td  valign="top">&nbsp;<?php echo $alert[2]; ?></td>


</tr>
<?php

        $sn++;}
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

?>
<!--<form name="frm" method="post" action="export_so_status.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
You Can export Max.1200 records
</form>   -->

<div id="bg" class="popup_bg"> </div>