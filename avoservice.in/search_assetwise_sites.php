<?php
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection

$strPage = $_REQUEST['Page'];
 $br=$_POST['br'];
//==========================================

if(isset($_POST['type']) && $_POST['type']!='')
{
    $type=$_POST['type'];

$sql="Select a.*, b.* from atm a, site_assets b where a.track_id=b.atmid and b.assets_name='".$type."' ";  
}
if(isset($_POST['specs']) && $_POST['specs']!='')
{
$specs=$_POST['specs']; 
$sql.=" and b.assets_spec ='".$specs."'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.cust_id IN('".$cid."')";
}


if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id='".$branch."'";
}

$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins
?>
 <div align="center"><b>Total Records: <?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
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
$qry22=$sql;
$sql.=" order by a.track_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);


?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Vertical/Customer</th>
<th width="40">End User</th>

<th width="50">City</th>
<th width="95">State</th>
<th width="95">Branch</th>
<th width="70">Pincode</th>
<th width="50">Landmark</th>
<th width="70">Address</th>
<th width="75">Sol/Sol/ATM Id</th>

<th width="70">PO No.</th>
<th width="70">Warranty Status</th>
<th width="70">Product Name</th>
<th width="70">Specification</th>
<th width="70">Warranty Term</th>
<th width="70">Qty</th>
<th width="70">Start Date</th>
<th width="70">Expiry Date</th>

<th width="100">All Assets </th>


<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_assoc($table))
{
	
$qry1=mysqli_query($con1,"select cust_name from customer where cust_id= '".$row['cust_id']."'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='".$row['branch_id']."'");
$bran=mysqli_fetch_row($qrybr);	

?><div class=article>
<div class=title><tr>

<td width="77"><?php echo $crow[0] ?></td>
<td width="40"><?php echo $row['bank_name'] ?></td>

<td width="50"><?php echo $row['city'] ?></td>
<!---state-->
<td width="95"><?php echo $row['state1'] ?></td>

<td width="95"><?php echo $bran[0] ?></td>

<td width="70"><?php echo $row['pincode'] ?></td>
<td width="50"><?php echo $row['area'] ?></td>
<td width="70"><?php echo $row['address'] ?></td>
<td width="75"><?php echo $row['atm_id'] ?></td>


<td width="75"><?php echo date('d-m-Y',strtotime($row[13])) ?></td>

<?php if($row['status']==1) { $stat= "In-Warranty";} 

else { $stat= "Out of Warr";} ?>
<td width="75"><?php echo $stat?></td>

<td width="75"><?php echo $row['assets_name'] ?></td>
<?php
$spcme1=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row['assets_spec']."' ");
$spc_name1=mysqli_fetch_row($spcme1); ?>
<td width="75"><?php echo $spc_name1[0] ?></td>

<td width="75"><?php echo $row['valid'] ?></td>
<td width="75"><?php echo $row['quantity'] ?></td>
<td width="75"><?php echo $row['start_date'] ?></td>
<td width="75"><?php echo $row['exp_date'] ?></td>

<td style="width: 17%;"><?php
//===============Assets=============
$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row['track_id']."'");

while($ast=mysqli_fetch_row($qry2me))
{
$spcme=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$ast[4]."' ");
$spc_name=mysqli_fetch_row($spcme); 
echo $ast[3]."(".$spc_name[0].") ".$ast[16]." to ".$ast[18]."</br>";

} ?>  </td>


<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.<?php echo $row[0]; ?>.');"> Delete </a></td>-->
</tr></div></div><?php
}

?></table>
<div class="pagination" style="width:90%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?> 
<form name="frm" method="post" action="export_assetwise_site.php" target="_new">
<input type="hidden" name="prod" value="<?php echo $type; ?>" readonly>    
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>