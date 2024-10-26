<?php
include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
$pin="";
$sdate="";
$edate="";

$strPage = $_REQUEST['Page'];
	
	$sql="Select * from tempsites where 1";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and custid IN(select cust_id from customer where cust_name LIKE '%".$cid."%')";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bankname LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and city LIKE '%".$city."%'";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and state LIKE '%".$state."%'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and pincode LIKE '%".$pin."%'";
}
if(isset($_POST['sdate']) && $_POST['sdate']!='')
{
$sdate=$_REQUEST['sdate'];
$sdate2=str_replace("/","-",$sdate);
$sql.=" and podate LIKE '%".date('Y-m-d',strtotime($sdate2))."%'";
}
if(isset($_POST['edate']) && $_POST['edate']!='')
{
$edate=$_REQUEST['edate'];
$edate2=str_replace("/","-",$edate);
$sql.=" and podate LIKE '%".date('Y-m-d',strtotime($edate2))."%'";
}

//$sql.=" and status=0";
//$table=mysqli_query($con1,"select * from atm");

$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins

$Per_Page =10;   // Records Per Page
 
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
$sql.=" order by id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
//$table=mysqli_query($con1,"select * from atm");

//$str="";
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter1($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");

?>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
$count=0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"> 


<th width="77">Customer</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="95">State</th>
<th width="70">Pincode</th>
<th width="95">Address</th>
<th width="75">ATM</th>

<th width="45">Action</th>
<?php
while($row= mysqli_fetch_row($table))
{
$count=$count+1;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);

?><tr>

<td width="77"><?php echo $crow[1] ?></td>
<td width="125"><?php echo $row[4]?></td>
<td width="75"><?php echo $row[5]?></td>
<td width="75"><?php echo $row[7]?></td>
<td width="95"><?php echo $row[8]?></td>
<td width="70"><?php echo $row[6]?></td>
<td width="75"><?php echo $row[9]?></td>
<td width="75"><?php echo $row[3]?></td>
<td width="45" height="31" id="am<?php echo $count; ?>">
<?php
if($row[12]==1)
echo "Converted to AMC";
else{
?>
<!--<select name="service<?php echo $count; ?>" id="service<?php echo $count; ?>">
<option value="">-Select-</option>
<option value="3">Every 3 month</option>
<option value="6">Every 6 month</option>
</select><br>

<input type="text" name="adate<?php echo $count; ?>" id="adate<?php echo $count; ?>" onclick="displayDatePicker('adate<?php echo $count; ?>');" value="<?php echo date('d/m/Y'); ?>" readonly />-->
 <!--<input type="checkbox" id="convertamc<?php echo $count; ?>" name="convertamc[]" value="<?php echo $row[0]?>" onClick="convert(this.id,'am<?php echo $count; ?>','service<?php echo $count; ?>','adate<?php echo $count; ?>');">&nbsp;&nbsp;Convert To Amc-->
 
<a href="javascript:void(0);"  onclick="newwin('add_amcasset.php?alert_id=<?php echo $row[0]; ?>&am=<?php echo $count; ?>&service=<?php echo $count; ?>&adate=<?php echo $count; ?>','display',600,600)" class="update">
  Convert To Amc</a>
 <?php
 }
 ?>
</td>
<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
</tr>

<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
?>
<tr><td colspan="9" align="center">
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<?php
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
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
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div></td></tr></table>
<?php } ?>