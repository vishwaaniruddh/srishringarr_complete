<?php session_start();
include("access.php");
include('config.php');
//include('functions.php');

include("menubar.php");  
        
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New Sales Order </title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="menu.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
      
      <style>
      
      input:focus{
          outline: none;
      }
      .custom_radio{
              width: 5%;
    height: 20px;
      }
      .cust_column{
          display:flex;
      }
      .submit_btn{
          display:flex;
          justify-content:center;
      }
      .submit_btn input{
          width:15%;
          margin:2%;
      }
      
      
      input[type="text"]{
          width:100%;
      }
      .optional_input, .hide{
    display: none;
}

.show {
    display: block ! important;
}
           html[xmlns] #menu-bar {
    display: block;
    z-index: 1000;
    position: relative;
}
#menu-bar li:hover > ul {
    text-align: center;
}

#menu-bar{
        width: 100%;
}
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
   #custer_vertical, #po_no{
       width:100%;
   }

   .additional_buttons{
       display: flex;
    justify-content: center;

   }
   .additional_buttons form{
       margin:1%;
   }
   .custom_row label{
       display:block;
           font-size: 18px;
   }
   .row{
       margin:2%;
   }
   label{
       color:white;
   }
    html[xmlns] #menu-bar {
    display: block;
    z-index: 1000;
    position: relative;
}
#menu-bar ul{
    z-index: 999;
}
table{
    width: 50% !important;
    margin: auto;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

#check_partial_product ,#check_all_product{
    border: 0;
    border-radius: 0;
    box-shadow: none;
}
input[type=checkbox]{
        height: 20px;
    width: 20px;
    margin: 0;
}
#po_qty{
        background-color: transparent;
    border: none;
        text-align: center;
    width: 100%;
}
      </style>
    </head>
    
               <div class="search_fields" style="margin: 1%;">
                    
                    <form class="form-inline" method="POST">    
                        
                    <div class="form-group col-md-3">
                    <label for="staticEmail2" class="sr-only">Invoice No</label>
                    <input type="text"  class="form-control" id="po_no" name="po_no" value="<?= $po_no; ?>" placeholder="Invoice Number">
                    </div>
                    
                    <input class="btn btn-success" type="submit" name="search" value="Search">
                    
                    </form>
                </div>
           
           
           <?
           $po_no = $_POST['po_no'];
           
           
           if($po_no){
           echo "<h4 style='color:white;text-align:center;'>Search Result for '".$po_no."' </h4>";
           $sql = mysqli_query($con1,"select * from so_order where inv_no like '%".$po_no."%' and status=2");
           ?>
           <div class="search_result" style="font-size:20px; width:100%;text-align:center; ">
           <?
               while($sql_result = mysqli_fetch_assoc($sql)){
                   
                   
                  $po = $sql_result['inv_no'];
                  $soid = $sql_result['id'];
                  $claim_status=$sql_result['logistics_claim_status'];
            if($claim_status==0){      
                  ?>
                <a style="color:white;" href="logistics.php?id=<? echo $soid; ?>"><? echo $po;?></a>
                <?
               } else { echo $po." - Already Claimed" ; }
               
               
                   echo '<br>';
               }?>    
           </div>
                          
           <? } else echo "No Results Found";

           ?>     
    </body>
      
      </html>  