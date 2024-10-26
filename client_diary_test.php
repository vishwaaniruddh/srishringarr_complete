<? include('header.php');  



function showimg($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from client_diary_details where clientid='".$id."' order by id asc");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['image_url'];
}

?>

<title>Client Diary | Sri Shringarr </title>

<meta name="description" content="Want to know more about our Customers and Products and their experiences?">

<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.js" integrity="sha512-/LtMywMLXZ29TJbETec4e6ndSWPxQDTdsqCud+8Q4IFnKQ1WVlr87r0D5oo9QNO9zuqQNJDmvQxQmvqe8DRYLA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.css" integrity="sha512-HWY8i77pPLL23sU4pHj+5iuZEmmmu2YaiTUcWrBXqBRTpn6yUdDvlFGNmG0qyjDg/vpt+YWNMASjg9M0eOU9DA==" crossorigin="anonymous" />
    <?php
    
    
$directory = 'static/images/site/banner/';
$opendir = opendir($directory);

?>
    


<div class="flexslider" id="web_ban">
  <ul class="slides">
    <?php
    $sql_result2 = mysqli_query($con,"select distinct(image_url) as image from client_diary_details where banner=1") ;
    while($sql_result2_result = mysqli_fetch_assoc($sql_result2))
		    { 
                ?>
                <li style="position:relative; ">
    			    <img src="<?php echo $sql_result2_result['image'] ;?>" style="height:100%;object-fit:contain; max-height:600px;">
                        <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15" style="position:absolute;top:10%;">
        				    <!--<div class="xl-text1 title" ><b>NEW ARRIVALS</b></div>-->
        					<!--<a href="contact_us.php">-->
        				 <!--       <input type="button" class="flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4"  value="Shop now" id="fade" style=" width:120px;height:30px;" />-->
        			  <!--      </a>-->
    				    </div>
    			</li>
                    
                <?php  } ?>

  </ul>
</div>



<script>
    // Can also be used with $(document).ready()
$(document).ready(function() {
    $('.flexslider').flexslider({
        animation: "slide"
});
});
</script>

<br><br>
<hr>
<div class="container">
    <div class="row">
        
        <?php
        $sql = mysqli_query($con,"select * from client_diary where status=1");
        while($sql_result = mysqli_fetch_assoc($sql)){
        $id = $sql_result['id'];
        $title = $sql_result['title'];
        $sku = $sql_result['sku'];
        ?>
            
            <div class="col-sm-4" style="height: 350px; max-height: 350px;">
                <a href="<? echo getlinkbysku($sku); ?>" style="color:blue;text-decoration:underline;" class="open-AddBookDialog" data-toggle="modal" data-getImageDate="<?php echo $id; ?>" data-target="#mediumModal">
                <img src="<? echo showimg($id);?>" style="width:100%; height:100%;object-fit: contain;">
                </a>
                <a href="<? echo getlinkbysku($sku); ?>">
                    <?php echo $title; ?>
                </a>                
            </div>
    
        <? }     ?>

    </div>
</div>


<br><br>



<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="box-shadow: 2px 0px 33px 7px;">

    <div class="modal-dialog modal-lg" role="document" style="margin: 10px; padding: 10px;max-width: inherit; height: 88vh;">
        <div class="modal-content" style="    height: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style=" padding: 0;">

                <div id="aiimage"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("click", ".open-AddBookDialog", function () {
$("#aiimage").html('');
     var id = $(this).data('getimagedate');
     
 $.ajax({

                type: "POST",
                url: 'get_image.php',
                data: 'id='+id,
                success:function(msg) {
                        $("#aiimage").html(msg);
                }
            });
});

</script>

<?php include('footer.php'); ?>
    	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css"> 
