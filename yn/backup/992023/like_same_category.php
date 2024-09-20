<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css" integrity="sha512-c7jR/kCnu09ZrAKsWXsI/x9HCO9kkpHw4Ftqhofqs+I2hNxalK5RGwo/IAhW3iqCHIw55wBSSCFlm8JP0sw2Zw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js" integrity="sha512-BmoWLYENsSaAfQfHszJM7cLiy9Ml4I0n1YtBQKfx8PaYpZ3SoTXfj3YiDNn0GAdveOCNbK8WqQQYaSb0CMjTHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="container-fluid" style="background: white;">
  <h4 class="like_h4">From Same Category </h4>
  <?

if($type=="1")
{
    $sql="SELECT * FROM `product` WHERE `product_id`='".$prid."'";
    $sql_query = mysqli_query($con,$sql);
    $sql_result = mysqli_fetch_assoc($sql_query);
    $category = $sql_result['subcat_id'];
    $sql_product  = mysqli_query($con,"select * from garment_product where product_for='".$category."' order by visitcount desc limit 20");
}
else if($type=="2")
{
    $sql="select * from  `garment_product` where gproduct_id='".$prid."'";
    $sql_query = mysqli_query($con,$sql);
    $sql_result = mysqli_fetch_assoc($sql_query);
    $category = $sql_result['product_for'];
    $sql_product  = mysqli_query($con,"select * from product where subcat_id='".$category."' order by visitcount desc limit 20");
}


$product_type = $type;
$product_id = $category;

$file = 'data/'.$product_type . '-'.$product_id.'.json';
$requesturi =  $_SERVER['REQUEST_URI'] ;
        $url = 'https://www.srishringarr.com'.  $_SERVER['REQUEST_URI']  ;
        if ( $temp = strstr($requesturi, 'page', true) ) {
        $requesturi = $temp;
        $requesturi = rtrim($requesturi , '&');
        }

if (file_exists($file)) {
    $sample_data = file_get_contents($file);
}else{

        $api =  str_replace('like_list','list_json',$url) ;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
        ),
        ));

        $sample_data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        touch($file);

        $myfile = fopen($file, "w");
        fwrite($myfile, $sample_data);
        fclose($myfile);

}

// just normal getting data
// var_dump($sample_data);

$raw_data = json_decode($sample_data, true);
$raw_data = $raw_data['qqq'];

$raw_data = array_slice($raw_data, 0, 10);
// $data = json_decode($data);
// $raw_data = $data->qqq;

if($pricefilter==2){
    usort($raw_data, function ($item1, $item2) {
        return $item1['rent_price'] <=> $item2['rent_price'];
    });
}elseif($pricefilter==1){
    usort($raw_data, function ($item1, $item2) {
        return $item2['rent_price'] <=> $item1['rent_price'];
    });
}

// use get variable to paging number
$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$limit = 20; // five rows per page
$offset = ($page - 1) * $limit; // offset
$total_items = count($raw_data); // total items
$total_pages = ceil($total_items / $limit);
$final = array_splice($raw_data, $offset, $limit); // splice them according to offset and limit


// echo '$total_pages = '.$total_pages ;
?>

        <div class="flexslider carousel">
          <div class="row rowFlexMargin wrapper slides">
            <?php foreach($final as $key => $value): ?>
            
            <? 
            
            $image_url = $value['com_image']; 
            $image_url = str_replace("yn/","",$image_url) ; 
        
            if($image_url){
                
            
            
            ?>
            
              <li class="product_col">
                <div class="product">
                  <a href="<? echo $value['link']; ?>" class="img-prod">
                    <img src="<? echo $image_url ; ?>">
                  </a>
                  <div class="text py-3 px-3">
                    <div class="subpart">
                      <p style="display:block;">MRP
                        <? echo $value['cur_sym']. ' ' . $value['selling_price']; ?>
                      </p>
                      <h6 style="color:red;    font-size: 13px; text-decoration: underline;font-weight: 700;">SKU : <a href="<? echo $value['link']; ?>"><? echo $value['sku']; ?></a></h6>


                    </div>
                  </div>
                </div>
              </li>
              <?php } endforeach; ?>
          </div>
        </div>
</div>
</div>


<script>
    		
$(document).ready(function() {
    $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 210,
    itemMargin: 5
    });
});
</script>