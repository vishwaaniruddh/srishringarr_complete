<? session_start(); 

// include('config.php');
include("access.php");
        
//echo $_SESSION['branch']."BBBB";
//var_dump($_SESSION);
include("db_connection.php");
$con1 = OpenCon1();
$con2 = OpenCon2();



     if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }

function get_atm($parameter, $id,$con1){
    
    // global $con;
    
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
        
 

?>

<html>
    <head>
    
    <title>Invoices </title>
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
          
      
      
      
      
      <script>
          function confirm_generate(cust,atmid,trackid,so_order_id)
{
//alert("cust="+cust+"&atmid="+atmid+"&trackid="+trackid+"&callid="+callid+'&frmpg=1");
if(confirm("Ensure Material is delivered at site."),confirm("Ensure Site is ready for Installation."))
  {
   // document.location="AccountManager/alert.php?cust="+cust+"&atmid="+atmid+"&trackid="+trackid+"&so_order_id="+so_order_id;
   document.location="gen_alert.php?cust="+cust+"&atmid="+atmid+"&trackid="+trackid+"&so_order_id="+so_order_id;
  }
  
}

function confirm_rental(cust,atmid,trackid,so_order_id)
{

if(confirm("Ensure Material is delivered at site."),confirm("Ensure Site is ready for Installation."))
  {
 document.location="AccountManager/alert_rental.php?cust="+cust+"&atmid="+atmid+"&trackid="+trackid+"&so_order_id="+so_order_id;
  }
  
}

function confirm_close(cust,atmid,trackid)
{
//alert("hi");
//alert("cust="+cust+"atmid="+atmid+"trackid="+trackid);

if(confirm("Ensure Material is delivered at site."))
  {
    document.location="confirm_close.php?cust="+cust+"&atmid="+atmid+"&trackid="+trackid;
  }
  
}

function inst_edit(id)
{
 // alert("Hi!!!!");
         //    soid=document.getElementById(id).value; 
          //   alert(id);
 $.ajax({
        type: "POST",
        url: 'inst_edit.php',
        data: 'id='+id,
     //   alert(url);
        success:function(msg) {
           // alert(msg);
            if(msg==1){
                alert('Succesfully Updated !');
            }
            else{
                
        // alert(msg);
         
                alert('Some Problem Occured !');
            }

    }
        });

}


      </script>
    
       <script>
    
    
function invoice_hold(id){
    
  swal("Hold Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();  
       
     
        jQuery.ajax({
                type: "POST",
                url: 'invoice_hold.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+id }, 
                    success:function(data) {
               
                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success")


                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);

         
                        }
                        else{
                           swal("Cancelled", 'Something Wrong'  , "error");
                        }
                        
                        if(data==2 || data=='2' || data=="2"){
                            
                           swal("Hold", 'Remark Not Added ! '  , "error");
                            
                        }
                    }
            });


});
     

}  


function cancel_invoice(id){
    alert("Are You Sure")
    swal("Cancel Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();
     
        jQuery.ajax({
                type: "POST",
                url: 'invoice_cancel.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+id }, 
                    success:function(data) {

                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success")
                          
                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);

                        }
                        else{
                           swal("Terminated Request", 'Something Wrong'  , "error");
                        }
                         if(data==2 || data=='2' || data=="2"){
                            
                           swal("Terminated request", 'Remark Not Added ! '  , "error");
                            
                        }
                        
                    }
            });
});
     
}

function invoice_unhold(id){

swal("Unhold Remark:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();  
       
     
        jQuery.ajax({
                type: "POST",
                url: 'invoice_unhold.php',
               data: {data : 'value='+value+'&id='+id+'&so_trackid='+id }, 
                    success:function(data) {
                        
                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Remark added successfully' , "success");
                            
                          setTimeout(function(){ 
                              location.reload();
                          }, 3000);


         
                        }
                        else{
                            swal("Sorry", 'Something Wrong'  , "error");
                        }
                        
                        if(data==2 || data=='2' || data=="2"){
                            
                           swal("Oh! ", 'Enter Remarks ! '  , "error");
                            
                        }
                    }
            });


});
     
}
 
   
</script>

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



$no_of_records_per_page = 10;
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
                
            <input type="text" class="form-control" name="inv_no" id="inv_no" value="<? if(isset($_POST['inv_no'])){ echo $_POST['inv_no']; }  ?>" placeholder="Invoice Number">



            <select name="avo_branch" class="form-control" id="avo_branch" >       
				<?
                    
                  //========
                       
                        
                        if(strlen($branch_id)==0 || $branch_id=='all'){
                   $branch_sql = mysqli_query($con1,"select * from avo_branch " );
                        }
                        else { $branch_sql = mysqli_query($con1,"select * from avo_branch where id in($branch_id)");
                        }
                  
             
				
			//	$branch_sql = mysqli_query($con1,"select * from avo_branch");
			?>
                <option value="">Branch</option>
                
                <?php  
                while($branch_sql_result = mysqli_fetch_assoc($branch_sql)){ ?>
                
                <option value="<?php echo $branch_sql_result['id']; ?>" <? if( $_POST['avo_branch'] ==$branch_sql_result['id']  ){ echo 'selected'; } ?> >
                
                    <?php echo $branch_sql_result['name']; ?>
                </option>
                
                <?php } ?>
            </select>
            
    
    
 <!--   <select name="exec_id" class="form-control" id="exec_id" >       
				<?
            global $con2;
           $exe_sql = mysqli_query($con2,"SELECT * FROM salesteam where status=1 order by exe_name ASC");
           
           //echo $con2,"SELECT * FROM salesteam ";
           
  			?>
                <option value="-1">Sales Executive</option>
                
                <?php  
                while($exe = mysqli_fetch_assoc($exe_sql)){ ?>
                
                <option value="<?php echo $exe['exe_id']; ?>" <? if( $_POST['exec_id'] ==$exe['exe_id'] ){ echo 'selected'; } ?> >
                
                    <?php echo $exe['exe_name']; 
                    ?>
                </option>
                
                <?php } ?>
            </select>  -->
            
            
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


<!-- <input type="text" name="atm_id" id="atm_id" class="form-control" placeholder="Site/Sol/ATM ID"/> -->
            
            <input type="text" name="atm_id" id="atm_id" class="form-control" value="<? echo $_POST['atm_id']; ?>" placeholder="Site/Sol/ATM ID"/> 
            
            <input type="text" name="bank_name" id="bank_name" class="form-control" value="<? echo $_POST['bank_name']; ?>"placeholder="Bank Name"/>
        
        
        
            <select name="status" class="filter form-control">
                
                    <option value="" <? if(empty($_POST['status'])){ echo 'selected'; }  ?>>All Status</option>
                    <option value="1" <? if($_POST['status']=='1'){ echo 'selected'; }  ?> >Pending</option>
                    <option value="c" <? if($_POST['status']=='c'){ echo 'selected'; }  ?> >Cancel</option>
                    <option value="h" <? if($_POST['status']=='h'){ echo 'selected'; }  ?> >Hold</option>
                    <option value="2" <? if($_POST['status']=='2'){ echo 'selected'; }  ?>>Completed</option>
            </select>
                            
                            

                            
            <input type="submit" name="submit" class="form-control" value="submit">
                            
                            
</form>
        </div>
        </div>
        
       
       <?  
  
    
     
       if(isset($_POST["invno"]) || isset($_POST["branch_avo"]) || isset($_POST["cust"]) || isset($_POST["fromdt"]) || isset($_POST["todt"]) || isset($_POST["atm_id"]) || isset($_POST["sub_date"]) || isset($_POST["filter"]) || isset($_POST["bank_name"])){
         
          
                            
                $k = $_POST;
                $sliced = array_slice($k, 0, -1);
                if(isset($sliced)){
            

                    $i = 0;
                     $string = '';
                if($_SESSION['branch']==0 || $_SESSION['branch']=='all'){
                  $statement= "select * from so_order where";   
                        }
                        else { 
                $statement .= "select * from so_order where avo_branch='".$_SESSION['branch']."' and" ;
                        }
                    
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
                                    
                                    if($key=='atm_id'){                 
                                      
                                      
                                        $statement .=" $key LIKE '%".$val."%'";
                                      $statement .= " and";
                                    }
                                
                                
                                if($key != 'inv_no' && $key !='todt' && $key !='fromdt' && $key != 'atm_id' && $key != 'bank_name' && $key != 'branch_avo'){
                                     
                                     $statement .=" $key = '".$val."'";
                                     $statement .= " and";
                                }
 
 if($key=='branch_avo'){                 
                                      
                                      
                        $statement .=" avo_branch='".$val."'";
                        $statement .= " and";
                                    }
 
 
     if($key == 'bank_name'){
    $bank_name=$_POST['bank_name'];
    $demoqry=mysqli_query($con1,"select so_id from demo_atm where bank_name like '%".$bank_name."%' ");
     $all_alid=array();
while($demorow=mysqli_fetch_row($demoqry)){
         //echo $demorow[0];
	 $all_alid[]=$demorow[0];
}
$string = implode(",",$all_alid);

                        
    $statement .=" po_id in($string)";
    $statement .= " and";
                                } 
                                
//============Executive filter========

/*if($key == 'exec_id'){
    $exec=$_POST['exec_id'];
    
    $exeqry=mysqli_query($con1,"select id from purchase_order where salesperson = '".$exec."' ");
     $all_alid=array();
while($exerow=mysqli_fetch_row($exeqry)){
         //echo $demorow[0];
	 $po_alid[]=$exerow[0];
}
$string = implode(",",$po_alid);

                        
    $statement .=" po_id in($string)";
    $statement .= " and";
                                }  */

                            
                        }

                    }   
                }


    $statement  = substr($statement, 0, strlen($statement)-3);   
   
    $statement .= " order by id desc";
//  echo $statement;
    
           }   
   
       if(empty($statement)){
           
        $statement= "select * from so_order where ";   
        if($_SESSION['branch']==0 || $_SESSION['branch']=='all'){
                    
                        }
                        else { 
        $statement .= " avo_branch='".$_SESSION['branch']."' " ;
                        }
                   
 $statement .=" order by id desc";
       
} 

$count_sql = str_replace("*","count(*) as count_number",$statement);

    $total_rows = mysqli_query($con1,$count_sql);

        $if_account = mysqli_fetch_assoc($total_rows);
        $total_rows = $if_account['count_number'];
        $total_pages = ceil($total_rows / $no_of_records_per_page);  



$sqlqry =$statement; 
$sql =$statement;

echo $sql;


?>


<!--Table-->



<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:3px;" class="res" id="custtable">
<tbody><tr>

<th>S.N.</th> 
<th>SO Date time</th> 
<th>DO No.</th> 
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
<th>Delivery Mode</th>
<th>Courier</th>
<th>Docket No.</th>
<th>Estimated Delivery Date</th>
<th>Dispatch Date</th>
<th>Delivery Date</th>



<? if($_SESSION['designation']!=5){ ?>
<th>Update Delivery</th>
<? } ?>
<th>Delivery Note/ Remarks</th>
<th>Invoice Copy</th>
<th>Credit Note Copy</th>

<? if($_SESSION['designation']!=5){ ?>
<th>Edit</th>
<? }  ?>

<th>View Sales Order</th>
<th>Add/View Remarks</th>

<th>Pre-Invoice Update</th>
<th>Status</th>

<? if($_SESSION['designation']!=5) { ?>
 <th>Generate Calls</th>
<th>Action</th>       
<? } ?>

<? if($_POST['status']=='2') { ?>
<th>Call Ticket No.</th> 
<th>Status</th>
<? } ?>

</tr>

<?

    $sql = $sql." LIMIT  $offset, $no_of_records_per_page";
 
 $sqlexp=$sql;
 
// echo $sqlexp;
    
    $prepared_sql = mysqli_query($con1,$sql);
       


       if(empty($prepared_sql) || $prepared_sql==NULL || $prepared_sql=='' || !$prepared_sql){
           
           
    $prepared_sql = mysqli_query($con1,"select * from so_order order by id desc LIMIT $offset, $no_of_records_per_page
");

  $total_pages = "SELECT COUNT(*) FROM so_order";        
                $result = mysqli_query($con1,$total_pages);
                $total_rows = mysqli_fetch_array($result)[0];
                
                
       } 
       ?>
       <h4 style="color:white;text-align:center;">Total <? echo $total_rows;?> Records..</h4>
       <? 
    
    
       while($prepared_sql_result = mysqli_fetch_assoc($prepared_sql)){ 
       
       
           $id = $prepared_sql_result['po_id'];
        //   echo $id;
    

        $so_order_id = $prepared_sql_result['id'];

//==========================================  
$newsales_qry= mysqli_query($con1,"select * from new_sales_order where so_trackid = '".$id."' ");
    
    $newsales = mysqli_fetch_assoc($newsales_qry);
        $inst_rqst=$newsales['inst_request'];

if ($inst_rqst==1)
{$inst_rqst= "Yes"; }
else {$inst_rqst=  "No" ;} 

$po = $newsales['po_trackid'];

$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$newsales['branch_id']."'");
    
    $branch_sql_result = mysqli_fetch_row($branch_sql);
$br_name=$branch_sql_result[0];

$cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$newsales['po_custid']."'");
    
    $custrow = mysqli_fetch_row($cust_sql);
$cust_name=$custrow[0];
       ?>

           

<tr>
    
<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top"><?php echo get_atm('so_date',$id,$con1); ?></td>
<td  valign="top"><?php echo get_atm('DO_no',$id,$con1); ?></td>

<td  name="inv_no" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_no']; ?></td>
<td  name="inv_date" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_date']; ?></td>
<td  name="inv_date" valign="top">&nbsp;<?php echo $prepared_sql_result['inv_value']; ?></td>
<td  name="customer" valign="top">&nbsp;<?php echo $cust_name; ?></td> 
<!--<td  name="bank_name" valign="top">&nbsp;<?php echo get_atm('bank_name',$id,$con1); ?></td> -->
<td valign="top">&nbsp;<?php echo get_atm('bank_name',$id,$con1); ?></td>

<td  name="address" valign="top">&nbsp; <?php echo get_atm('address',$id,$con1); ?></td>


<td  name="branch" valign="top">&nbsp;<?php echo $br_name; ?></td>  


<!--<td  name="atm_id" valign="top">&nbsp;<?php echo get_atm('atm_id',$id,$con1); ?></td> -->

<td valign="top">&nbsp;<?php echo get_atm('atm_id',$id,$con1); ?></td> 

<td  name="crn_no" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_no']; ?></td> 

<!--<td  name="crn_date" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_date']; ?></td> -->
<td  name="crn_amount" valign="top">&nbsp;<?php echo $prepared_sql_result['crn_amount']; ?></td> 

<td  valign="top"><?php echo $newsales['del_type']; ?></td>
<td  Valign="top">&nbsp;&nbsp;<?php echo "$inst_rqst" ; ?> 

<? if ($_SESSION['user']=='masteradmin'){ ?>
<a class="btn btn-success" href="javascript:inst_edit('<?php echo $id; ?>')" style="color:white;">Edit</a> 
<? } ?>
</td>


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
<td  name="" valign="top">&nbsp;<?php echo $prepared_sql_result['del_mode']; ?></td>
<td  name="" valign="top">&nbsp;<?php echo $prepared_sql_result['courier']; ?></td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['docketno']; ?></td>   
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['est_date']; ?></td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['dis_date']; ?></td>




<td valign="top">&nbsp;<div id="deldiv<?php echo $prepared_sql_result['id']; ?>" >
        <?php
        if($prepared_sql_result['del_date']!='0000-00-00'){ 
            echo $prepared_sql_result['del_date'];
        } ?>
    </div>
</td>
<? if($_SESSION['designation']!=5){ ?>
<td valign="top">&nbsp;<div class="dispatch_date" id="subdiv<?php echo $prepared_sql_result['id']; ?>" >

<?php  

if($prepared_sql_result['del_date']=='0000-00-00'){ ?>
		<input type="text" name="sub<?php echo $prepared_sql_result['id']; ?>" id="sub<?php echo $prepared_sql_result['id']; ?>"  onclick="displayDatePicker('sub<?php echo $prepared_sql_result['id']; ?>');"  />

		<input type="button" name="submission" value="submission" onclick="setSubmit(<?php echo $prepared_sql_result['id']; ?>)" />
		<?php }
		else{
		  ?>

<input type="text" name="sub<?php echo $prepared_sql_result['id']; ?>" id="sub<?php echo $prepared_sql_result['id']; ?>"  onclick="displayDatePicker('sub<?php echo $prepared_sql_result['id']; ?>');"  value="<?php echo $prepared_sql_result['del_date']; ?>"/>
		<input type="button" name="submission" value="Update" onclick="setSubmit(<?php echo $prepared_sql_result['id']; ?>)" />
<?php }} ?>


</div>
</td>
<td  valign="top">&nbsp;<?php echo $prepared_sql_result['remarks']; ?></td>
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
<? if($_SESSION['designation']!=5){ ?>
<td><a href="javascript:void(0);" onclick='window.open("new_edit_inv.php?id=<?php echo $prepared_sql_result['id']; ?>","_blank");'>EDIT</a></td>
<? } ?>


<!--<td><a href="view_so.php?id=<?php echo $prepared_sql_result['po_id']; ?>" >View SO</a></td> -->

<td style="display: flex;justify-content: center;"> 
    
     <a style="color:black;" style="margin:5px;"class="btn btn-success" href="view_so.php?id=<? echo $prepared_sql_result['po_id']; ?>">View SO</a>
   
    </td> 


<!--<td><a href="javascript:void(0);" onclick="window.open('update_generateSO.php.php?id=<?php echo $prepared_sql_result['po_id']; ?>&typ=2','view updates')" class="update" >View Remarks</a></td> -->

<td><a href="javascript:void(0);" onclick="window.open('new_update_generateSO.php?id=<?php echo $prepared_sql_result['po_id']?>&typ=2','Update_generateSO')" class="update" >Add/View Remarks</a></td>

<td>
    <? $qryfirst="SELECT Remarks_update FROM `SO_Update` WHERE so_id='".$id."' and remarks_type=1 order by updt_id desc ";
 //   echo $qryfirst;
	$tab=mysqli_query($con1,$qryfirst);
	$upd=mysqli_fetch_row($tab);
	echo $upd[0]; ?>
    
</td>

<td>
     <?
     if($prepared_sql_result['status'] =='1'){ echo "Pending"; }
     if($prepared_sql_result['status'] =='c'){ echo "Cancelled"; }
     if($prepared_sql_result['status'] =='h'){ echo "Hold"; }
     if($prepared_sql_result['status'] =='2'){ echo "Completed"; }
     ?>


</td>
 <td>
     <?
     if($prepared_sql_result['status'] =='1'){  ?>
     
     
     
         <? if($prepared_sql_result['del_date']!='0000-00-00'){ 
                
                   $del_type = $newsales['del_type'];
                   $inst_request=  $newsales['inst_request'];
                   
                   $customer_id = $newsales['po_custid'];
                 
     // if($_SESSION['designation']!=5){              
                   
                   if($del_type=='site_del' && $inst_request==1){ ?>
                               
                               <a class="btn btn-success" href="javascript:confirm_generate('<?php echo $customer_id; ?>','<?php echo get_atm('atm_id',$id,$con1); ?>','<?php echo $id; ?>',<? echo $so_order_id;?>);" > Generate Call</a>
                               
                               
                                       
                   <? }
                   
                   elseif($del_type=='opex' && $inst_request==1){ ?>
                        
                         <a class="btn btn-success" href="javascript:confirm_rental('<?php echo $customer_id; ?>','<?php echo get_atm('atm_id',$id,$con1); ?>','<?php echo $id; ?>',<? echo $so_order_id;?>);" > Generate Call</a>
                  
                   <? }
                   
                   
                   
                   else{ ?>
                        
                    <a class="btn btn-success" href="javascript:confirm_close('<?php echo $customer_id; ?>','<?php echo get_atm('atm_id',$id,$con1); ?>',<?php echo $id; ?>)" style="color:white;">Close</a>
                  
                   <? }
             
      //   }
                   
         ?> 
         
    
        <? } }
        
        else{

        }
        
        ?>
     
 </td>
 
     <td>
         <?    if($_SESSION['designation'] ==7){   
         
         if($prepared_sql_result['status'] =='1'){ ?>
        <a style="margin:5px;" style="color:white;" class="btn btn-danger sales_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="cancel_invoice(<? echo $id;?>)" >Cancel</a>
        
        
           <a style="margin:5px;" class="btn btn-warning hold_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="invoice_hold(<? echo $id;?>)">Hold</a>
           
        <? }
        
        if($prepared_sql_result['status']=='h'){ ?>
                      <a style="margin:5px;" class="btn btn-danger unhold_btn" sales_id="<? echo $id; ?>" id="<? echo $id; ?>" onclick="invoice_unhold(<? echo $id;?>)" >Unold</a>
           
 
        <? }
         if($prepared_sql_result['status']=='c'){ echo "Cancelled";}
        
        
         }
        ?>
       </td>
  <!--===========Call Ticket===========  -->
   <?  if($prepared_sql_result['status'] =='2'){ 
    
    $sqlalert= mysqli_query($con1,"select * from alert where alert_id = '".$prepared_sql_result['alert_id']."' ");
   $alert = mysqli_fetch_assoc($sqlalert);
   
   if($alert['call_status']=="Done" or $alert['status']=="Done"){
  $call_status="Closed" ;}  
else if($alert['call_status']=="1"){
    $call_status="Pending" ;} 
    
else if($alert['call_status']=="") {
 $call_status="Not Assigned" ;}
 else {$call_status=$alert['call_status'];
     
 }     ?>
    <td  valign="top">&nbsp;<?php echo $alert['createdby']; ?></td>    
    <td  valign="top">&nbsp;<?php echo $call_status; ?></td>
 
  <? }  ?>   
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
    
     <!--<form name="frm" method="post" action="invoice_export_test.php" target="_new" style="text-align: center;">-->
        <form name="frm" method="POST" action="https://avoservice.in/exportexcel_new_test.php" style="text-align: center;">
             <input type="hidden" name="qr" value="<?php echo $sqlqry; ?>">    
             <input type="submit" name="cmdsub" value="Export" target="_blank"> <span>(You can Export MAX 2000 Records at one Time.)</span>
        </form>
    

</div>     



    </body>
</html>
<?php  

    CloseCon($con1);
    CloseCon($con2);

?>