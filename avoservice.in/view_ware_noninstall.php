<?php session_start();
include("access.php");
include('config.php');


    


function get_so_status($id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from so_order where po_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['status'];
    
}




function get_new_sales_order_data($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from new_sales_order where so_trackid = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}


function get_branch($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from demo_atm where so_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_id = $sql_result['branch_id'];
    
    $branch_sql = mysqli_query($con1,"select * from avo_branch where id = '".$branch_id."'");
    
    $branch_sql_result = mysqli_fetch_assoc($branch_sql);
    
    return $branch_sql_result['name'];
    
}




function get_cust($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_id = $sql_result['po_custid'];
    
    $cust_sql = mysqli_query($con1,"select * from customer where cust_id = '".$cust_id."'");
    
    $cust_sql_result = mysqli_fetch_assoc($cust_sql);
    
    return $cust_sql_result['cust_name'];
    
}


function get_atm($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from demo_atm where so_id = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}


function is_so_complete($so_id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from so_consumption where so_trackid='".$so_id."'");
   
    if(mysqli_num_rows($sql) > 0) {
    
    $qry= mysqli_query($con1,"select po_status from so_consumption where so_trackid='".$so_id."' and po_status=1 ");
    
   //echo "select po_status from so_consumption where so_trackid='".$so_id."' and po_status=1 ";
   
   if(mysqli_num_rows($qry) >0) {
    
    return 1 ;        
   
    } else { return 0 ;} }
    
    else { return 1 ; }
    

}




$sql = mysqli_query($con1,"select * from new_sales_order where del_type='ware_del' and inst_request=0");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $ware_in[]= $sql_result['so_trackid'];

}

    $ware_in=json_encode($ware_in);
        
    $ware_in=str_replace( array('[',']') , ''  , $ware_in);
            
    $ware_in = implode(',',array_unique(explode(',', $ware_in)));


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Users</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        
        <script src="popup.js" type="text/jscript" language="javascript"> </script>
        
        
<script>
function confirm_close(cust,trackid,callid)
{

if(confirm("Ensure Material is delivered at site."),confirm("Ensure Site is ready for Installation."))
  {
    
        document.location="ware_add_site.php?cust="+cust+"&id="+trackid+"&callid="+callid+'&frmpg=1';
  }
  
}

        </script>
        
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
        #menu-bar ul{
    z-index: 999;
}

            body {
    background-color: #4D9494;
    margin-top: 10px;
}
        </style>
        </head>
    <body>
    <? if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        } ?>
    
        <div class="search_fields" style="margin: 2% auto;">
            
    <?
    
//Filter 

if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
        }
        else {
            $pageno = 1;
        }

        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        
    
//Filter 

 $statement= "select a.* from so_order a, new_sales_order b where a.po_id=b.so_trackid and b.del_type='ware_del' and b.inst_request=0 and a.status=2  ";

if(isset($_POST['inv_no']) && $_POST['inv_no'] !='' ){
         $statement .=" and a.inv_no='".$_POST['inv_no']."'";  
}

if(isset($_POST['branch_id']) && $_POST['branch_id'] !='' ){
         $statement .=" and a.avo_branch='".$_POST['branch_id']."'";  
}

if(isset($_POST['customer_vertical']) && $_POST['customer_vertical'] !='' ){
    $statement .=" and a.customer_vertical='".$_POST['customer_vertical']."'"; 
}


if(isset($_POST['fromdt']) && $_POST['fromdt'] !='' ){
    $from=$_POST['fromdt'];
    $date1 = str_replace('/', '-', $from);
    $date1 = date('Y-m-d', strtotime($date1));

    $statement .=" and a.inv_date >= '".$date1."'";
    
       }

if(isset($_POST['todt']) && $_POST['todt'] !='' ){
    $todt=$_POST['fromdt'];
    $date2 = str_replace('/', '-', $todt);
    $date2 = date('Y-m-d', strtotime($date1));

    $statement .=" and a.inv_date >= '".$date2."'";
    
       }

   
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count=mysqli_query($con1,$statement);
    $total_rows= mysqli_num_rows($count);
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
    $statement .=" order by a.id desc LIMIT $offset, $no_of_records_per_page";
    

?>

                    <div class="form-row">
                        <div class="col-xs-12">
                            
                            <form action="view_ware_noninstall.php" class="form-inline" method="POST">
                            
                         
                            
                            <div class="form-group mb-2">
                                <label for="staticEmail2" class="sr-only">ATM ID</label>
                                <input type="text" class="form-control" id="inv_no" name="inv_no" value="<? echo $_POST['inv_no'];?>" placeholder="Invoice Number ">
                            </div>
                            
                            
                            
                            
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="custer_vertical" class="sr-only">Customer Vertical</label>
                             <select id="po_custid" class="form-control" name="customer_vertical">
                                        
                                         
                                    <option value="">Select Customer Vertical</option>
                                    <?php
                                    $customer_qry = mysqli_query($con1,"select * from customer");
                                        while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                                            <option value= "<?php echo $customer_vertical['cust_id']; ?>" <? if($_POST['customer_vertical']==$customer_vertical['cust_id']){ echo 'selected'; } ?> >
                                                 <?php echo $customer_vertical["cust_name"];?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            
                            
                            
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="branch_id" class="sr-only">Branch</label>

                             <select id="branch_id" class="form-control" name="avo_branch">
                                        
                                         
                                    <option value="">Select Branch</option>
                                    
                                    <? $branch_sql = mysqli_query($con1,"select * from avo_branch");
                                    
                                        while ($branch_sql_result = mysqli_fetch_assoc($branch_sql)) { ?>
                                            <option value= "<?php echo $branch_sql_result['id']; ?>" <? if($_POST['avo_branch']==$branch_sql_result['id']){ echo 'selected'; }
                                            ?>>
                                            
                                                 <?php echo $branch_sql_result["name"];?>
                                            
                                            </option>
                                        <?php } ?>


                                    </select>
                            </div>
                            
                          <select name="status" class="filter form-control">
                              
                                <option value="">Select Status</option>
                                <option value="1">Pending</option>
                                <option value="c">Cancel</option>
                                <option value="h">Hold</option>
                                <option value="2">Close</option>
                            </select>
                            
                            
                            <input type="text" name="fromdt" value="<? echo $_POST['fromdt'];?>" id="fromdt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date">
                            
                            <input type="text" name="todt" value="<? echo $_POST['todt'];?>" id="todt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date">
                            
                            <input class="btn btn-success" type="submit" name="search" value="Search">
                            
                            </form>
                    
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    
                    
                </div>
    

    <br>
    <br>
    <br>

    
    
    <h4 style="color:white;text-align:center;">Ware House Non-Install sites</h4>
    
    
    <div class="container-fluid">
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:3px;" class="table table-striped table-bordered" id="custtable">
<body><tr>

<th>S.N.</th> 
<th>Invoice No</th> 
<th>Invoice Date</th>
<th>Vertical Customer</th>
<th>End User Name</th>


<th>Address</th>
<th>Branch</th>
<th>Site/Sol/ATM ID</th>
<th>Credit Note No</th> 
<!--<th>Credit Note Date</th> -->


<!--<th>Credit Note Amount</th> -->
<th>Courier</th>
<th>Docket No.</th>
<th>Estimated Delivery Date</th>
<th>Dispatch Date</th>

<th>Delivery Date</th>
<!--<th>Update Delivery</th>
<th>Invoice Copy</th>
<th>Credit Note Copy</th>  -->
<th>View Added site Details</th>

<th>Generate Calls</th>

</tr>

<?
        $prepared_sql = mysqli_query($con1,$statement);

while($prepared_sql_result = mysqli_fetch_assoc($prepared_sql)){ 

           $id = $prepared_sql_result['po_id'];
           $order_id = $prepared_sql_result['id'];
       ?>
<tr>
    
<td  valign="top"><?php echo ++$i; ?></td>
<td  name="inv_no" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_no']; ?></td>
<td  name="inv_date" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_date']; ?></td>
<td  name="customer" valign="top">&nbsp;<?php echo get_cust($id); ?></td> 
<td  name="bank" valign="top">&nbsp;<?php echo get_atm('bank_name',$id); ?></td>
<td  name="address" valign="top">&nbsp; <?php echo get_atm('address',$id); ?></td>


<td  name="branch" valign="top">&nbsp;<?php echo get_branch($id); ?></td>  
<td  name="atm_id" valign="top">&nbsp;<?php echo get_atm('atm_id',$id); ?></td> 
<td  name="crn_no" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_no']; ?></td> 

<!--<td  name="crn_date" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_date']; ?></td> 
<td  name="crn_amount" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_amount']; ?></td> -->


<td  name="" valign="top">&nbsp;<?php echo $prepared_sql_result['courier']; ?></td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['docketno']; ?></td>   
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['est_date']; ?></td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['dis_date']; ?></td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['del_date']; ?></td>


<td><a style="color:black;" style="margin:5px;"class="btn btn-success" href="javascript:void(0);" onclick="window.open('view_ware_generated.php?id=<?php echo $prepared_sql_result['po_id'] ?>','view',400,400)"><font color="white" > View Generared</font></a></td>


 <td>
     <?
     if($prepared_sql_result['status'] =='2'){
     ?>
         <? if($prepared_sql_result['del_date']!='0000-00-00'){ 
                
                   $del_type = get_new_sales_order_data('del_type',$prepared_sql_result['po_id']);
                   $inst_request=  get_new_sales_order_data('inst_request',$prepared_sql_result['po_id']); ?>
                   
                        
        <?  if(is_so_complete($id)==1){ ?>
           
           <a class="btn btn-danger" href="javascript:confirm_close('<?php echo get_atm('cust_id',$id); ?>','<?php echo $id; ?>','<?php echo get_atm('track_id',$id); ?>')" style="color:white;">Generate Call</a>
        
        <? } else{
                    echo 'Call Genarated ! Quantity Finished ..';
                }
                ?>

                  
                  
                   
          
         
    
        <? } }
        
        else{

        }
        
        ?>
     
 </td>
 





    
    
</tr>           
      

                  <? }  ?> 
       <!--End While Loop-->
       
</table>            


    
</div>
       
       <div class="pagiation_div" style="display:flex; justify-content:center;">
    

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
    </body>
</html>