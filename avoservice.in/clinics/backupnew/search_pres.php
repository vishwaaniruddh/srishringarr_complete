<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d');
//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query ="select * from appoint where cancstat=0 and presstat='3' and app_real_id in(select app_id from opd where medicines<>'') ";

if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
	//echo "hi";
$name=$_REQUEST['name'];

$query.=" and no=select srno from patient where name like('".$name."%') ";
}

if(isset($_REQUEST['searchdate']) && $_REQUEST['searchdate']!="")
{
	
$searchdate=$_REQUEST['searchdate'];
//echo "hi";
$query.="and app_date like STR_TO_DATE('".$searchdate."%','%d/%m/%Y') ";
}
else
$query.="and app_date='".$dt."'";

if(isset($_REQUEST['cont']) && $_REQUEST['cont']!='')
{
$cont=$_REQUEST['cont'];
$query.="and no=select srno from patient where mobile like('".$cont."%')";
}

if(isset($_REQUEST['appid']) && $_REQUEST['appid']!='')
{
$app=$_REQUEST['appid'];
$query.="and app_real_id like('".$app."%')";
}

if(isset($_REQUEST['patid']) && $_REQUEST['patid']!="")
{
$pat=$_REQUEST['patid'];
$query.="and no Like '".$pat."%'";
}
//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page =12;   // Records Per Page
 
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

$query.="  order by app_id ASC LIMIT $Page_Start , $Per_Page";
//echo "<br>".$query;

$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="overflow:auto;width:910px;">
<table border="0" style="border:hidden">
<?php
$intRows = 0;
$cnt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row=mysql_fetch_array($result))
{
//echo "select name from patient where srno='".$row[11]."'";
$pat=mysql_query("select name,srno from patient where srno='".$row[11]."'");
$patro=mysql_fetch_row($pat);
$opd=mysql_query("select medicines,potency,opd_real_id from opd where app_id='".$row[22]."'");
$opdro=mysql_fetch_row($opd);
$med=explode(",",$opdro[0]);
$pot=explode(",",$opdro[1]);
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
//echo $opdro[2];
?>
<tr><td><a href="#" onclick="getpres('<?php echo $opdro[2]; ?>')" /><?php echo $patro[0]; ?> (<?php echo $patro[1]; ?>)</a></td>
</tr>
<!--<tr><td colspan="4"><table border="0" width="50%"><tr><td width="13%"><b>Sr. no.</b></td>
<td width="70%" align="center"><b>Medicine</b></td><td width="13%" align="center"><b>Potency</b></td>
</tr><?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $med[$i]; ?></td><td><?php echo $pot[$i]; ?></td></tr>
<?php
}
}
 ?></table></td></tr>-->



<?php
}
}

		
		
	?>
</table></div>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
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
if($Page!=$Num_Pages)
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>
<?php
############

}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
?>