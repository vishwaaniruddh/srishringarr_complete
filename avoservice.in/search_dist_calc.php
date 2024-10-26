<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}




	$strPage = $_REQUEST['Page'];
 $branch=$_POST['branch'];
//==========================================	



$sql="Select * from atm where active='Y'";

if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atm_id LIKE '%".$id."%'";
}

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id in('".$branch."')";
}

if(isset($_POST['engg']) && $_POST['engg']!='')
{
$engg=$_REQUEST['engg'];

$sql.=" and track_id in(select site_id from engg_site_mapping_warr where engg_id ='".$engg."')";
}

echo $sql;

$table=mysql_query($sql);

$Num_Rows = mysql_num_rows ($table);
 
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

$table=mysql_query($sql);

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
<th width="70">Engineer Name</th>
<th width="70">Distance</th>

</tr>

<?php
// Insert a new row in the table for each person returned
if(mysql_num_rows($table)>0) 
{
while($row= mysql_fetch_row($table))
{
	
$qry1=mysql_query("select cust_name from customer where cust_id='$row[2]'");
$crow=mysql_fetch_row($qry1);
$qrybr=mysql_query("select name from avo_branch where id='$row[7]'");
$bran=mysql_fetch_row($qrybr);	

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

<?
$qryt1=mysql_query("select engg_id from engg_site_mapping_warr where site_id='".$row[0]."'");

$maprow=mysql_fetch_row($qryt1);

$qryt23=mysql_query("select * from area_engg where engg_id='$maprow[0]'");
$maprow=mysql_fetch_row($qryt23);
if(mysql_num_rows($qryt23)==0) {
 $dis="Site-Engr Not mapped" ;   
} else {

$sitelat = $row[26];
$sitelong=$row[27];
$englat = $maprow[18];
$englong =$maprow[19];

if ($sitelat =='0.00' ) {
$dis="Site Not Marked" ;
} elseif ($englat =='0.00') {
 $dis="mark Engr location" ;   
} 
else {

$dis1=distance($sitelat, $sitelong, $englat, $englong, "K"); 
$dis=$dis1." KMs";
}

}
?>
<td width="75"><?php echo $maprow[1] ?></td>

<td width="75"><?php echo $dis ?></td>

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
<form name="frm" method="post" action="export_dist_cal_warr.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>