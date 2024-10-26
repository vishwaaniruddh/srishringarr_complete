<? session_start();
include('functions.php');

$buyer_id = $_POST['buyer_id'];

$sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$buyer_id."'");

$sql_result = mysqli_fetch_assoc($sql);

$id = $sql_result['buyer_executive'];


echo "

<div id='buyer_information'>
<h2 style='color:white;text-align:center;'>Buyer Information</h2>
    <label>Buyer_vertical</label> 
    <span>".get_cust_vertical_name($sql_result['buyer_vertical'])."</span>
    
    <br>
        <label>Name</label> 
    <span>".$sql_result['buyer_name']."</span>
    <br>
        <label>buyer_segment</label> 
    <span>".get_end_user_name($sql_result['buyer_segment'])."</span>
    <br>
        <label>City</label> 
    <span>".$sql_result['buyer_city']."</span>
    <br>
        <label>Address</label> 
    <span>".$sql_result['buyer_address']."</span>
    <br>
        <label>State</label> 
    <span>".get_state_name($sql_result['buyer_state'])."</span>
    <br>
            <label>Branch</label> 
    <span>".get_branch_name($sql_result['avo_branch'])."</span>
    <br>
            <label>Pincode</label> 
    <span>".$sql_result['buyer_pin']."</span>
    <br>
      <label>GST</label> 
    <span>".$sql_result['buyer_gst']."</span>
    <br>
      <label>Executive</label> 
    <span>".get_sales_team('exe_name',$id)."</span>
    <br>
    <label>Contact</label> 
    <span>".$sql_result['buyer_contact']."</span>
    <br>
    <label>Designation</label> 
    <span>".$sql_result['buyer_designation']."</span>
    <br>
       <label>Mail</label> 
    <span>".$sql_result['buyer_mail']."</span>
    <br>
</div>";

$_SESSION['branchid'] = $sql_result['avo_branch'];
?>