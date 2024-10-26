<?php session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include_once('site_header.php'); 

$userid = $_SESSION['gid'];



if(isset($_POST['edit_submit']) && $_GET['action']=='edit_del'){

$id = $_GET['id'];    
$person_name = $_POST['person_name'];
$person_contact = $_POST['person_contact'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$pincode = $_POST['pincode'];


 $sql = "update shippingInfo set person_name = '".$person_name."',person_contact = '".$person_contact."',address = '".$address."',landmark = '".$landmark."',city = '".$city."',state = '".$state."',country = '".$country."',pincode = '".$pincode."' where id='".$id."'";

    if(mysqli_query($con,$sql)){ ?>
       <script>
           alert(' Shipping Updated ! ');
           window.location.href="shipping-address.php";
       </script> 
    <? }
}



?>




	
	<? if(isset($_SESSION['email'])){ ?>
	

	    

		<div style="margin:5%;">
			<div class="woocommerce"></div>
	        <div id="primary" class="content-area">
		        <main id="main" class="site-main" role="main">
                    <article id="post-9" class="post-9 page type-page status-publish hentry"> 
			            <div class="entry-content">
			                
			                <div class="row">
                                <? include('woo-menu.php');?>
                                <div class="col-sm-8">
                                <?
                            $created_at = date('Y-m-d h:i:s');
                            
                            if(isset($_POST['del_submit']) && $_GET['action']=='add_del'){
                            $person_name = $_POST['person_name'];
                            $person_contact = $_POST['person_contact'];
                            $address = $_POST['address'];
                            $landmark = $_POST['landmark'];
                            $city = $_POST['city'];
                            $state = $_POST['state'];
                            $country = $_POST['country'];
                            $pincode = $_POST['pincode'];


$sql = "insert into shippingInfo(userid,person_name,person_contact,address,landmark,city,state,country,pincode,type,status,created_at,created_by) values('".$userid."','".$person_name."','".$person_contact."','".$address."','".$landmark."','".$city."','".$state."','".$country."','".$pincode."','0','1','".$created_at."','".$userid."')" ;

    if(mysqli_query($con,$sql)){ ?>
       <script>
           alert('Shipping added');
           window.location.href="shipping-address.php";
       </script> 
    <? }
}


if(isset($_POST['pick_submit']) && $_GET['action']=='add_pick'){
    
 $person_name = $_POST['person_name'];
$person_contact = $_POST['person_contact'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$pincode = $_POST['pincode'];


$sql = "insert into shippingInfo(userid,person_name,person_contact,address,landmark,city,state,country,pincode,type,status,created_at,created_by) values('".$userid."','".$person_name."','".$person_contact."','".$address."','".$landmark."','".$city."','".$state."','".$country."','".$pincode."','1','1','".$created_at."','".$userid."')" ;

    if(mysqli_query($con,$sql)){ ?>
       <script>
           alert('Shipping added');
           window.location.href="confirmShipping.php";
       </script> 
    <? }
}



?>

<style>
input {
    border: 1px solid #d8d9da !important;
}

input, button {
    border: none;
    background: none;
    outline: none;
}

.btn-success, .btn-danger,.btn-dark {
    color: #fff !important;
}
    .chooseShipping{
        padding: 10px;
    border: 1px solid #afa8a8;
        margin: 20px auto;
    }
    

.modal-dialog {
    max-width: 1200px;
    margin: 30px auto;
}
</style>

<div class="container">


        <br><br>
        
        
     
    <div class="row" style="margin:3% auto;"> 
        <div class="col-sm-6">
        
        
            <h4> Delivery Address</h4>
            <? $del_sql = mysqli_query($con,"select * from shippingInfo where type=0 and userid ='".$userid."'");
            while($del_sql_result = mysqli_fetch_assoc($del_sql)){ ?>
               
               <div class="row chooseShipping">
                   <div class="col-sm-12">
                   <span><? echo $del_sql_result['person_name'];?></span>
                   <br>
                   </div>
                   <p><? echo $del_sql_result['person_contact'];?></p>
                   
                   <p>
                       <span><? echo $del_sql_result['address'] . ', ' . $del_sql_result['landmark']. ', ' . $del_sql_result['city'].', '.$del_sql_result['state'].', '.$del_sql_result['country'].', '.$del_sql_result['pincode'] ; ?></span>
                   </p>
                   
                   <a this data-toggle="modal" data-status="<? echo $del_sql_result['id']; ?>" data-id="<? echo $del_sql_result['id']; ?>" class="open-DetailDialog btn btn-dark" href="#myModalDetail">Details</a>
                   
               </div>

               

            <? } ?>
                        <a id="del" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add + </a>                
            
            
        </div>

        <div class="col-sm-6">
            <h4> Pickup Address</h4>
            <? $pic_sql = mysqli_query($con,"select * from shippingInfo where type=1 and userid ='".$userid."'");
            while($pic_sql_result = mysqli_fetch_assoc($pic_sql)){ ?>
            
                <div class="row chooseShipping">
                   <div class="col-sm-12">

                   <span><? echo $pic_sql_result['person_name'];?></span>
                   <br>
                   </div>
                   <p><? echo $pic_sql_result['person_contact'];?></p>
                   <p>
                       <span><? echo $pic_sql_result['address'] . ', ' . $pic_sql_result['landmark']. ', ' . $pic_sql_result['city'].', '.$pic_sql_result['state'].', '.$pic_sql_result['country'].', '.$pic_sql_result['pincode'] ; ?></span>
                   </p>
                   
                   <a this data-toggle="modal" data-status="<? echo $pic_sql_result['id']; ?>" data-id="<? echo $pic_sql_result['id']; ?>" class="open-DetailDialog btn btn-dark" href="#myModalDetail">Details</a>
                   
                   
               </div>


                      
            <? } ?>
            <a class="btn btn-danger" id="pick" data-toggle="modal" data-target="#myModal">Add + </a>      
        </div>

    </div>
    
    
    
    
    




















<!-- large modal -->
<div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
            <div class="card-block" id="result_status" style=" overflow: auto;">
              
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>





<!-- large modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
                <div class="row">
                    <form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_del" id="del_form" style="display:none;" method="POST"></form>
                    <form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_pick" id="pick_form" style="display:none;" method="POST"></form>
                </div>
    
    
    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>









<script>

$(document).on("click", ".open-DetailDialog", function () {
     var reqId = $(this).data('id');
     var reqStatus = $(this).data('status');
     $.ajax({
        type: "GET",
        url: "edit_add.php?id="+reqId,
        dataType: "html",             
        success: function(response){
            $(".modal-body #result_status").html(response);
        }
     });

});



    $("#del").on('click',function(){
        var ht = '<div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize; padding: 20px;">';
            ht +=   '<div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><label for="">address</label><input type="text" name="address" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">city</label><input type="text" name="city" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">state</label><input type="text" name="state" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">country</label><input type="text" name="country" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="del_submit" class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" data-dismiss="modal">Cancel</a></div></div></div>';
            
            ht +=   '</div>';
            $("#pick_form").html('');
            $("#del_form").html(ht);
            $("#del_form").css('display','block');
    });
    
     $("#pick").on('click',function(){
        var ht = '<div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize; padding: 20px;">';
            ht +=   '<div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><label for="">address</label><input type="text" name="address" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">city</label><input type="text" name="city" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">state</label><input type="text" name="state" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">country</label><input type="text" name="country" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="pick_submit" class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" data-dismiss="modal">Cancel</a></div></div></div>';
            
            ht +=   '</div>';
            
        
            $("#del_form").html('');
            
            $("#pick_form").html(ht);
            $("#pick_form").css('display','block');
    });
    
    
    function pickcancel(){
        $("#pick_form").html('');
    }
    
    function delcancel(){
        $("#del_form").html('');
    }
    
</script>


                                </div>
                                
                            </div>
                        </div>
                    </article>
                </main>
                                
            </div>                    
    </div>
                                <? } ?>
                                
                                <? include('footer.php');?>