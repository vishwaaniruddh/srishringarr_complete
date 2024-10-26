<?php
    include('../config.php');
    date_default_timezone_set('Asia/Kolkata');
    $date=date('Y-m-d H:i:s');
    $alert_id= $_POST['alert_id'];
    
  
    $err = 0;
    $noerr = 0;
    $totalfiles = 0;
    $size_err = 0;
    $size_err1 = 0;$size_err2 = 0;$size_err3 = 0;$size_err4 = 0;$size_err5 = 0;$size_err6 = 0;
    
    $size = $_FILES["full_product"]["size"];
    $full_product_size = $size[0];
    if($full_product_size > 500000){
       $size_err++;    
       $size_err1++;
    }

  
    $size = $_FILES["front_panel"]["size"];
    $front_panel_size = $size[0];
    if ($front_panel_size > 500000) {
        $size_err = $size_err + 1;
        $size_err2 = $size_err2 + 1;
    }
 
   $size = $_FILES["buyback"]["size"];
   $buyback_size = $size[0];
   if ($buyback_size > 500000) {

        $size_err++;
        $size_err3++;

    }

    $size = $_FILES["input_volt"]["size"];
        $input_volt_size = $size[0];
    if ($input_volt_size > 500000) {

            $size_err++;
            $size_err4++;
        }

    $size = $_FILES["output_volt"]["size"];
    $output_volt_size = $size[0];
    if ($output_volt_size > 500000) {
    
            $size_err++;
            $size_err5++;
    }

    $size = $_FILES["earth_volt"]["size"];
    $earth_volt_size = $size[0];
    if ($earth_volt_size > 500000) {
                $size_err++;
            $size_err6++;
    }
            
            
    if($size_err==0){
        
     
        $totalfiles_cd = 0;
        $noerr_cd = 0;
        $err_cd = 0;
      
        $key_name = 'full_product';
        $totalfiles_cd = $totalfiles_cd + 1;

        $target_filedir = "../inst_snaps_1123/" . $alert_id . "/" . $key_name . "/";
        
        
            
        if (!file_exists($target_filedir)) {
            mkdir($target_filedir, 0777, true);
        }
        
        $array = array(['code'=>$size_err,'size'=>$full_product_size,'path'=>$_FILES["full_product"]["name"]]);
        
         echo json_encode($array);
        /*  
        $path = $_FILES["full_product"]["name"];
        
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        
        
           
          
        $filename = "fullprod.".$ext;
        $target_file = $target_filedir . $filename;
        
         
       
        if (move_uploaded_file($_FILES["full_product"]["tmp_name"], $target_file)) {
            $noerr_cd = $noerr_cd + 1;
            $str = $target_file;
            $mod_target_file = ltrim($str,"../");
            $compress_images = $mod_target_file;
                        
            $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
            if (mysqli_num_rows($snapqry) > 0) { 
             
               $inst = mysqli_query($con1, "UPDATE snap_inst set full_product='" . $compress_images . "' where alert_id ='".$alert_id."'");
            } else {
    
                $inst = mysqli_query($con1, "Insert into snap_inst set alert_id='" . $alert_id . "', full_product='" . $compress_images . "',created_at='" . $date . "' ");

                if ($inst) {
                    $alrt = mysqli_query($con1, "UPDATE alert set snap_file='Done' where alert_id='" . $alert_id . "'");
                }
          
            }
        } else {
            $err_cd++;

        } */
                    
    }

        
        
        
       


?>