<?php 
// include('config.php');
include('../db_connection.php') ;
$con=OpenSrishringarrCon();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$bill_id=$_POST['bill_id']; 
//echo $bill_id."<br>";
$bill_date=$_POST['bill_date'];
$supp_id=$_POST['supp_id'];
//echo $supp_id."<br>";

$myitemid=$_POST['myitemid']; //name of item
//print_r($myitemid);
$item_cat=$_POST['item_cat'];
//echo $item_cat."<br>"; //cat of item
$item_no=$_POST['item_no'];
//echo $item_no."<br>";//Number of item
$cprice=$_POST['cprice'];
//print_r($cprice)."<br>";
$uprice=$_POST['uprice'];
//echo $uprice."<br>";
$qty=$_POST['qty'];
$totalqty=$_POST['totalqty'];
$totalamt=$_POST['totalamt'];
$payamt=$_POST['payamt'];
$distype=$_POST['distype'];
$discount=$_POST['per'];

$errors=0;

$begin=mysqli_query($con,"BEGIN;");

$qrypur=mysqli_query($con,"INSERT INTO `phppos_purchase`(`pur_id`, `bill_id`, `supp_id`, `date`, `totalqty`, `totalamt`, `outstanding`, `discount`, `payamt`, `dis_type`) VALUES ('','$bill_id','$supp_id',STR_TO_DATE('".$bill_date."','%d/%m/%Y'),'$totalqty','$totalamt','$payamt','$discount','$payamt','$distype')");

if($qrypur)
 {
$pur_id=mysqli_insert_id($con);
 for($i=0;$i<count($myitemid);$i++)
   {  
         $res=mysqli_query($con,"select * from phppos_items where name='".$myitemid[$i]."' ");
         $row = mysqli_fetch_array($res); 
         
    if(mysqli_num_rows($res)>0)
    {
        
        $orgqt=$row["quantity"];
        
        $newqtry=$qty[$i]+$orgqt;



$productsql  = mysqli_query($con,"select * from categories where category='".$item_cat[$i]."'");
$productsql_result = mysqli_fetch_assoc($productsql);
$productType= $productsql_result['typ'];


$str="update phppos_items set category='".$item_cat[$i]."',supplier_id='".$supp_id."' ,description='".$bill_date."', cost_price='".$cprice[$i]."',unit_price='".$uprice[$i]."',quantity='".$newqtry."' ,category_type='".$productType."' where item_number='".$item_no[$i]."'";

   $myautoid=$row["item_id"];
   $qryitm=mysqli_query($con,$str);
   	if(!$qryitm)
   	{
	$errors++;
   	}
   
   echo mysqli_error($con);
   
    }else{



$selectMaxidsql = mysqli_query($con,"select max(item_id) as maxitem_id from phppos_items");
$selectMaxidResult = mysqli_fetch_assoc($selectMaxidsql);
$selectMaxid = $selectMaxidResult['maxitem_id'];

$itemNumber = $item_no[$i] ;  
// $itemNumber = $item_no[$i].'_'. $selectMaxid ;  


// echo "INSERT INTO `phppos_items`(`name`, `category`, `supplier_id`, `item_number`, `description`, `cost_price`, `unit_price`, `quantity`) VALUES ('".$myitemid[$i]."','".$item_cat[$i]."', '".$supp_id."','".$itemNumber."' ,'".$bill_date."', '".$cprice[$i]."', '".$uprice[$i]."', '".$qty[$i]."')" ; 



$productsql  = mysqli_query($con,"select * from categories where category='".$item_cat[$i]."'");
$productsql_result = mysqli_fetch_assoc($productsql);
$productType= $productsql_result['typ'];



   $qryitm=mysqli_query($con,"INSERT INTO `phppos_items`(`name`, `category`, `supplier_id`, `item_number`, `description`, `cost_price`, `unit_price`, `quantity`,`category_type`) VALUES ('".$myitemid[$i]."','".$item_cat[$i]."', '".$supp_id."','".$itemNumber."' ,'".$bill_date."', '".$cprice[$i]."', '".$uprice[$i]."', '".$qty[$i]."','".$productType."')");
  
   $myautoid=mysqli_insert_id($con);
  
   }
  
  // -----------Insert data phppos_purchase_details table-----------------  
   $det=mysqli_query($con,"INSERT INTO `phppos_purchase_details`(`id`, `pur_id`, `item_id`, `qty`, `price`) VALUES ('','$pur_id', '".$myautoid."', '$qty[$i]', '$cprice[$i]')");			
	
	if(!$qryitm || !$det)
	$errors++;
  }
  
 }
 else
 $errors++;
	if($errors==0)
	{
	
	mysqli_query($con,"COMMIT;");
	echo " <center>Entries Done Successfully.<br> <<==<a href='purchase_entrytest.php'>GO BACK <<==</a> <a href='/pos/home_dashboard.php'>HOME <<==</a> <a href=''>BACK PURCHASE</a> </center>";
	if(!$det){
		$err=mysqli_error($con);
		//header('Location:addlead.php?err='.$err);
		}		
	
		}else{
			mysqli_query($con,"ROLLBACK;");
			echo "Error in Insering  ".mysqli_error($con)."<a href='purchase_entrytest.php'>GO BACK <<==</a>";
			}
	
CloseCon($con);	
	
?>