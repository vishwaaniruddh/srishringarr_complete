<?php
session_start();
include('header.php');
?>

<style>
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
</style>

<?php
$product_id = $_REQUEST['id'];
if (isset($_REQUEST['pricefilter'])) {
    $pricefilter = $_REQUEST['pricefilter'];
}
?>
    
    
<!--<div id="loadingOverlay">-->
<!--    <p>Loading...</p>-->
<!--</div>-->


<div class="container">
    

    <br />
    <div style="float:right;">
        <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="width: auto;" required>
            <option value="">Select</option>
            <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=1"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 1) {
                                                                                            echo 'selected';
                                                                                        } ?>>Higher To Lower</option>
            <option value="apparel.php?id=<?php echo $product_id; ?>&type=2&pricefilter=2"<?php if (isset($_GET['pricefilter']) && $_GET['pricefilter'] == 2) {
                                                                                            echo 'selected';
                                                                                        } ?>> Lower To Higher </option>
        </select>
    </div>
    <br /><br />
    
    
    <div id="loadingOverlay" class="center" style="visibility: visible;text-align: center;">
        <img class=" ls-is-cached lazyloaded" data-src="assets/loader.gif" loading="lazy" src="assets/loader.gif" style="width:200px;">     
    </div>



    <div id="dataContainer" class="row rowFlexMargin wrapper"></div>
    <div id="paginationContainer" class="row mt-3 text-center"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var currentPage = 1;
        var itemsPerPage = 20; // Number of items to display per page

        // Show loading overlay
        $('#loadingOverlay').show();

        $.ajax({
            url: "preRentingApparel1.php?id=<?php echo $product_id; ?>&type=2&pricefilter=<? echo $pricefilter; ?>",
            dataType: 'json',
            success: function(response) {
                var data = response.data;
                var totalItems = data.length;
                var totalPages = Math.ceil(totalItems / itemsPerPage);

                function displayItems(page) {
                    var startIndex = (page - 1) * itemsPerPage;
                    var endIndex = startIndex + itemsPerPage;
                    var html = '';

                    for (var i = startIndex; i < endIndex && i < totalItems; i++) {
                        var product = data[i];
                        // Create the HTML for each product
                        html += '<div class="col-xs-6 col-md-4 col-lg-3 ftco-animate fadeInUp ftco-animated product_col">';
                        html += '<div class="product">';
                        html += '<a href="' + product.link + '" class="img-prod">';
                        html += product.imgframe;
                        html += '</a>';

                        html += '<div class="text py-3 px-3">';
                        html += '<h3>';
                        html += '<a href="' + product.link + '">' + product.product_name + '</a>';
                        html += '</h3>';
                        html += '<hr style="margin-top: 0rem; margin-bottom: 0.3rem;">';
                        html += '<div class="subpart">';
                        html += '<p style="display:block;">MRP ₹ ' + product.mrp + '</p>';
                        html += '<h6 style="color:red; font-size: 13px; text-decoration: underline; font-weight: 700;">SKU : <a href="' + product.link + '">' + product.sku + '</a></h6>';
                        html += '<div class="d-flex">';

                        html += '<div class="pricing">';
                        html += '<p class="price">';
                        html += '<span class="mr-2 price-dc">Rent ₹ <strong>' + product.addedRentPrice + '</strong> for 3 Days</span>';
                        html += '<br>';
                        html += '<span class="price-sale">Refundable Deposit ₹ <strong>' + product.deposit + '</strong></span>';
                        html += '</p>';
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

                    // Insert the HTML into the dataContainer div
                    $('#dataContainer').html(html);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow');

                    // Hide loading overlay
                    $('#loadingOverlay').hide();
                }

                function displayPagination() {
                    var paginationHtml = '';

                    // Generate the pagination links
                    for (var i = 1; i <= totalPages; i++) {
                        if (i === currentPage) {
                            paginationHtml += '<a href="#" class="page-link active">' + i + '</a>';
                        } else {
                            paginationHtml += '<a href="#" class="page-link">' + i + '</a>';
                        }
                    }

                    // Insert the pagination links into the paginationContainer div
                    $('#paginationContainer').html(paginationHtml);

                    // Add event listener to handle page changes
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

                displayItems(currentPage);
                displayPagination();
                updateActivePageLink(currentPage);
            }
        });
    });
</script>

<?php
include('footer.php');
?>
