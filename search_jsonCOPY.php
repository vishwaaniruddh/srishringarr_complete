<?php include('config.php');
header('Content-Type: application/json');
$searchText = $_POST['query'];
include('functions.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
if($searchText){
    
			    $pathmain = "https://yosshitaneha.com/";
		        $jewellery = 'jewellery';
                $apparels = 'Apparels';
                $path = '../Admin/';
                $qty = 1;
                
                $garsql = "SELECT g.*,gp.* FROM `garments` g left join  garment_product gp on g.garment_id = gp.product_for WHERE g.name like '%".$searchText."%' or gp.gproduct_code like '%".$searchText."%'";
                $Apparel=mysqli_query($conn,$garsql);

                $garment_row_count = mysqli_num_rows($Apparel);
                $jewsql = "SELECT j.categories_name,j.subcat_id as m_category,js.name,js.subcat_id as sub_cat,p.* from jewel_subcat j join subcat1 js on j.subcat_id=js.maincat_id join product p on js.subcat_id = p.subcat_id where j.categories_name like '%".$searchText."%' or js.name like '%".$searchText."%' or p.product_code like '%".$searchText."%' or p.product_name like '%".$searchText."%' ";
                $Jewellery=mysqli_query($conn,$jewsql);
                
                $jewel_row_count = mysqli_num_rows($Jewellery);
                
                
                if($garment_row_count > 0){
                    
                    $result = $Apparel;
                    $type =$category = 2;
                } else if($jewel_row_count > 0){
                    
                    $result = $Jewellery;
                    
                    $type = $category = 1;
                } else {
                    $result = 0;
                }
                $num = 0;
                while( $row = mysqli_fetch_array($result))
                {
                    
                                            unset($deposit);
                    if($row['m_category']==1){
                            $necklace = 1 ;
                    }
                    $youtube = $row['youtube'];
                    echo $youtube;
                    if($youtube){
                        $is_youtube = 1 ;
                    }else{
                        $is_youtube = 0 ; 
                    }
                    
                    if($category==2){
                        $prcode=$row['gproduct_code'];
                        $pid = $row['gproduct_id'];
                        $image_qry ="SELECT prod_image from product_images_new where gproduct_id = '".$pid."' or pro_code='".$prcode."' ";
                        $name = $row['gproduct_name'];
                        
                    } else if($category==1){
                        $prcode=$row['product_code'];
                        $pid = $row['product_id'];
                        $image_qry ="SELECT prod_image from product_images_new where product_id = '".$pid."' or pro_code='".$prcode."' ";
                        $name = $row['product_name'];
                    }
                    //echo $image_qry;
                    
                    $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
                    $rero=mysqli_fetch_row($re);
                    $newselling_price = $rero[0]; 
                    
                    $qty=round($rero[2]);
        
        if($qty > 0 ){
        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        $currentsp=$rero[0]-$rero1[0];
        $splimit=$rero[1]*0.8;
if($type==1){
    if($currentsp>$splimit)
        $newsp=$currentsp;
    else
        $newsp=$splimit;
    
}elseif($type==2){
    if($currentsp>$splimit)
        $newsp=$currentsp;
    else
        $newsp=$splimit;
}        
                    if($category=="1"){
                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$pid."'";
                              if($newsp<=40000){
                                $rentprice=$newsp*0.20;  
                              }
                            else if($newsp<=60000){
                                $rentprice=$newsp*0.17;
                            }
                            else{
                                $rentprice=$newsp*0.15;
                            }
                               if($newsp<=2000){
                                   $courier = 100;
                               }else if($newsp<=5000){
                                   $courier = 250;                                   
                               }else if($newsp<=10000){
                                   $courier = 500;                                   
                               }else{
                                   $courier = 1000;                                   
                               }                       
    $rentprice = $rentprice  + $courier ;
                                        // necklace cat should have mimnim um 1500 rent and not less than that
                                        if($necklace==1 && $rentprice < 1500 ){
                                            $rentprice = 1500;
                                            $deposit = 3000; 
                                        }
                        }
                        else{
                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$pid."'";
                              if($newsp<=40000)
                                $rentprice=$newsp*0.20;
                            else if($newsp<=60000)
                                $rentprice=$newsp*0.17; 
                            else
                                $rentprice=$newsp*0.15;
                               if($newsp<=10000){
                                   $courier = 750;
                               }else {
                                   $courier = 2000;                                   
                               }
                            $rentprice = $rentprice  + $courier ;
                            if($rentprice < 3500){
                                $rentprice  =3500;
                                $deposit = 3500;
                            }
                        }  
                        $qryimg = mysqli_query($con,$sqlimg);
                        $rowimg = mysqli_fetch_row($qryimg);
                        
                        if($rowimg){
                            $path = trim($pathmain."uploads".$rowimg[0]);
                            $source_img = trim("yn/uploads".$rowimg[0]);
$filename = basename($source_img);
// $destination_img = 'comimage/com_'.$filename;
$destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;

compress($source_img, $destination_img, 20);
        
                            $imgframe = '<img class="img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" src="' . $destination_img . '">';
                            
                            // $imgframe = '<img class="img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" src="' . $path . '">';
                        } else if($youtube){
                                $ytarray=explode("/", $youtube);
                                $ytendstring=end($ytarray);
                                $ytendarray=explode("?v=", $ytendstring);
                                $ytendstring=end($ytendarray);
                                $ytendarray=explode("&", $ytendstring);
                                $ytcode=$ytendarray[0];
                                $imgframe =  "<iframe width=\"100%\" height=\"315\" src=\"https://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
                        }else{

                        }
                        $rentprice = intval($rentprice) ;
                        $rentprice = round_amount($rentprice);
                        $image=mysqli_query($conn,$image_qry);
                    
                    $img = mysqli_fetch_assoc($image);
                    $path=trim($pathmain."uploads".$img['prod_image']);
                  
                    $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
                    $rero=mysqli_fetch_row($re);
                    $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
                    $rero1=mysqli_fetch_row($re1);
                    $currentsp=$rero[0]-$rero1[0];
                    $splimit=$rero[1]*0.8;
                   
                  
if($type==1){
    if($currentsp>$splimit)
        $newsp=$currentsp;
    else
        $newsp=$splimit;
    
}elseif($type==2){
    if($currentsp>$splimit)
        $newsp=$currentsp;
    else
        $newsp=$splimit;
}         

if(getDBrent($prcode,$type)>0){
    $rentprice = getDBrent($prcode,$type); 
    $rentprice = round_amount($rentprice+$courier);

}

                   if(isset($deposit) && $deposit!=0){ }else{ $deposit = intval($newsp*0.35);  }
                        $round_num = substr( $deposit, -2);
                    if($round_num < 50 && $round_num!=00 && $round_num!=50){
                        $add_amount = 50 - $round_num;
                    }
                    elseif($round_num > 50 && $round_num != 00 && $round_num!=50){
                        $add_amount = 100 - $round_num;  
                    }
                    else{
                        $add_amount = 0; 
                    }
                        $final_deposit = $deposit + $add_amount;
                        $qty=round($rero[2]);
                        $url = "detail.php?id=$pid&type=$category&days=3";
                        $data[] = ['pid'=>$pid,'category'=>$category,'link'=>$url,'image'=>$path,'product_name'=>$name,'deposite'=>$final_deposit, 'selling_price'=>$newselling_price,'sku'=>$prcode,'rent_price'=>$rentprice,'imageframe'=>$imgframe,'jew'=>$jewsql,'gar'=>$garsql];
                }
            }
        }

if($data){
    $data = ['qqq'=>$data];
echo json_encode($data);    
}
else{
    echo json_encode('0');
} 


?>