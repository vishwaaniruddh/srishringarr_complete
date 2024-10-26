<? session_start();

include('config.php');



$sql = mysqli_query($con,"select count(id) as count from new_member where status=1 and is_whatsapp_send=1");    




$sql_result  = mysqli_fetch_assoc($sql);


$total_num =  $sql_result['count'];

 $break = $total_num / 500 ;
        
 $ext = pathinfo($break, PATHINFO_EXTENSION);
        
        if($ext){
        $break = intval($break)+1;
        }


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



?>



                                    <option>Select Range</option>
                                    <? for($i=1;$i<=$break;$i++){ 
                                    
                                    $drop = drop_value($i);
                                    
                                    ?>
                                        
                                        <option value="<? echo $i;?>">
                                            <? echo $drop[0].' - '. $drop[1]; ?></option>
                                        
                                    <? } ?>
