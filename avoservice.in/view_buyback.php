<?php session_start();
include("access.php");
include('functions.php');

 if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }





function get_purchase_order($id){
    
    $sql= mysqli_query($con1,"select * from purchase_order where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    
    return $sql_result['po_no'];
}




        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }


        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;



?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View Buyback</title>
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

        //Filter 



            if(!empty($_GET['atm_id']) || !empty($_GET['branch_id']) || !empty($_GET['po_custid']) || isset($_GET['status']) ){
                
                
                unset($_GET['pageno']);
                $k = $_GET;
                $sliced = array_slice($k, 0, -1);
                
                

                if(isset($sliced)){

                    $i = 0;
                    $string = '';

    
            $statement= "SELECT * FROM new_sales_order,new_buyback WHERE new_sales_order.so_trackid = new_buyback.so_trackid AND new_sales_order.bb_available='1' and  ";

                    
                    foreach($sliced as $key=>$val){
                        
                        if($val){
                            

                            if($key=='fromdt'){ 
                                
                                $date1 = str_replace('/', '-', $val);
                                $date1 = date('Y-m-d', strtotime($date1));

                                $statement .=" so_time >= '".$date1."'";
                                $statement .= " and";
                            }

                            else if($key=='todt'){                 
                                      
                                $date2 = str_replace('/', '-', $val);
                                $date2 = date('Y-m-d', strtotime($date2));
                                $statement .=" so_time <= '".$date2."'";
                                $statement .= " and";
                            }
                            
                            else if($key == 'atm_id'){
                                    
                                     $statement .=" $key LIKE '%".$val."%'";
                                     $statement .= " and";
                            }

                            else{
                                
                                $statement .=" $key='".$val."'";
                                
                                $statement .= " and";

                            }
                            
                        
                                    
                        }
                        
                    }   
                }

    $statement = substr($statement, 0, strlen($statement)-3);
   
    $statement .= " order by created_at desc";
    
   // echo $statement ;
    
    
    
    
    
    $sql =$statement;
    
    $sql = mysqli_query($con1,$sql);
    
    // Counting Rows for pagination
    
    $result = mysqli_query($con1,$statement);
    $total_rows = mysqli_num_rows($result);
    
}


// end Filter


        ?>
<br>

<div class="container-fluid" >
       <div class="form-row">
                        <!--<div class="col-xs-10"> -->
                            
                            <form action="view_buyback.php" class="form-inline" method="GET">
                            
                         
                            
                            <div class="form-group mb-2">
                                <label for="staticEmail2" class="sr-only">ATM ID</label>
                                <input type="text" class="form-control" id="atm_id" name="atm_id" value="<? echo $_GET['atm_id'];?>" placeholder="Site ID">
                            </div>
                            
                            
                            
                            
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="custer_vertical" class="sr-only">Customer Vertical</label>
                             <select id="po_custid" class="form-control" name="po_custid">
                                        
                                         
                                    <option value="">Select Customer Vertical</option>
                                    <?php
                                    $customer_qry = mysqli_query($con1,"select * from customer");
                                        while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                                            <option value= "<?php echo $customer_vertical['cust_id']; ?>" <? if($_GET['po_custid']==$customer_vertical['cust_id']){ echo 'selected'; } ?> >
                                                 <?php echo $customer_vertical["cust_name"];?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            
                            
                            
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="branch_id" class="sr-only">Branch</label>

                             <select id="branch_id" class="form-control" name="branch_id">
                                        
                                         
                                    <option value="">Select Branch</option>
                                    
                                    <? $branch_sql = mysqli_query($con1,"select * from avo_branch");
                                    
                                        while ($branch_sql_result = mysqli_fetch_assoc($branch_sql)) { ?>
                                            <option value= "<?php echo $branch_sql_result['id']; ?>" <? if($_GET['branch_id']==$branch_sql_result['id']){ echo 'selected'; }
                                            ?>>
                                            
                                                 <?php echo $branch_sql_result["name"];?>
                                            
                                            </option>
                                        <?php } ?>


                                    </select>
                            </div>
                            
                        
                            <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="fromdt" value="<? echo $_GET['fromdt'];?>" id="fromdt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date">
                            
                            <input type="text" name="todt" value="<? echo $_GET['todt'];?>" id="todt" class="form-control" value="" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date">
                            
                            <input class="btn btn-success" type="submit"  value="Search">
                            
                            </form>
                    
                        </div>
                    </div>
</div>    




<?




$url = $_SERVER['REQUEST_URI'];



$parameters = str_replace("/view_buyback.php?","",$url);


$parameters = str_replace("&search=Search","",$parameters);

$parameters = str_replace("pageno=","",$parameters);






?>





<div class="container"style="margin: 0% 0%;">
    
    
   
    <h4 style="display:flex;justify-content:center;">Buyback</h4>
    <table id="example" class=" table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <!-- <th width="5%">PO No</th> -->
                <th width="5%">Customer Vertical</th>
                <th width="5%">Invoice No.</th>
                <th width="5%">Branch</th>
                 <th width="5%">Site/Sol/ATM Id</th>
                 <th width="5%">End User Name</th>
                  <th width="5%">City</th>
                   <th width="5%">Address</th>
                <th width="5%">SO Date/time</th>
                <th width="5%">Buyback Product</th>
                <th width="5%">Capacity</th>
                <th width="5%">Qty</th>
                <th width="5%">Value</th>
                <th width="5%">Date</th>       
                <th width="10%">Is Collected</th>
                <th width="10%">Collected Remarks </th>
                <th width="5%">Submit</th>
            </tr>
        </thead>
        <tbody>
            <?
            
            if($statement){
                
                $count_sql = str_replace("*","count(*) as count_number",$statement);
                
                $total_rows = mysqli_query($con1,$count_sql);
                
                $if_account = mysqli_fetch_assoc($total_rows);
                $total_rows = $if_account['count_number'];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                
                $sql = mysqli_query($con1,$statement." LIMIT $offset, $no_of_records_per_page");
    
            }
            else{            
                
                $count_sql = "SELECT count(*) as count_number FROM new_sales_order,new_buyback WHERE new_sales_order.so_trackid = new_buyback.so_trackid AND new_sales_order.bb_available='1' order by new_buyback.so_trackid desc";
                $total_rows = mysqli_query($con1,$count_sql);
                $if_account = mysqli_fetch_assoc($total_rows);
                $total_rows = $if_account['count_number'];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $sql = mysqli_query($con1,"SELECT * FROM new_sales_order,new_buyback WHERE new_sales_order.so_trackid = new_buyback.so_trackid AND new_sales_order.bb_available='1' order by new_buyback.so_trackid desc LIMIT $offset, $no_of_records_per_page");
                
            }
                
               
       
       ?>
       <h4 style="color:white;text-align:center;">Total <? echo $total_rows;?> Records..</h4>
                
                
                
              <?  
                while($sql_result = mysqli_fetch_assoc($sql)){
                    
                    $id = $sql_result['track_id'];
                    $po_trackid = $sql_result['po_trackid'];
                    $buyback_collected = $sql_result['is_collected'];
                    $buyback_date = $sql_result['buyback_date'];
                    $remark = $sql_result['remark'];
                    
                    $so_id = $sql_result['so_trackid'];
                    $atm= mysqli_query($con1,"SELECT * FROM demo_atm WHERE so_id='".$so_id."'");
                    $atmrow=mysqli_fetch_assoc($atm);
                    $inv= mysqli_query($con1,"SELECT inv_no, inv_date FROM so_order WHERE po_id='".$so_id."'");
                    $inv_no=mysqli_fetch_row($inv);
                    
                    
            ?>
            <tr>
                <!--<td width="5%"><? echo get_purchase_order($po_trackid); ?></td> -->
                <td width="5%"><? echo get_cust_vertical_name($sql_result['po_custid']);?></td>
                <td width="5%"><? echo $inv_no[0];?></td>
                <td width="5%"><? echo get_branch_name($sql_result['branch_id']);?></td>
                <td width="5%"><? echo $sql_result['atm_id'];?></td>
                <td width="5%"><? echo $atmrow['bank_name'];?></td>
                <td width="5%"><? echo $atmrow['city'];?></td>
                <td width="5%"><? echo $atmrow['address'];?></td>
                <td width="5%"><? echo $sql_result['created_at'];?></td>
                <td width="5%"><? echo $sql_result['bb_Product'];?></td>
                <td width="5%"><? echo $sql_result['bb_cap'];?></td>
                <td width="5%"><? echo $sql_result['bb_qty'];?></td>
                <td width="5%"><? echo $sql_result['bb_value'];?></td>
                
                <form method="post" action="update_buyback_case.php">
                <td id="date_select">
                    
                    
                    <input type="text" name="sub<?php echo $id; ?>" id="sub"  onclick="displayDatePicker('sub<?php echo $id; ?>');" value="<? echo $buyback_date; ?>"  />
                    
                    
                </td>       
                
                <td id="<?= 'collect'.$id?>">
                    
                    <select name="is_buyback_collected" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <? if($buyback_collected=='1'){ echo 'selected'; }?> >Yes</option>
                        <option value="0" <? if($buyback_collected=='0'){ echo 'selected'; }?> >No</option>
                    </select>
                </td>        
                
                <td id="remark">
                    
                     <input type="text" name="remark" id="remark"  value="<? echo $remark; ?>"  />
                </td>
                
                
                <td>
                    <input type="submit" value="submit" class="btn btn-primary">
                </td>
                </form>

            </tr>    
            <? } ?>
            
        </tbody>
        </table>
    </div>
    
    
        
</div>
       
       <div class="pagiation_div" style="display:flex; justify-content:center;">
    

       <ul class="pagination">
    <li><a href="?pageno=1&<? echo $parameters;?>">First</a></li>
    
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        
        <a href="<?php 
        if($pageno <= 1){
        echo '#'; 
        } else {
        echo "?pageno=".($pageno - 1).'&'. $parameters; 
        } ?>">
            
            Prev</a>
    
    
    </li>
    
    
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1).'&'. "$parameters"; } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>&<? echo $parameters;?>">Last</a></li>
</ul>

</div>
        
    </body>
    
    
    <script>
        $(document).ready(function(){
           
           
           
           $("#sup").on("changeDate", function(e) {
   console.log("Date changed:");
});
           
           
           
        });
    </script>
    
<div style="display:flex:justify-content:center">
    
     <form name="frm" method="post" action="export_newbuyback.php" target="_new" style="text-align: center;">
    <input type="hidden" name="qr" value="<?php echo $statement; ?>" readonly>    
    <input type="submit" name="cmdsub" value="Export" > <span>(Export MAX 860 Records)</span>
    </form>
    

</div>
    
    </html>