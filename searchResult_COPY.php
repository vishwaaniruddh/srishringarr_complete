<?php session_start();

include('header.php'); 

$searchText = $_REQUEST['query'];
echo "$searchText";

if($searchText){ ?>
  <style>
    .col-xs-6 {
      width: 50%;
      padding-left: 3px;
      padding-right: 3px;
    }
    
    .loader {
      color: #e6be6e;
      font-size: 90px;
      text-indent: -9999em;
      overflow: hidden;
      width: 1em;
      height: 1em;
      border-radius: 50%;
      margin: 72px auto;
      position: relative;
      -webkit-transform: translateZ(0);
      -ms-transform: translateZ(0);
      transform: translateZ(0);
      -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
      animation: load6 1.7s infinite ease, round 1.7s infinite ease;
    }
    
    @-webkit-keyframes load6 {
      0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
      5%,
      95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
      10%,
      59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
      }
      20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
      }
      38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
      }
      100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
    }
    
    @keyframes load6 {
      0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
      5%,
      95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
      10%,
      59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
      }
      20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
      }
      38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
      }
      100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
    }
    
    @-webkit-keyframes round {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
    @keyframes round {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
    p {
      color: #000;
    }
    
    .product_col:hover .product_img {
      transition: transform 1.2s;
      transform: scale(1.5);
    }
    
    div.subpart * {
      all: initial;
      all: unset;
    }
    
    .formob {
      text-transform: uppercase;
    }
    
    p,
    span,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: Montserrat-Regular !important;
    }
    
    .ftco-animate {
      /*opacity: 0;*/
      /*visibility: hidden;*/
    }
    
    .product {
      display: block;
      width: 100%;
      margin-bottom: 30px;
      position: relative;
      -moz-transition: all .3s ease;
      -o-transition: all .3s ease;
      -webkit-transition: all .3s ease;
      -ms-transition: all .3s ease;
      transition: all .3s ease;
    }
    
    .product .img-prod {
      position: relative;
      display: block;
      overflow: hidden;
    }
    
    a {
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease;
      color: #ffa45c;
    }
    
    .product .img-prod img {
      -webkit-transform: scale(1);
      -moz-transform: scale(1);
      -ms-transform: scale(1);
      -o-transform: scale(1);
      transform: scale(1);
      -moz-transition: all .3s ease;
      -o-transition: all .3s ease;
      -webkit-transition: all .3s ease;
      -ms-transition: all .3s ease;
      transition: all .3s ease;
    }
    
    .img-fluid {
      max-width: 100%;
      height: auto;
      min-height: 350px;
      object-fit: cover;
    }
    
    img {
      vertical-align: middle;
      border-style: none;
    }
    
    .product .img-prod span.status {
      position: absolute;
      top: 10px;
      left: -1px;
      padding: 2px 15px;
      color: #000;
      font-weight: 300;
      background: #ffa45c;
    }
    
    .product .img-prod .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      content: '';
      opacity: 0;
      background: #ffa45c;
      -moz-transition: all .3s ease;
      -o-transition: all .3s ease;
      -webkit-transition: all .3s ease;
      -ms-transition: all .3s ease;
      transition: all .3s ease;
    }
    
    .product .text {
      background: #fff;
      position: relative;
      width: 100%;
    }
    
    .pl-3,
    .px-3 {
      padding-left: 1rem!important;
    }
    
    .pb-3,
    .py-3 {
      padding-bottom: 1rem!important;
    }
    
    .pr-3,
    .px-3 {
      padding-right: 1rem!important;
    }
    
    .pt-3,
    .py-3 {
      padding-top: 1rem!important;
    }
    
    .product .text h3 {
      font-size: 14px;
      margin-bottom: 5px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .d-flex {
      display: -webkit-box!important;
      display: -ms-flexbox!important;
      display: flex!important;
    }
    
    @media (min-width: 992px) {
      .col-lg {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
      }
    }
    
    @media (min-width: 768px) {
      .col-md-6 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
      }
    }
    
    @media (min-width: 576px) {
      .col-sm {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
      }
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
  <link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css" />
  <div class="m-t-20 m-b-20">
    <section class="newproduct bgwhite">
      <div>
        <!-- Slide2 -->
        <div class="container">
          <div class="row formob">
            <div class="loader">Loading...</div>
            <div class="proList grid" id="list1" style="width:100%;">
              <div id="wrap" class="row rowFlexMargin wrapper">
                 
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <br> </section>
  </div>
  <script>
    $(document).ready(function() {
      var query = '<?php echo $searchText; ?>';
      $.ajax({
        type: "POST",
        url: 'search_jsonCOPY.php',
        data: 'query=' + query,
        success: function(msg) {
          console.log(msg);
          if (msg) {
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            // var obj = JSON.parse(msg);                        
            $('#list1').pagination({
              dataSource: msg.qqq,
              pageSize: 20,
              callback: function(data, pagination) {
                var wrapper = $('#list1 .wrapper').empty();
                $.each(data, function(i, f) {
                  var ht = '<div class="col-xs-6 col-md-4 col-lg-3 ftco-animate fadeInUp ftco-animated product_col">';
                  ht += '<div class="product">';
                  ht += '<a href="' + f.link + '" class="img-prod">';
                  ht += f.imageframe;
                  ht += '</a>';
                  ht += '<div class="text py-3 px-3">';
                  ht += '<h3><a href="' + f.link + '">' + f.product_name + '</a></h3><hr>';
                  ht += '<div class="subpart">';
                  ht += '<p style="display:block;">MRP ₹ ' + f.selling_price + '</p>';
                  ht += '<h6 style="color:red;">SKU : <a href="' + f.link + '">' + f.sku + '</a></h6>';
                  ht += '<div class="d-flex">';
                  ht += '<div class="pricing">';
                  ht += '<p class="price">';
                  ht += '<span class="mr-2 price-dc">Rent ₹ <strong>' + f.rent_price + '</strong>  for 3 Days</span><br>';
                  ht += '<span class="price-sale">Deposit ₹ <strong>' + f.deposite + '</strong></span>';
                  ht += '</p></div>';
                  ht += '<div class="rating"><p class="text-right">';
                  ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                  ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                  ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                  ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                  ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                  ht += '</p></div></div>';
                //   ht += '<div class="here">' + f.booking + '</div>';
                //   $('#list1.wrapper').append(ht);
                   $('#wrap').append(ht);
                  console.log(ht);
                });
              }
            });
            $('.loader').css('display', 'none');
          } else {
            alert('try again ! ');
          }
          console.log(msg);
        }
      });
    });
  </script>
  <? } ?>
    <?php include('footer.php'); ?>