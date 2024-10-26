<?php include 'header.php';

$product_type = $_GET['type'];
$product_id   = $_GET['id'];

//var_dump($_SESSION);
?>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
	<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css" />
	<script type="text/javascript" src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
	<style>
	.velaProBlock.grid .btnProduct {
		width: 45px;
		height: 45px;
		text-align: center;
		line-height: 48px;
		padding: 20%;
	}

	.sidebarListCategories li.sidebarCateItem {
		display: block !important;
	}

	.paginationjs .paginationjs-pages li.active>a {
		z-index: 3;
		color: #fff;
		background-color: #ba933e;
		border-color: #ba933e;
		cursor: default;
	}

	.paginationjs .paginationjs-pages li:not(:last-child) {
		margin-right: 8px;
	}

	.paginationjs .paginationjs-pages li {
		border-right: 1px solid #aaa !important;
		border: 1px solid #aaa !important;
	}

	.paginationjs .paginationjs-pages li>a {
		font-size: 18px;
	}

	.product-card__image .product-card__img {
		object-fit: cover;
	}
	</style>
	<div class="menuMobileOverlay hidden-md hidden-lg"></div>
	</div>
    <main class="mainContent" role="main">
        <div class="shopify-policy__container">
                    <div class="shopify-policy__title">
                        <h1 style="text-align:center">Delivery, Return and Cancellation Policy</h1>
                    </div>
            <div class="shopify-policy__body">
                <div class="container">

                    <div class="row">
                        <div class="center">
                        <div class="card">
                            <div class="col-md-12" >
                                <div class="rte" >
                                    <h4> DELIVERY POLICY </h4>
                                    <span>
                                        User has to be present at the agreed date and time at the specified address given while placing an order with Yosshita & Neha Fashion Studio.
                                    </span>
                                    <span>
                                      The delivery is free Pan- India.
                                    </span>
                                    <span>
                                      The delivery rates for outside India will be communicated at the time of order processing.
                                    </span>

                                    <h4> RETURN AND CANCELLATION POLICY </h4>
                                    <ol>
                                      <span>
                                        In the odd case that you did not receive your proper product from Yosshita & Neha products, here is our policy on returns:
                                      </span>
                                      <ol>
                                        <li>
                                            <span>
                                                Order once placed cannot be cancelled or refunded. Return of the products is not applicable. Returns are only available if you have received wrong or damaged products. You need to return the product to us in an unused condition. Products that are eligible for return can be returned within 72 hours of receiving the merchandise. The Yosshita & Neha Care team must receive and approve your return request. Once your request is received and approved, you will have to self-ship the products back to us. The courier slip with proper shipping date will have to be mailed to us. We recommend using an insured delivery service since the liability for the purchase is not transferred to ourselves until the return is received by ourselves or our representatives.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                Once your return has been authorized, we'd be happy to process your exchange process. This does not affect your statutory rights.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                These conditions do not apply to custom made / made to measure products that are made after an order is placed on our site and specifically for customers, hence returns are not possible. Additionally, if any product has been partly or completely changed for your order, including but not restricted to changing lengths or changing colours or changing the fit, then returns for the same are not possible.
                                            </span>
                                        </li>
                                      </ol>

                                      <h4> DAMAGED OR FAULTY GOODS </h4>
                                      <ol>
                                        <li>
                                            <span>
                                                We employ professional carriers for all our deliveries to customers. In the unlikely event that your merchandise arrives damaged, you should email us a photo & video of the damaged product with the Bar Code. If a product is damaged or faulty, please contact us at once and no later than 2 working days of receipt or of the fault developing, and we will arrange a replacement as you request. We will exchange item which is delivered in a damaged or faulty condition, provided adequate proof of the same has been provided. Alternatively, at your option, we will replace the item with the same or a similar product (subject to stock availability).
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                Sometimes the product specifications may change because of availability of material, embroidery materials or embellishments. In case the changes are substantially different from the advertised products, you can request a replacement and we will do our best to offer you a substitute of the same or better quality at the same price. If you are not happy with the replacement, you can return it in accordance with our returns policy as outlined above under paragraph. Please allow up to 14 days from receipt by us of your replacement item despatched.
                                            </span>
                                        </li>
                                        <li>
                                          <span>
                                              We reserve the right to refuse to issue a refund/replacement item and to recover the cost of the returns delivery from you in the event that the item is found to have suffered damage after delivery or has been misused or used other than in accordance with the instructions or if the problem is due to normal wear and tear. This does not affect your statutory rights.
                                          </span>
                                        </li>
                                        <li>
                                          <span>
                                              We aim to process all returns within 14 days. If you have any questions about your return, feel free to reach out to the Yosshita & Neha Care team at <a href="yosshita.neha@gmail.com"><b>yosshita.neha@gmail.com</b></a>
                                            </span>
                                        </li>
                                        <li>
                                          <span>
                                              All returns are subject to the discretion of Yosshita & Neha. But we're a friendly bunch :)
                                          </span>
                                        </li>
                                        <li>
                                          <span>
                                            	For any other questions or clarifications, please reach out to the Yosshita & Neha Care team at <a href="yosshita.neha@gmail.com"><b>yosshita.neha@gmail.com</b></a>
                                          </span>
                                        </li>
                                        <br>
                                        <span>
                                          The name and contact details of the Grievance Officer are provided below:
                                        </span>
                                        <br><br>
                                        <span>
                                          Yosshita & Neha Fashion Studio <br>
                                          Shyamkamal Building B-1, Flat No. 104, 1st Floor, Agarwal Market, <br> Near Deenanath Mangeshkar Natya Mandir, Vile Parle East, <br> Mumbai - 400057 <br>
                                          Mobile No.: 9324243011 <br>
                                          Email: <a href=" yosshita.neha@gmail.com"> <b>yosshita.neha@gmail.com</b></a> <br>
                                          Time: Available from Tuesday – Sunday (12:00 – 19:00) <br>
                                        </span>

                                    </ol>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>


                </div>

            </div>
        </div>
    </main>
	<style type="text/css">
	@keyframes ldio-kpxe4ypb4vk {
		0% {
			transform: rotate(0deg)
		}
		50% {
			transform: rotate(180deg)
		}
		100% {
			transform: rotate(360deg)
		}
	}

	.ldio-kpxe4ypb4vk div {
		position: absolute;
		animation: ldio-kpxe4ypb4vk 1s linear infinite;
		width: 160px;
		height: 160px;
		top: 20px;
		left: 20px;
		border-radius: 50%;
		box-shadow: 0 4px 0 0 #deb34b;
		transform-origin: 80px 82px;
	}

	.loadingio-spinner-eclipse-w42oo7vkqqq {
		width: 200px;
		height: 200px;
		display: inline-block;
		overflow: hidden;
		/*background: #f1f2f3;*/
	}

	.ldio-kpxe4ypb4vk {
		width: 100%;
		height: 100%;
		position: relative;
		transform: translateZ(0) scale(1);
		backface-visibility: hidden;
		transform-origin: 0 0;
		/* see note above */
	}

	.ldio-kpxe4ypb4vk div {
		box-sizing: content-box;
	}
	/* generated by https://loading.io/ */
	</style>
	<div id="q"></div>
	<style>
	.flash {
		display: block;
		position: fixed;
		top: 125px;
		right: 25px;
		width: 350px;
		padding: 20px 25px 20px 85px;
		font-size: 16px;
		font-weight: 400;
		color: #66847C;
		background-color: #FFF;
		border: 2px solid #66847C;
		border-radius: 2px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
		opacity: 0;
		z-index: 100;
		/*display:none;*/
	}

	.flash__icon {
		position: absolute;
		top: 50%;
		left: 0;
		width: 1.8em;
		height: 100%;
		padding: 0 0.4em;
		background-color: #66847C;
		color: #FFF;
		font-size: 36px;
		font-weight: 300;
		transform: translate(0, -50%);
	}

	.flash__icon .icon {
		position: absolute;
		top: 50%;
		transform: translate(0, -50%);
	}

	.button {
		position: absolute;
		top: 50%;
		left: 50%;
		padding: 10px 20px;
		border: 2px solid #66847C;
		border-radius: 2px;
		color: #66847C;
		transform: translate(-50%, -50%);
		transition: all 0.1s;
	}

	.button:hover {
		cursor: pointer;
		color: #FFF;
		background-color: #66847C;
	}

	.button:active {
		box-shadow: none;
		background-color: #5f7b74;
	}

	@-webkit-keyframes drop-in-fade-out {
		0% {
			opacity: 0;
			visibility: visible;
			-webkit-transform: translate3d(0, -200%, 0);
			-moz-transform: translate3d(0, -200%, 0);
			-ms-transform: translate3d(0, -200%, 0);
			-o-transform: translate3d(0, -200%, 0);
			transform: translate3d(0, -200%, 0);
		}
		12% {
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		20% {
			opacity: 1;
		}
		70% {
			opacity: 1;
			visibility: visible;
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		80% {
			opacity: 0;
		}
		100% {
			visibility: hidden;
			-webkit-transform: translate3d(75%, 0, 0);
			-moz-transform: translate3d(75%, 0, 0);
			-ms-transform: translate3d(75%, 0, 0);
			-o-transform: translate3d(75%, 0, 0);
			transform: translate3d(25%, 0, 0);
		}
	}

	@-moz-keyframes drop-in-fade-out {
		0% {
			opacity: 0;
			visibility: visible;
			-webkit-transform: translate3d(0, -200%, 0);
			-moz-transform: translate3d(0, -200%, 0);
			-ms-transform: translate3d(0, -200%, 0);
			-o-transform: translate3d(0, -200%, 0);
			transform: translate3d(0, -200%, 0);
		}
		12% {
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		20% {
			opacity: 1;
		}
		70% {
			opacity: 1;
			visibility: visible;
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		80% {
			opacity: 0;
		}
		100% {
			visibility: hidden;
			-webkit-transform: translate3d(75%, 0, 0);
			-moz-transform: translate3d(75%, 0, 0);
			-ms-transform: translate3d(75%, 0, 0);
			-o-transform: translate3d(75%, 0, 0);
			transform: translate3d(25%, 0, 0);
		}
	}

	@-o-keyframes drop-in-fade-out {
		0% {
			opacity: 0;
			visibility: visible;
			-webkit-transform: translate3d(0, -200%, 0);
			-moz-transform: translate3d(0, -200%, 0);
			-ms-transform: translate3d(0, -200%, 0);
			-o-transform: translate3d(0, -200%, 0);
			transform: translate3d(0, -200%, 0);
		}
		12% {
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		20% {
			opacity: 1;
		}
		70% {
			opacity: 1;
			visibility: visible;
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		80% {
			opacity: 0;
		}
		100% {
			visibility: hidden;
			-webkit-transform: translate3d(75%, 0, 0);
			-moz-transform: translate3d(75%, 0, 0);
			-ms-transform: translate3d(75%, 0, 0);
			-o-transform: translate3d(75%, 0, 0);
			transform: translate3d(25%, 0, 0);
		}
	}

	@keyframes drop-in-fade-out {
		0% {
			opacity: 0;
			visibility: visible;
			-webkit-transform: translate3d(0, -200%, 0);
			-moz-transform: translate3d(0, -200%, 0);
			-ms-transform: translate3d(0, -200%, 0);
			-o-transform: translate3d(0, -200%, 0);
			transform: translate3d(0, -200%, 0);
		}
		12% {
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		20% {
			opacity: 1;
		}
		70% {
			opacity: 1;
			visibility: visible;
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
		80% {
			opacity: 0;
		}
		100% {
			visibility: hidden;
			-webkit-transform: translate3d(75%, 0, 0);
			-moz-transform: translate3d(75%, 0, 0);
			-ms-transform: translate3d(75%, 0, 0);
			-o-transform: translate3d(75%, 0, 0);
			transform: translate3d(25%, 0, 0);
		}
	}

	.animate--drop-in-fade-out {
		-webkit-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32, 1.75, .65, .91);
		-moz-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32, 1.75, .65, .91);
		-ms-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32, 1.75, .65, .91);
		-o-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32, 1.75, .65, .91);
		animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32, 1.75, .65, .91);
	}
	</style>
	<?php include 'footer.php';?>