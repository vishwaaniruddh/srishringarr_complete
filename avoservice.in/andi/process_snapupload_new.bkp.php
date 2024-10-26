<?php
    include('../config.php');
    date_default_timezone_set('Asia/Kolkata');
    $date=date('Y-m-d H:i:s');
    $alert_id= $_POST['alert_id'];
    
    

    function compressImage($source_image, $compress_image) {
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
    }



    $err = 0;
    $noerr = 0;
    $totalfiles = 0;
  
    
    $full_product_count = count($_FILES["full_product"]["name"]);
    $front_panel_count = count($_FILES["front_panel"]["name"]);
    $buyback_count = count($_FILES["buyback"]["name"]);
    $input_volt_count = count($_FILES["input_volt"]["name"]);
    $output_volt_count = count($_FILES["output_volt"]["name"]);
    $earth_volt_count = count($_FILES["earth_volt"]["name"]);

    //$filename = strtotime("now").".jpg";
    $size_err = 0;
    $size_err1 = 0;$size_err2 = 0;$size_err3 = 0;$size_err4 = 0;$size_err5 = 0;$size_err6 = 0;
    
 
    for($j=0;$j<$full_product_count;$j++){
       $name1 = $j ;
        $size = $_FILES["full_product"]["size"][$name1];
        if($size > 500000){
            if($j==0){
               $size_err = $size_err + 1;    
               $size_err1 = $size_err1 + 1;
            }
        }
    }



    for ($j = 0; $j < $front_panel_count; $j++) {
        $name1 = $j;
        $size = $_FILES["front_panel"]["size"][$name1];
        if ($size > 500000) {
            if ($j == 0) {
                $size_err = $size_err + 1;
                $size_err2 = $size_err2 + 1;
            }
        }
    }

    for ($j = 0; $j < $buyback_count; $j++) {
        $name1 = $j;
        $size = $_FILES["buyback"]["size"][$name1];
        if ($size > 500000) {
            if ($j == 0) {
                $size_err = $size_err + 1;
                $size_err3 = $size_err3 + 1;
            }
        }
    }

    for ($j = 0; $j < $input_volt_count; $j++) {
        $name1 = $j;
        $size = $_FILES["input_volt"]["size"][$name1];
        if ($size > 500000) {
            if ($j == 0) {
                $size_err = $size_err + 1;
                $size_err4 = $size_err4 + 1;
            }
        }
    }

    for ($j = 0; $j < $output_volt_count; $j++) {
        $name1 = $j;
        $size = $_FILES["output_volt"]["size"][$name1];
        if ($size > 500000) {
            if ($j == 0) {
                $size_err = $size_err + 1;
                $size_err5 = $size_err5 + 1;
            }
        }
    }

    for ($j = 0; $j < $earth_volt_count; $j++) {
        $name1 = $j;
        $size = $_FILES["earth_volt"]["size"][$name1];
        if ($size > 500000) {
            if ($j == 0) {
                $size_err = $size_err + 1;
                $size_err6 = $size_err6 + 1;
            }
        }
    }

    
    if($size_err==0){
        
        $cnt_cd = count($_FILES["full_product"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_cd = 0;
        $noerr_cd = 0;
        $err_cd = 0;
        if ($cnt_cd > 0) {
            $key_name = 'full_product';
            for ($k = 0; $k < $cnt_cd; $k++) {
                $name = $k;
                $size = $_FILES["full_product"]["size"][$name];
                
                    $totalfiles_cd = $totalfiles_cd + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["full_product"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["full_product"]["tmp_name"][$name], $target_file)) {
                        $noerr_cd = $noerr_cd + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                           // if ($cnt == 1) {
                                $inst = mysqli_query($con1, "Insert into snap_inst set alert_id='" . $alert_id . "', full_product='" . $compress_images . "',created_at='" . $date . "' ");

                                if ($inst) {
                                    $alrt = mysqli_query($con1, "UPDATE alert set snap_file='Done' where alert_id='" . $alert_id . "'");
                                }
                           // }
                        }
                    } else {
                        $err_cd = $err_cd + 1;

                    }
               
            }
        }

        $cnt_fp = count($_FILES["front_panel"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_fp = 0;
        $noerr_fp = 0;
        $err_fp = 0;
        if ($cnt_fp > 0) {
            $key_name = 'front_panel';
            for ($k = 0; $k < $cnt_fp; $k++) {
                $name = $k;
                $size = $_FILES["front_panel"]["size"][$name];
                
                    $totalfiles_fp = $totalfiles_fp + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["front_panel"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["front_panel"]["tmp_name"][$name], $target_file)) {
                        $noerr_fp = $noerr_fp + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                            $inst = mysqli_query($con1, "UPDATE snap_inst set front_panel='" . $compress_images . "' where alert_id='" . $alert_id . "'");
                        }
                    } else {
                        $err_fp = $err_fp + 1;

                    }
                
            }
        }

        $cnt_b = count($_FILES["buyback"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_b = 0;
        $noerr_b = 0;
        $err_b = 0;
        if ($cnt_b > 0) {
            $key_name = 'buyback';
            for ($k = 0; $k < $cnt_b; $k++) {
                $name = $k;
                $size = $_FILES["buyback"]["size"][$name];
                
                    $totalfiles_b = $totalfiles_b + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["buyback"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["buyback"]["tmp_name"][$name], $target_file)) {
                        $noerr_b = $noerr_b + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                            $inst = mysqli_query($con1, "UPDATE snap_inst set buyback='" . $compress_images . "' where alert_id='" . $alert_id . "'");
                        }
                    } else {
                        $err_b = $err_b + 1;

                    }
                
            }
        }

        $cnt_iv = count($_FILES["input_volt"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_iv = 0;
        $noerr_iv = 0;
        $err_iv = 0;
        if ($cnt_iv > 0) {
            $key_name = 'input_volt';
            for ($k = 0; $k < $cnt_iv; $k++) {
                $name = $k;
                $size = $_FILES["input_volt"]["size"][$name];
                
                    $totalfiles_iv = $totalfiles_iv + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["input_volt"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["input_volt"]["tmp_name"][$name], $target_file)) {
                        $noerr_iv = $noerr_iv + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                            $inst = mysqli_query($con1, "UPDATE snap_inst set input_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
                        }
                    } else {
                        $err_iv = $err_iv + 1;

                    }
                
            }
        }

        $cnt_ov = count($_FILES["output_volt"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_ov = 0;
        $noerr_ov = 0;
        $err_ov = 0;
        if ($cnt_ov > 0) {
            $key_name = 'output_volt';
            for ($k = 0; $k < $cnt_ov; $k++) {
                $name = $k;
                $size = $_FILES["output_volt"]["size"][$name];
                
                    $totalfiles_ov = $totalfiles_ov + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["output_volt"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["output_volt"]["tmp_name"][$name], $target_file)) {
                        $noerr_ov = $noerr_ov + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                           $inst = mysqli_query($con1, "UPDATE snap_inst set output_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
                        }
                    } else {
                        $err_ov = $err_ov + 1;

                    }
                
            }
        }

        $cnt_ev = count($_FILES["earth_volt"]["name"]);
        //$filename = strtotime("now").".jpg";
        $totalfiles_ev = 0;
        $noerr_ev = 0;
        $err_ev = 0;
        if ($cnt_ev > 0) {
            $key_name = 'earth_volt';
            for ($k = 0; $k < $cnt_ev; $k++) {
                $name = $k;
                $size = $_FILES["earth_volt"]["size"][$name];
               
                    $totalfiles_ev = $totalfiles_ev + 1;

                    $target_filedir = "../inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    $target_dir = "inst_snaps_1123/" . $alert_id . '/' . $key_name . '/';
                    if (!file_exists($target_filedir)) {
                        mkdir($target_filedir, 0777, true);
                    }
                    $path = $_FILES["earth_volt"]["name"][$name];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time() . "_" . $name . "." . $ext;
                    //$target_file = $target_filedir . basename($_FILES[$name]["name"]);
                    $target_file = $target_filedir . $filename;
                    if (move_uploaded_file($_FILES["earth_volt"]["tmp_name"][$name], $target_file)) {
                        $noerr_ev = $noerr_ev + 1;
                        $str = $target_file;
                        $mod_target_file = ltrim($str,"../");
                        $compress_images = $mod_target_file;
                        $snapqry = mysqli_query($con1, "select * from snap_inst where alert_id='" . $alert_id . "'");
                        if (mysqli_num_rows == 0) {
                            $inst = mysqli_query($con1, "UPDATE snap_inst set earth_volt='" . $compress_images . "' where alert_id='" . $alert_id . "'");
                        }
                    } else {
                        $err_ev = $err_ev + 1;

                    }
                
            }
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

