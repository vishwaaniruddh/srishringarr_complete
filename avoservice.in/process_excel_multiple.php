<?php include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


function po_data($parameter,$po_id){
    global $con1;
    $sql = mysqli_query($con1,"select $parameter from purchase_order where id='".$po_id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

function get_assetTrackid($po){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po."'");
    
    while($sql_result = mysqli_fetch_assoc($sql)){
        
        $assetTrackid[] = $sql_result['assettrack_id'];
        
    }
    
    return $assetTrackid;
}


function get_product_specs($parameter, $so_assetid){
    global $con1;
    $sql = mysqli_query($con1,"select $parameter from new_sales_order_asset where so_assetID='".$so_assetid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
} 
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

function get_branch_id($name){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where name like '".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_id = $sql_result['id'];
    
    return $branch_id;
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

function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}

function get_atm_data($parameter, $id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from atm where atm_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

function get_assetid($po,$asset,$model){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po."' and assets_name like '".trim($asset)."' and specs = '".$model."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['assettrack_id'];
}
        
function get_buyername($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $buyer_name = $sql_result['buyer_name'];
    
    return $buyer_name;   
}

function check_po($po_no){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from purchase_order where po_no like '".$po_no."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        return 1;
    }
    else{
        return 0;
    }
    
    
    
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
    $contents.="Sr no \t Customer Vertical \t so_trackid \t PO Number \t PO ID  \t Buyer Name \t ATM ID \t Branch \t Delivery Type \t Installation Request \t   Buyback \t Contact Name \t  Contact Phone \t Contact Email \t Success\t  Message \t";
 
 
 $counter = 1;
    for($i = 1; $i<=$row; $i++){
        
        

        $no_of_sites = $rowData[$i][0][22];
        
        
        $sites = $no_of_sites;

        if($no_of_sites){

        for($site_count = $i;  $site_count <= $sites; $site_count++){
            
            $po_no =  $rowData[$site_count][0][0];
            $po_id = $rowData[$site_count][0][1];
            $custid  = po_data('cust_id',$po_id);
            $buyerid  = po_data('buyer_id',$po_id);
            $so_by  = $rowData[$site_count][0][21];
            $atmid  = $rowData[$site_count][0][2];
            $contact_person_name  = $rowData[$site_count][0][4];
            $inst_request  = strtolower($rowData[$site_count][0][3]);
            $contact_person_mobile  = $rowData[$site_count][0][6];
            $email_to = $rowData[$site_count][0][5];
            $buyback  = strtolower($rowData[$site_count][0][7]);
            $del_type  = strtolower($rowData[$site_count][0][8]);
            $avo_branch =  $rowData[$site_count][0][17];
            $avo_branch = get_branch_id($avo_branch);
            $DO_no = $rowData[$site_count][0][20];
            $buyback_product = $rowData[$site_count][0][9];
            $buyback_cap = $rowData[$site_count][0][10];
            $buyback_qty = $rowData[$site_count][0][11];
            $buyback_value = $rowData[$site_count][0][12];
            $consignee_name = $rowData[$site_count][0][13];
            $area = $rowData[$site_count][0][15];
            $pincode = $rowData[$site_count][0][20];
            $city = $rowData[$site_count][0][14];
            $address = $rowData[$site_count][0][16];
            $state_name = $rowData[$site_count][0][18];        
        
        $check_purchase = mysqli_query($con1,"select * from purchase_order where po_no like '".$po_no."' and id='".$po_id."'");
        
        if($check_purchase_result = mysqli_fetch_assoc($check_purchase)){
           
        //   var_dump($check_purchase_result); 
        }
        else{
            $error.='Purchase Order Number  and Purchase Order ID not match, ';
        }
        

        if($inst_request=='yes'){
            $instrequest = '1';
        }
        else{
            $instrequest = '0';
        }
        

        if(!$contact_person_name){
            $error.='Please specify Contact Person Name, ';
        }
        

        if(!$contact_person_mobile){
            $error.='Please specify Contact Person Mobile, ';
        }
        

        if(!$email_to){
            $error.='Please specify Contact Person Email, ';
        }
        
        

        
        if($buyback=='yes'){
            $buyback = '1';
        }
        else{
            $buyback = '0';
        }
        
        if($buyback > 1){
            $error.='Please Specify Valid Buback Request , ';
        }
        

        
        if(!$avo_branch){
            $error.='Invalid Branch Name';
        }
        



        
        $check_po_sql = mysqli_query($con1,"select * from purchase_order where po_no like '".$po_no."'");
        $check_po_sql_result = mysqli_fetch_assoc($check_po_sql);
        
        if(!$check_po_sql_result){
            $error.='Invalid Purchase Order Number,';
        }
        

        if($del_type !='site_del' && $del_type !='ware_del'){
            $error.='Invalid Delivery Type, ';
        }
        
        if(!$DO_no){
            $error.='Invalid Docket Number, ';
        }
        
    if($error == '0'){
        $sales_sql="insert into new_sales_order(po_trackid,DO_no,po_custid,buyerid,so_by,atm_id,inst_request,user_cont_name,user_cont_phone,user_mail,bb_available,status,do_date,del_type,branch_id) VALUES('".$po_id."','".$DO_no."','".$custid."','".$buyerid."','".$so_by."','".$atmid."','".$inst_request."','".$contact_person_name."','".$contact_person_mobile."','".$email_to."','".$buyback."','1','".$only_date."','".$del_type."','".$avo_branch."')";
    

        mysqli_query($con1,$sales_sql);
        
        
        $so_trackid = mysqli_insert_id();
        // $so_trackid = 001;
        $sales_assets_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."'");
        
        while($sales_assets_sql_result = mysqli_fetch_assoc($sales_assets_sql)){
            
            $assets_name = $sales_assets_sql_result['assets_name'];
            $specs = $sales_assets_sql_result['specs'];
            $qty = $sales_assets_sql_result['qty'];
            $warranty = $sales_assets_sql_result['warranty'];
            $rate = $sales_assets_sql_result['rate'];
            
            
            $sales_asset_insert = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$assets_name."','".$specs."','".intval($qty/$sites)."','".$warranty."','".$rate."')";

// echo $sales_asset_insert;

// echo '<br>';
// echo '<br>';
            mysqli_query($con1,$sales_asset_insert);
            $asset_trackid = mysqli_insert_id();
            $po_product_id[] = mysqli_insert_id();
            
            
    $check_cons = mysqli_query($con,"select * from po_consumption where so_trackid='".$so_trackid."' and po_trackid='".$po_id."'");
    
    if($check_cons_result = mysqli_fetch_assoc($check_cons)){
        
    
    $cons_sql = "update po_consumption set po_qty = '".intval($qty/$sites)."'  where po_trackid='".$po_id."' and so_trackid='".$so_trackid."' and po_product= '".$asset_trackid."'";
    
    ?>
    <script>
        console.log(<? echo $cons_sql; ?>);
    </script> 
    <?
    // mysqli_query($con,$cons_sql);
    // echo $cons_sql;
    
    // echo '<br>';
        
    }
    
    
        }
        
        // buyback starts        
     if($buyback=='1' || $buyback==1){
        
        $buyback_sql ="insert into new_buyback(so_trackid,bb_available,bb_Product,bb_cap,bb_qty,bb_value) values('".$so_trackid."','Yes','".$buyback_product."','".$buyback_cap."','".$buyback_qty."','".$buyback_value."')";
        
        mysqli_query($con1,$buyback_sql);
    }
    
    // end Buyback
        
    // Demo_atm insert
    
 
    
    
    $atm_sql = "insert into demo_atm(atm_id, cust_id, so_id,so_date,po_trackid,bank_name, area, pincode, city, branch_id,  address, DO_no, state, pending_status) values('".$atmid."', '".$custid."', '".$so_trackid."','".$date."','".$po_id."','".$consignee_name."', '".$area."', '".$pincode."', '".$city."', '".$avo_branch."', '".$address."', '".$DO_no."' , '".$state_name."', '1')";
      
        mysqli_query($con1,$atm_sql);
        
        
    
    // Demo_atm insert



    // PO consumption
    
    $assetTrackid = get_assetTrackid($po_id);
    


       
       $count = 0;
       foreach($po_product_id as $key=>$val){
           
           $po_model = get_product_specs('po_model', $val);
           $po_quantity = get_product_specs('po_qty', $val);
           
           $check_cons_sql = mysqli_query($con,"select * from po_consumption where po_trackid = '".$po_id."' and so_trackid='".$so_trackid."' and po_product = '".$assetTrackid[$count]."'");
           
           if($check_cons_sql_rersult = mysqli_fetch_assoc($check_cons_sql)){
               
           }else{
               
               if($assetTrackid[$count]){
                   
                   $consumption_sql = "insert into po_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status,so_assetID) values('".$po_id."','".$so_trackid."','".$assetTrackid[$count]."','".$po_model."','0','".intval($po_quantity/$sites)."','".$po_quantity."','0','".$val."')";
           
           
           
            //   echo $consumption_sql;
                mysqli_query($con1,$consumption_sql);                   
               }

            
        $count++;
        
           }
       }
    // $cons_sql = 
    // End po_consumption



            $contents.="\n".$counter."\t";
            $contents.= $custid."\t";
            $contents.= $so_trackid."\t";
            
            $contents.= $po_no."\t";
            $contents.= $po_id."\t";
            $contents.= get_buyername($buyerid)."\t";
            $contents.= $atmid."\t";
            $contents.= get_branch_name($avo_branch)."\t";
            $contents.= $del_type."\t";
            
            if($inst_request == 1){
                $install = 'Yes';
            }
            else{
                $install = 'No';
            }
            $contents.= $install."\t";
            
            if($buyback==1){
                $buyback_request = 'Yes';
            }
            else{
                $buyback_request = 'No';
            }
            $contents.= $buyback_request."\t";
            
            $contents.= $contact_person_name."\t";
            $contents.= $contact_person_mobile."\t";
            $contents.= $email_to."\t";
            
            $contents.= 'Yes'."\t";
            $contents.= $error."\t";
            

        }

        
        else{
            // error part
            $so_trackid = 0;
            $contents.="\n".$counter."\t";
            
        if($custid){
            
            $contents.= $custid."\t";            
        } else {
             $contents.='No Customer Vertical Found,'."\t";
             $error.='No Customer Vertical Found,'."\t";
            
        }

            $contents.= $so_trackid."\t";
            
            if(check_po($po_no)==1){
                $contents.= $po_no."\t";                
            }
            else{
             $contents.='No Purchase Order Number Found,'."\t";
             $error.='No Purchase Order Number Found,'."\t";
            }

            if(check_po($po_no)==1){
                $contents.= $po_id."\t";                
            }
            else{
             $contents.='No Purchase Order ID Found,'."\t";
             $error.='No Purchase Order ID Found,';
            }
            
            if(get_buyername($buyerid)){
                $contents.= get_buyername($buyerid)."\t";                
            }
            else{
                $contents.='No Buyer Found,'."\t";
                 $error.='No Buyer Found,';
            }

            if($atmid){
                $contents.= $atmid."\t";                
            }
            else{
                $contents.='No ATM Found,'."\t";
                 $error.='No ATM Found,';
            }

            if($avo_branch){
                $contents.= $avo_branch."\t";                
            }
            else{
                $contents.='No Branch Found,'."\t";
                 $error.='No Branch Found,';
            }
            
            if($del_type){
                $contents.= $del_type."\t";                
            }
            else{
                $contents.='No Delivery Type Found,'."\t";
                 $error.='No Delivery Type Found,';
            }

            if($inst_request){
                $contents.= $inst_request."\t";                
            } else{
                $contents.='No Installation Request Found,'."\t";
                 $error.='No Installation Request Found,';
            }

            
            if($buyback==1){
                $buyback_request = 'Yes';
            }
            else{
                $buyback_request = 'No';
            }
            if($buyback_request){
                $contents.= $buyback_request."\t";                
            } else{
                $contents.='No Buyback Request Found,'."\t";
                 $error.='No Buyback Request Found,';
            }

            if($contact_person_name){
                $contents.= $contact_person_name."\t";                
            } else{
                $contents.='No Contact Person Name Found,'."\t";
                 $error.='No Contact Person Name Found,';
            }

            if($contact_person_mobile){
                $contents.= $contact_person_mobile."\t";                
            } else{
                $contents.='No Contact Person Mobile Found,'."\t";
                 $error.='No Contact Person Mobile Found,';
            }
            

            if($email_to){
                $contents.= $email_to."\t";                
            } else{
                $contents.='No Contact Person Email Found,'."\t";
                 $error.='No Contact Person Email Found,';
            }
            
            $contents.= 'No'."\t";
            $contents.= $error."\t";
            

        }
            
            
        }
        
        }
        
        
        $no= $no + $no_of_sites;
        $sites = 0;
        $error = '0';
        $counter++;
    }
    

$contents = strip_tags($contents); 




// return;

  header("Content-Disposition: attachment; filename=export_sales.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
