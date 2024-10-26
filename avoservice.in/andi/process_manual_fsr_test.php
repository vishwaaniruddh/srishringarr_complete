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
    $count = count($_FILES["image"]["name"]);
    //$filename = strtotime("now").".jpg";
    $size_err = 0;
    $size_err1 = 0;$size_err2 = 0;$size_err3 = 0;$size_err4 = 0;$size_err5 = 0;$size_err6 = 0;
    for($j=0;$j<$count;$j++){
        $name1 = $j ;
        $size = $_FILES["image"]["size"][$name1];
        if($size > 500000){
            if($j==0){
               $size_err = $size_err + 1;    
               $size_err1 = $size_err1 + 1;
            }
            if($j==1){
               $size_err = $size_err + 1;    
               $size_err2 = $size_err2 + 1;
            }
            if($j==2){
               $size_err = $size_err + 1;    
               $size_err3 = $size_err3 + 1;
            }
            if($j==3){
               $size_err = $size_err + 1;    
               $size_err4 = $size_err4 + 1;
            }
            if($j==4){
               $size_err = $size_err + 1;    
               $size_err5 = $size_err5 + 1;
            }
            if($j==5){
               $size_err = $size_err + 1;    
               $size_err6 = $size_err6 + 1;
            }
        }
    }
    
    if($size_err==0){
        for($k=0;$k<$count;$k++){
        //foreach($_FILES as $k => $v){
            $totalfiles = $totalfiles + 1;
            $cnt = $k + 1;
            $name = $k ;
           // $target_filedir =  "../visituploadapp/".$visit_id.'/'; 
            $target_filedir = "../manual_fsr_test_test/"; 
                if (!file_exists($target_filedir)) {
                    mkdir($target_filedir, 0777, true);
                }
                
            $path = $_FILES["image"]["name"][$name];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $filename = time()."_".$name.".".$ext; 
            //$target_file = $target_filedir . basename($_FILES[$name]["name"]);    
            $target_file = $target_filedir . $filename;
            if (move_uploaded_file($_FILES["image"]["tmp_name"][$name], $target_file)) {
                $noerr = $noerr + 1;
                $str = $target_file;
                $mod_target_file = ltrim($str,"../");
               // $compress_images = $target_file;
                $compress_images = $mod_target_file;
                $inst=mysqli_query($con1,"UPDATE alert set manual_fsr='".$compress_images."' where alert_id='".$alert_id."'");	
                
            } else {
                $err = $err + 1;
            
            }
            
        }
             
             
        if($noerr>0){
            if($totalfiles==$noerr){
                $msg = $noerr." Test Files uploaded successfully."; 
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

