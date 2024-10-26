
<?php
include('config.php');


$strPage = $_REQUEST['Page'];

$sql="SELECT * FROM amc_po_new where no_sites !='1'";


if(isset($_POST['status']) && $_POST['status']!='')
{
$sql.=" and status='".$_POST['status']."' ";

//echo $sql;
}

//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$sql.=" and cust_id ='".$_POST['cid']."'";
}

if(isset($_POST['po_no']) && $_POST['po_no']!='')
{
$po_no=$_POST['po_no']; 
//echo $po_no;
$sql.=" and po_no like '%".$po_no."%'";

}
if(isset($_POST['buyer']) && $_POST['buyer']!='')
{
$buyer=$_POST['buyer']; 
$sql.=" and buyer like'%".$buyer."%'";

}

//==========search by Date======================================================
if(isset($_POST['fromdate']) && $_POST['fromdate']!='' && isset($_POST['todate']) && $_POST['todate']!='')
{
$fromdt=$_REQUEST['fromdate'];
$todt=$_REQUEST['todate'];

$sql.=" and po_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";


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
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 
<tr>
               
                
                <th width="2%">S.No</th>
                <th width="5%">Customer Vertical</th>
                <th width="5%">PO No.</th>
                <th width="5%">PO Date</th>
                <th width="7%">PO raised Datetime</th>
                <th width="5%">Buyer Name</th>
                <th width="10%">Address</th>
                <th width="5%">Sales person</th>
                <th width="3%">No. of Sites</th>
                <th width="4%">AMC Value</th>
                <th width="5%">Start Date</th>
                <th width="5%">Expiry Date</th>
                <th width="3%">PO File</th>
                <th width="3%">PO File</th>
                <th width="5%">See Products</th>
                <th width="5%">PM Required in</th>
                <th width="4%">Billing Period</th>
                <th width="5%">Created By</th> 
                <th width="5%">Date of Upload</th> 
                <th width="5%">Upload status</th>
                <th width="5%">Upload</th> 
               
            </tr>





<?php
$i=1;

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_assoc($table))
{ 

$id=$row['po_id'];
$po_no=$row['po_no'];
$po_date= $row['po_date'];
$cust_id=  $row['cust_id'];
$saleperson= $row['saleperson'];
$buyer=$row['buyer'];
$buyer_add=$row['buyer_add'];
$no_sites=$row['no_sites'];
$start_date=$row['start_date'];
$exp_date=$row['exp_date'];
$pm_time=$row['pm_time'];
$billperiod=$row['billperiod'];
$amc_value=$row['amc_value'];
$created_by=$row['created_by'];
$created_at=$row['created_at'];
$po_file=$row['po_file'];
$data_file=$row['data_file'];

$upload_date= $row['upload_date'];
$status= $row['status'];

$custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cust_id."'");
$custname1=mysqli_fetch_row($custname);
?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->
<td width="77"> <?  echo $custname1[0];  ?></td>
<td width="5%"><? echo $po_no;?></td> 
<td width="5%"><? echo $po_date;?></td> 
<td width="5%"> <? echo $created_at; ?></td>
<td width="95"><?php echo $buyer; ?></td>
<td width="50"><?php echo $buyer_add; ?></td>
<td width="70"><?php echo $saleperson; ?></td>
<td width="70"><?php echo $no_sites; ?></td>
<td width="200"><?php echo $amc_value; ?></td>
<td width="200"><?php echo $start_date; ?></td>
<td width="200"><?php echo $exp_date; ?></td>
<!--<td width="70"><?php echo $po_file; ?></td> -->
<td>
<a href="<?php echo $po_file; ?>" target="_blank" ><image src="<?php echo $po_file; ?>" alt="PO" width="50" height="50" /></a>
</td>
<td>
<a href="<?php echo $data_file; ?>" target="_blank" ><image src="<?php echo $data_file; ?>" alt="Data" width="50" height="50" /></a>
</td>
<td>
<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('view_amc_assets.php?id=<? echo $id;?>','view updates','width=500px,height=400,left=400,top=100')" class="update">Products</a>
</td>
<td width="50"><?php echo $pm_time;?></td>
<td width="75"><?php echo $billperiod;?></td>
<td width="75"><?php echo $created_by;?></td> 

<td>
 <?php echo $upload_date; ?>                   
</td> 

<td> 
<?php if($status=='2'){  echo "Yes"; }
 else echo "No"; ?>   
</td>

<td>
 <?php if($status=='1'){  ?> 
<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('amcdata_upload.php?id=<? echo $id;?>','upload','width=700px,height=500,left=300,top=100')" class="update">Upload</a>

<?} else echo "Uploaded" ; ?>

</td>


</tr></div><?php

} 

?> 
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

} 


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

<!--<form name="frm" method="post" action="export_newbuyback.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>-->
