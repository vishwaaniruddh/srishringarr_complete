<?php session_start();
include('header.php') ;

// include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}



$currency = $_SESSION['cur'];
function currencyAmount($currency,$product_amount){

    global $con;

    if($currency=='INR'){
        return $product_amount ;
    }else{

        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
        $sql1_result = mysqli_fetch_assoc($sql1);
        $rate = $sql1_result['rate'];
        $product_amount = $rate*$product_amount ;
        return $product_amount ;
    }
}

function get_booking_date($sku) {
    global $con3;

    $sql = mysqli_query($con3,"select * from order_detail where item_id ='".$sku."' order by id desc");
    $sql_result = mysqli_fetch_assoc($sql);
    $bill_id = $sql_result['bill_id'];
    $status_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$bill_id."' and booking_status = 'Booked'");
    $status_sql_result = mysqli_fetch_assoc($status_sql);

    return $status_sql_result['pick_date'];
}



function new_get_booking_date($sku) {
    global $con3;

    $sql = mysqli_query($con3,"select * from order_detail where item_id ='".$sku."' and return_qty=0 order by id desc");
    while($sql_result = mysqli_fetch_assoc($sql)){
        $bill_id[] = $sql_result['bill_id'];
    }

    foreach($bill_id as  $k=>$v){

            $status_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$v."' and booking_status = 'Booked'");
            $status_sql_result = mysqli_fetch_assoc($status_sql);
            $pic_date[] = $status_sql_result['pick_date'];
            $return_date[] = $status_sql_result['delivery_date'];

    }
            $data = ['pick_date'=>$pic_date, 'return_date'=>$return_date] ;
return $data ;


}





$url = 'https://www.srishringarr.com'.  $_SERVER['REQUEST_URI']  ;
if ( $temp = strstr($url, 'days', true) ) {
   $url = $temp;
   $url = rtrim($url , '&');
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css" integrity="sha512-c7jR/kCnu09ZrAKsWXsI/x9HCO9kkpHw4Ftqhofqs+I2hNxalK5RGwo/IAhW3iqCHIw55wBSSCFlm8JP0sw2Zw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js" integrity="sha512-BmoWLYENsSaAfQfHszJM7cLiy9Ml4I0n1YtBQKfx8PaYpZ3SoTXfj3YiDNn0GAdveOCNbK8WqQQYaSb0CMjTHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
function round_amount(amount){

    var round_num = amount.slice(-2);

        if(round_num < 50 ){
            add_amount = 50 - round_num;
        }
        if(round_num > 50 ){
            add_amount = 100 - round_num;
        }
        if(round_num ==  00 || round_num==50){
            add_amount = 00;
        }

    new_amount = parseInt(amount) + parseInt(add_amount);
    return new_amount;
}




$("#document").ready(function(){



setTimeout(function(){

$("#dateRangeP").on('change',function(){

	   var dateRangeP = $('#dateRangeP').val();
       var dateRangeP_arr = dateRangeP.split('-');

const date1 = new Date(dateRangeP_arr[0]);
const date2 = new Date(dateRangeP_arr[1]);
const diffTime = Math.abs(date2 - date1);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))+1;

var get_days = '<?php echo $_GET['days'] ; ?>' ;


var ss_date1 = new Date(date1);
var ss_dd1 = String(ss_date1.getDate()).padStart(2, '0');
var ss_mm1 = String(ss_date1.getMonth() + 1).padStart(2, '0'); //January is 0!
var ss_yyyy1 = ss_date1.getFullYear();
ss_date1 = ss_mm1 + '/' + ss_dd1 + '/' + ss_yyyy1;



var ss_date2 = new Date(date2);
var ss_dd2 = String(ss_date2.getDate()).padStart(2, '0');
var ss_mm2 = String(ss_date2.getMonth() + 1).padStart(2, '0'); //January is 0!
var ss_yyyy2 = ss_date2.getFullYear();
ss_date2 = ss_mm2 + '/' + ss_dd2 + '/' + ss_yyyy2;

$('#dateRangeP').val(ss_date1 +' - '+ss_date2);

// alert(date2);
//         alert('diffDays '+diffDays);

        if(diffDays > 7 ){

        // if(diffDays > 7 || diffDays == 7 ){
            swal('Cannot select more than 7 days !','','error');
            setTimeout(function(){
                    window.location.href = '<?php echo $url ?>&&days=7&from_dt='+ss_date1+'&to_dt='+ss_date2;
            }, 3000);


        }
        else{
            if(diffDays< 3){
                swal('selecting for minimum 3 days ! ');
            setTimeout(function(){
                window.location.href = '<?php echo $url ?>&&days=3&from_dt='+ss_date1+'&to_dt='+ss_date2;
            }, 3000);


            }
            else if(diffDays==3){
                        if(get_days==3){

                        }else{
                            window.location.href = '<?php echo $url ?>&&days=3&from_dt='+ss_date1+'&to_dt='+ss_date2;
                        }

            }else if(diffDays==4){
                if(get_days==4){

                        }else{
                            swal('selecting for 4 days ! ');
                        window.location.href = '<?php echo $url ?>&&days=4&from_dt='+ss_date1+'&to_dt='+ss_date2;
                        }

            }else if(diffDays==5){
                if(get_days==5){

                        }else{
                            swal('selecting for 5 days ! ');
                            window.location.href = '<?php echo $url ?>&&days=5&from_dt='+ss_date1+'&to_dt='+ss_date2;
                        }


            }else if(diffDays==6){
                if(get_days==6){

                        }else{
                            swal('selecting for 6 days ! ');
                            window.location.href = '<?php echo $url ?>&&days=6&from_dt='+ss_date1+'&to_dt='+ss_date2;
                        }


            }else if(diffDays==7){
                if(get_days==7){

                        }else{
                            swal('selecting for 7 days ! ');
                            window.location.href = '<?php echo $url ?>&&days=7&from_dt='+ss_date1+'&to_dt='+ss_date2;
                        }


            }
        }


});

}, 2000);




});
</script>


<?

function getDBrent2($sku,$type){

    global $con;

    if($type==1){
        $sql ="select rent_price from product where product_code='".$sku."' order by product_id desc";
    }else if($type==2){
         $sql ="select rent_price from garment_product where gproduct_code='".$sku."' order by gproduct_id desc";
    }

    $statement = mysqli_query($con,$sql);
    if($statement_result = mysqli_fetch_assoc($statement)){
        return $statement_result['rent_price'];
    }else{
        return 0 ;
    }

}



$type  = $_GET['type'];
$id = $_GET['id'];
$userid = $_SESSION['userid'];
$prid=$id;
$transtyp = 1;

if($type=="1")
{
    $sql="SELECT * FROM `product` WHERE `product_id`='".$prid."'";

    $sql_query = mysqli_query($con,$sql);
    $sql_result = mysqli_fetch_assoc($sql_query);
    $visitcount = $sql_result['visitcount'];
    $visitcount = $visitcount+1;
    mysqli_query($con,"update product set visitcount= '".$visitcount."' where product_id='".$prid."'");

}
else if($type=="2")
{
    $sql="select * from  `garment_product` where gproduct_id='".$prid."'";

    $sql_query = mysqli_query($con,$sql);
    $sql_result = mysqli_fetch_assoc($sql_query);
    $visitcount = $sql_result['visitcount'];
    $visitcount = $visitcount+1;
    mysqli_query($con,"update garment_product set visitcount= '".$visitcount."' where gproduct_id='".$prid."'");

}




$table=mysqli_query($con,$sql);
$rws=mysqli_fetch_array($table);


$sku = $rws[2];



if($type==1){
    $youtube = $rws[35];
}elseif($type==2){
    $youtube = $rws[35];
}



for($i=0; $i<7 ; $i++){
    $block_date[] = date('Y-m-d', strtotime( '+'.$i.' days'));
}







$newbooking = new_get_booking_date($sku);
if($newbooking){
$total_bookings = count($newbooking['pick_date']);
for($init=0;$init<$total_bookings;$init++){
     $booking_to = $newbooking['pick_date'][$init];
     $booking_from = $newbooking['return_date'][$init];



    $block_date[] =date('Y-m-d', strtotime('0 days', strtotime($booking_to)));

    for($i=1; $i<=7 ; $i++){
        $block_date[] =date('Y-m-d', strtotime('-'.$i.' days', strtotime($booking_to)));
    }
    for($i=1; $i<=10 ; $i++){
        $block_date[] =date('Y-m-d', strtotime('+'.$i.' days', strtotime($booking_to)));
    }
}
}
else{
    $booking_date = date('Y-m-d', strtotime( '+7 days'));
}


foreach($block_date as $key => $value){
    if($value){
        $your_date[] = date("m/d/Y", strtotime($value));
    }

}
usort($block_date, "date_sort");


$mdy_block_date = json_encode($your_date,JSON_UNESCAPED_SLASHES);



$missingDates = array();

$dateStart = date_create($your_date[0]);
$dateEnd   = date_create(end($your_date));
$interval  = new DateInterval('P1D');
$period    = new DatePeriod($dateStart, $interval, $dateEnd);

    foreach($period as $day) {
      $formatted = $day->format("m/d/Y");
      if(!in_array($formatted, $your_date)){
        $missingDates[] = $formatted;
      }
    }

$block_date_json = $mdy_block_date;



if($type=="1")
{
    $qryjew1=mysqli_query($con,"select * from subcat1  where subcat_id='".$rws['subcat_id']."'");
    $rowjew1=mysqli_fetch_array($qryjew1);

    if($rowjew1['maincat_id']==1){
        $necklace = 1 ;
    }



    $qryjew2 = mysqli_query($con,"SELECT * FROM `jewel_subcat` where subcat_id='".$rowjew1['maincat_id']."'");
    $rowjew2 = mysqli_fetch_array($qryjew2);

    // var_dump($rowjew2);
    if($rowjew2['mcat_id']==1){
        $necklace = 1 ;
    }


    if($rowjew2['mcat_id']=="1" || $rowjew2['mcat_id']=="3") {
        $transtypchk='1';
    } else{
        $transtypchk='2';
    }
} else {
    $qryjew=mysqli_query($con,"SELECT * FROM `garments` where garment_id='".$rws['product_for']."'");
	$rowjew=mysqli_fetch_array($qryjew);
    if($rowjew['Main_id']=="1" || $rowjew['Main_id']=="3"){
        $transtypchk='1';
    } else
    {
        $transtypchk='2';
    }
}



    $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$rws[2]."'");
    $rero = mysqli_fetch_row($re);

    $qty = round($rero[2]);
  $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$rws[2]."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
    $rero1 = mysqli_fetch_row($re1);
    $currentsp=$rero[0]-$rero1[0];

    $splimit=$rero[1]*0.8;

    // echo '$currentsp' .$currentsp;
    // echo '<br>';
    // echo '$splimit' . $splimit ;
    // echo '<br>';




if($type==1){
    if($necklace == 1 ){
        if($currentsp>$splimit)
            $newsp=$currentsp;
        else
            $newsp=$splimit;
    }else{
        $newsp=$rero[0];
    }

}elseif($type==2){
    if($currentsp>$splimit)
        $newsp=$currentsp;
    else
        $newsp=$splimit;
}


        // echo '$newsp= ' . $newsp ;

//jwellery
if($type=="1") {
    if($newsp<=40000){
            $rentprice=$newsp*0.20;
          }
        else if($newsp<=60000){
            $rentprice=$newsp*0.17;
        }
        else{
            $rentprice=$newsp*0.15;
        }

           if($newsp<=2000){
               $courier = 100;
           }else if($newsp<=5000){
               $courier = 250;
           }else if($newsp<=10000){
               $courier = 500;
           }else{
               $courier = 1000;
           }
            $rentprice = $rentprice  + $courier ;
        if( $necklace == 1 ){    // necklace cat should have mimnim um 1500 rent and not less than that
                if($rentprice < 1500){
                    $rentprice = 1500;
                    $deposit = 3000;
            }
}

    // echo '$rentprice = '.  $rentprice ;

}


if($type==2){

    if($newsp<=40000){
        $rentprice=$newsp*0.20;
    } else if($newsp<=60000){
        $rentprice=$newsp*0.17;
    } else{
        $rentprice=$newsp*0.15;
    }

    if($newsp<=10000){
       $courier = 750;
    }else {
       $courier = 2000;
    }
$rentprice = $rentprice  + $courier ;
    if($rentprice < 3500 ){
       $rentprice = 3500;
     $deposit = 3500;
    }
}



// if(getDBrent($sku,$type)>0){
//      $rentprice = getDBrent($sku,$type);

// }


   if(isset($deposit) && $deposit!=0){

   }
   else{ $deposit = intval($newsp*0.35); }
    // $deposit = round($newsp*0.35) ;
    $deposit=round_amount($deposit);
    $final_rent = round_amount($rentprice) ;



if(getDBrent2($sku,$type)>0){
    $final_rent = getDBrent2($sku,$type);
    $final_rent = round_amount($final_rent+$courier);
}


if($type=="1"){
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='$prid' order by rank";
}else if($type=="2")
{
    $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";
}
// echo $sqlimg;
$qryimg=mysqli_query($con,$sqlimg);
$rowimg=mysqli_fetch_row($qryimg);
$img_path ='https://yosshitaneha.com/uploads';
$pathmain = 'https://yosshitaneha.com/';
$path = $img_path.$rowimg[0];
?>
<style>
/*img{*/
/*    width:100%;*/
/*}*/
.daterangepicker{
    position: fixed;
    top: 10% !important;
    left: 24% !important;

    right: 10%;
    width: 50%;
}
.daterangepicker .calendar{
    max-width: 500px;
}
.ranges{
        width: 100% ! important;
    display: flex;
    justify-content: center;
}
.left ,.right{
    width:49% ! important;
}

body{
    overflow-x:hidden;
}
</style>


<style>


        @media (max-width: 768px){

.left ,.right{
    width:100% ! important;
}

.daterangepicker{
     width: 100% !important;
    left: auto !important;

}

        }

@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext");

:root {
  --white: #ffffff;
  --light: #f0eff3;
  --black: #000000;
  --dark-blue: #1f2029;
  --dark-light: #353746;
  --red: #da2c4d;
  --yellow: #f8ab37;
  --grey: #ecedf3;
}




	figure.zoom {
 	 background-position: 50% 50%;
 	 position: relative;
 	 /*width: 500px;*/
  	 overflow: hidden;
  	 cursor: zoom-in;
	}

	figure.zoom img:hover {
  		opacity: 0;
	}

	figure.zoom img {
  		transition: opacity .5s;
  		display: block;
  		width: 100%;
	}

	.prodGalleryImg {
		width: 80px;
	    height: 80px;
	    border: 1px solid #424242;
	    margin:5px;
	}

	.g-background {
		height: 5px;
	    position: relative;
	    background: #f0f0f0;
	    margin-top: 7px;
	    margin-left: 7px;
	    border-radius: 100px;
	    width: 80%;
	}
	.ratio-background {
		left: 0;
	    position: absolute;
	    height: 5px;
	    transform: scaleX(1);
	    transform-origin: left center;
	    transition: transform 0.4s cubic-bezier(0, 0, 0.3, 1) 0.3s, -webkit-transform 0.4s cubic-bezier(0, 0, 0.3, 1) 0.3s;
	    border-radius: 100px;
	    width:100%;
	    background-color: #388e3c;
	}

	.zoom:hover {
		transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
		overflow: scroll;
	}

	.pointer {cursor: pointer;}
		.dot {
	  height: 72px;
	  width: 70px;
	  background-color: #E2C88A;
	  border-radius: 100%;
	  display: inline-block;
	  /*border: 1px solid black;*/
	  }


	/*radio buttons design*/

	.days_btn,.del_btn{
	    /*width: 40px;*/
	    height: 40px;
	    /*border-radius: 3px;*/
        border: 1px solid #E6BE6E;
	    border-radius: 4px;
	    align-items: flex-start;
	    text-align: center;
	    padding: 8px 15px;
	    float: left;
	}
	.days_btn.sel,.del_btn.sel{
		background: #e6be6e;
		color: #fff;
	}
	.subject-list,.del_btn_radio{
		display: none;
	}

	.flex-w label + input[type="radio"]:checked {
    	background:pink !important;
	}

	input[type=text] {
		border-color: #e6be6e !important;
	}

	.bo9{
		border: 1px solid #cccccc !important;
	}
	.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  border-color:#e6be6e
  margin-bottom: 15px;
}
.icon {
  padding: 10px;
  background-color:#E6BE6E;
  //background-color:orange;
  min-width:50px;
  text-align: center;
}
.fs-15.hvr {
    background-color: #E6BE6E;
	//background-color: orange;
    height: 40px;

    }
	.fs-15 {
        background-color: white;
	}


.amazingslider-space-0{
    height : 550px !important;
}
amazingslider-img-elem-0{
        margin-top: 0 !important;
}
amazingslider-img-0{
    overflow : visible !important;
    top : 50% !important;
    position : unset;
}

a[data-zoom-id], .mz-thumb{
    line-height : 1 !important;
    /*display: table-cell !important;*/
    display: unset !important;

}
.selectors{
        display: inherit;
        margin-top:2%;
}
.mz-inner, #mzCrA118625690571 , #crMz1178248867535 {
    display: none !important;
}


::selection {
  color: var(--white);
  background-color: var(--black);
}
::-moz-selection {
  color: var(--white);
  background-color: var(--black);
}
mark {
  color: var(--white);
  background-color: var(--black);
}
.section {
  position: relative;
  width: 100%;
  display: block;
  text-align: center;
  margin: 0 auto;
}
.over-hide {
  overflow: hidden;
}
.z-bigger {
  z-index: 100 !important;
}

.background-color {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: var(--dark-blue);
  z-index: 1;
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox:checked ~ .background-color {
  background-color: var(--white);
}

[type="checkbox"]:checked,
[type="checkbox"]:not(:checked),
[type="radio"]:checked,
[type="radio"]:not(:checked) {
  position: absolute;
  left: -9999px;
  width: 0;
  height: 0;
  visibility: hidden;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label {
  position: relative;
  width: 70px;
  display: inline-block;
  padding: 0;
  margin: 0 auto;
  text-align: center;
  margin: 17px 0;
  margin-top: 100px;
  height: 6px;
  border-radius: 4px;
  background-image: linear-gradient(298deg, var(--red), var(--yellow));
  z-index: 100 !important;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before {
  position: absolute;
  font-family: "unicons";
  cursor: pointer;
  top: -17px;
  z-index: 2;
  font-size: 20px;
  line-height: 40px;
  text-align: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox:not(:checked) + label:before {
  content: "\eac1";
  left: 0;
  color: var(--grey);
  background-color: var(--dark-light);
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(26, 53, 71, 0.07);
}
.checkbox:checked + label:before {
  content: "\eb8f";
  left: 30px;
  color: var(--yellow);
  background-color: var(--dark-blue);
  box-shadow: 0 4px 4px rgba(26, 53, 71, 0.25), 0 0 0 1px rgba(26, 53, 71, 0.07);
}

.checkbox:checked ~ .section .container .row .col-12 p {
  color: var(--dark-blue);
}

.checkbox-tools:checked + label,
.checkbox-tools:not(:checked) + label {
  position: relative;
  display: inline-block;
  padding: 20px;
  width: 110px;
  font-size: 14px;
  line-height: 20px;
  letter-spacing: 1px;
  margin: 0 auto;
  margin-left: 5px;
  margin-right: 5px;
  margin-bottom: 10px;
  text-align: center;
  border-radius: 4px;
  overflow: hidden;
  cursor: pointer;
  text-transform: uppercase;
  color: var(--white);
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox-tools:not(:checked) + label {
  background-color: var(--dark-light);
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}
.checkbox-tools:checked + label {
  background-color: transparent;
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-tools:not(:checked) + label:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-tools:checked + label::before,
.checkbox-tools:not(:checked) + label::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 4px;
  background-image: linear-gradient(298deg, var(--red), var(--yellow));
  z-index: -1;
}
.checkbox-tools:checked + label .uil,
.checkbox-tools:not(:checked) + label .uil {
  font-size: 24px;
  line-height: 24px;
  display: block;
  padding-bottom: 10px;
}

.checkbox:checked
  ~ .section
  .container
  .row
  .col-12
  .checkbox-tools:not(:checked)
  + label {
  background-color: var(--light);
  color: var(--dark-blue);
  box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
}

.checkbox-budget:checked + label,
.checkbox-budget:not(:checked) + label {
  color:white;
  padding: 2%;
}
.checkbox-budget:not(:checked) + label {
  background-color: var(--dark-light);
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}
.checkbox-budget:checked + label {
  background-color: #e6be6e;
  /*box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);*/
}
.checkbox-budget:not(:checked) + label:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-budget:checked + label::before,
.checkbox-budget:not(:checked) + label::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 4px;
  background-image: linear-gradient(138deg, var(--red), var(--yellow));
  z-index: -1;
}
.checkbox-budget:checked + label span,
.checkbox-budget:not(:checked) + label span {
  position: relative;
  display: block;
}
.checkbox-budget:checked + label span::before,
.checkbox-budget:not(:checked) + label span::before {
  position: absolute;
  content: attr(data-hover);
  top: 0;
  left: 0;
  width: 100%;
  overflow: hidden;
  -webkit-text-stroke: transparent;
  text-stroke: transparent;
  -webkit-text-fill-color: var(--white);
  text-fill-color: var(--white);
  color: var(--white);
  -webkit-transition: max-height 0.3s;
  -moz-transition: max-height 0.3s;
  transition: max-height 0.3s;
}
.checkbox-budget:not(:checked) + label span::before {
  max-height: 0;
}
.checkbox-budget:checked + label span::before {
  max-height: 100%;
}

.checkbox:checked
  ~ .section
  .container
  .row
  .col-xl-10
  .checkbox-budget:not(:checked)
  + label {
  background-color: var(--light);
  -webkit-text-stroke: 1px var(--dark-blue);
  text-stroke: 1px var(--dark-blue);
  box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
}

.checkbox-booking:checked + label,
.checkbox-booking:not(:checked) + label {
  position: relative;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-align-items: center;
  -moz-align-items: center;
  -ms-align-items: center;
  align-items: center;
  -webkit-justify-content: center;
  -moz-justify-content: center;
  -ms-justify-content: center;
  justify-content: center;
  -ms-flex-pack: center;
  text-align: center;
  padding: 0;
  padding: 6px 25px;
  font-size: 14px;
  line-height: 30px;
  letter-spacing: 1px;
  margin: 0 auto;
  margin-left: 6px;
  margin-right: 6px;
  margin-bottom: 16px;
  text-align: center;
  border-radius: 4px;
  cursor: pointer;
  color: var(--white);
  text-transform: uppercase;
  background-color: var(--dark-light);
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox-booking:not(:checked) + label::before {
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}
.checkbox-booking:checked + label::before {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-booking:not(:checked) + label:hover::before {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-booking:checked + label::before,
.checkbox-booking:not(:checked) + label::before {
  position: absolute;
  content: "";
  top: -2px;
  left: -2px;
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  border-radius: 4px;
  z-index: -2;
  background-image: linear-gradient(138deg, var(--red), var(--yellow));
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox-booking:not(:checked) + label::before {
  top: -1px;
  left: -1px;
  width: calc(100% + 2px);
  height: calc(100% + 2px);
}
.checkbox-booking:checked + label::after,
.checkbox-booking:not(:checked) + label::after {
  position: absolute;
  content: "";
  top: -2px;
  left: -2px;
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  border-radius: 4px;
  z-index: -2;
  background-color: var(--dark-light);
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox-booking:checked + label::after {
  opacity: 0;
}
.checkbox-booking:checked + label .uil,
.checkbox-booking:not(:checked) + label .uil {
  font-size: 20px;
}
.checkbox-booking:checked + label .text,
.checkbox-booking:not(:checked) + label .text {
  position: relative;
  display: inline-block;
  -webkit-transition: opacity 300ms linear;
  transition: opacity 300ms linear;
}
.checkbox-booking:checked + label .text {
  opacity: 0.6;
}
.checkbox-booking:checked + label .text::after,
.checkbox-booking:not(:checked) + label .text::after {
  position: absolute;
  content: "";
  width: 0;
  left: 0;
  top: 50%;
  margin-top: -1px;
  height: 2px;
  background-image: linear-gradient(138deg, var(--red), var(--yellow));
  z-index: 1;
  -webkit-transition: all 300ms linear;
  transition: all 300ms linear;
}
.checkbox-booking:not(:checked) + label .text::after {
  width: 0;
}
.checkbox-booking:checked + label .text::after {
  width: 100%;
}

.checkbox:checked
  ~ .section
  .container
  .row
  .col-12
  .checkbox-booking:not(:checked)
  + label,
.checkbox:checked
  ~ .section
  .container
  .row
  .col-12
  .checkbox-booking:checked
  + label {
  background-color: var(--light);
  color: var(--dark-blue);
}
.checkbox:checked
  ~ .section
  .container
  .row
  .col-12
  .checkbox-booking:checked
  + label::after,
.checkbox:checked
  ~ .section
  .container
  .row
  .col-12
  .checkbox-booking:not(:checked)
  + label::after {
  background-color: var(--light);
}

.link-to-page {
  position: fixed;
  top: 30px;
  right: 30px;
  z-index: 20000;
  cursor: pointer;
  width: 50px;
}
.link-to-page img {
  width: 100%;
  height: auto;
  display: block;
}


.checkbox-budget + label > a{
    color:white;
}

.bgwhite{
    padding:10px;
}

.like_h4{
        margin: 16px 0;
    padding: 10px;
    text-align: center;
    text-decoration: underline;
    font-size: 30px;
}
</style>

<link href="static/css/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="static/js/magiczoom.js" type="text/javascript"></script>
<script type="text/javascript">
    var mzOptions = {};
    mzOptions = {
        onZoomReady: function() {
            console.log('onReady', arguments[0]);
        },
        onUpdate: function() {
            console.log('onUpdated', arguments[0], arguments[1], arguments[2]);
        },
        onZoomIn: function() {
            console.log('onZoomIn', arguments[0]);
        },
        onZoomOut: function() {
            console.log('onZoomOut', arguments[0]);
        },
        onExpandOpen: function() {
            console.log('onExpandOpen', arguments[0]);
        },
        onExpandClose: function() {
            console.log('onExpandClosed', arguments[0]);
        }
    };
    var mzMobileOptions = {};

    function isDefaultOption(o) {
        return magicJS.$A(magicJS.$(o).byTag('option')).filter(function(opt){
            return opt.selected && opt.defaultSelected;
        }).length > 0;
    }

    function toOptionValue(v) {
        if ( /^(true|false)$/.test(v) ) {
            return 'true' === v;
        }
        if ( /^[0-9]{1,}$/i.test(v) ) {
            return parseInt(v,10);
        }
        return v;
    }

    function makeOptions(optType) {
        var  value = null, isDefault = true, newParams = Array(), newParamsS = '', options = {};
        magicJS.$(magicJS.$A(magicJS.$(optType).getElementsByTagName("INPUT"))
            .concat(magicJS.$A(magicJS.$(optType).getElementsByTagName('SELECT'))))
            .forEach(function(param){
                value = ('checkbox'==param.type) ? param.checked.toString() : param.value;

                isDefault = ('checkbox'==param.type) ? value == param.defaultChecked.toString() :
                    ('SELECT'==param.tagName) ? isDefaultOption(param) : value == param.defaultValue;

                if ( null !== value && !isDefault) {
                    options[param.name] = toOptionValue(value);
                }
        });
        return options;
    }

    function updateScriptCode() {
        var code = '&lt;script&gt;\nvar mzOptions = ';
        code += JSON.stringify(mzOptions, null, 2).replace(/\"(\w+)\":/g,"$1:")+';';
        code += '\n&lt;/script&gt;';

        magicJS.$('app-code-sample-script').changeContent(code);
    }

    function updateInlineCode() {
        var code = '&lt;a class="MagicZoom" data-options="';
        code += JSON.stringify(mzOptions).replace(/\"(\w+)\":(?:\"([^"]+)\"|([^,}]+))(,)?/g, "$1: $2$3; ").replace(/\{([^{}]*)\}/,"$1").replace(/\s*$/,'');
        code += '"&gt;';

        magicJS.$('app-code-sample-inline').changeContent(code);
    }

    function applySettings() {
        MagicZoom.stop('Zoom-1');
        mzOptions = makeOptions('params');
        mzMobileOptions = makeOptions('mobile-params');
        MagicZoom.start('Zoom-1');
        updateScriptCode();
        updateInlineCode();
        try {
            prettyPrint();
        } catch(e) {}
    }

    function copyToClipboard(src) {
        var
            copyNode,
            range, success;

        if (!isCopySupported()) {
            disableCopy();
            return;
        }
        copyNode = document.getElementById('code-to-copy');
        copyNode.innerHTML = document.getElementById(src).innerHTML;

        range = document.createRange();
        range.selectNode(copyNode);
        window.getSelection().addRange(range);

        try {
            success = document.execCommand('copy');
        } catch(err) {
            success = false;
        }
        window.getSelection().removeAllRanges();
        if (!success) {
            disableCopy();
        } else {
            new magicJS.Message('Settings code copied to clipboard.', 3000,
                document.querySelector('.app-code-holder'), 'copy-msg');
        }
    }

    function disableCopy() {
        magicJS.$A(document.querySelectorAll('.cfg-btn-copy')).forEach(function(node) {
            node.disabled = true;
        });
        new magicJS.Message('Sorry, cannot copy settings code to clipboard. Please select and copy code manually.', 3000,
            document.querySelector('.app-code-holder'), 'copy-msg copy-msg-failed');
    }

    function isCopySupported() {
        if ( !window.getSelection || !document.createRange || !document.queryCommandSupported ) { return false; }
        return document.queryCommandSupported('copy');
    }
</script>


<script>
   $(document).ready(function() {

console.log('rent_price = ' + '<?php echo $final_rent ; ?>')
$("#rent_price").html('<?php echo $final_rent ; ?>');



    $("#rent_price").html('');
    // var days = $(this).attr('id');



    var days = "<?php echo $_GET['days']; ?>";
    days = parseInt(days);
// if(!days){
//     days=3;
// }
// alert(days);
    if(days > 7 ){
        swal("Selecting For 7 days",'','error');
        setTimeout(function(){
            window.location.href = '<?php echo $url ?>&&days=7';
        },3000);

    }else if(!days){
        swal("Selecting For 3 days",'','error');
        setTimeout(function(){
            window.location.href = '<?php echo $url ?>&&days=3';
        },3000);

    }

    if(days=='' || days == undefined){
        days=3;
    }
    var rent_price = parseInt('<?php echo $final_rent; ?>') ;

    var rent_calc_single = rent_price*0.05;

    console.log(rent_calc_single);

    if(days == 3){
    var rent_calc = rent_price;
    }
    else if(days == 4){

        var rent_calc = rent_price + rent_calc_single;
        console.log(rent_calc);
    }
    else if(days == 5){
        var rent_calc = rent_price + (days-3)*rent_calc_single;
        console.log(rent_calc);
    }
    else if(days == 6){
        var rent_calc = rent_price + (days-3)*rent_calc_single;
        console.log(rent_calc);
    }
    else if(days == 7){

        var rent_calc = rent_price + (days-3)*rent_calc_single;
        console.log('rent_price= ' + rent_price  + 'and =rent_calc ' + rent_calc);
    }

    rent_calc = Math.round(rent_calc);
    rent_calc = rent_calc.toString();


var final_rent_amount = round_amount(rent_calc) ;
$("#rent_price_inr").val(final_rent_amount);


        $.ajax({
           type: 'POST',
            url:'rent_convert.php',
            data:'rent='+final_rent_amount,
            success: function(msg){

    $("#rent_price").html(msg);

            }
        });






   });



</script>

<?php


if(isset($_GET['from_dt']) && isset($_GET['to_dt'])){

    $start_date = $_GET['from_dt'];
    $end = $_GET['to_dt'] ;
}else{
if($missingDates){
    $start_date = $missingDates[0];
    $days = $_GET['days']-1;
    $end =  date('m/d/Y', strtotime($start_date. ' + ' . $days .' days'));
}
else{
    $start_date = date('m/d/Y', strtotime( '+7 days'));
    $days = $_GET['days']-1;
    $end =  date('m/d/Y', strtotime($start_date. ' + ' . $days .' days'));
}

}






if(array_search($end,$your_date)){ ?>
   <script>
      swal('The product is already booked on selected date !','','error');
       setTimeout(function(){
        //   window.history.back();
       }, 1500);

   </script>

<? }

?>



	<section class="bgwhite p-t-55 p-b-65 ">
		<div>
		    <div>
        		<div class="col-sm-12 col-md-12 col-lg-12">
        			<div>
        				<div class="flex-w">

        					<ol class="breadcrumb" style="display:inline-flex">
                    		  <?php
                    		  if($type=="1")
                    		  {
                    		      ?>
                    		       <li class=""><a href="sub_category.php?type=1"> <?php echo "Jewellery";?>&nbsp; / &nbsp;</a> </li>
                    		      <?php
                    		  } else if($type=="2")
                    		  { ?>
                    		       <li class=""> <a href="sub_category.php?type=2"><?php echo "Apparels";?>&nbsp; / &nbsp;</a></li>
                    		      <?php
                    		  }

                    		  if($type=="1")
                    		  {
                    		    $gtmctnm=mysqli_query($con,"select name,maincat_id from subcat1 where subcat_id='".$rws[8]."'");
                    		    $grmrws=mysqli_fetch_array($gtmctnm);


                    		    $gtmctnm2=mysqli_query($con,"select categories_name from jewel_subcat where subcat_id='".$grmrws[1]."'");
                    		    $grmrws2=mysqli_fetch_array($gtmctnm2);



                        	    ?>
                        	    <?php if(strtolower($grmrws2[0]) != strtolower($grmrws[0])) { ?>
                        		    <li class=""><a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $grmrws[1];?>","<?php echo $subcatid;?>","<?php echo $typ;?>","1");'><?php echo ucfirst(strtolower($grmrws2[0]));?></a></li>&nbsp; / &nbsp;
                        	    <?php } ?>

                                <!--<li class=""><?php echo $grmrws2[0];?></li>-->
                                <li class=""><a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $grmrws[1];?>","<?php echo $rws[8];?>","<?php echo $typ;?>");'><?php echo ucfirst(strtolower($grmrws[0]));?></a></li>&nbsp; / &nbsp;
                        	<?php }  else  if($type=="2"){
                    		        $gtmctnm=mysqli_query($con,"select * from garments where garment_id='".$rws['product_for']."'");
                    		        $grmrws=mysqli_fetch_assoc($gtmctnm);

$product_id = $grmrws['garment_id'];
if($product_id == '10' ){ ?>

<title>Rent Designer Lehengas | Sri Shringarr Fashion studio</title>

<meta name="description" content="Rent your special Bridal / Sider Lehengas from Sri Shringarr. ✔Custom Fitting ✔Dry Cleaned ✔Delivery. Don’t Repeat It, Rent It. Click Now for Easy Rentals.">

<meta name="keywords" content="Bridal Lehenga Shops in Mumbai, Bridal Lehengas on Rent, Bridal Lehenga Rental, Bridal Lehenga Rent with prices, Lehenga Rental, Lehenga on Rent, Lehenga Rental Near Me, Lehenga Rental Online, Sider Lehenga On rent, Hand embroidered Lehenga on Rent, Bridal Wear on Hire, Designer Lehengas on Hire, Made In India.">


<? }elseif($product_id == '28' ){ ?>

  <title>Rent Exclusive Indo Western Outfits | Sri Shringarr</title>
  <meta name="description" content="Hire Women Outfits for Sangeet, Bachelor Parties, Cocktails etc. Take a glance at the exclusive collection of Sri Shringarr’s Indo Western section and easily rent any.">
  <meta name="keywords" content="Rent Indo Western Outfits, Rent Indo Western Wear, Rent Women's Wear, Sangeet Wear on Hire, Indo Western Gowns on Rent, Indo Western Lehenga Choli, Lehenga Choli on Rent, Crop Top Skirt, Dhoti Style, Draped Gowns, Sharara on rents, Rental clothes, Bridal Wear on Hire, Made In India">


<? }elseif($product_id == '22' ){ ?>

  <title>Rent Exclusive Designer Evening Gowns - Sri Shringarr</title>
  <meta name="description" content="Don’t Repeat It, Rent It. Rent Exclusive Reception Gowns, Floor Length Gowns, Indian Bridal Gowns, Ball Gowns, Trail Gowns, Pre Wedding Gowns.">
  <meta name="keywords" content="Rent Indian Gowns, Women Gowns on Rent, Drape Gowns, Reception Gowns on Hire, Hand Embroidered Gowns, Bridal Gowns, Evening Gowns, Designer Gowns, Ball Gown, Trail Gown, Pre Wedding Gown, Infinity Gown, Maternity Shoot Gowns, Rental Clothes, Clothes on Rent, Bridal Wear on Hire, Made In India.">


<? }elseif($product_id == '29' ){ ?>

  <title>Trail / Infinity Gown on Rent for Pre Wedding| Sri Shringarr</title>
  <meta name="description" content="Rent Trail Gowns / Infinity Gowns for your Pre Wedding or Maternity Shoot. Sri Shringarr gives Long Flowy Gowns on Hire. Pre Wedding Gowns | Maternity Gowns">
  <meta name="keywords" content="Trail Gowns on Rent, Rental Pre Wedding Gowns, Pre Wedding Shoot Gowns on Rent, Infinity Gowns on Rent, Maternity Shoot Gowns on Rent, Gowns on Rent, Long Gowns on Rent, Flowy Gowns on Rent.">


<? }
                    		  ?>

                    		 <li class="">
                    		     <a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $rws['product_for'];?>","<?php echo "0";?>","<?php echo $typ;?>");'><?php echo ucfirst(strtolower($grmrws['name']));?>
                    		     </a>
                    		    </li>

                    		 <?php } ?>
                    	</ol>
    				</div>
    				<hr style="width:100%;background:#ccc;">
    			</div>
    		</div>


    		<style>

    		    #Zoom-1{
    		            width: 100%;
    display: flex;
    justify-content: center;
    		    }
    		</style>
        		<div class="container bgwhite p-t-35 p-b-80">
        			<div class="flex-w flex-sb" >
        				<div class="w-size13 p-t-0 respon5">
        					<div class="wrap-slick3 flex-sb flex-w">


        					</div>


                            <div class="app-figure" id="zoom-fig">
                                <a id="Zoom-1" class="MagicZoom" title="Show your product in stunning detail."
                                    href="<?php echo $path; ?>"
                                    data-zoom-image-2x="<?php echo $path; ?>"
                                    data-image-2x="<?php echo $path; ?>"
                                >
                                    <img class="product_image" src="<?php echo $path; ?>" srcset="<?php echo $path; ?>?h=800 2x" style="width:100%;"/>
                                </a>


                        <br><br>


                        <?

        				if($youtube){ ?>
                        <div class="row" style="height:280px;;">
                            <hr><hr>
        				<br>
  <?
        				$ytarray=explode("/", $youtube);
$ytendstring=end($ytarray);
$ytendarray=explode("?v=", $ytendstring);
$ytendstring=end($ytendarray);
$ytendarray=explode("&", $ytendstring);
$ytcode=$ytendarray[0];
echo "<iframe width=\"100%\" height=\"280px\" src=\"https://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";

?>
        				</div>
        				 <? } ?>





        				    <!--<object width="425" height="350" data="<? echo $youtube; ?>" type="application/x-shockwave-flash"><param name="src" value="<? echo $youtube; ?>" /></object>-->

        				    <!--<iframe width="560" height="315" src="<? echo $youtube; ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->



                                <div class="selectors">

                                    <section id="gallery">
  <div class="container">
    <div id="image-gallery">
      <div class="row">



                                    <?php
                                        if($type=="1")
                                        {
                                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='$prid' order by rank";
                                        }
                                        else if($type=="2")
                                        {
                                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";
                                        }

                                        //echo $sqlimg;

                                        $qryimg=mysqli_query($con,$sqlimg);
                                        while($rowimg23=mysqli_fetch_array($qryimg))
                                        {
                                            $img = str_replace("/ ","/",$rowimg23[0]);

                                            $path=trim($pathmain."uploads".$img);

                                            $expl=explode('/',$path);

                                            $cnt=count($expl);

                                            $angle_img=trim($pathmain."thumbs/".trim($expl[$cnt-1]));
                                            $zoom_img = $path;

                                    ?>




        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
          <div class="img-wrapper">
            <a href="<? echo $zoom_img; ?>"><img src="<? echo $zoom_img; ?>" class="img-responsive"></a>
            <div class="img-overlay">
              <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
          </div>
        </div>

                                    <?php } ?>


      </div><!-- End row -->
    </div><!-- End image gallery -->
  </div><!-- End container -->
</section>
 </div>
</div>

</div>
<style>
	#gallery {
  padding-top: 40px;
}
@media screen and (min-width: 991px) {
  #gallery {
    padding: 60px 30px 0 30px;
  }
}

.img-wrapper {
  position: relative;
  margin-top: 15px;
}
.img-wrapper img {
  width: 100%;
}

.img-overlay {
  background: rgba(0, 0, 0, 0.7);
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
}
.img-overlay i {
  color: #fff;
  font-size: 3em;
}

#overlay {
  background: rgba(0, 0, 0, 0.7);
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
#overlay img {
  margin: 0;
  width: 80%;
  height: auto;
  -o-object-fit: contain;
     object-fit: contain;
  padding: 5%;
}
@media screen and (min-width: 768px) {
  #overlay img {
    width: 60%;
  }
}
@media screen and (min-width: 1200px) {
  #overlay img {
    width: 50%;
  }
}

#nextButton {
  color: #fff;
  font-size: 2em;
  transition: opacity 0.8s;
}
#nextButton:hover {
  opacity: 0.7;
}
@media screen and (min-width: 768px) {
  #nextButton {
    font-size: 3em;
  }
}

#prevButton {
  color: #fff;
  font-size: 2em;
  transition: opacity 0.8s;
}
#prevButton:hover {
  opacity: 0.7;
}
@media screen and (min-width: 768px) {
  #prevButton {
    font-size: 3em;
  }
}

#exitButton {
  color: #fff;
  font-size: 2em;
  transition: opacity 0.8s;
  position: absolute;
  top: 15px;
  right: 15px;
}
#exitButton:hover {
  opacity: 0.7;
}
@media screen and (min-width: 768px) {
  #exitButton {
    font-size: 3em;
  }
}
</style>
<script>
	// Gallery image hover
$( ".img-wrapper" ).hover(
  function() {
    $(this).find(".img-overlay").animate({opacity: 1}, 600);
  }, function() {
    $(this).find(".img-overlay").animate({opacity: 0}, 600);
  }
);

// Lightbox
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

// Add overlay
$overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
$("#gallery").append($overlay);

// Hide overlay on default
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function(event) {
  // Prevents default behavior
  event.preventDefault();
  // Adds href attribute to variable
  var imageLocation = $(this).prev().attr("href");
  // Add the image src to $image
  $image.attr("src", imageLocation);
  // Fade in the overlay
  $overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function() {
  // Fade out the overlay
  $(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").next().find("img"));
  // All of the images in the gallery
  var $images = $("#image-gallery img");
  // If there is a next image
  if ($nextImg.length > 0) {
    // Fade in the next image
    $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  } else {
    // Otherwise fade in the first image
    $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
  }
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").prev().find("img"));
  // Fade in the next image
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function() {
  // Fade out the overlay
  $("#overlay").fadeOut("slow");
});
</script>
        				<?
//         				ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


        				?>

        				<div class=" bo9 w-size14 p-t-0 respon5 p-b-0 ">
					        <div class=" p-l-20 p-r-20 p-t-20 p-b-20 mainbox">
                        		<h4 class="product-detail-name m-text15 p-b-10">
                        			<?php echo $rws[3];?>
                        			<title><? echo $rws[3]; ?></title>
                        		</h4>

        						<span class="p-b-10" style="color:#E6BE6E;"><strong>SKU: <?php echo $rws[2];?></strong></span>
        						<br>
        						<?php
                                if($rws['discount']>0){
                                    $ab=($rws['discount']/100)*$rero[0];
                                    $newsp=$rero[0]-$ab;
                                }
                                $mrp_price = $rero[0];
                                if($rero[0]==$newsp)
                                {

                                ?>
                                   <span class="p-b-10 thisone" style="color:#E6BE6E;"><strong>MRP: <? echo $currency_symbol . ' ' ; ?> <?php echo round(currencyAmount($currency,$rero[0]),2); ?></strong></span>
                                   <input type="hidden" name="mrp" id="mrp" value="<?php echo $rero[0]; ?>">
                                   <?php
                                } else {
                                   ?>
                                  <span class="p-b-10 thatone" style="color:#E6BE6E	;">MRP: <? echo $currency_symbol . ' ' ; ?> <?php echo round(currencyAmount($currency,$rero[0]),2); ?></span>
                                   <!--<span class="p-b-10" style="color:#E6BE6E	;"><strong>MRP: <strike><?php echo $rero[0]; ?></strike> <b>Now </b> <?php echo $newsp; ?>  <br /> </strong> </span>-->

                                   <input type="hidden" name="price1" id="price" value="<?php echo $newsp; ?>">

                                    <?php if($rws['discount']>0){ ?>
                                        <font color="#00ff99"><b>Flat</b></font> &nbsp;<?php echo $rws['discount']; ?>%  off<br />
                                        <span class="p-b-10" style="color:#E6BE6E	;"><strong>Flat: </strong></span>
                                    <?php
                                    }
                                }


                                ?>
                                                                <br>

            						<?php if($pick_date!='' && $delivery_date!='' && get_booking_status($row[2]) !='Returned') { ?>
                            						<span class="block2-price m-text6 p-r-5">
                            						    <?php
                            						    if(date("m/d/Y", strtotime($pick_date)) === '01/01/1970'){

                            						    }else{ ?>

                                                            <span class="p-b-10" style="color:#E6BE6E;"><strong>Booking Status Dates : <?php echo date("m/d/Y", strtotime($pick_date)) .' - '. date("m/d/Y", strtotime($pick_date)) ;?></strong></span>

                            						    <?php }

                            						    ?>

                        						    </span>
                    						    <?php } ?>



                                <span class="label label-primary">
                                    <?php //echo $book_status $pick_date $delivery_date; ?>
                                </span>

						        <hr style="background-color:#e6be6e">

							<div class="fs-15 p-b-5">
								<div class="">
									<table style="border:0px;">
										<tr style="border:0px; padding-bottom: 10px; ">
    										<td style="border:0px; padding-bottom: 10px; "	>
    									        <span class="fs-15"  style="color: #555555;"> <b>Rent Price</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    										</td>

    										<td style="border:0px; padding-bottom: 10px; "><b>:</b></td>

    										<td style="border:0px; padding-bottom: 10px; ">
            									<strong>
            										<span class="fs-15 m-l-10" style="color: #424242;font-size: 18px;" ><? echo $currency_symbol . ' ' ; ?> <input type="hidden" id="rent_price_inr" value="">  <label id="rent_price"> </label> </span>
            									</strong>
            								</td >
								        </tr>

								        <input type="hidden" name="sku" id="sku" value="<?php echo $rws[2];?>">

        								<tr>
        									<p></p>
        								</tr>

        								<tr>
        									<td style="border:0px; padding-bottom: 10px; ">
        								        <span class="fs-15 "  style="color: #555555;"><b>Deposit</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        								    </td>
        								    <td style="border:0px; padding-bottom: 10px; "><b>:</b></td>
        									<td style="border:0px; padding-bottom: 10px; " >
            									<strong>
            							<span class="fs-15 m-l-10"  style="font-size: 18px;color: #424242;" ><? echo $currency_symbol ; ?> <input type="hidden" id="deposite_amount_inr" value="<? echo $deposit; ?>"><label id="deposite_amount" ><?php echo round(currencyAmount($currency,$deposit),2); ?></label></span>
            									</strong>
        									</td>
        								</tr>
        								<tr>
        									<p></p>
        								</tr>
								        <!-- stock -->

										<div class="m-t-10">
											<tr>
												<td style="border:0px;padding-bottom: 10px; ">
											        <span class="fs-15 " style="color: #555555;"><b>Stock</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
										        </td>
    											<td style="border:0px;padding-bottom: 10px; "><b>:</b></td>
    												<td style="border:0px;padding-bottom: 10px; ">
    												<span class="fs-15 m-b-15 m-t-15 m-l-10 " style="color: #000000;"><?php echo $qty; ?> in stock</span>
    											</td>
											</tr>
											<tr>
												<td style="border:0px;" ></td>
											        <p></p>
											    </td>
											</tr>
										</div>

									</table>
								</div>
							</div>

						    <hr style="background-color:#e6be6e">
						    <p><strong class="m-b-5" style="color: #444444;">Rental period</strong></p>

<style>

.day_select{
    display:flex;
}
        .day_select div , .day_select div label {
            width: 100%;
        }

.day_select div label{
    padding:10% ! important;
    text-align:center;
}

.day_select div{
    margin: auto 1%;
}

</style>
							<div class="day_select">

							    <div>
							    <input class="checkbox-budget" type="radio" name="budget" id="3" <? if($_GET['days']==3 || !isset($_GET['days']) ){ echo 'checked'; }?> >
        						<label class="for-checkbox-budget" for="3">
        							<a href="<?php echo $url .  '&&days=3'?>"><span data-hover="3 Days">3 Days</span></a>
        						</label>
							    </div>

        						<div>
        						<input class="checkbox-budget" type="radio" name="budget" id="4" <? if($_GET['days']==4 ){ echo 'checked'; }?>>
        						<label class="for-checkbox-budget" for="4">
        							<a href="<?php echo $url .  '&&days=4'?>"><span data-hover="4 Days">4 Days</span></a>
        						</label>
        						</div>

        						<div>
        						    <input class="checkbox-budget" type="radio" name="budget" id="5" <? if($_GET['days']==5 ){ echo 'checked'; }?>>
        						<label class="for-checkbox-budget" for="5">
        							<a href="<?php echo $url .  '&&days=5'?>"><span data-hover="5 Days">5 Days</span></a>

        						</label>
        						</div>

        						<div>
        						<input class="checkbox-budget" type="radio" name="budget" id="6" <? if($_GET['days']==6 ){ echo 'checked'; }?>>
        						<label class="for-checkbox-budget" for="6">
        							<a href="<?php echo $url .  '&&days=6'?>"><span data-hover="6 Days">6 Days</span></a>
        						</label>
        						</div>

                				<div>
                				<input class="checkbox-budget" type="radio" name="budget" id="7" <? if($_GET['days']==7 ){ echo 'checked'; }?>>
        						<label class="for-checkbox-budget" for="7">
        							<a href="<?php echo $url .  '&&days=7'?>"><span data-hover="7 Days">7 Days</span></a>
        						</label>
                				</div>



						    </div>

						    <hr style="background-color:#e6be6e">
							<!--<div class="">-->
							<!--    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxOCI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48ZWxsaXBzZSBjeD0iOSIgY3k9IjE0LjQ3OCIgZmlsbD0iI0ZGRTExQiIgcng9IjkiIHJ5PSIzLjUyMiIvPjxwYXRoIGZpbGw9IiMyODc0RjAiIGQ9Ik04LjYwOSA3LjAxYy0xLjA4IDAtMS45NTctLjgyNi0xLjk1Ny0xLjg0NSAwLS40ODkuMjA2LS45NTguNTczLTEuMzA0YTIuMDIgMi4wMiAwIDAgMSAxLjM4NC0uNTRjMS4wOCAwIDEuOTU2LjgyNSAxLjk1NiAxLjg0NCAwIC40OS0uMjA2Ljk1OS0uNTczIDEuMzA1cy0uODY0LjU0LTEuMzgzLjU0ek0zLjEzIDUuMTY1YzAgMy44NzQgNS40NzkgOC45MjIgNS40NzkgOC45MjJzNS40NzgtNS4wNDggNS40NzgtOC45MjJDMTQuMDg3IDIuMzEzIDExLjYzNCAwIDguNjA5IDAgNS41ODMgMCAzLjEzIDIuMzEzIDMuMTMgNS4xNjV6Ii8+PC9nPjwvc3ZnPg==" class="location_icon" style="margin-right: 6px;">-->
							<!--    <strong class="m-b-5" style="color: #444444;">Deliver to </strong>-->
							<!--    <div class="">-->
    			<!--					<form class = "formimages" class="" enctype="multipart/form-data" method="POST" >-->
    			<!--						<div style="display: flex; margin: 1%;">-->
    			<!--							<input  type='text' placeholder="Enter your pincode" style="padding:5px;width:70%; margin: auto 1%;border:1px solid #353746 !important;" name="delivery_pin" id="delivery_pin" value=""/>-->
    			<!--						    <input class="btn btn-primary" type="button"  value="check Location"  id = "check_location" name="check_location"  style="width:30%; padding:0;  background-color: #353746;color: white;"/>-->

    			<!--						</div>-->
    			<!--					</form>-->
							<!--    </div>	-->
						 <!--   </div>-->
						    <br>



<?
// var_dump($newbooking);


// foreach($block_date as $ss_date => $ss_val){
//     echo $ss_val ;

//     echo '<br>';
// }

?>

							<div class="">
							    <strong class="" style="color: #444444;">Select Date : </strong> <br>
							    <div class="" style="border-color:#E6BE6E;">
    								<div class="bo1 input-container lengthdate" style="border-color:#353746;">
    									<i class="fa fa-calendar icon" style="font-size:14px;color: white; background-color: #353746;"></i>
								        <input type="text" name="daterange" id="dateRangeP" value="<?php echo $start_date . ' - ' . $end?>"  style="text-align: left; width: 100%;padding-left: 3%;"></p>
    								</div>
							    </div>
						    </div>
							<!--<div class="rating" style="margin-top: 29px;">-->
							<br>

							<div class="row">
                                    <div class="col-md-6" style="border-color:#353746;">
                                        <input type="text" name="Pincode"  placeholder="Enter Pincode" class="form-control" id="delivery_pincode" style="border-bottom:1px solid black !important;" maxlength="10" onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="col-md-6">
                                      <input onclick="checkdelivery()" type="submit" value="Check Availability" title="Check Delivery" class="btn btn-danger" style="margin: 10px;width:100%">
                                    </div>
                                    <div class="col-md-12">
                                       <span id="placedata"></span><br/>
                                       <span id="checkdeliveryresult"></span>
                                    </div>
                            </div>

							<br>

							<!--<div >-->
       <!--                     	<span class="review-no"><?php echo $total_view;?> people viewed this product.</span>-->
       <!--                     </div>-->
                            <?php
                            $rating_result = get_rating_review($id,$type);
                             if($rating_result['rating_count'] > 0) {
                                $total_rating = $rating_result['total_rating'] / $rating_result['rating_count'];
                             } else {
                                $total_rating = 0;
                             }

                            ?>

                            <br>
<br>

		                    <!-- add to cart code -->

							<?php if($qty > 0){ ?>
							    							<div class="">
										<input class="btn" type="button" value="Add To Cart"  id = "add_to_cart" name="add_to_cart"  style="background-color: #353746;color: white; width:100%;"/>
							</div>
							<? }
							else{ ?>
							    <a href="#" class="btn" style="background-color: #353746;color: white; width:100%;">Sorry ! This Product is not available now !</a>
							<? } ?>

							<input type="hidden" name="h_days_index" id="id_days_index" value="" />
		                    <!-- end add to cart code -->
		                </div>
				    </div>
			    </div>

			    <?
			    function addNewLine($string){
   $newString = '';
   $split= preg_split("/[]+/",$string);
   foreach($split as $char){
        $newString.=$char.'<br />';
   }
      return $newString;
}


			    ?>
			    <?php if($rws['gproduct_desc']) { ?>
    			    <div class="flex-w flex-sb respondesc" >
        				<div class="bo9 p-t-20 p-t-20 p-l-20 p-r-20 p-b-20 m-t-40" style="width:100%;">
        					<h5 class="fs-16" style="color: #444444;"><strong> Description :</strong> </h5>
        					<hr/>
        					<p class="decri">
        					    <?

        					    $description = $rws['gproduct_desc'];

        					     $description = str_replace("•","●",$description);


        					    $description =  str_replace("●","<br>● ",$description);
echo $description ;
        					    ?>
        					 </p>



        					<div class="dropdown-content p-t-15 p-b-23">
        						<p class="s-text8">
        							<p> <?php echo addNewLine($rws['gproduct_desc']) ;  ?></p>
        					</div>
        				</div>
        			</div>
    			<?php }elseif($rws['product_desc']){ ?>
    			    <div class="flex-w flex-sb respondesc" >
        				<div class="bo9 p-t-20 p-t-20 p-l-20 p-r-20 p-b-20 m-t-40" style="width:100%;">
        					<h5 class="fs-16" style="color: #444444;"><strong> Description :</strong> </h5>
        					<hr/>
        					<p class="decri">
        					    <?

        					    $description = $rws['product_desc'];

        					     $description = str_replace("•","●",$description);


        					    $description =  str_replace("●","<br>● ",$description);
                    echo $description ;
        					    ?>
        					 </p>



        					<div class="dropdown-content p-t-15 p-b-23">
        						<p class="s-text8">
        							<p> <?php echo addNewLine($rws['product_desc']) ;  ?></p>
        					</div>
        				</div>
        			</div>
    			<? } ?>
		    </div>
		</div>
	</div>
  </div>
</section>






<br><br>

<? include('like_same_category.php'); ?>


<? include('like_history.php'); ?>


<? include('from_suggestionlist.php'); ?>
<br><br>

<script>
    (function() {

// store the slider in a local variable
var $window = $(window),
flexslider = { vars:{} };

// tiny helper function to add breakpoints
function getGridSize() {
return (window.innerWidth < 600) ? 2 :
(window.innerWidth < 900) ? 5 : 6;
}

$(function() {
// SyntaxHighlighter.all();
});

$window.load(function() {
$('.flexslider').flexslider({
animation: "slide",
animationLoop: true,
itemWidth: 210,
itemMargin: 5,
minItems: getGridSize(), // use function to pull in initial value
maxItems: getGridSize() // use function to pull in initial value
});
});

// check grid size on resize event
$window.resize(function() {
var gridSize = getGridSize();

flexslider.vars.minItems = gridSize;
flexslider.vars.maxItems = gridSize;
});
}());
</script>






<script>
$(function() {
    var result = new Date();
    result.setDate(result.getDate() + 7);




    $('input[name="daterange"]').daterangepicker({

        dateLimit: { days: 7 },
        "dateFormat": "dd-mm-yy",
        "maxDate": 7,
        minDate: result,
        locale: {
            format: 'MM/DD/YYYY '
        }
    });

});


var array2 = <?php echo $block_date_json; ?>;
var array1 = [] ;
var array= array1.concat(array2);

$(function(){
       $('input[name="daterange"]').daterangepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date(),
        isInvalidDate: function(date) {
        for (i = 0; i < array.length; i++) {
            if (date.format('MM/DD/YYYY') == array[i]) {
                return true;
                }
            }
        }
    });
});



	$('#add_to_cart').on('click',function() {


    var pid = <?php echo $id; ?>;
    var type = <?php echo $_GET['type']; ?>;
    var qty = 1;
    var sku = $("#sku").val();
    var price = $("#rent_price_inr").val();
    var dateRangeP = $('#dateRangeP').val();
    var dateRangeP_arr = dateRangeP.split('-');
    var sales_price = <?php echo $newsp; ?>;
    var deposit = $('#deposite_amount_inr').val();
    var image = '<? echo $path ; ?>' ;

    console.log('pid = '+pid);
    console.log('type = '+type);
    console.log('sku = '+sku);
    console.log('price = '+price);
    console.log('from = '+dateRangeP_arr[0]);
    console.log('to = '+dateRangeP_arr[1]);
    console.log('sales_price = '+sales_price);
    console.log('deposit = '+deposit);





	if($('#dateRangeP').val()==''){
		swal('Please select Date or Days','','error');
	}
	else {
	    $.ajax({
           type: 'POST',
            url:'addcart_process_demo.php',
            data:'pid='+pid+'&type='+type+'&qty='+qty+'&rent_date='+dateRangeP_arr[0]+'&return_date='+dateRangeP_arr[1]+'&price='+price+'&deposit='+deposit+'&sales_price='+sales_price+'&image='+image+'&sku='+sku,

            success: function(msg){
                if(msg==1){
                    swal('Product Added To Cart Successfully. ','','success');
                    setTimeout(function(){
                        window.location.href="";
                    }, 3000);
                }else if(msg==0){
                    swal('Product Added Error ','','error');
                }else if(msg==11){
                    swal('insufficient Quantity','','warning');
                }



            }
        });

	  //  $(".cart_anchor").effect( "shake", { direction: "left", times: 4, distance: 101}, 2000 );
	 }
});

function checkdelivery(){
    var deliverypincode = $('#delivery_pincode').val();
    if (deliverypincode.length==6) {
        $.ajax({
               type: 'POST',
                url:'LocationFinder.php',
                data:'pincode='+deliverypincode,
                success: function(msg){
                    var html = "";
                    if(msg=='Yes'){
                         html = "<span style='color:green;margin-left:1%;'>Delivery Available</span>";
                    }else{
                        html = "<span style='color:red;margin-left:1%;'>Delivery Not Available!</span>";
                    }
                    $("#checkdeliveryresult").html(html);
                }
        });
    }
    else
      {
        html = "<span style='color:red;margin-left:1%;'>Not a valid Pincode</span>";
         $("#checkdeliveryresult").html(html);

      }
}
</script>

	<script type="text/javascript" src="static/css/vendor/select2/select2.min.js"></script>


<?php include('footer.php'); ?>