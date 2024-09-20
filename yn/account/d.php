<? session_start();

// var_dump($_SESSION);
include_once('site_header.php'); 

$userid=$_SESSION['gid'];

?>

<style> 
	.site-content {
    outline: none;  
}

.site-content, .header-widget-region {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
@media (max-width: 66.4989378333em) {
.col-full {
    margin-left: 2.617924em;
    margin-right: 2.617924em;
    padding: 0;
}
}

table {
    border-spacing: 0;
    width: 100%;
    border-collapse: separate;
}

@media (min-width: 768px){
    
    .woocommerce-MyAccount-content {
    width: 76.4705882353%;
    float: right;
    margin-right: 0;
}

table.my_account_orders {
    font-size: 0.875em;
}
table.shop_table_responsive thead {
    display: table-header-group;
}


.col-full {
    max-width: 66.4989378333em;
    margin-left: auto;
    margin-right: auto;
    padding: 0 2.617924em;
    box-sizing: content-box;
}

 .widget-area {
    margin-bottom: 2.617924em;
}

.content-area {
    width: 100%;
    float: left;
 
}

.woocommerce-MyAccount-navigation {
    width: 17.6470588235%;
    float: left;
    margin-right: 5.8823529412%;
}

.woocommerce-MyAccount-content {
    width: 76.4705882353%;
    float: right;
    margin-right: 0;
}

table.shop_table_responsive tr td {
    display: table-cell;
}

table.shop_table_responsive tbody tr td, table.shop_table_responsive tbody tr th {
    text-align: left;
}

}

table:not( .has-background ) th {
    background-color: #000000;
}

table thead th,td {
    padding: 1.41575em;
    vertical-align: middle;
}
table th, table tbody td, #payment .payment_methods li, #comments .comment-list .comment-content .comment-text, #payment .payment_methods > li .payment_box, #payment .place-order {
    background: #f8f8f8!important;
}
table th {
    font-weight: 600;
}

table thead th {
    padding: 1.41575em;
    vertical-align: middle;
}

p {
    margin: 0 0 1.41575em;
}	

.hentry .entry-content .woocommerce-MyAccount-navigation ul {
    margin-left: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

ul {
    list-style: disc;
}
ul, ol {
    margin: 0 0 1.41575em 3em;
    padding: 0;
}

.hentry .entry-content .woocommerce-MyAccount-navigation ul li {
    list-style: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
}
a {
    color: #227504;
        /*font-weight: 600;*/
}
.hentry .entry-content .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link a {
    text-decoration: none;
    padding: 0.875em 0;
    display: block;
}	
.site-main {
    margin-bottom: 2.617924em;
}

.hentry {
    /*border-bottom: 1px solid #ededed;*/
    margin: 0 0 4.235801032em;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
#content{
        margin: 3% auto;
}

.login{
    color:white;
}


.woocommerce-MyAccount-content .form-row-first {
    width: 38.4615384615%;
    float: left;
    margin-right: 7.6923076923%;
}
.form-row-first {
    width: 47.0588235294%;
    float: left;
    margin-right: 5.8823529412%;
    clear: both;
}
p {
    margin: 0 0 1.41575em;
        margin-right: 0px;
}

.form-row input, .form-row textarea, .form-row select {
    width: 100%;
}
input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text {
    border: 1px solid 
    #ededed;
    box-shadow: none;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
input[type="text"], input[type="number"], input[type="email"], input[type="tel"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text {
    padding: 0.6180469716em;
    background-color: 
#f2f2f2;
color:
    #43454b;
    border: 0;
    -webkit-appearance: none;
    box-sizing: border-box;
    font-weight: normal;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.125);
}

.woocommerce-MyAccount-content .form-row-last {
    width: 53.8461538462%;
    float: right;
    margin-right: 0;
}
.form-row-last {
    width: 47.0588235294%;
    float: right;
    margin-right: 0;
}
.form-row-last {
    margin-right: 0 !important;
}

</style>

<div id="content" class="site-content" tabindex="-1">
	<div class="container">
	    <div class="woocommerce"></div>
	    <div id="primary" class="content-area">
		    <main id="main" class="site-main" role="main">

                <article id="post-9" class="post-9 page type-page status-publish hentry">
			        <div class="entry-content">
			            <div class="row woocommerce">
                            <nav class="woocommerce-MyAccount-navigation">
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

                            <?
                            if(isset($_SESSION['email'])){ ?>
                            
                            <?php

                            $sql=mysqli_query($conn,"select * from Registration where registration_id='".$_SESSION['gid']."'");

                            $sql_result=mysqli_fetch_assoc($sql); ?>
                            <div class="woocommerce-MyAccount-content">
	                           <div class="woocommerce-notices-wrapper"></div>
	                           <form method="POST" action="edit_account_process.php">
	                               <input type="hidden" name="city" value"" id="city">
	                               <input type="hidden" name="state" id="state" value="">
		                        <h3>Billing address</h3>
                        		<?
                        		$_SESSION['referer'] =  $_SERVER['HTTP_REFERER'];
                                // 		echo $_SESSION['referer'];
                        		?>
                                
		                        
		                        <div class="woocommerce-address-fields">
			                        <div class="woocommerce-address-fields__field-wrapper">
			                            <div class="form-group"> 

        	                                    <label for="billing_first_name" class="">First name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                            	 <input type="text" class="input-text form-control " name="billing_first_name" id="billing_first_name" placeholder="" value="<? echo $sql_result['Firstname']?>" autocomplete="given-name">
	                                    </div>
	                                    
	                                    <div class="form-group"> 
    	                                
    	                                        <label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>

    	                                            <input type="text" class="input-text form-control" name="billing_last_name" id="billing_last_name" placeholder="" value="<? echo $sql_result['Lastname'];?>" autocomplete="family-name">
    	                                </div>
	                                    
	                                    <div class="form-group"> 
    	                                        <label for="billing_country" class="">Country&nbsp;<abbr class="required" title="required">*</abbr>	</label>
    	                                    <select name="billing_country" id="billing_country" class="country_to_state country_select  form-control" autocomplete="country" tabindex="-1" aria-hidden="true" required>
                                                    	<option value="">Select a country…</option>
                                                    	<option value="IN" selected="selected">India</option>
                                        	</select>
                                        </div>
                                        
                                        <div class="form-group"> 
                                            
                                                <label for="billing_address_1" class="">Street address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                            	<textarea class="form-control" style="height: 100px;" name="billing_address_1" id="billing_address_1" placeholder="House number and street name"><?php echo $sql_result['address'];?></textarea>
                                    	</div>
                                    	
                                    	<div class="form-group"> 
                                    	
                                            	<label for="billing_address_1" class="">Landmark<abbr class="required" title="required">*</abbr> </label>
                                            	    <input type="text" class="input-text form-control" name="landmark" id="landmark" placeholder="House number and street name" value="<? echo $sql_result['landmark'];?>" autocomplete="address-line1" data-placeholder="House number and street name">
                                        </div>
                                        <div class="form-group"> 
        	                                     <label for="billing_state" class="">State&nbsp;<abbr class="required" title="required">*</abbr> </label>
    	                                            <select name="state_code" id="state_code" class="state_select form-control">
        	    		                                <option value="">Select an option…</option>
                                                        <?php
                                                        $sql=mysqli_query($conn,"select * from states"); 
                                                        while($sql_result1=mysqli_fetch_assoc($sql)){ ?>
                                                            <option id="<?php echo $sql_result1['state_code']?>" value="<? echo $sql_result1['state_code']?>"><? echo $sql_result1['state_name']?></option>
                                                        <?php } ?>
        	                                        </select>
                                            	    <?php
                                                	$sql=mysqli_query($conn,"select * from Registration where registration_id='".$userid."'");
                                                	
                                                	$sql_result=mysqli_fetch_assoc($sql);
                                                	$state = $sql_result['state'];
                                                	$city_id = $sql_result['city'];
                                                	$state_name = get_state_name($state);
                                                	$city_name = get_city_name($city_id);
                                                	?>
    	
                                                    <script>    
                                                    $("select#state_code option").each(function(){
                                                        if ($(this).text() == "<?php echo $state_name;?>")
                                                            $(this).attr("selected","selected");
                                                    });
                                                    </script>
    
                                                	<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                                                    	<span class="selection">
                                                    	    <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-billing_state-container" role="combobox">
                                                    
                                                        	    <span class="select2-selection__arrow" role="presentation">
                                                        	        <b role="presentation">	</b>
                                                        	    </span>
                                                    	    </span>
                                                    	</span>
                                                    	<span class="dropdown-wrapper" aria-hidden="true"> </span>
                                                	</span>
                                    	       
                                        </div>
                                        
                                        <div class="form-group" id="city"> 
                                        	<label for="billing_state" class="">City&nbsp;<abbr class="required" title="required">*</abbr>
                                        	</label> 
                                        	    <select name="billing_city" id="billing_city" class="state_select form-control" required>
                                                <?php
                                                if($city_id){ ?>
                                                    <option value="">Select an option…</option>
                                                	
                                                    <?php $sql=mysqli_query($conn,"select * from cities where state_code='".$state."'"); 
                                                    
                                                    while($sql_result1=mysqli_fetch_assoc($sql)){ ?>
                                                        <option value="<? echo $sql_result1['name']?>" id="<? echo $sql_result1['code']?>"><? echo $sql_result1['name']?></option>
                                                    <?php } ?>
                                                <?php }
                                                
                                                else{
                                                    
                                                }
                                                ?>
    	
    	                                   </select>
    	
                                            <script>  
                                                $("#state_code").change(function() {
                                                    console.log('change')
                                                    $( "#billing_city option" ).remove();
                                                    
                                                var id = $("#state_code").val();    
                                                    alert(id);
                                                    if(id){
                                                        $.ajax({
                                                            type: "POST",
                                                            url: 'get_cities.php',
                                                            data: 'state='+id,
                                                            success: function(msg){
                                                                
                                                                if(msg){
                                                                    var obj = JSON.parse(msg);
                                            
                                                                    for(i=0;i<msg.length;i++){
                                                                    
                                                                        $('#billing_city').append($('<option>', {
                                                
                                                                            text: obj[i]['name'],
                                                                            id:obj[i]['id']
                                                                        }
                                                                    ));
                                                                    }                                                                    
                                                                }else{
                                                                    var city = document.getElementById("billing_city");
                                                                    city.remove();
                                                                    $("#city").append('<input name="billing_city" class="form-control" type="text">'); 

                                                                }

                                                            }
                                                        });                   
                                                    }
                                                });
                                    
                                                $("select#billing_city option").each(function(){
                                                    
                                                  if ($(this).text() == "<?php echo $city_name;?>")
                                                    $(this).attr("selected","selected");
                                                });
                                                
                                                
                                                
                                                $("#billing_city").change(function() {
                                                    console.log('city')
                                                    //$( "#billing_city option" ).remove();
                                                    
                                                    var id = $(this).children(":selected").attr("id");
                                                    var state = $("#state_code").children(":selected").attr("id");
                                                    $("#city").val(id);
                                                    if(id){
                                                        $.ajax({
                                                            type: "POST",
                                                            url: 'get_cities.php',
                                                            data: 'state='+state,
                                                            success: function(msg){  
                                                                console.log(msg)
                                        
                                                                var obj = JSON.parse(msg);
                                        
                                                                for(i=0;i<msg.length;i++){
                                                                
                                                                    $('#billing_city').append($('<option>', {
                                            
                                                                        text: obj[i]['name'],
                                                                        id:obj[i]['id']
                                                                
                                                                    }
                                                                ));
                                                                }
                                                            }
                                                        });                   
                                                    }
                                                });
                                            </script>
                                            
                                        	<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                                            	<span class="selection">
                                                	<span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-billing_state-container" role="combobox">
                                                
                                                	<span class="select2-selection__arrow" role="presentation">
                                                    	<b role="presentation"></b>
                                                	</span>
                                                	</span>
                                            	</span>
                                            	<span class="dropdown-wrapper" aria-hidden="true">
                                            	</span>
                                        	</span>
                                        	
                                        </div>
                                        
                                        <div class="form-group"> 
                                        	<label for="billing_postcode" class="">Postcode / ZIP&nbsp;<abbr class="required" title="required">*</abbr></label>

                                        	    <input type="text" class="input-text form-control" name="billing_postcode" id="billing_postcode" placeholder="" value="<? echo $sql_result['pincode']?>" autocomplete="postal-code">
                                    	</div>
                                    	<div class="form-group"> 
                                            	<label for="billing_phone" class="">Phone&nbsp;<abbr class="required" title="required">*</abbr></label>
                                            	    <input type="tel" class="input-text form-control" name="billing_phone" id="billing_phone" placeholder="" value="<? echo $sql_result['Mobile']?>" autocomplete="tel">
                                        </div>
                                        
                                        <div class="form-group"> 
                                        		<label for="billing_email" class="">Email address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                            	    <input type="email" class="input-text form-control" name="billing_email" id="billing_email" placeholder="" value="<? echo $sql_result['email']?>" autocomplete="email username">
                                    	</div>
                                    </div>
                                    
                                    <div class="form-group">
                                      <label class="col-md-4 control-label"></label>
                                      <div class="col-md-4">
                                        <button type="submit" class="btn btn-warning" >submit <span class="glyphicon glyphicon-send"></span></button>
                                      </div>
                                    </div>
	
	                                    <!--<input type="submit"  class="btn btn-warning" name="submit" value="submit">-->
		                            </div>
	                           </form>
                            </div>
                            <?php }
                                else{        
                                    
                                    include_once('login_register.php'); ?>
                                <?php } ?>



                        </div>
					</div><!-- .entry-content -->
		</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->


		</div><!-- .col-full -->
	</div>