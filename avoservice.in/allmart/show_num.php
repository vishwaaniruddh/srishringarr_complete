<? include('config.php');


function drop_value($i){
            global $conn;
            
            if($i==1){
                $max = 500;
                $min = $max - 499;
            }
            else{
                $max = $i*500;
                $min = $max - 499;    
            }

        return [$min,$max];   
        }
        

$range = $_POST['range'];
$sender = $_POST['sender'];

$range = $range-1;
 
 
 ?>


<div class="container">
    <h2 style="text-align: center;
    margin: 3% auto;">Showing  records .. </h2>
<table class="table" style="background: white;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Number</th>
    </tr>
  </thead>
  <tbody>



<? 

$sql = mysqli_query($con,"select * from new_member where status = '1' and is_whatsapp_send=1 LIMIT $range,500");


$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
    
    <tr>
      <th scope="row"><? echo $i;?></th>
      <td><? echo $sql_result['name'];; ?></td>
      <td><? echo $sql_result['mobile'];; ?></td>
    </tr>
    <?
    $i++;
}
?>
  </tbody>
</table>
</div>