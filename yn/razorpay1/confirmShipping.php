<? session_start();

include('site_header.php'); 



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
           window.location.href="confirmShipping.php";
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
    
    label input[type=radio] {
  transform: scale(1.5);
}
</style>

<div class="container">


<?


?>

    <form action="check_confirm.php" method="POST">
<input type="hidden" name="total_rental" value="<? echo trim($_POST['total_rental']);?>">


        <br><br>
        
        
        <?
        

        $sql = mysqli_query($con,"select * from shippingInfo where userid='".$userid."' group by type");
        $sql_result = mysqli_fetch_assoc($sql); 
        $num_count = mysqli_num_rows($sql);
        
        
        if($num_count>1){
        
        ?>
        
        
            <input type="submit" class="btn btn-dark" value="Proceed To Pay">
        
            
        <? }else{ ?>
        <p>Add Delivery and Pickup Address To Continue </p>
        <? }
        
        
        
        
        ?>
 
            <div class="row" style="margin:3% auto;"> 
    
        <div class="col-sm-6">
            <h4 class="mb-3">Choose Delivery Address</h4>
            <? $del_sql = mysqli_query($con,"select * from shippingInfo where type=0 and userid ='".$userid."'");
            while($del_sql_result = mysqli_fetch_assoc($del_sql)){ ?>
            
            <div class="card mb-3">
           <div class="card-body">
           
               <label class="btn btn-default" style="color:black;font-weight:700;"><input type="radio" name="delivery" value="<? echo $del_sql_result['id'];?>" class="mr-3" required><? echo $del_sql_result['person_name'];?></label>
            
                   
                   
                   
                   <p class="ml-4"><? echo $del_sql_result['person_contact'];?></p>
                   
                   <p class="ml-4">
                       <span><? echo $del_sql_result['address'] . ', ' . $del_sql_result['landmark']. ', ' . $del_sql_result['city'].', '.$del_sql_result['state'].', '.$del_sql_result['country'].', '.$del_sql_result['pincode'] ; ?></span>
                   </p>
              
               </div>
               </div>

               
                
            <? } ?>
            
            
            
        </div>

        <div class="col-sm-6">
            <h4 class="mb-3">Choose Pickup Address</h4>
            <? $pic_sql = mysqli_query($con,"select * from shippingInfo where type=1 and userid ='".$userid."'");
            while($pic_sql_result = mysqli_fetch_assoc($pic_sql)){ ?>
            <div class="card mb-3">
  <div class="card-body">
      <label class="btn btn-default" style="color:black;font-weight:700;">
          <input type="radio" name="pickup"  value="<? echo $pic_sql_result['id'];?>" class="mr-3" required><? echo $pic_sql_result['person_name'];?>
          </label>
                
                  
                   <p class="ml-4"><? echo $pic_sql_result['person_contact'];?></p>
                   
                   <p class="ml-4">
                       <span><? echo $pic_sql_result['address'] . ', ' . $pic_sql_result['landmark']. ', ' . $pic_sql_result['city'].', '.$pic_sql_result['state'].', '.$pic_sql_result['country'].', '.$pic_sql_result['pincode'] ; ?></span>
                   </p>
             
               </div>
               </div>

               
                
            <? } ?>
            
            
            
            
        </div>

        
    </div>
    
    
    </form>
    
    
    
    <div class="row form-group">



        <div class="col-sm-6 form-group">
            <a id="del" class="btn btn-success">Add + </a>
            <form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_del" id="del_form" style="display:none;" method="POST"></form>
        </div>
        
            
        <div class="col-sm-6 from-group">
            <a class="btn btn-success" id="pick">Add + </a>
            <form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_pick" id="pick_form" style="display:none;" method="POST"></form>
        </div>
    </div>

</div>



<script>

    $("#del").on('click',function(){
        var ht = '<div class="card m-3"><div class="card-body"><div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize;">';
            ht +=   '<div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><label for="">address</label><input type="text" name="address" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">city</label><input type="text" name="city" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">state</label><input type="text" name="state" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">country</label><input type="text" name="country" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="del_submit" class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" onclick="delcancel()">Cancel</a></div></div></div>';
            
            ht +=   '</div></div></div>';
            
            $("#del_form").html(ht);
            $("#del_form").css('display','block');
    });
    
     $("#pick").on('click',function(){
        var ht = '<div class="card m-3"><div class="card-body"><div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize;">';
            ht +=   '<div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><label for="">address</label><input type="text" name="address" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">city</label><input type="text" name="city" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">state</label><input type="text" name="state" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">country</label><input type="text" name="country" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="pick_submit" class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" onclick="pickcancel()">Cancel</a></div></div></div>';
            
            ht +=   '</div></div></div>';
            
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



<? include('../footer.php');?>