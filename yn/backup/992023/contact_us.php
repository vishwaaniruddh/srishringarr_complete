<?php include('header.php');


$product_type = $_GET['type'];
$product_id = $_GET['id'];


//var_dump($_SESSION);
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css"/>
<script type="text/javascript" src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">




<style>
.velaProBlock.grid .btnProduct {
    width: 45px;
    height: 45px;
    text-align: center;
    line-height: 48px;
    padding: 20%;
}


.sidebarListCategories li.sidebarCateItem{
    display:block !important;
}
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
.product-card__image .product-card__img{
    object-fit: cover;
}
</style>



<main class="mainContent" role="main">

      <section id="pageContent">

          <?

          ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);

      ?>


      <div class="container">

                  <div class="rowFlex rowFlexMargin">
                      <div class="col-xs-12 col-md-5 mb30">
                          <div class="pageContactLeft">
                              <h1 class="velaContactTitle">Contact</h1>
                              <div class="rowFlex rowFlexMargin"><div class="col-xs-12"><div class="contactDetail">
                                                      <p><b>Yosshita Neha Fashion Studio</b><br></p>
                                  <p></p>
                                  <p><strong>Address:&nbsp;</strong> Shyamkamal Building B/1,Flat No 104,1st Floor, Agarwal Market,Near Deenanath Mangeshkar Natya Mandir, Vile Parle East, Mumbai 400057</p>
                                  <p><strong>Phone:</strong>&nbsp; 9324243011 / 7400413163</p>
                                  <p><strong>Email:&nbsp;</strong> yosshita.neha@gmail.com</p>
                                  <p><strong>Open:</strong>&nbsp; 12.00 to 7.30pm, Tue - Sat, Monday Closed</p>
                                  <p></p>
                                                  </div></div></div>
                          </div>
                      </div>
                      <div class="col-xs-12 col-md-7 mb20">
                          <div class="pageContactRight">
                              <div class="formContactUs">
                                  <form method="post" action="sendmail_new.php" id="contact_form" accept-charset="UTF-8" class="contact-form"><input type="hidden" name="form_type" value="contact"><input type="hidden" name="utf8" value="✓">
                                      <div class="formContent">


                                          <div class="row">
                                              <div class="col-xs-12">
                                                  <div class="form-group">

                                                      <label for="ContactFormName" class="hidden">Name <sup>*</sup></label>
                                                      <input type="text" id="ContactFormName" class="form-control" placeholder="Name" name="name" autocapitalize="words" value="">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                      <label for="ContactFormPhone" class="hidden">Phone Number <sup>*</sup></label>
                                                      <input type="number" id="ContactFormPhone" class="form-control" placeholder="Phone Number" name="phone" autocorrect="off" autocapitalize="off" value="">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                      <label for="ContactFormEmail" class="hidden">Email <sup>*</sup></label>
                                                      <input type="email" id="ContactFormEmail" class="form-control" placeholder="Email" name="email" autocorrect="off" autocapitalize="off" value="">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12">
                                                  <div class="form-group">
                                                      <label for="ContactFormMessage" class="hidden">Message<sup>*</sup></label>
                                                      <textarea rows="6" id="ContactFormMessage" class="form-control" placeholder="Message" name="body"></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-button">
                                              <input type="submit" class="btn btnContact" value="Send Message">
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>




                      </div>
                  </div>
              </div>
          </div>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7540.325588877759!2d72.8424816!3d19.1005129!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c9b22eafd0fd%3A0x7941a22bbacf65b8!2sYosshita%20Neha%20Fashion%20Studio!5e0!3m2!1sen!2sin!4v1639215205365!5m2!1sen!2sin" width="1500" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> <br>

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


<?php include('footer.php'); ?>

