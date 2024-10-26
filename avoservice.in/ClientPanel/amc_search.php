<?php
include 'config.php';
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

$strPage = $_REQUEST['Page'];

$sql = "Select * from Amc where 1";
if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];
    $sql .= " and atmid LIKE '%" . $id . "%'";
}
if (isset($_POST['cid']) && $_POST['cid'] != '') {
    $cid = $_POST['cid'];
    $sql .= " and cid IN(select cust_id from customer where cust_name LIKE '%" . $cid . "%')";
}
if (isset($_POST['bank']) && $_POST['bank'] != '') {
    $bank = $_REQUEST['bank'];
    $sql .= " and bankname LIKE '%" . $bank . "%'";
}
if (isset($_POST['area']) && $_POST['area'] != '') {
    $area = $_REQUEST['area'];
    $sql .= " and address LIKE '%" . $area . "%'";
}
if (isset($_POST['city']) && $_POST['city'] != '') {
    $city = $_REQUEST['city'];
    $sql .= " and city LIKE '%" . $city . "%'";
}
if (isset($_POST['state']) && $_POST['state'] != '') {
    $state = $_REQUEST['state'];
    $sql .= " and state LIKE '%" . $state . "%'";
}
if (isset($_POST['pin']) && $_POST['pin'] != '') {
    $pin = $_REQUEST['pin'];
    $sql .= " and pincode LIKE '%" . $pin . "%'";
}
if (isset($_POST['sdate']) && $_POST['sdate'] != '') {
    $sdate = $_REQUEST['sdate'];
    $sdate2 = str_replace("/", "-", $sdate);
    $sql .= " and podate LIKE '%" . date('Y-m-d', strtotime($sdate2)) . "%'";
}
if (isset($_POST['edate']) && $_POST['edate'] != '') {
    $edate = $_REQUEST['edate'];
    $edate2 = str_replace("/", "-", $edate);
    $sql .= " and podate LIKE '%" . date('Y-m-d', strtotime($edate2)) . "%'";
}

//$table=mysqli_query($conc,"select * from atm");

$table = mysqli_query($sql);

$Num_Rows = mysqli_num_rows($table);

########### pagins
?>
<div align="center">
    Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

        <?php
for ($i = 1; $i <= $Num_Rows; $i++) {
    if ($i % 10 == 0) {
        ?>
        <option value="<?php echo $i; ?>" <?php if (isset($_POST['perpg']) && $_POST['perpg'] == $i) {?>
            selected="selected" <?php }?>><?php echo $i . "/page"; ?></option>
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
$sql .= " order by amcid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table = mysqli_query($sql);
//$table=mysqli_query($conc,"select * from atm");

//$str="";
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter1($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include "config.php";

?>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
$count = 0;
// Insert a new row in the table for each person returned
if (mysqli_num_rows($table) > 0) {
    ?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" id="custtable">


    <th width="77">Customer</th>
    <th width="125">Bank</th>
    <th width="75">Area</th>
    <th width="75">City</th>
    <th width="95">State</th>
    <th width="70">Pincode</th>
    <th width="95">Address</th>
    <th width="75">ATM</th>
    <th width="206">Assets Details</th>

    <th width="45">Detail</th>
    <?php
while ($row = mysqli_fetch_row($table)) {
        $count = $count + 1;
        $qry1 = mysqli_query($conc,"select * from customer where cust_id='$row[1]'");
        $crow = mysqli_fetch_row($qry1);

        ?><tr>

        <td width="77"><?php echo $crow[1] ?></td>
        <td width="125"><?php echo $row[4] ?></td>
        <td width="75"><?php echo $row[5] ?></td>
        <td width="75"><?php echo $row[7] ?></td>
        <td width="95"><?php echo $row[8] ?></td>
        <td width="70"><?php echo $row[6] ?></td>
        <td width="75"><?php echo $row[9] ?></td>
        <td width="75"><?php echo $row[3] ?></td>

        <td width="206"><?php
$qry2me = mysqli_query($conc,"select * from amcassets where `siteid`='$row[0]'");
        while ($detail1 = mysqli_fetch_row($qry2me)) {
//echo "select * from assets_specification where ass_spc_id='$detail1[2]'";
            $qry3me = mysqli_query($conc,"select * from assets_specification where ass_spc_id='$detail1[2]'");
            $row3me = mysqli_fetch_row($qry3me);

            $qry4me = mysqli_query($conc,"select * from assets where assets_id='$row3me[1]'");
            $row4me = mysqli_fetch_row($qry4me);

            $qry5me = mysqli_query($conc,"select * from `amcpurchaseorder` where amcsiteid='" . $row[0] . "'");
            $row5me = mysqli_fetch_row($qry5me);
            if ($row5me[3] != '0000-00-00' && $row5me[4] != '0000-00-00') {
                echo $row4me[1] . " : " . "<b>" . date('d/m/Y', strtotime($row5me[3])) . "-" . date('d/m/Y', strtotime($row5me[4])) . "</b>" . "</br>";
            }

        }
        ?>
        </td>

        <td width="45" height="31"> <a href="detail1_site.php?id=<?php echo $row[0] ?>" target="_blank"> Detail
            </a>&nbsp;&nbsp;
            <a href="#" class="update"
                onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&type=amc','edit_site','width=700px,height=750,left=200,top=40')">
                Edit </a>
        </td>
        <!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
    </tr>

    <!--Total <?php //echo $Num_Rows;?> Record : -->
    <?php
}
    ?>
    <tr>
        <td colspan="10" align="center">
            <div class="pagination" style="width:100%;">
                <font size="4" color="#000">
                    <?php
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
    ?></font>
            </div>
        </td>
    </tr>
</table>
<?php }?>