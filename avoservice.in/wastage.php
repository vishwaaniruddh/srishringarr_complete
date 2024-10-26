
    
    
    
    
            
    // po consumption starts
    
    
    $po_consume = $rowData[$i][0][18];

    $po_consume = explode(',', $po_consume);
    $po_consume_count = count($po_consume);
        
        
     for($p = 0 ; $p < $po_consume_count; $p++){
        
        
            for($num = 1; $num <=$po_consume_count; $num++){
      
                
              if($p==0 || $p==$num){
                  
                $product_name = $product_ar[$p];
                $model = $product_ar[$p+1];
                $quantity = $product_ar[$p+2];
                
                $model_id = get_model_id($model);
                // echo '$product_name'.$product_name;
                 
                 $po_product = get_assetid($po_id,$product_name,$model_id);

                $po_cons_sql = "insert into po_consumption(po_trackid,so_trackid,po_product,po_model,po_qty,po_consumqty,po_status) values('".$po_id."','".$so_trackid."','".$po_product."','".$model."','".$quantity."','".$po_consume[$p]."','1')";
                
                echo $po_cons_sql;
                echo '<br>';
                  
              }    
        }
    }
      
             
             
    // po consumption end
        
        
        
        
    if(!$po_qty){
        
        
        foreach($select as $key => $value){
            
            
    
            $sql = mysqli_query($con1,"select * from po_assets where assettrack_id='".$value."'");
            
            $sql_result = mysqli_fetch_assoc($sql);
            
            $po_qty[]=$sql_result['qty'];
       
        }
        
    }
    
    
$date = date('Y-m-d H:i:s');




if($same_customer=='on'){
    
    $buyerid  = $_POST['buyerid'];
    
    $avo_branch = get_branch($buyerid);

    $state_id = get_buyer_state($buyerid);
    
    $state_name = get_state_name($state_id);
    
}
else{
$state_name = get_state_name($state);    
}


if(is_atm_exist($site_id) == true){
    
    $avo_branch = get_atm_data('branch_id',$site_id);
    
    $state_name = get_atm_data('state1',$site_id);
    
}


if($po_id){

    $sales_sql="insert into new_sales_order(po_trackid,DO_no,po_custid,buyerid,so_by,atm_id,inst_request,user_cont_name,user_cont_phone,user_mail,bb_available,status,do_date,del_type,branch_id) VALUES('".$po_id."','".$DO_no."','".$custid."','".$buyerid."','".$so_by."','".$atmid."','".$inst_request."','".$contact_person_name."','".$contact_person_mobile."','".$email_to."','".$buyback."','1','".$date."','".$del_type."','".$avo_branch."')";
    
    mysqli_query($con1,$sales_sql);
    
    $so_trackid = mysqli_insert_id();





// SalesOrderAssets Table

$i = 0;
foreach($select as $key=>$val){
    

        
    
    $sql=mysqli_query($con1,"select * from po_assets where assettrack_id = '".$val."'");
    $sql_result=mysqli_fetch_assoc($sql);
    
    $asset_name  = $sql_result['assets_name'];
    $po_capacity = $sql_result['po_capacity'];
    $po_model    = $sql_result['po_model'];
    $po_specification = $sql_result['specs'];
    $po_validity = $sql_result['warranty'];
    $po_rate     = $sql_result['rate'];
    
        
    


    $sales_order_sql = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_cap,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$asset_name."','".$po_specification."','".$po_capacity."','".$po_qty[$i]."','".$po_validity."','".$po_rate."')";
    
    
    
    mysqli_query($con1,$sales_order_sql);
    $i++;

    }
    
    // End SalesOrderAssets Table
    
    
    // start buyback table
    
    
    $is_buyback = $_POST['buyback'];
    $buyback_product = $_POST['buyback_product'];
    $buyback_cap = $_POST['buyback_cap'];
    $buyback_qty = $_POST['buyback_qty'];
    $buyback_value = $_POST['buyback_value'];
    
    
    if($is_buyback=='1' || $is_buyback==1){
        
        $buyback_sql ="insert into new_buyback(so_trackid,bb_available,bb_Product,bb_cap,bb_qty,bb_value) values('".$so_trackid."','Yes','".$buyback_product."','".$buyback_cap."','".$buyback_qty."','".$buyback_value."')";
        
        mysqli_query($con1,$buyback_sql);
            
    }
    
    // end buyback table

    // start po_consumption
    
    $j = 0; 
    foreach($select as $key=>$val){
    
            $po_product = $val;
            
            $check_sql= mysqli_query($con1,"select * from po_consumption where po_trackid='".$po_id."' and po_product='".$po_product."'");
            
        
            $check_sql_result= mysqli_fetch_assoc($check_sql);
            
            
            $total_qty = $check_sql_result['po_qty'];
                    
                $prev_consume_qty = $check_sql_result['po_consumqty'];
                $new_consume_qty = $prev_consume_qty + $po_qty[$j];
            
            if($check_sql_result){
                
                if($total_qty >= $new_consume_qty){
        
                    
                    
            
                    mysqli_query($con1,"update po_consumption set po_consumqty='".$new_consume_qty."' where po_trackid='".$po_id."' and po_product='".$val."'");
                }
                else{
                    
                    echo '<script>
                    alert("selected PO quantity is higher than expected !! ");
                    </script>';
        
                }
        
                  
                    
            }
        else{
            
            
            $sql=mysqli_query($con1,"select * from po_assets where assettrack_id = '".$val."'");
            $sql_result=mysqli_fetch_assoc($sql);
            
        
            $asset_name  = $sql_result['assets_name'];
            $po_cap      = $sql_result['po_capacity'];
            $po_model    = $sql_result['specs'];
            $po_validity = $sql_result['warranty'];
            $po_rate     = $sql_result['rate'];
            $po_quantity = $sql_result['qty'];
            
            
            if($po_quantity == $po_qty[$j]){
            $po_status = '0';
            }
            else{
                    $po_status = '1';
            }
            
        
            
             $consumption_sql = "insert into po_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status) values('".$po_id."','".$so_trackid."','".$po_product."','".$po_model."','".$po_cap."','".$po_quantity."','".$po_qty[$j]."','".$po_status."')";
            
            mysqli_query($con1,$consumption_sql);
            // echo $consumption_sql;
        
           
        }
        
          if($total_qty == $new_consume_qty){
                        
                        mysqli_query($con1,"update po_consumption set po_status='0' where po_trackid='".$po_id."' and po_product='".$val."'");
            
                    }
             $j++;
}


// end po_consumption

$atm_insert = $_POST['insert_site'];
    
    $purchase_sql=mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
    
    $purchase_sql_result = mysqli_fetch_assoc($purchase_sql);
    
    $po_date = $purchase_sql_result['po_date'];
    
    $atm_sql = "insert into demo_atm(atm_id, cust_id, so_id,so_date,po_trackid,bank_name, area, pincode, city, branch_id,  address, DO_no, state, pending_status) values('".$atmid."', '".$custid."', '".$so_trackid."','".$date."','".$po_id."','".$consignee_name."', '".$area."', '".$pincode."', '".$city."', '".$avo_branch."', '".$address."', '".$DO_no."' , '".$state_name."', '1')";
    
    mysqli_query($con1,$atm_sql);
    
}

?>













<?php session_start();
include("access.php");

include('config.php');
?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bulk Upload Sales Order </title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    
    
       <style>
      
   #custome_buyer_information,#buyer_information{
       color: white;
    text-align: left;
   }
   
   #buyer_information label,#custome_buyer_information label{
       width:30%;
   }
  #buyer_information span, #custome_buyer_information span{
       width:70%;
   }
   .add_heading{
       color:white;
   }
   .custom_inside_row{
       width:47%;
       display: flex;
    height: fit-content;
   }
   
   .custom_inside_row .span_label{
       width:98%;
       
   }
   html[xmlns] #menu-bar {
    display: block;
    z-index: 100000;
    position: relative;
}

   #header, #form1 table{
       width:80%;
   }
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
 
             .select-editable {
     position:relative;
     background-color:white;
     border:solid grey 1px;
     width:120px;
     height:18px;
 }
 .select-editable select {
     position:absolute;
     top:0px;
     left:0px;
     font-size:14px;
     border:none;
     width:120px;
     margin:0;
 }
 .select-editable input {
     position:absolute;
     top:0px;
     left:0px;
     width:100px;
     padding:1px;
     font-size:12px;
     border:none;
 }
 .select-editable select:focus, .select-editable input:focus {
     outline:none;
 }
 
.bd-example {
    position: relative;
    padding: 5rem;
    margin: 2rem -15px 0;
    border: none;
    border-width: 0;
}
form{
    margin:2%;
    display:flex;
    justify-content:center;
}
.cust_file{
    color: white;
    background-color: #4d9494;
        width: 50%;
}

        </style>
    </head>
    <body>
        <?
        
        include("menubar.php");   ?>
        
        <br>
        <br>
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="file" name="images" class="form-control cust_file">
          <input type="submit" value="upload" class="btn btn-danger">
        </form>
        
    </body>
</html>


<?php

function get_model_id($name){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets_specification where name like '".trim($name)."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['ass_spc_id'];
}


function get_state_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from state where state_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $state_name = $sql_result['state'];
    
    return $state_name;
}


function get_buyer_state($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $state = $sql_result['buyer_state'];
    
    return $state;
}


function get_branch($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch = $sql_result['avo_branch'];
    
    return $branch;
}


function is_atm_exist($name){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from atm where atm_id='".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    if($sql_result){
        
        return true;
        
    }
    else{
        return false;
    }
    

}


function get_atm_data($parameter, $id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from atm where atm_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

function get_assetid($po,$asset,$model){
    
    
    $sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po."' and assets_name like '".trim($asset)."' and specs = '".$model."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['assettrack_id'];
}

$date = date('Y-m-d h:i:s a', time());

$only_date = date('Y-m-d');



$target_dir = 'PHPExcel/';

    $file_name=$_FILES["images"]["name"];
    
    $file_tmp=$_FILES["images"]["tmp_name"];
    
    
    
    $file =  $target_dir.'/'.$file_name;

    move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"],$target_dir.'/'.$file_name);
    


  //Had to change this path to point to IOFactory.php.
  //Do not change the contents of the PHPExcel-1.8 folder at all.
  include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

  //Use whatever path to an Excel file you need.
  $inputFileName = $file;

  try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
  } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
        $e->getMessage());
  }

  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  for ($row = 1; $row <= $highestRow; $row++) { 
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                                    null, true, false);
                                
  }
  


    $row = $row-2;
    
    for($i = 1; $i<=$row; $i++){
        
        $po_id = $rowData[$i][0][0];
        $DO_no = $rowData[$i][0][1];
        $custid  = $rowData[$i][0][2];
        $buyerid  = $rowData[$i][0][3];
        $so_by  = $rowData[$i][0][4];
        $atmid  = $rowData[$i][0][5];
        $inst_request  = $rowData[$i][0][6];
        $contact_person_name  = $rowData[$i][0][7];
        $contact_person_mobile  = $rowData[$i][0][8];
        $email_to = $rowData[$i][0][9];
        $buyback  = $rowData[$i][0][10];
        $del_type  = $rowData[$i][0][11];
        $avo_branch =  $rowData[$i][0][12];
        $product  = $rowData[$i][0][13];
        
        
        $sales_sql="insert into new_sales_order(po_trackid,DO_no,po_custid,buyerid,so_by,atm_id,inst_request,user_cont_name,user_cont_phone,user_mail,bb_available,status,do_date,del_type,branch_id) VALUES('".$po_id."','".$DO_no."','".$custid."','".$buyerid."','".$so_by."','".$atmid."','".$inst_request."','".$contact_person_name."','".$contact_person_mobile."','".$email_to."','".$buyback."','1','".$date."','".$del_type."','".$avo_branch."')";
    
        
        mysqli_query($con1,$sales_sql);
        $so_trackid = mysqli_insert_id();
        $so_trackid = '1221';

        $product_ar = explode(',', $product);
        $product_count = count($product_ar);
        
        for($j = 0 ; $j < $product_count; $j++){
        
            for($num = 3; $num <=$product_count; $num=$num*2){


                if($j==0 || $j==$num){
                
                    $product_name = $product_ar[$j];
                    $model = $product_ar[$j+1];
                    $quantity = $product_ar[$j+2];
                    
                    $spec = get_model_id($model);
                    
                    $po_asset_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."' and assets_name like '".trim($product_name)."' and specs like '".trim($spec)."'");
                    
                    $po_asset_sql_result = mysqli_fetch_assoc($po_asset_sql);
                    $po_validity = $po_asset_sql_result['warranty'];
                    $po_rate = $po_asset_sql_result['rate'];



                $sales_order_sql = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$product_name."','".$spec."','".$quantity."','".$po_validity."','".$po_rate."')";
                
                
                mysqli_query($con1,$sales_order_sql); 
                
                 

                }
            
            }
            
        }
        
        
        // buyback starts
        
        $buyback_product = $rowData[$i][0][14];
        $buyback_cap = $rowData[$i][0][15];
        $buyback_qty = $rowData[$i][0][16];
        $buyback_value = $rowData[$i][0][17];
        
        
     if($buyback=='1' || $buyback==1){
        
        $buyback_sql ="insert into new_buyback(so_trackid,bb_available,bb_Product,bb_cap,bb_qty,bb_value) values('".$so_trackid."','Yes','".$buyback_product."','".$buyback_cap."','".$buyback_qty."','".$buyback_value."')";
        
        mysqli_query($con1,$buyback_sql);
            
    }
    
    // end Buyback
        
    // Demo_atm insert
    
    $consignee_name = $rowData[$i][0][18];
    $area = $rowData[$i][0][19];
    $pincode = $rowData[$i][0][20];
    $city = $rowData[$i][0][21];
    $address = $rowData[$i][0][22];
    $state_name = $rowData[$i][0][23]; 
    
      $atm_sql = "insert into demo_atm(atm_id, cust_id, so_id,so_date,po_trackid,bank_name, area, pincode, city, branch_id,  address, DO_no, state, pending_status) values('".$atmid."', '".$custid."', '".$so_trackid."','".$date."','".$po_id."','".$consignee_name."', '".$area."', '".$pincode."', '".$city."', '".$avo_branch."', '".$address."', '".$DO_no."' , '".$state_name."', '1')";
      
      $atm_sql_insert = mysqli_query($con1,$atm_sql);
      
    //  End demo atm insert
        


    }
    

if($_FILES['images']){
    
    if($atm_sql_insert=='1' || $atm_sql_insert==1){ ?>
  
      <script>
          alert('Upload Successfully !');
      </script>
    
    <? } } ?>

?>