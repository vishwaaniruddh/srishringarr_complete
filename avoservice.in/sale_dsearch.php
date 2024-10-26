<?php
include('config.php');

$strPage = $_REQUEST['Page'];
	
 $br=$_POST['br'];

//==========================================	
if($_POST['br']=='all')
//$sql="Select a.* from atm a, site_assets b where a.track_id=b.atmid and a.branch_id <>'' and a.cust_id <>'' and b.exp_date >'2023-08-31' and b.start_date <'2023-01-01' and b.assets_name= 'Battery' ";
//b.start_date <'2023-01-01'
$sql="Select * from atm where active='N' and branch_id <>'' and cust_id <>''";
 
//  $sql="Select * from atm where active='N'";
else
 $sql="Select * from atm where active='N' and branch_id in(".$br.") and cust_id <>''";	
	
	
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atm_id LIKE '%".$id."%'";
}
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id='".$branch."'";
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

if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and pincode LIKE '%".$pin."%'";
}

//echo $sql;

$table=mysqli_query($con1, $sql);

$Num_Rows = mysqli_num_rows($table);

//echo "Count".$Num_Rows;
 
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
	$Num_Pages = $Num_Pages;
}
$qry22=$sql;

$sql.=" order by track_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$qryy=mysqli_query($con1,$sql);


?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Verical /Customer</th>
<th width="125">End User</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="100">Address</th>
<th width="100">Branch</th>
<th width="75">Site/Sol/ATM Id</th>

<th width="75">PO Date</th>
<th width="75">UPS Start Date</th>
<th width="75">UPS Expiry Date</th>
<th width="100">Assets in Warranty</th>
<th width="100">Assets out of Warranty</th>
<th width="45">Detail</th></tr>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($qryy)>0) {
while($row= mysqli_fetch_row($qryy))
{
	
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[2]'");
$crow=mysqli_fetch_row($qry1);	
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[7]'");
$bran=mysqli_fetch_row($qrybr);	

?><div class=article>
<div class=title><tr>

<td width="77"><?php echo $crow[1] ?></td>
<td width="125"><?php echo $row[3] ?></td>
<td width="75"><?php echo $row[4] ?></td>
<td width="75"><?php echo $row[6] ?></td>
<td width="100"><?php echo $row[9] ?></td>
<td width="100"><?php echo $bran[0] ?></td>

<td width="75"><?php echo $row[1] ?></td>

<td width="75"><?php echo $row[13];?></td>

<? //=========== Show latest UPS start-exp date======= 
$qryas=mysqli_query($con1,"select start_date, exp_date from site_assets where atmid='".$row[0]."' and assets_name like '%UPS%' order by site_ass_id DESC limit 1");
$dt=mysqli_fetch_row($qryas);
?>

<td width="75"><?php echo $dt[0]; ?></td>
<td width="75"><?php echo $dt[1]; ?></td>  

<td style="width: 18%;"> 
<?php 

//================Assets in warranty=====
$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."' and cust_id='$row[2]' and status=1");

while($detailme=mysqli_fetch_row($qry2me))
{ 
echo $detailme[3]."(".str_replace(',',' ',$detailme[5]).") ".$detailme[16]." to ".$detailme[18]."</br>";
 }  ?>
</td> 

<td style="width: 18%;"><?php 
//================Assets out of warranty=====
$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."' and cust_id='$row[2]' and status=0");

while($detailme=mysqli_fetch_row($qry2me))
{
echo $detailme[3]."(".str_replace(',',' ',$detailme[5]).") ".$detailme[16]." to ".$detailme[18]."</br>";
} 
?>
</td>



<td width="45" height="31"> <a href="detail_site.php?id=<?php echo $row[0] ?>" target="_blank"> Detail </a>&nbsp;&nbsp;
<a href="#" onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&type=new','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>&nbsp;&nbsp;
<!--  <a href="javascript:confirm_delete('<?php echo $row[0]; ?>','atm');"> DeActivate </a> -->
</td>
<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.<?php echo $row[0]; ?>.');"> Delete </a></td>-->
</tr></div></div><?php
}

?></table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
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
<form name="frm" method="post" action="export_owarr.php" target="_new">
    
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>