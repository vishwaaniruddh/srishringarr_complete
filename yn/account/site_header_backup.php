<?php session_start(); 
include_once('../functions.php');



// var_dump($_SERVER);


$userid=$_SESSION['gid'];
$email1=$_SESSION['email'];
$_SESSION['cart']=array();

if($_SESSION['loginstats'] == 1){
    $usrid = $_SESSION['gid'];
} else {
    $usrid = $_SESSION['gid'];
}

$View = "select count(cart_id) as numrow from cart  where user_id='".$usrid."' and status=0";


$table=mysql_query($View,$con);
$table_result=mysql_fetch_assoc($table);

if($table_result){
    $Num_Rows = $table_result['numrow'];
} else {
    $Num_Rows = 0;
}

$count = $Num_Rows;
$_SESSION['cart_amt'] = '';
$_SESSION['product_viewed_count'] = array('userid'=>$usrid,'count'=>0); ?>


<script>

function emptycartfunc()
{
   var confirmr=confirm("Do you want to continue!");
   
   if(confirmr){
    
$.ajax({
    type: 'POST',    
    url:'emptycartprocessr.php',
    data:'',

success: function(msg){
//alert(msg);
if(msg==1)
{
    
  window.open('index.php','_self'); 
}else
{
  alert("Error try again later") ; 
    
}
         }
    });
   }
}

function searchfunc()
{
    //var srch=document.getElementById('srchtxt').value;
    
    $('#formf').attr('action','vsearch.php');
    $('#formf').submit();
}
function addincart()
{
//alert("testdfsf");

$.ajax({
   type: 'POST',    
url:'addincart.php',
data:'',

success: function(msg){
//alert(msg);
var input=msg;
var fields = input.split('#');
var amt= fields[0];
var qty= fields[1];
$('span[data-pet]').val(qty);
        }
    });
}

function addToCart(prodId ,categoryType,price,avail_qty){
    $.ajax({
        type: 'POST',    
        url:'cart.php',
        data:'product_id="'+prodId+'"&typ='+categoryType+"&price="+price+"&avail_qty="+avail_qty,
        success: function(msg){

            console.log(msg);
        }
    });
}
function pay(pid,type,qty){

    var isLoggedIn = <?php echo $_SESSION['loginstats']?>;
    if(isLoggedIn==1){
        window.open('showCart.php','_self')
    } else {
        window.open('login.php','_self')
    }
}
function showcart(){
    $("#cart").toggle();
}
function detail(sid,typ,subcattyp,transtyp,maincatid,subcatid)
{

    document.getElementById('selectedproduct').value=sid;
    
    var slkd=1009;
    var typ =2;
    var subcattyp =2;
    var transtyp=2;
    var maincatid = 8;
    var subcatid =0;
    
    window.open('sdetsTest.php?slkd='+sid+'&slpyt='+typ+'&psbctp='+subcattyp+'&ptrp='+transtyp+'&dmctd='+maincatid+'&dsd='+subcatid,'_self');
}

</script>

<?php /*?>
<div class="top_right" style="float: none !important;">
  <ul>
    <li><a href="contact.php">Contact</a></li>|
    <li><a href="trackorder.php">Track Order</a></li>|
  </ul>
  <ul class="margin-prop">
    <li class="top_link" >
        <?php if($email1!="") { ?>
                <a href="logout.php"><?php echo $email1;?> | logout</a> 
               
            <?php } else {?>
                <a href="login.php">MyAccount</a> 
            <?php } ?>
        </li>
        <li class="top_link">
            <?php 
            if((time() >= strtotime("11:00:00")) && (time() <= strtotime("20:00:00"))) { ?>
                <a href="tel:+91 9321021211" class="call-now btn btn-warning">Call Now</a>
            <?php } else { ?>
                <button id="call-now" class="call-now btn btn-warning" onclick="call();">Call Now</button>
            <?php } ?>
        </li>
        <!--<a href='showcart_details.php?page=all' style="color: white;" >-->
            
            
            <div>
              <div class="shopping-cart">
                  
                  <div class="my-account">
                      <img src="http://yosshitaneha.com/gallery/account.png"> 
                  </div>
                  
                <!--<div class="shopping-cart-header">
                  <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>
                  <div class="shopping-cart-total">
                    <span class="lighter-text">Total:</span>
                    <span class="main-color-text">$2,229.97</span>
                  </div>
                </div> -->
                <div id="ex4" onclick="showcart()" >
                  <span class="p1 fa-stack fa-2x has-badge" data-count="<?php echo $count;?>" >
                    <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                    <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
                  </span>
                </div>
                <?php 
                    $userid = $_SESSION['gid'];
                    $cart = mysql_query("select * from cart where user_id = '".$userid."'");
                    ?>
                <div style="display:none;" id="cart">
                <!--<ul class="shopping-cart-items" >-->
                    <?php while($result = mysql_fetch_assoc($cart)){
                        $productid = $result['product_id'];
                        $actyp = $result['ac_typ'];
                        if($result['ac_typ']=="1")
                        {
                            $sql="SELECT * FROM `product` WHERE `product_id`=".$result['product_id'];
                        }
                        else if($result['ac_typ']=="2")
                        {
                            $sql="select * from  `garment_product` where gproduct_id=".$result['product_id'];
                        }
                        
                        $table=mysql_query($sql,$con);
                        $tableftch=mysql_fetch_array($table);
                        //var_dump($tableftch);
                        $productcode=$tableftch[3];
                        $productname=$tableftch[3];
                        //sdetsTest.php?slkd=1009&slpyt=2&psbctp=2&ptrp=2&dmctd=8&dsd=0

                    ?>
                      <div class="clearfix" onclick="detail(<?php echo $productid; ?>,<?php echo $actyp;?>,2,8,0);">
                        <img class="cart_image" src="http://yosshitaneha.com/uploads/<? echo get_image($productid); ?>" />
                        <span class="item-name"><?php echo $productcode;?></span>
                        <span class="item-name"><?php echo $productname;?></span>
                        <span class="item-price"><?php echo $result['total_amt'];?></span>
                        <span class="item-quantity">Quantity: <?php echo $result['qty'];?></span>
                      </div>
                    <?php  }?>
                <!--</ul>-->
                <a href="showcart_details.php" class="btn btn-info">Checkout</a>
                </div>
                
              </div> 
            </div>
        <!--</a>-->
    </ul>
</div>
<?php */ ?>
<?php /* Ruchi :
<div class="top_left">
  <ul>
      <li class="top_link" >
            <div align="right" >
                <input id="srchtxt" name="srchtxt" type="text" width="100%" value="<?php echo $srchtxt;?>" style="color:#000;">
                <button class="btns" type="button" onclick="searchfunc();" style="color:#000;"> Search</button>
                <label id="srchtxterr"><label>
            </div>
        </li>
        <!--
        <li class="top_link"></li>|-->
        <!--<li class="top_link" style="margin-right:-20px"><a href="checkout.php">
        <font style="color:#fff;"> <div class="total">
          <label><i class="fa fa-inr"></i> <label id="showcount">0.00 (0)</label></label></div>
        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></font></a></li> | <li class="top_link"><a href="javascript:void(0);" class="simpleCart_empty" style="color:#fff;" onclick="emptycartfunc();">Empty Cart</a></li>   
    | -->
    <li class="top_link">
      <?php if($email1!="") { ?>
                <a href="logout.php"><?php echo $email1;?> | logout</a></li>  
            <?php } else {?>
                <a href="login.php">MyAccount</a></li>  
            <?php } ?>
        </li>
  </ul>
</div>

<form action="#">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search" name="srchtxt" id="srchtxt" value="<?php echo $srchtxt;?>">
      <div class="input-group-btn">
        <button class="btn btn-default" type="button" id="search_btn"><i class="glyphicon glyphicon-search" ></i></button>
      </div>
      <!--onclick="searchfunc();" -->
    </div>
</form>
<div class="clearfix"> </div>
</div>

*/?>
<style>
    #ex4{
        display:unset;
    }
    .my-account{
            display: inline-block;
    }
    /*.main-head{*/
    /*        margin: auto 2%;*/
    /*}*/
</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>YN</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="custom_style.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
  
<style>
  .top-header{
    background: #800000;
  }
  .top-header{
    padding: 2%;
  }
  .site-header, .left_part, .left_part ul,.cart_account,.account_search{
    display: flex;
  }
  .cart_account{
        justify-content: flex-end;
  }
  .cart_account div{
    margin:auto;
    
  }
  .cart_account .clearfix{
    margin:auto;
    border-top:1px solid black;
    border-bottom:1px solid black;
    padding : 2%;
  }
.left_part ul{
  
       width: 100%;
    padding: 0;

}

.call-now{
  float: right;
    margin: 1%;
}

  .left_part ul li{
    list-style: none;
    margin: 1%;
  }
  .left_part ul li a{
    color: white;
  }


  .right_part,.left_part{
    width: 50%;
  }

  .search_form{
    width: 85%;
  }
  .cart_account{
    width: 15%;
    position: relative;
  }
  .right_part{
        display: flex;
    justify-content: flex-end;
  }
.login{
  margin: auto;
}
.login a{
  color: white;
}
</style>


<div class="top-header">
  <div class="container">
  <div class="site-header">
      <div class="left_part">
      <ul>
        <li><a href="http://yosshitaneha.com/contact.php">CONTACT |</a></li>
        <li><a href="http://yosshitaneha.com/trackorder.php">TRACK ORDER |</a></li>
      </ul>
      </div>
      <div class="right_part">
          <div class="login">
             <?php if($email1!="") { ?>
               Hello ,<?php echo $email1;?> |<a href="../logout.php"> logout </a>  
                  <?php } else {?>
            <a href="#">Login |</a> 
            <a href="#">Register</a>
               <?php } ?>
          </div>
          <?php 
            if((time() >= strtotime("11:00:00")) && (time() <= strtotime("20:00:00"))) { ?>
                <a href="tel:+91 9321021211" class="call-now btn btn-warning">Call Now</a>
            <?php } else { ?>
                <button id="call-now" class="call-now btn btn-warning" onclick="call();">Call Now</button>
            <?php } ?>
        <!-- <button id="call-now" class="call-now btn btn-warning" onclick="call();">Call Now</button> -->
      </div>
  </div>

  <div class="account_search">
    <div class="search_form">
      <form action="#">
      <div class="input-group">
      <input type="text" class="form-control" placeholder="Search" name="srchtxt" id="srchtxt" value="">
      <div class="input-group-btn">
      <button class="btn btn-default" type="button" id="search_btn"><i class="glyphicon glyphicon-search" ></i></button>
      </div>
      <!--onclick="searchfunc();" -->
      </div>
      </form>
    </div>
    <div class="cart_account">
     <div class="my-account">
          <a href="<?php echo $base_url.'/account/my-account.php';?>"><img src="http://yosshitaneha.com/gallery/account.png"></a> 
      </div>
                <div class="header-cart" id="ex4" onclick="showcart()">
                    <a href="#"><img src="http://yosshitaneha.com/gallery/supermarket.png"></a> 
                    <span class="p1 fa-stack fa-2x has-badge" data-count="<?php echo $count;?>" >
                    <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                    <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
                  </span>
                </div>

                    <?php 
                    $userid = $_SESSION['gid'];
                    $cart = mysql_query("select * from cart where user_id = '".$userid."'");
                    ?>
                <div style="display:none;" id="cart">
                <!--<ul class="shopping-cart-items" >-->
                    <?php while($result = mysql_fetch_assoc($cart)){
                        $productid = $result['product_id'];
                        $actyp = $result['ac_typ'];
                        if($result['ac_typ']=="1")
                        {
                            $sql="SELECT * FROM `product` WHERE `product_id`=".$result['product_id'];
                        }
                        else if($result['ac_typ']=="2")
                        {
                            $sql="select * from  `garment_product` where gproduct_id=".$result['product_id'];
                        }
                        
                        $table=mysql_query($sql,$con);
                        $tableftch=mysql_fetch_array($table);
                        //var_dump($tableftch);
                        $productcode=$tableftch[3];
                        $productname=$tableftch[3];
                        //sdetsTest.php?slkd=1009&slpyt=2&psbctp=2&ptrp=2&dmctd=8&dsd=0
                    ?>
                      <div class="clearfix" onclick="detail(<?php echo $productid; ?>,<?php echo $actyp;?>,2,8,0);">
                        <img style="width:30%;" class="cart_image" src="http://yosshitaneha.com/uploads/<? echo get_image($productid); ?>" />
                        <span class="item-name"><?php echo $productcode;?></span>
                        <span class="item-name"><?php echo $productname;?></span>
                        <span class="item-price"><?php echo $result['total_amt'];?></span>
                        <span class="item-quantity">Quantity: <?php echo $result['qty'];?></span>
                      </div>
                    <?php  }?>
                    
                    
                    
                <!--</ul>-->
                <?php  $base_url="http://".$_SERVER['SERVER_NAME'].'/'; 
                ?>
                <a href="<?php echo $base_url.'/cart.php';?>" class="btn btn-info">Checkout</a>
                </div>
                     
                <!--</div>-->
            </div>
        </div>
        
        
        
  </div>
</div>


<div class="container">
<? include('../menu.php');?>    
</div>









