<?php session_start(); include_once('site_header.php');


// var_dump($_SESSION);


// var_dump($_COOKIE);
if(isset($_SESSION['email'])) { // Check if the user is logged in
?>

<div class="" style="margin: 5%;">
    <div class="woocommerce"></div>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-9" class="post-9 page type-page status-publish hentry">
                <div class="entry-content">
                    <div class="row">
                        <?php include('woo-menu.php'); ?>
                        <div class="col-sm-8">
                            <div class="woocommerce-notices-wrapper"></div>
                            <p>Hello <strong><?php echo $_SESSION['email']; ?></strong> (not <strong><?php echo $_SESSION['email']; ?></strong>? <a href="../logout.php">Log out</a>)</p>
                            <p>From your account dashboard you can view your <a href="orders.php">recent orders</a>, manage your <a href="edit-account.php">shipping and billing addresses</a>, and <a href="password_reset.php">edit your password </a> <a href="edit-account.php"> account details</a>.</p>
                            <?php
                            $sql = mysqli_query($conn, "select * from Registration where registration_id='" . $userid . "'");
                            $sql_result = mysqli_fetch_assoc($sql);
                            $state = $sql_result['state'];
                            $city = $sql_result['city'];
                            if (empty($state) || empty($city)) { ?>
                                <h2>
                                    <a href="edit-account.php">
                                        "Please complete your profile... !";
                                    </a>
                                </h2>
                            <?php } ?>
                        </div>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .col-full -->

<?php } else { // If user is not logged in, display login form ?>
    <div class="container" style="padding: 5%;">
        <?php include_once('login_register.php'); ?>
    </div>
<?php }

// var_dump($_SESSION);

include_once('footer.php');
?>
