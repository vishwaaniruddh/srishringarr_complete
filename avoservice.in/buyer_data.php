<?php
include("access.php");error_reporting(0);
$strPage = $_REQUEST['Page'];
$msg = '';
function delete($id){
    $sql = mysqli_query($con1,"update buyer set status = 2 where buyer_ID= ".$id);
    if($sql){
        $msg = "Deleted successfully!";
        echo '<script>alert("Deleted successfully!")</script>';
    }
}

function edit_data($id){
    $sql = mysqli_query($con1,"update buyer set status = 2 where buyer_ID= ",$id);
    if($sql){
        $msg = "Updated successfully!";
    }
}
?>


<form name="frm1" method="post" action='changeandroid.php'>
    
<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">
    <tr>
        <th width="200">buyer_name</th>
        <th width="100">buyer_segment</th>
        <th width="82">Branch</th>
        <th width="80">buyer_exec</th>
        <th width="92">buyer_city</th>
        <th width="92">Address</th>
        <th width="92">State</th>
        <th width="92">GST</th>
        <th width="47">Pin</th>
        <th width="92">Contact</th>
        <th width="47">Designation</th>
        <th width="92">Phone</th>
        <th width="47">Mail</th>
        <th width="92">Phone2</th>
        <th width="47">Created Date</th>
        <th width="47">Action</th>
    </tr>
<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];


/*if($_SESSION['branch']=='all' || $_SESSION['branch']=='0')
{
$str.="select e.`engg_id`, e.`engg_name`, e.`area`, e.`city`, e.`email_id`, e.`phone_no1`, e.`emp_code`, e.`resume`,l.username,e.status,l.password,e.loginid,e.current_area, e.engg_desgn, e.date_join from area_engg e,login l where e.deleted=0 and e.loginid=l.srno";
}
else
$str.="select e.`engg_id`, e.`engg_name`, e.`area`, e.`city`, e.`email_id`, e.`phone_no1`, e.`emp_code`, e.`resume`,l.username,e.status,1.password,e.loginid,e.current_area, e.engg_desgn, e.date_join from area_engg e,login l where e.deleted=0 and e.loginid=l.srno and e.area in (".$_SESSION['branch'].")";

//echo $str;
if(isset($_POST['name']) && $_POST['name']!='')
{
$str.=" and e.engg_name like '%".$_POST['name']."%'";

}
if(isset($_POST['email']) && $_POST['email']!='')
{
$str.=" and e.emp_code like '%".$_POST['email']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$str.=" and e.phone_no1 like '%".$_POST['number']."%'";
}
$table=mysqli_query($con1,$str);

$Num_Rows = mysqli_num_rows ($table);*/
?>
 <?php 
 /*<div align="center">Total Number Of Records :>> 
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div> 
 */ ?>
 <?php
########### pagins
/*
$Per_Page =$_POST['perpg'];;   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
*/
//$str.=" order by e.engg_name ASC  LIMIT $Page_Start , $Per_Page";
$query ="Select * from buyer where status = 1";

$qry=mysqli_query($con1,$query);
while($row=mysqli_fetch_assoc($qry))
{
    $count=$count+1;

$customer_qry = mysqli_query($con1,"select * from customer where cust_id= ".$row['buyer_vertical']);
$customer_result = mysqli_fetch_assoc($customer_qry); 

$branch_qry = mysqli_query($con1,"select * from avo_branch  where id = ".$row['avo_branch']);
$branch_result = mysqli_fetch_assoc($branch_qry); 

$state_qry = mysqli_query($con1,"select * from state where state_id=".$row['buyer_state']);
$state_result = mysqli_fetch_assoc($state_qry); 

$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where status=1 and exe_id=".$row['buyer_executive']);

$executive_result = mysqli_fetch_assoc($executive_qry); 

?>
<tr >
    <td ><?php echo $row['buyer_name']; ?></td>
    <td><?php echo $customer_result['cust_name']; ?></td>
    <td ><?php echo $branch_result['name']; ?></td>
    <td ><?php echo $executive_result['exe_name']; ?></td>
    <td ><?php echo $row['buyer_city']; ?></td>
    <td ><?php echo $row['buyer_address']; ?></td>
    <td ><?php echo $state_result['state']; ?></td>
    <td ><?php echo $row['buyer_gst']; ?></td>
    <td ><?php echo $row['buyer_pin']; ?></td>
    <td ><?php echo $row['buyer_contact']; ?></td>
    <td ><?php echo $row['buyer_designation']; ?></td>
    <td ><?php echo $row['buyer_phone']; ?></td>
    <td ><?php echo $row['buyer_mail']; ?></td>
    <td ><?php echo $row['buyer_phone2']; ?></td>
    <td ><?php echo $row['created_date']; ?></td>
    <td >
        <a href="buyers_form.php?id=<?php echo $row['buyer_ID'];?>&action=edit"><input type="button"  value="Edit"></a>
        <a href="edit_buyer.php?id=<?php echo $row['buyer_ID'];?>&action=delete"><input type="button"  value="Delete" ></a>
    </td>
</tr>
<?php } ?>
</table>

</form>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
/*
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}*/
?></font></div>