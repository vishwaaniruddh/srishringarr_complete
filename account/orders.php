<?php
date_default_timezone_set("Asia/Calcutta");
include_once('site_header.php');
?>

    <div class="" style="margin: 5%;">
        <div class="row">

<br /><br /><br />

                            <?php include('woo-menu.php'); 
                            
                            if (isset($_SESSION['email'])) { ?>

                                <div class="col-sm-8">
                                    <div style="overflow: auto;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order #</th>
                                                <th>Transaction ID</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <style>
                                                td {
                                                    white-space: nowrap;
                                                }

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

                                            $order_sql = mysqli_query($conn, "select * from Order_ent where user_id = '" . $userid . "' and razorpay_order_id<>'' and razor_status <> 'In Progress' order by id desc");

                                            while ($order_sql_result = mysqli_fetch_assoc($order_sql)) {

                                                $txn_id = $order_sql_result['razorpay_order_id'];
                                                $order_id = $order_sql_result['id'];
                                                $date = $order_sql_result['date'];
                                                $amount = $order_sql_result['amount'];
                                                $status = $order_sql_result['razor_status'];

                                                if ($status == 'captured') {
                                                    $new_status = 'Success';
                                                } else {
                                                    $new_status = 'Failed !';
                                                }

                                                ?>
                                                <tr>
                                                    <td scope="row">
                                                        <? echo $order_id; ?>
                                                    </td>
                                                    <td>
                                                        <? echo $txn_id; ?>
                                                    </td>
                                                    <td>
                                                        <? echo '₹ ' . $amount . '.00/-'; ?>
                                                    </td>
                                                    <td>
                                                        <? echo date('d M Y h:i', strtotime($date)); ?>
                                                    </td>
                                                    <td>
                                                        <? echo $new_status; ?>
                                                    </td>
                                                    <td><a class="cust_btn"
                                                            href="order_details.php?id=<? echo $order_id; ?>">View Details</a>
                                                    </td>

                                                </tr>



                                            <? } ?>


                                        </tbody>
                                    </table>
                                        
                                    </div>

                                </div>

                            <? } else {

                                include_once('login_register.php'); ?>
                                sa
                            <? }

                            ?>







                        </div>
    </div>
    

<? include_once('footer.php'); ?>