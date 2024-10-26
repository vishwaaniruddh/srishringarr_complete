<?php  include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  }
</style>
</head>
<body> 
<?
//echo $_GET['id'];
$so_id= $_GET['id'];

function get_asset_name($id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $asset_name = $sql_result['name'];
    return $asset_name;
}

?>
<table style="width:100%">
    <tr>    <th>id</th>
    <th>Product </th> 
    <th>Specification</th>
    <th>Sales Order Qty</th>
    <th>Consumed</th>
    </tr>

<?

$soassetsqry=mysqli_query($con1, "select * from new_sales_order_asset where so_trackid='".$so_id."'");

while($roswwe = mysqli_fetch_row($soassetsqry)){
$assety=mysqli_query($con1, "select quantity from site_assets where so_id='".$so_id."'and assets_spec='".$roswwe[4]."'"); 

$count=array();  
while($row=mysqli_fetch_assoc($assety)){
$count[]=$row['quantity'];
   
}
$sum=array_sum($count); ?>
    <tr>
    <td><? echo $roswwe[0] ?> </td>
    <td><? echo $roswwe[3] ?> </td>
    <td><? echo get_asset_name($roswwe[4]) ?> </td>
    <td><? echo $roswwe[5] ?> </td>
    <td><? echo $sum ?> </td>
    
    </tr>
   <?  } ?>  
    </table>
    </br> </br>
<table style="width:100%">
    <tr><td colspan="7" style="text-align:center"><b>Site Details</b></td></tr>
<tr>
    <td style="width: 3%;">S.No</td>
    <td style="width: 5%;">Site Id</td>
    <td style="width: 8%;">End User </td>
    <td style="width: 18%;">Address</td>
    <td style="width: 10%;">State</td>
    <td style="width: 3%;">Site Status</td>
    <td style="width: 18%;">Products</td>
    
    </tr>
 
 
<? 
//echo "select * from atm where so_id='".$so_id."'";
$atmqry=mysqli_query($con1, "select * from atm where so_id='".$so_id."'");
$cnt=1;
while($atm_result = mysqli_fetch_row($atmqry)){  ?>
  
  <tr>
    <td><? echo $cnt ?> </td>
    <td><? echo $atm_result[1] ?> </td>
    <td><? echo $atm_result[3] ?> </td>
    <td><? echo $atm_result[9] ?> </td>
    <td><? echo $atm_result[15] ?> </td>
    <td><? echo $atm_result[22] ?> </td>
<td style="width: 18%;">
<?
$assetqry=mysqli_query($con1, "select * from site_assets where atmid='".$atm_result[0]."' ");

// This is correct in future=============
//$assetqry=mysqli_query($con1, "select * from site_assets where atmid='".$atm_result[0]."' and so_id='".$so_id."'");

while($detailme=mysqli_fetch_row($assetqry))
{ 
echo $detailme[3]."(".get_asset_name($detailme[4]).") Qty: ".$detailme[6]."</br>";
 }  ?>
  </td>  
    </tr> 
<? $cnt++;   
}
?>
    
</table>    
    
    
    </body>
    </html>
   