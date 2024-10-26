<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>
<body>
<form name="form1" method="post">

<table class="center" width="60%" border="2" cellpadding="2" cellspacing="0" style="margin-top:15px;margin-left:2%;" class="res" id="custtable">
<tr>
<th width="2%" style="text-align:center">S.No</th>
<th width="15%">Engineer Name</th>
<th width="5%">Branch</th>
<th width="8%">Designation</th>
<th width="5%">Enr  call claim</th>
<th width="5%">Portal Visit Count</th>
<th width="5%">Claimed Amount</th>

<th width="5%">Avg.Engr Claim per Visit(Portal)</th>


<th width="5%">Deduction by Approver</th>
<th width="5%">Deduction by Admin</th>

<th width="5%">Total Accepted Claim</th>

<th width="5%">Claim Date</th>
<th width="8%">Claim entry date</th>
<th width="8%">Approved Date</th>
<th width="8%">Verified Date</th>
</tr>


<?php

$count=0;
include("config.php");


$fix=25;
$Branch=$_POST['Branch'];
$Employee_name=$_POST['Employee_name'];
$from =$_POST['from'];
$to = $_POST['to'];

$strPage=$_POST['Page'];

//echo $from;
//echo $to;

$abc="select * from daily_expenses where status=2 " ;


?>
<?php

if($Branch!=""){
$abc.=" and branch_id='".$Branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_id ='".$Employee_name."'";
//echo $abc;
}


if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{

$abc.=" and claim_date Between '".$from."' AND '".$to."'  ";


}

$app=$abc;

$result=mysqli_query($con1,$abc);
 $Num_Rows=mysqli_num_rows($result);

$Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
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

$abc.=" ORDER BY date DESC LIMIT $Page_Start , $Per_Page ";
	

$qrys=mysqli_query($con1,$abc);
$count=mysqli_num_rows($qrys);

$count=1;
	if($Page=="1" or $Page=="")
	{
	$count="1";
	}else
	{
	  $count=($fix* $Page)-$fix;
	  $count=$count+1;
	}


?>



<div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
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
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 
 
 <?php
//echo $abc;

$qry=mysqli_query($con1,$abc);

while($row=mysqli_fetch_row($qry))

{
//$count=$count+1;

//echo "select * from daily_expenses where id='".$row[1]."'";

$qry1=mysqli_query($con1,"select * from approved_expenses where claim_id='".$row[0]."'");
//echo "select * from approved_expenses where claim_id='".$row[0]."'";

$row1=mysqli_fetch_row($qry1);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select engg_name, engg_desgn from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $count; ?></td>
<td class="sticky"><?php echo $row3[0]; ?></td> <!-- Engr Name -->
<td><?php echo $row2[0]; ?></td> <!Branch -->
<td><?php echo $row3[1]; ?></td> <!design -->
<td><?php echo $row[4]; ?></td>  <!Engr Calls -->

<td><?php echo $row1[5]; ?></td>  <!portal Calls-->
<td><?php echo $row[19]; ?></td> <!Claim amount -->

<td><?php echo ($row[19] / $row1[5]); ?></td>

<td><?php echo ($row[19] - $row1[6]); ?></td> <! Deduction by App-->

<td>
<? if ($row1[8]==1) { echo " Verify Pending";}
else if ($row1[8]==2) { echo ($row1[6] - $row1[12]) ;} ?></td> <!--Ded by Veri-->

<td>
<? if ($row1[8]==1) { echo "Pending";}
else if ($row1[8]==2) { echo $row1[12];} ?></td> <!Final Verfiy amt -->


<td><?php echo date($row[3]); ?></td><!date -->
<td><?php echo date($row[22]); ?></td><!entry date -->
<td><?php echo date($row1[11]); ?></td> <!Verify Amt -->
<td><?php echo date($row1[15]); ?></td> <!Verify Amt -->



	


</tr>

 <?php
$count++;
  ?>
<?php 
}
?>

</table>

<?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back</center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

?>

</form>

<form name="frm" method="post" action="export_verify_expense.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $app; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center>
</form>

</body>





