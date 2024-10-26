<?

include('config.php');

$id=$_GET['id'];


$sql="select * from BRF_details where Brf_id='".$id."'";
$qrys=mysqli_query($con1,$sql);
?>
<table border="1" style="margin-top:30px"  width="100%">
  <tr>
      
         <th>S.No</th>
     
    <th>BatterySerialNo</th>
    <th>Charging_Voltage</th>
    <th>Discharge</th>
   <th>DischargeVoltage</th>


  </tr>

  <?php $sr=1;
  while($row = mysqli_fetch_array($qrys)) { ?>

 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row["BatterySerialNo"];?></td>
    <td><?php echo $row["Charging_Voltage"];?></td>
    <td><?php echo $row["Discharge"];?></td>
    <td><?php echo $row["DischargeVoltage"];?></td>
   
   </tr>
  <?php
$sr++;
 
}
?>

</table>