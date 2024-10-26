<?php session_start();
include("access.php");
include('config.php');



//echo $_SESSION['user'];



     if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
        
        

//var_dump($_SESSION);

function get_salesPerson($id,$con1){
    
    global $con2;
    
    $sql = mysqli_query($con1,"select * from purchase_order where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $person_id = $sql_result['salesperson'];
    
    $executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where exe_id='".$person_id."'");
    $executive_name = mysqli_fetch_assoc($executive_qry);
    $name = $executive_name['exe_name'];
    
    return $name;
    
}


function get_purchase_order($id){
    
    $sql= mysqli_query($con1,"select * from purchase_order where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    
    return $sql_result['po_no'];
}




function get_po_id($po_no){
    $sql = mysqli_query($con1,"select * from purchase_order where po_no like '%".$po_no."%' order by id desc");
    $sql_result =mysqli_fetch_assoc($sql);
    
    $po_id = $sql_result['id'];
    
    return $po_id; 
}



// get all branch_id for accounts as comma seprated value

if($_SESSION['designation']==7 ){
            
            $customer_qry = "select * from login where srno='".$_SESSION['logid']."'";

        
        $query = mysqli_query($con1,$customer_qry);
        
        while($branch_qry_result = mysqli_fetch_assoc($query)){
        

          $branch_ids[] = $branch_qry_result['branch']; 



        }
        
        

        

        
        if(strlen($branch_ids)>2){
            $branch_id=json_encode($branch_ids);
            
            $branch_id=str_replace( array('[',']') , ''  , $branch_id);
            
            $branch_id = implode(',',array_unique(explode(',', $branch_id)));
            

        }
        else{
            $branch_id = $_SESSION['branch'];
        }
        
        

        
        }
        else{
            
            $customer_qry = "select * from avo_branch";    
        }
        



// end get all branch_id for accounts as comma seprated value



// get all customer vertical


if($_SESSION['designation']==5 ){
            
            $cv = "select * from clienthandle where logid='".$_SESSION['logid']."'";

        
        $cv_query = mysqli_query($con1,$cv);
        
        while($cv_result = mysqli_fetch_assoc($cv_query)){
        

          $cv = $cv_result['client']; 
          
          $get_cust_sql = mysqli_query($con1,"select * from customer where cust_name='".$cv."'");
          $get_cust_sql_result = mysqli_fetch_assoc($get_cust_sql);
          
          $cvs[] = $get_cust_sql_result['cust_id'];
        }
  

          if($cvs){
            $cust=json_encode($cvs);
            
            $cust=str_replace( array('[',']') , ''  , $cust);
            
            $cust = implode(',',array_unique(explode(',', $cust)));
            
        }
        
        }
        else{
            
            $customer_qry = "select * from customer";    
        }
        
         // end get all customer vertical
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View SO</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        
        <script src="popup.js" type="text/jscript" language="javascript"> </script>
        
        
        <style>
        #menu-bar li:hover > ul{
            text-align:center;
        }
        .additional_buttons{
            display:flex;
            margin:1% ! important;
        }
        .additional_buttons form{
            margin: auto 1%;            
        }

        .pagination{
            width: 100%;
    display: flex;
    justify-content: center;
        }
        tr:nth-of-type(2n-1) a,tr:nth-of-type(2n) a{
            color:white;
        }
        #menu-bar ul{
    z-index: 999;
}

            body {
    background-color: #4D9494;
    margin-top: 10px;
}


th{
        white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: middle !important;
    text-align:center;
}
td{
        vertical-align: middle !important;
}
.ellipsis{
        white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    
}
        </style>
        </head>
    <body>
    

            <?
            
            // var_dump($_POST);
            
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 20;
                $offset = ($pageno-1) * $no_of_records_per_page; 
//echo $offset;

        ?>    
            
                  
            <div class="container-fluid">
                
                
                <div class="search_fields" style="margin: 1% auto;">
                    
                    
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <form action="view_sales_order.php" class="form-inline" method="POST">
                            
                            <div class="form-group mb-2">
                                <label for="staticEmail2" class="sr-only">PO_NO</label>
                                <input type="text"  class="form-control" id="po_trackid" name="po_trackid" value="<? echo $_POST['po_trackid'];?>" placeholder="PO Number !!">
                            </div>
                            
                            
                            <div class="form-group mb-2">
                                <label for="staticEmail2" class="sr-only">ATM ID</label>
                                <input type="text"  class="form-control" id="atm_id" name="atm_id" value="<? echo $_POST['atm_id'];?>" placeholder="ATM ID">
                            </div>
                            
                            
                            
                            
                            <div class="form-group mx-sm-3 mb-1">
                            <label for="custer_vertical" class="sr-only">Customer Vertical</label>
                             <select id="po_custid" class="form-control" name="po_custid">
                                        
                                         
                                    <option  value="">Select Customer Vertical</option>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <?php
                                    if($cust){
                                        
                                    
                                    $customer_qry = mysqli_query($con1,"select * from customer where cust_id in($cust)");
                                        while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                                            <option value= "<?php echo $customer_vertical['cust_id']; ?>" <? if($_POST['po_custid']==$customer_vertical['cust_id']){ echo 'selected'; } ?> >
                                                 <?php echo $customer_vertical["cust_name"];?>
                                            </option>
                                        <?php } 
                                        
                                    } else{
                                        

                                        ?>
                                        
                                        
                                                                            <?php
                                    $customer_qry = mysqli_query($con1,"select * from customer");
                                        while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                                            <option value= "<?php echo $customer_vertical['cust_id']; ?>" <? if($_POST['po_custid']==$customer_vertical['cust_id']){ echo 'selected'; } ?> >
                                                 <?php echo $customer_vertical["cust_name"];?>
                                            </option>
                                        <?php } 
                                        
                                            }
                                ?>
                                </select>
                            </div>
                           
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="branch_id" class="sr-only">Branch</label>

                             <select id="branch_id" class="form-control" name="branch_id">
                                        
                                         
                                    <option  value="">Select Branch</option>
                                    <?php
                                    if($_SESSION['designation']==7 ){
                                        
                                        if($_SESSION['branch']!='all'){
                                            $branch_sql = mysqli_query($con1,"select * from avo_branch where id in($branch_id)");                                            
                                        }
                                        else{
                                                $branch_sql = mysqli_query($con1,"select * from avo_branch");
                                        }


                                    }
                                    else{
                                        $branch_sql = mysqli_query($con1,"select * from avo_branch");
                                        
                                    }
                                    
                                    
                                        while ($branch_sql_result = mysqli_fetch_assoc($branch_sql)) { ?>
                                            <option value= "<?php echo $branch_sql_result['id']; ?>" <? if($_POST['branch_id']==$branch_sql_result['id']){ echo 'selected'; }
                                            ?>>
                                            
                                                 <?php echo $branch_sql_result["name"];?>
                                            
                                            </option>
                                        <?php } ?>
                                
                                    </select>
                            </div>
                            
                          <select name="status" class="filter form-control">
                              
                                <option value="">All Status</option> 
                                <option value="1" <? if($_POST['status'] == '1'){ echo 'selected' ; }?> >Pending</option>
                                <option value="c" <? if($_POST['status'] == 'c'){ echo 'selected' ; }?> >Cancel</option>
                                <option value='h' <? if($_POST['status'] == 'h'){ echo 'selected' ; }?> >Hold</option>
                                <option value='2' <? if($_POST['status'] == '2'){ echo 'selected' ; }?> >Close</option>
                                <option value='old' <? if($_POST['status'] == 'old'){ echo 'selected' ; }?> >Long Pending</option>
                            </select>
                            
                            
                            <input type="text" name="fromdt" id="fromdt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date">
                            
                            <input type="text" name="todt" id="todt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date">
                            
                            <input class="btn btn-success" type="submit" name="search" value="Search">
                            
                            </form>
                    
                        </div>
                     
                    </div>
                    
                    
                </div>
            </div>
   
<?


if($_SESSION['designation']==7 || $_SESSION['designation']=="7"){
                        
                        
                        if(strlen($branch_id)==0 || $branch_id=='all'){
                        $statement= "select * from new_sales_order where 1";    
                        }
                        else{
                            $statement= "select * from new_sales_order where branch_id in($branch_id) and ";
                        }
                        
                        
                         }
                    
                    else {
                        $statement= "select * from new_sales_order where 1";                        
                    }

//echo $statement;
if(!empty($_POST['po_trackid'])){
    $statement .=" and po_trackid LIKE '%".get_po_id($val)."%'";
}

if(!empty($_POST['branch_id'])){
    $statement .=" and branch_id = '".$_POST['branch_id']."'";
}

if(!empty($_POST['po_custid'])){
    $statement .=" and po_custid = '".$_POST['po_custid']."'";
}

if(!empty($_POST['atm_id'])){
    $statement .=" and atm_id like '%".$_POST['atm_id']."%'";
}

if(!empty($_POST['status'] && $_POST['status'] !='old')){
    $statement .=" and status = '".$_POST['status']."'";
}
else if($_POST['status']== 'old') {
                                
    $cutdate = strtotime("-8 day", time());
    $cdate=date('Y-m-d H:i:s', $cutdate); 
    $statement .=" and status='1' and so_time <= '".$cdate."'";
                                $statement .= " and";
                            }
if(!empty($_POST['fromdt'])){
    $date1 = str_replace('/', '-', $_POST['fromdt']);
    $date1 = date('Y-m-d', strtotime($date1));
    $statement .=" and so_time >= '".$date1."'";
}
if(!empty($_POST['todt'])){

    $date2 = str_replace('/', '-', $_POST['todt']);
    $date2 = date('Y-m-d', strtotime($date2));
    $statement .=" and so_time <= '".$date2."'";
}

//echo $statement;
  $export= $statement;

    // Counting Rows for pagination
    
    $result = mysqli_query($con1,$statement);
    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    

                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 20;
                $offset = ($pageno-1) * $no_of_records_per_page; 
//echo $offset;
   
   $statement .= " order by so_trackid desc LIMIT $offset, $no_of_records_per_page";
   
  //  echo $statement;
 
    $sql = mysqli_query($con1,$statement);


?>
   <h4 style="color:white; text-align:center;">View Sales Order</h4>
    
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
           <tr>


<th width="5%">PO No</th> 
<th width="5%">PO Date</th>
<th width="5%">Do No</th>
<!--<th width="5%">DO Date</th>-->
<th width="5%">SO Date/time</th>
<th width="5%">End User/Consignee</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">Delivery/Consignee Address</th>
<th width="5%">CITY</th>
<th width="5%">STATE</th>
<th width="5%">PIN CODE</th>
<th width="5%">Sales Person</th>
<th width="5%">Vertical/ Customer</th>
<th width="10%">Buyer Name/Address</th>
<th width="5%">Buyer GST No.</th>
<th width="5%">Contact Person</th>
<th width="5%">Contact No.</th>
<th width="5%">PO additional info</th>
<th width="5%">PO Remarks.</th>
<th width="5%">SO Status</th>
<th width="5%">View / Add Updates </th>
<th width="5%">Last Remarks </th>
<th width="5%">Specification</th>

<? if($filter =='Closed')  { ?>
<th>View Invoice</th>
<? }

elseif ($filter =='Pending' || !$filter) { ?>
    <? if($_SESSION['designation']!=7){ ?>
  <th>Actions</th>       
     <? } ?>
    
    
    <?
    if($_SESSION['designation']!=5){ ?>
    
<th>Generate</th> 

<? } ?>
<? }
elseif ($filter =='Hold') { ?>

    <? if($_SESSION['designation']!=7){ ?>
  <th>Actions</th>       
    <? } ?>
<? }    
?>


</tr>
        </thead>
        <tbody>
            
 

<h4 style="color:white;text-align:center;">Total <? echo $total_rows;?> Records..</h4>
  <?      
        while($sql_result=mysqli_fetch_assoc($sql)){
         
        $so_trackid = $sql_result['so_trackid'];
        $po_id = $sql_result['po_trackid'];
        $atm_id = $sql_result['atm_id'];
        $customer_vertical = $sql_result['po_custid']; 
    
        
        $buyer_id = $sql_result['buyerid'];
        $status = $sql_result['status'];
        $bb = $sql_result['bb_available'];
        
        
        ?>



<!--End Buyback Modal-->

<? 
$so_time1=$sql_result['so_time'] ; 
$so_time = date('Y-m-d h:i:s A', strtotime($so_time1)+41400); // 11:30 Hrs added for IST from USA time
$date_diff=strtotime("-7 day");
$so_curr_date=strtotime($so_time1);

//echo "select * from purchase_order where id='".$po_id."'";

$sqlpo = mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
$porow = mysqli_fetch_assoc($sqlpo);

$sqldemo = mysqli_query($con1,"select * from demo_atm where so_id='".$so_trackid."'");
$demo_row = mysqli_fetch_assoc($sqldemo);

$consignee = $demo_row['bank_name'];
$address = $demo_row['address'];

$sql_cus=mysqli_query($con1,"select cust_name from customer where cust_id='".$customer_vertical."'");
$cust_name = mysqli_fetch_assoc($sql_cus);

$sql_buyer = mysqli_query($con1,"select * from buyer where buyer_ID='".$buyer_id."'");
$buyer_result = mysqli_fetch_assoc($sql_buyer);

?>

<tr <?php if($sql_result['status']=='1' && $so_curr_date < $date_diff){ echo "style='background:red'"; } ?> >
    <td class="ellipsis"><? echo $porow['po_no']; ?></td> 
    <td class="ellipsis"><? echo $porow['po_date']; ?></td>
    <td><? echo $sql_result['DO_no']; ?></td>
    <!--<td>DO Date</td>-->
  <!--  <td class="ellipsis"><? echo $sql_result['so_time'];?></td> -->
    
    <td class="ellipsis"><? echo $so_time ;?></td>
    <td><? echo $consignee; ?></td>
    <td class="ellipsis"><? echo $sql_result['atm_id']; ?></td>
    <td><? echo $address; ?></td>
    <td><? echo $demo_row['city']; ?></td>
    <td><? echo $demo_row['state']; ?></td>
    <td><? echo $demo_row['pincode']; ?></td>
    <td class="ellipsis"><? echo get_salesPerson($po_id,$con1); ?></td>
    <td><? echo $cust_name['cust_name']; ?></td>
    <td><? echo $buyer_result['buyer_name'].'<br>'.$buyer_result['buyer_address']; ?></td>
    <td><? echo $porow['gst']; ?></td>
    <td class="ellipsis"><? echo $sql_result['user_cont_name'];?></td>
    <td><? echo $sql_result['user_cont_phone'];?></td>
    <td><? echo $porow['non_standard_item_product'];?></td>
    <td><? echo $porow['po_remarks'];?></td> 
   
     <td><? if($status =='1') {echo "Pending";}
         elseif($status =='c') {echo "Cancelled";}
         elseif($status =='h') {echo "on Hold";}
         elseif($status =='2') {echo "Billed";} else{echo "";}
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
    
    <td>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#<? echo $so_trackid; ?>">See Products</a>
    <br>
    
    <? if($bb){ ?>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#buy<? echo $so_trackid; ?>">See Buyback</a>
    <? }?>
    
    
    </td>

<? if($status ==1) { ?>    
    
    <? if($_SESSION['designation']==5 || $_SESSION['user']=='acc-admin'){?>
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
      
        <a style="color:black;" class="btn btn-warning genhold_btn" href="new_salesorder.php?id=<? echo $so_trackid; ?>">Generate</a>
      <? } ?>   
    
    </td>

   <? } elseif($status =='h'){ ?>
    <td>
      <a style="margin:5px;" class="btn btn-warning unhold_btn" sales_id="<? echo $so_trackid; ?>" id="<? echo $po_id; ?>" href="#" onclick="unhold_sales();">Unhold</a>
    </td>
    
    <? }?>
</tr>
           <? } ?>
           
<!-- see product Modal -->
<div id="<? echo $so_trackid; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
          <? echo $po_id;
          ?>
        <h2>For Purchase Order <span style="font-size:18px; color:red;"><? echo get_purchase_order($po_id); ?></span></h2>
        
        <?
        $po_asset_sql = mysqli_query($con1,"select * from new_sales_order_asset where so_trackid='".$so_trackid."'");
        while($po_asset_sql_result = mysqli_fetch_assoc($po_asset_sql)){
            
        $po_asset_id = $po_asset_sql_result['po_model'];
        
        $sqlasset=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$po_asset_id."'");
        $sqlasset_result= mysqli_fetch_assoc($sqlasset);

        echo '<hr>';
        echo '<span style="font-size:18px; color:gray; font-weight:500;">Product Name : </span>'.$po_asset_sql_result['po_product'].'<br>';
        echo '<span style="font-size:18px; color:gray;font-weight:500;">Model : </span>'.$sqlasset_result['name'].'<br>';
       echo '<span style="font-size:18px; color:gray;font-weight:500;">Quantity : </span>'.$po_asset_sql_result['po_qty'].'<br>';
        echo '<span style="font-size:18px; color:gray;font-weight:500;">Price : </span>'.$po_asset_sql_result['po_rate'].'<br>';
        echo '<span style="font-size:18px; color:gray;font-weight:500;">Warranty : </span>'.$po_asset_sql_result['po_warr'].'<br>';
       

        }
        ?>
        
        
        
        
      </div>
     
    </div>

  </div>
</div>
<!--End See product modal-->



<!--buyback Modal-->


<div id="buy<? echo $so_trackid; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
          <h2>Buyback </h2>
        
        <?
        
        $buyback_sql = mysqli_query($con1,"select * from new_buyback where so_trackid='".$so_trackid."'");
        
        $buyback_sql_result = mysqli_fetch_assoc($buyback_sql);
        
        $bb_product = $buyback_sql_result['bb_Product'];
        $bb_cap = $buyback_sql_result['bb_cap'];
        $bb_qty = $buyback_sql_result['bb_qty'];
        $bb_value = $buyback_sql_result['bb_value'];
        
        echo '<hr>';
        echo '<span style="font-size:18px; color:gray; font-weight:500;">Product  </span>'.$bb_product.'<br>';
        echo '<span style="font-size:18px; color:gray; font-weight:500;">Capacity  </span>'.$bb_cap.'<br>';
        echo '<span style="font-size:18px; color:gray; font-weight:500;">Quantity  </span>'.$bb_qty.'<br>';
        echo '<span style="font-size:18px; color:gray; font-weight:500;">Value  </span>'.$bb_value.'<br>';
        
        
    ?>
      </div>
     
    </div>

  </div>
</div>

        </tbody>
    </table>
    
    
    <ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>



  </div>
     
     
<div style="display:flex:justify-content:center">
    
     <form name="frm" method="post" action="sales_export.php" target="_new" style="text-align: center;">


    <? if($statement){ ?>
    <input type="hidden" name="qr" value="<?php echo $export; ?>" readonly>    
    <? } else { ?>
  <input type="hidden" name="qr" value="<?php echo "select * from new_sales_order where status=1 order by so_trackid desc limit 1200 ;"; ?>" readonly> 
    <? } ?>         
    
    
    
    <input type="submit" name="cmdsub" value="Export" > <span>(MAX 1200 Records at one Time.)</span>
    </form>
    

</div>     
    

     
     <script>
     
        $('.filter').on("change",function(){
            
            var filter = $(this).val();
            
            
            
            

        });
     


   $('.sales_btn').click(function(){
      var id =  $(this).attr('id');

    var so_trackid = $(this).attr('sales_id');


                 
swal("Cancel Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();
     
        jQuery.ajax({
                type: "POST",
                url: 'sales_cancel.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+so_trackid }, 
                    success:function(data) {



                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success")
                          
                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);

                        }
                        else{
                           swal("Declined", 'Something Wrong'  , "error");
                        }
                         if(data==2 || data=='2' || data=="2"){
                            
                           swal("Declined", 'Remark Not Added ! '  , "error");
                            
                        }
                        
                    }
            });
});
     


   });

    $('.hold_btn').click(function(){
     
     var id =  $(this).attr('id');
     var so_trackid = $(this).attr('sales_id');

  
swal("Hold Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();  
       
     
        jQuery.ajax({
                type: "POST",
                url: 'sales_hold.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+so_trackid }, 
                    success:function(data) {
               
                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success")


                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);

         
                        }
                        else{
                           swal("Cancelled", 'Something Wrong'  , "error");
                        }
                        
                        if(data==2 || data=='2' || data=="2"){
                            
                           swal("Cancelled", 'Remark Not Added ! '  , "error");
                            
                        }
                    }
            });


});
     


});
   
   
   
       $('.unhold_btn').click(function(){
     
     var id =  $(this).attr('id');
     var so_trackid = $(this).attr('sales_id');

  
swal("Unhold Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();  
       
     
        jQuery.ajax({
                type: "POST",
                url: 'sales_unhold.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+so_trackid }, 
                    success:function(data) {
               
                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success");
                            
                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);


         
                        }
                        else{
                           swal("Cancelled", 'Something Wrong'  , "error");
                        }
                        
                        if(data==2 || data=='2' || data=="2"){
                            
                           swal("Cancelled", 'Remark Not Added ! '  , "error");
                            
                        }
                    }
            });


});
     


});
   
   
   
     </script>       
            

    </body>
</html>
            