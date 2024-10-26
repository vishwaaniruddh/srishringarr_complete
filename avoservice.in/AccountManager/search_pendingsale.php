<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include '../config.php';
//require("myfunction/function.php");
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$id = "";
$cid = "";
$bank = "";
$city = "";
$area = "";
$state = "";
$pin = "";
$sdate = "";
$edate = "";
//paging
/*$page=1;//Default page
$limit=10;//Records per page
$start=0;//starts displaying records from 0
if(isset($_GET['page']) && $_GET['page']!=''){
$page=$_GET['page'];
}
$start=($page-1)*$limit;*/
//end paging
$strPage = $_REQUEST['Page'];
$type = $_POST['type'];

if ($type == "sale") {
    $noredids = "";
    $getsodetsqr = mysqli_query($con1, "select po_id from sales_orders where (status='c' or call_status='1')");
    while ($gtfrids = mysqli_fetch_array($getsodetsqr)) {
        if ($noredids == "") {
            $noredids = $gtfrids[0];
        } else {
            $noredids = $noredids . "," . $gtfrids[0];
        }

    }
}

if ($type == "sale") {
    $sql = "select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.status,b.bank_name,b.address,b.state1,b.city,b.area,b.pincode,b.podate,b.atm_id from pending_installations a,atm b where a.type='sales' and a.status<>2 and a.del_type='site_del' and a.atmid=b.track_id ";
} else {
    $sql = "select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.status,b.bank_name,b.address,b.state1,b.city,b.area,b.pincode,b.podate,b.atm_id from pending_installations a,atm b where a.type='sales' and a.status<>2 and a.del_type='ware_del' and a.atmid=b.track_id ";
}

if ($type == "sale") {

    if ($type == "sale") {
        if ($noredids != "") {
            $sql .= " and a.id not in($noredids)";
        }
    }
}

//$sql="Select * from atm where `pending_status`=1";
if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];
    $sql .= " and b.atm_id LIKE '%" . $id . "%'";
}
if (isset($_POST['cid']) && $_POST['cid'] != '') {
    $cid = $_POST['cid'];
    $sql .= " and a.cust_id IN(select cust_id from customer where cust_name LIKE '%" . $cid . "%')";
//echo $sql;
}
if (isset($_POST['bank']) && $_POST['bank'] != '') {
    $bank = $_REQUEST['bank'];
    $sql .= " and b.bank_name LIKE '%" . $bank . "%'";
}
if (isset($_POST['area']) && $_POST['area'] != '') {
    $area = $_REQUEST['area'];
    $sql .= " and b.address LIKE '%" . $area . "%'";
}
if (isset($_POST['city']) && $_POST['city'] != '') {
    $city = $_REQUEST['city'];
    $sql .= " and b.address LIKE '%" . $city . "%'";
}
if (isset($_POST['state']) && $_POST['state'] != '') {
    $state = $_REQUEST['state'];
    $sql .= " and b.state1 LIKE '%" . $state . "%'";
}
if (isset($_POST['pin']) && $_POST['pin'] != '') {
    $pin = $_REQUEST['pin'];
    $sql .= " and b.pincode LIKE '%" . $pin . "%'";
}

$table = mysqli_query($con1, $sql);

$Num_Rows = mysqli_num_rows($table);

########### pagins
?>
 <div align="center">
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
$sql .= " order by a.id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table = mysqli_query($con1, $sql);
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include "../config.php";
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable">


<th width="77">Customer</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="95">State</th>
<th width="70">Pincode</th>
<th width="70">Address</th>
<th width="75">ATM</th>
<th width="75">Start Date</th>
<th width="75">Generate Call</th>
<th width="75">Delete Call</th>
<th width="75">Updates</th>
<th width="75">Invoice</th>
<!--<th width="75">Asset Details</th>
<th width="45">Detail</th></tr>-->

<th width="45">Edit</th>
<!--<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if (mysqli_num_rows($table) > 0) {
    while ($row = mysqli_fetch_row($table)) {
//$atmdet=mysqli_query($con1,"select * from atm where track_id='".$row[0]."'");
        //$atmrow=mysqli_fetch_row($atmdet);
        $qry1 = mysqli_query($con1, "select cust_name from customer where cust_id='$row[2]'");
        $crow = mysqli_fetch_row($qry1);
        $stat = array();
//echo "select * from site_assets where cust_id='$row[2]' and po='$row[11]' and atmid='".$row[0]."'";
        //echo "Select * from site_assets where atmid = '".$row[0]."' ";
        $qry2me = mysqli_query($con1, "Select * from site_assets where atmid = '" . $row[0] . "' and callid='" . $row[8] . "'");
        while ($detailme = mysqli_fetch_row($qry2me)) {
//echo "Select * from installed_sitesme where assets like '".$detailme[3]."%' and atm_id='".$row[17]."'";
            $qryin = mysqli_query($con1, "Select * from installed_sitesme where assets like '" . $detailme[3] . "%' and atm_id='" . $row[17] . "'");
            if (mysqli_num_rows($qryin) > 0) {
                $ast = mysqli_fetch_row($qryin);
                echo $ast[1];
                //echo "hii";
                $stat[] = '1';
            } else {
                //echo "hello";
                $stat[] = 0;
            }

        }
//echo "<br>".in_array(0,$stat);
        if (in_array(0, $stat)) {
            ?><div class=article>
<div class=title><tr>
<td width="77"><?php echo $crow[0] ?></td>
<td width="125"><?php echo $row[10] ?></td>
<td width="75"><?php echo $row[14] ?></td>
<td width="75"><?php echo $row[13] ?></td>
<!---state--->
<td width="95">
<?php
//$stateshow=mysqli_query($con1,"select state from state where branch_id='".$row[7]."'");
            //$stateshow1=mysqli_fetch_row($stateshow);
            echo $row[12]; ?></td>

<td width="70"><?php echo $row[15] ?></td>
<td width="70"><?php echo $row[11] ?></td>
<td width="75"><?php echo $row[17] ?></td>
<td width="75"><?php
if (isset($row[16]) and $row[16] != '0000-00-00 00:00:00') {
                echo date('d-m-Y', strtotime($row[16]));
            }

            ?></td>
<!--<td width="75"><?php

//$qry2me=mysqli_query($con1,"select * from site_assets where cust_id='$row[2]' and po='$row[11]' and atmid='".$row[0]."'");
            //while($detailme=mysqli_fetch_row($qry2me))
            //{
            /*echo "select * from assets_specification where ass_spc_id='$detail[4]'";
            $qry3=mysqli_query($con1,"select * from assets_specification where ass_spc_id='$detail[4]'");
            $row3=mysqli_fetch_row($qry3);*/

//$validmnth=str_replace(',',' ',$detailme[5]);
            //$expdt=date('d-m-Y', strtotime($row[13] .' +'.$validmnth));

//echo $detailme[3]."(".str_replace(',',' ',$detailme[5]).")"." <b>/".$expdt."</b>"."</br>";
            //}
            ?>
</td>-->
<!--<td width="45" height="31"> <a href="newalert1.php?cust=<?php echo $cid; ?>&atmid=<?php echo $row[1]; ?>&trackid=<?php echo $row[0]; ?>" target="_blank"> Generate Call</a>&nbsp;&nbsp;</td>-->


<td width="45" height="31">
<?php

            $gcsts = 1;
            $reas = "";

            $gtsofrmtable = mysqli_query($con1, "select status,call_status from sales_orders where po_id='" . $row[8] . "'");
            $gtsofrmtablenum = mysqli_num_rows($gtsofrmtable);

            if ($gtsofrmtablenum > 0) {
                $frrw = mysqli_fetch_array($gtsofrmtable);

//echo $frrw[1];

                if ($frrw[0] == "h") {
                    $gcsts = 0;
                    $reas = "On Hold";
                }

                if ($frrw[0] == "c") {
                    $gcsts = 0;
                    $reas = "SO Cancelled";
                }

                if ($frrw[1] == "1") {
                    $gcsts = 0;
                    $reas = "Call Cancelled";
                }

            }

            if ($row[9] == 0 and $type == "sale") {
                echo "Waiting for SO";
            } else {
                if ($gcsts == 1) {
                    ?>
<a href="javascript:confirm_generate('<?php echo $row[2]; ?>','<?php echo $row[17]; ?>','<?php echo $row[0]; ?>','<?php echo $row[8]; ?>');" > Generate Call</a>
<?php
} else {
                    echo $reas;
                }
            }?>
</td>
<td width="45" height="31">
<?php
if ($row[9] == 0) {?>
<a href="javascript:confirm_delete('<?php echo $row[0]; ?>');" > Delete Call</a>
<?php }?>
</td>
<?php $qry_soupdt = mysqli_query($con1, "select Remarks_update from SO_Update where po_id='" . $row[8] . "' order by updt_id DESC");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
            $fetchsoupdt = mysqli_fetch_array($qry_soupdt);
            ?>
<td> <?php echo $fetchsoupdt[0]; ?><br><a href="javascript:void(0);" onclick="window.open('../view_SO.php?id=<?php echo $row[8] ?>','view updates','width=700px,height=750,left=200,top=40')" class="update" >View All</a></td>
<td><?php
$qry_inv = mysqli_query($con1, "select inv_img from sales_orders where po_id='" . $row[8] . "'");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
            $fetchinv = mysqli_fetch_array($qry_inv);
            if ($fetchinv[0] != null) {?>
<a href="<?php echo '../' . $fetchinv[0]; ?>" target="_blank" ><image src="<?php echo '../' . $fetchinv[0]; ?>" alt="no attachment" width="50" height="50" /></a>
<?php }?>
</td>
<!--<td width="45" height="31"> <a href="detail_site.php?id=<?php echo $atmrow[0] ?>" target="_blank"> Detail </a>&nbsp;&nbsp;
<a href="#" onClick="window.open('edit_site.php?id=<?php echo $atmrow[0]; ?>&type=new','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>
</td>-->
<!--

<td width="50" height="31">  <a href="javascript:confirm_delete('.$atmrow[0].');"> Delete </a></td>-->
<td width="45" height="31"> <a href="javscript:void(0);" onclick='window.open("../edit_SO.php?id=<?php echo $row[8]; ?>","_blank");'> Edit </a></td>
</tr></div></div><?php
}
    }

    ?>

</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if ($Prev_Page) {
    echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
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
if ($Page != $Num_Pages) {
    echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?>