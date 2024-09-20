<? session_start();
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

include_once($_SERVER["DOCUMENT_ROOT"].'/header.php'); 

$userid=$_SESSION['gid'];


?>



<div id="pageContainer">
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




<?
if(isset($_SESSION['email'])){ ?>

<div class="col-sm-8">
	<div class="woocommerce-notices-wrapper"></div>

	
	
<table class="table table-hover">

  <thead>
    <tr>
      <th scope="col">Order #</th>
      <th>Transaction ID</th>
      <th scope="col">Amount</th>
      <th scope="col">Date</th>

      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>

<style>

.cust_btn {
    background: red;
    color: white;
    padding: 2% 6%;
    border-radius: 4px;
}
.cust_btn:hover {
    color: yellow;
}

</style>
<?

$order_sql = mysqli_query($con,"select * from Order_ent where user_id = '".$userid."' order by id desc");

while($order_sql_result = mysqli_fetch_assoc($order_sql)){ 



$txn_id = $order_sql_result['transaction_id'];
$order_id = $order_sql_result['id'];
$date = $order_sql_result['date'];
$amount = $order_sql_result['amount'];

if($amount>0){ 

?>

    <tr>
      <td scope="row"><? echo $order_id; ?></td>
      <td><? echo $order_sql_result['razorpay_payment_id']; ?></td>
      <td><? echo '₹ '.$amount.'.00/-'; ?></td>
      <td><? echo  date('d M Y h:i',strtotime($date)); ?></td>
      
      
      <td><a class="cust_btn" href="order_details.php?id=<? echo $order_id; ?>">View Details</a> </td>

    </tr>
    
<? } ?>
    

<? } ?>
    

  </tbody>
</table>

</div>
    
<? }
else{ 
    
    include_once('login_register.php'); ?>
    sa
<?}

?>







</div>
					</div><!-- .entry-content -->
		</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->


		</div><!-- .col-full -->
	</div>    
</div>
