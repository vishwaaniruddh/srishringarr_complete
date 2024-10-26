<?php 

$product_id = $_REQUEST['id'];

$custom_con = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$category = 1 ; 

$categorysql = mysqli_query($custom_con,"select * from garments where garment_id='".$product_id."'");
$categorysqlResult = mysqli_fetch_assoc($categorysql) ; 


// var_dump($categorysqlResult);

$category_name = $categorysqlResult['name'];
$meta_title = $categorysqlResult['meta_title'];
$meta_keywords = $categorysqlResult['meta_keywords'];
$meta_description = $categorysqlResult['meta_description'];

include('header.php');
?>

<style>


.tooltip-item:hover + .tooltip-content {
    display: block !important;
}


.mytooltip {
    display: inline;
    position: relative;
    z-index: 999;
}

.mytooltip .tooltip-item {
cursor: pointer;
    display: inline-block;
    font-weight: 500;
    padding: 0px 5px;
    background: gray;
    color: white;
    border-radius: 50%;
    line-height: 1.8;
    font-size: 7px;
}
.mytooltip .tooltip-item::after {
    content: '';
    position: absolute;
    width: 360px;
    height: 20px;
    bottom: 45%;
    left: 50%;
    pointer-events: none;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

.tooltip-effect-1 .tooltip-content {
    -webkit-transform: translate3d(0,-10px,0);
    transform: translate3d(0,-10px,0);
    -webkit-transition: opacity .3s,-webkit-transform .3s;
    transition: opacity .3s,-webkit-transform .3s;
    transition: opacity .3s,transform .3s;
    transition: opacity .3s,transform .3s,-webkit-transform .3s;
    color: #fff;
}

.mytooltip .tooltip-content {
  position: absolute;
    z-index: 9999;
    width: 360px;
    bottom: 15%;
    text-align: left;
    font-size: 20px;
    line-height: 30px;
    -webkit-box-shadow: -5px -5px 15px rgba(48,54,61,.2);
    box-shadow: -5px -5px 15px rgba(48,54,61,.2);
    background: #06d482;
    display: none;
    cursor: default;
    padding: 14px;
    pointer-events: none;
    font-weight: 600;
     /*font-size: 32px;*/
}




.mytooltip .tooltip-content img {
    position: relative;
    height: 140px;
    display: block;
    float: left;
    margin-right: 1em;
}
img {
    vertical-align: middle;
    border-style: none;
}

.mytooltip .tooltip-text {
    font-size: 14px;
    line-height: 24px;
    display: block;
    padding: 1.31em 1.21em 1.21em 0;
    color: #fff;
}
.mytooltip .tooltip-content::after {
    content: '';
    top: 100%;
    left: 50%;
    border: solid transparent;
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-color: #2a3035 transparent transparent;
    border-width: 10px;
    margin-left: -10px;
}

.clearfix::after {
    display: block;
    clear: both;
    content: "";
}
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: black;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-link.active {
        color: #ffa45c;
        color: white;
        background: darkgray;
    }

    /*#loadingOverlay {*/
    /*    position: fixed;*/
    /*    top: 0;*/
    /*    left: 0;*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*    background-color: rgba(255, 255, 255, 0.8);*/
    /*    z-index: 9999;*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*    justify-content: center;*/
    /*}*/

.noUi-horizontal {
    height: 10px !important;
}
.noUi-handle:after, .noUi-handle:before {
  content: inherit !important;
}
.noUi-horizontal .noUi-handle {
    width: 25px !important;
    height: 20px !important;
    right: -22px !important;
    top: -6px !important;
}

    @media (min-width: 992px) and (min-width: 1410px){
    .filterTagFullwidthContent.velaSidebar {
        width: 320px;
    }   
    }
    @media (min-width: 1410px){
     
.velaCenterColumnFix {
    width: calc(100% - 320px)!important;
}   
    }
    
    @media (min-width: 1410px){
     
.container {
    max-width: 1410px;
}   
    }
    #rangefilterForm input{
        border-bottom: 1px solid #d1c2c2 !important;
        margin: 5px;
        background: transparent;
        border-radius: 0;
    }
    
    #rangefilterForm input[type=submit] {
            background: blue;
    }
    .highlight{
            padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    /*margin: 20px auto;*/
    }
    
    .typeFilter {
        margin:5px;
    }
    

</style>


<?php
if (isset($_REQUEST['pricefilter'])) {
    $pricefilter = $_REQUEST['pricefilter'];
}
?>
    
  


<div class="container-fluid">
    


    <br />
    <div class="row" style="display: flex;
    justify-content: end;">
        
        <?
        $minPrice = $_REQUEST['minPrice'];
        $maxPrice = $_REQUEST['maxPrice'];
        $typeFilter = $_REQUEST['typeFilter'];
        
        ?>
        <select class="form-control " onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="width: auto;" required>
                <option value="">Select</option>
                <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=1"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 1) {
                                                                                                echo 'selected';
                                                                                            } ?>>Rent - Higher To Lower</option>
                <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=2"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 2) {
                                                                                                echo 'selected';
                                                                                            } ?>>Rent - Lower To Higher </option>
                                                                                            
                                                                                            
                <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=3"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 3) {
                                                                                                echo 'selected';
                                                                                            } ?>>Sell - Higher To Lower </option>
                <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=4"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 4) {
                                                                                                echo 'selected';
                                                                                            } ?>>Sell - Lower To Higher </option>
                                                                                            
            </select>
        </div>
    <br />
    
    
    <div id="loadingOverlay" class="center" style="visibility: visible;text-align: center;">
        <img class=" ls-is-cached lazyloaded" data-src="assets/loader.gif" loading="lazy" src="assets/loader.gif" style="width:200px;">     
    </div>



<div class="row">
    
<aside id="velaSidebar" class="col-sm-2 filterTagFullwidthContent sidebarLeft velaSidebar" style="display: none;">
   <div class="filterTagFullwidthClose hidden-xl hidden-lg hidden-md hidden-xl"></div>
   <div class="velaSidebarInner highlight" style="padding: 10%;">
                <div id="shopify-section-sidebartop" class="shopify-section">
                  <div id="velaCategories" class="velaCategoriesSidebar velaBlock">
                      <h3 class="titleSidebar">Filters</h3>
                      <hr />
                  <div class="velaContent">

                      <div id="rangeFilter"></div>
                      <hr>
                      
                      </div>
                  </div>
                </div>
   </div>
</aside>
    
    <div class="col-sm-10">
        <div id="dataContainer" class="row"></div>
        <div id="paginationContainer" class="row mt-3 text-center" style="float:right;"></div>
    </div>
</div>




</div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.1/nouislider.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.1/nouislider.min.js"></script>

<script>
    $(document).ready(function() {
        
        var urlParams = new URLSearchParams(window.location.search);
        var currentPage = parseInt(urlParams.get('page')) || 1;
        var itemsPerPage = 20; // Number of items to display per page
        
        // Show loading overlay
        $('#loadingOverlay').show();

        $.ajax({
            url: "apparel1.php?id=<?php echo $product_id; ?>&type=2&pricefilter=<? echo $pricefilter; ?>&minPrice=<? echo $minPrice; ?>&maxPrice=<? echo $maxPrice; ?>&typeFilter=<? echo $typeFilter; ?>",
            dataType: 'json',
            success: function(response) {
                var data = response.data;
                var totalItems = data.length;
                var totalPages = Math.ceil(totalItems / itemsPerPage);
                
                
                var typeFilter = '<? echo $typeFilter; ?>'; 
                var minAddedRentPrice = response.minAddedRentPrice;
                var maxAddedRentPrice = response.maxAddedRentPrice;
                
                
                var minLastSellingPrice = response.minLastSellingPrice;
                var maxLastSellingPrice = response.maxLastSellingPrice;

                var selectedminAddedRentPrice = '<? echo $minPrice; ?>';
                
                if(!selectedminAddedRentPrice){
                    selectedminAddedRentPrice = minAddedRentPrice ;
                }
                
                var selectedmaxAddedRentPrice = '<? echo $maxPrice; ?>'; 

                if(!selectedmaxAddedRentPrice){
                    selectedmaxAddedRentPrice = maxAddedRentPrice ;
                }


                function displayItems(page) {
                    var startIndex = (page - 1) * itemsPerPage;
                    var endIndex = startIndex + itemsPerPage;
                    var html = '';

if(totalItems > 1){
                    for (var i = startIndex; i < endIndex && i < totalItems; i++) {
                        var product = data[i];
                        // Create the HTML for each product
                        html += '<div class="col-xs-6 col-md-4 col-lg-3 ftco-animate fadeInUp ftco-animated product_col" style="margin: 10px auto;">';
                        html += '<div class="product">';
                        html += '<a href="' + product.link + '&page='+ currentPage +'" class="img-prod">';
                        html += product.imgframe;
                        html += '</a>';

                        html += '<div class="text py-3 px-3">';
                        html += '<h3>';
                        html += '<a href="' + product.link + '">' + product.product_name + '</a>';
                        html += '</h3>';
                        html += '<hr style="margin-top: 0rem; margin-bottom: 0.3rem;">';
                        html += '<div class="subpart">';
                        html += '<h6 style="color: #f3a915;font-size: 12px;text-decoration: underline;font-weight: 600;cursor:pointer;">SKU : <a href="' + product.link + '">' + product.sku + '</a></h6>';
                        html += '<p style="display:block;" style="display: flex;justify-content: space-between;align-items: center;">MRP ₹ ' + product.mrp ;
                        
                        html +=`                        
                        </p>
                        `;


                        html += '<div class="d-flex">';

                        html += '<div class="pricing">';
                        html += '<p class="price">';
                        html += '<span class="mr-2 price-dc">Rent ₹ <strong>' + product.addedRentPrice + '</strong> for 3 Days</span>';
                        html += '<br>';
                        html += '<span class="price-sale">Refundable Deposit ₹ <strong>' + product.deposit + '</strong></span>';
                        html += '<br>';
                        html += '<span class="price-sale" style="display:none;">Selling Price ₹ <strong>' + product.lastSellingPrice + '</strong></span>';
                        html += '</p>';
                        html +=`<span class="mytooltip tooltip-effect-1" style="display:none;">
                        &nbsp;&nbsp;&nbsp;<span class="tooltip-item"><i>i</i></span>

                        <span class="tooltip-content clearfix" style="justify-content: space-between;align-items: center;">

                        <span class="tooltip-text">
                            You can now buy Pre Loved Pieces at exciting prices. They are very well maintained and look as good as new❤️
                        </span>
                        </span>
                        
                        </span><br />`;
                        
                        html += '<div id="bookingStatus">'+product.booking+'</div>'
                        
                      
                        html += '</div>';

                        html += '<div class="rating">';
                        html += '<p class="text-right">';
                        html += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                        html += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                        html += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                        html += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                        html += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                        html += '</p>';
                        html += '</div>';

                        html += '</div>';
                        html += '</div>';

                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    }
    
}else{
    html = `No Product Found !` ; 
}

           
                    $('#dataContainer').html(html);
                    $('#velaSidebar').css('display','block');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow');
                    $('#loadingOverlay').hide();
                }

                function displayPagination() {
                    var paginationHtml = '';

                    for (var i = 1; i <= totalPages; i++) {
                        if (i === currentPage) {
                            paginationHtml += '<a href="#" class="page-link active">' + i + '</a>';
                        } else {
                            paginationHtml += '<a href="#" class="page-link">' + i + '</a>';
                        }
                    }

                    $('#paginationContainer').html(paginationHtml);

                    $('#paginationContainer .page-link').on('click', function(e) {
                        e.preventDefault();
                        var page = parseInt($(this).text());
                        currentPage = page;
                        displayItems(page);
                        updateActivePageLink(page);
                    });
                }

                function updateActivePageLink(page) {
                    $('#paginationContainer .page-link').removeClass('active');
                    $('#paginationContainer .page-link:contains(' + page + ')').addClass('active');
                }
                
function setFiltersRent(minAddedRentPrice, maxAddedRentPrice) {
    htmlRent = `
    <div id="rangeFilter">
        <div id="priceSlider"></div>
        <p style="margin-top: 10px;display: flex;justify-content: space-between;"><span id="selectedMin">${minAddedRentPrice}</span> - <span id="selectedMax">${maxAddedRentPrice}</span></p>
    </div>
    
    <form method="GET" action="apparel.php" id="rangefilterForm" >
        <input type="text" name="id" value="<?= $product_id; ?>" style="display:none;">
        <input type="text" name="typeFilter" value="addedRentPrice" style="display:none;">
        <input type="text" name="pricefilter" value="<? echo $pricefilter; ?>" style="display:none;">
                        
        
        <input type="text" name="type" value="2" style="display:none;">
        <div style="display:flex;">
            <input type="text" name="minPrice" value="${minAddedRentPrice}" placeholder="min price" style="width: 50%;">
            <input type="text" name="maxPrice" value="${maxAddedRentPrice}" placeholder="max price" style="width: 50%;">
        </div>
        
        
    <br />
        <input type="submit" name="submit" value="Rent Filter" class="btn btn-primary">
    </form>
    `;

    $("#rangeFilter").html(htmlRent);

    const priceSlider = document.getElementById('priceSlider');
    const selectedMin = document.getElementById('selectedMin');
    const selectedMax = document.getElementById('selectedMax');
    const minPriceInput = document.querySelector('input[name="minPrice"]');
    const maxPriceInput = document.querySelector('input[name="maxPrice"]');

    noUiSlider.create(priceSlider, {
        start: [selectedminAddedRentPrice, selectedmaxAddedRentPrice],
        connect: true,
        range: {
            'min': minAddedRentPrice,
            'max':  maxAddedRentPrice 
        }
    });

    priceSlider.noUiSlider.on('update', function (values, handle) {
        if (handle === 0) {
            selectedMin.textContent = values[handle];
            minPriceInput.value = values[handle];
        } else if (handle === 1) {
            selectedMax.textContent = values[handle];
            maxPriceInput.value = values[handle];
        }
    });
}



                displayItems(currentPage);
                displayPagination();
                updateActivePageLink(currentPage);
                setFiltersRent(minAddedRentPrice,maxAddedRentPrice);
                // setFiltersSell(minLastSellingPrice,maxLastSellingPrice);
                
            }
        });
    });
    
    
    $(document).on('click','.page-link',function(){
        var page = $(this).text();
        var newURL = window.location.href.split('?')[0] + '?page=' + page;
        window.history.replaceState({ path: newURL }, '', newURL);

    })
    
    
</script>

<?php
include('footer.php');
?>
