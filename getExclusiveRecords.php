<? include('config.php');
header('Content-Type: application/json; charset=utf-8');


$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'all';

$sql_query = "SELECT * FROM `exclusive_collections`";

if ($type !== 'all') {
    $sql_query .= " WHERE category = '$type'";
}

$raw_data = mysqli_query($con, $sql_query);

$data = [];
while ($row = mysqli_fetch_assoc($raw_data)) {
    
    $sku = $row['sku'];
    
    // echo "SELECT * FROM `garment_product` WHERE `gproduct_code` LIKE '".$sku."'" ; 
    
    if($result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `garment_product` WHERE `gproduct_code` LIKE '".$sku."'"))){
        $row['product_name'] = $result['gproduct_name'];
    }else{
        $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product` WHERE `product_code` LIKE '".$sku."'")) ; 
        $row['product_name'] = $result['product_name'];
    }
    
    

$row['image'] = str_replace('https://yosshitaneha.com/','./yn/',$row['image_url']);

$row['thumb'] = 'https://srishringarr.com/yn/thumbs/'.basename($row['image_url']);

    $data[] = $row;
}

echo json_encode($data) ;

?>