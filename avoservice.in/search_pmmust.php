<?php
session_start();
include('config.php');
############# must create your db base connection


$strPage = $_REQUEST['Page'];
$br=$_POST['br'];
$branch=$_SESSION['branch'];

if($_SESSION['branch']=='all') {
$sql="Select a.* from Amc a, amc_pm_sites b where a.amcid=b.site_id and a.active='Y' ";

} else 

$sql="Select a.* from Amc a, amc_pm_sites b where a.amcid=b.site_id and a.active='Y' and a.branch in (".$br.") ";


if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and a.atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.CID ='".$cid."'";
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

$table1=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table1);
 
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
$sql.=" order by a.amcid ASC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

include("config.php");
$count=0;

if(mysqli_num_rows($table)>0) {
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Verical/Customer</th>
<th width="100">End User</th>
<!--<th width="75">Landmark</th> -->
<th width="50">City</th>
<th width="50">State</th>
<th width="65">Branch</th>
<th width="125">Address</th>
<th width="50">Site/Sol/ATM Id</th>

<th width="75">AMC Start</th>
<th width="75">AMC Expiry</th>

<th width="40">PM Required</th>

<th width="50">Calls Done in this AMC period</th>
<th width="75">Last Call Done</th>
<th width="75">Ageing from Last Call</th>


<th width="45">Detail</th>
<?php

while($row=mysqli_fetch_row($table)) {

$count=$count+1;
$qry1=mysqli_query($con1,"select cust_name from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);
$qry2=mysqli_query($con1,"select name  from avo_branch where id='$row[8]'");
$branch=mysqli_fetch_row($qry2);

?><tr>

<td width="77"><?php echo $crow[0] ?></td>
<td width="125"><?php echo $row[4]?></td>
<!--<td width="75"><?php echo $row[5]?></td> -->
<td width="75"><?php echo $row[7]?></td>
<td width="95"><?php echo $row[10]?></td>
<td width="95"><?php echo $branch[0]?></td>
<td width="125"><?php echo $row[9]?></td>
<td width="75"><?php echo $row[3]?></td>

<td width="75"><?php echo $row[12]?></td>
<td width="75"><?php echo $row[25]?></td>
<?php 

$assetqry=mysqli_query($con1,"select pm_reqd from amc_pm_sites where site_id='$row[0]'");
$pmreqd=mysqli_fetch_row($assetqry); ?>

<td width="75"style='text-align:center;'><?php echo $pmreqd[0]?></td>

<?
/*

$exp= $det[18];
$sixmonth = date('Y-m-d', strtotime("+6 months $exp"));
$oneyear = date('Y-m-d', strtotime("+12 months $exp"));
$two= date('Y-m-d', strtotime("+24 months $exp"));
$three= date('Y-m-d', strtotime("+36 months $exp"));
$warrdue= date('Y-m-d', strtotime("-6 months $exp"));
$status=$det[11] ;

if($status==1) {
if($date > $warrdue) { $age = "<6 Months Left";} else {$age ="UW";}
    
} else {
    
    if($date < $sixmonth) { $age = "Expired Within 6 Months";}
elseif($date <$oneyear) { $age = "Expired 6-12 Months";}
elseif($date < $two) { $age = "Expired 1-2 Years";}
elseif($date < $three) { $age = "Expired 2-3 Years";}
 
else{ $age = "Abv 3 Years"; }
}*/
$date=date('Y-m-d');
$countqry=mysqli_query($con1,"select count(atm_id) AS `count` from alert where atm_id ='$row[0]' and date(close_date) between '".$row[12]."' and '$date' ");
//echo "select count(atm_id) AS `count` from alert where atm_id ='$row[0]' and date(close_date) between '".$row[12]."' and '$date' ";

//$countqry=mysqli_query($con1,"select count(atm_id) AS `count` from alert where atm_id ='$row[0]'");

$cntrow=mysqli_fetch_assoc($countqry);
$cntc=$cntrow['count'];

$alertqry=mysqli_query($con1,"select date(close_date) from alert where atm_id ='$row[0]' and call_status !='Rejected' order by alert_id DESC ");
$alert=mysqli_fetch_row($alertqry); 

if($alert[0] !=''){ 
    $to_time = strtotime($date);
	$from_time = strtotime($alert[0]);
	$diff=round(abs($to_time - $from_time) / (3600*24),2);
      }
else { $diff='' ;}

?>
<td width="75" style='text-align:center;'><?php echo $cntc ?></td>
<td width="75"><?php echo $alert[0] ?></td>
<td width="75"><?php echo $diff." Days" ?></td>


<?php

if($diff > 90 && $cntc < $pmreqd[0]) { ?>
<td width="45" height="31"> <a href="#" onClick="window.open('generate_pm.php?id=<?php echo $row[0]; ?>&type=amc','pm_call','width=700px,height=750,left=200,top=40')"><font color="blue"> Generate PM call</font></a>

</td>
<?php }  ?>
</tr>

<?php
} }
 
?>
</table>
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
?></font></div></td></tr>

<form name="frm" method="post" action="export_pmsites.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>

