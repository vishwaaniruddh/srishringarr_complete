<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d');
//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query ="select * from medicine where 1 ";

if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
	//echo "hi";
$name=$_REQUEST['name'];

$query.="and name like('%".$name."%') ";
}

/*if(isset($_REQUEST['searchdate']) && $_REQUEST['searchdate']!="")
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
}*/

//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page =15;   // Records Per Page
 
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

$query.="  order by name,quantity ASC LIMIT $Page_Start , $Per_Page";
//echo "<br>".$query;

$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="overflow:auto;">
<table  class="results" style="width:700px">
 
       <thead align="left">
          <tr>
          <th>Medicines Name</th>
          <th>Potency</th>
          <!--<th>Quantity</th>-->
          <th>InStock</th>
          <th>InUse</th>
          <th>Bring in Use</th>
         </tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row=mysql_fetch_array($result))
{
//echo "select * from patient where medid='".$row[5]."'";
$qr=mysql_query("select * from curstock where medid='".$row[5]."'");
$qrro=mysql_fetch_row($qr);


//echo $opdro[2];
?>
<tr><td><?php echo $row[0];  ?></td><td><?php echo $row[6];  ?></td><!--<td><?php echo $row[11];  ?></td>--><td><?php echo $qrro[2];  ?></td>
<td><?php echo $qrro[3];  ?> <div align="right"><?php if($qrro[3]>0){  ?> <a href="usemedicine.php?mid=<?php echo $row[5]; ?>&tp=finish">Finish</a><?php } ?></div></td>
<td><?php if($qrro[2]>0){  ?><a href="usemedicine.php?mid=<?php echo $row[5]; ?>&tp=open">Open New</a><?php } ?></td>
</tr>




<?php
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