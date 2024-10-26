<?php
include('config.php');
############# must create your db base connection


$strPage = $_REQUEST['Page'];
$br=$_POST['br'];
	
//====================================Search start here	
if($_POST['br']=='all')
 $sql="Select * from Amc where active='Y'";
else
 $sql="Select * from Amc where active='Y' and branch in (".$br.")";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and CID IN(select cust_id from customer where cust_id ='".$cid."')";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bankname LIKE '%".$bank."%'";
}
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and BRANCH='".$branch."'";
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
/*if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and state1 LIKE '%".$state."%'";
}*/
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

//echo $sql;
//$table=mysqli_query($con1,"select * from atm");

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
$sql.=" order by amcid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

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
<th width="75">PO No.</th>
<th width="75">AMC Start date</th>
<th width="75">AMC End Date</th>
<th width="100">Assets Details</th>

<th width="45">Detail</th>
<?php
while($row= mysqli_fetch_row($table))
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
<td width="75"><?php echo $row[2]?></td>
<td width="75"><?php echo $row[12]?></td>
<td width="75"><?php echo $row[25]?></td>
<td> Not reqd</td>



<td width="45" height="31"> <a href="detail1_site.php?id=<?php echo $row[0]?>" target="_blank"> Detail </a>
<a href="#" class="update" onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&stateid=<?php echo $row[8]; ?>&type=amc','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>&nbsp;&nbsp;
<!--<a href="javascript:confirm_delete('<?php echo $row[0]; ?>','amc');"> DeActivate </a> -->

<a href="#" onClick="window.open('generate_pm.php?id=<?php echo $row[0]; ?>&type=amc','pm_call','width=700px,height=750,left=200,top=40')"><font color="red"> Generate PM call</font></a>&nbsp;&nbsp;

</td>
<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
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
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div></td></tr></table><form name="frm" method="post" action="exportallsites.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
<?php } ?>