<?php session_start() ; 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('../top-header.php');?>
     <?php include('../top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <?php include('../navbar.php');
                $con = OpenSrishringarrCon();
                ?>
                
                <!-- partial -->
                  <div class="main-panel">
                        <div class="content-wrapper">



<script>
    function disable(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Think twice to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        }).then((result) => {
            if (result.isConfirmed) {

                jQuery.ajax({
                    type: "POST",
                    url: 'disable_user.php',
                    data: 'id=' + id,
                    success: function (msg) {

                        if (msg == 1) {
                            Swal.fire(
                                'Updated!',
                                'Status has been changed.',
                                'success'
                            );

                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);

                        } else if (msg == 0 || msg == 2) {

                            Swal.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            );



                        }

                    }
                });


            }
        })

    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    
        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }

        .tab-content {
            padding: 20px;
        }

        .tab-buttons {
            margin-bottom: 20px;
        }

        .tab-button {
            cursor: pointer;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .tab-button.active {
            background-color: #3498db;
            color: #fff;
        }
        select.form-control{
            border:1px solid black;
            color:black;
        }
</style>
    
    <section class="card">
        <div class="card-body">
            
     <!--<form action="process_pdfmaker.php" method="POST">-->
     
     <form action="review_pdfmaker.php" method="POST">
         <textarea id="skus" name="sku" style="width:100%"></textarea>
         <br />
        <button>Generated PDF</button>
        
        
        
        
     </form>       
            
            <hr />
            <div class="tab-buttons" style="
    display: flex;
    justify-content: center;
">
                <button class="tab-button active" id="apparelTab" onclick="openTab('apparel')">Apparel</button>
                <button class="tab-button" id="jewelTab" onclick="openTab('jewellery')">Jewellery</button>
              <div>
        <div style="display:flex;">
            <input type="text" id="minPrice" name="minPrice" class="form-control" value="" placeholder="min price" style="width: 50%;">
            <input type="text" id="maxPrice" name="maxPrice" class="form-control" value="" placeholder="max price" style="width: 50%;">
        </div>
        
        
    <br />
        <input type="submit" name="submit" id="rentFilter" value="Apply Rent Filter" class="btn btn-primary">
        
        <input type="submit" name="submit" id="sellFilter" value="Apply Sell Filter" class="btn btn-danger">
    
      </div>
    
            </div>

    
    
            <div id="apparel" class="tab active">
                <div class="tab-content">
                    <select id="garmentid" name="garmentid" class="form-control">
                        <option> Select </option>
                        <?
                        $garsql = mysqli_query($web_con,"SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
                        while($garsql_result = mysqli_fetch_assoc($garsql)){
                            $name = $garsql_result['name'];
                            $garment_id = $garsql_result['garment_id'];    
                            echo '<option value="'.$garment_id.'">'.ucwords(strtolower($name)).'</option>' ;
                        }
                        ?>
                    </select>
                    <div id="garmentdestailsShow"></div>
                </div>
            </div>
            
            <div id="jewellery" class="tab">
                <div class="tab-content">
                   <select id="jewelid" name="jewelid" class="form-control">
                        <option> Select </option>
                        <?
                        $garsql = mysqli_query($web_con,"select * from subcat1");
                        while($garsql_result = mysqli_fetch_assoc($garsql)){
                            $name = $garsql_result['name'];
                            $subcat_id = $garsql_result['subcat_id'];    
                            echo '<option value="'.$subcat_id.'">'.ucwords(strtolower($name)).'</option>' ;
                        }
                        ?>
                    </select>
                    <div id="jewelDetailsShow"></div>
                    
                </div>
            </div>
     

            <script>
            
            
        $(document).on('click', '#rentFilter', function () {
           
             if ($('.product_grid').length === 0) {
                swal.fire("Select Category First !");
                return;
            }
            
            
            var minPrice = parseFloat($("#minPrice").val());
            var maxPrice = parseFloat($("#maxPrice").val());
            
            
            if (isNaN(minPrice) && isNaN(maxPrice)) {
                swal.fire("Enter minimum and maximum values !");
                return;
            }
            
            
            $('.product_grid').each(function () {
                var rentPrice = parseFloat($(this).data('rent_price'));
                if (
                    (isNaN(minPrice) || rentPrice >= minPrice) &&
                    (isNaN(maxPrice) || rentPrice <= maxPrice)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
           });
           
                 Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Sorted With Rent values !",
                  showConfirmButton: false,
                  timer: 1500
                });
    

        });

            
         $(document).on('click', '#sellFilter', function () {
            
             if ($('.product_grid').length === 0) {
                swal.fire("Select Category First !");
                return;
            }
            
            var minPrice = parseFloat($("#minPrice").val());
            var maxPrice = parseFloat($("#maxPrice").val());

            if (isNaN(minPrice) && isNaN(maxPrice)) {
                swal.fire("Enter minimum and maximum values !");
                return;
            }
            
            
            $('.product_grid').each(function () {
                var sellingPrice = parseFloat($(this).data('selling_price'));
                if (
                    (isNaN(minPrice) || sellingPrice >= minPrice) &&
                    (isNaN(maxPrice) || sellingPrice <= maxPrice)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
           });
           
           Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Sorted With Sell values !",
              showConfirmButton: false,
              timer: 1500
            });

        });

            
            
            
            function openTab(tabName) {
                var tabs = document.getElementsByClassName('tab');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active');
        }

        var tabButtons = document.getElementsByClassName('tab-button');
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove('active');
        }


        document.getElementById(tabName).classList.add('active');

        var activeTabButton = document.querySelector('.tab-button[data-tab="' + tabName + '"]');
        activeTabButton.classList.add('active');
        
        
var currentActiveButton = document.querySelector('.tab-button.active');

console.log(currentActiveButton)

if (currentActiveButton) {
    currentActiveButton.classList.remove('active');
}

var newActiveButton = document.querySelector('.tab-button');
if (newActiveButton) {
    newActiveButton.classList.add('active');
}



    }
    
    $(document).on('click','#jewelTab',function(){
        
        $(this).addClass('active');
        $("#apparelTab").removeClass('active');

    });
    $(document).on('click','#apparelTab',function(){
        
        $(this).addClass('active');
        $("#jewelTab").removeClass('active');

    });
</script>
        </div>
    </section>
    </div>
</div>
    
    
   

    
    
<script>

//  var productid = $(this).data('productid');
       
 var uniqueSkus = new Set();

    $(document).on('click', '.addInExclusiveCollection', function () {
      var productId = $(this).data("productid");
      var sku = $(this).data("sku");
      var combinedString = sku + "-" + productId;

      // Check if the combinedString is not already in the set
      if (!uniqueSkus.has(combinedString)) {
        // Add the unique value to the set
        uniqueSkus.add(combinedString);

        // Set the result in the textarea
        $("#skus").val([...uniqueSkus].join(','));
      }
    });
    
    $(document).on('change','#garmentid',function(){
       $("#garmentdestailsShow").html('');
       var garmentid = $(this).val();
        $.ajax({
            url: "./garmentdestailsShowPDF.php",
            data: 'garmentid='+garmentid,
            success: function(response) {
               $("#garmentdestailsShow").html(response);
            }
        });
    });
      $(document).on('change','#jewelid',function(){
         $("#jewelDetailsShow").html('');
       var jewelid = $(this).val();
        $.ajax({
            url: "./jeweldestailsShowPDF.php",
            data: 'jewelid='+jewelid,
            success: function(response) {
               $("#jewelDetailsShow").html(response);
            }
        });
    });
</script>
    
    	    </div>
                	
                	 <?php include('../footer.php');?>
                  </div>

    </div>

</div>

<script src="vendors/js/vendor.bundle.base.js">
</script>
<script src="vendors/js/vendor.bundle.addons.js">
</script>

<script src="js/off-canvas.js">
</script>
<script src="js/hoverable-collapse.js">
</script>
<script src="js/misc.js">
</script>
<script src="js/settings.js">
</script>
<script src="js/todolist.js"></script>

<script src="js/data-table.js"></script>
<script src="js/data-table2.js"></script>
<script src="js/select2.js"></script>
            
</body>
</html>