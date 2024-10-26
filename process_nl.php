<? session_start();
include('config.php');
$name = $_REQUEST['name'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$created_at = date('Y-m-d h:i:s');

 $nodes='sendmailapi.sarmicrosystems.in/sscheckoutapi.php';

$check_sql = mysqli_query($con,"select * from newsl where email='".$email."' or mobile='".$mobile."'");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    echo 2;
}else{
    $sql = "insert into newsl(name,mobile,email,created_at) values('".$name."','".$mobile."','".$email."','".$created_at."')";
    if(mysqli_query($con,$sql)){
$insert_id = $con->insert_id;
        echo 1;
        $_SESSION['shownl']=1;


        $coupon_sql = mysqli_query($con,"select * from xircle_coupon where type='welcome'");
        $coupon_sql_result = mysqli_fetch_assoc($coupon_sql);

        $coupon = $coupon_sql_result['code'];



		$fetch_sql = mysqli_query($con,"select * from newsl where id='".$insert_id."'");
		$fetch_sql_result = mysqli_fetch_assoc($fetch_sql);
		$name = $fetch_sql_result['name'];



        $html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ccc" >
		<tbody >
		    <tr >
			<td align="center" valign="top" >

				<table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tbody ><tr >
						<td align="center" >
							<table width="640" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" >
								<tbody ><tr >
									<td style="width: 640px; min-width: 640px; font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; user-select: auto;">





										<table width="100%" border="0" cellspacing="0" cellpadding="0" >
											<tbody ><tr >
												<td style="padding: 20px 20px 0px; border-radius: 12px 12px 0px 0px; user-select: auto;">


                                             <table width="100%" cellspacing="0" cellpadding="0" style="opacity: 0.95; user-select: auto;">
                                                <tbody ><tr >
                                                    <td style="padding: 20px 20px 0px; border-radius: 12px 12px 0px 0px; user-select: auto;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >

                                                            <tbody ><tr >
                                                                <th width="145" style="font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; vertical-align: top; user-select: auto;">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                                                        <tbody ><tr >

                                                                            <td style="font-size: 0pt; line-height: 0pt; text-align: center; user-select: auto;"></td>


                                                                            <td style="font-family: Arial, sans-serif; font-size: 25px; line-height: 24px; text-align: left; color: rgb(14, 48, 73); padding-left: 10%; user-select: auto;" id="m_-9067825665392853875head">Thank you for renting from Sri Shringarr!</td>

                                                                        </tr>
                                                                    </tbody></table>
                                                                </th>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>

                                                    <td height="1" bgcolor="#ccc" style="font-size: 0pt; line-height: 0pt; text-align: left; user-select: auto;">&nbsp;</td>
                                                </tr>

                                                <tr >
                                                    <td style="padding: 20px 20px 5px; user-select: auto;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 6px solid rgb(14, 48, 73); padding: 20px; user-select: auto;">
                                                            <tbody ><tr >

                                                                <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 32px !important; user-select: auto;" id="m_-9067825665392853875body1">Hi '.$name.'</td>

                                                            </tr>
                                                            <tr >

                                                                <td style="font-family: Verdana; line-height: 28px; text-align: center; padding-bottom: 5px; color: rgb(14, 48, 73); font-style: italic; font-size: 20px !important; white-space: pre-line !important; user-select: auto;" id="m_-9067825665392853875body2">Here’s some love from us. Enjoy!
                                                                </td>


                                                            </tr>

                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
									</td>
								</tr>
								<tr ><td ><b >

								</b>
</td></tr><tr >
<td >

	<div >




<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tbody ><tr >
		<td style="padding: 20px 10px 0px 20px; user-select: auto;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
				<tbody ><tr >
					<td style="padding: 10px 9px 0px 0px; user-select: auto;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" >
							<tbody ><tr >
								<th width="400" style="font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; vertical-align: top; user-select: auto;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" >
										<tbody ><tr>

									<td style="color: rgb(0, 0, 0); font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 28px; line-height: 28px; text-align: left; border-top: 0px solid rgb(204, 204, 204); border-bottom: 0px solid rgb(204, 204, 204); border-left: 0px solid rgb(204, 204, 204); border-image: initial; padding: 0px; width: 1px; border-right: none; user-select: auto;">
									    									</td>
									<td style="color: rgb(0, 0, 0); font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 28px; line-height: 28px; text-align: left; border-top: 0px solid rgb(204, 204, 204); border-right: 0px solid rgb(204, 204, 204); border-bottom: 0px solid rgb(204, 204, 204); border-image: initial; padding: 0px; border-left: none; user-select: auto;">

										<div style="font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: center; user-select: auto;">Sri Shringarr</div>

										<h1 style="text-align:center;color:red;">
										    '.$coupon.'
										</h1>
										<div style="font-family: Verdana; line-height: 28px; text-align: center; padding-bottom: 5px; color: rgb(14, 48, 73); font-style: italic; font-size: 20px !important; white-space: pre-line !important; user-select: auto;" id="m_-9067825665392853875body2">Coupon applicable on all orders above Rs. 5000/-
                                                                </div>

									</td>

										</tr>

									</tbody></table>
								</th>


							</tr>
						</tbody></table>
					</td>
				</tr>

			</tbody></table>
		</td>
	</tr>
		</tbody>
	<tbody >

	<tr>
<td style="padding: 0px 20px 20px; user-select: auto;">
	<table style="border: 1px solid rgb(204, 204, 204); user-select: auto;" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody ><tr >
			<td style="padding: 0px; user-select: auto;">
				<table style="border: 1px solid rgb(204, 204, 204); user-select: auto;" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody ><tr >
						<th width="400" style="font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; vertical-align: top; width: 100%; user-select: auto;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tbody ><tr >


                            <td style="color: rgb(0, 0, 0); font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 18px; line-height: 20px; text-align: left; border: 0px solid rgb(204, 204, 204); padding: 10px; user-select: auto;">
                                <strong style="font-style: normal; font-weight: 600; font-size: 15px; line-height: 1.5; color: rgb(73, 80, 87); user-select: auto;">Dont Repeat It, Rent It. Exclusive Designer Lehenga Choli, Jewellery, Bridal Lehengas, Evening Gowns, Indo-Western on Hire. Click now for an ultimate renting</strong></td>


						<td style="color: rgb(0, 0, 0); font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 20px; border: 0px solid rgb(204, 204, 204); height: auto; width: 20%; padding-top: 15px; margin-right: 5px; padding-bottom: 10px; user-select: auto;">


					<a href="https://f77whdye.r.us-east-1.awstrack.me/L0/https:%2F%2Fwww.srishringarr.com%2F/1/01000179b34d80ee-07fee3e3-1a79-4865-8b4e-891b82119531-000000/EDS4Soook2RTnzrj0_FDCj43RIU=216" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://f77whdye.r.us-east-1.awstrack.me/L0/https:%252F%252Fwww.srishringarr.com%252F/1/01000179b34d80ee-07fee3e3-1a79-4865-8b4e-891b82119531-000000/EDS4Soook2RTnzrj0_FDCj43RIU%3D216&amp;source=gmail&amp;ust=1622297293220000&amp;usg=AFQjCNGfqaIBwNp8XwL7pUGZWDggkJJBng" >
					<button style="font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(42, 139, 249); background-repeat: no-repeat; border: 1px solid rgb(42, 139, 249); overflow: hidden; color: rgb(255, 255, 255); font-size: 14px; padding: 4px 12px; border-radius: 3px; user-select: auto;">Shop Now</button></a>
                    </td>
				</tr>

			</tbody></table>
		</th>

							</tr>
							<tr ><td style="padding-bottom: 5px; user-select: auto;">
								<a href="https://f77whdye.r.us-east-1.awstrack.me/L0/https:%2F%2Fwww.xircls.com%2Fmerchant%2Foutlets%2Ftandc%2F1711/1/01000179b34d80ee-07fee3e3-1a79-4865-8b4e-891b82119531-000000/RhbZJjv2CoRhybGOYMHCFye66lw=216" style="color: rgb(255, 255, 255); user-select: auto;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://f77whdye.r.us-east-1.awstrack.me/L0/https:%252F%252Fwww.xircls.com%252Fmerchant%252Foutlets%252Ftandc%252F1711/1/01000179b34d80ee-07fee3e3-1a79-4865-8b4e-891b82119531-000000/RhbZJjv2CoRhybGOYMHCFye66lw%3D216&amp;source=gmail&amp;ust=1622297293220000&amp;usg=AFQjCNFahdPwOCSYLjceXOWf-noeg4Ffxw"><span style="font-size: 8px; margin-left: 10px; color: rgb(80, 80, 80); user-select: auto;"> Terms &amp; Conditions </span> </a>
							</td>
						</tr></tbody></table>
					</td>
				</tr>

			</tbody></table>
		</td>
	</tr>
	<tr >
		<td height="10" bgcolor="#ccc" style="font-size: 0pt; line-height: 0pt; text-align: left; user-select: auto;">&nbsp;</td>
	</tr>

</tbody></table>
	</div>
</td>
</tr>

</td>
					</tr>
				</tbody></table>

			</td>
		</tr>
	</tbody></table>
</td></tr></tbody></table>' ;

    // $headers='';
    // $headers .= "Reply-To: The Sender sales@srishringarr.com\r\n";
    // $headers .= "Return-Path: The Sender sales@srishringarr.com\r\n";
    // $headers .= "From: Srishringarr Fashion Studio <sales@srishringarr.com>" ."\r\n" .
    // $headers .= "Organization: Sender Organization\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html; charset=utf-8\r\n";
    // $headers .= "X-Priority: 3\r\n";
    // $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;


    // if(mail($email, "Welcome Coupon From Srishringarr", $html, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"')){


    //     mail('rajanipodar@gmail.com', "Welcome Coupon From Srishringarr", $html, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
    //     mail('vishwaaniruddh@gmail.com', "Welcome Coupon From Srishringarr", $html, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
    // }
    
     $subject = 'Welcome Coupon From Srishringarr';
    
        $data = array(
        'subject' => $subject,
        'to' => $email,
        'message' => $html,
        );
        
        
        $ch = curl_init($nodes);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        // execute!
        $response = curl_exec($ch);
        
        // close the connection, release resources used
        curl_close($ch);
        
        // do anything you want with your response
        // var_dump($response);



    }else{
        echo 0;
    }
} ?>