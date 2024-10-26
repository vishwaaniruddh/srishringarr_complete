<? include('config.php');


$sql = mysqli_query($con,"SELECT * FROM `garment_product` group by gproduct_code having count(gproduct_code) > 1");
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
    

<div>
    

<?
    echo $sku = $sql_result['gproduct_code'];
    
    echo '<br>';
    
    $sku_sql = mysqli_query($con,"select * from garment_product where gproduct_code='".$sku."'");
    while($sku_sql_result = mysqli_fetch_assoc($sku_sql)){
        $pid = $sku_sql_result['gproduct_id'];
        
        echo $pid ; 
        ?> 
        
 	    <a href="detail.php?id=<? echo $pid; ?>&type=2&days=3">View | </a>
 	    <a href="deletepro.php?id=<? echo $pid; ?>">Delete</a>
        
        
        <?
        
        
    } ?>
</div>  

<? 
    echo '<br>';    echo '<br>';
    
}


?>