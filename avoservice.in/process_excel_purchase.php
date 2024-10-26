<?php
include('config.php');


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


function get_customer_address($id){
    
    
    $sql = mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    return $sql_result['buyer_address'];
}

function get_gst($id){
    
    
    $sql = mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    return $sql_result['buyer_gst'];
}


function get_asset_name($id){
    
    $sql = mysqli_query($con1,"select * from assets where assets_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['assets_name'];
}



function get_cust_vertical_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_name = $sql_result['cust_name'];
    
    return $cust_name;
}

function get_cust_vertical_id($name){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_name like '".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_id = $sql_result['cust_id'];
    
    return $cust_id;
}




function get_buyername($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $buyer_name = $sql_result['buyer_name'];
    
    return $buyer_name;   
}

function get_buyerid($name){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_name like '".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $buyer_id = $sql_result['buyer_ID'];
    
    return $buyer_id;   
}



function get_sales_team($parameter,$name){
    

    global $con2;

    $sql = mysqli_query($con2,"select $parameter from salesteam where exe_name  like '".$name."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;   
}


function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}

function get_branch_id($name){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where name like '".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $id = $sql_result['id'];
    
    return $id;
}

function get_buyerinfo($parameter,$id){
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from buyer where buyer_ID ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];
}




function get_asset_id($name){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets where assets_name like '".$name."'");
    $sql_result= mysqli_fetch_assoc($sql);
    
    return $sql_result['assets_id'];
}


function get_asset_spec_id($asset_id ,$model){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets_specification where assets_id = '".$asset_id."' and name like '".$model."'");
    $sql_result= mysqli_fetch_assoc($sql);
    
    return $sql_result['ass_spc_id'];
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
    

    
    
    $error = '0';
$contents='';
 $contents.="Sr no \t Customer Vertical \t Customer Vertical ID \t PO Number \t PO ID  \t Buyer Name \t Buyer Address \t GST \t Sales Executive \t PO Raised By \t TAT \t Branch \t Delivery Type \t Payment \t Remarks \t Date \t Success\t  Message \t";





    
    for($i = 1; $i<=$row; $i++){
        
        $po_no = $rowData[$i][0][0];
        $po_date = $rowData[$i][0][1];

        $customer_vertical  = $rowData[$i][0][2];
        $customer_vertical = get_cust_vertical_id($customer_vertical);
        
        
        $buyer_id  = $rowData[$i][0][3];
        $buyer_id = get_buyerid($buyer_id);
        
        $branch  = $rowData[$i][0][4];
        $branch = get_branch_id($branch);

        $sales_exe_name  = $rowData[$i][0][5];
        $modeOfSale  = $rowData[$i][0][6];
        $tat  = $rowData[$i][0][7];
        $payment_term  = $rowData[$i][0][8];
        $add_info  = $rowData[$i][0][9];
        $product  = $rowData[$i][0][10];
        $remarks =  $rowData[$i][0][11];
        $delivery_type  = $rowData[$i][0][12];
        $other_charges  = $rowData[$i][0][13];
        $non_std_product  = $rowData[$i][0][14];
        $userid = $rowData[$i][0][15];
        $raiseby = $rowData[$i][0][16];
        $no_of_sites = $rowData[$i][0][17];
        
        if($no_of_sites){
            $sites= $no_of_sites ;
        } else{
            $sites = 0;
        }
        
        
        $check_po= mysqli_query($con1,"select * from purchase_order where po_no = '".$po_no."'");
        if($check_po_result = mysqli_fetch_assoc($check_po)){
            
            $error .= 'Purchase order exists, ';
        }

        
        $check_cv= mysqli_query($con1,"select * from customer where cust_id = '".$customer_vertical."'");
            $check_cv_result = mysqli_fetch_assoc($check_cv);
            if(!$check_cv_result){
                        $error .= 'Customer Vertical Not Exist , ';    
            }
                        
        
        

        $check_buyer= mysqli_query($con1,"select * from buyer where buyer_ID = '".$buyer_id."'");
        $check_buyer_result = mysqli_fetch_assoc($check_buyer);
        
        if(!$check_buyer_result){
            $error .= 'Buyer Not Exist , ';            
        }
        

        $check_branch= mysqli_query($con1,"select * from avo_branch where id = '".$branch."'");
        $check_branch_result = mysqli_fetch_assoc($check_branch);
        if(!$check_branch_result){
            $error .= 'Branch Not Exist , ';            
        }
        

        $check_sales= mysqli_query($con2, "select * from salesteam where exe_name  like '".$sales_exe_name."'");
        $check_sales_result = mysqli_fetch_assoc($check_sales);
        if(!$check_sales_result){
            $error .= 'sales executive Not Exist , ';            
        }
        
        
        
        $product_ar = explode(',', $product);
        $product_count = count($product_ar);
        


    // check
    
    for($j = 0 ; $j < $product_count; $j++){
        
            for($num = 5; $num <=$product_count; $num=$num*2){


                if($j==0 || $j==$num){
                
                    $product_name = $product_ar[$j];
                    $product_id = get_asset_id($product_name);
                    
                    $model = $product_ar[$j+1];
                
                $check_asset_sql= mysqli_query($con1,"select * from assets_specification where assets_id='".$product_id."' and name like '".$model."'");
                
                if($check_asset_sql = mysqli_fetch_assoc($check_asset_sql)){

                    $quantity = $product_ar[$j+2];
                    $price = $product_ar[$j+3];
                    $warranty = $product_ar[$j+4];
                    
                    // $po_asset_sql_insert =mysqli_query($con1,"insert into  po_assets (po_no,assets_name,qty,warranty,rate,specs,po_trackid) values('".$po_no."','".$product_name."','".$quantity."','".$warranty."','".$price."','".$model."','".$po_trackid."')") ;
                    
                }
                else{
                    $error.='Invalid Product Combo for '.$product_name."\t";
                }
                
                


                }
            
            }
            
        }
        
        
            // check 
        
if($error == '0'){
    


    
$po_sql_insert = mysqli_query($con1,"insert into  purchase_order (po_no,cust_id,buyer_id,po_raiseby,po_mode,po_tat,po_payment,salesperson,po_remarks,po_status,del_type,other_charge,non_standard_item_product,buyeraddress,gst,po_time,po_date,branch_id,created_by,no_sites)  values('".$po_no."','".$customer_vertical."','".$buyer_id."','".$raiseby."','".$modeOfSale."','".$tat."','".$payment_term."','".$sales_exe_name."','".$remarks."','1','".$delivery_type."','".$other_charges."','".$non_std_product."','".get_customer_address($buyer_id)."','".get_gst($buyer_id)."','".$date."','".$only_date."','".$branch."','".$userid."','".$sites."')");

$po_trackid = mysqli_insert_id();  

$table=mysqli_query($con1,"select * from purchase_order where po_no='".$po_no."'");




if($sql_result = mysqli_fetch_assoc($table)){
    
    
            $cust_id = $sql_result['cust_id'];
            $po_id = $sql_result['id'];
    
    
            $contents.="\n".$i."\t";
            $contents.= get_cust_vertical_name($cust_id)."\t";
            $contents.= $cust_id."\t";
            $contents.= $sql_result['po_no']."\t";
            $contents.= $po_trackid."\t";
            $contents.= get_buyername($sql_result['buyer_id'])."\t";
            $contents.= $sql_result['buyeraddress']."\t";
            $contents.= $sql_result['gst']."\t";
            $contents.= get_sales_team('exe_name',$sql_result['salesperson'])."\t";
            $contents.= $sql_result['po_raiseby']."\t";
            $contents.= $sql_result['po_tat']."\t";
            $contents.= get_branch_name($sql_result['branch_id'])."\t";
            $contents.= $delivery_type."\t";
            $contents.= $sql_result['po_payment']."\t";
            $contents.= $sql_result['po_remarks']."\t";
            $contents.= $sql_result['po_time']."\t";

            
            if($po_trackid >0 ){
                $contents.= 'Yes'."\t";
            }
            else{
                $contents.= 'No'."\t";
            }
            $contents.= $error."\t";
    

}

for($j = 0 ; $j < $product_count; $j++){
        
            for($num = 5; $num <=$product_count; $num=$num*2){


                if($j==0 || $j==$num){
                
                    $product_name = $product_ar[$j];
                    $product_id = get_asset_id($product_name);
                    
                    $model = $product_ar[$j+1];
                
                $check_asset_sql= mysqli_query($con1,"select * from assets_specification where assets_id='".$product_id."' and name like '".$model."'");
                
                if($check_asset_sql = mysqli_fetch_assoc($check_asset_sql)){

                    $quantity = $product_ar[$j+2];
                    $price = $product_ar[$j+3];
                    $warranty = $product_ar[$j+4];
                    
                    $model = get_asset_spec_id($product_id ,$model);
                    $po_asset_sql_insert =mysqli_query($con1,"insert into  po_assets (po_no,assets_name,qty,warranty,rate,specs,po_trackid) values('".$po_no."','".$product_name."','".$quantity."','".$warranty."','".$price."','".$model."','".$po_trackid."')") ;
                    
                }
                // else{
                //     // $error.='Invalid Product Combo for '.$product_name."\t";
                // }
                
                


                }
            
            }
            
        }
    
    
}
else{
    
    $po_trackid = 0;

            $contents.="\n".$i."\t";
    
            $contents.=get_cust_vertical_name($customer_vertical)."\t";
            $contents.=$customer_vertical."\t";
            
            if(!get_cust_vertical_name($customer_vertical)){
                $error.= 'Invalid Customer vertical'."\t";                
            }

            $contents.= $po_no."\t";
            $contents.= $po_trackid."\t";
                
        if(get_buyername($buyer_id)){
            
            $contents.= get_buyername($buyer_id)."\t";
            
        } else {
             $contents.='No Buyer Found,'."\t";
                $error.='No Buyer Found,'."\t";
            
        }
            
         if(get_buyerinfo('buyer_address',$buyer_id)){
            $contents.= get_buyerinfo('buyer_address',$buyer_id)."\t"; 
         }
         else{
             $contents.='No buyeraddress'."\t";
             $error.='No buyeraddress'."\t";
         }
            
        if(get_gst($buyer_id)){
            $contents.= get_gst($buyer_id)."\t";            
        }
        else{
            $contents.= 'No GST found '."\t";
            $error.= 'No GST found '."\t";
        }
        
            $contents.= $sales_exe_name."\t";

            if(!get_sales_team('exe_name',$sales_exe_name)){
                $error .= 'Not found Sales Person ,'."\t";
            }
            
            $contents.= $raiseby."\t";
            $contents.= $tat."\t";
            
            if(get_branch_name($branch)){
                $contents.= get_branch_name($branch)."\t";                
            }
            else{
                $contents.= 'No Branch found'."\t";
                $error.='No Branch Found'."\t";
            }
            
            $contents.= $delivery_type."\t";
            $contents.= $payment_term."\t";
            $contents.= $remarks."\t";
            $contents.= '----/--/--'."\t";
            $contents.= 'No'."\t";
            $contents.= $error."\t";
    

    }     
    $error = '0';

}

$contents = strip_tags($contents); 




// return;

  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>