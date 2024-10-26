<? include('config.php');


$qryjew = mysqli_query($con, "SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");
while($rowjew = mysqli_fetch_array($qryjew)){
    

    $sql1 = mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1");
    
    while($sql1_result = mysqli_fetch_assoc($sql1)){
        
        $subcat_id = $sql1_result['subcat_id'];
        
        
            $sql = mysqli_query($con, "SELECT * FROM product WHERE subcat_id='".$subcat_id."'");
            $productNames = array(); // Array to store product names
            
            while ($sql_result = mysqli_fetch_assoc($sql)) {
                
                
                $productName = $sql_result['product_name'];
                if($productName){
                          
                        $productID = $sql_result['product_id'];
                        $productName = str_replace(' ', '_', $productName); // Replace spaces with underscores
                        $productName = preg_replace('/[^a-zA-Z0-9_]/', '', $productName); // Remove special characters
                        $productName = ltrim($productName, '_'); // Remove underscores at the beginning
                        $productName = rtrim($productName, '_'); // Remove underscores at the end

                        if (isset($productNames[$productName])) {
                            $productNames[$productName]++; // Increment counter for duplicate name
                            $productName .= '_' . $productNames[$productName]; // Append counter to the name
                        } else {
                            $productNames[$productName] = 0; // Initialize counter for new name
                        }
                    
                        // echo $productName;
                        // echo '<br>';
                     
                     $update = "update product set newProductName = 'Rent_".$productName."' where product_id = '".$productID."'" ; 
                    //  echo '<br />';
                     mysqli_query($con,$update);
                     
                    }
                      
                }

        
    }
        
    
    
}




?>