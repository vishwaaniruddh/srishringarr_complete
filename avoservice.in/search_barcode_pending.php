<?php
include('config.php');
session_start();

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

//echo "Hiiiii";


//require("myfunction/function.php");
############# must create your db base connection

   
$strPage = $_REQUEST['Page'];

$sql = "Select a.po_id, a.inv_no, a.avo_branch, a.customer_vertical, b.po_model, b.po_qty, b.po_product,a.inv_date from so_order a, new_sales_order_asset b, new_sales_order c where a.po_id=b.so_trackid and a.po_id=c.so_trackid and a.status=1 and a.call_status=0 and b.po_product='UPS' and c.del_type !='stock_trfr'";


//$sql = "Select a.po_id, a.inv_no, a.avo_branch, a.customer_vertical, b.po_model, b.po_qty, b.po_product from so_order a, new_sales_order_asset b, new_sales_order c where a.po_id=b.so_trackid and a.po_id=c.so_trackid and b.po_product='UPS' and c.del_type !='stock_trfr' and a.po_id=197422";


if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];

$sql.=" and a.atm_id LIKE '%".$id."%' ";

}

//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.customer_vertical ='".$cid."'";

}

//==========search by Invoice no===================================
if(isset($_POST['invno']) && $_POST['invno']!='')
{
$invno=$_REQUEST['invno'];

$sql.=" and a.inv_no like '%".$invno."%'";

}


//==========search by Branch===========================================
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];

$sql.=" and a.avo_branch ='".$state."'";
}
//echo $sql;

//==========search by Date======================================================
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
$fromdt=$_REQUEST['sdate'];
$todt=$_REQUEST['edate'];

$sql.=" and a.inv_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')"; //   + INTERVAL 1 DAY";


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
$sql.=" order by a.po_id DESC LIMIT $Page_Start , $Per_Page";

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
                <th width="3%">Product</th>
                <th width="5%">Model Name</th>
                <th width="2%">Order Qty</th>
                <th width="2%">Barcode Pending</th>
                <th width="2%">Action</th>
               
               </tr>

<?php
$i=1;

if(mysqli_num_rows($table)>0) {
while($so_det= mysqli_fetch_array($table))
{ 

$so_id=$so_det[0];
$assetcount=$so_det[5];
$model_id=$so_det[4];
$product=$so_det[6];                
                $atmqry = mysqli_query($con1, "select * from demo_atm where so_id='".$so_id."' ");
                $atm = mysqli_fetch_row($atmqry);
 
                $cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$so_det[3]."' ");
                     $clro = mysqli_fetch_row($cl);
                    $cust_name = $clro[1];
                
                $brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$so_det[2]."' ");
                    $brro = mysqli_fetch_row($brqry);
                    $br_name = $brro[1];

                $specqry= mysqli_query($con1, "Select name from assets_specification where ass_spc_id='".$model_id."'" );
                    $spcrow=mysqli_fetch_row($specqry);
       
$model_name=$spcrow[0];

$qry= mysqli_query($con1, "Select count(id) as `count` from so_order_barcode where `so_id`='".$so_id."' and model_id='".$model_id."'" );
        $row=mysqli_fetch_assoc($qry);
        $count=$row['count'];
    
$pendingcount=$assetcount - $count;

?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->

<td width="77"> <?php echo $cust_name;  ?></td>
     
<!-- Branch -->
<td width="5%"> <?php echo $br_name; ?></td>
<td width="95"><?php echo $atm[1]; ?></td>

<td width="95"><?php echo $atm[6]; ?></td>
<!--City -->
<td width="50"><?php echo $atm[9]; ?></td>
<!---Address  -->
<td width="70"><?php echo $atm[11]; ?></td>

<td width="5%"><? echo $so_det[1];?></td> 
<td width="5%"><? echo $so_det[7];?></td> 

<td><? echo $so_det[6];?></td> 
<td><? echo $model_name;?></td> 
<td><? echo $so_det[5];?></td> 
<td><? echo $pendingcount;?></td>

<?php if($_SESSION['user']=='acc-admin' || $_SESSION['designation']==1 ||  $_SESSION['user']=='bihar1886') { ?>
<td> <a style="color:red;" style="margin:5px;"class="btn btn-success" href="add_barcode_slno.php?id=<?php echo $so_id; ?>&model=<?php echo $model_id ?>&cnt=<?php echo $pendingcount ?>">Add</a>
   
    </td> 
<?php } ?>

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


<form name="frm" method="post" action="export_barcode_pend.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>Max Records-2000</span>
</form>
