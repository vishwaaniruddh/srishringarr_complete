<?php
session_start();
echo $_SESSION['user'] . " " . $_SESSION['branch'] . " " . $_SESSION['designation'];

include 'config.php';
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
//echo $_POST['br'];
$id = "";
$cid = "";
$bank = "";
$city = "";
$area = "";
$state = "";
//$br="Mumbai";
$bran = array();
//echo $_SESSION['branch'];

//$br=$_SESSION['branch'];
$br = $_POST['br'];
if ($_POST['br'] != 'all') {
    $br1 = str_replace(",", "','", $br); //echo $br1[0]."/".$br1[1];
    $br1 = "'" . $br1 . "'";
//echo $br1;
    //echo "select state from state where state_id in (".$br1.")";
    //echo "select state from state where state_id in (".$br1.")";
    $src = mysqli_query($con1, "select state from state where state_id in (" . $br1 . ")");
    while ($srcrow = mysqli_fetch_array($src)) {
        $bran[] = $srcrow[0];
    }
    $br3 = implode(",", $bran);
    $br2 = str_replace(",", "','", $br3); //echo $br1[0]."/".$br1[1];
    $br2 = "'" . $br2 . "'";
}
$str = "";
//for($i=0;$i<count($br1);$i++){
//echo "select * from alert where state='$br1[$i]'";
//$table=mysqli_query($con1,"select * from alert where state='$br1[$i]'");
//include_once('class_files/generic_filter.php');
//$filter= new generic_filter();

//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');

$form=new table_formation();
$form->table_forming(array("","","","","","","","","","",""),$table,"n");*/

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr><th width="77">Complain ID</th>
<th width="77">Client Docket Number</th>
<th width="77">Name</th>
<th width="72">ATM</th>
<th width="71">Bank</th>
<th width="55">City</th>
<th width="57">Area</th>
<th width="207">Address</th>
<th width="207">State</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>
<th width="75"> Delegated To</th>
<th width="75"> Customer Status</th>
<th width="100">Engineer Last FeedBack</th>
<th width="67">Status</th>

<th width="48">Update</th></tr>
<?php
include "config.php";

//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if ($_POST['br'] == 'all') {
    if (isset($_POST['state']) && $_POST['state'] != '') {$stt = $_POST['state'];
        $sql .= "Select * from alert where state like ('%" . $stt . "%') ";
    } else {
        $sql .= "Select * from alert where 1";
    }

} else {
    if (isset($_POST['state']) && $_POST['state'] != '') {$stt = $_POST['state'];
        $sql .= "Select * from alert where state like ('%" . $stt . "%') ";
    } else {
        $sql .= "Select * from alert where state in (" . $br2 . ") ";
    }

}
if (isset($_POST['calltype'])) {
    $calltype = $_REQUEST['calltype'];
    if ($calltype == '') {
    } elseif ($calltype == 'open') {
        $sql .= " and (call_status = 'Pending' or call_status='1' or call_status='2') and atm_id<>'temp_'";
        echo $sql;
    } elseif ($calltype == 'Done') {
        $sql .= " and call_status = 'Done'";
    } elseif ($calltype == 'onhold') {
        $sql .= " and call_status = 'onhold'";
    } elseif ($calltype == 'Rejected') {
        $sql .= " and call_status = 'Rejected'";
    }

}
if (isset($_POST['eng']) && $_POST['eng'] != '') {
    $eng = $_POST['eng'];
    $sql .= " and alert_id in (select alert_id from alert_delegation where engineer='" . $eng . "' )";
}
if (isset($_POST['fromdt']) && $_POST['fromdt'] != '' && isset($_POST['todt']) && $_POST['todt'] != '') {
    $fromdt = $_POST['fromdt'];
    $todt = $_POST['todt'];
//$dtme=$todt." 11:59:00";
    $sql .= " and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
//$sql.=" and `entry_date` Between FROM_UNIXTIME($fromdt) AND FROM_UNIXTIME($todt)";
    echo $sql;
}
if (isset($_POST['atmid']) && $_POST['atmid'] != '') {
    $id = $_POST['atmid'];
    $qr = mysqli_query($con1, "select track_id from atm where atm_id LIKE '%" . $id . "%'");
    $qr2 = mysqli_query($con1, "select amcid from Amc where atmid LIKE '%" . $id . "%'");
    $qr3 = mysqli_query($con1, "select atm_id from alert where atm_id LIKE '%" . $id . "%'");
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

//$sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%') or atm_id LIKE '%".$id."%'))";
    if ($r1 == '0' && $r2 == '0') {
        $sql .= " and atm_id LIKE '%" . $id . "%' ";
    } else {
        $sql .= " or atm_id LIKE '%" . $id . "%' ) ";
    }

}
if (isset($_POST['cid']) && $_POST['cid'] != '') {
    $cid = $_POST['cid'];
    $sql .= " and cust_id ='" . $cid . "'";
}

if (isset($_POST['bank']) && $_POST['bank'] != '') {
    $bank = $_REQUEST['bank'];
    $sql .= " and bank_name LIKE '%" . $bank . "%'";
}
if (isset($_POST['sitetp']) && $_POST['sitetp'] != '') {
    $sitetp = $_REQUEST['sitetp'];
    $sql .= " and alert_type ='" . $sitetp . "'";
}
if (isset($_POST['docket']) && $_POST['docket'] != '') {
    $docket = $_REQUEST['docket'];
    $sql .= " and custdoctno LIKE '%" . $docket . "%'";
}

if (isset($_POST['area']) && $_POST['area'] != '') {
    $area = $_REQUEST['area'];
    $sql .= " and address LIKE '%" . $area . "%'";
}

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table = mysqli_query($con1, $sql);
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
$sql .= " order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table = mysqli_query($con1, $sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if (mysqli_num_rows($table) > 0) {
    while ($row = mysqli_fetch_row($table)) {

        include "config.php";

        if ($row[17] == 'service' && $row[21] == 'amc') {
            $atm = mysqli_query($con1, "select atmid from Amc where amcid='" . $row[2] . "'");
        }

        if ($row[17] == 'service' && $row[21] == 'site') {
            $atm = mysqli_query($con1, "select atm_id from atm where track_id='" . $row[2] . "'");
        }

        $qry = mysqli_query($con1, "select cust_name from customer where cust_id='" . $row[1] . "'");
        $custrow = mysqli_fetch_row($qry);
        $tab = mysqli_query($con1, "select feedback,standby from eng_feedback where alert_id='" . $row[0] . "' order by id DESC");
        $row1 = mysqli_fetch_row($tab);
        //echo "eng stat".$row[15];
        ?>
<tr <?php if ($row[26] == '1') {echo "style='background:#99CC33'";}if ($row[16] == '2') {echo "style='background:#990000'";}?>>
<td width="77" valign="top">&nbsp;<?php echo $row[25]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo $row[30]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td width="72" valign="top">&nbsp;<?php // echo $row[17]." ".$row[2];
        if ($row[17] == 'new' || $row[17] == 'new temp') {echo $row[2];} else {
            $atmrow = mysqli_fetch_row($atm);
            echo $atmrow[0];}?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[3] ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td width="55" valign="top">&nbsp;<?php echo $row[6] ?></td>
<td width="57" valign="top">&nbsp;<?php echo $row[4] ?></td>
<td valign="top">&nbsp;<?php echo $row[5] ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>
<td width="75" valign="top">&nbsp;<?php
// echo $row[9];
        if ($row[28] == '1') {
            //echo "select desc from buyback where alertid='".$row[0]."'";
            $buy = mysqli_query($con1, "select * from buyback where alertid='" . $row[0] . "'");
            $buyro = mysqli_fetch_row($buy);
            echo "<br><b>Buy Back :</b>" . $buyro[2] . "<br>";

        }
        echo $row[9];
        ?></td>
<td width="75" valign="top">&nbsp;<?php
if ($row[17] == 'service' || $row[17] == 'new temp') {echo date('d/m/Y h:i:s a', strtotime($row[10]));} else {if (isset($row[11]) and $row[11] != '0000-00-00') {
            echo date('d/m/Y h:i:s a', strtotime($row[11]));
        }
        }
        ?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[12] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[13] ?></td>
<td width="75" valign="top">&nbsp;
<?php
$oldeng = mysqli_query($con1, "select engineer from alert_delegation where alert_id='" . $row[0] . "'");
        $getold = mysqli_fetch_row($oldeng);
        $fetchengid = mysqli_query($con1, "Select engg_name from area_engg where engg_id='" . $getold[0] . "'");
        $getoldname = mysqli_fetch_row($fetchengid);
        echo $getoldname[0];
        ?></td>

  <td width="75" valign="top">&nbsp;
<?php
if (0 === strpos($row[2], 'temp')) {
            echo "PCB";
        } else
        if ($row[21] == '' || $row[21] == 'site') {echo "Under Warrenty";} else if ($row[21] == 'amc') {echo "AMC";} else {echo "PCB";}
        ?></td>
<td valign="top">&nbsp;<?php if ($row1[0] != '') {?><a class="update" href="#" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display')" ><?php echo $row1[0]; ?></a><?php } else {
            $al = mysqli_query($con1, "select feedback from eng_feedback where alert_id='" . $row[0] . "' order by id DESC limit 1");
            $alro = mysqli_fetch_row($al);
            echo $alro[0];
        }?></td>
 <td>
 <?php if ($row[15] != 'Done') {?>
 <br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=wait">Standby Close</a>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
 <?php
}
        //echo $_POST['br']." ".$_SESSION['user'];
        if ($row[16] == '1') {
            //echo $row[15]." ".$row[16];
            if ($row[15] != 'Delegated') {

                if ($row[15] != 'Done') {
                    ?><br><a href="delegate.php?req=<?php echo $row[0] ?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2] ?>&br=<?php echo $br; ?>">Delegate</a>
<?php
}
            }

            if ($row[15] == 'Done') {
//echo $row[16];
                ?>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=wait">Standby Close</a>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
<?php
}
            if ($row[15] == 'Delegated') {
                echo "Delegated";
            }

            if ($row[16] != '1') {
                echo $row[16];
                ?>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=wait">Standby Close</a>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
<?php }
        } elseif ($row[16] == 'Pending') {
            echo $row[16];
            if ($row[26] != '1') {
                ?>
<br><a href="decision.php?alertid=<?php echo $row[0] ?>">Questions</a>
<?php
//echo "select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' order by id DESC limit 1";
                $qr = mysqli_query($con1, "select * from transfersites where alertid='" . $row[0] . "' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");

                ?><br />

<a class="update" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer')"  href="#"  >Transfer<?php if (mysqli_num_rows($qr) > 0) {
                    $qrro = mysqli_fetch_row($qr);
                    echo " Failed<br>Reason :" . $qrro[6];}?></a>
<?php
} else {
                echo "<br><br>Under Transferring Process";
            }

        } elseif ($row[16] == 'onhold') {
            echo "<br><a href=unhold.php?id=$row[0]>Unhold</a>";

        } elseif ($row[16] == 'Rejected') {
            echo $row[16];
        } elseif ($row[16] == '2') {
            ?>
<br><a href="notify.php?req=<?php echo $row[0] ?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>
<?php } elseif ($row[16] == 'Done') {
            ?>
Call Closed
<?php }

        ?>
 </td>

 <td>
 <?php
// echo $row[16]
        if (($row[16] == 'Delegated' || $row[16] == '2' || $row[16] == '1') && $row[26] != '1') {
            ?>
	<a href="update.php?id=<?php echo $row[0] ?>&br=<?php echo $br ?>" style="text-decoration:none">Update</a>
	<?php
}

        ?><a class="update" href="#" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>','display')" >View Update</a>
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
<form name="frm" method="post" action="exportme2.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>

<div id="bg" class="popup_bg"> </div>