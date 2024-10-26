<?php session_start();

include('header.php'); 
echo '<pre>'; print_r($_POST['search']); echo '</pre>';

$searchText = $_POST['search'];

?>
            	
            	
            	<style>
            	    
.product_col:hover .product_img {
    transition: transform 1.2s;
    transform: scale(1.5);
}
.product .img-prod img {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
    -moz-transition: all .3s ease;
    -o-transition: all .3s ease;
    -webkit-transition: all .3s ease;
    -ms-transition: all .3s ease;
    transition: all .3s ease;
}
.img-fluid {
    max-width: 100%;
    height: auto;
    min-height: 350px;
    object-fit: cover;
}
@media (min-width: 768px){
.product_img {
    height: 300px !important;
}    
}


            	</style>

            <div class="p-t-45 p-b-15 p-l-40">
            	<div class="p-l-20 p-r-20 p-t-20 p-b-20 m-l-20 m-r-20 m-t-20 m-b-20">

            	</div>
            			
            </div>

	<div class="bo9 m-l-20 m-r-20 m-t-20 m-b-20">		
		<section class="newproduct bgwhite">
				<div>
					<div class="p-b-20 p-t-20 p-r-20 p-l-20">
						<h3 class="m-text15">
							Products Count: 201
						</h3>
					</div>
					
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="row">
						    
						    
						    <?php
						    $pathmain = "http://yosshitaneha.com/";
		        $jewellery = 'jewellery';
                $apparels = 'Apparels';
                $path = '../Admin/';
                $qty = 1;
                
                $Apparel=mysqli_query($conn,"SELECT g.*,gp.* FROM `garments` g left join  garment_product gp on g.garment_id = gp.product_for WHERE g.name like '%".$searchText."%' or gp.gproduct_code like '%".$searchText."%'");
                
                $garment_row_count = mysqli_num_rows($Apparel);
                
                $Jewellery=mysqli_query($conn,"SELECT j.categories_name,j.subcat_id as m_category,js.name,js.subcat_id as sub_cat,p.* from jewel_subcat j join subcat1 js on j.subcat_id=js.maincat_id join product p on js.subcat_id = p.subcat_id where j.categories_name like '%".$searchText."%' or js.name like '%".$searchText."%' or p.product_code like '%".$searchText."%' or p.product_name like '%".$searchText."%' ");
                
                $jewel_row_count = mysqli_num_rows($Jewellery);
                
                if($garment_row_count > 0){
                    
                    $result = $Apparel;
                    $category = 2;
                } else if($jewel_row_count > 0){
                    
                    $result = $Jewellery;
                    $category = 1;
                } else {
                    $result = 0;
                    echo 'No result found!';
                }
                $num = 0;
                 
                while($row = mysqli_fetch_assoc($result))
                {
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
                    $image=mysqli_query($conn,$image_qry);
                    
                    $img = mysqli_fetch_assoc($image);
                    $path=trim($pathmain."uploads".$img['prod_image']);
                  
                    $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
                    $rero=mysqli_fetch_row($re);
                    $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
                    $rero1=mysqli_fetch_row($re1);
                    $currentsp=$rero[0]-$rero1[0];
                    $splimit=$rero[1]*0.8;
                    if($currentsp>$splimit)
                        $newsp=$currentsp;
                    else
                        $newsp=$splimit;
                        $qty=round($rero[2]);
                        
                        if($img['prod_image']!=''){
                
                ?>
                
                
                
                
                
                
<div class="col col-sm-4 ftco-animate fadeInUp ftco-animated product_col">
    <div class="product">
        <a href="detail.php?id=<?php echo $pid; ?>&type=<?php echo $category;?>" class="img-prod">
            <img class="img-fluid product_img" style="height:350px; width: 100%;object-fit: cover;" src="<?php echo $path;?>" alt="Colorlib Template" data-pagespeed-url-hash="2897450385" onload="">
        </a>
    <div class="text py-3 px-3">
        
        <h3><a href="detail.php?id=<?php echo $pid; ?>&type=<?php echo $category;?>"><?php echo $name;?></a></h3>
        <hr>
        <div class="subpart">
            <p style="display:block;">MRP ₹ <?php echo $newsp; ?></p>
            <h6 style="color:red;">SKU : <a href="#"><? echo $prcode;?></a> </h6>
            <div class="d-flex">
                <!--<div class="pricing">-->
                <!--    <p class="price">-->
                <!--        <span class="mr-2 price-dc">Rent ₹ <strong>'+rent_price+'</strong> : for 3 Days</span>-->
                <!--        <br>-->
                <!--        <span class="price-sale">Deposit ₹ <strong>'+deposite+'</strong> </span>-->
                <!--    </p>-->
                <!--</div>-->
                <div class="rating">
                    <p class="text-right">
                        <a href="#"> <span class="ion-ios-star-outline"> </span> </a>
                        <a href="#"><span class="ion-ios-star-outline">  </span> </a>
                        <a href="#"> <span class="ion-ios-star-outline"> </span> </a>
                        <a href="#"> <span class="ion-ios-star-outline"> </span> </a>
                        <a href="#"> <span class="ion-ios-star-outline"> </span> </a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

























							<!--<div class="col-sm-3" style="padding: 10px;">				-->
							<!--	<div class="item-slick2 p-l-15 p-r-15">-->
									<!-- Block2 -->
							<!--		<div class="block2">-->
							<!--			<div class="block2-img wrap-pic-w of-hidden pos-relative">-->
							<!--				<a href="detail.php?id=<?php echo $pid; ?>&type=<?php echo $category;?>">-->
							<!--					<img src="<?php echo $path;?>" >-->
							<!--				</a>-->
			

							<!--			</div>-->
			
							<!--			<div class="block2-txt p-t-20">-->
							<!--				<a href="detail.php?id=<?php echo $pid; ?>&type=<?php echo $category;?>" class="block2-name dis-block s-text3 p-b-5">-->
							<!--					<?php echo $name;?> -->
							<!--				</a>-->
							<!--				 <span class="block2-price m-text6 p-r-5">-->
							<!--					<?php echo $prcode; ?>-->
							<!--				</span>-->
							<!--				<table style="width: 100%;">-->
							<!--					<tr>-->
							<!--						<td class="block2-price m-text6 p-r-5" style="width: 95%;color: #444;font-size: 15px;">-->
							<!--								Rs. <?php echo $newsp; ?>-->
							<!--						</td>-->

							<!--					</tr>-->
							<!--				</table>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<?php }
                $num++;
                }?>
							
							
						</div>
					</div>
				</div>
			</section>
	</div>

	
	<?php include('footer.php'); ?>