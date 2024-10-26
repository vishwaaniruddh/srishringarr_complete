<?php include('config.php'); ?>
<html>
    <head>
        <style>
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
        
<h3> Using HTML5 </h3>
<input list="browsers" name="browser">
<datalist id="browsers">
    
    <?php 
        $sql_buyer = mysqli_query($con1,"select * from buyer where status = 1");
        
        while($result = mysqli_fetch_assoc($sql_buyer)){ ?>
            
            <option value="<?php echo $result['buyer_ID'];?>" ><?php echo $result['buyer_name'];?></option>
        <?php } ?>
  
  
</datalist>
    </body>
</html>

