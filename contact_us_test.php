<?php include('header.php'); ?>


<title>Contact Us | Sri Shringarr </title>

<meta name="description" content="For any queries, Please Contact Us">


<section class="" style="background-image: url(static/images/site/grid_images/img-1.jpg);">
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(static/images/header.png);">
		<h2 class="l-text2 t-center">
			Contact Us
		</h2>
	</section><br>
		<div class="container">
			<div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38">
				<h5 class="m-text20 m-b-30 m-t-10 m-r-20">
					ENQUIRY 
				</h5>
				<form enctype="multipart/form-data" method="POST" action="send_mail_copy.php">
					
					<div class="row">
						<div class="col-sm-4">
							<span class="s-text15">
								<strong>Full Name</strong>
							</span>
							<div class="size1 bo4 m-b-12">
								<input type="text" class="sizefull s-text7 p-l-15 p-r-15" placeholder="Enter Full Name" name="userName" value="" required> 
							</div>
						</div>

						<div class="col-sm-4">
							<span class="s-text15">
								<strong>Email</strong>
							</span>
							<div class="size1 bo4 m-b-12">
								<input type="text" class="sizefull s-text7 p-l-15 p-r-15" placeholder="Enter email address" name="email" value="" required>
							</div>
						</div>

						<div class="col-sm-4">
							<span class="s-text15">
								<strong>Mobile</strong>
							</span>
							<div class="size1 bo4 m-b-12">
								<input type="text" class="sizefull s-text7 p-l-15 p-r-15" placeholder="Enter Mobile" name="userPhone" maxlength="10" value="" required>
							</div>
						</div>
						
						<div class="col-sm-12">
							<span class="s-text15">
								<strong>Subject</strong>
							</span>
							<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="userMsg" placeholder="Message" required></textarea>
						</div>
					</div>
				
					<div class="size1">
					    <br>
						<input class="btn btn-dark" type="submit" name="send_enquiry" value="Submit">
					</div>
				</form>	
			</div>
			<br><br>
		<br>
		<br>
	</div>


<?php include('footer.php'); ?>