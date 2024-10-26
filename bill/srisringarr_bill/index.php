<?php
session_start();
include ('../config.php');

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
  //Request hash
  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : ''; 
  if(strcasecmp($contentType, 'application/json') == 0){
    $data = json_decode(file_get_contents('php://input'));
    $hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
    $json=array();
    $json['success'] = $hash;
      echo json_encode($json);
  
  }
  exit(0);
}
 
function getCallbackUrl()
{
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

  	
	  if (isset($_GET['nights']) && isset($_GET['amount'])) {

    return $protocol.$_SERVER['HTTP_HOST'].'/PHP_Bolt-master/pay_response2.php';
      }
      else{
    return $protocol.$_SERVER['HTTP_HOST'].'/PHP_Bolt-master/pay_response1.php';

      }

  	




}

// var_dump($_SERVER['REQUEST_URI']);

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// echo $actual_link;
?>


  <?php

$url=$_SERVER['REQUEST_URI'];

$url_final = (explode('/en', $url));
// var_dump($url_final);
?>


<?php include_once($_SERVER['DOCUMENT_ROOT'].'/header_hindi1.php');?>



<style>
    .main{
            display: flex;
    justify-content: center;
    margin: 3% auto;
   text-align:center;
  font-family:Arial, Helvetica, sans-serif;
  padding:1%;

    }
form {
    border: 1px solid #f86c31;
    padding-top: 3%;
    padding-left: 3%;
    padding-right: 3%;
    padding-bottom: 3%;
}
    .main form .dv{
        display:flex;
        margin: 15px;
    }
    .text{
        width:40%;
        margin:auto;
        text-align:left;
    }
    .input{
        margin:auto;
    }
    .nights-details{
        display:flex;
    }
    .nights-count{
        width:50%;
    }
    .nights-amount{
        width:50%;
        
    }
    .input-group-field{
            font-size: 21px;
            width: inherit;
                /*padding: .375rem .75rem;*/
    font-size: 1rem;
    line-height: 1;
    color: #495057;
    background-color: #fff;
    text-align: center;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .circle{
        border-radius: 50%;
    }
    #showamount{
        background:#ed0505;color:white;width:50% !important;flex: none;font-size: 21px; margin:auto;
    }
    .pay-action{
            margin: 10% auto auto;
    }
    .pay-button{
        border-radius: 8px;
    font-size: large;
    width: 20%;
    margin: 0 auto;
    background-color: #f86c31;
    color: white;
    }
    label{
    margin-bottom: auto;
}
	input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

.total-amount{
        text-align: center;
    width: 50%;
    margin: auto;
    color: white;
    font-weight: 700;
    background: #e66830 ! important;
}

</style>

<?php

if(isset($_GET['nights']) && isset($_GET['amount'])){
    $nights=$_GET['nights'];
    $amount=$_GET['amount'];
    ?>
    <style>
    	.circle{
    		display: none;
    	}
    </style>
<?php 
}
else{
    $nights='1';
    $amount='50000';

}

?>


<div class="col-lg-4 conformation" style="margin:auto; padding-bottom: 0px;padding-top: 5em;">
        <!--<h2> Contribution Details </h2> -->
   </div>

<div class="main">
  <form action="#" id="payment_form" onsubmit="check(); return false;">
      <!--ekta--> 
      <p style="font-weight:500; font-size:35px; margin:0;">Contribution</p>
      <span style="font-size:18px">Summary</span>
       <!--<h6 >Membership Amount Rs. 50,000/- per night</h6><br><br>-->
        

<div class="nights-details">
          <div class="nights-count"><h6 class="">No. of Nights </h6>

          <button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:0; " class="button hollow circle" data-productinfo="minus" data-field="productinfo">
            
            <i class="fa" style="background: url(https://image.flaticon.com/icons/svg/149/149146.svg); height: 28px; width: 21px; background-repeat: no-repeat; outline:none;     vertical-align: middle;" aria-hidden="true"></i>
          </button>
                                    
          <?php if (isset($_GET['nights'])){ ?>
				<label for="" style="
    font-size: 21px;
"><?php echo $nights; ?></label>
          <?php }
          else { ?>

          <input class="input-group-field" type="text"  name="productinfo" style="font-size:21px;width: 20%; height: 35px; outline:none; "  value="<?php echo $nights;?>" readonly >


          
          <?php } ?>
          

            <button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:none; " class="button hollow circle" data-productinfo="plus" data-field="productinfo">
            <i class="fa " style="background: url(https://image.flaticon.com/icons/svg/149/149145.svg); height: 28px; width: 21px; background-repeat: no-repeat; outline:none;    vertical-align: middle;"  aria-hidden="true"></i><br>
          </button>
        </div>
          

            <div class="nights-amount">
              <h6>Total Amount</h6>
              <input class="form-control total-amount" type="text" name="amount" id="amount" value="<?php echo $amount; ?>" border="none" readonly>
                   </div>
            </div>



                    <!--ekta-->
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7"  />
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <div class="dv" style="display:none">
    <span class="text"><label>Merchant Key:</label></span>
    <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="kLDL5cIY" /></span>
    </div>
    
    <div class="dv" style="display:none">
    <span class="text"><label>Merchant Salt:</label></span>
    <span class="input"><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="nusDG6FdBw" /></span>
    </div>
    
    <div class="dv" style="display:none">
    <span class="text"><label>Transaction/Order ID:</label></span>
    <span class="input"><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
    </div>
   <!--ekta--> 
   <hr style="border:2px solid #f86c31;width:100%;">
   <!--end-->
  <!--   <div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span class="input"><input class="form-control" type="text" id="amount" name="amount" placeholder="Amount" value="<?php echo $amount; ?>" /></span>    
    </div> -->
    
    <div class="dv" style="display:none">
    <span class="text"><label>Product Info:</label></span>
    <span class="input">
    	<input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="<?php echo $nights; ?>" />
    </span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Full Name:</label></span>
    <span class="input"><input class="form-control" type="text" id="fname" name="fname" placeholder="Enter Your Full Name" value="" required/></span>
    </div>
    
  
    
    <!--<div class="dv">-->
    <!--<span class="text"><label>Email ID:</label></span>-->
    <!--<span class="input"><input class="form-control" type="text" id="email" name="email" placeholder="Email ID" value="" required/></span>-->
    <!--</div>-->
    
    <div class="dv">
    <span class="text"><label>Mobile Number:</label></span>
    <span class="input"><input class="form-control" type="number" id="mobile" name="mobile" placeholder="10 Digit Mobile Number" value=""  size="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number" maxlength = "10" minlength="10" required/></span>
    </div>
    
    <div class="dv" style="display:none">
    <span class="text"><label>Hash:</label></span>
    <span class="input"><input type="text" id="hash" name="hash" placeholder="Hash" value="" /></span>
    </div>
    
    
    <div class="pay-action">
        <input class="btn pay-button" name="submit" type="submit" value="Pay" onclick="launchBOLT(); return false;" />
    </div>
  </form>
</div>





<script type="text/javascript"><!--
$('#payment_form').bind('keyup blur', function(){
  $.ajax({
          url: 'index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
        salt: $('#salt').val(),
        txnid: $('#txnid').val(),
        amount: $('#amount').val(),
        pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
      email: $('#email').val(),
      mobile: $('#mobile').val(),
      udf5: $('#udf5').val()
          }),
      contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
       $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
      else if (json['success']) { 
        $('#hash').val(json['success']);
            }
          }
        }); 
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
  bolt.launch({
  key: $('#key').val(),
  txnid: $('#txnid').val(), 
  hash: $('#hash').val(),
  amount: $('#amount').val(),
  firstname: $('#fname').val(),
  email: $('#email').val(),
  phone: $('#mobile').val(),
  productinfo: $('#pinfo').val(),
  udf5: $('#udf5').val(),
  surl : $('#surl').val(),
  furl: $('#surl').val(),
  mode: 'dropout' 
},{ responseHandler: function(BOLT){
  console.log( BOLT.response.txnStatus );   
  if(BOLT.response.txnStatus != 'CANCEL')
  {
    //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
    var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
    '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
    '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
    '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
    '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
    '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
    '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
    '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
    '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
    '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
    '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
    '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
    '</form>';
    var form = jQuery(fr);
    jQuery('body').append(form);                
    form.submit();
  }
},
  catchException: function(BOLT){
    alert( BOLT.message );
  }
});
}
//--
</script> 


<script>
      function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
      
      
          jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-productinfo="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
            
              var currentValnew = parseInt($('input[name='+fieldName+']').val());
            // var amount =$("#showamount").val();
             var totalAmount =currentValnew*50000;
            $("#showamount").val("Rs. "+totalAmount);
              $("#amount").val(totalAmount);
            
            
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
    // This button will decrement the value till 0
    $('[data-productinfo="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
            
            
             var currentValnew = parseInt($('input[name='+fieldName+']').val());
           //  var amount =$("#showamount").val();
             var totalAmount =currentValnew*50000;
           $("#showamount").val("Rs. "+totalAmount);
              $("#amount").val(totalAmount);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
});



function check()
{

    if(mobile.value.length!=10){
     alert("Please Input Valid Mobile Number !");
    }
}

      </script>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/en/footer_english1.php'); ?>




