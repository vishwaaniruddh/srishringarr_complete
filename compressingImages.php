<?php
require('config.php');
set_time_limit(0);

return ; 
$img_path = 'https://yosshitaneha.com/uploads';
$pathmain = 'https://yosshitaneha.com/';


    function compressImageFromURL($imageUrl, $destinationPath, $quality) {
        $image = imagecreatefromstring(file_get_contents($imageUrl));
    
        // Check if the image creation was successful
        if ($image === false) {
            echo "Failed to create image from URL.";
            return false;
        }
    
        // Compress the image
        imagejpeg($image, $destinationPath, $quality);
    
        // Free up memory
        imagedestroy($image);
    
        return true;
    }
    



$qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
    while ($rowjew = mysqli_fetch_array($qryjew)) { 
        
        $get_id = $rowjew['garment_id'];
        $sql_query = "select *, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$get_id."' 
        and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
        
        $raw_data = mysqli_query($con,$sql_query);
        while($row = mysqli_fetch_array($raw_data)){
            $deposit = 0;
            $product_id = $row[0];    
            $prid = $product_id ;
        
            echo $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$product_id."'";
            $qryimg = mysqli_query($con,$sqlimg);
            $rowimg = mysqli_fetch_row($qryimg);
            
            $path = $img_path . $rowimg[0];
            $mainImage = $path;
            
            $imageUrl = $path ; 
            $compressedFolder = "comimage/";
            $filname = basename($imageUrl);
            $compressedFilename = $filname;
            $compressedPath = $compressedFolder . $compressedFilename;
            $compressionQuality = 20; // Adjust the quality value as needed (0-100)
            
            // Create the "comimage" folder if it doesn't exist
            if (!file_exists($compressedFolder)) {
            mkdir($compressedFolder, 0777, true);
            }
            
            // Compress the image and check if the compression was successful
            if (compressImageFromURL($imageUrl, $compressedPath, $compressionQuality)) {
            echo "Image compressed and saved successfully: " . $compressedPath;
            echo '<br>';
            mysqli_query($con,"update product_images_new set comimage='".$compressedPath."' where `gproduct_id`='$prid'");
            } else {
            // echo "Failed to compress image.";
            }
            
            
            
        }
        
    }



return ; 
// ALL Jewel

    
$qryjew = mysqli_query($con, "SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");
    while ($rowjew = mysqli_fetch_array($qryjew)) {
        $qryjew1 = mysqli_query($con, "select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
        $cnt = mysqli_num_rows($qryjew1);
        $i = 1;
            while ($rowjew1 = mysqli_fetch_array($qryjew1)) {
        
                $get_id = $rowjew1['subcat_id'];
    

        if($get_id==0 && $get_type==1 && $viewall == 4 ){
         $all = "'2','1','6','3','68','4'";
         $necklace=1;
        }
        
        if($get_id==1 ||$get_id==2 ||$get_id==3 ||$get_id==4 ||$get_id==6||$get_id==68){
            if($type==1){
              $necklace=1;
            }
        }
        
        if($get_id==0 && $get_type==1 && $viewall == 76 ){
         $all = "'59','74','75','76','77','78','79','80'";
        }
    
    
       if($all){
        $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku,newProductName from `product` where subcat_id in($all) order by sku desc";
       }else{
        $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku,newProductName from `product` where subcat_id='".$get_id."' order by sku desc";
       }
   
   
   
                $raw_data = mysqli_query($con,$sql_query);
                $i = 1;
                $cur_sym = $currency_symbol;
                while($row = mysqli_fetch_array($raw_data)){
                    
                echo $product_id = $row[0];
                $prid = $product_id ; 
                
                $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$product_id."'";
                            $qryimg = mysqli_query($con,$sqlimg);
                            $rowimg = mysqli_fetch_row($qryimg);
                            
                            $path = $img_path . $rowimg[0];
                            $mainImage = $path;
                            
                            
                            $imageUrl = $path ; 
                            $compressedFolder = "comimage/";
                            $filname = basename($imageUrl);
                            $compressedFilename = $filname;
                            $compressedPath = $compressedFolder . $compressedFilename;
                            $compressionQuality = 20; // Adjust the quality value as needed (0-100)
                            
                            // Create the "comimage" folder if it doesn't exist
                            if (!file_exists($compressedFolder)) {
                            mkdir($compressedFolder, 0777, true);
                            }
                            
                            // Compress the image and check if the compression was successful
                            if (compressImageFromURL($imageUrl, $compressedPath, $compressionQuality)) {
                            echo "Image compressed and saved successfully: " . $compressedPath;
                            echo '<br>';
                            mysqli_query($con,"update product_images_new set comimage='".$compressedPath."' where `product_id`='$prid'");
                            } else {
                            // echo "Failed to compress image.";
                            }
  
                            
                   
                }            

            }
}


return ; 
$sqlimg = "SELECT img_name,product_id FROM `product_images_new` WHERE product_id > 0 and product_id<>'' and img_name<>''";

$qryimg = mysqli_query($con, $sqlimg);
while($rowimg = mysqli_fetch_row($qryimg)){
    
    $prid = $rowimg['product_id'];
    
    $img_path = 'https://yosshitaneha.com/uploads';
    $pathmain = 'https://yosshitaneha.com/';
    $path = $img_path . $rowimg[0];
    $mainImage = $path;
    
    
    $imageUrl = $path ; 
    // $imageUrl = "https://yosshitaneha.com/uploads/2020/08/15979177330.jpg";
    $compressedFolder = "comimage/";
    $filname = basename($imageUrl);
    $compressedFilename = $filname;
    $compressedPath = $compressedFolder . $compressedFilename;
    $compressionQuality = 40; // Adjust the quality value as needed (0-100)
    
    // Create the "comimage" folder if it doesn't exist
    if (!file_exists($compressedFolder)) {
        mkdir($compressedFolder, 0777, true);
    }
    
    // Compress the image and check if the compression was successful
    if (compressImageFromURL($imageUrl, $compressedPath, $compressionQuality)) {
        echo "Image compressed and saved successfully: " . $compressedPath;
        mysqli_query($con,"update product_images_new set comimage='".$compressedPath."' where `product_id`='$prid'");
    } else {
        echo "Failed to compress image.";
    }
    
    
}


return ; 


$prid = $_REQUEST['id'];
$sqlimg = "SELECT img_name,product_id FROM `product_images_new` WHERE product_id='".$prid."'";

$qryimg = mysqli_query($con, $sqlimg);
while($rowimg = mysqli_fetch_row($qryimg)){
    

    
    $img_path = 'https://yosshitaneha.com/uploads';
    $pathmain = 'https://yosshitaneha.com/';
    $path = $img_path . $rowimg[0];
    $mainImage = $path;
    
    
    $imageUrl = $path ; 
    // $imageUrl = "https://yosshitaneha.com/uploads/2020/08/15979177330.jpg";
    $compressedFolder = "comimage/";
    $filname = basename($imageUrl);
    $compressedFilename = $filname;
    $compressedPath = $compressedFolder . $compressedFilename;
    $compressionQuality = 40; // Adjust the quality value as needed (0-100)
    
    // Create the "comimage" folder if it doesn't exist
    if (!file_exists($compressedFolder)) {
        mkdir($compressedFolder, 0777, true);
    }
    
    // Compress the image and check if the compression was successful
    if (compressImageFromURL($imageUrl, $compressedPath, $compressionQuality)) {
        echo "Image compressed and saved successfully: " . $compressedPath;
        echo "update product_images_new set comimage='".$compressedPath."' where `product_id`='$prid'"; 
        
        mysqli_query($con,"update product_images_new set comimage='".$compressedPath."' where `product_id`='$prid'");
    } else {
        echo "Failed to compress image.";
    }
    
    
}




return ; 



function compress($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    }
    elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
        imagegif($image, $destination, $quality);
    }
    elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        $compression = 9 - round(($quality / 100) * 9);
        imagepng($image, $destination, $compression);
    }

    return $destination;
}

$prid = $_REQUEST['id'];

$sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`='$prid' ORDER BY rank";
$qryimg = mysqli_query($con, $sqlimg);
$rowimg = mysqli_fetch_row($qryimg);
$img_path = 'https://yosshitaneha.com/uploads';
$pathmain = 'https://yosshitaneha.com/';
$path = $img_path . $rowimg[0];
$mainImage = $path;
echo $source_img = $mainImage;
echo '<br>';
echo $filename = basename($source_img);
$folder = 'comimage/';
echo '<br>';
echo $destination_img = str_replace($filename, '', $source_img) . $folder . $filename;

compress($source_img, $destination_img, 20);
?>
