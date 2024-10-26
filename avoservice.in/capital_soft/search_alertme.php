<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include("config.php");
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr><th width="77">Complain ID</th>
<th width="77">Call Request Type</th>
<th width="77">Name</th>
<th width="72">Site/ATM ID</th>
<th width="71">End User</th>
<!--<th width="55">City</th>
<th width="57">Area</th> -->
<th width="100">Address</th>
<th width="100">State</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Call Type</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>
<th width="75"> Delegated To</th>
<th width="75"> Engg Number</th>
<th width="75"> Customer Status</th>
<th width="75"> ETA</th>
<th width="150"> Delegate</th>
<th width="75">View Update</th>
<th width="75">Update</th>
<th width="75">Status</th>
</tr>
<?php

$cid = $_POST['cid'];
//$sql.="Select * from alert where cust_id='".$cid."'";

$sql .= "Select * from alert where 1";

$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == 6) {
    // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($concs,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");

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

$cl = mysqli_query($concs,$client);
while ($clro = mysqli_fetch_row($cl)) {
    $custid[] = $clro[0];
}
$cust = implode(",", $custid);

$sql .= " and cust_id in($cust) ";

if (isset($_POST['state']) && $_POST['state'] != '') {$stt = $_POST['state'];

    $sql .= " and branch_id = '" . $stt . "' ";
}
if (isset($_POST['calltype'])) {
    $calltype = $_REQUEST['calltype'];
    if ($calltype == '') {
    } elseif ($calltype == 'open')
//$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and atm_id<>'temp_' and status != 'Done'";
    {
        $sql .= " and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done'";
    } elseif ($calltype == 'Done') {
        $sql .= " and (call_status = 'Done' or status = 'Done') ";
    } elseif ($calltype == 'onhold') {
        $sql .= " and call_status = 'onhold'";
    } elseif ($calltype == 'Rejected') {
        $sql .= " and call_status = 'Rejected'";
    }

}

//======================================Search Call of open , close, tem, new tem etc.
if (isset($_POST['openall'])) {
    $calltype = $_REQUEST['openall'];
    if ($calltype == '') {
    } elseif ($calltype == 'all') {
    } elseif ($calltype == 'install') {
        $sql .= " and (alert_type = 'new')";
    } elseif ($calltype == 'service') {
        $sql .= " and (alert_type = 'service' or `alert_type`='new temp')";
    } elseif ($calltype == 'pm') {
        $sql .= " and (alert_type = 'pm' or `alert_type`='temp_pm')";
    } elseif ($calltype == 'dere') {
        $sql .= " and (`alert_type`='dere' or `alert_type`='temp_dere') ";
    }

}
//echo $sql;

if (isset($_POST['eng']) && $_POST['eng'] != '') {
    $eng = $_POST['eng'];

    $alrtid = mysqli_query($concs,"select alert_id from alert_delegation where engineer='" . $eng . "' ");
    $alertarry = array();
    while ($alertrows = mysqli_fetch_assoc($alrtid)) {
        $alertarry[] = $alertrows['alert_id'];
    }
    $alert_string = implode(",", $alertarry);
    //echo $alert_string;

    $sql .= " and alert_id in ($alert_string )";
}
if (isset($_POST['fromdt']) && $_POST['fromdt'] != '' && isset($_POST['todt']) && $_POST['todt'] != '') {
    $fromdt = $_POST['fromdt'];
    $todt = $_POST['todt'];
    $sql .= " and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

}
if (isset($_POST['atmid']) && $_POST['atmid'] != '') {
    $id = $_POST['atmid'];
    $qr = mysqli_query($concs,"select track_id from atm where atm_id LIKE '%" . $id . "%'");
    $qr2 = mysqli_query($concs,"select amcid from Amc where atmid LIKE '%" . $id . "%'");
    $qr3 = mysqli_query($concs,"select atm_id from alert where atm_id LIKE '%" . $id . "%'");
    $r1 = mysqli_num_rows($qr);
    $r2 = mysqli_num_rows($qr2);
    $r3 = mysqli_num_rows($qr3);
    if ($r1 > 0 && $r2 > 0) {
        $sql .= " and ((atm_id IN (select track_id from atm where atm_id LIKE '%" . $id . "%') or atm_id IN (select amcid from Amc where atmid LIKE '%" . $id . "%'))";
    } elseif ($r1 > 0 && $r2 == 0) {
        $sql .= " and ((atm_id IN (select track_id from atm where atm_id LIKE '%" . $id . "%'))";
    } elseif ($r2 > 0 && $r1 == 0) {
        $sql .= " and ((atm_id IN (select amcid from Amc where atmid LIKE '%" . $id . "%'))";
    }

    if ($r1 == '0' && $r2 == '0') {
        $sql .= " and atm_id LIKE '%" . $id . "%' ";
    } else {
        $sql .= " or atm_id LIKE '%" . $id . "%' ) ";
    }

}

if (isset($_POST['bank']) && $_POST['bank'] != '') {
    $bank = $_REQUEST['bank'];
    $sql .= " and bank_name LIKE '%" . $bank . "%'";
}
if (isset($_POST['sitetp']) && $_POST['sitetp'] != '') {
    $sitetp = $_REQUEST['sitetp'];
    $sql .= " and alert_type ='" . $sitetp . "'";
}

if (isset($_POST['area']) && $_POST['area'] != '') {
    $area = $_REQUEST['area'];
    $sql .= " and address LIKE '%" . $area . "%'";
}
if (isset($_POST['complaintno']) && $_POST['complaintno'] != '') {
    $complaintno = $_REQUEST['complaintno'];
    $sql .= " and createdby LIKE '%" . $complaintno . "%'";
}

//echo $sql;

$table = mysqli_query($concs,$sql);
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

$sql .= " order by alert_id DESC LIMIT $Page_Start , $Per_Page";


$table = mysqli_query($concs, $sql);

if (mysqli_num_rows($table) > 0) {
    while ($row = mysqli_fetch_row($table)) {
       
        if (($row[17] == 'service' || $row[17] == 'pm' || $row[17] == 'dere') && $row[21] == 'amc') {
            $atm = mysqli_query($concs,"select atmid from Amc where amcid='" . $row[2] . "'");
        }

        if (($row[17] == 'service' || $row[17] == 'pm' || $row[17] == 'dere') && $row[21] == 'site') {
            $atm = mysqli_query($concs,"select atm_id from atm where track_id='" . $row[2] . "'");
        }

        //}
        $tab = mysqli_query($concs,"select feedback,standby,feed_date from eng_feedback where alert_id='" . $row[0] . "' order by id DESC");
        $row1 = mysqli_fetch_row($tab);
        //echo "eng stat".$row[15];
    $qry = mysqli_query($concs,"select cust_name from customer where cust_id='" .$row[1]. "'");
$custrow = mysqli_fetch_row($qry);
        
        ?>
<tr <?php if ($row[26] == '1') {echo "style='background:#99CC33'";}if ($row[16] == '2') {echo "style='background:#990000'";}?>>


<td width="77" valign="top"><?php echo $row[25]; ?></td> <!--ticket -->
<td width="77" valign="top"><?php echo $row[30]; ?></td>
<td width="77" valign="top"><?php echo $custrow[0]; ?></td>
<td width="72" valign="top"><?php // echo $row[17]." ".$row[2];
        if ($row[17] == 'new' || $row[17] == 'new temp' || $row[17] == 'temp_pm' || $row[17] == 'temp_dere') {echo $row[2];} else {
            $atmrow = mysqli_fetch_row($atm);
            echo $atmrow[0];}?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[3] ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>
<td width="55" valign="top">&nbsp;<?php echo $row[6] ?></td>
<td width="57" valign="top">&nbsp;<?php echo $row[4] ?></td> -->
<td valign="top">&nbsp;<?php echo $row[5] ?></td>   <!-- Address -->
<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td> <!--State-->
<td width="75" valign="top">&nbsp;<?php echo $row[9] ?></td> <!--Problem-->

<td width="75" valign="top">&nbsp;<?php
if ($row[17] == 'service' || $row[17] == 'new temp') {echo date('d/m/Y h:i:s a', strtotime($row[10]));} else {if (isset($row[11]) and $row[11] != '0000-00-00') {
            echo date('d/m/Y h:i:s a', strtotime($row[11]));
        }
        }
        ?></td>


<td width="75" valign="top">&nbsp;<?php //echo $row[17]
        if ($row[17] == 'service' || $row[17] == 'new temp') {echo "Service Call";} elseif ($row[17] == 'new') {echo "Installation Call";} elseif ($row[17] == 'pm' || $row[17] == 'temp_pm') {echo "PM Call";} elseif ($row[17] == 'dere' || $row[17] == 'temp_dere') {echo "De-Re installation Call";}

        ?></td>


<td width="75" valign="top"><?php echo $row[12] ?></td>
<td width="75" valign="top"><?php echo $row[13] ?></td>
<td width="75" valign="top">
<?php
$oldeng = mysqli_query($concs,"select engineer from alert_delegation where alert_id='" . $row[0] . "'");
        $getold = mysqli_fetch_row($oldeng);
        $fetchengid = mysqli_query($concs,"Select engg_name,phone_no1 from area_engg where engg_id='" . $getold[0] . "'");
        $getoldname = mysqli_fetch_row($fetchengid);
        echo $getoldname[0];
        ?></td>

  
  <td valign="top"> <?php echo $getoldname[1]; ?> </td>
  
  <td width="75" valign="top">&nbsp;
<?php
if (0 === strpos($row[2], 'temp')) {
            echo "PCB";
        } else
        if ($row[21] == '' || $row[21] == 'site') {echo "Under Warrenty";} else if ($row[21] == 'amc') {echo "AMC";} else {echo "PCB";}
        ?></td>

<td width="77" valign="top">&nbsp;<?php echo $row[31]; ?></td>

<!--- ==================Open  delegation Status==========   -->
<td>
 <?php 
 if($row[16]=='1' || $row[16]=='Pending') {  

 if($row[15] =='Pending'){ ?>

 <a href="delegate.php?alertid=<?php echo $row[0]?>"><font color="#000066" size="+1">Delegate</font></a>
 
 <a href="javascript:void(0);" onclick="newwin('rejected-hold.php?id=<?php echo $row[0] ?>','Reject',400,400)"><font color="white" > Reject / Hold</font></a>
 <?php  } 
  if($row[15] =='Delegated'){ ?>
 <a href="redelegateme.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>"><font color="#000066" size="+1">Redelegate</font></a>
 <a href="javascript:void(0);" onclick="newwin('rejected-hold.php?id=<?php echo $row[0] ?>','Reject',400,400)"><font color="white" > Reject / Hold</font></a>
 <?
 
 } } ?>
</td>
  <!--==========Update Remarks======-->

<td width="150">
<div height="100px" style="height:150px; overflow:hidden;">

<?php
if (mysqli_num_rows($tab) > 0) {
            ?>
<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a', strtotime($row1[2])) . "<br>" . wordwrap($row1[0], 10, "<br />\n", true); ?></a>
<?php
} else {
            echo "No Updates so far";
        }

        ?>
</div>
</td>

<td>
<?php
        if ($row[15] != 'Done' && $row[16] != 'Done' && $row[16] != 'Rejected' && $row[16] != 'onhold') {
            ?>
 <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>&br=<?php echo $br ?>&ctype=<?php echo $row[17] ?>','display',600,600)" class="update">
  Update</a>

	<?php
} else if($row[16] == 'onhold'){ ?>
    <a href="javascript:void(0);" onclick="newwin('unhold.php?id=<?php echo $row[0] ?>','unhold',400,400)"><font color="white" > Un-Hold</font></a>
<? }

        ?>
</td> 

<td>
<?php //if($row[19]=='Y')
        if ($row[15] == 'Done' || $row[16] == 'Done') {echo "Call Closed";} else if ($row[16] == 'Rejected') {echo "Call Rejected";} else if ($row[16] == 'onhold') {echo "Call is on Hold ";} else {
            echo "Pending";
        }
        ?>
 </td>
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
/*
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
}
else
{
echo "<li class='currentpage'><b> $i </b></li>";
}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if ($Page != $Num_Pages) {
    echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="export_viewalert.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>

<div id="bg" class="popup_bg"> </div>