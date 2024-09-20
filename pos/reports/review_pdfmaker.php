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


<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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




<? 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
     
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">



            
<form action="process_pdfmaker.php" method="POST">
    
    <div class="row">
        <div class="col-sm-12">
            <label>
                Enter PDF Name
            </label>
            <input type="text" name="pdfName" class="form-control" required />
            
        </div>
    </div>
    
    <?php
    $sku = $_REQUEST['sku'];
    $skuar = explode(',', $sku);

    foreach ($skuar as $k => $v) {
        $sku = explode('-', $v)[0];
        $product_id = explode('-', $v)[1];

        $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$product_id'";
        $qryimg = mysqli_query($web_con, $sqlimg);

        if (!$qryimg || mysqli_num_rows($qryimg) == 0) {
            $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`='$product_id'";
            $qryimg = mysqli_query($web_con, $sqlimg);
        }

        if ($qryimg && mysqli_num_rows($qryimg) > 0) {
            $rowimg = mysqli_fetch_array($qryimg);
        }
        
        // echo $sqlimg ; 

        // $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$product_id' ORDER BY rank";
        // $qryimg = mysqli_query($web_con, $sqlimg);
            $pathmain = 'https://srishringarr.com/yn/';

        $html = '';

        echo '<div class="card">
            <div class="card-header">
                <h3>SKU :' . $sku . ' </h3>
            </div>
            <div class="card-body">
                <div class="row">';
        while ($rowimg23 = mysqli_fetch_array($qryimg)) {

            $img = str_replace("/ ", "/", $rowimg23[0]);
            $path = trim($pathmain . "uploads" . $img);
            $expl = explode('/', $path);
            $cnt = count($expl);
            $angle_img = trim($pathmain . "thumbs/" . trim($expl[$cnt - 1]));

            $zoom_img = $path;
            ?>
                    <div class="col-sm-3">
                        <div class="img-box">
                            <img src="<?php echo $zoom_img; ?>" alt="<?= $product_name; ?>" style="width:200px;" onclick="toggleRadio(this)" />
                            <br />
                            <input type="radio" class="radio-group <?= $sku . '-' . $product_id; ?>" name="<?= $sku . '-' . $product_id; ?>" value="<?= $v . '-' . basename($angle_img); ?>" />
                        </div>
                    </div>
            <?php
        }
        echo '</div>
            </div>
        </div>';
    }
    ?>
    <input type="submit" name="submit" value="Submit" />
</form>

<script>
    function toggleRadio(imgElement) {
        // Get the closest radio button to the clicked image within the same group
        var radioBtn = imgElement.closest('.img-box').querySelector('.radio-group');
        // Toggle the checked state
        radioBtn.checked = !radioBtn.checked;
    }
</script>

            
            
        </div>
    </div>
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