<?php session_start();
include("access.php");
include("config.php");


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

 //var_dump($_SESSION);


// get customer vertical of logged in user

function customer_vertical_id($name){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}



if($_SESSION['designation']==5){
            
            $customer_qry = "select * from clienthandle where logid='".$_SESSION['logid']."'";
            
        }
        else{
            
            $customer_qry = "select * from customer";
                }
                            
 $query = mysqli_query($con1,$customer_qry);

while($customer_qry_result = mysqli_fetch_assoc($query)){

$cust_vertical_name = $customer_qry_result['client']; 
    
    $cust_vertical_id[] = customer_vertical_id($cust_vertical_name);
}
            
            
    $cust_vertical_id=json_encode($cust_vertical_id);
        
    $cust_vertical_id=str_replace( array('[',']') , ''  , $cust_vertical_id);
            
    $cust_vertical_id = implode(',',array_unique(explode(',', $cust_vertical_id)));
    
 
 
 
 
 
 
 
//  Pagination
 
    if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}


$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page; 










//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buyer</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />


<style>
     body {
    background-color: #4D9494;
    margin-top: 5px;
}
.additional_buttons {
    display: flex;
    margin: 1% ! important;
}
.additional_buttons form {
    margin: auto 1%;
}
.search_fields{
    margin: 1% 1%;
}
</style>


<body onLoad="searchById('Loading','1','')">
<center>
        <?
        if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
   

function get_salesexecutive_name($id){

    global $con2;
    
    $executive_qry = mysqli_query($con2, "SELECT * FROM salesteam where exe_id = '".$id."'");
    $executive_qry_result = mysqli_fetch_assoc($executive_qry);
    $name = $executive_qry_result['exe_name'];
       return $name;
}




if(!empty($_POST['buyer_name']) || !empty($_POST['buyer_vertical']) || !empty($_POST['avo_branch'])){
              
                
                $k = $_POST;
                $sliced = array_slice($k, 0, -1);


                if(isset($sliced)){
            

                    $i = 0;
                     $string = '';
                     
                     if($_SESSION['designation']==5){
                    $statement= "select * from buyer where buyer_vertical in($cust_vertical_id) and status=1 and";                         
                     }
                     else{
                        $statement= "select * from buyer where status=1 and";
                     }
//echo $statement;
                    foreach($sliced as $key=>$val){
                        
                        if($val){
                            
                            if($key=='buyer_name'){ 
                                
                                 $statement .=" $key LIKE '%".$val."%'";
                                
                                  $statement .= " and";

                            }
                            else{
                                
                                $statement .=" $key='".$val."'";
                                
                                $statement .= " and";

                            }
                        }
                        
                    }   
                }


    $statement = substr($statement, 0, strlen($statement)-3);
    



    $result = mysqli_query($con1,$statement);
    $total_rows = mysqli_num_rows($con1,$result);
    $total_pages = ceil($total_rows / $no_of_records_per_page);  

    $statement .="order by buyer_ID desc LIMIT $offset, $no_of_records_per_page";
//echo $statement;
    $sql =$statement;

    $sql = mysqli_query($con1,$sql);

}

if(!$sql || empty($sql)){


    if($_SESSION['designation']==5){
        
        $if_account = mysqli_query($con1,"select count(*) as count_number from buyer where buyer_vertical in($cust_vertical_id) and status=1");
//echo "select count(*) as count_number from buyer where buyer_vertical in($cust_vertical_id) and status=1";


        $if_account = mysqli_fetch_assoc($if_account);
        $total_rows = $if_account['count_number'];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
    }
    else{

        $if_account = mysqli_query($con1,"select count(*) as count_number from buyer where status=1");

        $if_account = mysqli_fetch_assoc($if_account);
        $total_rows = $if_account['count_number'];
        $total_pages = ceil($total_rows / $no_of_records_per_page);  
        
    }
}

?>


            <div class="search_fields" >
                    
                <form class="form-inline" method="POST">

                    <div class="form-group mb-2">
                        <label for="staticEmail2" class="sr-only">PO_NO</label>
                        <input type="text"  class="form-control" id="buyer_name" name="buyer_name" placeholder="Search buyer !!" value="<? echo $_POST['buyer_name'];?>">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                    <label for="custer_vertical" class="sr-only">Buyer Vertical</label>
                    
                    
                    
                    <? $customer_qry = mysqli_query($con1,$customer_qry);

                    
                    ?>
                    
                    
                           <select id="buyer_vertical" name="buyer_vertical" id="buyer_vertical" class="form-control">
                            <option  value="">Select Vertical</option>
                            
                            
                            <?php 
                            
                            
                            while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { 
                            
                            
                            if($_SESSION['designation']==5){ ?>
                            <option value="<? echo customer_vertical_id($customer_vertical["client"]); ?>" <? if($_POST['buyer_vertical']== customer_vertical_id($customer_vertical["client"])){ echo 'selected'; }?> >
                                <?php echo $customer_vertical["client"];?>
                            </option>
                            <? } else{ ?> 
                                
                            <option value="<? echo $customer_vertical['cust_id']; ?>" <? if($_POST['buyer_vertical'] == $customer_vertical['cust_id']){ echo 'selected'; }?> >
                                <?php echo $customer_vertical["cust_name"];?>
                            </option>
                            <? } ?>
                            



                                <? } ?>
                                   


                        </select>
                            
                            
                            
                            
                            
                    </div>
                    
                    <div class="form-group mb-2">
                    <label for="buyer" class="sr-only">Branch</label>
                    
                    <select id="avo_branch" name="avo_branch" class="form-control">
                                
                                 
                            <option  value="">Select Branch </option>
                            <?php
                            $avo_branch = mysqli_query($con1,"select * from avo_branch");
                                while ($avo_branch_result = mysqli_fetch_assoc($avo_branch)) { ?>
                                    <option value= "<?php echo $avo_branch_result['id']; ?>" <? if($POST['avo_branch']==$avo_branch_result['id']){ echo 'selected'; }?> > <?php echo $avo_branch_result["name"];?>
                                    </option>
                                <?php } ?>
                        
                            </select>
                            
                    
                    </div>
               
                    
                    <input class="btn btn-success" type="submit" name="search" value="Search">
                    
                    </form>
                    
                </div>
                
                
                
                
<h4>View Buyers </h4>


<table class="table table-striped table-bordered" style="width:100%">
    <tr>
        <th width="100">Buyer_name</th>
        <th width="50">Buyer segment</th>
        <th width="82">Branch</th>
        <th width="80">Buyer Executive</th>
        <th width="30">Buyer City</th>
        <th width="92">Address</th>
        <th width="80">State</th>
        <th width="92">GST</th>
        <th width="47">Pin</th>
        <th width="60">Contact</th>
        <? if($_SESSION['designation']!=5){ ?>
            
            
        <th width="47">Designation</th>
        <th width="92">Phone</th>
        <th width="47">Mail</th>
        <th width="50">Phone2</th> <? } ?>
        <th width="47">Created Date</th>
        <th width="47">Action</th>
    </tr>
    
    <? 
    
     if(!$sql || empty($sql)){
         
         if($_SESSION['designation']==5){



                $sql=mysqli_query($con1,"SELECT * FROM buyer where buyer_vertical in($cust_vertical_id) and status=1 order by buyer_ID desc LIMIT $offset, $no_of_records_per_page");
                


                }
            else{

                $sql=mysqli_query($con1,"SELECT * FROM buyer where status=1 order by buyer_ID desc LIMIT $offset, $no_of_records_per_page");
                
            }
            
        //    echo $sql;

        }
        
        ?>
        
        <h4 style="color:white;text-align:right;">Total <? echo $total_rows;?> Records..</h4>
        
        <?


while($sql_result = mysqli_fetch_assoc($sql))
{ 

    


$cust_id = $sql_result['buyer_vertical'];
$branch_id = $sql_result['avo_branch'];
$buyer_state = $sql_result['buyer_state'];


$exe_id= $sql_result['buyer_executive'];
$exe_name = get_salesexecutive_name($exe_id);

$cust_sql=mysqli_query($con1,"select cust_name from customer where cust_id='".$cust_id."'");
$cust_result = mysqli_fetch_assoc($cust_sql);
$cust_vertical_name=$cust_result['cust_name'];

$sql_br=mysqli_query($con1,"select name from avo_branch where id='".$branch_id."'");
$Br_result = mysqli_fetch_assoc($sql_br);
$branch_name = $Br_result['name'];

$statesql=mysqli_query($con1,"select state from state where state_id='".$buyer_state."'");
$state_result = mysqli_fetch_assoc($statesql);
$state = $state_result['state'];
?>
    
    
    <tr >
    <td ><?php echo $sql_result['buyer_name']; ?></td>
    <td><?php echo $cust_result['cust_name']; ?></td>
    <td ><?php echo $branch_name; ?></td>
    <td ><?php echo $exe_name ?></td>
    <td ><?php echo $sql_result['buyer_city']; ?></td>
    <td ><?php echo $sql_result['buyer_address']; ?></td>
    <td ><?php echo $state; ?></td>
    <td ><?php echo $sql_result['buyer_gst']; ?></td>
    <td ><?php echo $sql_result['buyer_pin']; ?></td>
    <td ><?php echo $sql_result['buyer_contact']; ?></td>
    
<?    if($_SESSION['designation'] !=5) { ?>
    
    <td ><?php echo $sql_result['buyer_designation']; ?></td>
    <td ><?php echo $sql_result['buyer_phone']; ?></td>
    <td ><?php echo $sql_result['buyer_mail']; ?></td>
    <td ><?php echo $sql_result['buyer_phone2']; ?></td>
    <? } ?>
    <td ><?php echo $sql_result['created_date']; ?></td>
    <td >
        <a href="buyers_form.php?id=<?php echo $sql_result['buyer_ID'];?>&action=edit"><input type="button"  value="Edit"></a>
        
        
        
        <? if($_SESSION['designation']!=5){ ?>
                <a href="edit_buyer.php?id=<?php echo $sql_result['buyer_ID'];?>&action=delete" onclick="return confirm('Are you sure?')"> <input type="button"  value="Delete" ></a>            
        <? } ?>

        
        
        <a href="add_purchase_order.php?id=<?php echo $sql_result['buyer_ID'];?>" target="_blank"><input type="button"  value="Add Purchase Order" ></a>
    </td>
</tr>
  
  
    <? } ?>
    
</table>
    
    
    
    
    
</div>
<div id="search"></div>
</center>


<div class="pagination_div" style="display: flex;justify-content: center;">
    

<ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
</div>




    <div style="display:flex:justify-content:center">
    
     <form name="frm" method="post" action="buyers_export.php" target="_new" style="text-align: center;">


    <? if($statement){ ?>
    <input type="hidden" name="qr" value="<?php echo $statement; ?>" readonly>    
    <? } else { ?>
    <input type="hidden" name="qr" value="<?php echo "select * from buyer where status=1 order by buyer_ID desc ;"; ?>" readonly>
    <? } ?>         
    
    
    
    <input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
    </form>
    

</div>     


</body>
</html>