<?php
include 'config.php';
############# must create your db base connection

$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select * from admission ";

if(isset($_REQUEST['month']) && isset($_REQUEST['year']))
{
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
//echo "bill_date between '".$year."-".$month."-01' and '".$year."-".$month."-31'";
if($year!='0000')
$query.="where dis_date between '".$year."-".$month."-01' and '".$year."-".$month."-31'";
}



$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
if(isset($Num_Rows)){

	$Num_Rows = mysqli_num_rows($result);

}
 
########### pagins

$Per_Page = 50;   // Records Per Page
 
$Page = $strPage;
if(isset($strPage))
{
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Num_Pages=0;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if(isset($Num_Rows)) {
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

$query.="order by ad_id desc LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
}
}
?> 
<style>
td{ padding:2px;}
</style>
<div id="dvData" >
<table class="results" border="1" style="font-size:13px; border:1px #ac0404 solid;">
<tr>
<th>S.NO.</th>
<th>IP NO.</th>
<th>IP Name</th>
<th>Relation</th>
<th>Ref No</th>
<th>Patient Name</th>
<th>Case Reg No.</th>
<th>Ref_Date</th>
<th>Diagnosis</th>
<th>Treat Type</th>
<th>CGHS_Rate</th>
<th>Bill No</th>
<th>Bill Date</th>
<th>Bill Amount</th>
<th>Amount Payable</th>
</tr>   

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
$sn=1;
while($row= mysqli_fetch_row($result))
{
$sql1=mysqli_query($con,"select * from patient where no='$row[1]'");
$row1=mysqli_fetch_row($sql1);

$sql2=mysqli_query($con,"select * from discharge where ad_id='$row[0]'");
$row2=mysqli_fetch_row($sql2);

?>

<tr>
<td><?php echo $sn++; ?></td>
<td><?php echo $row1[39]; ?></td>
<td><?php echo $row1[40]; ?></td>
<td><?php echo $row1[44]; ?></td>
<td><?php echo $row[34]; ?></td>
<td><?php echo $row1[6]; ?></td>
<td></td>
<td><?php if(isset($row[35]) and $row[35]!='0000-00-00') echo date('d/m/Y',strtotime($row[35])); ?></td>
<td><?php if(isset($row2[1])) {echo $row2[1]; }?></td>
<td><?php echo $row[33]; ?></td>
<td></td>
<td><?php echo $row[0]; ?></td>
<td><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>



<td><?php

if(isset($total))
{
$total= $row2[3]+$row2[4]+$row2[5]+$row2[6]+$row2[10];
echo $total; }?></td>
<td></td>
</tr>
    
<?php $intRows++; } echo"</table></div>"; ?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<font size="3">Total Bills : <?php if(isset($Num_Rows)) {echo $Num_Rows;} ?>  </font>
<?php
}
if(isset($Prev_Page)) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
}


/*for($i=1; $i<=$Num_Pages; $i++){
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
//echo "hehehehehe";
?>
</font></div>
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

?>
<a href="#"  onclick="exportit()" >export</a>
<!--<form method="post" action="mail_ipd.php" >
<input type="hidden" name="msg" value="<?php echo $query; ?>" />
<input type="submit" value="Excel" class=" submit formbutton" onclick=""/>
</form>-->
