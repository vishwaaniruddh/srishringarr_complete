<?php session_start();
include("access.php");
include('config.php');


function get_salesPerson($id){
    
    global $con2;
    
    $sql = mysqli_query($con1,"select * from purchase_order where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $person_id = $sql_result['salesperson'];
    
    $executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where exe_id='".$person_id."'");
    $executive_name = mysqli_fetch_assoc($executive_qry);
    $name = $executive_name['exe_name'];
    
    return $name;
    
}


function buyer_data($parameter,$buyer_id){
    
    $sql = mysqli_query($con1,"select $parameter from buyer where buyer_ID='".$buyer_id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $result = $sql_result[$parameter];
        return $result;
    }

if($_SESSION['designation']==7 ){
            
            $customer_qry = "select * from login where srno='".$_SESSION['logid']."'";

        
        $query = mysqli_query($con1,$customer_qry);
        
        while($branch_qry_result = mysqli_fetch_assoc($query)){
        

          $branch_ids[] = $branch_qry_result['branch']; 

}

        }
 
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">PO Number</th> 
<th width="5%">PO Date</th> 
<th width="5%">SO Datetime</th>
<th width="5%">Customer Vertical</th>
<th width="5%">Branch</th>
<th width="5%">Buyer Name & Address</th>
<th width="5%">Buyer GST No</th>
<th width="5%">End User</th>
<th width="5%">City</th>
<th width="5%">Address</th>
<th width="5%">State</th>

<th width="5%">Contact Person</th>
<th width="5%">Contact No</th>
<th width="5%">PO Additional Info</th>
<th width="5%">PO Remarks</th>
<th width="5%">SO Remarks</th>
<th width="5%">SO Status</th>
<th width="5%">View/ Add Updates</th>
<th width="5%">Last Remarks</th>
<th width="5%">Specifications</th>
<th width="5%">Action</th>
<th width="5%">Generate</th>
</tr>
 
<? 
      
 $strPage = $_REQUEST['Page'];
 $branch=$_POST['branch_avo'];
  $cid=$_POST['cid'];
  $status=$_POST['status'];
  $poname=$_POST['po_no'];
  $fromdt=$_POST['fromdt'];
  $todt=$_POST['todt'];
  
$from2 = str_replace('/', '-', $fromdt);
$fromdate = date('Y-m-d', strtotime($from2));

$todt2 = str_replace('/', '-', $todt);
$todate = date('Y-m-d', strtotime($todt2));
//===================================
       
  $sql= "select * from new_sales_order where 1";  
  
 if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{
   	$sql.=" and branch_id in('".$branch."') ";
  	}  

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
    
  	$sql .=" and date(so_time) between '".$fromdate."' and '".$todate."'";
} 

if(isset($_POST['atmid']) && $_POST['atmid']!='')
{  $atmid=$_POST['atmid'];
    $sql.=" and atm_id LIKE '%".$atmid."%'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$sql.=" and po_custid ='".$cid."'";
}
 
 
 if(isset($_POST['status']) && $_POST['status']!='')
 {
 $sql.=" and status ='".$status."'";    
 }
 
 if(isset($_POST['po_no']) && $_POST['po_no']!='')
 {
$poqry=mysqli_query($con1,"select id from purchase_order where po_no='".$poname."'");
$pono=mysqli_fetch_row($poqry);
$po_id=$pono[0];
 $sql.=" and po_trackid ='".$po_id."'";    
 }
 
$table=mysqli_query($con1,$sql);
$count=0;
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


$qr22=$sql;
$sql.=" order by so_trackid DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
include("config.php");
while($row= mysqli_fetch_assoc($table))
{
//==================

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row['po_custid']."'");
	$custrow=mysqli_fetch_row($qry);
	
	$demoqry=mysqli_query($con1,"select * from demo_atm where so_id='".$row['so_trackid']."'");
	$atm=mysqli_fetch_row($demoqry);
	
	$poqry=mysqli_query($con1,"select po_no, po_date, non_standard_item_product, po_remarks from purchase_order where id='".$row['po_trackid']."'");
	$po=mysqli_fetch_row($poqry);
	
	$branchqry=mysqli_query($con1,"select name from avo_branch where id='".$row['branch_id']."'");
	$br=mysqli_fetch_row($branchqry);

$status=$row['status'];
$so_trackid=$row['so_trackid'];
$bb = $row['bb_available'];
?>


<tr>


<td  valign="top"><?php echo $po[0]; ?></td>
<td  valign="top"><?php echo $po[1]; ?></td>
<td  valign="top"><?php echo $row['so_time']; ?></td>
<td  valign="top"><?php echo $custrow[0]; ?></td>
<td  valign="top"><?php echo $br[0]; ?></td>
<td  valign="top"><?php echo "Buyer"; ?></td>
<td  valign="top"><?php echo "GST"; ?></td>
<td  valign="top"><?php echo $atm[6]; ?></td>
<td  valign="top"><?php echo $atm[9]; ?></td>
<td  valign="top"><?php echo $atm[11]; ?></td>
<td  valign="top"><?php echo $atm[13]; ?></td>
<td  valign="top"><?php echo $row['user_cont_name']; ?></td>
<td  valign="top"><?php echo $row['user_cont_phone']; ?></td>
<td  valign="top"><?php echo $po[2]; ?></td>
<td  valign="top"><?php echo $po[3]; ?></td>

<td  valign="top"><?php echo $row['remarks']; ?></td>

<td><? if($status ==1) {echo "Pending";}
         if($status ==c) {echo "Cancelled";}
         if($status ==h) {echo "on Hold";}
         if($status ==2) {echo "Billed";}
    ?></td> 


<td>
         <a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('view_SO.php?id=<? echo $so_trackid;?>&amp;typ=1','view updates','width=700px,height=750,left=200,top=40')" class="update">View</a> <br>
    
        <a href="javascript:void(0);" class="btn btn-danger" onclick="window.open('update_generateSO.php?id=<? echo $so_trackid;?>&amp;typ=1','Update_generateSO','width=700px,height=750,left=200,top=40')" class="update">Add</a>
    </td>

<?php $remark=mysqli_query($con1,"select * from SO_Update where so_id='".$so_trackid."' and remarks_type='1' ORDER BY updt_id DESC LIMIT 1");
$lst_remark = mysqli_fetch_assoc($remark);
$last_remark= $lst_remark['Remarks_update'];
?>
     <td><? echo $last_remark;?></td> 

<td> Under test</td>
<!--<td>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#<? echo $so_trackid; ?>">See Products</a>
    <br>
    
    <? if($bb){ ?>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#buy<? echo $so_trackid; ?>">See Buyback</a>
    <? }?>
    
    
    </td> -->
    
    
<? if($filter =='Pending' || !$filter) { ?>    
    
    <? if($_SESSION['designation']==5 || $_SESSION['user']=='acc-admin2535'){?>
    <td style="display: flex;justify-content: center;">
        <a style="margin:3px;" class="btn btn-danger sales_btn" sales_id="<? echo $so_trackid; ?>" id="<? echo $po_id; ?>" href="#" onclick="cancel_sales();">Cancel</a>
        <span style="border-left :1px solid black;"></span>

    <a style="margin:3px;" class="btn btn-warning hold_btn" sales_id="<? echo $so_trackid; ?>" id="<? echo $po_id; ?>" href="#" onclick="hold_sales();">Hold</a>
    
   </td>
    <? } ?>
  
     <td style="display: flex;justify-content: center;">
     <a style="color:black;" style="margin:5px;"class="btn btn-success" href="view_so.php?id=<? echo $so_trackid; ?>">View SO</a>
   </td>
    
   
      <td style="display: flex;justify-content: center;">
      
       <? if($_SESSION['designation']!=5){ ?>   
      
        <a style="color:black;" class="btn btn-warning hold_btn" href="new_salesorder.php?id=<? echo $so_trackid; ?>">Generate</a>
      <? } ?>   
    
    </td>

   <? } elseif($filter =='Hold'){ ?>
    <td>
      <a style="margin:5px;" class="btn btn-warning unhold_btn" sales_id="<? echo $so_trackid; ?>" id="<? echo $po_id; ?>" href="#" onclick="unhold_sales();">Unhold</a>
    </td>
    
    <? } elseif ($filter =='Cancel') { ?>
       
    <td>
        <a style="color:black;" class="btn btn-success" href="<? echo get_invoice($so_trackid); ?>">View Invoice</a>
    </td>
    
    <? }    ?>

</tr>
<?php
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
} ?>

<div id="bg" class="popup_bg"> </div> 

?>
        
        