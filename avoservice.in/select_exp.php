<?php session_start();
include("access.php");
include('config.php');
          include("menubar.php");  

?>
<html>
    <head>
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

 
 
    </head>
    
            
           <?
         echo "<h4 style='color:white;text-align:center;'>Select The Expenses Type </h4>"; 
          $sql=mysqli_query($con1,"select id, name from `branch_exphead` where status=1 order by id");

           ?>
           <div class="search_result" style="width: 80%; margin: 2% 5%;">
           <?
               while($sql_result = mysqli_fetch_assoc($sql)){
                   
                   
                  $po = $sql_result['name'];
                  $id = $sql_result['id'];
    
                  
                  ?>
                <a style="color:white;" href="branch_exp_entry.php?id=<? echo $id; ?>"><? echo $po;?></a>
    
    
               <?
               
                   echo '<br>';
               }?>    
           </div>
                          
         
    </body>
      
      </html>  