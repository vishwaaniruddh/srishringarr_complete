<?php
// include 'config.php';

$nodes = 'sendmailapi.sarmicrosystems.in/yncheckoutapi.php';
$to = 'hellbinderkumar@gmail.com';
$subject = 'test mail ';
$id = 526;
$firstname = 'hellbinder';



$link = '
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
	</head>
	<body>
		<div id="m_3716871841364271743wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tbody>
					<tr>
					<td align="center" valign="top">
						<div id="m_3716871841364271743template_header_image"></div>
							<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
								<tbody>
									<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_header" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
											<tbody>
												<tr>
													<td id="m_3716871841364271743header_wrapper" style="padding:36px 48px;display:block">
														<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff">
														Thank you for your order

														</h1>
															<h3>Your Order is successfully placed ! </h3>
														<span> The transaction id for your reference is  ' . $txnid . ' </span>
														</td>
												</tr>
											</tbody>
										</table>

									</td>
									</tr>

									<tr>
									<td align="center" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_body"><tbody><tr>
												<td valign="top" id="m_3716871841364271743body_content" style="background-color:#ffffff">

														<table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
														<td valign="top" style="padding:48px 48px 32px">
															<div id="m_3716871841364271743body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

																	<p style="margin:0 0 16px">Hi ' . $firstname . ',</p>
																	<p style="margin:0 0 16px">Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p><span class="im">


																	</span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
																		[Order #' . $id . '] (' . date('Y/m/d h:i:s') . ')</h2>

																	<div style="margin-bottom:40px">
																		<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
																	<thead><tr>
																					<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
																					<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																					<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																				</tr></thead>';

																				$sql = mysqli_query($con, "select * from order_details  where order_id='".$id."' and ac_typ ='2'");
        																		while ($sql_result = mysqli_fetch_assoc($sql)) {
        
        																			$product_id = $sql_result['product_id'];
        																			$type = $sql_result['product_type'];
        
        																			$name = get_sku($product_id, $type);
        
        																			$quantity = $sql_result['qty'];
        																			$product_amt = $sql_result['product_amt'];
        																			$image_url = $sql_result['image'];
        																			$deposit_date = $sql_result['deposite_date'];
        																			$return_date = $sql_result['return_dt'];
        																			$rent_date = $sql_result['rent_dt'];
        																			$link .= '<tbody>
        																				<tr>
        																					<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
        																						<img src="' . $image_url . '" width="30%">	' . $name . '		</td>
        																					<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
        																																' . $quantity . ' </td>
        																					<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
        																					<span><span>₹</span>' . $product_amt . '</span>		</td>
        																				</tr>
        
        																				</tbody>';
        
        																		}
																		$link .= '<tfoot>


																	<tr>
																	<th scope="row" colspan="5" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
																							<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>₹</span>' . $total_amount . '</span></td>
																						</tr>
																	</tfoot>
																	</table>
																	</div>

																	<p style="margin:0 0 16px">We look forward to fulfilling your order soon.</p>
																	<a href="https://yosshitaneha.com/checkout/Invoice.php?oid=' . $id . '" >Click here to View/download Bill</a>

																	<h3>Enjoy Unlimited Unique Fashion Products !<h3>
																	<p>Visit <b><a href="https://yosshitaneha.com/">YosshitaNeha</a></b></p>


																	<a style="border-radius:0px;font-size:16px;color:#fff;padding:11px 50px;max-width:500px;font-family:Atlas Grotesk,Open Sans,HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;border:0px solid #0061ff;text-align:center;text-decoration:none;font-weight:300;display:block;background-color:#0061ff" href="https://www.yosshitaneha.com/account/redirect.php?id=' . $userid . '" data-saferedirecturl="https://www.google.com/url?q=https://www.dropbox.com/l/AABWjooGQaWoHtoVAS-WNXojMuESi-3AWkk/transfer&amp;source=gmail&amp;ust=1599233688458000&amp;usg=AFQjCNFvNdMIywplnetehOofv4MityU2Kg">
																	View My Account
																	</a>


															</div>

														</td>
													</tr>
												</tbody>
											</table>

										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
			</tr>

			<tr>
			<td align="center" valign="top">

									<table border="0" cellpadding="10" cellspacing="0" width="600" id="m_3716871841364271743template_footer"><tbody><tr>
			<td valign="top" style="padding:0;border-radius:6px">
												<table border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr>
			<td colspan="5" valign="middle" id="m_3716871841364271743credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">

														</td>
													</tr></tbody></table>
			</td>
										</tr></tbody></table>

			</td>
							</tr>
			</tbody></table><div class="yj6qo"></div><div class="adL"></div>
		</div>

	</body>
</html>';

       $data = array(
        'subject' => $subject,
        'to' => $to,
        'message' => $link,
        );
    
    $ch = curl_init($nodes);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);



?>