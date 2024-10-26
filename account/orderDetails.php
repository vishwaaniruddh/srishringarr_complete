<?php include_once('site_header.php'); 

$userid=$_SESSION['gid'];
  //echo $userid;
?>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
    .site-content {
        outline: none;
    }

    .site-content, .header-widget-region {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    @media (max-width: 66.4989378333em) {
        .col-full {
            margin-left: 2.617924em;
            margin-right: 2.617924em;
            padding: 0;
        }
    }

    table {
        border-spacing: 0;
        width: 100%;
        border-collapse: separate;
    }
    
    @media (min-width: 768px){
        .woocommerce-MyAccount-content {
        width: 76.4705882353%;
        float: right;
        margin-right: 0;
    }
    
    table.my_account_orders {
        font-size: 0.875em;
    }
    table.shop_table_responsive thead {
        display: table-header-group;
    }
    
    .col-full {
        max-width: 66.4989378333em;
        margin-left: auto;
        margin-right: auto;
        padding: 0 2.617924em;
        box-sizing: content-box;
    }
    
     .widget-area {
        margin-bottom: 2.617924em;
    }
    
    .content-area {
        width: 100%;
        float: left;
    }
    
    .woocommerce-MyAccount-navigation {
        width: 17.6470588235%;
        float: left;
        margin-right: 5.8823529412%;
    }
    
    .woocommerce-MyAccount-content {
        width: 76.4705882353%;
        float: right;
        margin-right: 0;
    }
    
    table.shop_table_responsive tr td {
        display: table-cell;
    }
    
    table.shop_table_responsive tbody tr td, table.shop_table_responsive tbody tr th {
        text-align: left;
    }
    
    }
    
    table:not( .has-background ) th {
        background-color: #000000;
    }
    
    table thead th,td {
        padding: 1.41575em;
        vertical-align: middle;
    }
    table th, table tbody td, #payment .payment_methods li, #comments .comment-list .comment-content .comment-text, #payment .payment_methods > li .payment_box, #payment .place-order {
        background: #f8f8f8!important;
    }
    table th {
        font-weight: 600;
    }
    
    table thead th {
        padding: 1.41575em;
        vertical-align: middle;
    }
    
    p {
        margin: 0 0 1.41575em;
    }	
    
    .hentry .entry-content .woocommerce-MyAccount-navigation ul {
        margin-left: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    ul {
        list-style: disc;
    }
    ul, ol {
        margin: 0 0 1.41575em 3em;
        padding: 0;
    }
    
    .hentry .entry-content .woocommerce-MyAccount-navigation ul li {
        list-style: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }
    a {
        color: #227504;
            /*font-weight: 600;*/
    }
    .hentry .entry-content .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link a {
        text-decoration: none;
        padding: 0.875em 0;
        display: block;
    }	
    .site-main {
        margin-bottom: 2.617924em;
    }
    
    .hentry {
        /*border-bottom: 1px solid #ededed;*/
        margin: 0 0 4.235801032em;
    }
    
    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
        display: block;
    }
    #content{
        margin: 3% auto;
    }
</style>

<div id="content" class="site-content" tabindex="-1">
    <div class="container">
	        <div id="primary" class="content-area">
		        <main id="main" class="site-main" role="main">
                    <article id="post-9" class="post-9 page type-page status-publish hentry">
			            <div class="entry-content">
			                <div class="woocommerce">
                                <nav class="woocommerce-MyAccount-navigation">
	                                <ul>
                            			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
                            				<a href="my-account.php">Dashboard</a>
                            			</li>
                            					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                            				<a href="orders.php">Orders</a>
                            			</li>
                            			
                            			
                            			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                            				<a href="../cart.php">Go to cart</a>
                            			</li>
                            			
                            			
                            			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                            				<a href="edit-account.php">Account details</a>
                            			</li>
                            			<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                            				<a href="../logout.php">Logout</a>
                            			</li>
			                        </ul>
                                </nav>

                                <div class="woocommerce-MyAccount-content">

                                        <div class="row-offcanvas row-offcanvas-left">
                                            <div id="page">
                                                <!-- header -->
                                        
                                                <header id="header-layout" class="header-v2">

                                                   <div id="header-bot" class="hidden-xs hidden-sm">
                                                        <div class="container-fluid">
                                                            <div class="container-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                                                                                            
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                                                                         <?php 
                                                                        // include("mancategories.php");
                                                                         ?>                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <!-- /header -->
                                                <!-- sys-notification -->
                                                <div id="sys-notification">
                                                  <div class="container">
                                                    <div id="notification"></div>
                                                  </div>
                                                </div>
                                                <!-- /sys-notification -->
                                                <div class="container-fluid">
                                                    <ul class="breadcrumb">
                                                        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                                                        <li><a href="my-account.php">Account/</a></li>
                                                        <li><a href="orders.php">Order History/</a></li>
                                                        <li><a href="ordersDetails.php">Order Information/</a></li>
                                                    </ul>
                                                    <div class="row">
                                                        <div id="content" >
                                                            <h2>Order Information</h2>
                                                            <table class="table table-bordered table-hover" style="background-color: white;">
                                                                <?php
                                                                $order_id = $_GET['id'];

                                                                $query_order = mysql_query("select * from Order_ent where id='".$order_id."' ");
                                                                $fetch_order=mysql_fetch_assoc($query_order);
                                                                
                                                                $subtotal = $fetch_order['total_amount'] - $fetch_order['shipping_charges'];;                                                                
                                                                
                                                                $userid = $fetch_order['user_id'];
                                                                    
                                                                $userData = mysql_query("SELECT * FROM Registration WHERE registration_id ='".$userid."'  ");
                                                                $fetch_userData = mysql_fetch_assoc($userData);
                                                                
                                                                $city = get_city_name($fetch_userData['city']);
                                                                $state = get_state_name($fetch_userData['state']);
                                                                
                                                                //$userData = get_shipping_address($userid);
                                                                $shipping_charges = get_shipping_charges($fetch_order['amount']);
                                                                
                                                                ?>
                                                            
                                                                <thead>
                                                                  <tr>
                                                                    <td class="text-left" colspan="2"><b style="color:#666666">Order Details</b></td>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-left" style="width: 50%;">  
                                                                            <b>Order ID: <?php echo $order_id;?></b> <br />
                                                                            <b>Date Added:</b> <?php echo $fetch_order['date'];?>
                                                                        </td>
                                                                        
                                                                        <td class="text-left" style="width: 50%;"> 
                                                                            <b>Payment Method: <?php echo $fetch_order['pmode'];?></b> <br />
                                                                            <b>Transaction No: <?php echo $fetch_order['transaction_id'];?></b> <br />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                        </table>
                                                        
                                                                <b style="color:#666666">Shipping Address</b>
                                                                 
                                                              <p>
                                                                <?php echo $fetch_userData['address'].'<br>'.$fetch_userData['landmark'];?><br />
                                                                <?php echo $state.' , '.$city;?><br />
                                                                <?php echo $fetch_userData['Mobile'];?><br /><?php echo $fetch_userData['pincode'];?>
                                                              </p>
                                                              

                                                                <b style="color:#666666"><a class="btn btn-danger" href="../bill/srisringarr_bill/srishringarr_bill.php?oid=<?php echo $order_id;?>">Invoice</a></b>

                                      <br>
                                      <br>
                                      
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div>
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Product</th>
                                                                                <th>Quantity</th>
                                                                                <th class="text-center">Price</th>
                                                                                <th class="text-center">Total</th>
                                                                                <th> </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            
                                                                            <?php
                                                                            

                                                                            $query = mysql_query("select * from order_details where order_id='".$order_id."' ORDER BY id desc");
                                                                            
                                                                            
                                                                            
                                                                            while($fetch=mysql_fetch_assoc($query))
                                                                            {
                                                                                //var_dump($fetch);
                                                                                
                                                                                
                                                                                $today = date("Y-m-d H:m:s");
                                                                                $order_date = $fetch['date'];
                                                                                
                                                                                
                                                                                $date1=date_create($order_date);
                                                                                $date2=date_create($today);
                                                                                $diff=date_diff($date1,$date2);
                                                                                
                                                                                $date_difference =  $diff->format("%a");

                                                                                
                                                                                $qrydt="";
                                                                            	if($fetch['product_type']==1)
                                                                            	{
                                                                            	    $qrydt="select product_code,product_id from product where product_id='".$fetch['product_id']."'";
                                                                            	}
                                                                            	else
                                                                            	{
                                                                            	     $qrydt="select gproduct_code,gproduct_id from garment_product where gproduct_id='".$fetch['product_id']."'";
                                                                            	}
                                                                            // 	echo $qrydt;
                                                                            	
                                                                            // 	echo '<br>';
                                                                                $qrypro=mysql_query($qrydt);
                                                                                $fetchp=mysql_fetch_array($qrypro);
                                                                                $qryyimg="";
                                                                            	  
                                                                            	$qryyimg="select prod_image from product_images_new where gproduct_id='".$fetch['product_id']."' or  product_id='".$fetch['product_id']."'";
                                                                            	
                                                                            // 	echo $qryyimg;
                                                                            	$qryimg=mysql_query($qryyimg);
                                                                                $fetchimg=mysql_fetch_array($qryimg);
                                                                            
                                                                            ?>
                                                                            <tr>
                                                                                <td class="col-sm-8 col-md-6">
                                                                                    <div class="media">
                                                                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo "../uploads".$fetchimg[0];?>" style="width: 72px; height: 72px;"> </a>
                                                                                        <div class="media-body">
                                                                                            <h4 class="media-heading"><a href="#"><?php echo $fetchp[0]; ?></a></h4>
                                                                                            <h5 class="media-heading">  <a href="#"><?php echo $fetch['short_desc']; ?></a></h5>
                                                                                            <span><?php echo $fetch['status']; ?> : </span><span class="text-success"><strong><?php echo $fetch['date']; ?></strong></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                                                                    <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $fetch['qty']; ?>" readonly>
                                                                                </td>
                                                                                <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $fetch['product_amt']; ?></strong></td>
                                                                                <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $fetch['total_amt'];?></strong></td>
                                                                                <td class="col-sm-1 col-md-1">
                                                                                    <?php if(($fetch['status']==3 || $fetch['status']==2) && $date_difference<=5) { ?>
                                                                                        <button type="button" class="btn btn-danger" onclick="cancel_order(<?php echo $fetch['id'];?>,5,<?php echo $fetch['qty']; ?>);">
                                                                                            <span class="glyphicon glyphicon-share-alt"></span> Return
                                                                                        </button>
                                                                                    <?php } else if($fetch['status']==1 && $date_difference<=5){ ?>
                                                                                        <button type="button" class="btn btn-danger" onclick="cancel_order(<?php echo $fetch['id'];?>,4,<?php echo $fetch['qty']; ?>);">
                                                                                            <span class="glyphicon glyphicon-remove"></span> Cancel
                                                                                        </button>
                                                                                    <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                        
                                                                            <tr>
                                                                                <?php } ?>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td><h5>Subtotal : </h5></td>
                                                                                <td class="text-right"><h5><strong><?php echo $subtotal ; ?></strong></h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td><h5>Estimated shipping : </h5></td>
                                                                                <td class="text-right"><h5><strong><?php echo $shipping_charges;?></strong></h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td>   </td>
                                                                                <td><h3>Total</h3></td>
                                                                                <td class="text-right"><h3><strong><?php echo $fetch_order['total_amount'];?></strong></h3></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                      
                                                        <!--<h3>Order History</h3>
                                                        <table class="table table-bordered table-hover" style="background-color: white;">
                                                            <thead>
                                                              <tr>
                                                                <td class="text-left">Date Added</td>
                                                                <td class="text-left">Status</td>
                                                                <td class="text-left">Comment</td>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <td class="text-left"><?php echo $dt;?></td>
                                                                <td class="text-left"><?php echo $p;?></td>
                                                                <td class="text-left"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>    <br />-->
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <!--
                                              $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
                                             -->
                                        </div>
                                        <div class="sidebar-offcanvas visible-xs visible-sm">
                                            <div class="offcanvas-inner panel-offcanvas">
                                                <div class="offcanvas-heading clearfix">
                                                    <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <div id="offcanvasmenu"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function cancel_order(oid,status,qty){
                                   console.log(oid); 
                                   if(status == 4){
                                        var is_cancel = confirm('Are you sure you want cancel this product!');
                                   } else if(status == 5){
                                       var is_cancel = confirm('Are you sure you want return this product!');
                                   }
                                   if(is_cancel){
                                        $.ajax({
                                            type: 'POST',    
                                            url:'../order_processing.php',
                                            data:'oid='+oid+'&status='+status+'&qty='+qty,
                                            beforeSend: function() {
                                            
                                            },
                                            success: function(msg){
                                                if(msg==1){
                                                    alert('Request for cancel initiated !');
                                                } else {
                                                    alert('Request for cancel failed !');
                                                }
                                             
                                            },
                                        });
                                   }
                                }
                                
                                function return_product(oid){
                                    console.log(oid);
                                    
                                    $.ajax({
                                        type: 'POST',    
                                        url:'../order_processing.php',
                                        data:'oid='+oid+'&status=5',
                                        beforeSend: function() {
                                        
                                        },
                                        success: function(msg){
                                            if(msg==1){
                                                alert('Request for return initiated !');
                                            } else {
                                                alert('Request for return failed !');
                                            }
                                         
                                        },
                                    });
                                }
                            </script>
<?php ?>