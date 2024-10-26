<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection

//echo "Hi--------";

//die;

	$strPage = $_REQUEST['Page'];
 $br=$_POST['br'];
//==========================================	
if($_POST['br']=='all')
 $sql="Select * from atm where active='Y' and site_type='opex'";
else
 $sql="Select * from atm where active='Y' and site_type='opex' and branch_id in(".$br.") ";	
	
	
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atm_id LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and cust_id IN('".$cid."')";
}

if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and address LIKE '%".$city."%'";
}

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id='".$branch."'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and pincode LIKE '%".$pin."%'";
}

//echo $sql;

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
$sql.=" order by track_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

include("config.php");
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Vertical/Customer</th>
<th width="40">End User</th>
<th width="50">Area</th>
<th width="50">City</th>
<th width="95">State</th>
<th width="95">Branch</th>
<th width="70">Pincode</th>
<th width="70">Address</th>
<th width="75">Sol/Sol/ATM Id</th>

<th width="70">Latest PO Date</th>
<th width="70">UPS Start Date</th>
<th width="70">UPS Expiry Date</th>
<th width="100">Assets in Warranty </th>
<th width="100">Assets out of Warranty </th>
<th width="45">Detail</th></tr>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
	
$qry1=mysqli_query($con1,"select cust_name from customer where cust_id='$row[2]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[7]'");
$bran=mysqli_fetch_row($qrybr);	

?><div class=article>
<div class=title><tr>

<td width="77"><?php echo $crow[0] ?></td>
<td width="40"><?php echo $row[3] ?></td>
<td width="50"><?php echo $row[4] ?></td>
<td width="50"><?php echo $row[6] ?></td>
<!---state-->
<td width="95"><?php echo $row[15] ?></td>

<td width="95"><?php echo $bran[0] ?></td>

<td width="70"><?php echo $row[5] ?></td>
<td width="70"><?php echo $row[9] ?></td>
<td width="75"><?php echo $row[1] ?></td>


<td width="75"><?php echo date('d-m-Y',strtotime($row[13])) ?></td>

<? //=========== Show latest UPS start-exp date======= 
$qryas=mysqli_query($con1,"select po_date, start_date, exp_date from site_assets where atmid='".$row[0]."' and assets_name ='UPS' order by site_ass_id DESC limit 1");
$dt=mysqli_fetch_row($qryas);

?>

<td width="75"><?php echo $dt[1]; ?></td>
<td width="75"><?php echo $dt[2]; ?></td>

<td style="width: 22%;"><?php 
//===============Assets in warranty
$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."' and status=1");

//echo "select * from site_assets where cust_id='$row[2]' and atmid='".$row[0]."' and status=1";

while($ast=mysqli_fetch_row($qry2me))
{

echo $ast[3]."(".str_replace(',',' ',$ast[5]).") ".$ast[16]." to ".$ast[18]."</br>";
} ?>  </td>

<td style="width: 17%;"><?php 
//=========Assets in O/O warr=========
$qry2me=mysqli_query($con1,"select * from site_assets where cust_id='$row[2]' and atmid='".$row[0]."' and status=0");

while($ast=mysqli_fetch_row($qry2me))
{
echo $ast[3]."(".str_replace(',',' ',$ast[5]).") ".$ast[16]." to ".$ast[18]."</br>";
} ?>  </td>

<td width="45" height="31"> 

<!--<a href="detail_site.php?id=<?php echo $row[0] ?>" target="_blank"> Detail </a>&nbsp;&nbsp; -->
<a href="#" onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&type=new','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>&nbsp;&nbsp;
<!--  <a href="javascript:confirm_delete('<?php echo $row[0]; ?>','atm');"> DeActivate </a> -->
</td>
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
<form name="frm" method="post" action="exportallamc.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>