<? session_start(); 
include('config.php');
        include("access.php");

//var_dump($_SESSION);



     if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
        
        
function get_so_status($id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from so_order where po_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['status'];
    
}




function get_new_sales_order_data($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from new_sales_order where so_trackid = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    }


function get_branch($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from demo_atm where so_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_id = $sql_result['branch_id'];
    
    $branch_sql = mysqli_query($con1,"select * from avo_branch where id = '".$branch_id."'");
    
    $branch_sql_result = mysqli_fetch_assoc($branch_sql);
    
    return $branch_sql_result['name'];
    
}




function get_cust($id){
    
    global $con1;
    
    
    $sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_id = $sql_result['po_custid'];
    
    $cust_sql = mysqli_query($con1,"select * from customer where cust_id = '".$cust_id."'");
    
    $cust_sql_result = mysqli_fetch_assoc($cust_sql);
    
    return $cust_sql_result['cust_name'];
    
}


function get_atm($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from demo_atm where so_id = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}
//======== Sales Exe===========
function get_salesPerson($id){
    
    global $con2;
    
    $sql = mysqli_query($con1,"select * from purchase_order where id='".$po."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $person_id = $sql_result['salesperson'];
    
    $executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where exe_id='".$person_id."'");
    $executive_name = mysqli_fetch_assoc($executive_qry);
    $name = $executive_name['exe_name'];
    
    return $name;
    
}







//=========== get all branch_id for account manager as comma seprated value

if($_SESSION['branch']!='all' ){
            
            $customer_qry = "select * from login where srno='".$_SESSION['logid']."'";

        
        $query = mysqli_query($con1,$customer_qry);
        
        while($branch_qry_result = mysqli_fetch_assoc($query)){
        

          $branch_ids[] = $branch_qry_result['branch']; 



        }
        
        
        if($branch_ids){
            $branch_id=json_encode($branch_ids);
            
            $branch_id=str_replace( array('[',']') , ''  , $branch_id);
            
            $branch_id = implode(',',array_unique(explode(',', $branch_id)));
            
        }
        
        }
        else{
            
            $customer_qry = "select * from avo_branch";    
        } 
        
      //  echo $branch_id;


// end get all branch_id for account manager as comma seprated value



// get all customer vertical


if($_SESSION['designation']==5 ){
            
            $cv = "select * from clienthandle where logid='".$_SESSION['logid']."'";

        
        $cv_query = mysqli_query($con1,$cv);
        
        while($cv_result = mysqli_fetch_assoc($cv_query)){
        

          $cv = $cv_result['client']; 
          
          $get_cust_sql = mysqli_query($con1,"select * from customer where cust_name='".$cv."'");
          $get_cust_sql_result = mysqli_fetch_assoc($get_cust_sql);
          
          $cvs[] = $get_cust_sql_result['cust_id'];


        }
        
        
        if($cvs){
            $cust=json_encode($cvs);
            
            $cust=str_replace( array('[',']') , ''  , $cust);
            
            $cust = implode(',',array_unique(explode(',', $cust)));
            
        }
        
        }
        else{
            
            $customer_qry = "select * from customer";    
        }
        
        
        

        
        // end get all customer vertical

?>

<html>
    <head>
    
    <title>Sales Report </title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
          
      
      
      
      
     
 
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
          width:10%;
          margin:2%;
      }
      .dispatch_date input, input.swal-content__input{
          width:100% ! important;
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
    margin-top: 10px;
    
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
           font-size: 10px;
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
#search_filters{
    display:flex;
}
#search_filters input, #search_filters select{
    margin:auto 0.2%;
}
a.btn{
    color:white ! important;
}

      </style>
    </head>
    <body>
        <?


        
        
        
        
        if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}



$no_of_records_per_page = 25;
$offset = ($pageno-1) * $no_of_records_per_page; 

$total_pages_sql = "SELECT COUNT(*) FROM so_order";        
    $result = mysqli_query($con1,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);


        ?>
        
        
        <br><br><br>
        <div class="container-fluid">
            
        
        <div id="search_filters">
            
            
            
            <form id="search_filters" method="POST">
                
            <input type="text" class="form-control" name="inv_no" id="invno" value="<? if(isset($_POST['inv_no'])){ echo $_POST['inv_no']; }  ?>" placeholder="Invoice Number">



            <select name="avo_branch" class="form-control" id="avo_branch" >       
				<?
                    
                  //========
                   if($_SESSION['designation']==7 || $_SESSION['designation']=="7"){
                        
                        
                        if(strlen($branch_id)==0 || $branch_id=='all'){
                   $branch_sql = mysqli_query($con1,"select * from avo_branch " );
                        }
                        else { $branch_sql = mysqli_query($con1,"select * from avo_branch where id in($branch_id)");
                        }
                   }
             
				
				$branch_sql = mysqli_query($con1,"select * from avo_branch");?>
                <option value="">Branch</option>
                
                <?php  
                while($branch_sql_result = mysqli_fetch_assoc($branch_sql)){ ?>
                
                <option value="<?php echo $branch_sql_result['id']; ?>" <? if( $_POST['avo_branch'] ==$branch_sql_result['id']  ){ echo 'selected'; } ?> >
                
                    <?php echo $branch_sql_result['name']; ?>
                </option>
                
                <?php } ?>
            </select>
            
            
                   <select name="customer_vertical" class="form-control" id="customer_vertical">
               <option value="">Customer Vertical</option>
           
           
           <? 
           if($cust){ 
              
           $cust_sql = mysqli_query($con1,"select * from customer where cust_id in($cust)");
            
            while($cust_sql_result = mysqli_fetch_assoc($cust_sql)){ ?>
            
                <option value="<? echo $cust_sql_result['cust_id'];?>"  <? if( $_POST['customer_vertical'] ==$cust_sql_result['cust_id']  ){ echo 'selected'; } ?>  >
            
                    <? echo $cust_sql_result['cust_name'];?> 
                </option> 
            
                <? } ?>
                
           <? }
           else{
               
                          $cust_sql = mysqli_query($con1,"select * from customer"); 
            
            while($cust_sql_result = mysqli_fetch_assoc($cust_sql)){ ?>
            
                <option value="<? echo $cust_sql_result['cust_id'];?>"  <? if( $_POST['customer_vertical'] ==$cust_sql_result['cust_id']  ){ echo 'selected'; } ?>  >
            
                    <? echo $cust_sql_result['cust_name'];?> 
                </option> 
            
                <? } 
                } ?>
                
          
           
            </select>


            <input type="text" name="fromdt" id="fromdt" class="form-control" value="<? echo $_POST['fromdt']; ?>" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/>

            <input type="text" name="todt" id="todt" class="form-control" value="<? echo $_POST['todt']; ?>" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/>


            <input type="text" name="atm_id" id="atm_id" class="form-control" value="<? echo $_POST['atm_id']; ?>" placeholder="Site/Sol/ATM ID"/>
        
               
                            

                            
            <input type="submit" name="submit" class="form-control" value="submit">
                            
                            
</form>
        </div>
        </div>
        
       
       <?  
       
       if(isset($_POST["invno"]) || isset($_POST["branch_avo"]) || isset($_POST["cust"]) || isset($_POST["fromdt"]) || isset($_POST["todt"]) || isset($_POST["atmid"]) ){
         
 
                $k = $_POST;
                $sliced = array_slice($k, 0, -1);
     

                if(isset($sliced)){
            

                    $i = 0;
                     $string = '';
                    $statement= "select * from so_order where";
                    foreach($sliced as $key=>$val){
                        
                        if($val){
                                
                                if($key == 'inv_no'){
                                    
                                     $statement .=" $key LIKE '%".$val."%'";
                                     $statement .= " and";
                                    
                                }
                                
                                if($key=='fromdt'){ 
                                
                                $date1 = str_replace('/', '-', $val);
                                $date1 = date('Y-m-d', strtotime($date1));

                                 $statement .=" inv_date >= '".$date1."'";
                                  $statement .= " and";
                                  
                                  
                                }

                                  if($key=='todt'){                 
                                      
                                      $date2 = str_replace('/', '-', $val);
                                        $date2 = date('Y-m-d', strtotime($date2));
                                        $statement .=" inv_date <= '".$date2."'";
                                      $statement .= " and";
                                    }
                                    
                                if($key != 'inv_no' && $key !='todt' && $key !='fromdt'){
                                     
                                     $statement .=" $key='".$val."'";
                                     $statement .= " and";
                                }
                            

                            
                        }

                    }   
                }


    $statement = substr($statement, 0, strlen($statement)-3);
   
    $statement .= " order by id desc";
    $sql =$statement;
    


    $count_sql = str_replace("*","count(*) as count_number",$statement);

    $total_rows = mysqli_query($con1,$count_sql);

        $if_account = mysqli_fetch_assoc($total_rows);
        $total_rows = $if_account['count_number'];
        $total_pages = ceil($total_rows / $no_of_records_per_page);  
        
    

       }
       
        
        
    




       if(empty($statement)){

        $if_account = mysqli_query($con1,"select count(*) as count_number from so_order where status=1");

        $if_account = mysqli_fetch_assoc($if_account);
        $total_rows = $if_account['count_number'];
        $total_pages = ceil($total_rows / $no_of_records_per_page);  


}


?>


<!--Table-->



<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:3px;" class="res" id="custtable">
<tbody><tr>

<th>S.N.</th> 
<th>Invoice No</th> 
<th>Invoice Date</th>
<th>Invoice Value</th>
<th>Vertical Customer</th>
<th>End User Name</th>


<th>Address</th>
<th>Branch</th>
<th>Site/Sol/ATM ID</th>
<th>Credit Note No</th> 

<!--<th>Credit Note Date</th> -->
<th>Credit Note Amount</th>
<th>Delivery Type</th>
<th>Installation Request</th>
<th>Sales Executive</th>
<th>PO No.</th>

<th>Invoice Copy</th>
<th>Credit Note Copy</th>


<th>View Sales Order</th>

<th>Status</th>

</tr>

<?

    $sql = $sql." LIMIT  $offset, $no_of_records_per_page";
    $prepared_sql = mysqli_query($con1,$sql);
       
       if(empty($prepared_sql) || $prepared_sql==NULL || $prepared_sql=='' || !$prepared_sql){
           
           
    $prepared_sql = mysqli_query($con1,"select * from so_order where status=2 order by id desc LIMIT $offset, $no_of_records_per_page
");

  $total_pages = "SELECT COUNT(*) FROM so_order where status=2";        
                $result = mysqli_query($con1,$total_pages);
                $total_rows = mysqli_fetch_array($result)[0];
                
                
       }
       ?>
       <h4 style="color:white;text-align:center;">Total <? echo $total_rows;?> Records..</h4>
       <? 
       while($prepared_sql_result = mysqli_fetch_assoc($prepared_sql)){ 
       
       
           $id = $prepared_sql_result['po_id'];
        //   echo $id;
    

        $so_primary_id = $prepared_sql_result['id'];

//==========================================      
        $inst_rqst=get_new_sales_order_data('inst_request',$id);

if ($inst_rqst==1)
{$inst_rqst= "Yes"; }
else {$inst_rqst=  "No" ;} 

$po = get_new_sales_order_data('po_trackid',$id);



       ?>

           

<tr>
    
<td  valign="top"><?php echo ++$i; ?></td>
<td  name="inv_no" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_no']; ?></td>
<td  name="inv_date" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_date']; ?></td>
<td  name="inv_date" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_value']; ?></td>
<td  name="customer" valign="top">&nbsp;<?php echo get_cust($id); ?></td> 
<td  name="bank" valign="top">&nbsp;<?php echo get_atm('bank_name',$id); ?></td>
<td  name="address" valign="top">&nbsp; <?php echo get_atm('address',$id); ?></td>


<td  name="branch" valign="top">&nbsp;<?php echo get_branch($id); ?></td>  
<td  name="atm_id" valign="top">&nbsp;<?php echo get_atm('atm_id',$id); ?></td> 
<td  name="crn_no" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_no']; ?></td> 

<!--<td  name="crn_date" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_date']; ?></td> -->
<td  name="crn_amount" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_amount']; ?></td> 

<td  valign="top"><?php echo get_new_sales_order_data('del_type',$id); ?></td>
<td  Valign="top">&nbsp;&nbsp;<?php echo "$inst_rqst" ; ?> </td>


<? 

 global $con2;
    
    $sql = mysqli_query($con1,"select * from purchase_order where id='".$po."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $person_id = $sql_result['salesperson'];
    $po_no = $sql_result['po_no'];
    
    $executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where exe_id='".$person_id."'");
    $executive_name = mysqli_fetch_assoc($executive_qry);
    $name = $executive_name['exe_name'];
    
    ?>


<td  Valign="top">&nbsp;<?php echo "$name" ; ?> </td>

<td  Valign="top">&nbsp;<?php echo "$po_no" ; ?> </td>

<!--<td  valign="top">&nbsp;<?php echo get_new_sales_order_data('inst_request',$id); ?></td> -->


<td>
<?php if($prepared_sql_result['inv_img']!=null ){ ?>
<a href="<?php echo $prepared_sql_result['inv_img']; ?>" target="_blank" ><image src="<?php echo $prepared_sql_result['inv_img']; ?>" alt="view invoice" width="50" height="50" /></a>
<?php } ?>
</td>
<td>
<?php if($prepared_sql_result['crn_img']!=null or $prepared_sql_result['crn_img']!=''){ ?>
<a href="<?php echo $prepared_sql_result['crn_img']; ?>" target="_blank" >
<?php
$splt=explode(".",$prepared_sql_result['crn_img']);

echo $splt[1];

if(strtolower($splt[1])=="pdf")
{

?>
<a href="<?php echo $prepared_sql_result['crn_img']; ?> " download></a>
<?php
}
else{
?>
<image src="<?php echo $prepared_sql_result['crn_img']; ?>" alt="view credit note" width="50" height="50" /></a>
<?php } 
} ?>
</td>

<!--<td><a href="view_so.php?id=<?php echo $prepared_sql_result['po_id']; ?>" >View SO</a></td> -->

<td style="display: flex;justify-content: center;"> 
    
     <a style="color:black;" style="margin:5px;"class="btn btn-success" href="view_so.php?id=<? echo $prepared_sql_result['po_id']; ?>">View SO</a>
   
    </td> 



<td>
     <?
     if($prepared_sql_result['status'] =='1'){ echo "Pending"; }
     if($prepared_sql_result['status'] =='c'){ echo "Cancelled"; }
     if($prepared_sql_result['status'] =='h'){ echo "Hold"; }
     if($prepared_sql_result['status'] =='2'){ echo "Completed"; }
     ?>


</td>
 
 
</tr>           
           
                  <? }  ?> 
       <!--End While Loop-->
</table>       

<div class="pagiation_div" style="display:flex; justify-content:center;">
    

       <ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>

</div>

<script>
    function setSubmit(id)
{
    

             sub=document.getElementById('sub'+id).value;
 $.ajax({
        type: "POST",
        url: 'new_setSubmit.php',
        data: 'sub='+sub+'&id='+id,
        success:function(msg) {
            
            if(msg==1){
                alert('Succesfully Updated !');
            }
            else{
                alert('Some Problem Occured !');
            }

    }
        });


             
}
</script>

    <div style="display:flex:justify-content:center">
    
     <form name="frm" method="post" action="export_sales_rep.php" target="_new" style="text-align: center;">

    <input type="hidden" name="qr" value="<?php echo $statement; ?>" readonly>    
    
    
    <input type="submit" name="cmdsub" value="Export" > <span>(MAX 1200 Record at one Time.)</span>
    </form>
    

</div>     

    </body>
</html>