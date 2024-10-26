<?php include('config.php');


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


function is_atm_exist($atmid){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from atm where atm_id='".$atmid."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    if($sql_result){
        
        return 1;
        
    }
    else{
        return 0;
    }
    

}

function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
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
 
 
 
    for($i = 1; $i<=$row; $i++){
        
        
        $po_no =  $rowData[$i][0][0];
        $DO_no = $rowData[$i][0][1];
        $atmid  = $rowData[$i][0][2];
        $inst_request  = strtolower($rowData[$i][0][3]);
        $contact_person_name  = $rowData[$i][0][4];
        $contact_person_mobile  = $rowData[$i][0][5];
        $email_to = $rowData[$i][0][6];
        $buyback  = $rowData[$i][0][7];
        
        $del_type  = strtolower($rowData[$i][0][8]);
        
        $consignee_name = $rowData[$i][0][9];
        $area = $rowData[$i][0][10];
        $pincode = $rowData[$i][0][11];
        $city = $rowData[$i][0][12];
        $address = $rowData[$i][0][13];
        $state_name = $rowData[$i][0][14]; 
        $branch_name =  $rowData[$i][0][15];
        $uqty = $rowData[$i][0][16];
        $bqty = $rowData[$i][0][17];
        $sqty = $rowData[$i][0][18];
        $itqty = $rowData[$i][0][19];
        
      //  $so_by  = $rowData[$i][0][21];
      
      $so_by  = "71";
      
      $check_po_sql = mysqli_query($con1,"select * from purchase_order where po_no like '".$po_no."'");
        $check_po_sql_result = mysqli_fetch_assoc($check_po_sql);
        
        $po_id= $check_po_sql_result['id'];
         $custid = $check_po_sql_result['cust_id'];
         $buyerid = $check_po_sql_result['buyer_id'];
  
        if(!$check_po_sql_result){
            $error.='Invalid Purchase Order Number,';
        } 
        

        $check_atm = mysqli_query($con1,"select * from atm where atm_id ='".$atmid."'");
        if($check_so_result = mysqli_fetch_assoc($check_atm)){
            $error.='Site ID already exists!, ';            
        } 
        if(!$consignee_name){
            $error.='Please specify Consignee Name, ';
       }
        
      /*  if(!$uqty || !$bqty || !$sqty || !$itqty) {
            $error.='Please Mention Any Product Quantity, ';
        } */
        
        
        if(!$address){
            $error.='Please specify Address, ';
        }
        if(!$state_name){
            $error.='Please specify State,';
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
        
         $avo_branch = get_branch_id($branch_name);
        
        if(!$avo_branch){
            $error.='Invalid Branch Name';
        }
        
 
        if($del_type !='site_del' && $del_type !='ware_del'){
            $error.='Invalid Delivery Type, ';
        }
        
       
        $cntups=0; $cntbat=0;
    if($error == '0'){
        
       $poid_sql = mysqli_query($con1,"select id from purchase_order where po_no like '".$po_no."'");
     //  echo "select id from purchase_order where po_no like '".$po_no."'";
        $po_sql_result = mysqli_fetch_assoc($poid_sql);
        
         $po_id= $po_sql_result['id'];
         $custid = $po_sql_result['cust_id'];
         $buyerid = $po_sql_result['buyer_id'];

        $sales_sql="insert into new_sales_order(po_trackid,DO_no,po_custid,buyerid,so_by,atm_id,inst_request,user_cont_name,user_cont_phone,user_mail,bb_available,status,do_date,del_type,branch_id) VALUES('".$po_id."','".$DO_no."','".$custid."','".$buyerid."','".$so_by."','".$atmid."','".$inst_request."','".$contact_person_name."','".$contact_person_mobile."','".$email_to."','".$buyback."','1','".$only_date."','".$del_type."','".$avo_branch."')";
    
        mysqli_query($con1,$sales_sql);
         $so_trackid = mysqli_insert_id();
        
         // Demo_atm insert

    $atm_sql = "insert into demo_atm(atm_id, cust_id, so_id,so_date,po_trackid,bank_name, area, pincode, city, branch_id,  address, DO_no, state, pending_status) values('".$atmid."', '".$custid."', '".$so_trackid."','".$date."','".$po_id."','".$consignee_name."', '".$area."', '".$pincode."', '".$city."', '".$avo_branch."', '".$address."', '".$DO_no."' , '".$state_name."', '1')";
      
        mysqli_query($con1,$atm_sql);
        
        //============Asset of UPS======
        if($uqty !='') {
        $sales_assets_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."' and assets_name ='UPS'");
          $ups_row = mysqli_fetch_assoc($sales_assets_sql);
        
           $po_assetid=$ups_row['assettrack_id'];
            $ups_name = $ups_row['assets_name'];
            $upsspecs = $ups_row['specs'];
            $uwarranty = $ups_row['warranty'];
            $urate = $ups_row['rate'];
 
            $ups_asset_insert = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$ups_name."','".$upsspecs."','".$uqty."','".$uwarranty."','".$urate."')";

            mysqli_query($con1,$ups_asset_insert);
            $so_uasset_id=mysqli_insert_id();
           $cntups=$uqty;
        }
         //==========Battery Insert=======
         if($bqty !='') {
             
        $batt_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."' and assets_name ='Battery'");
        $bat_row = mysqli_fetch_assoc($batt_sql);
        
            $bat_assetid=$bat_row['assettrack_id'];
            $bat_name = $bat_row['assets_name'];
            $batspecs = $bat_row['specs'];
            $bwarranty = $bat_row['warranty'];
            $brate = $bat_row['rate'];
            
             $bat_asset_insert = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$bat_name."','".$batspecs."','".$bqty."','".$bwarranty."','".$brate."')";

           mysqli_query($con1,$bat_asset_insert);
           $cntbat=$bqty;
         }
           //==========Servo Insert=======
         
        
         if($sqty !='') {
         
        $ser_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."' and assets_name ='Stabilizer'");
        $ser_row = mysqli_fetch_assoc($ser_sql);
        
            $ser_assetid=$ser_row['assettrack_id'];
            $ser_name = $ser_row['assets_name'];
            $serspecs = $ser_row['specs'];
            $swarranty = $ser_row['warranty'];
            $srate = $ser_row['rate'];
 
             $ser_asset_insert = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$ser_name."','".$serspecs."','".$sqty."','".$swarranty."','".$srate."')";

           mysqli_query($con1,$ser_asset_insert);
           $cntbat=$bqty;
         }   
         
          //==========Isolation Insert=======
         if($itqty !='') {
         
        $it_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$po_id."' and assets_name ='Isolation Transformer'");
        $it_row = mysqli_fetch_assoc($it_sql);
        
            $it_assetid=$it_row['assettrack_id'];
            $it_name = $it_row['assets_name'];
            $itspecs = $it_row['specs'];
            $itwarranty = $it_row['warranty'];
            $itrate = $it_row['rate'];
            
            $it_asset_insert = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$it_name."','".$itspecs."','".$itqty."','".$itwarranty."','".$itrate."')";

           mysqli_query($con1,$it_asset_insert);
           $cntbat=$bqty;
         }   
           //==========PO COnsumption======       
        $check_sql= mysqli_query($con1,"select * from po_consumption where po_trackid='".$po_id."' and po_product='".$po_assetid."'");
        
        $check_sql_result= mysqli_fetch_assoc($check_sql);

    $total_qty = $check_sql_result['po_qty'];
            
        $prev_consume_qty = $check_sql_result['po_consumqty'];
        $new_consume_qty = $prev_consume_qty + $uqty;
    
    if($check_sql_result){
        
        if($total_qty >= $new_consume_qty){

             mysqli_query($con1,"update po_consumption set po_consumqty='".$new_consume_qty."' where po_trackid='".$po_id."' and po_product='".$po_assetid."'");
        }
        else{
            
            echo '<script>
            alert("selected PO quantity is higher than expected !! ");
            </script>';
        }
    }
else{
    
    
     $sql=mysqli_query($con1,"select * from po_assets where assettrack_id = '".$po_assetid."'");
    $sql_result=mysqli_fetch_assoc($sql);
    
    $po_quantity = $sql_result['qty'];
    
    if($po_quantity == $uqty){
    $po_status = '0';
    }
    else{
            $po_status = '1';
    }

     $consumption_sql = "insert into po_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status,so_assetID) values('".$po_id."','".$so_trackid."','".$po_assetid."','".$so_uasset_id."','".$upsspecs."','".$po_quantity."','".$uqty."','".$po_status."','".$so_uasset_id."')";
    
    mysqli_query($con1,$consumption_sql);
        
}
           
 
            $contents.="\n".$i."\t";
            $contents.= $custid."\t";
            $contents.= $so_trackid."\t";
            
            $contents.= $po_no."\t";
            $contents.= $po_id."\t";
            $contents.= get_buyername($buyerid)."\t";
            $contents.= $atmid."\t";
            $contents.= get_branh_name($avo_branch)."\t";
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
            $contents.="\n".$i."\t";
            
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
            
            if(is_atm_exist($atmid)==0){
                $contents.= $atmid."\t";                
            }
            else{
             $contents.='ATM ID Already exist'."\t";
             $error.='ATM ID Already exist'."\t";
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

  $error = '0';
    }
    
// return;    
$contents = strip_tags($contents); 




// return;

  header("Content-Disposition: attachment; filename=export_sales.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
