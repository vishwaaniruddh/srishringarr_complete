<?php
include("access.php");
include('config.php');
session_start();
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 $strPage = $_REQUEST['Page'];

$seltype=$_POST['seltype'];

if ($seltype=="client") {
?>

<center>

<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;border:1px #fff solid" id="custtable">

<th width="10px">Sr.no</th>
<th width="80px">Customer Name</th>
<th width="30px">Amc</th>
<th width="30px">Warranty</th>

<?php 
$query="select cust_id,cust_name from customer";
$qr1=mysqli_query($con1,$query);

$Num_Rows =mysqli_num_rows($qr1);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
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


$query.=" order by cust_id ASC LIMIT $Page_Start , $Per_Page";

$qryss=mysqli_query($con1,$query);

$srno=1;


while($varqry=mysqli_fetch_array($qryss))
{
if($branch=="")
{
//echo "select count(AMCID) from Amc where CID='".$varqry[0]."' and active='Y'";
$queryatm=mysqli_query($con1,"select count(AMCID) from Amc where CID='".$varqry[0]."' and active='Y'");
$qryfetch=mysqli_fetch_array($queryatm);
       
$queryatm1=mysqli_query($con1,"select count(track_id) from atm where cust_id='".$varqry[0]."' and active='Y'");
$custfetch=mysqli_fetch_array($queryatm1);

}
else
{
//echo "select count(AMCID) from Amc where CID='".$varqry[0]."' and branch='".$branch."' and active='Y'";
$queryatm=mysqli_query($con1,"select count(AMCID) from Amc where CID='".$varqry[0]."' and branch='".$branch."' and active='Y'");
$qryfetch=mysqli_fetch_array($queryatm);

$queryatm1=mysqli_query($con1,"select count(track_id) from atm where cust_id='".$varqry[0]."' and branch_id=$branch and active='Y'");
$custfetch=mysqli_fetch_array($queryatm1);

}
?>
<tr>
<td><?php echo $srno;?></td>
<td><?php echo $varqry[1];?></td>
<!--<td><?php echo $qryfetch[0];?></td>
<td><?php echo $custfetch[0];?></td>-->
<td><?php $cntamc+=$qryfetch[0]; echo $qryfetch[0]; ?></td>
<td><?php $cntatm+=$custfetch[0];echo $custfetch[0]; ?></td>

<!--<td><a href="javascript:void(0);" onclick="window.open('view_site_details_summary.php?id=<?php echo $varqry[0]?>&type=amc&br=<?php if($branch==""){echo 0;}else{ echo $branch;} ?>','View_servicepcalls','width=700px,height=750,left=200,top=40')" class="update">
 <?php// $cntamc+=$qryfetch[0];  echo $qryfetch[0]; ?></a></td>
<td><a href="javascript:void(0);" onclick="window.open('view_site_details_summary.php?id=<?php echo $varqry[0]?>&type=atm&br=<?php if($branch==""){echo 0;}else{ echo $branch;}?>','View_servicepcalls','width=700px,height=750,left=200,top=40')" class="update">
  <?php //$cntatm+=$custfetch[0]; echo $custfetch[0];?></a></td> -->
</tr>

<?php
$srno++;
 } ?>
 
 <tr><td></td> <td>Grand Total </td><td> <?php echo $cntamc; ?> </td> <td> <?php echo $cntatm; ?> </td></tr>

</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

//echo $Prev_Page;
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

?>

</div>
</center>

<? } else {
?>

<center>

<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;border:1px #fff solid" id="custtable" >

<th width="10px">Sr.no</th>
<th width="80px">Branch Name</th>
<th width="30px">Amc</th>
<th width="30px">Warranty</th>

<?php 
$query="select id,name from avo_branch";
$qr1=mysqli_query($con1,$query);

$Num_Rows =mysqli_num_rows($qr1);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
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


$query.=" order by name ASC LIMIT $Page_Start , $Per_Page";

$qryss=mysqli_query($con1,$query);

$srno=1;

$cntatm=0;
$cntamc=0;
while($varqry=mysqli_fetch_array($qryss))
{
if($branch=="")
{
//echo "select count(AMCID) from Amc where CID='".$varqry[0]."' and active='Y'";
$queryatm=mysqli_query($con1,"select count(AMCID) from Amc where BRANCH='".$varqry[0]."' and active='Y'");
$qryfetch=mysqli_fetch_array($queryatm);
       
$queryatm1=mysqli_query($con1,"select count(track_id) from atm where branch_id='".$varqry[0]."' and active='Y'");
$custfetch=mysqli_fetch_array($queryatm1);

}
else
{
//echo "select count(AMCID) from Amc where CID='".$varqry[0]."' and branch='".$branch."' and active='Y'";
$queryatm=mysqli_query($con1,"select count(AMCID) from Amc where BRANCH='".$varqry[0]."' and branch='".$branch."' and active='Y'");
$qryfetch=mysqli_fetch_array($queryatm);

$queryatm1=mysqli_query($con1,"select count(track_id) from atm where branch_id='".$varqry[0]."' and branch_id=$branch and active='Y'");
$custfetch=mysqli_fetch_array($queryatm1);

}
?>
<tr>
<td><?php echo $srno;?></td>
<td><?php echo $varqry[1];?></td>
<td><?php $cntamc+=$qryfetch[0]; echo $qryfetch[0]; ?></td>
<td><?php $cntatm+=$custfetch[0];echo $custfetch[0]; ?></td>

<!--<td><a href="javascript:void(0);" onclick="window.open('view_site_details_summary.php?id=<?php echo $varqry[0]?>&type=amc&br=<?php if($branch==""){echo 0;}else{ echo $branch;} ?>','View_servicepcalls','width=700px,height=750,left=200,top=40')" class="update">
 <?php echo $qryfetch[0]; ?></a></td>
<td><a href="javascript:void(0);" onclick="window.open('view_site_details_summary.php?id=<?php echo $varqry[0]?>&type=atm&br=<?php if($branch==""){echo 0;}else{ echo $branch;}?>','View_servicepcalls','width=700px,height=750,left=200,top=40')" class="update">
  <?php echo $custfetch[0];?></a></td> -->
  
 </tr>

<?php
$srno++;
 } ?>
 
<tr> <td></td><td>Grand Total </td> <td> <?php echo $cntamc; ?> </td> <td> <?php echo $cntatm; ?> </td></tr>

</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

//echo $Prev_Page;
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

?>

</div>
</center>

<?

}