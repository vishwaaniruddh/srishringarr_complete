<?php session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include_once('site_header.php'); 

$userid = $_SESSION['gid'];
?>




	
	<? if(isset($_SESSION['email'])){ ?>
	
	<div id="content" class="site-content" tabindex="-1">
		<div class="container">
			<div class="woocommerce"></div>
	        <div id="primary" class="content-area">
		        <main id="main" class="site-main" role="main">
                    <article id="post-9" class="post-9 page type-page status-publish hentry"> 
			            <div class="entry-content">
			                
			                <div class="row">
                                <nav class="col-sm-4 woo-nav">
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

                                <div class="col-sm-8">
	                                <div class="woocommerce-notices-wrapper"></div>
                                        <p>Hello <strong><? echo $_SESSION['email'];?></strong> (not <strong><? echo $_SESSION['email'];?></strong>? <a href="../logout.php">Log out</a>)</p>



                                        <p>From your account dashboard you can view your <a href="orders.php">recent orders</a>, manage your <a href="edit-account.php">shipping and billing addresses</a>, and <a href="password_reset.php">edit your password </a> <a href="edit-account.php"> account details</a>.</p>



	<?
	
	$sql=mysqli_query($conn,"select * from Registration where registration_id='".$userid."'");
	
	$sql_result=mysqli_fetch_assoc($sql);
	
	$state=$sql_result['state'];
	$city=$sql_result['city'];
	
	
	if(empty($state) || empty($city)){ ?>   
	  <h2>
	      <a href="edit-account.php">
	          "Please complete your profile... !";
	      </a>
	  </h2> 
	<?}
	?>

</div>
</div>
					</div><!-- .entry-content -->
		</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->


		</div><!-- .col-full -->
	</div>
	
	
	
	
	
	
	
<?	} else{ ?>

<div class="container" style="margin:2% auto ;">
    
<?php include_once('login_register.php'); } ?>
	
	
	
	
</div>




	
	
	
	
	
	
	
	
	
	
	
	
	<?php include_once('footer.php');  ?>
