<?php
include("access.php");

?>

<?php
include 'config.php';

$page=$_GET['page'];
         $sr=1;
         if($page=="" || $page=='1')
         {
           $page1=0;  
           $sr="1";
         }
         else
         {
         
          $page1=($page*20)-20;  
          
           $sr=(20* $page)-20;
	  
	   $sr=$sr+1;
         
         }
         
        

         
$sql="select * from UpdateStatus limit $page1,20";
$result=mysqli_query($con1,$sql);

    
     $Num_Rows=mysqli_num_rows($result);
     
    
 $sql1="select * from UpdateStatus ";
 
$result1=mysqli_query($con1,$sql1);
$count=mysqli_num_rows($result1);

  
   ?> 
   
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>
table {width:auto; table-layout:auto; text-align:left; width:55%; border-collapse:collapse; empty-cells:hide;}
	
}
td{
	padding:7px;
	font-size:12px;
	font-weight: bold;
	//color:#000;
}

 th{
	-ms-border:1px solid #fff;
	border:1px solid #fff;
    color:#fff; 
    font-size:13px; 
    text-align:left;
    font-family:"Times New Roman", Times, serif;
    background-color:#005252;
    padding:4px;
	text-align:left;
  }



tr:nth-of-type(2n-1){
	-ms-border:1px solid #fff;
	-moz-border:1px solid #fff;
	-o-border:1px solid #fff;
    border:1px solid #fff;
    color:#000; 
    font-size:14px; 
	font-weight:bold;
	font-stretch:condensed;
    text-align:left; 
    font-family:"Times New Roman", Times, serif;
    background-color:#4D9494; 
	-moz-background-color:#4D9494;
	-webkit-background-color:#4D9494;
   padding:5px;
  }
tr:nth-of-type(2n){
	-moz-border:1px solid #fff;
	-ms-border:1px solid #fff;
	-o-border:1px solid #fff;
	border:1px solid #fff;
    color:#000;
    font-size:14px;
	font-weight:bold;
	font-stretch:condensed;
    text-align:left; font-family:"Times New Roman", Times, serif; 
    background-color:#B2D1D1; 
	-webkit-background-color:#B2D1D1;
	-moz-background-color:#B2D1D1;
    padding:5px;
	}
	
tr:hover {background-color: #7A9999; cursor:default;}	
	
tr:nth-of-type(2n-1) a{text-decoration:none; color:#005200; font-weight:bold; font-size:15px; }	
tr:nth-of-type(2n-1) a:hover {color:#F00;}

tr:nth-of-type(2n)  a{text-decoration:none; color:#005200; font-weight:bold; font-size:15px; }
tr:nth-of-type(2n)  a:hover {color:#F00;}

tr:nth-of-type(2n-1) a.update {text-decoration:none; color:#FFFF00; font-weight:bold; font-size:16px;}
tr:nth-of-type(2n-1) a.update:hover {color:#FFF;}

tr:nth-of-type(2n) a.update {text-decoration:none; color:#FFFF00; font-weight:bold; font-size:16px;}
tr:nth-of-type(2n) a.update:hover {color:#FFF;}



</style>
</head>

&nbsp;&nbsp;&nbsp;
      <center><h1 style="margin-top:5px; color:#fff;"  ><b>Updates view</b></h1></center>
       
        
		   

<body>
<?php include("menubar.php");?>  

<div align="center">total records:<?php echo $count?></div>

  <table border="1"  align="center" style="margin-top:30px">
  <tr>
    <th>sr</th>
      <th>status_id</th>
    <th>comments</th>
    <th>status</th>
    

  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { ?>

 <tr >
   <td><?php echo $sr;?></td>
    <td><?php echo $row["status_id"];?></td>
    <td><?php echo $row["comments"];?></td>
    <td><?php echo $row["status"];?></td>
   
   <?php
   $sr++;
   ?>
<?php 
}
?>

</table>



<?php
         $a=$count/20;
         $a=ceil($a);
         //echo $a;
      
         for($b=1;$b<=$a;$b++)
          
         
         
       {
          ?> <div align="center" <a href="viewupdate.php?page=<?php echo $b ?>" style="text-decoration:none "> <?php echo $b." ";?> </a></div>
            
          <?php
        
         }
         
       ?>
       

</body>
</html>







