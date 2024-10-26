<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php');

    
        include('menu.php');
        ?>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
        
        <style>
            td, th{
                text-align:center;
            }
        </style>
        
        
        <section class="cust_form">

            <div class="container">
        <?php
        
        
        if(isset($_POST['submit'])){
            
       $number = $_POST['mobile'];


 $sql = "update new_member set is_whatsapp_send = 0 where mobile='".$number."'";

if(mysqli_query($con,$sql)){
    echo 'succesfully Blocked !';    
}
else{
    echo 'Error in  Blocking !';    
}
}



        ?>
        
                <div class="content">
                    
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    
                    
                      <div class="form-group">
                        <label for="message">Enter Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control">
                      </div>
                      
                      <input type="submit" name="submit" class="btn btn-danger" value="block"></button>
                    
                    </form>
    
    
                </div>
                
                
                <div class="content">
<h2>Blocked number</h2>
<table class="table" style="background: white;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Number</th>
    </tr>
    <tbody>
<?
$sql = mysqli_query($con,"select * from new_member where mobile > 0 and status=1 and is_whatsapp_send= 0 ");
$i=1 ; 
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
    
    <tr>
      <th scope="row"><? echo $i ; ?></th>
      <td><? echo $sql_result['name']; ?></td>
      <td><? echo $sql_result['mobile'];?></td>
    </tr>
    
<? $i++; } ?>
            
    </tbody>
  </thead>              
</table>



                </div>
                                    
                                    
            </div>    
        </section>
        
    </body>
</html>