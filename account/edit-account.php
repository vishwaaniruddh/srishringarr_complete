<?php
include_once('site_header.php'); 


?>

<div class="" style="margin:5%;">
	    <div class="woocommerce"></div>
	    <div id="primary" class="content-area">
		    <main id="main" class="site-main" role="main">

                <article id="post-9" class="post-9 page type-page status-publish hentry">
			        <div class="entry-content">
			            <div class="row">
                            <? include('woo-menu.php');
                            
                            echo 'ds' ;
                            var_dump($_SESSION)
                            ;
                            ?>

                            <?
                            if(isset($_SESSION['email'])){ ?>
                            
                            <?php

                            $sql=mysqli_query($conn,"select * from Registration where registration_id='".$userid."'");

                            $sql_result=mysqli_fetch_assoc($sql); ?>
                            <div class="col-sm-8">
	                           <div class="woocommerce-notices-wrapper"></div>
	                           <form method="POST" action="edit_account_process.php">
	                               <input type="hidden" name="city" value"" id="city">
	                               <input type="hidden" name="state" id="state" value="">
		                        <h3>Billing Address</h3>
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
                                                        $sql=mysqli_query($conn,"select * from states order by state_name"); 
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
                                        
                                        <div class="form-group"> 
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
                                                    
                                                    var id = $(this).children(":selected").attr("id");
                                                    $("#state").val(id);
                                                    if(id){
                                                        $.ajax({
                                                            type: "POST",
                                                            url: 'get_cities.php',
                                                            data: 'state='+id,
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


		</div>
	
	<? include('footer.php');?>