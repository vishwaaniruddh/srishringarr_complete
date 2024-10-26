<?php session_start();
include("access.php");
include('config.php');



function customer_vertical_id($name){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}


// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];


        if($_SESSION['designation']==5){
            
            $customer_qry = mysqli_query($con1,"select * from clienthandle where logid='".$_SESSION['logid']."'");
            
        }
        else{
            
            $customer_qry = mysqli_query($con1,"select * from customer");
            
            
        }
        

    
$branch_qry = mysqli_query($con1,"select * from avo_branch  ");
    
$state_qry = mysqli_query($con1,"select * from state ");

$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where status='1'");

$end_user = mysqli_query($con1,"select * from user_segment where status=1");
/*$user = mysqli_fetch_assoc($end_user);
var_dump($user);*/

if(isset($_GET['action']) && $_GET['action']=='edit'){
    $id = $_GET['id'];
    $edit_data =mysqli_query($con1,"select * from buyer where buyer_ID = ".$id);
    $edit_result  = mysqli_fetch_assoc($edit_data);
    
    $buyer_vertical = $edit_result['buyer_vertical'];
    $buyer_name = $edit_result['buyer_name'];
    $buyer_segment = $edit_result['buyer_segment'];
    $avo_branc = $edit_result['avo_branch'];
    $buyer_city = $edit_result['buyer_city'];
    $buyer_address = $edit_result['buyer_address'];
    $buyer_state = $edit_result['buyer_state'];
    $buyer_pin = $edit_result['buyer_pin'];
    $buyer_gst = $edit_result['buyer_gst'];
    $buyer_executive = $edit_result['buyer_executive'];
    $buyer_contact = $edit_result['buyer_contact'];
    $buyer_designation = $edit_result['buyer_designation'];
    $buyer_phone = $edit_result['buyer_phone'];
    $buyer_mail = $edit_result['buyer_mail'];
    $buyer_phone2 = $edit_result['buyer_phone2'];
    $status = $edit_result['status'];
} else {
    $id = 0;
    $customer_vertical = '';
    $buyer_name = '';
    $buyer_segment = '';
    $avo_branc = '';
    $buyer_city = '';
    $buyer_address = '';
    $buyer_state = '';
    $buyer_pin = '';
    $buyer_gst = '';
    $buyer_executive = '';
    $buyer_contact = '';
    $buyer_designation = '';
    $buyer_phone = '';
    $buyer_mail = '';
    $buyer_phone2 = '';
    $status = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<title>Edit Buyer</title>
</head>
<script type="text/javascript">
function validate1(){
var a=document.getElementById("form1");
//alert(a);
 with(a)
 {
    var numbers = /^[0-9]+$/;
    var namePattern = /^[A-Za-z()_ ]/;
    if(document.getElementById('state').value==0)
    {
    	alert("Please Select State");
    	document.getElementById('state').focus();
    	return;
    }
    if(document.getElementById('avo_branch').value==0)
    {
    	alert("Please Enter Branch Address");
    	document.getElementById('avo_branch').focus();
    	return;
    }
if(document.getElementById('city').value=='')
{
	alert("Please Enter City");
	document.getElementById('city').focus();
	return;
}
if(document.getElementById('pincode').value=='')
{
	alert("Please Enter Pincode");
	document.getElementById('pincode').focus();
	return;
}

if(document.getElementById('gst_no').value=='')
{
	alert("Please Enter GST Number");
	document.getElementById('gst_no').focus();
	return;
}

if(document.getElementById('buyer_name').value=='' || document.getElementByName('address').value=='')
{
alert("Give atleast one Name");
return;
}

document.getElementById("form1").action = "add_buyer_process.php?id=<?php echo $id;?>";
a.submit();
}
}
</script>
<body >
    <center>
        
        <?
        if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
        ?>


    <h2> <?php if(isset($_GET['action']) && $_GET['action']=='edit'){echo 'Edit';} else {echo 'New';}?> Buyer</h2>
    <div id="header">
        <form id="form1" method="post" action ="add_buyer_process.php?id=<?php echo $id;?>">
            <table>
                <tr>
                    <td><label for="customer_vertical">Customer Vertical &nbsp</label></td>
                    
                    
                    
                    
                    
                    
                    
                    <td>
                        <select id="customer_vertical" name="customer_vertical" id="customer_vertical"  required>
                            <option  value="">Select</option>
                            <?php
                        
                        
                                while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { 
                        
                                if($_SESSION['designation']==5){
                                
                                $cust_id = customer_vertical_id($customer_vertical['client']);
                                ?> 
                                    
                                    
                                    
                                   <option value= "<?php echo $cust_id ?>" <?php if($cust_id == $buyer_vertical) {echo 'selected';}?> > <?php echo $customer_vertical["client"];?></option>
                                   
                                <? }
                                else{ ?>
                                    
                                     <option value= "<?php echo $customer_vertical['cust_id']; ?>" <?php if($customer_vertical['cust_id']==$buyer_vertical) {echo 'selected';}?> > <?php echo $customer_vertical["cust_name"];?></option>


                                <? } ?>
                                   

                                <?php } ?>
                        </select>
                    </td>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </tr>
                <tr>
                    <td><label for="buyer_name">Buyer Name &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer Name" name="buyer_name" id="buyer_name" value="<?php echo $buyer_name;?>" required><br></td>
                </tr>
                <tr>
                    <td><label for="end_user">End user segment &nbsp</label></td>
                    <td>
                        <select id="end_user" name="end_user" required>
                            <option  value="">Select</option>
                            <?php //$end_user
                            while ($user = mysqli_fetch_assoc($end_user)) { var_dump($user);?>
                                <option value= "<?php echo $user["id"];?>"  <?php if($user['id']==$buyer_segment){echo 'selected';}?> ><?php echo $user["name"]; ?></option>;
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="city">City &nbsp</label></td>
                    <td><input type="text" placeholder="City" name="city" id="city" value="<?php echo $buyer_city;?>" required><br></td>
                </tr>
                <tr>
                    <td><label for="address">Address &nbsp</label></td>
                    <td><input type="text" placeholder="Address" name="address" id="address" value="<?php echo $buyer_address;?>" required></td>
                </tr>
                <tr>
                    <td><label for="state">State &nbsp</label></td>
                    <td>
                        <select id="state" name="state" required>
                            <option  value="">Select</option>
                            <?php
                            while ($state = mysqli_fetch_assoc($state_qry)) { ?>
                                <option value = "<?php echo $state['state_id'];?>" <?php if($state['state_id']==$buyer_state){echo 'selected';}?>> <?php echo $state["state"];?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> <label for="avo_branch">AVO Branch &nbsp</label></td>
                    <td>
                       <select id="avo_branch" name="avo_branch" required>
                            <option  value="">Select</option>
                            <?php
                            while ($avo_branch = mysqli_fetch_assoc($branch_qry)) { ?>
                              <option value = '<?php echo $avo_branch["id"]; ?>' <?php if($avo_branch['id']==$avo_branc){echo 'selected';}?> ><?php echo $avo_branch["name"]; ?> </option>
                            <?php } ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="pincode">Pincode &nbsp</label></td>
                    <td><input type="text" placeholder="Pincode" maxlength='6' name="pincode" id="pincode" value="<?php  echo $buyer_pin;?>" onkeypress="return onlyNumberKey(event)" required><br></td>
                </tr>
                <tr>
                    <td><label for="gst_no.">Buyer GST No. &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer GST No." name="gst_no" id="gst_no" maxlength="15" value="<?php echo $buyer_gst;?>" required><br></td>
                </tr>
                <tr>
                    <td><label for="executive_name">Sales Executive Name &nbsp</label></td>
                    <td>
                       <select id="executive_name" name="executive_name" required>
                        <option  value="">Select</option>
                        <?php
                        while ($executive_name = mysqli_fetch_assoc($executive_qry)) { ?>
                         <option value = '<?php echo $executive_name["exe_id"]; ?>' <?php if($executive_name['exe_id']==$buyer_executive){echo 'selected';} ?> ><?php echo $executive_name["exe_name"];?> </option>
                        <?php }  ?>
                    </select> 
                    </td>
                </tr>
                <tr>
                  <td><label for="Buyer_contact_person">Buyer Contact Person &nbsp</label></td>
                  <td><input type="tel" placeholder="Buyer Contact Person" name="Buyer_contact_person" id="Buyer_contact_person" required maxlength='25' value="<?php echo $buyer_contact;?>"></td>
                </tr>
                <tr>
                    <td><label for="Buyer_designation">Buyer Designation &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer Designation" name="Buyer_designation" id="Buyer_designation" required value="<?php echo $buyer_designation;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="buyer_phone">Buyer Mobile Number &nbsp</label></td>
                    <td><input type="tel" maxlength ='10' placeholder="Buyer Mobile Number" name="buyer_phone" required id="buyer_phone"  value="<?php echo $buyer_phone;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="buyer_e-mail">Buyer e-mail Address &nbsp</label></td>
                    <td><input type="email" placeholder="Buyer e-mail Address" name="buyer_e-mail" id="buyer_e-mail" required value="<?php echo $buyer_mail;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="Landline_phone_no.">Landline Phone No. &nbsp</label></td>
                    <td><input type="tel" placeholder="Landline Phone No." maxlength='10' name="Landline_phone_no" required id="Landline_phone_no" value="<?php echo $buyer_phone2;?>"><br></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Click" ></td>
                </tr>
            </table>
        </form>
    </div>
</center>
<script>
    function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script>
</body>
</html>