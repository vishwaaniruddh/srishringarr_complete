<? session_start(); 
include('config.php');
include("access.php");


?>

<!--get menu -->

        <?
        if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
        ?>


 <!--end menu-->
<? 


function get_model($id){
    
    global $con1;
        
    $model_sql = mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$id."'");
    
        $model_sql_result = mysqli_fetch_assoc($model_sql);
        
        return $model_sql_result['name'];
        


}


function get_purchase_order($id){
    
    $sql= mysqli_query($con1,"select * from purchase_order where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    
    return $sql_result['po_no'];
}

function get_asset_count($po_no){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select count(po_no) as asset_count from po_assets where po_no='".$po_no."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['asset_count'];
    
    
}

function customer_vertical_id($name){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}


function get_sales_team($parameter,$id){
    

    global $con2;

    $sql = mysqli_query($con2,"select $parameter from salesteam where exe_id ='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;
    
}

function get_cust_vertical_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_name = $sql_result['cust_name'];
    
    return $cust_name;
}


function get_buyername($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $buyer_name = $sql_result['buyer_name'];
    
    return $buyer_name;
    
    
}

function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}




function check_po_complete($po_id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from po_consumption where po_trackid='".$po_id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['po_status'];
    
}


function get_sales_order_count($po_id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select count(*) as fetch_count from new_sales_order where po_trackid='".$po_id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $count = $sql_result['fetch_count'];
    
    if($count>0){
        return $count;
    }
    else{
        return 0;
    }
    
}



// get all customer vertical for account manager as comma seprated value

if($_SESSION['designation']==5){
            
            $customer_qry = "select * from clienthandle where logid='".$_SESSION['logid']."'";
            
        }
        else{
            
            $customer_qry = "select * from customer";    
        }
        
        
        $query = mysqli_query($con1,$customer_qry);

while($customer_qry_result = mysqli_fetch_assoc($query)){

$cust_vertical_name = $customer_qry_result['client']; 
    
    $cust_vertical_id[] = customer_vertical_id($cust_vertical_name);
}
            
            
    $cust_vertical_id=json_encode($cust_vertical_id);
        
    $cust_vertical_id=str_replace( array('[',']') , ''  , $cust_vertical_id);
            
    $cust_vertical_id = implode(',',array_unique(explode(',', $cust_vertical_id)));



// end get all customer vertical for account manager as comma seprated value




?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Users</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <script src="popup.js" type="text/jscript" language="javascript"> </script>
        
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        
        
        <style>
        #menu-bar li:hover > ul{
            text-align:center;
        }
        .additional_buttons{
            display:flex;
            margin:1% ! important;
        }
        .additional_buttons form{
            margin: auto 2%;            
        }

        .pagination{
            width: 100%;
    display: flex;
    justify-content: center;
        }
        tr:nth-of-type(2n-1) a,tr:nth-of-type(2n) a{
            color:white;
        }
        
            body {
    background-color: #4D9494;
    margin-top: 10px;
}
        </style>
        </head>
        <body>
            
                 <?
                
//  Pagination
 
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
        }
        else {
            $pageno = 1;
        }

        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        
  
  if($_SESSION['designation']==5){
                    $statement= "select * from purchase_order where cust_id in($cust_vertical_id) and po_status=1 ";                         
                     }
                     else{
                    $statement= "select * from purchase_order where po_status=1 ";
                     }
                     
if(!empty($_POST['po_no'])) {
    $statement .= " and po_no like '%".$_POST['po_no']."%' ";
}

if(!empty($_POST['cust_id'])) {
    $statement .= " and cust_id = '".$_POST['cust_id']."' ";
}
 
if(!empty($_POST['branch_id'])) {
    $statement .= " and branch_id = '".$_POST['branch_id']."' ";
}       


    $result = mysqli_query($con1,$statement);
    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $no_of_records_per_page);  



    $statement .=" order by id desc LIMIT $offset, $no_of_records_per_page";
    $sql =$statement;
    
//  echo $statement;

    $qryrow = mysqli_query($con1,$sql);

?>    
            
            
            
            <div class="container-fluid" style="margin: 2% 0%;">
                
                
                <div class="search_fields" >
                    
                    
                    <form class="form-inline" method="POST">
                    <div class="form-group mb-2">
                    <label for="staticEmail2" class="sr-only">PO_NO</label>
                    <input type="text"  class="form-control" id="po_no" name="po_no" value="<? echo $_POST['po_no']; ?>" placeholder="PO Number !!">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                    <label for="custer_vertical" class="sr-only">Customer Vertical</label>
                    

                    
                    
                    
                    <select id="cust_id" name="cust_id" id="cust_id" class="form-control" >
                            <option  value="">Select Vertical</option>
                            
                            
                            <?php 
                            
                            $customer_qry  = mysqli_query($con1,$customer_qry);
                            while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { 
                            

                            if($_SESSION['designation']==5){ ?>
                            <option value="<? echo customer_vertical_id($customer_vertical["client"]); ?>" <? if($_POST['cust_id'] == customer_vertical_id($customer_vertical["client"])){ echo 'selected'; }?> >
                                <?php echo $customer_vertical["client"];?>
                            </option>
                            <? } else{ ?> 
                                
                            <option value="<? echo $customer_vertical['cust_id']; ?>" <? if($_POST['cust_id'] == $customer_vertical['cust_id'] ){ echo 'selected'; }?> >
                                <?php echo $customer_vertical["cust_name"];?>
                            </option>
                            <? } ?>
                            



                                <? } ?>
                                   


                        </select>
                    </div>
                    
                    
                    <div class="form-group mb-2">
                    <label for="buyer" class="sr-only">Branch</label>
                    
                        <select id="branch_id" name="branch_id" class="form-control">
                                     
                            <option  value="">Select Branch </option>
                            <?php
                            
                            $brach_sql = mysqli_query($con1,"select * from avo_branch");
                            while ($brach_sql_result = mysqli_fetch_assoc($brach_sql)) { ?>
                                <option value= "<?php echo $brach_sql_result['id']; ?>" <? if($_POST['branch_id'] == $brach_sql_result['id'] ){ echo 'selected'; } ?> > 
                                    <?php echo $brach_sql_result["name"];?>
                                </option>
                                <?php } ?>
                        
                        </select>
                    </div>
                    
                    
                    <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">GST</label>
                    <input type="text" class="form-control" id="search_gst" name="gst" value="<? echo $_POST['gst']; ?>" placeholder="Enter GST  !!">
                    </div>
                    
                    
                    <input class="btn btn-success" type="submit" name="search" value="Search">
                    
                    </form>

                    

                   
                   
                </div>
     
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
           <tr>
               <th>Customer Vertical</th>
                <th>PO Number</th>
                <th>PO Date</th>
                <th>Buyer Name</th>
                <th>Buyer Address</th>
                <th>GST</th>
                <th>Sales Exe</th>
                <th>PO Raised By:</th>
                <th>TAT</th>
                <th>Branch</th>
                <th>Payment</th>
                <th>Remarks</th>
                <th>Date</th>
                <th>Products</th>
                <th>Sales Orders</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
             
                    <h4 style="color:white;text-align:right;">Total <? echo $total_rows;?> Records..</h4>
            
            <?
            
            

            while($sql_result = mysqli_fetch_assoc($qryrow)){ 
                
                $cust_id = $sql_result['cust_id'];
                $po_id = $sql_result['id'];
                
              ?>  
               
                <tr>
                    <td><? echo get_cust_vertical_name($cust_id);?></td>
                    <td><? echo $sql_result['po_no'];?></td>
                     <td><? echo $sql_result['po_date'];?></td>
                    <td><? echo get_buyername($sql_result['buyer_id']);?></td>
                    <td><? echo $sql_result['buyeraddress'];?></td>
                    <td><? echo $sql_result['gst'];?></td>
                    <td><? echo get_sales_team('exe_name',$sql_result['salesperson']);?></td>
                    <td><? echo $sql_result['po_raiseby'];?></td>
                    <td><? echo $sql_result['po_tat'];?></td>
                    <td><? echo get_branch_name($sql_result['branch_id']);?></td>
                    <td><? echo $sql_result['po_payment'];?></td>
                    <td><? echo $sql_result['po_remarks'];?></td>
                    <td><? echo $sql_result['po_time'];?></td>
                    
                    
                    
                    
                <td>
                    
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#<? echo $po_id; ?>">
                    See Products
                </a>
        
                </td>
                
                <td>
                    
                    <? if(get_sales_order_count($po_id)>0){ ?>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#sales<? echo $po_id; ?>">
                    See Sales Orders
                </a>
                <? } else {
echo 'No sales Record Found';
}                ?>
                </td>
                    
                    
                <? if(check_po_complete($po_id)=='' || check_po_complete($po_id)!=0){ ?>
                    <td>
                        <a href="edit_purchase_order.php?action=edit&&id=<?php echo $sql_result['id'];?>" class="btn btn-success">Edit</a>

                             
                        <a href="process_purchase_order.php?id=<?php echo $sql_result['id'];?>&action=delete" class="btn btn-danger">Delete</a>
                       
                        <a href="add_sales_order.php?id=<?php echo $sql_result['id'];?>" class="btn btn-danger">Sales Order</a>
                        </td>
                        
                    <? }
                    else{ ?>
                      <td>
                     <!--     <a href="view_complete_po_order.php?id=<? echo $po_id;?>">View</a>  -->
                      </td>
                        
                    <? }
                    ?>
                
                </tr>
                
                
            <?  // end condition for check consumption
            }
            
            ?>

       
        </tfoot>
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
    
     <form name="frm" method="post" action="purchase_order_export.php" target="_new" style="text-align: center;">


    <? if($statement){ ?>
    <input type="hidden" name="qr" value="<?php echo $statement; ?>" readonly>    
    <? } else { ?>
    <input type="hidden" name="qr" value="<?php echo "select * from purchase_order where po_status=1 order by id desc ;"; ?>" readonly>
    <? } ?>         
    
    
    
    <input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
    </form>
    

</div>     
    
    
</body>
</html>