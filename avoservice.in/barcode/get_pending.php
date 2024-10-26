<?php
error_reporting(-1);
include("../config.php");

$srno = $_GET['id'];
//$srno=1894;
$result = mysqli_query($con1, "select * from login where srno='".$srno."'");

if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_row($result);
    $str = array();
    if($row[4]==7 && ($row[3] !='' or $row[3] !=0 )) {

$sql1 = mysqli_query($con1, "Select a.po_id, a.inv_no, a.avo_branch, a.customer_vertical, b.po_model, b.po_qty, b.po_product from so_order a, new_sales_order_asset b, new_sales_order c where a.po_id=b.so_trackid and a.po_id=c.so_trackid and a.status=1 and a.call_status=0 and a.avo_branch='".$row[3]."' and b.po_product='UPS' and c.del_type !='stock_trfr'");

        while ($so_det = mysqli_fetch_row($sql1)) {
                $so_id=$so_det[0];
                
                $atmqry = mysqli_query($con1, "select * from demo_atm where so_id='".$so_id."' ");
                $atm = mysqli_fetch_row($atmqry);
 
                $cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$so_det[3]."' ");
                $cust_name = "";
                if (mysqli_num_rows($cl) > 0) {
                    $clro = mysqli_fetch_row($cl);
                    $cust_name = $clro[1];
                }
                $brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$so_det[2]."' ");
                $br_name = "";
                if (mysqli_num_rows($brqry) > 0) {
                    $brro = mysqli_fetch_row($brqry);
                    $br_name = $brro[1];
                }
       
        $assetcount=$so_det[5];
        $model_id=$so_det[4];
        $product=$so_det[6];

    $qry= mysqli_query($con1, "Select count(id) as `count` from so_order_barcode where `so_id`='".$so_id."' and model_id='".$model_id."'" );
        $row=mysqli_fetch_assoc($qry);
        $count=$row['count'];
    
$pendingcount=$assetcount - $count;



$specqry= mysqli_query($con1, "Select name from assets_specification where ass_spc_id='".$model_id."'" );
        $spcrow=mysqli_fetch_row($specqry);
       
$model_name=$spcrow[0];


    $str[] = array('so_id' => $so_id, 'siteid' => htmlspecialchars($atm[1]), 'invno' => htmlspecialchars($so_det[1]), 'branch' => $br_name, 'cust' => $cust_name, 'enduser' => $atm[6], 'address' => htmlspecialchars($atm[11]),'product' => $product,'model_name' => $model_name,'model_id' => $model_id, 'qty' => $assetcount,'pending_count' => $pendingcount );
            }
        
       }
//echo "<pre>";
//print_r($str);
//echo "</pre>";

      $data = ['code'=>200,'data'=>$str];

    } else {
        //====Login failed
        $str = -1;
        $data = ['code'=>201];
    }
    
    echo json_encode($data);
    
/*  **************** Note ********************

There may be  >1 UPS Models in a single so_id. Hence, There maybe 2 rows in the display with same so_id with different model_id.
If Pending_count = 0, Need not enable barcode reader and only enable it where pending is"   */


    