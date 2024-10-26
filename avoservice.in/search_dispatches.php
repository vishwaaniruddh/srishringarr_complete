<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection

   
$strPage = $_REQUEST['Page'];

$sql="SELECT * FROM so_order WHERE status=2";


if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];

$sql.=" and atm_id LIKE '%".$id."%' ";

}

//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and customer_vertical ='".$cid."'";

}

//==========search by Invoice no===================================
if(isset($_POST['invno']) && $_POST['invno']!='')
{
$invno=$_REQUEST['invno'];

$sql.=" and inv_no like '%".$invno."%'";

}


//==========search by Branch===========================================
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];

$sql.=" and avo_branch ='".$state."'";
}
//echo $sql;

//==========search by Date======================================================
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
$fromdt=$_REQUEST['sdate'];
$todt=$_REQUEST['edate'];

$sql.=" and inv_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')"; //   + INTERVAL 1 DAY";


}

//echo $sql;



$sqlr=$sql;

$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
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
$sql.=" order by po_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 
<tr>
               
                
                <th width="2%">S.No</th>
                <th width="5%">Customer Vertical</th>
                
                <th width="5%">Branch</th>
                 <th width="7%">Site/Sol/ATM Id</th>
                 
                 <th width="5%">End User Name</th>
                 <th width="5%">City</th>
                 <th width="10%">Address</th>
                   
                <th width="5%">Invoice No.</th>
                <th width="5%">Invoice Date</th>
                
                <th width="5%">Dispatch date</th>
                <th width="5%">Delivery date</th>
                <th width="7%">Type of Transport</th>
                <th width="7%">Courier </th>
                <th width="7%">Courier Doc No</th>
                
               </tr>

<?php
$i=1;

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_assoc($table))
{ 


$so_id=$row['po_id'];
$cid= $row['customer_vertical'];
$br=  $row['avo_branch'];

$atmqry= mysqli_query($con1,"SELECT bank_name,city, address FROM demo_atm WHERE so_id='".$so_id."'");
$atm=mysqli_fetch_row($atmqry);

?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->

<td width="77">
 <?   $custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cid."'");
$custname1=mysqli_fetch_row($custname);
echo $custname1[0];  ?></td>
     
<!-- Branch -->
<td width="5%">
<?php 
$branch=mysqli_query($con1,"select name from avo_branch where id='".$br."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[0]; ?></td>
<td width="95"><?php echo $row['atm_id']; ?></td>




<!---bank -->

<td width="95"><?php echo $atm[0]; ?></td>
<!--City -->

<td width="50"><?php echo $atm[1]; ?></td>
<!---Address  -->
<td width="70"><?php echo $atm[2]; ?></td>

<td width="5%"><? echo $row['inv_no'];?></td> 
<td width="5%"><? echo $row['inv_date'];?></td> 

<td width="5%"><? echo $row['dis_date'];?></td> 
<td width="5%"><? echo $row['del_date'];?></td> 
<td width="5%"><? echo $row['del_mode'];?></td> 
<td width="5%"><? echo $row['courier'];?></td> 
<td width="5%"><? echo $row['docketno'];?></td> 


 
</tr></div><?php

}  }

?> 
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
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
?>


<form name="frm" method="post" action="export_dispatches.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>Max Records-2000</span>
</form>
