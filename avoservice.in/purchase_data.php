<?php
include("access.php");
$count=0;
include("config.php");
$strPage = $_REQUEST['Page'];
$sql="Select * from purchase_order where po_status=1";

if(isset($_POST['acc']) && $_POST['acc']!='')
{
$sql.=" and loginid in(select srno from login where designation ='".$_POST['acc']."')";

}
if(isset($_POST['name']) && $_POST['name']!='')
{
$sql.=" and head_name like '%".$_POST['name']."%'";

}
if(isset($_POST['email']) && $_POST['email']!='')
{
$sql.=" and email_id like '%".$_POST['email']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$sql.=" and (phone_no1 like '%".$_POST['number']."%' or phone_no2 like '%".$_POST['number']."%')";
}
/*if(isset($_POST['state']) && $_POST['state']!='')
{
	$sql.=" and loginid in (select srno from login where branch like '%,".$_POST['state'].",%' or branch like '%,".$_POST['state']."%' or branch like '%".$_POST['state'].",%' or branch like '%".$_POST['state']."%')";
}*/
//echo $sql;
$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
?>

 <div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
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
 <?php 
########### pagins

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
$sql.=" order by po_no DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
if(mysqli_num_rows($table)>0)
{
   
?>
<table width="613" border="0" cellpadding="1" cellspacing="0"  id="custtable">
<tr>
    <th width="128">PO Number</th>
    <th width="128">Buyer Name</th>
    <th width="128">Customer</th>
    <th width="123">Delivery Type</th>
    <th width="137">GST</th>
    <th width="85">Raised By</th>

    <th width="46">TAT</th>
    <th width="46">Payment</th>
    <th width="46">Remarks</th>
    <th width="46">Date</th>
    <th width="46">Edit</th>
    <th width="56">Delete</th></tr>
<?php
while($row=mysqli_fetch_assoc($table))
{ ?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row['po_no']; ?></td>
<td><?php echo $row['buyer_id']; ?></td>
<td><?php echo $row['cust_id']; ?></td>
<td ><?php echo $row['del_type']; ?></td>
<td ><?php echo $row['gst']; ?></td>
<td ><?php echo $row['po_raiseby']; ?></td>
<td ><?php echo $row['po_tat']; ?></td>
<td ><?php echo $row['payment']; ?></td>
<td ><?php echo $row['po_remarks']; ?></td>
<td ><?php echo $row['po_time']; ?></td>

<!--<td width="46" class="update" height="31"> <a href='#'> Edit </a></td>

<td width="56" height="31" class="update">  <a href="#"> Delete </a></td>-->

<td width="46" class="update" height="31"><a href="edit_purchase_order.php?id=<?php echo $row['id'];?>"><input type="button"  value="Edit"></a></td>
<td width="46" class="delete" height="31"><a href="process_purchase_order.php?id=<?php echo $row['id'];?>&action=delete"><input type="button"  value="Delete" ></a></td>
        
</tr>
<?php //} 
}
?>
<tr><td colspan="9" align="center">
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
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
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div></td></tr></table>
<?php
}
?>