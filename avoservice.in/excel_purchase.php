<?php session_start();
include("access.php");
?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bulk Upload Purchase Order </title>
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
 
.bd-example {
    position: relative;
    padding: 5rem;
    margin: 2rem -15px 0;
    border: none;
    border-width: 0;
}
form{
    margin:2%;
    display:flex;
    justify-content:center;
}
.cust_file{
    color: white;
    background-color: #4d9494;
        width: 50%;
}

        </style>
    </head>
    <body>
        <?
        
        include("menubar.php");   ?>
        
        <br>
        <br>
        <form action="process_excel_purchase.php" method="post" enctype="multipart/form-data">
          <input type="file" name="images" class="form-control cust_file">
          <input type="submit" value="upload" class="btn btn-danger">
        </form>
    <h2>Excel format for PO:</h2>
    
     PO Number,	PO Date,	Customer Vertical,	Buyer Name,	Branch,	Sales Person,	Mode of Sales,	Delivery TAT,	Payment Terms,	Addl Information if any,	Product (Product Name, Specification, Qty, Rate, Warranty in Months- (12 Months)),	remarks,	delivery type,	other charges,	non_std_product,  	userid,	raiseby 
    
    
    </body>
</html>
