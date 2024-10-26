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
                        <h1 style="text-align:center">Shipping Policy</h1>
                    </div>
            <div class="shopify-policy__body">
                <div class="container">

                    <div class="row">
                        <div class="center">
                        <div class="card">
                            <div class="col-md-12" >
                                <div class="rte" >
                                    <span>
                                        We are committed to delivering your order accurately, in good condition, and always on time. Below are some more shipping related points:
                                    </span>
                                    <ul>
                                        <li>
                                            <span>
                                                User has to be present at the agreed date and time at the specified address given while placing an order on our website.
                                            </span>
                                            <br>
                                            <span>
                                                Free Shipping is available Pan – India. <br> The shipping charges for outside India will be communicated to you at the time of order processing.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                Each order would be shipped only to a single destination address specified at the time of payment for that order. If you wish to ship products to different addresses, you shall need to place multiple orders.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                We make our best efforts to ensure that each item in your order is shipped out within 7-8 working days of the order date. However in some cases, it may take longer to ship the order if there is a heavy demand.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                We ship out orders on all week days (Tuesday to Saturday), excluding public holidays.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                To ensure that your order reaches you in the fastest time and in good condition, we will only make shipments through reputed courier agencies.
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                While we strive to ship all items in your order together, this may not always be possible due to product characteristics, or availability.
                                            </span>
                                        </li>
                                    </ul>
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