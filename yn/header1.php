<div id="shopify-section-vela-header" class="shopify-section"><div id="velaTopbar">
        <div class="container">
            <div class="velaTopbarInner row flexAlignCenter">
                <div class="velaTopbarLeft hidden-xs hidden-sm hidden-md d-flex col-md-4"><i class="icons icon-call-in"> </i> +91 93242 43011 <span class="ml10 mr10">|</span>   <i class="icons icon-envelope"></i>yosshita.neha@gmail.com</div>

                    <div class="velaTopbarCenter text-center col-xs-12 col-md-12 col-lg-4">
                        Free Shipping on all orders over <u>₹5000</u>
                        <!--<a href="https://yosshitaneha.com/list.php?type=2&id=10" class="bg-primary">Shop Now!</a>-->
                        </div>
                        <div class="velaTopbarRight d-flex flexAlignEnd hidden-xs hidden-sm hidden-md d-flex col-md-4">
                            <select class="vela-currency jsvela-currency" id="cur" data-value="INR" >
                                <?
                                $cur_sql = mysqli_query($con,"select distinct(currency) as currency,country from conversion_rates where currency in ('INR','USD','GBP','EUR','AED','SAR','AUD','CAD','HKD','SGD') and status=1 order by country ASC");
                                // $cur_sql = mysqli_query($con,"select distinct(currency) as currency,country from conversion_rates where status=1 order by country ASC");
                                while($cur_sql_result = mysqli_fetch_assoc($cur_sql)){
                                    $currency = $cur_sql_result['currency']; ?>

                                    <option value="<? echo $currency; ?>" <? if($_SESSION['cur'] == $currency){ echo 'selected'; }  ?> >
                                        <? echo $cur_sql_result['currency']; ?>
                                    </option>

                                <? } ?>
                            </select>


                            <div class="hidden-xs">
                                <div class="d-flex velaSocialTop">
                                    <a target="_blank" href="https://www.facebook.com/YosshitaandNehaFashionStudio/">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a target="_blank" href="https://twitter.com/yosshitaneha/">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a target="_blank" href="https://www.instagram.com/yosshitanehafashionstudio/">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a target="_blank" href="https://in.pinterest.com/yosshitaandneha/">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
<script>
    $("#cur").on('change',function(){
        var cur = $("#cur").val();
        $.ajax({
            type: "POST",
            url: 'set_cur.php',
            // url: '<? echo $_SERVER["DOCUMENT_ROOT"] ?>/yn/set_cur.php',
            data: 'cur='+cur,
            success:function(msg) {
                window.location.reload();
            }
        });

    })
</script>


