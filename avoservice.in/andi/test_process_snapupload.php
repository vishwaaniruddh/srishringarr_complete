<?php
    include('../config.php');
  //  date_default_timezone_set('Asia/Kolkata');
    $date=date('Y-m-d H:i:s');
    $alert_id= $_POST['alert_id'];
    
    

 /*   function compressImage($source_image, $compress_image) {
    	$image_info = getimagesize($source_image);	
    	if ($image_info['mime'] == 'image/jpeg') { 
    		$source_image = imagecreatefromjpeg($source_image);
    		imagejpeg($source_image, $compress_image, 75);
    	} elseif ($image_info['mime'] == 'image/gif') {
    		$source_image = imagecreatefromgif($source_image);
    		imagegif($source_image, $compress_image, 75);
    	} elseif ($image_info['mime'] == 'image/png') {
    		$source_image = imagecreatefrompng($source_image);
    		imagepng($source_image, $compress_image, 6);
    	}	    
    	return $compress_image;
    }*/

//echo "Helooo"; die;

    $err = 0;
    $noerr = 0;
    $totalfiles = 0;
   $size_err = 0;
    $size_err1 = 0;$size_err2 = 0;$size_err3 = 0;$size_err4 = 0;$size_err5 = 0;$size_err6 = 0;
    
    $size = $_FILES["full_product"]["size"];
        if($size > 500000){
       $size_err++;    
       $size_err1++;
          
        }

  
        $size = $_FILES["front_panel"]["size"];
        if ($size > 500000) {
                $size_err = $size_err + 1;
                $size_err2 = $size_err2 + 1;
            }
 
  $size = $_FILES["buyback"]["size"];
        if ($size > 500000) {
   
                $size_err++;
                $size_err3++;

    }

        $size = $_FILES["input_volt"]["size"];
        if ($size > 500000) {
 
                $size_err++;
                $size_err4++;
            }

        $size = $_FILES["output_volt"]["size"];
        if ($size > 500000) {
     
                $size_err++;
                $size_err5++;
    }

        $size = $_FILES["earth_volt"]["size"];
        if ($size > 500000) {
                 $size_err++;
                $size_err6++;
            }

//echo "Size Error after"; die;

    if($size_err==0){
        
     
        $totalfiles_cd = 0;
        $noerr_cd = 0;
        $err_cd = 0;
      
            $key_name = 'full_product';
            $totalfiles_cd = $totalfiles_cd + 1;

            $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
            
            if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["full_product"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
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

                    }
  //================Front Panel============
        $totalfiles_fp = 0;
        $noerr_fp = 0;
        $err_fp = 0;
        
            $key_name = 'front_panel';
            $totalfiles_fp = $totalfiles_fp + 1;

            $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
            
            if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["front_panel"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
                  $filename = "frontpanel.".$ext;
                    $target_file = $target_filedir . $filename;
                    
                     if (move_uploaded_file($_FILES["front_panel"]["tmp_name"], $target_file)) {
                        $noerr_fp = $noerr_fp + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
    if (mysqli_num_rows($snapqry) > 0) { 
        
    $inst = mysqli_query($con1, "UPDATE snap_inst set front_panel='" . $compress_images . "' where alert_id='" . $alert_id . "'");
            }
                    } else {
                        $err_fp++;

                    }
  
//==============Buyback==============
        $totalfiles_b = 0;
        $noerr_b = 0;
        $err_b = 0;
     
        $key_name = 'buyback';
           
        $totalfiles_b = $totalfiles_b + 1;

            $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
          
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    
            $path = $_FILES["buyback"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
                  $filename = "buyback.".$ext;
                    $target_file = $target_filedir . $filename;
                    
                     if (move_uploaded_file($_FILES["buyback"]["tmp_name"], $target_file)) {
                        $noerr_b = $noerr_b + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
    if (mysqli_num_rows($snapqry) > 0) { 
        
    $inst = mysqli_query($con1, "UPDATE snap_inst set buyback='" . $compress_images . "' where alert_id='" . $alert_id . "'");
            }
                    } else {
                        $err_b++;

                    }        
                    
 //=========Input Volt==========
        $totalfiles_iv = 0;
        $noerr_iv = 0;
        $err_iv = 0;
       
            $key_name = 'input_volt';
            $totalfiles_iv = $totalfiles_iv + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    
                    $path = $_FILES["input_volt"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
                  $filename = "input_volt.".$ext;
                    $target_file = $target_filedir . $filename;
                    
                     if (move_uploaded_file($_FILES["input_volt"]["tmp_name"], $target_file)) {
                        $noerr_iv = $noerr_iv + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
    if (mysqli_num_rows($snapqry) > 0) { 
        
    $inst = mysqli_query($con1, "UPDATE snap_inst set input_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
            }
                    } else {
                        $err_b++;

                    }     
 //==========Output Volt=
 $totalfiles_ov = 0;
        $noerr_ov = 0;
        $err_ov = 0;
             $key_name = 'output_volt';
             $totalfiles_ov = $totalfiles_ov + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
           $path = $_FILES["output_volt"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
                  $filename = "output_volt.".$ext;
                    $target_file = $target_filedir . $filename;
                    
                     if (move_uploaded_file($_FILES["input_volt"]["tmp_name"], $target_file)) {
                        $noerr_ov = $noerr_ov + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
    if (mysqli_num_rows($snapqry) > 0) { 
        
    $inst = mysqli_query($con1, "UPDATE snap_inst set output_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
            }
                    } else {
                        $err_ov++;

                    } 
                
        $totalfiles_ev = 0;
        $noerr_ev = 0;
        $err_ev = 0;
      
            $key_name = 'earth_volt';
          
             $totalfiles_ev = $totalfiles_ev + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
        $path = $_FILES["earth_volt"]["name"];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                   // $filename = time() . "_" . $name . "." . $ext;
                  $filename = "earth_volt.".$ext;
                    $target_file = $target_filedir . $filename;
                    
                     if (move_uploaded_file($_FILES["earth_volt"]["tmp_name"], $target_file)) {
                        $noerr_ev = $noerr_ev + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
        
    if (mysqli_num_rows($snapqry) > 0) { 
        
    $inst = mysqli_query($con1, "UPDATE snap_inst set earth_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
            }
                    } else {
                        $err_ev++;

                    }             
                    
     $count = $totalfiles_ev + $totalfiles_ov + $totalfiles_iv + $totalfiles_b + $totalfiles_fp + $totalfiles_cd;
       $noerr = $noerr_ev + $noerr_ov + $noerr_iv + $noerr_b + $noerr_fp + $noerr_cd;
       $err = $err_ev + $err_ov + $err_iv + $err_b + $err_fp + $err_cd;
             
        if($noerr>0){
            if($count==$noerr){
                $msg = $noerr." Files uploaded successfully."; 
            }else{
               $msg = $noerr." Files uploaded successfully and ".$err." Files not uploaded" ;  
            }
            $array = array(['Code'=>200,'msg'=>$msg,'files'=>$count]);
        }else{
            $msg = "Sorry, there was an error uploading ".$err." file."; 
            $array = array(['Code'=>201,'msg'=>$msg,'files'=>$count]);
        }
    }else{
        $array = array(['Code'=>202,'size_err1'=>$size_err1,'size_err2'=>$size_err2,'size_err3'=>$size_err3,'size_err4'=>$size_err4,
                        'size_err5'=>$size_err5,'size_err6'=>$size_err6]);
    }
    
    echo json_encode($array);		

?>