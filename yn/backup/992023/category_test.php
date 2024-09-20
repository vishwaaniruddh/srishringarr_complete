<?php include('header_raj.php');

$path = "old/Admin/";


function convertString($title)
{
    $title = htmlentities(strip_tags($title));
    $title = ucwords(strtolower($title));
    return $title;
}


?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css"/>
<style>
    .paginationjs .paginationjs-pages li.active>a{
            z-index: 3;
    color: #fff;
    background-color: #ba933e;
    border-color: #ba933e;
    cursor: default;
    }
    .paginationjs .paginationjs-pages li:not(:last-child) {
    margin-right: 8px;
}
.paginationjs .paginationjs-pages li {
    border-right: 1px solid #aaa !important;
    border : 1px solid #aaa !important;
}
.paginationjs .paginationjs-pages li>a{
    font-size:18px;
}
</style>
<main class="mainContent" role="main">
    
    <section id="pageContent">
    <div class="container">
        <div class="pageCollectionInner mb20 pb-md-30">
            <div id="shopify-section-vela-template-collections" class="shopify-section">
                <div class="rowFlex rowFlexMargin">
            		<?php $typ = $_REQUEST['page']; ?>
            		<div class="col-md-12 product-model-sec" id="show">
        		     
        		     <?php
                     if (isset($_REQUEST['page'])& $_REQUEST['page'] == 2 ) {
                         $qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=2 or `Main_id`=3");
                     } else if (isset($_REQUEST)& $_REQUEST['page'] == 1 & !isset($_REQUEST['cid'])) {
                         $qryjew = mysqli_query($con, "SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");
                     } else if (isset($_REQUEST)& $_REQUEST['page'] == 1 ) {
                         $cid = $_REQUEST['cid'];
                         $qryjew = mysqli_query($con, "select * from subcat1  where maincat_id='$cid' and status=1 order by name");
                     } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 3) {
                         $qryjew = mysqli_query($con, "select * from menu  where parent_id>0 and status=1 order by name");
                     }
                     
                         while ($rowjew = mysqli_fetch_assoc($qryjew)) {
                             $cid = '';
                             $pathmain = '';

             ?>
                    
                    
                <div class="col-xs-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="velaBoxCollection mb30 pb-md-30">
                        <div class="velaBoxCollectionImage">
                            
                            <?
                    if(isset($_REQUEST['page']) & $_REQUEST['page'] == 2 ) {
                        
                        $id = $rowjew['garment_id'];
                        $pathmain = $rowjew['garments_image'];
                        $name =$rowjew['name'];
                        $mainCatId =$rowjew['Main_id'];
                        
                    } else if(isset($_REQUEST['page']) & $_REQUEST['page'] == 1 & !isset($_REQUEST['cid'])) {
                        
                        $id = $rowjew['subcat_id'];
                        $pathmain = $rowjew['image'];
                        $name =$rowjew['categories_name'];
                        $mainCatId =$rowjew['mcat_id'];
                        
                        $qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$id' order by name");
        			    $subcategory = mysqli_fetch_assoc($qryjew1);
        			    $cnt = mysqli_num_rows($qryjew1);
        			    
        			    $subcatId = $subcategory['subcat_id'];
    			        $main_catId = $subcategory['maincat_id'];
                        
                    } else if(isset($_REQUEST['page']) & $_REQUEST['page'] == 1) {
                        
                        $pathmain = $rowjew['image'];
                        $name =$rowjew['name'];
                        $mainCatId =$rowjew['maincat_id'];
                        
                        $id = $rowjew['maincat_id'];
                        
                        $subcatId = $rowjew['subcat_id'];
			            $main_catId = $rowjew['maincat_id'];
			        
                    } else if(isset($_REQUEST['page']) && $_REQUEST['page']==3){
                        
                        $pathmain = $rowjew['image'];
                        $name =$rowjew['name'];
                        $id = $rowjew['id'];
                    }
                    
                    if($pathmain!='') {
                        $pathmain = $path.$pathmain;
                    } else {
                        $pathmain ='images/no_img.jpg';
                    }
		        ?>
    		    <?php if (isset($_REQUEST['page'])& $_REQUEST['page'] == 2) { ?>
    			    <a href="javascript:void(0)" onclick="submfunc('<?php echo $id; ?>','0','2','<?php echo $mainCatId; ?>','2');">
    			<?php } else if (isset($_REQUEST['page'])& $_REQUEST['page'] == 1) {


                     if ($cnt > 1) {
                         $cid = $_REQUEST['cid'];
                         $isSub = true; ?>
			        <a href="category_test.php?page=1&cid=<?php echo $id; ?>">
			   <?php } else {
                         $isSub = false;
               ?>
			        <a href="javascript:void(0)" onclick="submfunc('<?php echo $id; ?>','<?php echo $subcatId; ?>','1','<?php echo $mainCatId; ?>','2');">
			   <?php }
               ?>
			<?php }
             ?>
			

                            <a href="list.php?id=<? echo $id; ?>&type=<? echo $typ; ?>">
                                <div class="p-relative">
                                    <div class="product-card__image" style="padding-top:100.0%;">
                                        <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" 
                                        data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" 
                                        data-aspectratio="1.0" data-ratio="1.0" data-sizes="auto" 
                                        src="<? echo $pathmain; ?>"
                                        >
                                    </div>
                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
                                </div>
                                </a>
                            </div>
                            
		    
		                    <div class="velaBoxCollectionContent">
                            <h3 class="collectionTitle">
                                <a href="list.php?id=<? echo $id; ?>&type=<? echo $typ; ?>" title="<? echo convertString($name); ?>"><? echo convertString($name); ?></a>
                            </h3>
                        </div>
                        </div>  
                    </div>           
	    <?php } ?>
	 </div>
    </div>
</div>
        </div>
    </div>
</section>
</main>

<script>
    $(".btnMenuMobile").on('click',function(){
        $("body").addClass('menuMobileActive');
            console.log('click')
    });
    $(".btnMenuClose").on('click',function(){
    $("body").removeClass('menuMobileActive');
    console.log('click')
})

</script>
<?php include('footer.php'); ?>