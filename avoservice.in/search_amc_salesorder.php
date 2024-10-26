<?php
session_start(); 
//echo $_SESSION['user']."XX ".$_SESSION['branch']."XX ".$_SESSION['designation'];

include('config.php');

$strPage = $_REQUEST['Page'];

$sql="SELECT * FROM amc_po_new where 1";


//===================================
if($_SESSION['designation']==5 ){
            
    $cv = "select * from clienthandle where logid='".$_SESSION['logid']."'";
    $cv_query = mysqli_query($con1,$cv);
        
    while($cv_result = mysqli_fetch_assoc($cv_query)){
        $custv = $cv_result['client']; 
        $get_cust_sql = mysqli_query($con1,"select cust_id from customer where cust_name='".$custv."'");
        $get_cust_sql_result = mysqli_fetch_assoc($get_cust_sql);
          
        $cvs[] = $get_cust_sql_result['cust_id'];
        }
   if($cvs){
            $cust=json_encode($cvs);
            $cust=str_replace( array('[',']') , ''  , $cust);
            $cust = implode(',',array_unique(explode(',', $cust)));
        }

$sql.=" and cust_id in($cust) ";

//echo $sql;
} 
//=============================
if(isset($_POST['status']) && $_POST['status']!='')
{
$sql.=" and bill_status='".$_POST['status']."' ";
}

//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$sql.=" and cust_id='".$_POST['cid']."' ";
}

//==========search by Branch======================================
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$sql.=" and (bill_branch in('".$_POST['branch']."') or bill_branch='all' )";
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
                <th width="5%">Billing Branch</th>
                
                <th width="5%">PO No.</th>
                <th width="5%">PO Date</th>
             <!--   <th width="7%">PO raised Datetime</th> -->
                <th width="5%">Buyer Name</th>
                <th width="10%">Address</th>
                <th width="5%">Sales person</th>
                <th width="3%">No. of Sites</th>
                <th width="4%">AMC Value</th>
                <th width="4%">PO Start Date</th>
                <th width="4%">PO Expiry Date</th>
                <th width="3%">PO File</th>
                <th width="3%">Site Data</th>
                <th width="5%">See Products</th>
                <th width="5%">Upload Status</th> 
                <th width="4%">Billing Period</th>
                <th width="5%">Created By</th> 
                
                <th width="5%">Bill Status</th>
                
                <th width="5%">Last Inv. No.</th> 
                <th width="4%">Last Inv. Date</th>
                <th width="4%">Last Inv. Amount</th>
                
                <th width="4%">Bill Due date </th> 
                <th width="6%">Actions </th> 
                
                
                <th width="5%">Generate</th> 
               
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
$branch_id=  $row['bill_branch'];
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

$bill_status=$row['bill_status'];

$upload_date= $row['upload_date'];
$status= $row['status'];

$custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cust_id."'");
$custname1=mysqli_fetch_row($custname);

$brname=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$branch_id."'");
$br=mysqli_fetch_row($brname);
if( $branch_id=='all') { $branch='All';}
else $branch=$br[0];
?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->
<td width="77"> <?  echo $custname1[0];  ?></td>
<td width="77"> <?  echo $branch;  ?></td>
<td width="5%"><? echo $po_no;?></td> 
<td width="5%"><? echo $po_date;?></td> 
<!--<td width="5%"> <? echo $created_at; ?></td> -->
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

<td width="50" style="color:Red"> <?php if($status==1) {echo "Pending";}
    if($status==2) {echo "Uploaded";}

?> </td>

<td width="75"><?php if($billperiod==0){ echo "100% Adv";}
if($billperiod==3){ echo "Quarterly";}
if($billperiod==6){ echo "Half Year";}
if($billperiod==12){ echo "After Completion";}


?></td>


<td width="75"><?php echo $created_by;?></td> 

<? 
//==============================Bills
$billsquery=mysqli_query($con1,"select * from `amc_bills` where `po_id`='".$id."'order by id DESC limit 1");
$bill=mysqli_fetch_row($billsquery);


if($bill_status==0){ $dis="Pending";}
if($bill_status==1){ $dis="Partial Bills Done";}
if($bill_status==2){ $dis="Completed";}

?>

<td><?php echo $dis;?></td>

<td><?php echo $bill[2];?></td> 
<td><?php echo $bill[3];?></td>
<td><?php echo $bill[4];?></td> 
<?
//======
$curr=strtotime(date('Y-m-d'));
$start_date1=strtotime($start_date);
$repet=strtotime($bill[7]);
$expdt=strtotime($exp_date);

//echo $exp_date;

if($bill_status==0 && $billperiod==0){$duedate=$start_date;}

if($bill_status==0){
if($billperiod==3){
$duedate=date('Y-m-d', strtotime('+3 months', $start_date1));} 
elseif ($billperiod==6){
$duedate=date('Y-m-d', strtotime('+6 months', $start_date1));} 

elseif ($billperiod==12){
$duedate=$exp_date;} 
}

elseif($bill_status==1){
if($billperiod==3){
$duedate=date('Y-m-d', strtotime('+3 months', $repet));} 
elseif ($billperiod==6){
$duedate=date('Y-m-d', strtotime('+6 months', $repet));} 
elseif ($billperiod==12){
$duedate=$exp_date;} 
}
$duedate1=strtotime($duedate);

if($duedate1 > $expdt ) { $duedate=$exp_date;}

//=== 100% Adv===
if($bill_status==0 && $billperiod==0 ){ $act= "Raise the Bill";}

if($bill_status==0 && $duedate1 < $curr ){$act= "Raise Bill";} 
if($bill_status==0 && $duedate1 > $curr ){$act= "Period not Over"; }
if($bill_status==1 && $duedate1 < $curr ){$act= "Raise Part Bill";} 
if($bill_status==1 && $duedate1 > $curr ){$act= "Part Period not Over"; }

?>
<td><?php echo $duedate;?></td>
<td><?php echo $act;?></td> 

<td>
<?php  
if($bill_status !='0'){ ?>
<a href="<?php echo $bill[6]; ?>" target="_blank" ><image src="<?php echo $bill[5]; ?>" alt="Inv" width="50" height="50" /></a>
<?php } ?>
</td> 

<?php if($_SESSION['designation']==7){ ?>
<td>		
<? 

if($bill_status !='2'){ ?>
<a href="javascript:void(0);" class="btn btn-primary" style="color:yellow;" onclick="window.open('amc_inv_upload.php?id=<? echo $id;?>','view updates','width=600px,height=600,left=350,top=75')" class="update">Generate Invoice</a>
<?php }  else { echo " Full Period Billed";} 
?> 
</td>
<? } elseif ($_SESSION['designation']==5){ ?>
<td>		
<? if($bill_status =='0'){ ?>
<a href="javascript:void(0);" class="btn btn-primary" style="color:yellow;" onclick="window.open('edit_new_amcpo.php?id=<? echo $id;?>','view updates','width=800px,height=600,left=200,top=40')" class="update">Edit AMC PO</a>
<?php }  else { echo " You Can't Edit Now";} 
?> 
</td>
<? } ?>

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

<form name="frm" method="post" action="export_amcso.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>-->
