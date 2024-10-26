<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
		
include('config.php');
include('template_clinic.php');


?>

<!--MAIN CONTENT STARTS HERE-->
<div class="main_content">
    
    
    	<div class="container">
        
			<div class="left_content">
				<!--<h3>HOW WELL WE TAKE CARE </h3>
				<p><font ><strong>Take Care</strong></font> Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
				laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
				eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<h5>Our areas of specialty include, but are not limited to:</h5>-->
				<ul class="list_boxes">
						<ul class="list">
                        
                               <ul class="items">
                                    <li><a href="logout.php">Logout</a></li>
                                    
                                </ul>
                               
							<li class="list_heading">
								<img src="ddmenu/homipa.gif" height="400" width="400" alt="" />
								<!--<h4> Lorem<br/> ipsum dolor </h4>-->
							</li>
                                
						</ul>						
					</ul>                        
				<!--<p> Since 2005, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore 
				et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
				Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
				 cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
				totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
				 Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
				 Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et 
				 dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea 
				 commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, 
				 vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
				</p>-->
		   </div>
			<!--<div class="sidebar">
				<img src="images/main_right_image.png" alt=""/>
				<form id="contactus_form">
					<h3> Contact Us </h3>
					<label>Full Name<font color="#FF0000">*</font></label>
					<input type="text" value="" />
					<label>Business Name<font color="#FF0000">*</font></label>
					<input type="text" value="" />
					<label>E-mail Address<font color="#FF0000">*</font></label>
					<input type="text" value="" />
					<label>Phone Number<font color="#FF0000">*</font></label>
					<input type="text" value="" />
					<label>Business Website</label>
					<input type="text" value="" />
					<input class="medium_textbox" type="text" value="" />
					<img src="images/cap.png" alt=""/>
					<input class="send" type="submit" value="Send  " />
					<p>Fields marked with <font color="#FF0000">*</font> are mandatory</p>
				</form>
			</div>-->
		</div>
</div>
    
    
    
    

</body>
</html>








