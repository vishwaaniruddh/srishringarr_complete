<? include('config.php');

$type  = $_REQUEST['type'];
$id = $_REQUEST['id'];

$prid=$id;
$transtyp = 1;

if($type=="1")
{
    $sql="SELECT * FROM `product` WHERE `product_id`='".$prid."'";
}
else if($type=="2")
{
    $sql="select * from  `garment_product` where gproduct_id='".$prid."'";
}

$table=mysqli_query($con,$sql);
$rws=mysqli_fetch_array($table);
$sku = $rws[2];
$youtube = $rws[35];

if($type=="1")
{
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='$prid' order by rank";
}
else if($type=="2")
{
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";
}


$qryimg=mysqli_query($con,$sqlimg);
$rowimg=mysqli_fetch_row($qryimg);
$img_path ='https://yosshitaneha.com/uploads';
$pathmain = 'https://yosshitaneha.com/';
$path = $img_path.$rowimg[0];


$re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$rws[2]."'");
$rero = mysqli_fetch_row($re);
$qty = $rero[2];


                    ?>





<div id="velaQuickView" style="user-select: auto; display: block;">
        <div class="quickviewOverlay" style="user-select: auto;"></div>
        <div class="jsQuickview velaFadeOut" style="user-select: auto; display: block;">
            <a title="Close" class="quickviewClose btnClose" href="javascript:void(0);" style="user-select: auto;"></a>
            <div class="proBoxPrimary row" style="user-select: auto;">
                <div class="proBoxImage col-xs-12 col-sm-12 col-md-5" style="user-select: auto;">
                    <div class="proFeaturedImage" style="user-select: auto;">

                        <a class="proImage" title="" href="detail.php?id=<? echo $prid;?>&type=<? echo $type;?>" style="user-select: auto;">
                            <img class="img-responsive proImageQuickview" src="<? echo $path; ?>" alt="Quickview" style="user-select: auto;">
                            <span class="loadingImage" style="user-select: auto; display: none;"></span>
                        </a>

                    </div>
                   <div class="proThumbnails proThumbnailsQuickview clearfix" style="user-select: auto;">
                        <div class="owl-thumblist" style="user-select: auto;">
                            <div class="owl-carousel owl-loaded" style="user-select: auto; visibility: visible;">

                            <div class="owl-stage-outer" style="user-select: auto;">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 157px; user-select: auto;">


                                    <?php
                                        if($type=="1")
                                        {
                                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='$prid' order by rank";
                                        }
                                        else if($type=="2")
                                        {
                                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";
                                        }

                                        //echo $sqlimg;

                                        $qryimg=mysqli_query($con,$sqlimg);
                                        while($rowimg23=mysqli_fetch_array($qryimg))
                                        {
                                            $img_name= $rowimg23[0];

                                            $image_path = 'http://yosshitaneha.com/uploads'.$img_name;

                                            ?>


                                    <div class="owl-item active" style="width: 78.5px; user-select: auto;">
                                        <div class="thumbItem" style="user-select: auto;">
                                            <a href="javascript:void(0)" class="active" data-index="0" data-imageid="6555316387958" data-image="<? echo $image_path; ?>" data-zoom-image="<? echo $image_path; ?>" style="user-select: auto;">
                                                <img src="<? echo $image_path; ?>" alt="undefined" style="user-select: auto;">
                                            </a>
                                        </div>
                                    </div>
                                    <? } ?>

                                </div>
                            </div>

                            <div class="owl-nav disabled" style="user-select: auto;"><div class="owl-prev disabled" style="user-select: auto;">prev</div><div class="owl-next disabled" style="user-select: auto;">next</div></div><div class="owl-dots disabled" style="user-select: auto;"></div></div>
                        </div>
                    </div>
                </div>
                <div class="proBoxInfo col-xs-12 col-sm-12 col-md-7" style="user-select: auto;" id="product-4491238178934">


                    <div id="msgalerts2"></div>

                    <h3 class="quickviewName mb20" style="user-select: auto;"><a href="/products/victo-pedant-lamp" style="user-select: auto;"><? echo $rws[3]; ?></a></h3>
                    <div class="proShortDescription rte" style="user-select: auto;">
                    <p style="user-select: auto;">
                        <?php
                                                   $description = $rws[4];
                                                   $description = str_replace("•","●",$description);
                                                   $description =  str_replace("●","<br>● ",$description);
                                                   echo $description ;
                                                   ?>
                    </p>
<p style="user-select: auto;"></p></div>

                    <!--<form action="/cart/add" method="post" enctype="multipart/form-data" class="formQuickview form-ajaxtocart" style="user-select: auto;" id="product-actions-4491238178934">                       -->
                        <div class="proVariantsQuickview" style="user-select: auto;"></div>
                        <div class="proPrice clearfix" style="user-select: auto;">
                            <span class="priceProduct priceCompare" style="user-select: auto;"></span>
                            <span class="priceProduct pricePrimary" style="user-select: auto;"><span class="money" style="user-select: auto;">

                            <?
                    if($_SESSION['cur']=='INR'){
                        echo '₹ '.$rero[0];
                    }elseif($_SESSION['cur']=='USD'){
                        echo '$ '. currency_convert($rero[0]);
                    }

?>

</span></span>

                        </div>
                        <div class="velaGroup d-flex flexAlignEnd mb20" style="user-select: auto;">
                            <div class="proQuantity" style="user-select: auto;">
                                <!-- <label for="Quantity" class="qtySelector">Quantity</label> -->


        <div class="velaQty" style="user-select: auto;">
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-id="" data-qty="0" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">−</span>
            </button>
            <input type="text" class="velaQtyNum velaQtyText" value="1" min="1" data-id="" aria-label="quantity" pattern="[0-9]*" name="quantity" style="user-select: auto;">
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyPlus" data-id="" data-qty="11" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">+</span>
            </button>
        </div>


                            </div>
                            <div class="proButton" style="user-select: auto;">
                                <button type="submit" name="add" class="btn btnAddToCart is-added" style="user-select: auto;">
                                    <span id="AddToCart" style="user-select: auto;">Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    <input type="hidden" name="id" value="31715442032758" style="user-select: auto;">

                    <!--</form>-->



                    <div class="proAttr quickviewAvailability instock" style="user-select: auto;"><label style="user-select: auto;">Availability:</label> <? echo $rero[3];?></div>
                    <div class="proAttr quickViewSKU" style="user-select: auto;"><label style="user-select: auto;">SKU:</label><? echo $sku; ?></div>

                </div>
            </div>
        </div>
        <div id="quickviewModal" class="quickviewProduct" style="display: none; user-select: auto;">
            <a title="Close" class="quickviewClose btnClose" href="javascript:void(0);" style="user-select: auto;"></a>
            <div class="proBoxPrimary row" style="user-select: auto;">
                <div class="proBoxImage col-xs-12 col-sm-12 col-md-5" style="user-select: auto;">

                    <div class="proFeaturedImage" style="user-select: auto;">
                        <a class="proImage" title="" href="#" style="user-select: auto;">
                            <img class="img-responsive proImageQuickview" src="<? echo $path; ?>" alt="Quickview" style="user-select: auto;">
                            <span class="loadingImage" style="user-select: auto; display: none;"></span>
                        </a>
                    </div>


                    <div class="proThumbnails proThumbnailsQuickview clearfix" style="user-select: auto;">
                        <div class="owl-thumblist" style="user-select: auto;">
                            <div class="owl-carousel" style="user-select: auto;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="proBoxInfo col-xs-12 col-sm-12 col-md-7" style="user-select: auto;">
                    <h3 class="quickviewName mb20" style="user-select: auto;">&nbsp;</h3>
                    <div class="proShortDescription rte" style="user-select: auto;"></div>



                    <!--<form action="/cart/add" method="post" enctype="multipart/form-data" class="formQuickview form-ajaxtocart" style="user-select: auto;">                       -->
                        <div class="proVariantsQuickview" style="user-select: auto;">

                            <select name="id" style="display: none; user-select: auto;"></select></div>
                        <div class="proPrice clearfix" style="user-select: auto;">
                            <span class="priceProduct priceCompare" style="user-select: auto;"></span>
                            <span class="priceProduct pricePrimary" style="user-select: auto;"></span>

                        </div>
                        <div class="velaGroup d-flex flexAlignEnd mb20" style="user-select: auto;">
                            <div class="proQuantity" style="user-select: auto;">
                                <!-- <label for="Quantity" class="qtySelector">Quantity</label> -->


        <div class="velaQty" style="user-select: auto;">
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-id="" data-qty="0" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">−</span>
            </button>

            <input type="text" id="Quantity" class="velaQtyNum velaQtyText" value="1" min="1" data-id="" aria-label="quantity" pattern="[0-9]*" name="quantity"  style="user-select: auto;">


            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyPlus" data-id="" data-qty="11" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">+</span>
            </button>
        </div>


                            </div>
                            <div class="proButton" style="user-select: auto;">
                                <button type="submit" name="add" class="btn btnAddToCart is-added" style="user-select: auto;">
                                    <span id="AddToCartText" style="user-select: auto;">Add to Cart 2</span>
                                </button>
                            </div>
                        </div>
                    <!--</form>-->


                    <div class="proAttr quickviewAvailability" style="user-select: auto;"></div>
                    <div class="proAttr quickViewVendor" style="user-select: auto;"></div>
                    <div class="proAttr quickViewType" style="user-select: auto;"></div>
                    <div class="proAttr quickViewSKU" style="user-select: auto;"></div>

                </div>
            </div>
        </div>
    </div>




    <script>
        		$(document).ready(function(){



	$("#AddToCart").on('click',function(){

	   var qty = $("#Quantity").val();
	   var pid = '<? echo $prid ;?>';
	   var type= '<? echo $type; ?>';
	   var price = '<? echo $rero[0] ; ?>';
	   var status = '1';
	   var ac_type = '2';
	   var image = '<? echo $path; ?>';
	   var sku = '<? echo $sku; ?>';

       $.ajax({
                type: "POST",
                url: 'addtocart.php',
                data: 'qty='+qty+'&pid='+pid+'&type='+type+'&price='+price+'&status='+status+'&ac_type='+ac_type+'&image='+image+'&sku='+sku,
                success:function(msg) {
                    // alert(msg);
                    if(msg==1){
                        $("#msgalerts2").html('<div class="alert alert-success" role="alert">Added To Cart</div>');
                    $("#cartDrawer").load('cartdrawer.php');

                    }else if(msg==2){
                        $("#msgalerts2").html('<div class="alert alert-danger" role="alert">Error In Added To Cart</div>');
                        alert('Error In Added To Cart');
                    }else if(msg==0){
                        $("#msgalerts2").html('<div class="alert alert-warning" role="alert">selected qunatity is higher than available quantity</div>');
                    }
                }
       });
	});
    });
    </script>