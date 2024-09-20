<?php session_start(); 

// include_once('site_header.php');
include($_SERVER['DOCUMENT_ROOT'].'/header.php');
function get_sku_($product_id,$type){
    
    global $con;
    
             if($type==2){
            
                $sql=mysqli_query($con,"SELECT gproduct_code FROM `garment_product` WHERE gproduct_id = '".$product_id."'");
                
                $sql_result=mysqli_fetch_assoc($sql);
                
                $sku=$sql_result['gproduct_code'];
                return $sku;
            
                
            }
             else {
                
                $sql=mysqli_query($con,"SELECT * FROM product WHERE product_id = '".$product_id."'");
                
                $sql_result=mysqli_fetch_assoc($sql);
                
                $sku=$sql_result['product_code'];
                
                return $sku;
            
            }

return;
   
}

?>

<link rel="stylesheet" href="https://<? echo $_SERVER['SERVER_NAME']?>/amcss.css">
<style>
	.a-size-mini {
		text-align: center;
	}

#del{
        padding: 0;
    color: #ba933e;
    border: 0;
    background-color: transparent;
    font-size: 14px;
    text-transform: uppercase;
    -webkit-transition: all .35s ease;
    -o-transition: all .35s ease;
    transition: all .35s ease;
}
.highlight{
        padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    margin: 20px auto;
}
	/*.card{*/
	/*        position: relative;*/
	/*display: -webkit-box;*/
	/*display: -webkit-flex;*/
	/*display: -ms-flexbox;*/
	/*display: flex;*/
	/*-webkit-box-orient: vertical;*/
	/*-webkit-box-direction: normal;*/
	/*-webkit-flex-direction: column;*/
	/*-ms-flex-direction: column;*/
	/*flex-direction: column;*/
	/*background-color: #fff;*/
	/*border: 1px solid rgba(0, 0, 0, 0.125);*/
	/*border-radius: 0.25rem;*/
	/*    padding: 10px;*/
	/*    margin: 10px auto;*/
	/*}*/
</style>


<main class="mainContent" role="main">
	<section id="pageContent">
		<div class="container">
		    
		    <div class="row">
		        <nav class="col-sm-4 woo-nav">
	                            	<ul>
                            		<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
                            			<a href="<?  $_SERVER['DOCUMENT_ROOT']; ?>/account/my-account.php">Dashboard</a>
                            		</li>
                            				<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                            			<a href="<?  $_SERVER['DOCUMENT_ROOT']; ?>/account/orders.php">Orders</a>
                            		</li>
                            		
                            		
                            		<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                            			<a href="<?  $_SERVER['DOCUMENT_ROOT']; ?>/cart.php">Go to cart</a>
                            		</li>
                            		
                            		
                            		<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                            			<a href="<?  $_SERVER['DOCUMENT_ROOT']; ?>/account/edit-account.php">Account details</a>
                            		</li>
                            		<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                            			<a href="<?  $_SERVER['DOCUMENT_ROOT']; ?>/logout.php">Logout</a>
                            		</li>
                            	</ul>
</nav>
		    </div>
			<div id="velaAccount" class="velaAccountContainer">
				<div class="velaPageAccount">
					<h1 class="velaAccountTitle">
						<span>My Account</span>
					</h1>
					<div class="pageAccountContent">
						<div class="rowFlex rowFlexMargin">
							<div class="col-xs-12 col-sm-6">
								<div class="boxAccount accountInfo">
									<h4 class="accountHeading">Account Details</h4>
									<div class="accountContent">
										<h5 class="customerName">
											<? echo name(); ?>
										</h5>
										<div class="customerEmail">
											<? echo email(); ?>
										</div>
										<div class="formAccountRecover">
											<form method="post" action="/account/recover" accept-charset="UTF-8"><input
													type="hidden" name="form_type"
													value="recover_customer_password" /><input type="hidden" name="utf8"
													value="✓" />
												<div class="formContent"><input type="hidden" name="email"
														value="<? echo email(); ?>">
													<input type="submit" class="btnRecoverPassword"
														value="Reset your password">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>


							<div class="col-xs-12 col-sm-6">
								<div class="boxAccount accountAddress">
									<h4 class="accountHeading">Your Addresses</h4>
									<div class="accountContent">

										<?
								// 		echo "select * from shippingInfo where userid ='".$userid."' and site='YN'";
                                    $sql = mysqli_query($con,"select * from shippingInfo where userid ='".$userid."' and site='YN'");
                                    $sql_result1 = mysqli_num_rows($sql);

                                if($sql_result1>0){
                                    while($sql_result = mysqli_fetch_assoc($sql)){ ?>
										<div class="card highlight">
											<div class="card-block">
												<h5>
													<? echo $sql_result['person_name'];?>
												</h5>
												<p>
													<? echo $sql_result['person_contact'];?>
												</p>

												<p>
													<span>
														<? echo $sql_result['address'] . ', ' . $sql_result['landmark']. ', ' . $sql_result['city'].', '.$sql_result['state'].', '.$sql_result['country'].', '.$sql_result['pincode'] ; ?>
													</span>
												</p>



											</div>
										</div>

										<?
                                        
                                    } 
                                    }else{ ?>

										<div>
										</div>
										<p>There are no addresses in your address book</p>

										<? } ?>

										<div class="accountButton">
										    <a href="<? $_SERVER['DOCUMENT_ROOT']; ?>/account/edit-account.php" class="btnRecoverPassword">Add address </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accountOrderBox">
						<h4 class="accountHeading">Order History</h4>
						<div class="orderBoxContent">

							<div class="container">

								<?
            $order_sql = mysqli_query($con,"select * from order_details where user_id = '".$userid."' and ac_typ=2 order by id desc ");
            while($order_sql_result = mysqli_fetch_assoc($order_sql)){ 
            
            $order_id  =  $order_sql_result['id'];
            $image = $order_sql_result['image'];
            $order_date = $order_sql_result['date'];
            $order_date = date('d-M-y',strtotime($order_date));
            
            $product_type = $order_sql_result['product_type'] ;
            $product_id = $order_sql_result['product_id'];
            $sku = get_sku_($product_id,$product_type);
            $product_amt = $order_sql_result['product_amt'];
            $qty = $order_sql_result['qty'];
            $total_amount =$product_amt*$qty ;
            $total_amount = sprintf('%0.2f', $total_amount); 
            $product_amt = sprintf('%0.2f', $product_amt) ; 
            ?>




								<div class="a-box-group a-spacing-base order js-order-card">
									<div class="a-box a-color-offset-background order-info">
										<div class="a-box-inner">
											<div class="a-fixed-right-grid">
												<div class="a-fixed-right-grid-inner">
													<div class="a-fixed-right-grid-col a-col-left"
														style="padding-right:0%;float:left;">
														<div class="a-row">



															<div class="a-column a-span3">


																<div class="a-row a-size-base">

																	<span class="a-color-secondary label">
																		Order placed
																	</span>

																</div>
																<div class="a-row a-size-mini">

																	<span class="a-color-secondary value">
																		<? echo $order_date;?>
																	</span>

																</div>

															</div>





															<div class="a-column a-span2">
																<div class="a-row a-size-base">
																	<span class="a-color-secondary label"> Quantity
																	</span>
																</div>

																<div class="a-row a-size-mini">
																	<span class="a-color-secondary value">
																		<span
																			style="text-decoration: inherit; white-space: nowrap;"><span
																				class="currencyINR">&nbsp;&nbsp;</span><span
																				class="currencyINRFallback"
																				style="display:none">Rs. </span>
																			<? echo $qty; ?>
																		</span>
																	</span>
																</div>
															</div>


															<div class="a-column a-span2">


																<div class="a-row a-size-base">

																	<span class="a-color-secondary label">
																		Unit Price
																	</span>

																</div>



																<div class="a-row a-size-mini">

																	<span class="a-color-secondary value">
																		<span
																			style="text-decoration: inherit; white-space: nowrap;"><span
																				class="currencyINR">&nbsp;&nbsp;</span><span
																				class="currencyINRFallback"
																				style="display:none">Rs. </span>
																			<? echo $product_amt; ?>
																		</span>
																	</span>

																</div>

															</div>



															<div class="a-column a-span2">


																<div class="a-row a-size-base">

																	<span class="a-color-secondary label">
																		Total
																	</span>

																</div>



																<div class="a-row a-size-mini">

																	<span class="a-color-secondary value">
																		<span
																			style="text-decoration: inherit; white-space: nowrap;"><span
																				class="currencyINR">&nbsp;&nbsp;</span><span
																				class="currencyINRFallback"
																				style="display:none">Rs. </span>
																			<? echo $total_amount; ?>
																		</span>
																	</span>

																</div>

															</div>

														</div>
													</div>
													<div class="a-fixed-right-grid-col actions a-col-right">


														<div class="a-row a-size-base">

															<span class="a-color-secondary label">
																Order #
															</span>
															<span class="a-color-secondary value">
																<bdi dir="ltr">
																	<? echo 'YN-'.$order_id ;?>
																</bdi>
															</span>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>









									<div class="a-box shipment shipment-is-delivered">
										<div class="a-box-inner">
											<div class="a-row shipment-top-row js-shipment-info-container">
												<div style="margin-right:230px; padding-right:20px">

													<div class="a-row">
														<span class="a-size-medium a-color-base a-text-bold">
															<!--Delivered <? echo $order_date; ?>-->
														</span>
													</div>
													<div class="a-row">
														<span data-isstatuswithwarning="0"
															data-yodeliveryestimate="Delivered 21-Dec-2021"
															data-yoshortstatuscode="DELIVERED" data-yostatusstring=""
															class="js-shipment-info aok-hidden">
														</span>
													</div>

												</div>
											</div>
											<div class="a-fixed-right-grid a-spacing-top-medium">
												<div class="a-fixed-right-grid-inner a-grid-vertical-align a-grid-top">
													<div class="a-fixed-right-grid-col a-col-left"
														style="padding-right:3.2%;float:left;">

														<div class="a-row">
															<div class="a-fixed-left-grid a-spacing-none">
																<div class="a-fixed-left-grid-inner"
																	style="padding-left:100px">
																	<div class="a-text-center a-fixed-left-grid-col a-col-left"
																		style="width:100px;margin-left:-100px;float:left;">

																		<div class="item-view-left-col-inner">







																			<a class="a-link-normal"
																				href="/gp/product/B095YZB3MS/ref=ppx_yo_dt_b_asin_image_o03_s00?ie=UTF8&amp;psc=1">
																				<img alt="" src="<? echo $image ; ?>"
																					aria-hidden="true" class=""
																					height="90" width="81">
																			</a>


																		</div>
																	</div>
																	<div class="a-fixed-left-grid-col a-col-right"
																		style="padding-left:1.5%;float:left;">
																		<div class="a-row">
																			<a class="a-link-normal"
																				href="../detail.php?id=<? echo$product_id;?>&type=<? echo $product_type?>">
																				<? echo $sku ; ?>
																			</a>
																		</div>
																		<div class="a-row">
																			<span
																				class="a-color-secondary a-text-bold"></span>
																			<span class="a-color-secondary"></span>
																		</div>
																		<div class="a-row"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>


								<? } ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
