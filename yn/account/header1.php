<div id="shopify-section-vela-header" class="shopify-section"><div id="velaTopbar">
        <div class="container">
            <div class="velaTopbarInner row flexAlignCenter">
                <div class="velaTopbarLeft hidden-xs hidden-sm hidden-md d-flex col-md-4"><i class="icons icon-call-in"></i> +91 93242 43011<span class="ml10 mr10">|</span>   <i class="icons icon-envelope"></i>yosshita.neha@gmail.com
</div><div class="velaTopbarCenter text-center col-xs-12 col-md-12 col-lg-4">
                        Free shipping on all orders over <u>5000</u><a href="/collections/all" class="bg-primary">shop Now!</a>
                    </div><div class="velaTopbarRight d-flex flexAlignEnd hidden-xs hidden-sm hidden-md d-flex col-md-4">
                        
                        
                        
                        
    
    <select class="vela-currency jsvela-currency" id="cur">
        <option value="INR" <? if($_SESSION['cur']=='INR'){ echo 'selected';} ?>>INR</option>
        <option value="USD" <? if($_SESSION['cur']=='USD'){ echo 'selected';} ?>>USD</option>
    </select>
    
    
    
    


<div class="hidden-xs">
                            <div class="d-flex velaSocialTop">
    <a target="_blank" href="https://www.facebook.com/velatheme">
        <i class="fa fa-facebook"></i>
    </a>
    <a target="_blank" href="https://twitter.com/velatheme">
        <i class="fa fa-twitter"></i>
    </a>
    <a target="_blank" href="https://www.instagram.com/velatheme/">
        <i class="fa fa-instagram"></i>
    </a>
    <a target="_blank" href="https://www.pinterest.com/velatheme/">
        <i class="fa fa-pinterest"></i>
    </a>
</div>
                        </div></div>
            </div>
        </div>
    </div>



<script>
    $("#cur").on('change',function(){
        var cur = $("#cur").val();
        
        $.ajax({

            type: "POST",
            url: 'set_cur.php',
            data: 'cur='+cur,
            success:function(msg) {
                
                window.location.reload();
                
            }
        });

    })
</script>


