<? include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$id = $_REQUEST['id'];

$sql = mysqli_query($con,"select * from shippingInfo where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$person_name = $sql_result['person_name'];
$person_contact = $sql_result['person_contact'];
$address = $sql_result['address'];
$landmark = $sql_result['landmark'];
$city = $sql_result['city'];
$state = $sql_result['state'];
$country = $sql_result['country'];
$pincode = $sql_result['pincode'];


?>

<form action="shipping-address.php?action=edit_del&&id=<? echo $id; ?>" method="POST">

    <div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize; padding: 10px;">
        <div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" value="<? echo $person_name?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" value="<? echo $person_contact?>" class="form-control" required></div>
        <div class="col-sm-12"><label for="">address</label><input type="text" name="address" value="<? echo $address?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" value="<? echo $landmark?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">city</label><input type="text" name="city" value="<? echo $city?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">state</label><input type="text" name="state" value="<? echo $state?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">country</label><input type="text" name="country" value="<? echo $country?>" class="form-control" required></div>
        <div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" value="<? echo $pincode?>" class="form-control" required></div>
        <div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="edit_submit"  class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" data-dismiss="modal">Cancel</a></div></div></div>
    
    </div>

</form>