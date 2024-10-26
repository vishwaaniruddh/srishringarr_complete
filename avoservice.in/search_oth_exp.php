<?php
include("access.php");
session_start();
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];

//echo $_SESSION['designation'];
$strPage = $_REQUEST['Page'];

$appstatus=$_POST['status'];

?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">
<tr>
<th width="5%" style="text-align:center">S.No</th>
<th width="15%">Engineer Name</th>
<th width="10%">Branch</th>
<th width="10">Designation</th>
<th width="10%">Claim Date</th>
<th width="5%">Logistics Claim Detail</th>
<th width="5%">Logistics Amount</th>
<th width="5%">Handling / Hamali Detail</th>
<th width="5%">Hamali Charges</th>
<th width="5%">Spares Purchase Detail</th>
<th width="5%">Spares Amount</th>
<th width="5%">Courier Detail</th>
<th width="5%">Courier Amount</th>
<th width="5%">Stationary Detail</th>
<th width="5%">Stationary Amount</th>

<th width="5%">Other Expense Detail</th>
<th width="5%">Other Exp Amount</th>
<th width="5%">Total Claimed Amount</th>

<th width="5%">Approve</th>

</tr>


<?php
//echo $SESSION['designation'];

$count=0;
include("config.php");
$br=$_SESSION['branch'];
$fix=25;
$Branch=$_POST['Branch'];
$Employee_name=$_POST['Employee_name'];
$from =$_POST['from'];
$to = $_POST['to'];
$status=$_POST['status'];

$strPage=$_POST['Page'];



$abc="select * from engg_oth_expenses where 1 " ;


if($Branch!=""){
$abc.=" and branch_id='".$Branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_id='".$Employee_name."'";
//echo $abc;
}

if(isset($_POST['status']) && $_POST['status']!='')
{ $abc.=" and status='".$status."'" ; }


if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{

$abc.=" and claim_date Between '".$from."' AND '".$to."'  ";

//$dt1=str_replace("/","-",$_POST['from']);
//$dt2=str_replace("/","-",$_POST['to']);


}

$sql_exp =$abc ;

// echo $abc;
 
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

$abc.=" ORDER BY claim_date DESC LIMIT $Page_Start , $Per_Page ";
	
//echo $abc;

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


$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);



?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $count; ?></td>
<td class="sticky"><?php echo $row3[1]; ?></td>
<td><?php echo $row2[0]; ?></td>
<td><?php echo $row3[11]; ?></td>
<td><?php echo $row[2]; ?></td> <!-- claim Date-->
<td><?php echo $row[4]; ?></td> 
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[5]; ?></td>
<td><?php echo $row[6]; ?></td> 
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[7]; ?></td>  <!-- Handling -->

<td><?php echo $row[8]; ?></td>  <!-- Spare detail-->
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[9]; ?></td>  <!-- Spares Amount--> 

<td><?php echo $row[10]; ?></td>   <!-- Mobile-->
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[11]; ?></td> 
<td><?php echo $row[12]; ?></td>  
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[13]; ?></td>  <! Stationary-->
<td><?php echo $row[14]; ?></td>  
<td style="color:red; font-size:15px; font-weight:bold;"><?php echo $row[15]; ?></td>  <! Other Exp-->

<td style="color:blue; font-size:15px; font-weight:bold;"><?php echo $row[16]; ?></td>  <! Total-->


<? if ($row[17]=='1')  { ?>
<td> <? if ($_SESSION['designation']==3 ||$_SESSION['designation']==7) {?> <a href ="approve_oth_exp.php?id=<?php echo $row[0] ?>" target="_new"> Approve </a> <?}  else if ($_SESSION['designation']==4) { ?> <a href='edit_oth_exp.php?id=<?php echo $row[0]; ?>'> Edit </a> <? } else {echo "Pending";} }?> </td>

<? if ($row[17]=='2')  { ?>
<td> <?php echo "Approved";  }?></td>


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
<form name="frm" method="post" action="export_oth_expence.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sql_exp; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center>
</form>
</body>
