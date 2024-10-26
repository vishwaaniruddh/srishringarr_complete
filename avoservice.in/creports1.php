<?php session_start();
include("access.php");
include('functions.php');
include("menubar.php"); 
include('config.php');
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reports</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="menu.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">

    
   <style>
   #custome_buyer_information,#buyer_information{
       color: white;
    text-align: left;
   }
   
   #buyer_information label,#custome_buyer_information label{
       width:30%;
   }
  #buyer_information span, #custome_buyer_information span{
       width:70%;
   }
   .add_heading{
       color:white;
   }
   .custom_inside_row{
       width:47%;
       display: flex;
    height: fit-content;
   }
   
   .custom_inside_row .span_label{
       width:98%;
       
   }
   html[xmlns] #menu-bar {
    display: block;
    z-index: 100000;
    position: relative;
}

   #header, #form1 table{
       width:80%;
   }
   input[type="text"] {
     width: 100%; 
}
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
 
             .select-editable {
     position:relative;
     background-color:white;
     border:solid grey 1px;
     width:120px;
     height:18px;
 }
 .select-editable select {
     position:absolute;
     top:0px;
     left:0px;
     font-size:14px;
     border:none;
     width:120px;
     margin:0;
 }
 .select-editable input {
     position:absolute;
     top:0px;
     left:0px;
     width:100px;
     padding:1px;
     font-size:12px;
     border:none;
 }
 .select-editable select:focus, .select-editable input:focus {
     outline:none;
 }
        </style>

</head>

<body>



<br>

<?

$type = $_GET['report_type'];




            if(!empty($_GET['report_type']) || !empty($_GET['daterange'])){
                
                
                unset($_GET['report_type']);
                $k = $_GET;
                
                // $sliced = array_slice($k, 0, -1);


                if(isset($k)){

                    $split = explode("-",$daterange);
                    $from = $split[0]; 
                    $to = $split[1];
                    

                        $statement= "select count(*) as fetch_count from new_sales_order,so_order where new_sales_order.so_trackid = so_order.po_id and   ";




                    
                    foreach($k as $key=>$val){
                        
                        if($val){
                            

                            if($key=='daterange'){
                                
                                
                                if($type=='1'){
                                    $daterange = $_GET['daterange'];                                
                                    $split = explode("-",$daterange);
                                    $from = $split[0]; 
                                    $to = $split[1];                
    
                                    
                                    $date1 = date('Y-m-d', strtotime($from));
                                    $date2 = date('Y-m-d', strtotime($to));
                                    
                                    $statement .=" new_sales_order.so_time between '".$date1." 00:00:00' and '".$date2." 23:59:59'";
                                    $statement .= " and";
                                    
                                    
                                   
    
                                    $statement .=" so_order.inv_date between '".$date1."' and '".$date2."' ";
                                    $statement .= " and";                                    
                                }
                                else if($type=='2'){
                                    $daterange = $_GET['daterange'];                                
                                    $split = explode("-",$daterange);
                                    $from = $split[0]; 
                                    $to = $split[1];                
                                    
                                    
                                    $date1 = date('Y-m-d', strtotime($from));
                                    $date2 = date('Y-m-d', strtotime($to));
                                    
                                    $statement .=" new_sales_order.so_time between '".$date1." 00:00:00' and '".$date2." 23:59:59'";
                                    $statement .= " and";
                                    
                                    
                                    
                                    
                                    $statement .=" so_order.dis_date between '".$date1."' and '".$date2."' ";
                                    $statement .= " and";
                                }


                                else if($type=='3'){
                                    $daterange = $_GET['daterange'];                                
                                    $split = explode("-",$daterange);
                                    $from = $split[0]; 
                                    $to = $split[1];                
                                    
                                    
                                    $date1 = date('Y-m-d', strtotime($from));
                                    $date2 = date('Y-m-d', strtotime($to));
                                    
                                    $statement .=" new_sales_order.so_time between '".$date1." 00:00:00' and '".$date2." 23:59:59'";
                                    $statement .= " and";
                                    
                                    
                                    
                                    
                                    $statement .=" so_order.inv_img_time between '".$date1." 00:00:00' and '".$date2." 23:59:59' ";
                                    $statement .= " and";
                                }

                                
                                
                                
                                
                                
                                
                            }
                            else{
                                
                                

                                $statement .=" $key='".$val."'";
                                
                                $statement .= " and";

                            }
                            
                     
                        }
                        
                    }   
                }
                    $statement = substr($statement, 0, strlen($statement)-3);

    $sql =$statement;
    // echo $sql;
}


// end Filter




?>




<h1>
    <center>Reports</center>
</h1>

<div class="container-fluid">
    

<form action="creports.php" method="GET">
    
    <div class="row">
    
        <div class="col-md-3">
                <select name="report_type" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="1" <? if($type=='1'){ echo 'selected'; } ?> >Sales order - Call Generate</option>
                        <option value="2" <? if($type=='2'){ echo 'selected'; } ?> >Sales order - Delivery</option>
                        <option value="3" <? if($type=='3'){ echo 'selected'; } ?> >Sales order - Invoice upload</option>
                        <option value="4" <? if($type=='4'){ echo 'selected'; } ?> >Sales order - Call Close</option>
                </select>
        </div>
        
        <div class="col-md-3">
            <input type="text" value="<? echo $_GET['daterange'];?>" class="form-control" name="daterange" id="dateRangeP"></p>          
        </div>  
        
        <div class="col-md-3">
            <select class="form-control" name="po_custid">
                <option value="">Select</option>
                
                <?php
                    $customer_qry = mysqli_query($con1,"select * from customer");
                    
                    while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                        <option value= "<?php echo $customer_vertical['cust_id']; ?>" <? if($_GET['po_custid']==$customer_vertical['cust_id']){ echo 'selected'; } ?> >
                             <?php echo $customer_vertical["cust_name"];?>
                        </option>
                <?php } ?>
                                        
                                        
            </select>
        </div>
        
                                   
                                    
                                    
                                    
                                    <div class="col-md-3">
                                        <select id="branch_id" class="form-control" name="branch_id">
                                            
                                            <option value="">Select Branch</option>
                                            
                                            <? $branch_sql = mysqli_query($con1,"select * from avo_branch");
                                            
                                            while ($branch_sql_result = mysqli_fetch_assoc($branch_sql)) { ?>
                                            <option value= "<?php echo $branch_sql_result['id']; ?>" <? if($_GET['branch_id']==$branch_sql_result['id']){ echo 'selected'; }
                                            ?>>
                                            
                                            <?php echo $branch_sql_result["name"];?>
                                            
                                            </option>
                                            <?php } ?>

                                    </select>
                                    </div>
                                    <br><br>

    </div>
    <div style="display:flex;justify-content:center;">
        <input type="submit" class="btn btn-danger">                                    
    </div>
    

    
    




    
    
</form>



<?

$sql= mysqli_query($con1,$sql);
$sql_result = mysqli_fetch_assoc($sql);



if($sql_result['fetch_count']){ ?>

<h1 style="color:white; text-align:center;margin: 10% auto;
    font-size: 5rem;">Total <? echo $sql_result['fetch_count'];?> Records Found !</h1>
</div>    
<? }
else{ ?>
    <h1 style="color:white; text-align:center;margin: 10% auto;
    font-size: 5rem;">Filter To Get the Results !</h1>
</div>
<? } ?>






 <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">//<![CDATA[


$(function() {
    $('input[name="daterange"]').daterangepicker({

        locale: {
            format: 'MM/DD/YYYY '
        },
   
    });
   
});



  //]]>
  </script>

  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "rLnycn80"
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>

    <script>
      let allLines = []

      window.addEventListener("message", (message) => {
        if (message.data.console){
          let insert = document.querySelector("#insert")
          allLines.push(message.data.console.payload)
          insert.innerHTML = allLines.join(";\r")

          let result = eval.call(null, message.data.console.payload)
          if (result !== undefined){
            console.log(result)
          }
        }
      })
    </script>
</body>
</html>