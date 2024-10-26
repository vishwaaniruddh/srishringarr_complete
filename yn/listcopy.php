<?php include('header.php');

$product_type = $_GET['type'];
$product_id = $_GET['id'];
$pricefilter = $_GET['pricefilter'];

$currency = $_SESSION['cur'];
$currencySymbol = $currency_symbol ;

// echo $currency;

?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css"/>
<script type="text/javascript" src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">




<main class="mainContent" role="main">

<section id="pageContent">
<div class="container">
<div class="pageCollectionInner mb20 pb-md-30">
    <div class="row">
<aside id="velaSidebar" class="filterTagFullwidthContent sidebarLeft velaSidebar">
   <div class="filterTagFullwidthClose hidden-xl hidden-lg hidden-md hidden-xl"></div>
   <div class="velaSidebarInner">
                <div id="shopify-section-sidebartop" class="shopify-section">
                  <div id="velaCategories" class="velaCategoriesSidebar velaBlock">
                      <h3 class="titleSidebar">Product Categories</h3>
                  <div class="velaContent">
                          <ul class="sidebarListCategories list-unstyled">
                              <li class="sidebarCateItem active">
                                  <a class="active" href="#">All Categories</a></li>
                                      <?
                      // ini_set('display_errors', 1);
                      // ini_set('display_startup_errors', 1);
                      // error_reporting(E_ALL);
                      $type= $_GET['type'];
                      if($type==1){
                        // echo "1";
                      $cat_sql = mysqli_query($con,"select * from subcat1 order by name");

                      while($cat_sql_result = mysqli_fetch_assoc($cat_sql)){ ?>

                                      <li class="sidebarCateItem">

                                          <input type="checkbox" class="categories" name="categories[]" value="<? echo $cat_sql_result['subcat_id'];?>"  <? if($_GET['id']==$cat_sql_result['subcat_id']){ echo 'checked';}?>>
                                          <? echo ucwords(strtolower($cat_sql_result['name']));?>
                                      </li>

                                          <? }
                      }else if($type==2){
                          //echo "2";
                      $cat_sql=mysqli_query($con,"SELECT * FROM `garments`");
                      while($cat_sql_result=mysqli_fetch_assoc($cat_sql)) {
                      $name = $cat_sql_result['name'];
                      ?>

                                      <li class="sidebarCateItem">

                                          <input type="checkbox" class="categories" name="categories[]" value="<?php echo $cat_sql_result['garment_id']; ?>"  <? if($_GET['id']==$cat_sql_result['garment_id']){ echo 'checked';}?>>
                                          <? echo ucwords(strtolower($name)); ?>
                                      </li>
                                      <?
                      }
                        }
                      ?>
                          </ul>
                      </div>
                  </div>
                </div>
      <div id="shopify-section-sidebarfilter" class="shopify-section">
         <div id="sidebarAjaxFilter" class="velaFilter velaBlock">
            <div class="velaContent">
               <div class="ajaxFilter velaBlock">
                  <h4 class="titleSidebar ajaxFilterTitle">
                     <span>Price</span>
                     <a href="javascript:void(0)" class="velaClear" style="display:none;" title="Clear"><i class="icons icon-close"></i></a>
                  </h4>
                  <div class="demo">
                     <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" readonly>
                     <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <div class="ui-slider-range ui-widget-header" style="left: 28.8%; width: 6.4%;"></div>
                        <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 28.8%;"></a>
                        <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 35.2%;"></a>
                     </div>
                  </div>
                  <script type="text/javascript">
                     function showProducts(minPrice, maxPrice) {
                     $("#products .velaProBlock").hide().filter(function() {
                         var price = parseInt($(this).data("price"), 10);
                         return price >= minPrice && price <= maxPrice;
                     }).show();
                     }
                     var id='<?php echo $product_id ; ?>';
                     var type='<?php echo $product_type ; ?>';
                     var ajaxResult=[];
                     $.ajax({
                             type: "POST",
                             async:true,
                             dataType: "json",
                             url: 'filter/range_price.php',
                             data: 'id='+id+'&type='+type,
                             success:function(msg) {
                                 var mini = msg['start'];
                                 var maxi = msg['end'];
                                 ajaxResult.push(mini);
                                 ajaxResult.push(maxi);
                             }
                     });
                     setTimeout(function(){
                                 $(function() {
                                     var cur = '<? echo $_SESSION['cur'];?>';
                                     var min_ramge1 = parseInt(ajaxResult[0]);
                                     var max_ramge1 = parseInt(ajaxResult[1]);
                                     var min_ramge2 = parseInt(ajaxResult[0]) + 10;
                                     var max_ramge2 = parseInt(ajaxResult[1]) - 10;
                                     var options = {
                                         range: true,
                                         min: min_ramge1,
                                         max: max_ramge1,
                                         values: [min_ramge2, max_ramge2],
                                         slide: function(event, ui) {
                                             var min = ui.values[0],
                                                 max = ui.values[1];
                                             $("#amount").val(cur +' '+ min + "  -  "+cur+' ' + max);
                                             showProducts(min, max);
                                         }
                                     }, min, max;

                                     $("#slider-range").slider(options);

                                     min = $("#slider-range").slider("values", 0);
                                     max = $("#slider-range").slider("values", 1);

                                             $("#amount").val(cur +' '+ min + "  -  "+cur+' ' + max);
                                             // $("#amount").val("$" + min + " - $" + max);

                                     showProducts(min, max);
                                 });
                     }, 3000);
                  </script>
               </div>
            </div>
         </div>
      </div>

   </div>
</aside>
                <div id="proListCollection" class="velaCenterColumn velaCenterColumnFix col-xs-12 col-sm-12">
                    <div id="shopify-section-vela-template-collection" class="shopify-section"  >
<div class="filterCollectionFullwidth"><div class="filterTagFullwidth hidden-xl hidden-md hidden-lg">
	                <div class="filterTagFullwidthButton">
	                    <i class="fa fa-sliders"></i>
	                    <span>Filter</span>
	                </div>
	            </div><div class="collBoxSort">
                <div class="collView">
    <button class="changeView changeViewGrid changeViewActive" type="button" title="Grid view" data-view="grid">
        <span class="iconChangeView">
            <svg fill="currentColor" preserveAspectRatio="xMidYMid meet" height="16" width="16" viewBox="0 0 16 16" title="Grid" style="vertical-align:middle"><title>Grid</title><g><path d="M1,3.80447821 L1,1 L3.80447821,1 L3.80447821,3.80447821 L1,3.80447821 Z M6.5977609,3.80447821 L6.5977609,1 L9.4022391,1 L9.4022391,3.80447821 L6.5977609,3.80447821 Z M12.1955218,3.80447821 L12.1955218,1 L15,1 L15,3.80447821 L12.1955218,3.80447821 Z M1,9.4022391 L1,6.59706118 L3.80447821,6.59706118 L3.80447821,9.4022391 L1,9.4022391 Z M6.5977609,9.4022391 L6.5977609,6.5977609 L9.4022391,6.5977609 L9.4022391,9.4022391 L6.5977609,9.4022391 Z M12.1955218,9.4022391 L12.1955218,6.59706118 L15,6.59706118 L15,9.4022391 L12.1955218,9.4022391 Z M1,14.9993003 L1,12.1948221 L3.80447821,12.1948221 L3.80447821,14.9993003 L1,14.9993003 Z M6.5977609,14.9993003 L6.5977609,12.1948221 L9.4022391,12.1948221 L9.4022391,14.9993003 L6.5977609,14.9993003 Z M12.1955218,14.9993003 L12.1955218,12.1948221 L15,12.1948221 L15,14.9993003 L12.1955218,14.9993003 Z"></path></g></svg>
            <span class="hidden">Grid view</span>
        </span>
    </button>

</div>
<div class="collSortBy  pull-right">
<!-- <label for="SortBy">Default sorting</label> -->
<select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="width: auto;">

   <option>Select</option>
    <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type; ?>&pricefilter=1" <?php  if(isset($pricefilter) && $pricefilter==1){ echo 'selected'; }?>>Higher To Lower</option>
        <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type;?>&pricefilter=2" <?php  if(isset($pricefilter) && $pricefilter==2){ echo 'selected'; }?>> Lower To Higher </option>
    </option>
</select>
</div>

            </div>
        </div>

        <div id="msgalerts"></div>
    <div class="collBoxProducts">
        <div  class="proList grid" id="list1">
            <div class="rowFlex rowFlexMargin wrapper" id="products">
                    <div id="custloader" style="width:100%; text-align:center;"><div class="loadingio-spinner-eclipse-w42oo7vkqqq"><div class="ldio-kpxe4ypb4vk"><div></div></div></div><p style="text-align:center; font-size:20px;margin:10px auto ;">Please Wait..</p></div>

            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</section>
        </main>


<style type="text/css">
@keyframes ldio-kpxe4ypb4vk {
  0% { transform: rotate(0deg) }
  50% { transform: rotate(180deg) }
  100% { transform: rotate(360deg) }
}
.ldio-kpxe4ypb4vk div {
  position: absolute;
  animation: ldio-kpxe4ypb4vk 1s linear infinite;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  box-shadow: 0 4px 0 0 #deb34b;
  transform-origin: 80px 82px;
}
.loadingio-spinner-eclipse-w42oo7vkqqq {
  width: 200px;
  height: 200px;
  display: inline-block;
  overflow: hidden;
  /*background: #f1f2f3;*/
}
.ldio-kpxe4ypb4vk {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0; /* see note above */
}
.ldio-kpxe4ypb4vk div { box-sizing: content-box; }
/* generated by https://loading.io/ */
</style>



<div id="q"></div>

<style>
    .flash {
  display: block;
  position: fixed;
  top: 125px;
  right: 25px;
  width: 350px;
  padding: 20px 25px 20px 85px;
  font-size: 16px;
  font-weight: 400;
  color: #66847C;
  background-color: #FFF;
  border: 2px solid #66847C;
  border-radius: 2px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
  opacity: 0;
  z-index:100;
  /*display:none;*/
}

.flash__icon {
  position: absolute;
  top: 50%;
  left: 0;
  width: 1.8em;
  height: 100%;
  padding: 0 0.4em;
  background-color: #66847C;
  color: #FFF;
  font-size: 36px;
  font-weight: 300;
  transform: translate(0, -50%);
}
.flash__icon .icon {
  position: absolute;
  top: 50%;
  transform: translate(0, -50%);
}

.button {
  position: absolute;
  top: 50%;
  left: 50%;
  padding: 10px 20px;
  border: 2px solid #66847C;
  border-radius: 2px;
  color: #66847C;
  transform: translate(-50%, -50%);
  transition: all 0.1s;
}
.button:hover {
  cursor: pointer;
  color: #FFF;
  background-color: #66847C;
}
.button:active {
  box-shadow: none;
  background-color: #5f7b74;
}

@-webkit-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@-moz-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@-o-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
.animate--drop-in-fade-out {
  -webkit-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -moz-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -ms-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -o-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
}
</style>



<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>

<script>
$(document).on('click','.custquickview , .btnProductQuickview',function(){
   var productid = $(this).attr('data-pid');
    var type = '<? echo $_GET['type']; ?>';
        $.ajax({
                type: "POST",
                url: '<? $_SERVER["DOCUMENT_ROOT"]; ?>/quickview.php',
                data: 'id='+productid+'&type='+type,
                success:function(msg) {

                    if(msg){
                    $("#q").html(msg);
                    $("#loading").css('display','none');
                    }else{
                        $("#loading").css('display','none');
                        alert('Try Again');
                    }

                }
   });

});

function addtocart(pid,type,price,image,sku){
       var qty = '1';
	   var status = '1';
	   var ac_type = '2';
       $.ajax({
                type: "POST",
                url: '<? $_SERVER["DOCUMENT_ROOT"]; ?>/addtocart.php',
                data: 'qty='+qty+'&pid='+pid+'&type='+type+'&price='+price+'&status='+status+'&ac_type='+ac_type+'&image='+image+'&sku='+sku,
                success:function(msg) {
                    if(msg==1){
                        $("#msgalerts").html('<div class="flash"><div class="flash__icon"><i class="icon fa fa-check-circle-o"></i></div><p class="flash__body">Success!</p></div>');
                             $( ".flash" ).addClass( "animate--drop-in-fade-out" );
                              setTimeout(function(){
                                $( ".flash" ).removeClass( "animate--drop-in-fade-out" );
                              }, 3500);


                    $("#cartDrawer").load('<? $_SERVER["DOCUMENT_ROOT"]; ?>/cartdrawer.php');

                    }else if(msg==2){
                        $("#msgalerts").html('<div class="alert alert-danger" role="alert">Error In Added To Cart</div>');
                        alert('Error In Added To Cart');
                    }else if(msg==0){
                        $("#msgalerts").html('<div class="flash"><div class="flash__icon"><i class="icon fa fa-times-circle-o"></i></div><p class="flash__body">Selected Quantity is Higher than Available Quantity!</p></div>');
                             $( ".flash" ).addClass( "animate--drop-in-fade-out" );
                              setTimeout(function(){
                                $( ".flash" ).removeClass( "animate--drop-in-fade-out" );
                              }, 3500);
                    }
                }
       });
	}



$(document).on('change','.categories',function(){
    var searchIDs = $('input.categories:checked').map(function(){
      return $(this).val();
    });

var type='<?php echo $product_type ; ?>';
var pricefilter='<?php echo $pricefilter ; ?>';
// var currency='<?php echo $cur ; ?>';
    $.ajax({
        type: "POST",
        url: '<? $_SERVER["DOCUMENT_ROOT"]; ?>/list_jsoncopy.php',
        data: 'id='+searchIDs.get()+'&type='+type+'&pricefilter='+pricefilter,
        // data: 'id='+searchIDs.get()+'&type='+type+'&pricefilter='+pricefilter+'&currency='+currency,
        success:function(msg) {
    $('#list1 .wrapper').html('here');
      document.documentElement.scrollTop = 0;
    $('#list1').pagination({
      dataSource: msg,
      pageSize: 20,
      callback: function(data, pagination) {
          var wrapper = $('#list1 .wrapper').empty();
          $.each(data, function (i, f) {

              var onclickvar = "onclick=\"addtocart('" + f.pid + "','"+type+"','"+f.selling_price+"','"+f.image+"','"+f.sku+"')\"";
             $('#list1 .wrapper').prepend('<div class="velaProBlock grid col-xs-6 col-md-4 col-lg-3" data-price="'+f.selling_price+'"><div class="velaProBlockInner"><div class="proHImage d-flex flexJustifyCenter"><a class="proFeaturedImage" href="'+f.link+'"><div class="wrap "><div class="p-relative"><div class="product-card__image" style="padding-top:124.25%;"><img class="product-card__img lazyautosizes lazyloaded"  alt="" src="'+f.com_image+'"></div><div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div></div></div></a><div class="productLable"></div><div class="proButton clearfix"><a class="btn btnProduct btnAddToCart" href="#" '+onclickvar+' title="Quick Add"><span class="icons icon-handbag"></span><span class="select_options text">Quick Add</span></a></div></div><div class="proContent"><h5 class="proName"><a href="'+f.link+'">'+f.product_name+'</a></h5><h6 class="sku">SKU:<a href="'+f.link+'"> '+f.sku+'</h6><div class="groupPrice clearfix"><div class="proPrice"><div class="priceProduct "><span class="mymoney" currency="<? echo $currency; ?>" amount='+f.selling_price+'>PRICE: '+ f.symbol+' '+ f.selling_price+'</span></div></div></div></div></div></div>');
          });
        }
        // console.log($currency);
       });
        }
    });
});

$("li").click(function() {
   var colorClass = this.className;

});

var id=['<?php echo $product_id ; ?>'];
var type='<?php echo $product_type ; ?>';
var pricefilter='<?php echo $pricefilter ; ?>';
// var currency='<?php echo $cur ; ?>';
            $.ajax({
                        type: "POST",
                        url: '<? $_SERVER["DOCUMENT_ROOT"]; ?>/list_jsoncopy.php',
                        data: 'id='+id+'&type='+type+'&pricefilter='+pricefilter,
                        success:function(msg) {
                            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                            $('#list1').pagination({
                          dataSource: msg,
                          pageSize: 20,
                          callback: function(data, pagination) {
                            var wrapper = $('#list1 .wrapper').empty();
                            $.each(data, function (i, f) {
                            var onclickvar = "onclick=\"addtocart('" + f.pid + "','"+type+"','"+f.selling_price+"','"+f.image+"','"+f.sku+"')\"";
                            
                            if(f.discount > 0){
                                var show = '<div class="velaProBlock grid col-xs-6 col-md-4 col-lg-3" data-price="'+f.selling_price+'"><div class="velaProBlockInner"><div class="proHImage d-flex flexJustifyCenter"><a class="proFeaturedImage" href="'+f.link+'"><div class="wrap "><div class="p-relative"><div class="product-card__image">'+f.imageframe+'</div><div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div></div></div></a><div class="productLable"></div><div class="proButton clearfix"><a '+onclickvar+' class="btn btnProduct btnAddToCart" href="#" title="Quick Add"><span class="icons icon-handbag"></span><span class="select_options text">Quick Add</span></a></div></div><div class="proContent"><h5 class="proName"><a href="'+f.link+'">'+f.product_name+'</a></h5><h6 class="sku">SKU:<a href="'+f.link+'"> '+f.sku+'</h6><div class="groupPrice clearfix"><div class="proPrice"><div class="priceProduct ">  <span class="mymoney" currency="<? echo $currency; ?>"amount='+f.selling_price+'>PRICE: '+ f.symbol+' '+ f.selling_price+'</span> <del><span class="mymoney" currency="<? echo $currency; ?>" amount='+f.actual_price+'>  '+ f.symbol+' '+ f.actual_price+'</span></del></div></div></div></div></div></div>'
                            } else {
                                var show = '<div class="velaProBlock grid col-xs-6 col-md-4 col-lg-3" data-price="'+f.selling_price+'"><div class="velaProBlockInner"><div class="proHImage d-flex flexJustifyCenter"><a class="proFeaturedImage" href="'+f.link+'"><div class="wrap "><div class="p-relative"><div class="product-card__image">'+f.imageframe+'</div><div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div></div></div></a><div class="productLable"></div><div class="proButton clearfix"><a '+onclickvar+' class="btn btnProduct btnAddToCart" href="#" title="Quick Add"><span class="icons icon-handbag"></span><span class="select_options text">Quick Add</span></a></div></div><div class="proContent"><h5 class="proName"><a href="'+f.link+'">'+f.product_name+'</a></h5><h6 class="sku">SKU:<a href="'+f.link+'"> '+f.sku+'</h6><div class="groupPrice clearfix"><div class="proPrice"><div class="priceProduct ">  <span class="mymoney" currency="<? echo $currency; ?>"amount='+f.selling_price+'>PRICE: '+ f.symbol+' '+ f.selling_price+'</span></div></div></div></div></div></div>';
                            }
                            
                            $('#list1 .wrapper').append(show);
                            // $('#list1 .wrapper').append('<div class="velaProBlock grid col-xs-6 col-md-4 col-lg-3" data-price="'+f.selling_price+'"><div class="velaProBlockInner"><div class="proHImage d-flex flexJustifyCenter"><a class="proFeaturedImage" href="'+f.link+'"><div class="wrap "><div class="p-relative"><div class="product-card__image">'+f.imageframe+'</div><div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div></div></div></a><div class="productLable"></div><div class="proButton clearfix"><a '+onclickvar+' class="btn btnProduct btnAddToCart" href="#" title="Quick Add"><span class="icons icon-handbag"></span><span class="select_options text">Quick Add</span></a></div></div><div class="proContent"><h5 class="proName"><a href="'+f.link+'">'+f.product_name+'</a></h5><h6 class="sku">SKU:<a href="'+f.link+'"> '+f.sku+'</h6><div class="groupPrice clearfix"><div class="proPrice"><div class="priceProduct ">  <span class="mymoney" currency="<? echo $currency; ?>"amount='+f.selling_price+'>PRICE: '+ f.symbol+' '+ f.selling_price+'</span> <?php if('+f.discount+' ) {?> <div class="priceProduct priceCompare"><span class="mymoney" currency="<? echo $currency; ?>" amount='+f.selling_price+'> '+ f.symbol+' '+ f.actual_price+'</span></div><?php } ?></div></div></div></div></div></div>');
                   });
                }
                // console.log($currency);
              });

            }
            });

</script>