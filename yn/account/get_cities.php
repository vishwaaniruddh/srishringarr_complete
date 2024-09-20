<?php include('../config.php');

  $state=$_REQUEST['state'];

     if($state){

       $sqlm=mysqli_query($con,"SELECT code,name FROM cities where state_code='".$state."'");
      
   
        while($row=mysqli_fetch_assoc($sqlm)){
   
                $id=$row['code'];
                $name=$row['name'];
                $data[]=['id'=>$id,'name'=>$name];
                
			   } 
      
       }

echo json_encode($data);

?>