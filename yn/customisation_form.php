<?php include('header.php');

$type   = $_GET['type'];
$id     = $_GET['id'];
$userid = $_SESSION['userid'];

//  if($type=="1")
//    {
//        $sql="SELECT * FROM `product` WHERE `product_id`='".$id."'";
//    }
//    else
   if($type=="2")
   {
       $sql="select * from  `garment_product` where gproduct_id='".$id."'";
   }

   $table=mysqli_query($con,$sql);
   $rws=mysqli_fetch_array($table);
   $sku = $rws[2];


//  if($type=="1")
//    {
//        $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='$id' order by rank";
//    }
//    else
if($type=="2")
   {
       $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$id' order by rank";
   }

   $qryimg=mysqli_query($con,$sqlimg);
   $rowimg=mysqli_fetch_row($qryimg);
   $pathmain = 'https://yosshitaneha.com/';
   $path = trim($pathmain."uploads".$rowimg[0]);
            $source_img = trim("yn/uploads".$rowimg[0]);
            $filename = basename($source_img);
            $_file_parent = "https://yosshitaneha.com/";
            $_new_filename = $_file_parent.$source_img;
            // $destination_img = 'comimage/com_'.$filename;
            if(!file_exists($_new_filename)){
               $destination_img =  $path;
            }else{
                $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
            }
            $imgframe = '<img class="lazyload img-fluid product_img" style="width:400px;height:400px; object-fit: contain; user-select: auto;" data-src="' . $destination_img . '">';



?>
<style>
.main-panel{
  transition: width 0.25s ease, margin 0.25s ease;
    width: calc(100% - 255px);
    min-height: calc(100vh - 70px);
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    margin:auto;
}
</style>
<div class="main-panel">
  <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Customisation Form</h4>
            <form class="form-sample" action="customisationData.php" method="post" enctype="multipart">

                  <input type="hidden" name="id" value="<?php echo $id;?>">
                  <input type="hidden" name="type" value="<?php echo $type;?>">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" placeholder="Name" required />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Contact</label>
                    <div class="col-sm-9">
                      <input type="text" name="contact" maxlength="10" class="form-control" placeholder="Mobile Number" required/>
                      <!-- <input type="number" name="contact" max="10" class="form-control" required/> -->

                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Requirements</label>
                    <div class="col-sm-9">
                      <input type="text" name="requirement" class="form-control" placeholder="Requirements" required/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check1" class="form-check-input">
                            Exact Same Design
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check2" class="form-check-input">
                            Same Design but Different Size
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check3" class="form-check-input">
                            Same Design Different Colour
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check4" class="form-check-input">
                            Same Design Different Fabric
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check5" class="form-check-input">
                            Same Design Different Design
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="check6" class="form-check-input" id="check6_0" onclick="setCheck('0')">
                            Any Other Specifications
                          </label>
                          <textarea class="form-control" name="textarea" id="textarea" rows="4" style="display:none;"></textarea>

                        </div>
                      </div>
                      <!-- <div class="form-group">
                          <textarea class="form-control" name="textinput" id="textarea" rows="4"></textarea>
                      </div> -->
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Image</label>
                    <div class="col-sm-9">
                      <?php echo $imgframe;?>
                     <!-- <img src="" style="width:300px;height:300px;" alt="image"> -->
                    </div>
                  </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">SKU:</label>
                      <div class="col-sm-9">
                        <input type="text" name="sku" value="<?php echo $sku;?>" readonly>
                      </div>
                    </div>
                </div>
              </div>
                <button type="submit" name="submit" class="btn btnAddToCart" style="color:white;">Order</button>
            </form>
          </div>
        </div>
  </div>
      </div>
      <script>
        function setCheck(val)
            {
              if($("#check6_"+val).is(":checked"))
              {
                $("#textarea").show();
              }
              else{
                $("#textarea").hide();
              }
            }
      </script>
      <?php include 'footer.php';?>



