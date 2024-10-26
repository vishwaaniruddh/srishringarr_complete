<?php
include('config.php');
############# must create your db base connection


$strPage = $_REQUEST['Page'];
$br=$_POST['br'];
	
//====================================Search start here	
if($_POST['br']=='all')
  $sql="Select a.*, b.track_id from Amc a, atm b where a.atmid=b.atm_id and a.active='Y'";
else
 $sql="Select a.*, b.track_id from Amc a, atm b where a.atmid=b.atm_id and a.active='Y' and a.branch in (".$br.")";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and a.atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.CID IN(select cust_id from customer where cust_id ='".$cid."')";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and a.bankname LIKE '%".$bank."%'";
}
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and a.BRANCH='".$branch."'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and a.address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and a.city LIKE '%".$city."%'";
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
$sql.=" order by a.amcid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;

$qry12=mysqli_query($con1,$sql);

include("config.php");


$count=0;

if(mysqli_num_rows($table)>0) {
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Verical/Customer</th>
<th width="125">End User</th>
<th width="75">Landmark</th>
<th width="75">City</th>
<th width="95">State</th>
<th width="95">Branch</th>
<th width="70">Pincode</th>
<th width="125">Address</th>
<th width="75">Site/Sol/ATM Id</th>
<th width="75">AMC Start date</th>
<th width="75">AMC End Date</th>
<th width="100">Status</th>
<th width="100">Assets Details</th>

<?php
while($row= mysqli_fetch_row($qry12))
{
$count=$count+1;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);
$qry2=mysqli_query($con1,"select name  from avo_branch where id='$row[8]'");
$branch=mysqli_fetch_row($qry2);

?><tr>

<td width="77"><?php echo $crow[1] ?></td>
<td width="125"><?php echo $row[4]?></td>
<td width="75"><?php echo $row[5]?></td>
<td width="75"><?php echo $row[7]?></td>
<td width="95"><?php echo $row[10]?></td>
<td width="95"><?php echo $branch[0]?></td>
<td width="70"><?php echo $row[6]?></td>
<td width="125"><?php echo $row[9]?></td>
<td width="75"><?php echo $row[3]?></td>
<td width="75"><?php echo $row[12]?></td>
<td width="75"><?php echo $row[25]?></td>



<?php 
$warqry=mysqli_query($con1,"select * from site_assets where atmid='$row[38]' and status=1");
if(mysqli_num_rows($warqry) >0){
$status="Some Products in Warranty";
} else {$status="Products Out of Warr";} ?>

<td width="75"><?php echo $status?></td>
<?
$ii=1; ?>
<td width="100">
<?
while($ast=mysqli_fetch_row($warqry))
{

$ii++;

$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$ast[4]'");
$spec=mysqli_fetch_row($qry3me);

echo $ast[3]."(".$spec[0].") ".$ast[16]." to ".$ast[18]."</br>";

}
?>
</td>
</tr>

<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
?>
<tr><td colspan="10" align="center">
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<?php
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div></td></tr></table>

<form name="frm" method="post" action="exportamc_warrsites.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
<?php } ?>